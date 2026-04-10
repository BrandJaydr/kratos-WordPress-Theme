<?php
class Bluesky {
    public $posts = array();
    public $profile = null;

    public function __construct($handle) {
        if (empty($handle)) return;

        $transient_key = 'bluesky_data_' . md5($handle);
        $cached_data = get_transient($transient_key);

        if ($cached_data !== false) {
            $this->profile = $cached_data['profile'];
            $this->posts = $cached_data['posts'];
            return;
        }

        $profile_url = "https://public.api.bsky.app/xrpc/app.bsky.actor.getProfile?actor=" . urlencode($handle);
        $profile_response = wp_remote_get($profile_url, array('timeout' => 15));

        if (!is_wp_error($profile_response)) {
            $body = json_decode(wp_remote_retrieve_body($profile_response), true);
            if ($body && !isset($body['error'])) {
                $this->profile = [
                    'did' => $body['did'],
                    'handle' => $body['handle'],
                    'displayName' => $body['displayName'] ?: $body['handle'],
                    'description' => $body['description'],
                    'avatar' => $body['avatar'],
                    'banner' => $body['banner'],
                    'followersCount' => $body['followersCount'],
                    'followsCount' => $body['followsCount'],
                    'postsCount' => $body['postsCount']
                ];
            }
        }

        $feed_url = "https://public.api.bsky.app/xrpc/app.bsky.feed.getAuthorFeed?actor=" . urlencode($handle) . "&limit=10";
        $feed_response = wp_remote_get($feed_url, array('timeout' => 15));

        if (!is_wp_error($feed_response)) {
            $body = json_decode(wp_remote_retrieve_body($feed_response), true);
            if (isset($body['feed'])) {
                foreach ($body['feed'] as $item) {
                    $post = $item['post'];
                    $this->posts[] = [
                        'uri' => $post['uri'],
                        'cid' => $post['cid'],
                        'author' => $post['author'],
                        'record' => $post['record'],
                        'embed' => $post['embed'],
                        'replyCount' => $post['replyCount'],
                        'repostCount' => $post['repostCount'],
                        'likeCount' => $post['likeCount'],
                        'indexedAt' => $post['indexedAt']
                    ];
                }
            }
        }

        if ($this->profile) {
            set_transient($transient_key, ['profile' => $this->profile, 'posts' => $this->posts], HOUR_IN_SECONDS);
        }
    }
}
