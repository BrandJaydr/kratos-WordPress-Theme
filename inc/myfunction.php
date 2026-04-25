<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
//Integrate QPlayer  into the theme
if(!is_plugin_active('QPlayer/QPlayer.php')) if(kratos_option('openmusicplug')) include ("QPlayer/QPlayer.php");
if(!is_plugin_active('tinymce-advanced/tinymce-advanced.php')) if(kratos_option('open_tinymce')) include ("tinymce-advanced/tinymce-advanced.php");
/*Integrated code beautification plugin*/
if(!is_plugin_active('enlighter/Enlighter.php')) if(kratos_option('open_enlighter')) include ("enlighter/Enlighter.php");

//Word count
function count_words ($text) {
    global $post;
    if ( '' == $text ) {
        $text = $post->post_content;
    }
    $text = html_entity_decode(strip_tags($text));
    $word_count = count(preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY));
    return $word_count . ' words&nbsp;&nbsp;';
}
//Filter specific category posts on homepage
function excludeCat($query) {
  if ( $query->is_home ) { //Filter specific categories on the homepage; you can specify other pages
    $query->set('cat', kratos_option('filter')); //Filter posts with category IDs 3, 5, 23
  }
  return $query;
}
add_filter('pre_get_posts', 'excludeCat');


function article_index($content) {
    $matches = array();
    $ul_li = '';
    $js='';//JS script
    $r = '/<h([2-3]).*?\>(.*?)<\/h[2-3]>/is';
    $i=0;
    if(is_single() && preg_match_all($r, $content, $matches)) {
        $onetitle=1;
        $towtitle=1;
        foreach($matches[1] as $key => $value) {
            $title = trim(strip_tags($matches[2][$key]));
            $content = str_replace($matches[0][$key], '<h' . $value . ' id="title-' . $key . '">'.$title.'</h'.$value.'>', $content);
            if($value==2)
            {
                $ul_li .= '<li id="go-'.$key.'" title="'.$title.'">'.$onetitle.":".$title."</li>\n";
                $towtitle=1;
                $onetitle++;
            }
            else
            {
                $ul_li .= '<li class="index-ul-li" id="go-'.$key.'" title="'.$title.'">'.($onetitle-1).".".$towtitle.':'.$title."</li>\n";
                $towtitle++;
            }

            $i++;
        }
        for($j=0;$j<$i;$j++)
        {
            $js.='document.querySelector("#go-'.$j.'").onclick = function(){
                    document.querySelector("#title-'.$j.'").scrollIntoView(true);
                };';
        }
        if($_COOKIE['goto_bibo']==1){
            $content = "<div id=\"article-index\"><div id=\"article-index-move\">Article TOC<a id=\"category-close\">[x]</a></div>
<ol id=\"index-ul\">" . $ul_li . "</ol>
</div>".'<script type="text/javascript">'.$js.'</script>'.$content;
        }else{
            $content = "<div class='wow shake' id=\"article-index\"><div id=\"article-index-move\">Article TOC<a id=\"category-close\">[x]</a></div>
<ol id=\"index-ul\">" . $ul_li . "</ol>
</div>".'<script type="text/javascript">'.$js.'</script>'.$content;
        }
    }
    return $content;
}
if(kratos_option('opencontent')) add_filter( 'the_content', 'article_index');

