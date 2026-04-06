<?php get_header(); ?>
<?php if($_COOKIE['goto_bibo']==1){
    include dirname(__FILE__)."/pages/bilibililive/BilibiliLive.php";
    $bilibilUid=kratos_option('bilibili_uid');
    $bilibililive=new BilibiliLive($bilibilUid);
?>
    <div id="wrapper"  class="theme" style="background:url(<?php echo kratos_option('bibo_background')?>) no-repeat top center; padding-top:50px;background-color: white;background-attachment:fixed;background-size:100%;">
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
                    <a  target="_blank" href="https://space.bilibili.com/<?php echo $bilibilUid?>"><div class="weixin">Follow</div></a>
                    <a  target="_blank" class="qq" href="https://message.bilibili.com/#whisper/mid<?php echo $bilibilUid?>">Message</a>
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
        <div id="kratos-blog-post">
        <div id="container" class="container">
        <section id="contents" class="width">
            <!-- Sidebar -->
            <aside id="aside" class="left">
                <div class="inner wow bounceInLeft">
                    <div class="sns web-info">
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
                    <div class="sns master-info">
                        <div class="person-info">
                            <li class="item">
                                <div class="row user-auth"><span title="<?php echo kratos_option('bibo_auth');?>" class="auth-description"><a href="https://space.bilibili.com/<?php echo $bilibilUid?>" title="Personal Authentication" target="_blank" class="auth-icon personal-auth"></a><!---->
                            Bilibili Authentication<br><?php echo kratos_option('bibo_auth');?>
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
                                <span class="tips-right" aria-label="My birthday: <?php echo $bilibililive->birthday ?>">Birthday: <?php echo $bilibililive->birthday ?></span></li>
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
                    <div class="alteration">
                        <div class="widget">
                            <h3 class="widget-title">
                                <i class="icon louie-notice"></i>Announcement</h3>
                            <div class="textwidget">
                                <!-- Comments -->
                                <div class="info">
                                    <?php echo kratos_option('bibo_post');?>
                                </div>
                                <!-- End of Comments -->
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <?php if(kratos_option('bibo_post')){?>
                            <div class="widget">
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
                                    <!-- End of Friend Links -->
                                </ul>
                            </div>
                        <?php }?>
                        <?php if(kratos_option('bibo_hot')){?>
                            <div class="widget">
                                <h3 class="widget-title">
                                    <i class="icon louie-trend"></i>Hot Articles</h3>
                                <ul class="items hot-views">
                                    <li class="item">
                                        <!-- Article Rankings -->
                                        <?php most_hot_posts(180,10); ?>
                                        <!-- End -->
                                    </li>
                                </ul>
                            </div>
                        <?php }?>
                    </div>
            </aside>
    <div id="loop" class="right">
            <!-- Enable flexible switching of Live2D model -->
            <style><?php
                $style=kratos_option('wifuside');
                $position=substr($style,0,strripos($style,':'));
                $value=substr($style,strripos($style,':')+1);
                echo '.waifu {'.$position.':'.$value.'px;}';
                ?></style>
                <?php if(kratos_option('home_side_bar')=='left_side'){ ?>
                    <aside class="col-md-4 hidden-xs hidden-sm scrollspy">
                        <div id="sidebar" class="affix-top">
                            <?php dynamic_sidebar('sidebar_tool'); ?>
                        </div>
                    </aside>
                <?php } ?>
                    <?php
                    if(is_home()){kratos_banner();}
                    elseif(is_category()){
                        if(kratos_option('show_head_cat')){ ?>
                            <div class="kratos-hentry clearfix">
                                <h1 class="kratos-post-header-title">Category: <?php echo single_cat_title('',false); ?></h1>
                                <h1 class="kratos-post-header-title"><?php echo category_description(); ?></h1>
                            </div>
                        <?php }
                    }elseif(is_tag()){
                        if(kratos_option('show_head_tag')){ ?>
                            <div class="kratos-hentry clearfix">
                                <h1 class="kratos-post-header-title">Tag: <?php echo single_cat_title('',false); ?></h1>
                                <h1 class="kratos-post-header-title"><?php echo category_description(); ?></h1>
                            </div>
                        <?php }
                    }elseif(is_search()){ ?>
                        <div class="kratos-hentry clearfix">
                            <h1 class="kratos-post-header-title">Search Results: <?php the_search_query(); ?></h1>
                        </div>
                    <?php }
                    if(have_posts()){
                        while(have_posts()){
                            the_post();
                            get_template_part('/inc/content-templates/content',get_post_format());
                        }
                    }else{ ?>
                        <div class="kratos-hentry clearfix">
                            <h1 class="kratos-post-header-title">Sorry, no content found.</h1>
                        </div>
                    <?php }
                    kratos_pages(3);wp_reset_query(); ?>
                </section>
            <script src="<?php echo bloginfo('template_url').'/static/js/weixinAudio.js';?>"></script>
            <?php if(kratos_option('animal_load')){?>
                <script src = "<?php echo  bloginfo('template_url').'/static/js/wow.min.js';?>" ></script >
            <?php }?>
            <script type="text/javascript">
                $('.weixinAudio').weixinAudio({
                });
                // Animation Script
                new WOW().init();
            </script>
    </div>
     </section>
    </div>
    </div>
 <?php }else{ ?>
    <div id="container" class="container">
<!-- Enable flexible switching of Live2D model -->
        <style><?php
            $style=kratos_option('wifuside');
            $position=substr($style,0,strripos($style,':'));
            $value=substr($style,strripos($style,':')+1);
            echo '.waifu {'.$position.':'.$value.'px;}';
        ?></style>
        <div class="row">
            <?php if(kratos_option('home_side_bar')=='left_side'){ ?>
                <aside class="col-md-4 hidden-xs hidden-sm scrollspy">
                    <div id="sidebar" class="affix-top">
                        <?php dynamic_sidebar('sidebar_tool'); ?>
                    </div>
                </aside>
            <?php } ?>
            <section id="main" class="<?php echo (kratos_option('home_side_bar')=='center')?'col-md-12':'col-md-8'; ?>">
            <?php
                if(is_home()){kratos_banner();}
                elseif(is_category()){
            if(kratos_option('show_head_cat')){ ?>
                <div class="kratos-hentry clearfix">
                    <h1 class="kratos-post-header-title">Category: <?php echo single_cat_title('',false); ?></h1>
                    <h1 class="kratos-post-header-title"><?php echo category_description(); ?></h1>
                </div>    
            <?php }
                }elseif(is_tag()){
            if(kratos_option('show_head_tag')){ ?>
                <div class="kratos-hentry clearfix">
                    <h1 class="kratos-post-header-title">Tag: <?php echo single_cat_title('',false); ?></h1>
                    <h1 class="kratos-post-header-title"><?php echo category_description(); ?></h1>
                </div>
            <?php }
                }elseif(is_search()){ ?>
                <div class="kratos-hentry clearfix">
                    <h1 class="kratos-post-header-title">Search Results: <?php the_search_query(); ?></h1>
                </div>                
            <?php }
                if(have_posts()){
                    while(have_posts()){
                        the_post();
                        get_template_part('/inc/content-templates/content',get_post_format());
                    }
                }else{ ?>
            <div class="kratos-hentry clearfix">
                    <h1 class="kratos-post-header-title">Sorry, no content found.</h1>
            </div>
            <?php }
                kratos_pages(3);wp_reset_query(); ?>
            </section>
        <?php if(kratos_option('home_side_bar')=='right_side'){ ?>
            <aside class="col-md-4 hidden-xs hidden-sm scrollspy">
<!--                id="kratos-widget-area"-->
                <div id="sidebar" class="affix-top wow bounceInRight">
                    <?php dynamic_sidebar('sidebar_tool'); ?>
                </div>
            </aside>
            <?php }?>
        </div>
        <script src="<?php echo  bloginfo('template_url').'/static/js/weixinAudio.js';?>"></script>
        <!-- Music Player -->
        <?php if(kratos_option('animal_load')){?>
            <script src = "<?php echo  bloginfo('template_url').'/static/js/wow.min.js';?>" ></script >
        <?php }?>
        <script type="text/javascript">
            $('.weixinAudio').weixinAudio({
            });
        // Animation Script
            new WOW().init();
        </script>
    </div>
</div>
<?php }?>
<?php get_footer(); ?>