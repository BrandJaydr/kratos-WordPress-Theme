<?php
function success($atts,$content=null,$code=""){
    $return = '<div class="alert alert-success">';
    $return .= do_shortcode($content);
    $return .= '</div>';
    return $return;
}
add_shortcode('success','success');
function info($atts,$content=null,$code=""){
    $return = '<div class="alert alert-info">';
    $return .= do_shortcode($content);
    $return .= '</div>';
    return $return;
}
add_shortcode('info','info');

function danger($atts,$content=null,$code=""){
    $return = '<div class="alert alert-danger">';
    $return .= do_shortcode($content);
    $return .= '</div>';
    return $return;
}
add_shortcode('danger','danger');
function wymusic($atts,$content=null,$code=""){
    extract(shortcode_atts(array("autoplay"=>'0'),$atts));
    $return = '<iframe style="width:100%" frameborder="no" border="0" marginwidth="0" marginheight="0" height="86" src="https://music.163.com/outchain/player?type=2&id=';
    $return .= $content;
    $return .= '&auto='.$autoplay.'&height=66"></iframe>';
    return $return;
}
add_shortcode('music','wymusic');

function ypbtn($atts,$content=null,$code=""){
    $return = '<a class="downbtn downcloud" href="';
    $return .= $content;
    $return .= '" target="_blank"><i class="fa fa-cloud-download"></i>Cloud Download</a>';
    return $return;
}
add_shortcode('ypbtn','ypbtn');
function nrtitle($atts,$content=null,$code=""){
    $return = '<h2 class="title-h2">';
    $return .= $content;
    $return .= '</h2>';
    return $return;
}
add_shortcode('title','nrtitle');


function striped($atts,$content=null,$code=""){
    $return = '<div class="progress progress-striped active"><div class="progress-bar" style="width: ';
    $return .= $content;
    $return .= '%;"></div></div>';
    return $return;
}
add_shortcode('striped','striped');
function xcollapse($atts,$content=null,$code=""){
    extract(shortcode_atts(array("title"=>'Title Content'),$atts));
    $return = '<div class="xControl"><div class="xHeading"><div class="xIcon"><i class="fa fa-plus"></i></div><h5>';
    $return .= $title;
    $return .= '</h5></div><div class="xContent"><div class="inner">';
    $return .= do_shortcode($content);
    $return .= '</div></div></div>';
    return $return;
}
add_shortcode('collapse','xcollapse');


function hide($atts,$content=null,$code=""){
    extract(shortcode_atts(array("reply_to_this"=>'true'),$atts));
    global $current_user;
    get_currentuserinfo();
    if($current_user->ID) $email = $current_user->user_email;
    if($reply_to_this=='true'){
        if($email){
            global $wpdb;
            global $id;
            $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_author_email = '".$email."' and comment_post_id='".$id."'and comment_approved = '1'");
        }
        if(!$comments) $content = '<div class="hide_notice">'.sprintf('Sorry, you must <a href="%s" rel="nofollow">Login</a> and comment on this post to read the hidden content',wp_login_url(get_permalink())).'</div>';
    }else{
        if($email){
            global $wpdb;
            global $id;
            $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_author_email = '".$email."' and comment_approved = '1'");
        }
        if(!$comments) $content = '<div class="hide_notice">'.sprintf('Sorry, you must <a href="%s" rel="nofollow">Login</a> and comment on any post on this site to read the hidden content',wp_login_url(get_permalink())).'</div>';
    }
    if($comments) $content = '<div class="unhide"><div class="info">The following is hidden content:</div>'.$content.'</div>';
    return $content;
}
add_shortcode('hide','hide');
function successbox($atts,$content=null,$code=""){
    extract(shortcode_atts(array("title"=>'Title Content'),$atts));
    $return = '<div class="panel panel-success"><div class="panel-heading"><h3 class="panel-title">';
    $return .= $title;
    $return .= '</h3></div><div class="panel-body">';
    $return .= do_shortcode($content);
    $return .= '</div></div>';
    return $return;
}
add_shortcode('successbox','successbox');
function infobox($atts,$content=null,$code=""){
    extract(shortcode_atts(array("title"=>'Title Content'),$atts));
    $return = '<div class="panel panel-info"><div class="panel-heading"><h3 class="panel-title">';
    $return .= $title;
    $return .= '</h3></div><div class="panel-body">';
    $return .= do_shortcode($content);
    $return .= '</div></div>';
    return $return;
}
add_shortcode('infobox','infobox');

