<?php
class AniList {
    public $title = array();
    public $image_url = array();
    public $total = array();
    public $progress = array();
    public $evaluate = array();
    public $media_id = array();
    public $sum = 0;

    public function __construct($userName) {
        if (empty($userName)) return;

        $query = '
        query ($userName: String) {
          MediaListCollection(userName: $userName, type: ANIME, status: CURRENT) {
            lists {
              entries {
                media {
                  id
                  title {
                    romaji
                    english
                    native
                  }
                  coverImage {
                    large
                  }
                  episodes
                  description
                }
                progress
              }
            }
          }
        }';

        $variables = [
            "userName" => $userName
        ];

        $http = $this->query($query, $variables);

        if (isset($http['data']['MediaListCollection']['lists'])) {
            foreach ($http['data']['MediaListCollection']['lists'] as $list) {
                foreach ($list['entries'] as $entry) {
                    $media = $entry['media'];
                    $this->title[] = $media['title']['english'] ?: $media['title']['romaji'];
                    $this->image_url[] = $media['coverImage']['large'];
                    $this->total[] = $media['episodes'] ?: '?';
                    $this->progress[] = $entry['progress'];
                    $this->evaluate[] = wp_strip_all_tags($media['description']);
                    $this->media_id[] = $media['id'];
                    $this->sum++;
                }
            }
        }
    }

    private function query($query, $variables) {
        $url = 'https://graphql.anilist.co';
        $data = json_encode(['query' => $query, 'variables' => $variables]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
