<?php
class bilibiliAnime
{
    public $title=array();//Title
    public $image_url=array();//Image Link
    public $total=array();//Total episodes
    public $progress=array();//My progress
    public $evaluate=array();//介绍
    public $season_id=array();//ID No.，Used for anime jump
    public $sum;//Number of anime
//    This function handles my watch records
    private function process($content)
    {
        $start=stripos($content,"Episode ");
        if($start)
        {
            $end=stripos($content,"");
            return substr($content,$start+3,$end-$start-3);
        }
        else
        {
            $start=stripos($content," to ");
            if($start)
            {
                return substr($content,$start+3);
            }
            else
            {
                $start=stripos($content," Finished");
                if($start)
                {
                    return substr($content,$start+3);
                }
                else
                {
                    return "No records!";
                }
            }
        }
    }
    private function getpage($uid)
    {
        $url="https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&pn=1&ps=15&vmid=$uid";
        $ch = curl_init(); //InitializecurlModule
        curl_setopt($ch, CURLOPT_URL, $url); //Login submission URL
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);//This is key: fetched  to  data returned as file stream，rather than direct output
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //Send request header
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.90 Safari/537.36",
            "Referer: https://www.bilibili.com/",
        ));

        $info=json_decode(curl_exec($ch),true);
        curl_close($ch);//Close connection
        return $info['data']['total'];
    }
    public function __construct($uid,$cookie)
    {
        $this->sum=$this->getpage($uid);
        for($i=1;$i<=ceil($this->sum/15);$i++)
        {
            $url="https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&pn=$i&ps=15&vmid=$uid";
            $ch = curl_init(); //InitializecurlModule
            curl_setopt($ch, CURLOPT_URL, $url); //Login submission URL
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);//This is key: fetched  to  data returned as file stream，rather than direct output
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                //Send request header
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.90 Safari/537.36",
                "Referer: https://www.bilibili.com/",
                "Cookie: $cookie",
            ));
            $info=json_decode(curl_exec($ch),true);
            curl_close($ch);//Close connection
            foreach ($info['data']['list'] as $data) {
                array_push($this->title, $data['title']);
                array_push($this->image_url, $data['cover']);
                array_push($this->total, $data['new_ep']['title']);
                array_push($this->progress,$this->process($data['progress']));
                array_push($this->evaluate, $data['evaluate']);
                array_push($this->season_id, $data['season_id']);
            }
        }
    }

}
