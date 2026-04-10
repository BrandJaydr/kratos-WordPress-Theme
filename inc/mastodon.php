<?php
class Mastodon {
    public $statuses = array();
    public $user = null;

    public function __construct($instance, $userId) {
        if (empty($instance) || empty($userId)) return;

        $this->fetchUser($instance, $userId);
        $this->fetchStatuses($instance, $userId);
    }

    private function fetchUser($instance, $userId) {
        $url = "https://{$instance}/api/v1/accounts/{$userId}";
        $response = $this->query($url);
        if ($response) {
            $this->user = [
                'username' => $response['display_name'] ?: $response['username'],
                'avatar' => $response['avatar'],
                'header' => $response['header'],
                'note' => $response['note'],
                'url' => $response['url'],
                'followers_count' => $response['followers_count'],
                'following_count' => $response['following_count'],
                'statuses_count' => $response['statuses_count'],
                'fields' => $response['fields']
            ];
        }
    }

    private function fetchStatuses($instance, $userId) {
        $url = "https://{$instance}/api/v1/accounts/{$userId}/statuses?exclude_reblogs=false&limit=20";
        $response = $this->query($url);
        if ($response && is_array($response)) {
            foreach ($response as $status) {
                $this->statuses[] = [
                    'id' => $status['id'],
                    'created_at' => $status['created_at'],
                    'content' => $status['content'],
                    'url' => $status['url'],
                    'replies_count' => $status['replies_count'],
                    'reblogs_count' => $status['reblogs_count'],
                    'favourites_count' => $status['favourites_count'],
                    'media_attachments' => $status['media_attachments'],
                    'reblog' => $status['reblog']
                ];
            }
        }
    }

    private function query($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
