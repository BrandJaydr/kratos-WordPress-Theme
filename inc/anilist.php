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

        $transient_key = 'anilist_data_' . md5($userName);
        $cached_data = get_transient($transient_key);

        if ($cached_data !== false) {
            $this->applyData($cached_data);
            return;
        }

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

        $variables = ["userName" => $userName];
        $response = $this->query($query, $variables);

        if (!is_wp_error($response)) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            if (isset($body['data']['MediaListCollection']['lists'])) {
                set_transient($transient_key, $body['data'], HOUR_IN_SECONDS);
                $this->applyData($body['data']);
            }
        }
    }

    private function applyData($data) {
        foreach ($data['MediaListCollection']['lists'] as $list) {
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

    private function query($query, $variables) {
        $url = 'https://graphql.anilist.co';
        return wp_remote_post($url, array(
            'headers' => array('Content-Type' => 'application/json', 'Accept' => 'application/json'),
            'body'    => json_encode(array('query' => $query, 'variables' => $variables)),
            'timeout' => 15,
        ));
    }
}