function highlight($atts,$content=null,$code=""){
    extract(shortcode_atts(array("lanaguage"=>'language'),$atts));
    $return = '<pre class="line-numbers"><code class="language-';
    $return .= $lanaguage;
    $return .= '">';
    //Processpre-formattedContent
    $replace=array('<pre>','</pre>','<code>','</code>');
    $content=str_replace($replace,'',$content);
    //Process<and>display issues
    $content=str_replace('<','&lt;',$content);
    $content=str_replace('>','&gt;',$content);
    $return .=trim($content);
    $return .= '</code></pre>';
    return $return;
}
add_shortcode('highlight','highlight');


function block($atts,$content=null,$code=""){
    $return = '<pre class="hl"><code class="">';
    //Processpre-formattedContent
    $replace=array('<pre>','</pre>','<code>','</code>');
    $content=str_replace($replace,'',$content);
    //Process<and>display issues
    $content=str_replace('<','&lt;',$content);
    $content=str_replace('>','&gt;',$content);
    $return .=trim($content);
    $return .= '</code></pre>';
    return $return;
}
add_shortcode('block','block');



function dangerbox($atts,$content=null,$code=""){
    extract(shortcode_atts(array("title"=>'Title Content'),$atts));
    $return = '<div class="panel panel-danger"><div class="panel-heading"><h3 class="panel-title">';
    $return .= $title;
    $return .= '</h3></div><div class="panel-body">';
    $return .= do_shortcode($content);
    $return .= '</div></div>';
    return $return;
}
add_shortcode('dangerbox','dangerbox');

function wxmusic($atts,$content=null,$code=""){
    extract(shortcode_atts(array("url"=>'address'),$atts));
    extract(shortcode_atts(array("author"=>'author'),$atts));
    extract(shortcode_atts(array("title"=>'title'),$atts));
    $return = '<p class="weixinAudio"><audio src="';
    $return .=$url;
    $return .='" id="media" width="1" height="1" preload=""></audio><span id="audio_area" class="db audio_area"><span class="audio_wrp db"><span class="audio_play_area"><i class="icon_audio_default"></i><i class="icon_audio_playing"></i></span><span id="audio_length" class="audio_length tips_global">3:07</span><span class="db audio_info_area"><strong class="db audio_title">';
    $return .=$title;
    $return .='</strong><span class="audio_source tips_global">';
    $return .=$author;
    $return .='</span></span><span id="audio_progress" class="progress_bar" style="width: 0%;"></span></span></span></p>';
    return $return;
}
add_shortcode('wxmusic','wxmusic');



function soundcloud_shortcode($atts, $content = null, $code = "") {
    extract(shortcode_atts(array(
        "width" => '100%',
        "height" => '166',
        "auto_play" => 'false',
        "hide_related" => 'false',
        "show_comments" => 'true',
        "show_user" => 'true',
        "show_reposts" => 'false',
        "show_teaser" => 'true',
        "color" => '#ff5500'
    ), $atts));

    $content = trim($content);
    // If it's a full URL, we use the oEmbed-style iframe src
    $src = "https://w.soundcloud.com/player/?url=" . urlencode($content) . "&color=" . str_replace('#', '', $color) . "&auto_play=" . $auto_play . "&hide_related=" . $hide_related . "&show_comments=" . $show_comments . "&show_user=" . $show_user . "&show_reposts=" . $show_reposts . "&show_teaser=" . $show_teaser;

    return '<div class="soundcloud-container"><iframe width="' . $width . '" height="' . $height . '" scrolling="no" frameborder="no" allow="autoplay" src="' . $src . '"></iframe></div>';
}
add_shortcode('soundcloud', 'soundcloud_shortcode');

