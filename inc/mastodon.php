<?php
class Mastodon {
    public $statuses = array();
    public $user = null;

    public function __construct($instance, $userId) {
        if (empty($instance) || empty($userId)) return;

        $transient_key = 'mastodon_data_' . md5($instance . $userId);
        $cached_data = get_transient($transient_key);

        if ($cached_data !== false) {
            $this->user = $cached_data['user'];
            $this->statuses = $cached_data['statuses'];
            return;
        }

        $user_response = $this->query("https://{$instance}/api/v1/accounts/{$userId}");
        if (is_wp_error($user_response)) return;

        $user_body = json_decode(wp_remote_retrieve_body($user_response), true);
        if ($user_body && isset($user_body['username'])) {
            $this->user = [
                'username' => $user_body['display_name'] ?: $user_body['username'],
                'avatar' => $user_body['avatar'],
                'header' => $user_body['header'],
                'note' => $user_body['note'],
                'url' => $user_body['url'],
                'followers_count' => $user_body['followers_count'],
                'following_count' => $user_body['following_count'],
                'statuses_count' => $user_body['statuses_count'],
                'fields' => $user_body['fields']
            ];
        }

        $statuses_response = $this->query("https://{$instance}/api/v1/accounts/{$userId}/statuses?exclude_reblogs=false&limit=20");
        if (!is_wp_error($statuses_response)) {
            $statuses_body = json_decode(wp_remote_retrieve_body($statuses_response), true);
            if (is_array($statuses_body)) {
                foreach ($statuses_body as $status) {
                    $this->statuses[] = [
                        'id' => $status['id'],
                        'created_at' => $status['created_at'],
                        'content' => $status['content'],
                        'url' => $status['url'],
                        'replies_count' => $status['replies_count'],
                        'reblogs_count' => $status['reblogs_count'],
                        'favourites_count' => $status['favourites_count'],
                        'media_attachments' => $status['media_attachments']
                    ];
                }
            }
        }

        if ($this->user) {
            set_transient($transient_key, ['user' => $this->user, 'statuses' => $this->statuses], HOUR_IN_SECONDS);
        }
    }

    private function query($url) {
        return wp_remote_get($url, array('timeout' => 15, 'headers' => array('Accept' => 'application/json')));
    }
}
