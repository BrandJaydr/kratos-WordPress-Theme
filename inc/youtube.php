<?php
class YouTube {
    public $videos = array();
    public $channel = null;

    public function __construct($apiKey, $channelId) {
        if (empty($apiKey) || empty($channelId)) return;

        $this->fetchChannel($apiKey, $channelId);
        $this->fetchVideos($apiKey, $channelId);
    }

    private function fetchChannel($apiKey, $channelId) {
        $url = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id={$channelId}&key={$apiKey}";
        $response = $this->query($url);
        if ($response && isset($response['items'][0])) {
            $item = $response['items'][0];
            $this->channel = [
                'title' => $item['snippet']['title'],
                'description' => $item['snippet']['description'],
                'thumbnail' => $item['snippet']['thumbnails']['default']['url'],
                'banner' => $item['snippet']['thumbnails']['high']['url'], // Banner logic might need brandingSettings
                'subscriberCount' => $item['statistics']['subscriberCount'],
                'videoCount' => $item['statistics']['videoCount'],
                'viewCount' => $item['statistics']['viewCount']
            ];
        }
    }

    private function fetchVideos($apiKey, $channelId) {
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId={$channelId}&maxResults=10&order=date&type=video&key={$apiKey}";
        $response = $this->query($url);
        if ($response && isset($response['items'])) {
            foreach ($response['items'] as $item) {
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

    private function query($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
