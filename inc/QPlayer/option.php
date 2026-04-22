<?php 

function QPlayer_add_jquery() {
    if ( !is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', QPlayer_URL.'/js/jquery.min.js','' ,'2.2.1', true);
        wp_enqueue_script('jquery');  
    }
}

/**
 * Get song information from Netease
 * 
 * @link https://github.com/webjyh/WP-Player/blob/master/include/player.php
 * @param unknown $id 
 * @param unknown $type Type of the acquired ID: song, album, artist, collect (playlist)
 */

function get_netease_music($id, $type = 'song'){
    $return = false;
    switch ( $type ) {
        case 'song': $url = "https://music.163.com/api/song/detail/?ids=[$id]"; $key = 'songs'; break;
        case 'album': $url = "https://music.163.com/api/album/$id?id=$id"; $key = 'album'; break;
        case 'artist': $url = "https://music.163.com/api/artist/$id?id=$id"; $key = 'artist'; break;
        case 'collect': $url = "https://music.163.com/api/playlist/detail?id=$id"; $key = 'result'; break;
        default: $url = "https://music.163.com/api/song/detail/?ids=[$id]"; $key = 'songs';
    }
    if (!function_exists('curl_init')) return false;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //Send request headers
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.90 Safari/537.36",
        "Referer: https://music.163.com/",
        "cookie:player1.0"
    ));
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $cexecute = curl_exec($ch);
    if (PHP_VERSION_ID < 80000) curl_close($ch);
    if ( $cexecute ) {
        $result = json_decode($cexecute, true);
        if ( $result['code'] == 200 && $result[$key] ){

            switch ( $key ){
                case 'songs' : $data = $result[$key]; break;
                case 'album' : $data = $result[$key]['songs']; break;
                case 'artist' : $data = $result['hotSongs']; break;
                case 'result' : $data = $result[$key]['tracks']; break;
                default : $data = $result[$key]; break;
            }

            //List
            $list = array();
            foreach ( $data as $keys => $data ){

                $list[$data['id']] = array(
                        'title' => $data['name'],
                        'artist' => $data['artists'][0]['name'],
                        'location' => "https://music.163.com/song/media/outer/url?id=".$data['id'].".mp3",
                        'pic' =>str_replace("http://","https://",$data['album']['blurPicUrl']) .'?param=106x106'
                );
            }
            //Fix the out-of-order issue when adding multiple IDs at once
            if ($type = 'song' && strpos($id, ',')) {
                $ids = explode(',', $id);
                $r = array();
                foreach ($ids as $v) {
                    if (!empty($list[$v])) {
                        $r[] = $list[$v];
                    }
                }
                $list = $r;
            }
            //Final playbackList
            $return = $list;
        }
    } else {
        $return = array('status' =>  false, 'message' =>  'Illegal request');
    }
    return $return;
}


function parse($id, $type) {
    $resultList = explode(",", $id);
    $result="\n";
    foreach ($resultList as $key => $value) {
        $musicList = get_netease_music($value,$type);
        foreach($musicList as $x=>$x_value) {
            $result .= "{";
            foreach ($x_value as $key => $value) {
                if ($key == 'location') {
                    $key = 'mp3';
                }
                if ($key == 'pic') {
                    $key = 'cover';
                }
                if (strpos($value, '"') !== false) {
                    $value = addcslashes($value, '"');
                }
                $result .= "$key:\"". $value."\",";
            }
            $result .= "},\n";
        }
    }
    return $result;
}


function QPlayer_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    } 
    if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD']=='POST'){
        check_admin_referer('qplayer_options_update', 'qplayer_nonce');
        update_option('autoPlay', sanitize_text_field($_POST['autoPlay']));
        update_option('rotate', sanitize_text_field($_POST['rotate']));
        update_option('random', sanitize_text_field($_POST['random']));
        update_option('color', sanitize_text_field($_POST['color']));
        update_option('css', stripcslashes(sanitize_text_field($_POST['css'])));
        update_option('js', stripcslashes(sanitize_text_field($_POST['js'])));
        update_option('musicType', sanitize_text_field($_POST['musicType']));
        update_option('neteaseID', sanitize_text_field($_POST['neteaseID']));
        update_option('musicList',stripcslashes(sanitize_text_field($_POST['musicList'])));
        echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
<p><strong>Settings saved.</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Ignore this notification.</span></button></div>';
    } 
    if (isset($_POST['addMusic']) && $_SERVER['REQUEST_METHOD']=='POST') {
        check_admin_referer('qplayer_options_update', 'qplayer_nonce');
    	update_option('musicType',sanitize_text_field($_POST['musicType']));
        update_option('neteaseID',sanitize_text_field($_POST['neteaseID']));
    	$musicResult = parse(get_option('neteaseID'), get_option('musicType'));
    	$deal = get_option('musicList');
    	if ($deal != '' && substr(trim($deal), -1) != ','){
    		$deal .= ',';
    	}
    	update_option('musicList', $deal.$musicResult);
    	echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
<p><strong>Music added to musicList. </strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Ignore this notification.</span></button></div>';
    }
