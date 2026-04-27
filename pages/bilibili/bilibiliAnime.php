<?php
class bilibiliAnime
{
    public $title=array();//Title
    public $image_url=array();//Image link
    public $total=array();//Total episodes
    public $progress=array();//My progress
    public $evaluate=array();//Description
    public $season_id=array();//ID number, used for series jump
    public $sum;//Number of series
//    This is the function that processes viewing history from Bilibili API (requires Chinese markers for parsing)
    private function process($content)
    {
        $start=stripos($content,"第");
        if($start!==false)
        {
            $end=stripos($content,"话");
            return substr($content,$start+3,$end-$start-3);
        }
        else
        {
            $start=stripos($content,"到");
            if($start!==false)
            {
                return substr($content,$start+3);
            }
            else
            {
                $start=stripos($content,"完");
                if($start!==false)
                {
                    return substr($content,$start+3);
                }
                else
                {
                    return "No record!";
                }
            }
        }
    }
    private function getpage($uid)
    {
        $url="https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&pn=1&ps=15&vmid=$uid";
        $ch = curl_init(); //Initialize curl module
        curl_setopt($ch, CURLOPT_URL, $url); //Address to submit login
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);//This is key: return the fetched data as a file stream instead of outputting directly
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //Send request headers
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.90 Safari/537.36",
            "Referer: https://www.bilibili.com/",
        ));

        $info=json_decode(curl_exec($ch),true);
        if (PHP_VERSION_ID < 80000) curl_close($ch);//Close connection
        return $info['data']['total'];
    }
    public function __construct($uid,$cookie)
    {
        $this->sum=$this->getpage($uid);
        for($i=1;$i<=ceil($this->sum/15);$i++)
        {
            $url="https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&pn=$i&ps=15&vmid=$uid";
            $ch = curl_init(); //Initialize curl module
            curl_setopt($ch, CURLOPT_URL, $url); //Address to submit login
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);//This is key: return the fetched data as a file stream instead of outputting directly
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                //Send request headers
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.90 Safari/537.36",
                "Referer: https://www.bilibili.com/",
                "Cookie: $cookie",
            ));
            $info=json_decode(curl_exec($ch),true);
            if (PHP_VERSION_ID < 80000) curl_close($ch);//Close connection
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
