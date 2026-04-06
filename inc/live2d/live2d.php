<?php
/*
Plugin Name: Live2D Model Settings
Description: Used to set up the Live2D model
*/


define('FILE_PATH', dirname(__FILE__));

//Get JS File Content
function getjs()
{
    try{
        //Read File Content
        $js=fopen(FILE_PATH.'/waifu-tips.js','r') or die("Unable to open file");
        $content=fread($js,filesize(FILE_PATH.'/waifu-tips.js'));
        fclose($js);
        return $content;
    }catch (Exception $e)
    {
        return "It seems there is a problem, the JS content could not be retrieved. Please check if PHP has read/write permissions for this file!";
    }
}

//Save JS File Content
function savejs($content)
{
    $content=stripslashes($content);//Character unescaping
    try{
        //Read File Content
        $js=fopen(FILE_PATH.'/waifu-tips.js','w') or die(0);
        fwrite($js,$content);
        fclose($js);
        return 1;
    }catch (Exception $e)
    {
        return 0;
    }

}

//Download Image
function downloadimg($url,$imgpath)
{
    curlGet($url, $imgpath.'1.zip');//Download
    unzip($imgpath.'1.zip',$imgpath);//Extract
    unlink($imgpath.'1.zip');//Delete
}

//Live2D Model Settings Interface
function live2d_option_page() {
    //Determine if there is data submission
    if(!empty($_POST)) {
        //Live2D Settings
        if(!empty($_POST['live2d-setting'])) {
            if (savejs($_POST['live2d-setting'])) {
                ?>
                <div id="message" class="updated">
                    <p><strong>Data saved (clear cache for settings to take effect)</strong></p>
                </div>
                <?php
            } else {
                ?>
                <div id="message" class="updated">
                    <p><strong>Failed to save data</strong></p>
                </div>
                <?php
            }
        }
        //Email Subscription Settings
        if(!empty($_POST['email_list'])) {
            if(emaillist_add($_POST['email_list'])==1) {
                ?>
                <div id="message" class="updated">
                    <p><strong>Record added successfully</strong></p>
                </div>
                <?php
            }
            else
            {
                 ?>
                 <div id="message" class="updated">
                     <p><strong>Record already exists</strong></p>
                 </div>
                 <?php
            }
        }
        //Delete Subscribed User
        if(!empty($_POST['delete']))
        {
            if(emaillist_remove($_POST['delete'])==0)
            {
                ?>
                <div id="message" class="updated">
                    <p><strong>Subscriber not found</strong></p>
                </div>
                <?php
            }
            else
            {
                ?>
                <div id="message" class="updated">
                    <p><strong>Subscriber removed from list</strong></p>
                </div>
                <?php
            }
        }
        //Download Image resources
        if($_POST['download']) {
            $imgpath=dirname(dirname(dirname(__FILE__))).'/static/images/thumb/';
            $filelist=getfilecouts($imgpath.'*');
            if($_POST['donman'] || $_POST['bilibili'])
            {
                foreach ($filelist as $filename)
                {
                    unlink($filename);
                }
            }
            //Delete all images in the directory
            if($_POST['donman']) {
                //Batch delete images
                downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/thumb.zip',$imgpath)
                ?>
                <div id="message" class="updated">
                    <p><strong>Anime image resources downloaded. Success is not guaranteed; please refresh the homepage to check.</strong></p>
                </div>
                <?php
            }
            if($_POST['bilibili']) {
                downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/bilibili.zip',$imgpath);
                ?>
                <div id="message" class="updated">
                    <p><strong>Bilibili image resources downloaded. Success is not guaranteed; please refresh the homepage to check.</strong></p>
                </div>
                <?php
            }
            //Live2D Settings
            $blogpath=$_SERVER['DOCUMENT_ROOT'] ;
        }
        /*Download Avatar*/
        if($_POST['downloadavatar']) {
            $imgpath=dirname(dirname(dirname(__FILE__))).'/static/images/avatar/';
            $filelist=getfilecouts($imgpath.'*');
            if($_POST['man'] || $_POST['woman'])
            {
                foreach ($filelist as $filename)
                {
                    unlink($filename);
                }
            }
            //Delete all images in the directory
            if($_POST['man']) {
                //Batch delete images
                downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/avatarman.zip',$imgpath)
                ?>
                <div id="message" class="updated">
                    <p><strong>Anime male avatars downloaded. Success is not guaranteed; please refresh the homepage to check.</strong></p>
                </div>
                <?php
            }
            if($_POST['woman']) {
                downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/avatarwoman.zip',$imgpath);
                ?>
                <div id="message" class="updated">
                    <p><strong>Anime female avatars downloaded. Success is not guaranteed; please refresh the homepage to check.</strong></p>
                </div>
                <?php
            }
        }
        if($_POST['downlive2d']) {
            downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/live2d.zip',$_SERVER['DOCUMENT_ROOT'].'/');
            ?>
            <div id="message" class="updated">
                <p><strong>Live2D resources downloaded. Success is not guaranteed; please check yourself.</strong></p>
            </div>
            <?php
        }
        /*Emoji Pack Download*/
        if($_POST['downloadsmilies'])
        {
            $smilepath=dirname(dirname(dirname(__FILE__))).'/static/images/smilies/';
            $owo=dirname(dirname(__FILE__))."/OwO.json";
            if(!file_exists($smilepath."tieba/")) downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/smile.zip', $smilepath);
            $url="";
            if($_POST['tieba']) $url.="1";
            if($_POST['face'])  $url?$url.=",2":$url.="2";
            if($_POST['zhihu']) $url?$url.=",3":$url.="3";
            if($_POST['bilibili']) $url?$url.=",4":$url.="4";
            if($_POST['tv']) $url?$url.=",5":$url.="5";
            if(file_exists($owo)) unlink($owo);
            curlGet("http://api.xiaoyou66.com/theme/OwO/?id=".$url,$owo);
            ?>
            <div id="message" class="updated">
                <p><strong>Emoji pack downloaded. Success is not guaranteed; please check yourself.</strong></p>
            </div>
            <?php
        }
        /*Friend link review processing*/
        /*Approve Application*/
        if($_POST['approve']){
            global $wpdb;
            //Get Database Prefix
            global $table_prefix;
            $data=[];
            $data['link_name']=$_POST['name'];
            $data['link_url']=$_POST['web'];
            $data['link_description']=$_POST['introduce'];
            $data['link_image']=$_POST['avater'];
//    $wpdb->insert($table_name, array('album' => "$_POST['album']", 'artist' => "$_POST['artist']"));
            //Insert friend link data into the database
            $wpdb->insert($table_prefix.'links',$data);
            //Delete This Content
            $delete=$_POST['aselect']."]!!";
            update_option('application_list',str_replace($delete,"",esc_attr(get_option('application_list'))));
            //Send email notification to applicant
            $to=$_POST['mail'];
            $subject = 'Friend Link Application Approved!';
            $message='Hello, your friend link application has been approved! <br> -------- <br> This email is automatically sent by the system; if you do not know what it is about, you can ignore it.';
            $headers = 'Content-type: text/html';
            wp_mail($to,$subject,$message,$headers);
            ?>
            <div id="message" class="updated">
                <p><strong>Added successfully</strong></p>
            </div>
            <?php
        }
        /*Delete Application*/
        if($_POST['adelete']) {
            //First Get Content to be Deleted
            $delete=$_POST['aselect']."]!!";
            update_option('application_list',str_replace($delete,"",esc_attr(get_option('application_list'))));
            ?>
            <div id="message" class="updated">
                <p><strong>Application deleted</strong></p>
            </div>
            <?php
        }

    }
    ?>
    <style>
        .title{margin-bottom: 5px}
        .savejs{margin: 0px;}
    </style>
<script type='text/javascript' src='https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js?ver=2.1.4'></script>
<div style="overflow-y: scroll">
    <h1>Other Theme Settings</h1><br>
    <div>
        <form action="" method="post" id="live2d-options-form">
            <div><div class="title"><h4>Live2D Model Settings</h4> Read directly from and saved as a JS file. Do not modify areas other than settings!</div>
                <textarea  rows="6" cols="150" name="live2d-setting"><?php echo getjs() ?></textarea>
            </div>
            <input class="savejs" type="submit" name="savejs" value="Save JS File" />
        </form>
    </div>
    <div>
        <form action="" method="post" id="email-options-form">
            <?php wp_nonce_field('kratos_admin_options-update'); ?>
            <div><div class="title"><h4>Friend Link Application Processing</h4></div>Select an applicant from the dropdown to edit their details.</div>
            <p>Applicant List
                <select name="aselect" id="aselect">
                    <?php
                        //First Get All Applicants
                        $application=esc_attr(get_option('application_list'));
                        $applications=explode("]!!",$application);
                        foreach ($applications as $key)
                            echo "<option value='$key'>".explode("!!]",$key)[0]."</option>"
                    ?>
                </select>
            </p>
            <p>
                Name:<input type="text" id="name" name="name"/><br>
                URL:<input type="text" id="web" name="web"/><br>
                Intro:<input type="text" id="introduce" name="introduce"/><br>
                Avatar:<input type="text" id="avater" name="avater"/><br>
                Email:<input type="text" id="mail" name="mail"/><br>
            </p>
            <p>
                <input class="savejs" type="submit" name="approve" value="Approve" />
                <input class="savejs" type="submit" name="adelete" value="Delete Application" />
            </p>
        </form>
        <script language="javascript" type="text/javascript">
            $(document).ready(function(){
                var data=$(this).find("option").first().val();
                datas=data.split('!!]');
                $("#name").val(datas[0]);
                $("#web").val(datas[1]);
                $("#introduce").val(datas[2]);
                $("#avater").val(datas[3]);
                $("#mail").val(datas[4]);
                $('#aselect').change(function(){
                    var data=$(this).children('option:selected').val();
                    datas=data.split('!!]');
                    $("#name").val(datas[0]);
                    $("#web").val(datas[1]);
                    $("#introduce").val(datas[2]);
                    $("#avater").val(datas[3]);
                    $("#mail").val(datas[4]);
                })
            })
        </script>
    </div>
    <div>
        <form action="" method="post" id="email-options-form">
            <?php wp_nonce_field('kratos_admin_options-update'); ?>
            <div><div class="title"><h4>Email Subscription Settings</h4></div>Lists all subscribers, one per line. Validity is not checked upon addition.</div>
                <textarea  rows="6" cols="50" name="email_lists"><?php $arr=explode(",",esc_attr(get_option('email_list')));$i=1;foreach ($arr as $item ){if($item){echo $i.':'.$item."\n";}$i++;}?></textarea>
            <p>
            Add subscriber:<input type="text" id="email_list" name="email_list"/>
            <input class="savejs" type="submit" name="submit1" value="Add to Subscription List" /><br>
            </p>
            <p>
            Delete subscriber:<input type="text" id="delete" name="delete"/>
            <input class="savejs" type="submit" name="submit2" value="Remove from Subscription List" />
            </p>
        </form>
    </div>
    <div>
        <form action="" method="post">
            <div class="title"><h4>Background Image Resource Pack Download</h4>Select your preferred type (<span style="color:red;">Note: Existing images, including uploads, will be deleted. If both are selected, all will be downloaded.</span>)</div>
            <p><div>Default Anime Images:<input type="checkbox" name="donman"/> Bilibili:<input type="checkbox" name="bilibili" /></div></p>
            <p><input type="submit" name="download" value="Start Download"/></p>
        </form>
    </div>
    <div>
        <form action="" method="post">
            <div class="title"><h4>Random Avatar Download</h4>Select your preferred type (<span style="color:red;">Note: Existing avatars, including uploads, will be deleted. If both are selected, all will be downloaded.</span>)</div>
            <p><div>Anime Male Avatar:<input type="checkbox" name="man"/> Anime Female Avatar:<input type="checkbox" name="woman" /></div></p>
            <p><input type="submit" name="downloadavatar" value="Start Download"/></p>
         </form>
    </div>
    <?php
    if(!file_exists($_SERVER['DOCUMENT_ROOT'] .'/live2d-api/')) {
        ?>
        <div>
            <form action="" method="post">
                <div class="title"><h4>Live2D API Download</h4>Designed for beginners. The original API is large, so this is a simplified version.</div>
                <span style="color:red;">Note: This feature disappears after downloading. Refresh the homepage to see the character. If it doesn't appear, try switching characters. If characters appear, it's successful. If it fails, delete the live2d-api directory from the root.</span>
                <p><input type="submit" name="downlive2d" value="Start Download"/></p>
            </form>
        </div>
        </div>
        <?php
    }?>
    <div>
        <form action="" method="post">
            <div class="title"><h4>Emoji Pack Download</h4>Select your preferred type (<span style="color:red;">Existing emoji packs will be deleted. Select at least one.</span>)</div>
            <p><div>
                Tieba Bubbles:<input type="checkbox" name="tieba"/>
                Emoticons:<input type="checkbox" name="face" />
                Zhihu Emojis:<input type="checkbox" name="zhihu" />
                Bilibili Emojis:<input type="checkbox" name="bilibili" />
                Bilibili TV Emojis:<input type="checkbox" name="tv" />
            </div></p>
            <p><input type="submit" name="downloadsmilies" value="Start Download"/></p>
        </form>
    </div>
<?php
}

//Register database
function email_init() {
    register_setting('kratos_options', 'email_list');
}

add_action('admin_init', 'email_init');


//Add Interface to WordPress Settings
function live2d_plugin_menu() {
    add_options_page('Theme Settings', 'Theme', 'manage_options', 'live2d-plugin','live2d_option_page' );
}

//Add to WordPress Process
add_action( 'admin_menu', 'live2d_plugin_menu' );
