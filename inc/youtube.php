<?php
class YouTube {
    public $videos = array();
    public $channel = null;

    public function __construct($apiKey, $channelId) {
        if (empty($apiKey) || empty($channelId)) return;

        $transient_key = 'youtube_data_' . md5($channelId);
        $cached_data = get_transient($transient_key);

        if ($cached_data !== false) {
            $this->channel = $cached_data['channel'];
            $this->videos = $cached_data['videos'];
            return;
        }

        $channel_url = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id={$channelId}&key={$apiKey}";
        $channel_response = wp_remote_get($channel_url, array('timeout' => 15));

        if (!is_wp_error($channel_response)) {
            $body = json_decode(wp_remote_retrieve_body($channel_response), true);
            if (isset($body['items'][0])) {
                $item = $body['items'][0];
                $this->channel = [
                    'title' => $item['snippet']['title'],
                    'description' => $item['snippet']['description'],
                    'thumbnail' => $item['snippet']['thumbnails']['default']['url'],
                    'banner' => $item['snippet']['thumbnails']['high']['url'],
                    'subscriberCount' => $item['statistics']['subscriberCount'],
                    'videoCount' => $item['statistics']['videoCount'],
                    'viewCount' => $item['statistics']['viewCount']
                ];
            }
        }

        $videos_url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId={$channelId}&maxResults=10&order=date&type=video&key={$apiKey}";
        $videos_response = wp_remote_get($videos_url, array('timeout' => 15));

        if (!is_wp_error($videos_response)) {
            $body = json_decode(wp_remote_retrieve_body($videos_response), true);
            if (isset($body['items'])) {
                foreach ($body['items'] as $item) {
                    $this->videos[] = [
                        'id' => $item['id']['videoId'],
                        'publishedAt' => $item['snippet']['publishedAt'],
                        'title' => $item['snippet']['title'],
                        'description' => $item['snippet']['description'],
                        'thumbnail' => $item['snippet']['thumbnails']['high']['url']
                    ];
                }
            }
        }

        if ($this->channel) {
            set_transient($transient_key, ['channel' => $this->channel, 'videos' => $this->videos], HOUR_IN_SECONDS);
        }
    }
}