?>
    <style>
        body {
        	font-family: 'Merriweather','Open Sans',"PingFang SC",'Hiragino Sans GB','Microsoft Yahei','WenQuanYi Micro Hei','Segoe UI Emoji','Segoe UI Symbol',Helvetica,Arial,sans-serif;
        }
    	.title {
    		font-size: 15px;
    		font-weight:bold;
    		margin-bottom: 5px;
    	}
    	.tip,#addMusic {
    		margin-top: 0;
    	}
    	#addMusic, #submit{
    		font-weight: 500;
            font-size: 13px;
            font-family: "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            border-radius: 10px;
            background-color: #1b9af7;
            border-color: #4cb0f9;
            color: #FFF;
            border:0;
            padding: 6px 13px;
            outline:none;
    	}
    	#addMusic:hover, #submit:hover {
            background-color: #4cb0f9;
            cursor:pointer;
        }
        #inputID{
            width:300px;
        }
    </style>
    <div class="QPlayer">  
      <h1>QPlayer Settings</h1><br>
        <form method="post">  
			<div><div class="title">Auto Play</div>
			  <input type="radio" name="autoPlay" value="0" <?php if (!get_option('autoPlay')) echo "checked";?>>No
			  <input type="radio" name="autoPlay" value="1" <?php if (get_option('autoPlay')) echo "checked";?>>Yes
			</div><br>
			<div><div class="title">Cover Rotation</div>
			  <input type="radio" name="rotate" value="0" <?php if (!get_option('rotate')) echo "checked";?>>No
			  <input type="radio" name="rotate" value="1" <?php if (get_option('rotate')) echo "checked";?>>Yes
			</div><br>
            <div><div class="title">Enable Shuffle</div>
                <input type="radio" name="random" value="0" <?php if (!get_option('random')) echo "checked";?>>No
                <input type="radio" name="random" value="1" <?php if (get_option('random')) echo "checked";?>>Yes
            </div><br>
			<div><div class="title">Custom Main Color</div>
			  <input type="text" name="color" value="<?php echo get_option('color'); ?>">
			  <p class="tip">Default is <span style="color: #1abc9c;">#1abc9c</span>, You can customize any color you like as the main color of the player. Custom Main ColorSupportcss settings format, e.g.: `#233333`,"rgb(255,255,255)","rgba(255,255,255,1)","hsl(0, 0%, 100%)","hsla(0, 0%, 100%,1)". Filling in other incorrect formats may not take effect.</p>
			</div><br>
			<div><div class="title">Custom CSS</div>
			  <textarea rows="6" cols="100" name="css"><?php echo get_option('css') ?></textarea>
			</div><br>
			<div><div class="title">Custom JS</div>
			  <textarea rows="6" cols="100" name="js"><?php echo get_option('js') ?></textarea>
			</div><br>
            <div class="title">Add Netease Music (Requires host to support curl extension)</div>
            <div>ID Type
                <input type="radio" name="musicType"  value="collect"  <?php if (get_option('musicType') == 'collect') echo "checked";?>>Playlist
                <input type="radio" name="musicType" value="album" <?php if (get_option('musicType') == 'album') echo "checked";?>>Album
                <input type="radio" name="musicType" value="artist" <?php if (get_option('musicType') == 'artist') echo "checked";?>>Artist
                <input type="radio" name="musicType" value="song" <?php if (get_option('musicType') == 'song') echo "checked";?>>Song
            </div>
            <div>ID Input
                <input type="text" id="inputID" onclick="clickAnimation()" placeholder="Multiple IDs separated by English commas" name="neteaseID" value="<?php echo get_option('neteaseID') ?>">
                <p class="tip" style="margin-bottom: 0;">Please go to the Netease Music web version to get the music ID (specifically, there will be an ID at the end of the URL of each music item). Copyrighted music cannot be parsed!</p>
            </div>
			<input type="submit" name="addMusic" id="addMusic" value="Add to songList"  /><br><br>
			<div><div class="title">songList</div>
			  <textarea rows="8" cols="100" name="musicList"><?php echo get_option('musicList') ?></textarea>
			  <p class="tip">format: {title:"xxx", artist:"xxx", cover:"http:xxxx", mp3:"http:xxxx"} , Eachsongbetween use English,separated. Please ensuresongList contains at least one song! </p>
			</div>
			<input type="submit" name="submit" id="submit" value="<?php _e('Save Changes') ?>"  />  
            </p>  
        </form>  
    </div>
<?php
}
?>