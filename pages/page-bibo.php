<?php
/**
template name: Bilibili Dynamics Template
 */
setcookie('goto_bibo', 1);

if (kratos_option('mastodon_instance') && kratos_option('mastodon_user_id')) {
    include (get_template_directory() . "/pages/page-mastodon.php");
    return;
}

if (kratos_option('youtube_api_key') && kratos_option('youtube_channel_id')) {
    include (get_template_directory() . "/pages/page-youtube.php");
    return;
}

if (kratos_option('bluesky_handle')) {
    include (get_template_directory() . "/pages/page-bluesky.php");
    return;
}

include "bilibililive/BilibiliLive.php";
?>
<?php get_header();
$bilibilUid=kratos_option('bilibili_uid');
$bilibililive=null;
$bilibililive=new BilibiliLive($bilibilUid);
$theid=$_REQUEST['id'];
?>
<div id="wrapper"  class="theme" style="background:url(<?php echo kratos_option('bibo_background')?>) no-repeat top center; padding-top:50px;background-color: white;background-attachment:fixed;background-size:100%;">
    <div class="wow tada">
        <header id="header" class="site-header">
            <!-- Navigation End -->
            <section class="banner bg" style="background-image: url(<?php echo $bilibililive->spacepicture?>)">
                <div class="big-title">
                        <h1 class="big-title-h1" ><?php echo $bilibililive->usrname ?>
                            <span id="h-gender" class="icon gender male"></span>
                            <a href="//www.bilibili.com/html/help.html#k" target="_blank" lvl="<?php echo $bilibililive->level ?>" class="h-level m-level"></a>
                            <?php
                            if($bilibililive->isvip){
                                ?>
                                <a href="//account.bilibili.com/account/big" target="_blank" class="h-vipType">Annual VIP</a>
                            <?php }?>
                        </h1>
                    <h3 class="big-title-h3 tips-top" aria-label="<?php echo $bilibililive->sign ?>" id="yiyan"><?php echo $bilibililive->sign ?>
                        <br></h3>
                </div>
                <div class="contactme">
                    <a target="_blank" href="https://space.bilibili.com/<?php echo $bilibilUid?>"><div class="weixin">Follow</div></a>
                    <a target="_blank" class="qq" href="https://message.bilibili.com/#whisper/mid<?php echo $bilibilUid?>">Message</a>
                </div>
            </section>
            <div class="touxiang">
                <a href="https://space.bilibili.com/<?php echo $bilibilUid?>" target="_top">
                    <img src="<?php echo $bilibililive->advanter ?>" alt="Avatar"></a>
                <span class="renzheng" style="background-image:url(<?php echo  bloginfo('template_url').'/pages/';?>bilibililive/images/icon2.png);"></span>
            </div>
            <div class="banner-item width">
                <a target="_blank" class="active" href="https://space.bilibili.com/<?php echo $bilibilUid?>">Homepage</a>
                <a target="_blank" href="https://space.bilibili.com/<?php echo $bilibilUid?>/album">Album</a></div>
        </header>
    </div>
    <div id="kratos-blog-post">
    <div id="container" class="container">
        <section id="contents" class="width">
            <!-- Sidebar -->
            <aside id="aside" class="left">
                <div class="inner">
                    <div class="sns web-info wow bounceInLeft">
                        <li class="frinum">
                            <a href="https://space.bilibili.com/<?php echo $bilibilUid?>/fans/follow"><?php echo $bilibililive->attation?>
                                <span>Following</span></a>
                        </li>
                        <li class="vitnum">
                            <a href="https://space.bilibili.com/<?php echo $bilibilUid?>/fans/fans"><?php echo $bilibililive->fans?>
                                <span>Fans</span></a>
                        </li>
                        <li class="ptnum">
                            <?php echo $bilibililive->play?>
                            <span>Plays</span>
                        </li>
                    </div>
                    <div class="sns master-info wow bounceInLeft">
                        <div class="person-info">
                            <li class="item">
                                <div class="row user-auth"><span title="<?php echo kratos_option('bibo_auth');?>" class="auth-description"><a href="https://space.bilibili.com/<?php echo $bilibilUid?>" title="Personal Authentication" target="_blank" class="auth-icon personal-auth"></a><!---->
                            bilibiliPersonal Authentication<br><?php echo kratos_option('bibo_auth');?>
                          </span></div>
                            </li>
                        </div>
                        <ul class="m_info-items">
                            <?php if(kratos_option('bibo_palce')){?>
                                <li class="item">
                                    <i class="icon louie-location"></i>
                                    <span class="tips-right" aria-label="<?php echo kratos_option('bibo_palce');?>"><?php echo kratos_option('bibo_palce');?></span></li>
                            <?php }?>
                            <li class="item">
                                <i class="icon louie-time-o"></i>
                                <span class="tips-right" aria-label="My Birthday: <?php echo $bilibililive->birthday ?>">Birthday: <?php echo $bilibililive->birthday ?></span></li>
                            <?php if(kratos_option('bibo_descript')){?>
                                <li class="item">
                                    <i class="icon louie-smiling"></i>
                                    <span class="tips-right" aria-label="<?php echo kratos_option('bibo_descript');?>">Intro: <?php echo kratos_option('bibo_descript');?></span></li>
                            <?php }?>
                            <li class="item last">
                                <i class="icon louie-link-o"></i>
                                <a class="tips-right" aria-label="Personalized Domain" href="<?php echo kratos_option('bibo_pushlink');?>" target="_blank"><?php echo kratos_option('bibo_push');?></a></li>
                        </ul>
                        <div class="sns readmore">
                            <a href="<?php echo kratos_option('bibo_more');?>">View More&nbsp;&gt;</a></div>
                    </div>
                    <?php if(kratos_option('bibo_post')){?>}
                    <div class="alteration wow zoomIn">
                        <div class="widget">
                            <h3 class="widget-title">
                                <i class="icon louie-notice"></i>Announcement</h3>
                            <div class="textwidget">
                                <!-- Comments -->
                                <div class="info">
                                    <?php echo kratos_option('bibo_post');?>
                                </div>
                                <!-- CommentsEnd -->
                            </div>
                        </div>
                    </div>
                    <?php }?>
                        <?php if(kratos_option('bibo_post')){?>
                            <div class="widget wow bounceInLeft">
                                <h3 class="widget-title">
                                    <i class="icon icon louie-smile"></i>Friend Links (Random 10)</h3>
                                <ul class="items links-bar">
                                    <!-- Friend Links -->
                                    <?php
                                    $bookmarks = get_bookmarks(array('orderby'=>'rand'));
                                    if(!empty($bookmarks)){
                                        $i=0;
                                        foreach($bookmarks as $bookmark){
                                            echo '<li class="item"><a href="'.$bookmark->link_url.'" target="_blank" title="'.$bookmark->link_description.'">'.$bookmark->link_name.'</a></li>';
                                            $i++;
                                            if($i==10) break;
                                        }
                                    } ?>
                                    <!-- Friend LinksEnd -->
                                </ul>
                            </div>
                        <?php }?>
                        <?php if(kratos_option('bibo_hot')){?>
                            <div class="widget wow bounceInLeft">
                                <h3 class="widget-title">
                                    <i class="icon louie-trend"></i>Hot Articles</h3>
                                <ul class="items hot-views">
                                    <li class="item">
                                        <!-- Article ranking -->
                                        <?php most_hot_posts(180,10); ?>
                                        <!-- End -->
                                    </li>
                                </ul>
                            </div>
                        <?php }?>
                    </div>
            </aside>
        <!-- Sidebar end -->
        <div id="loop" class="right">
            <main id="main" class="width-half index" role="main" itemprop="mainContentOfPage" style="min-height: 514px;">
            <!-- Start fetching data here-->
                <?php
                $i=0;
                foreach ($bilibililive->getlive($theid) as $content)
                {
                    $i++;
                    if($i==11) break;
                    $realcontent=json_decode($content["card"],true);
                    $id="";

                    //The first line is simple text
                    if($realcontent["item"]["content"])
                    {
                        /*Change emoji*/
                        if($content["display"]["emoji_info"]["emoji_details"])
                        {
                            foreach ($content["display"]["emoji_info"]["emoji_details"] as $emojin)
                            $realcontent["item"]["content"]=str_replace($emojin["text"],"<img style='height:30px;width:30px;display:inline;' src='".$emojin["url"]."''/>",$realcontent["item"]["content"]);
                        }
                        //Get ID for dynamic jump
                        $id=$content['desc']['dynamic_id'];
                        //echo "Video content:".$realcontent["item"]["content"];
                        echoContent($realcontent["item"]["content"],"",$content["desc"]["repost"],$content["desc"]["like"],$content["desc"]["comment"],$content["desc"]["timestamp"],$content["desc"]["view"],"","",1, $bilibililive, $bilibilUid,$id);
                    }
                    else
                    {
                        //Distinguish content with images below
                        if($realcontent["item"]["description"])
                        {
                            /*Change emoji*/
                            if($content["display"]["emoji_info"]["emoji_details"])
                            {
                                foreach ($content["display"]["emoji_info"]["emoji_details"] as $emojin)
                                    $realcontent["item"]["description"]=str_replace($emojin["text"],"<img style='height:30px;width:30px;display:inline;' src='".$emojin["url"]."''/>",$realcontent["item"]["description"]);
                            }
                            $id=$content['desc']['dynamic_id'];
                            echoContent($realcontent["item"]["description"],$realcontent["item"]["pictures"],$content["desc"]["repost"],$content["desc"]["like"],$realcontent["item"]["reply"],$content["desc"]["timestamp"],$content["desc"]["view"],"","",2, $bilibililive, $bilibilUid,$id);
                        }
                        /*Here is the published video*/
                        if($realcontent["aid"])
                        {
                            /*Change emoji*/
                            if($content["display"]["emoji_info"]["emoji_details"])
                            {
                                foreach ($content["display"]["emoji_info"]["emoji_details"] as $emojin)
                                    $realcontent["desc"]=str_replace($emojin["text"],"<img style='height:30px;width:30px;display:inline;' src='".$emojin["url"]."''/>",$realcontent["desc"]);
                            }
                            echoContent($realcontent["desc"],"",$realcontent["stat"]["share"],$realcontent["stat"]["like"],$realcontent["stat"]["reply"],$realcontent["pubdate"],$realcontent["stat"]["view"],$realcontent["cid"],$realcontent["aid"],3, $bilibililive, $bilibilUid,$id);
//                            echo "<br>aid number".;
//                            echo "<br>cid number".$realcontent["cid"];
//                            echo "<br>video description".$realcontent["desc"];
                        }
                    }
                }
                ?>
                <?php
                /*Generate different types of content here
                Content, picture array, share count, like count, comment count, publish time, view count, video cid, video aid, type (1 pure text, 2 dynamic with images, 3 published video)
                */
                function echoContent($content, $picture, $share, $like, $comment, $time, $visited, $cid, $aid, $option, $bilibililive, $bilibilUid,$id)
                {
                    /*Try to implement emoji and newline replacement here*/
                    $content=str_replace("\r\n","<br>",$content);
                    $content=str_replace("\n","<br>",$content);
                    ?>
                    <!-- Post list -->
                    <div id="primary" class="list wow bounceInUp">
                        <article class="post">
                            <div class="entry-header pull-left">
                                <!-- Avatar -->
                                <a data-v-4077d7b8="" href="//space.bilibili.com/<?php echo $bilibilUid?>/dynamic" target="_blank" class="user-head c-pointer" style="background-image: url(<?php echo $bilibililive->advanter ?>); border-radius: 50%;" data-userinfo-popup-inited="true">
                                    <div data-v-4077d7b8="" class="user-decorator" style="background-image: url(<?php echo $bilibililive->hangpicture ?>);"></div>
                                </a>
                            </div>
                            <div class="entry-content">
                                <div class="meta">
                                    <div class="author" itemprop="author">
                                        <span class="author-name"><?php echo $bilibililive->usrname ?></span>
                                        <span class="is-author icon" aria-label="This is master">M</span></div>
                                    <time class="author-time" itemprop="datePublished" datetime="">
                                        <?php
                                              /*Time processing here*/
                                                echo date('Y-m-d H:i:s',$time);
                                        ?></time>

                                </div>
                                <?php if($id) echo "<a href='https://t.bilibili.com/$id' target='_blank'>";?>
                                <div class="summary" itemprop="description">
                                    <!-- Start fetching data here-->
                                    <?php
                                    /*Content processing code here*/
                                    if($option==1)
                                        echo $content;
                                    else if($option==2)
                                    {
                                        echo $content."<br>";
                                        foreach ($picture as $img)
                                        {
                                            echo "<img class='content-img' src='".$img["img_src"]."'/>";
                                        }
                                    }
                                    else if($option==3)
                                    {
                                        ?>
                                        <div class="video-container">
                                            <iframe src="//player.bilibili.com/player.html?aid=<?php echo $aid ?>&cid=<?php echo $cid ?>&page=1" allowtransparency="true" width="100%" height="498" scrolling="no" frameborder="0" >
                                            </iframe>
                                        </div>
                                        <?php
                                        echo "<br>Video Intro: ".$content;
                                    }

                                    ?>

                                </div>
                                <?php
                                if($id){
                                    echo "</a>";
                                }
                                ?>
                            </div>
                            <!--Bottom information-->
                            <?php if($aid) echo '<a href="https://www.bilibili.com/video/av'.$aid.'" target="_blank">'?>
                            <?php if($id) echo "<a href='https://t.bilibili.com/$id' target='_blank'>";?>
                                <div class="status-webo">
                                    <ul class="items state">
                                        <li class="item fa fa-share-square-o">
                                            <?php echo $share ?>
                                        </li>
                                        <li class="item fa fa-comment-o">
                                            <?php echo $comment ?>
                                        </li>
                                        <li class="item fa fa-thumbs-o-up">
                                            <?php echo $like ?>
                                        </li>
                                        <li class="item fa fa-eye" style="border-right:0">
                                            <?php echo $visited?>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </article>
                    </div>
                <?php
                }
                ?>
            </main>
            <?php if($theid) {?>
                <a href="<?php echo kratos_option('bibo_pagelink')."?id="; ?>"><button type="button" style="border-radius: 5px;;position: absolute;width: 48%" class="btn btn-primary">Home</button></a>
            <?php }?>
            <?php if($bilibililive->next_url) {?>
                <a href="<?php echo kratos_option('bibo_pagelink')."?id=".$bilibililive->next_url; ?>"><button type="button" style="border-radius: 5px;;position: absolute;width: 48%;right:0px;" class="btn btn-primary">Next Page</button></a>
            <?php }?>
    </div>
    </section>
        <?php if(kratos_option('animal_load')){?>
            <script src = "<?php echo  bloginfo('template_url').'/static/js/wow.min.js';?>" ></script >
            <script type="text/javascript">
                new WOW().init();
            </script>
        <?php }?>

    </div>
</div>
<?php get_footer(); ?>