//Display random avatars
function local_random_avatar( $avatar, $id_or_email, $size, $default, $alt) {
    if (is_numeric($id_or_email) || (is_string($id_or_email) && strpos($id_or_email, '@'))) {
        return $avatar;
    }
    if (is_object($id_or_email) && (isset($id_or_email->user_id) && $id_or_email->user_id != 0)) {
        return $avatar;
    }
    if (is_object($id_or_email) && isset($id_or_email->comment_ID)) {
        $comment_ID = $id_or_email->comment_ID;
        $photo = get_comment_meta($comment_ID, 'photo', true);
        $hang = get_comment_meta($comment_ID, 'hang', true);
        $uid = get_comment_meta($comment_ID, 'uid', true);
        $level = get_comment_meta($comment_ID, 'level', true);
        if ($uid) {
            return '<div class="entry-header pull-left"><a bilibili="" href="//space.bilibili.com/'.$uid.'/dynamic" target="_blank" class="user-head c-pointer" style="background-image: url('.$photo.'); border-radius: 50%;" data-userinfo-popup-inited="true"><div data-v-4077d7b8="" class="user-decorator" style="background-image: url('.$hang.');"></div></a><a href="//www.bilibili.com/blackboard/help.html#Member level related" target="_blank" lvl="'.$level.'" class="h-level m-level"></a></div>';
        }
    }

    if (is_object($id_or_email) && !isset($id_or_email->comment_ID)) {
        return $avatar;
    }

    /*Below is the display of local random and custom avatars for anonymous comments*/
    if (kratos_option('random_avatar')) {
        $images = explode("\r\n", kratos_option('random_avatar'));
        $random = mt_rand(0, count($images) - 1);
        $avatar_url = $images[$random];
    } else {
        $imgs = getfilecouts(dirname(dirname(__FILE__)).'/static/images/avatar/*');
        if (empty($imgs)) return $avatar;
        $random = mt_rand(0, count($imgs) - 1);
        $avatar_url = get_bloginfo('template_url') . "/static/images/avatar/" . substr($imgs[$random], strripos($imgs[$random], '/') + 1);
    }
    return "<img alt='".esc_attr($alt)."' src='".esc_url($avatar_url)."' class='avatar avatar-".esc_attr($size)." photo' height='".esc_attr($size)."' width='".esc_attr($size)."'/><div style='position: absolute;'><a href='//www.bilibili.com/blackboard/help.html#Member level related' target='_blank' lvl='0' class='n-level m-level'></a></div>";
}
add_filter( 'get_avatar' , 'local_random_avatar' , 1 , 5 );

//Remove carriage returns and line breaks
function trimall($str){
    $qian=array(" ","　","\t","\n","\r");
    return str_replace($qian, '', $str);
}

//Custom excerpt display function
function showSummary($content)
{
    //First clear HTML comments and carriage returns/line breaks
    $content=strip_tags($content);
    //Check if the beginning is an information box
   if($content[0]=='[')
   {
       /*If so, return the content of the info box*/
       $content=substr($content,strpos($content,']')+1);
       $content=substr($content,0,strpos($content,'['));
       return $content;
   }
   else //If not an info box, then just truncate the characters
   {
       return wp_trim_words($content,kratos_option('w_num'));
   }
}