function video_shortcode($atts,$content=null,$code=""){
    extract(shortcode_atts(array(
        "site" => 'auto',
        "cid" => '0',
        "page" => '1',
        "width" => '100%',
        "height" => '498'
    ), $atts));

    $content = trim($content);
    $video_url = '';

    if ($site == 'auto') {
        if (strpos($content, 'youtube.com') !== false || strpos($content, 'youtu.be') !== false) {
            $site = 'youtube';
        } elseif (strpos($content, 'vimeo.com') !== false) {
            $site = 'vimeo';
        } elseif (strpos($content, 'bilibili.com') !== false || is_numeric($content)) {
            $site = 'bilibili';
        }
    }

    switch ($site) {
        case 'youtube':
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $content, $match)) {
                $id = $match[1];
            } else {
                $id = $content;
            }
            $video_url = 'https://www.youtube.com/embed/' . $id;
            break;
        case 'vimeo':
            if (preg_match('%vimeo\.com/(?:video/)?([0-9]+)%i', $content, $match)) {
                $id = $match[1];
            } else {
                $id = $content;
            }
            $video_url = 'https://player.vimeo.com/video/' . $id;
            break;
        case 'bilibili':
        default:
            $id = $content;
            if (preg_match('%bilibili\.com/video/av([0-9]+)%i', $content, $match)) {
                $id = $match[1];
            }
            $video_url = '//player.bilibili.com/player.html?aid=' . $id . '&cid=' . $cid . '&page=' . $page;
            break;
    }

    return '<div class="video-container"><iframe src="' . $video_url . '" allowtransparency="true" width="' . $width . '" height="' . $height . '" scrolling="no" frameborder="0" allowfullscreen></iframe></div>';
}
add_shortcode('video','video_shortcode');
add_shortcode('bilibili','video_shortcode');

