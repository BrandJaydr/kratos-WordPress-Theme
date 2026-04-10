<?php
class Bluesky {
    public $posts = array();
    public $profile = null;

    public function __construct($handle) {
        if (empty($handle)) return;

        $this->fetchProfile($handle);
        $this->fetchFeed($handle);
    }

    private function fetchProfile($handle) {
        $url = "https://public.api.bsky.app/xrpc/app.bsky.actor.getProfile?actor=" . urlencode($handle);
        $response = $this->query($url);
        if ($response && !isset($response['error'])) {
            $this->profile = [
                'did' => $response['did'],
                'handle' => $response['handle'],
                'displayName' => $response['displayName'] ?: $response['handle'],
                'description' => $response['description'],
                'avatar' => $response['avatar'],
                'banner' => $response['banner'],
                'followersCount' => $response['followersCount'],
                'followsCount' => $response['followsCount'],
                'postsCount' => $response['postsCount']
            ];
        }
    }

    private function fetchFeed($handle) {
        $url = "https://public.api.bsky.app/xrpc/app.bsky.feed.getAuthorFeed?actor=" . urlencode($handle) . "&limit=10";
        $response = $this->query($url);
        if ($response && isset($response['feed'])) {
            foreach ($response['feed'] as $item) {
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

    private function query($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