//Send email when publishing an article
function send_email($new,$old,$post)
{

    if($new=="publish" && ($old=="auto-draft" || $old=="draft") && $post->post_title!="")
    {
        $to=explode(",",esc_attr(get_option('email_list')));
        $subject = 'A blogger you follow has published a new article! φ(>ω<*)--'.$post->post_title;
        $permalink = get_permalink($post->ID);
        $message='
                    <style>.qmbox img.wp-smiley{width:auto!important;height:auto!important;max-height:8em!important;margin-top:-4px;display:inline}
</style>
            <div style="background:#ececec;width:100%;padding:50px 0;text-align:center">
                <div style="background:#fff;width:750px;text-align:left;position:relative;margin:0 auto;font-size:14px;line-height:1.5">
                    <div style="zoom:1;padding:25px 40px;background:#518bcb; border-bottom:1px solid #467ec3;">
                        <h1 style="color:#fff;font-size:25px;line-height:30px;margin:0"><a href="'.home_url().'" style="text-decoration:none;color:#FFF">'.get_bloginfo('name').'</a></h1>
                        <img style="position: relative;left: 423px;top:25px;" src="">
                        <h3 style="position: relative;color:#FFF;left: 263px;bottom: -25px;">(〃\'▽\'〃)A blogger you follow has an article update! ( • ̀ω•́ )✧--</h3>
                    </div>
                    <div style="padding:35px 40px 30px">
                        <h2 style="font-size:18px;margin:5px 0">Article Title: '.$post->post_title.'</h2>
                        <hr>
						<h3 style="font-size:18px;margin:5px 0">Excerpt: </h3>
                        <p style="color:#313131;line-height:20px;font-size:15px;margin:20px 0">'.showSummary($post->post_content).'</p>
						<h4><a href="'.$permalink.'">Click to view original</a></h4>
                        <br  />
                        <div style="font-size:13px;color:#a0a0a0;padding-top:10px">This email is automatically sent by the system. If you did not perform this action, please ignore this email.</div>
                        <div class="qmSysSign" style="padding-top:20px;font-size:12px;color:#a0a0a0">
                            <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0">'.get_bloginfo('name').'</p>
                            <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0"><span style="border-bottom:1px dashed #ccc" t="5" times="">'.date("Y-m-d",time()).'</span></p>
                        </div>
                    </div>
                </div>
            </div>
        ';
        $headers = 'Content-type: text/html';
        wp_mail($to,$subject,$message,$headers);
    }
}
//Open email subscription service to registered users
function open_email($user) {
    $content=esc_attr(get_option('email_list'));
    //Check if user is already subscribed
    if(strpos($content,$user->user_email)===false)
    {
        ?>
        <h3>Enable Email Subscription</h3>
        <input type="checkbox" name="openemail[]" />You will be notified when the webmaster publishes a new article!
        <?php
    }
    else
    {
        ?>
        <h3>Enable Email Subscription</h3>
        <input type="checkbox" name="openemail[]" checked="checked" />You will be notified when the webmaster publishes a new article!
        <?php
    }
}

//Add users to my list
function emaillist_add($email)
{
    $content=esc_attr(get_option('email_list'));
    if(strpos($content,$email)===false)
    {
        if(!$content)
            $content=$email;
        else
            $content=$content.','.$email;
        update_option('email_list',$content);
        return 1;
    }
    else
    {
        return 0;
    }
}
//Remove users from my list
function emaillist_remove($email)
{
    $content=esc_attr(get_option('email_list'));
    if(strpos($content,$email)===false)
    {
        return 0;
    }
    else
    {
        $pos = strpos($content, $email);
        if ($content[$pos - 1] == ',') {
            $content = str_replace(',' . $email, '', $content);
        } else {
            if ($content[$pos + strlen($email)] == ',')
                $content = str_replace($email . ',', '', $content);
            else
                $content = str_replace($email, '', $content);
        }
        update_option('email_list', $content);
        return 1;
    }
}

//Operations after update
function update_email_setting($id)
{
    //Determine if there is data submission
    if(!empty($_POST)) {
        //Get user email
        $user=get_userdata($id);
        if($_POST['openemail'])
           emaillist_add($user->user_email);
        else
            emaillist_remove($user->user_email);
    }
}
if(kratos_option('openpassage'))
{
    add_action('show_user_profile', 'open_email');
    add_action('personal_options_update', 'update_email_setting');
    add_action('transition_post_status','send_email',1,3);
}


//Get files in a folder and return as an array of filenames
function getfilecouts($url)
{
    $sl=array();//Create a variable, let it default to 0;
    $arr = glob($url);//Store all files under that path in an array;
    foreach ($arr as $v)//Loop through it, Put the array$arrassigned to$v;
    {
       if(is_file($v))//First use an if to check if the file in the folder is a file; it might be a folder;
        {
            array_push($sl,$v);

       }
    }
    return $sl;//After this method is completed, return a value$sl,this value is the number of all files under this path;
}


//Download file
function curlGet($url, $file)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $file_content = curl_exec($ch);
    if (PHP_VERSION_ID < 80000) curl_close($ch);
    $downloaded_file = fopen($file, 'w');
    fwrite($downloaded_file, $file_content);
    fclose($downloaded_file);
}

//Extract file
function unzip($fromName, $toName)
{
    if(!file_exists($fromName)){
        return FALSE;
    }
    $zipArc = new ZipArchive();
    if(!$zipArc->open($fromName)){
        return FALSE;
    }
    if(!$zipArc->extractTo($toName)){
        $zipArc->close();
        return FALSE;
    }
    return $zipArc->close();
}


//Delete file
function delFile($dirName,$delSelf=false){
    if(file_exists($dirName) && $handle = opendir($dirName)){
        while(false !==($item = readdir( $handle))){
            if($item != '.' && $item != '..'){
                if(file_exists($dirName.'/'.$item) && is_dir($dirName.'/'.$item)){
                    delFile($dirName.'/'.$item);
                }else{
                    if(!unlink($dirName.'/'.$item)){
                        return false;
                    }
                }
            }
        }
        closedir($handle);
        if($delSelf){
            if(!rmdir($dirName)){
                return false;
            }
        }
    }else{
        return false;
    }
    return true;
}