add_action('init','more_button_a');
function more_button_a(){
    if(!current_user_can('edit_posts')&&!current_user_can('edit_pages')) return;
    if(get_user_option('rich_editing')=='true'){
        add_filter('mce_external_plugins','add_plugin');
        add_filter('mce_buttons','register_button');
    }
}
add_action('init','more_button_b');
function more_button_b(){
    if(!current_user_can('edit_posts')&&!current_user_can('edit_pages')) return;
    if(get_user_option('rich_editing')=='true'){
        add_filter('mce_external_plugins','add_plugin_b');
        add_filter('mce_buttons_3','register_button_b');
    }
}
function register_button($buttons){
    array_push($buttons," ","title");
    array_push($buttons," ","highlight");
    array_push($buttons," ","block");
    array_push($buttons," ","accordion");
    array_push($buttons," ","hide");
    array_push($buttons," ","striped");
    array_push($buttons," ","ypbtn");
    array_push($buttons," ","music");
    array_push($buttons," ","soundcloud");
    array_push($buttons," ","video");
    array_push($buttons," ","wxmusic");
    return $buttons;
}
function register_button_b($buttons){
    array_push($buttons," ","success");
    array_push($buttons," ","info");
    array_push($buttons," ","danger");
    array_push($buttons," ","successbox");
    array_push($buttons," ","infoboxs");
    array_push($buttons," ","dangerbox");
    return $buttons;
}
function add_plugin($plugin_array){
    $plugin_array['title'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['highlight'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['block'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['accordion'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['hide'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['striped'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['ypbtn'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['music'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['soundcloud'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['video'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['wxmusic'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    return $plugin_array;
}
function add_plugin_b($plugin_array){
    $plugin_array['success'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['info'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['danger'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['successbox'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['infoboxs'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    $plugin_array['dangerbox'] = get_bloginfo('template_url').'/inc/buttons/more.js';
    return $plugin_array;
}
function add_more_buttons($buttons){
    $buttons[] = 'hr';
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'styleselect';
    return $buttons;
}
add_filter("mce_buttons_2","add_more_buttons");

//Display Emojis
function fa_get_wpsmiliestrans(){
    global $wpsmiliestrans;
    $wpsmilies = array_unique($wpsmiliestrans);
    if(kratos_option('owo_out')) $owodir = bloginfo('template_url'); else $owodir = get_bloginfo('template_directory');
    foreach($wpsmilies as $alt => $src_path){
        $src_path=$owodir.'/static/images/smilies/'.$src_path;
        $output .= '<a class="add-smily" data-smilies="<img src=\''. $src_path.'\'>"><img src="'.$src_path.'"></a>';
    }
    return $output;
}
//Add Emoji
add_action('media_buttons_context','fa_smilies_custom_button');
function fa_smilies_custom_button($context){
    $context .= '<style>.smilies-wrap{background:#fff;border: 1px solid #ccc;box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.24);padding: 10px;position: absolute;top: 60px;width: 380px;display:none}.smilies-wrap img{height:24px;width:24px;cursor:pointer;margin-bottom:5px} .is-active.smilies-wrap{display:block}</style><a id="REPLACE-media-button" style="position:relative" class="button REPLACE-smilies add_smilies" title="Add Emoji" data-editor="content" href="javascript:;">Add Emoji</a><div class="smilies-wrap">'. fa_get_wpsmiliestrans() .'</div><script>jQuery(document).ready(function(){jQuery(document).on("click", ".REPLACE-smilies",function() { if(jQuery(".smilies-wrap").hasClass("is-active")){jQuery(".smilies-wrap").removeClass("is-active");}else{jQuery(".smilies-wrap").addClass("is-active");}});jQuery(document).on("click", ".add-smily",function() { send_to_editor(" " + jQuery(this).data("smilies") + " ");jQuery(".smilies-wrap").removeClass("is-active");return false;});});</script>';
    return $context;
}
function appthemes_add_quicktags(){ ?>
    <script type="text/javascript">
        try{
            QTags.addButton( 'pre', 'pre', '<pre>\n', '\n</pre>' );
            QTags.addButton( 'hr', 'hr', '\n\n<hr />\n\n', '' );
            QTags.addButton( 'Code Highlight ', 'Code Highlight ', '[highlight lanaguage="language"]', '[/highlight]' );
            QTags.addButton( 'Contenttitle ', 'Contenttitle ', '[title]', '[/title]' );
            QTags.addButton( 'Blue Font ', 'Blue Font ', '<span style="color: #0000ff;">', '</span>' );
            QTags.addButton( ' Red Font ', 'Red Font ', '<span style="color: #ff0000;">', '</span>' );
            QTags.addButton( 'Expand/Collapse ', 'Expand/Collapse ', '[collapse title="Title Content "]', '[/collapse]' );
            QTags.addButton( 'Reply to View ', 'Reply to View ', '[hide reply_to_this="true"]', '[/hide]' );
            QTags.addButton( 'Cloud Download ', 'Cloud Download ', '[ypbtn]', '[/ypbtn]' );
            QTags.addButton( 'Netease Cloud Music ', 'Netease Cloud Music ', '[music autoplay="0"]', '[/music]' );
            QTags.addButton( 'SoundCloud ', 'SoundCloud ', '[soundcloud]', '[/soundcloud]' );
            QTags.addButton( 'Green Background Bar ', 'Green Background Bar ', '[success]', '[/success]' );
            QTags.addButton( 'Blue Background Bar ', 'Blue Background Bar ', '[info]', '[/info]' );
            QTags.addButton( 'Red Background Bar ', 'Red Background Bar ', '[danger]', '[/danger]' );
            QTags.addButton( 'Green Panel ', 'Green Panel ', '[successbox title="Title Content "]', '[/successbox]' );
            QTags.addButton( 'Blue Panel ', 'Blue Panel ', '[infobox title="Title Content "]', '[/infobox]' );
            QTags.addButton( 'Red Panel ', 'Red Panel ', '[dangerbox title="Title Content "]', '[/dangerbox]' );
        }catch(err){}
    </script>
    <?php
}
add_action('admin_print_footer_scripts', 'appthemes_add_quicktags');