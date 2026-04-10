<?php
/*
Plugin Name: Live2D Waifu Settings
Description: Used to set up Live2D Waifu
*/


define('FILE_PATH', dirname(__FILE__));

//获取js文件内容
function getjs()
{
    try{
        //读取文件内容
        $js=fopen(FILE_PATH.'/waifu-tips.js','r') or die("无法打开文件");
        $content=fread($js,filesize(FILE_PATH.'/waifu-tips.js'));
        fclose($js);
        return $content;
    }catch (Exception $e)
    {
        return "好像出了一点问题，无法获取到js的内容，请检查PHP是否有对该文件的读写权限！";
    }
}

//Save JS file内容
function savejs($content)
{
    $content=stripslashes($content);//字符反转义
    try{
        //读取文件内容
        $js=fopen(FILE_PATH.'/waifu-tips.js','w') or die(0);
        fwrite($js,$content);
        fclose($js);
        return 1;
    }catch (Exception $e)
    {
        return 0;
    }

}

//下载图片
function downloadimg($url,$imgpath)
{
    curlGet($url, $imgpath.'1.zip');//下载
    unzip($imgpath.'1.zip',$imgpath);//解压
    unlink($imgpath.'1.zip');//删除
}

//看板娘的设置界面
function live2d_option_page() {
    //判断是否有数据提交
    if(!empty($_POST)) {
        //live2d的设置
        if(!empty($_POST['live2d-setting'])) {
            if (savejs($_POST['live2d-setting'])) {
                ?>
                <div id="message" class="updated">
                    <p><strong>Data saved (clear cache for changes to take effect)</strong></p>
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
        //删除订阅用户
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
        //下载图片资源
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
            //删除目录下所有图片
            if($_POST['donman']) {
                //批量删除图片
                downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/thumb.zip',$imgpath)
                ?>
                <div id="message" class="updated">
                    <p><strong>Anime image resources downloaded. Success not guaranteed, please refresh home page to check.</strong></p>
                </div>
                <?php
            }
            if($_POST['bilibili']) {
                downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/bilibili.zip',$imgpath);
                ?>
                <div id="message" class="updated">
                    <p><strong>Bilibili image resources downloaded. Success not guaranteed, please refresh home page to check.</strong></p>
                </div>
                <?php
            }
            //live2d的设置
            $blogpath=$_SERVER['DOCUMENT_ROOT'] ;
        }
        /*下载头像*/
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
            //删除目录下所有图片
            if($_POST['man']) {
                //批量删除图片
                downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/avatarman.zip',$imgpath)
                ?>
                <div id="message" class="updated">
                    <p><strong>Anime boy avatars downloaded. Success not guaranteed, please refresh home page to check.</strong></p>
                </div>
                <?php
            }
            if($_POST['woman']) {
                downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/avatarwoman.zip',$imgpath);
                ?>
                <div id="message" class="updated">
                    <p><strong>Anime girl avatars downloaded. Success not guaranteed, please refresh home page to check.</strong></p>
                </div>
                <?php
            }
        }
        if($_POST['downlive2d']) {
            downloadimg('https://cdn.jsdelivr.net/gh/xiaoyou66/Kratos-@3.0/live2d.zip',$_SERVER['DOCUMENT_ROOT'].'/');
            ?>
            <div id="message" class="updated">
                <p><strong>Live2D resources downloaded. Success not guaranteed, please check yourself.</strong></p>
            </div>
            <?php
        }
        /*Emoji Package Download*/
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
                <p><strong>Emojis downloaded. Success not guaranteed, please check yourself.</strong></p>
            </div>
            <?php
        }
        /*友链审核处理*/
        /*Pass申请*/
        if($_POST['pass']){
            global $wpdb;
            //获取数据库前缀
            global $table_prefix;
            $data=[];
            $data['link_name']=$_POST['name'];
            $data['link_url']=$_POST['web'];
            $data['link_description']=$_POST['introduce'];
            $data['link_image']=$_POST['avater'];
//    $wpdb->insert($table_name, array('album' => "$_POST['album']", 'artist' => "$_POST['artist']"));
            //向数据库中插入友链数据
            $wpdb->insert($table_prefix.'links',$data);
            //删除这个内容
            $delete=$_POST['aselect']."]!!";
            update_option('application_list',str_replace($delete,"",esc_attr(get_option('application_list'))));
            //发送邮件通知申请者
            $to=$_POST['mail'];
            $subject = 'Friend link application approved!';
            $message='Hello, your friend link application has been approved!<br>--------<br>This email is automatically sent. If you don't know what it is, you can ignore it.';
            $headers = 'Content-type: text/html';
            wp_mail($to,$subject,$message,$headers);
            ?>
            <div id="message" class="updated">
                <p><strong>Added successfully</strong></p>
            </div>
            <?php
        }
        /*删除申请*/
        if($_POST['adelete']) {
            //先获取到想删除的内容
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
            <div><div class="title"><h4>Live2D Waifu Settings</h4> Directly read and save as JS file. Do not modify outside settings!</div>
                <textarea  rows="6" cols="150" name="live2d-setting"><?php echo getjs() ?></textarea>
            </div>
            <input class="savejs" type="submit" name="savejs" value="Save JS file" />
        </form>
    </div>
    <div>
        <form action="" method="post" id="email-options-form">
            <?php wp_nonce_field('kratos_admin_options-update'); ?>
            <div><div class="title"><h4>Friend link application processing</h4></div>Select an applicant from dropdown, then edit their info</div>
            <p>Applicant List
                <select name="aselect" id="aselect">
                    <?php
                        //先获取到所有的申请者
                        $application=esc_attr(get_option('application_list'));
                        $applications=explode("]!!",$application);
                        foreach ($applications as $key)
                            echo "<option value='$key'>".explode("!!]",$key)[0]."</option>"
                    ?>
                </select>
            </p>
            <p>
                Name:<input type="text" id="name" name="name"/><br>
                Website:<input type="text" id="web" name="web"/><br>
                Intro:<input type="text" id="introduce" name="introduce"/><br>
                Avatar:<input type="text" id="avater" name="avater"/><br>
                Email:<input type="text" id="mail" name="mail"/><br>
            </p>
            <p>
                <input class="savejs" type="submit" name="pass" value="Pass" />
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
            <div><div class="title"><h4>Email Subscription Settings</h4></div>List of all subscribers, one per line. Correctness is not checked on adding, please verify.</div>
                <textarea  rows="6" cols="50" name="email_lists"><?php $arr=explode(",",esc_attr(get_option('email_list')));$i=1;foreach ($arr as $item ){if($item){echo $i.':'.$item."\n";}$i++;}?></textarea>
            <p>
            Add Subscriber:<input type="text" id="email_list" name="email_list"/>
            <input class="savejs" type="submit" name="submit1" value="Add to list" /><br>
            </p>
            <p>
            Delete Subscriber:<input type="text" id="delete" name="delete"/>
            <input class="savejs" type="submit" name="submit2" value="Remove from list" />
            </p>
        </form>
    </div>
    <div>
        <form action="" method="post">
            <div class="title"><h4>Background Image Package Download</h4>Choose your preferred type(<span style="color:red;">Note: Previous images will be deleted (including uploads). Both will be downloaded if selected.</span>)</div>
            <p><div>Default Anime:<input type="checkbox" name="donman"/> Bilibili:<input type="checkbox" name="bilibili" /></div></p>
            <p><input type="submit" name="download" value="Start Download"/></p>
        </form>
    </div>
    <div>
        <form action="" method="post">
            <div class="title"><h4>Random Avatar Download</h4>Choose your preferred type(<span style="color:red;">Note: Previous avatars will be deleted. Both will be downloaded if selected.</span>)</div>
            <p><div>动漫男生Avatar:<input type="checkbox" name="man"/> 动漫女生Avatar:<input type="checkbox" name="woman" /></div></p>
            <p><input type="submit" name="downloadavatar" value="Start Download"/></p>
         </form>
    </div>
    <?php
    if(!file_exists($_SERVER['DOCUMENT_ROOT'] .'/live2d-api/')) {
        ?>
        <div>
            <form action="" method="post">
                <div class="title"><h4>Live2D API Download</h4>Simplified API for easy use (download original for full experience)</div>
                <span style="color:red;">Note: This feature disappears after download. Refresh home to see the character. If it doesnt show, try switching. If successful, it appears automatically later.</span>
                <p><input type="submit" name="downlive2d" value="Start Download"/></p>
            </form>
        </div>
        </div>
        <?php
    }?>
    <div>
        <form action="" method="post">
            <div class="title"><h4>Emoji Package Download</h4>Choose your preferred type(<span style="color:red;">Note: Previous emojis will be deleted. Select at least one.</span>)</div>
            <p><div>
                Tieba Bubbles:<input type="checkbox" name="tieba"/>
                Kaomoji:<input type="checkbox" name="face" />
                Zhihu Emojis:<input type="checkbox" name="zhihu" />
                Bilibili Emojis:<input type="checkbox" name="bilibili" />
                Bilibili TV Emojis:<input type="checkbox" name="tv" />
            </div></p>
            <p><input type="submit" name="downloadsmilies" value="Start Download"/></p>
        </form>
    </div>
<?php
}

//注册数据库
function email_init() {
    register_setting('kratos_options', 'email_list');
}

add_action('admin_init', 'email_init');


//把设置界面添加到wordpress的设置内
function live2d_plugin_menu() {
    add_options_page('Theme Settings', 'Theme', 'manage_options', 'live2d-plugin','live2d_option_page' );
}

//加到wordpress进程中
add_action( 'admin_menu', 'live2d_plugin_menu' );