//Get hot articles
function most_hot_posts($days=30,$nums=5){
    global $wpdb;
    $today = date("Y-m-d H:i:s");
    $daysago = date("Y-m-d H:i:s",strtotime($today)-($days*24*60*60));
    $result = $wpdb->get_results("SELECT comment_count,ID,post_title,post_date FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' and post_type='post' and post_status='publish' ORDER BY comment_count DESC LIMIT 0 ,$nums");
    $output = '';
    if(empty($result)){
        $output = '<li>'.__('No data for now','moedog').'</li>';
    }else{
        foreach($result as $topten){
            $postid = $topten->ID;
            $title = $topten->post_title;
            $commentcount = $topten->comment_count;
            if($commentcount>=0){
                $output .= '<h4 class="title nowrap"><a class="list-group-item visible-lg" title="'.$title.'" href="'.get_permalink($postid).'" rel="bookmark">';
                $output .= strip_tags($title);
                $output .= '</a></h4>';
            }
        }
    }
    echo $output;
}
//
////Display relative paths site-wide and optimize sitemap
//add_filter( 'home_url', 'cx_remove_root' );
//function cx_remove_root( $url) {
//    if(!is_feed() && !get_query_var( 'sitemap') &&){
//        $url = preg_replace( '|^(https?:)?//[^/]+(/?.*)|i', '$2', $url );
//        return '/' . ltrim( $url, '/' );
//    }else{
//        return $url;
//    }
//}


/*Bilibili UID comment function*/
//Store data
add_action('wp_insert_comment','wp_insert_weibo',10,2);
function wp_insert_weibo($comment_ID,$commmentdata) {
    $uid= isset($_POST['uid']) ? $_POST['uid'] : false;
//    $nickname= isset($_REQUEST['nickname']) ? $_REQUEST['nickname'] : "Anonymous";
    $bilibiliphoto= isset($_REQUEST['photo']) ? $_REQUEST['photo'] : "";
    $avatarshang= isset($_REQUEST['hang']) ? $_REQUEST['hang'] : "";
    $level= isset($_REQUEST['level']) ? $_REQUEST['level'] : "0";
    update_comment_meta($comment_ID,'uid',$uid);
//    update_comment_meta($comment_ID,'nickname',$nickname);
    update_comment_meta($comment_ID,'photo',$bilibiliphoto);
    update_comment_meta($comment_ID,'hang',$avatarshang);
    update_comment_meta($comment_ID,'level',$level);
}
//Show UID in background
add_filter( 'manage_edit-comments_columns', 'my_comments_columns' );
add_action( 'manage_comments_custom_column', 'output_my_comments_columns', 10, 2 );
function my_comments_columns( $columns ){
    $columns[ 'uid' ] = __( 'uid' );        //UID represents the column name
//    $columns[ 'nickname' ] = __( 'Nickname' );
    $columns[ 'photo' ] = __( 'Photo Address' );
    $columns[ 'hang' ] = __( 'Avatar Pendant' );
    $columns[ 'level' ] = __( 'Level' );
    return $columns;
}
function output_my_comments_columns( $column_name, $comment_id ){
    switch( $column_name ) {
        case "uid" :
            echo esc_html( get_comment_meta( $comment_id, 'uid', true ) );
            break;
//        case "nickname" :
//            echo esc_html( get_comment_meta( $comment_id, 'nickname', true ) );
//            break;
        case "photo" :
            echo esc_html( get_comment_meta( $comment_id, 'photo', true ) );
            break;
        case "hang" :
            echo esc_html( get_comment_meta( $comment_id, 'hang', true ) );
            break;
        case "level" :
            echo esc_html( get_comment_meta( $comment_id, 'level', true ) );
            break;
    }
}

//Colored Tag Cloud
function colorCloud($text) {
    $text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
    $text=preg_replace('/<a /','<a ',$text);
    return $text;
}
function colorCloudCallback($matches) {
    $text = $matches[1];
//Define the range of our background colors here...
//$color = dechex(rand(0,16777215));randomly pick one from all colors
    $a = array('8D7EEA','F99FB2','AEE05B','E8D368','F75D78','55DCAB','F75DB1','ABABAF','7EA8EA');
    $co = array_rand($a,2);
    $color = $a[$co[0]];
//Random color code ends, now assign colors to each tag to generate background colors
    $pattern = '/style=(\'|\")(.*)(\'|\")/i';
    $text = preg_replace($pattern, "style=\"background:#{$color};\"", $text);
    return "<a $text>";
}
//Hook PHP code onto the wp_tag_cloud hook
add_filter('wp_tag_cloud', 'colorCloud', 1);



//Enable page comment function
function open_comments_for_pages( $status, $post_type, $comment_type ) {
    if ( 'page' === $post_type ) {
        $status = 'open';
    }
    return $status;
}
add_filter('get_default_comment_status', 'open_comments_for_pages', 10, 3 );



//Register jQuery plugin to avoid some plugins being unusable
function wpjam_add_scripts() {
    wp_register_script('jquery','',array(),'1.1', true);
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'wpjam_add_scripts' );

?>