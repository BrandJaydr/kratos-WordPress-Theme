<?php
class BilibiliLive{
    public $uid;
    public $usrname;//Username
    public $sign;//Signature
    public $isvip;//Is VIP
    public $level;//Level
    public $sex;//Sex
    public $advanter;//Avatar
    public $hangpicture;//Pendant
    public $attation;//Following
    public $fans;//Fans
    public $play;//Plays
    public $birthday;//Birthday month
    public $spacepicture;
    public $archivecount;//Dynamics count
    public $next_url;//Nexturl


    public function __construct($uid)
    {
        $this->uid=$uid;
        $url="https://api.bilibili.com/x/space/acc/info?mid=$uid&jsonp=jsonp";
        //Get plays count
        $url2="https://api.bilibili.com/x/space/upstat?mid=$uid&jsonp=jsonp";
        //GetFans
        $url3="https://api.bilibili.com/x/relation/stat?vmid=$uid&jsonp=jsonp";
        //Get space background
        $url4="https://api.bilibili.com/x/web-interface/card?mid=$uid&photo=true";


        $ch = curl_init(); //Initialize curl module
        curl_setopt($ch, CURLOPT_URL, $url); //Address to submit login
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);//This is key: return the fetched data as a file stream instead of outputting directly
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //Send request headers
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.90 Safari/537.36",
            "Referer: https://www.bilibili.com/",
        ));
        $info=json_decode(curl_exec($ch),true);


        curl_setopt($ch, CURLOPT_URL, $url2); //Address to submit login
        $info2=json_decode(curl_exec($ch),true);

        curl_setopt($ch, CURLOPT_URL, $url3); //Address to submit login
        $info3=json_decode(curl_exec($ch),true);

        curl_setopt($ch, CURLOPT_URL, $url4); //Address to submit login
        $info4=json_decode(curl_exec($ch),true);

        if (PHP_VERSION_ID < 80000) curl_close($ch);//Close connection

        $this->usrname=$info["data"]["name"];
        $this->sign=$info["data"]["sign"];
        $this->isvip=$info["data"]["vip"]["status"];
        $this->level=$info["data"]["level"];
        $this->sex=$info["data"]["sex"];
        $this->advanter=substr($info["data"]["face"],stripos($info["data"]["face"],":")+1);
        $this->birthday= $info["data"]["birthday"];
        /*Get other information*/
        $this->play=$info2['data']['archive']['view'];
        $this->attation=$info3['data']['following'];
        $this->fans=$info3['data']['follower'];
        $this->spacepicture=substr($info4['data']['space']['l_img'],stripos( $info4['data']['space']['l_img'],":")+1);
        $this->archivecount=$info4['data']['archive_count'];

    }

    function getlive($id)
    {
        $url="https://api.vc.bilibili.com/dynamic_svr/v1/dynamic_svr/space_history?visitor_uid=$this->uid&host_uid=$this->uid&offset_dynamic_id=$id";
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
        $this->hangpicture=$info["data"]["cards"][0]['desc']['user_profile']['pendant']['image'];
        $this->hangpicture=substr($this->hangpicture,stripos($this->hangpicture,":")+1);
        $this->next_url=$info["data"]["cards"][9]['desc']['dynamic_id'];
        return $info["data"]["cards"];
    }






}