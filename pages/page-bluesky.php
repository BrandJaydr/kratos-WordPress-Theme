<?php
/**
template name: Bluesky Dynamics Template
 */
get_header();

$handle = kratos_option('bluesky_handle');

require_once (get_template_directory() . "/inc/bluesky.php");
$bluesky = new Bluesky($handle);
$profile = $bluesky->profile;

if (!$profile) {
    echo '<div class="container" style="padding-top: 100px; text-align: center;"><h1>Configuration Error</h1><p>Unable to fetch Bluesky profile. Please check your Handle in theme settings.</p></div>';
    get_footer();
    return;
}
?>
<div id="wrapper" class="theme" style="background:url(<?php echo kratos_option('bibo_background')?>) no-repeat top center; padding-top:50px;background-color: white;background-attachment:fixed;background-size:100%;">
    <div class="wow tada">
        <header id="header" class="site-header">
            <section class="banner bg" style="background-image: url(<?php echo esc_url($profile['banner']) ?>)">
                <div class="big-title">
                    <h1 class="big-title-h1"><?php echo esc_html($profile['displayName']) ?>
                        <span class="is-author icon" style="font-size: 14px; background: #0085ff; color: white; padding: 2px 5px; border-radius: 3px; vertical-align: middle; margin-left: 10px;">Bluesky</span>
                    </h1>
                    <h3 class="big-title-h3 tips-top" aria-label="<?php echo esc_attr(wp_strip_all_tags($profile['description'])) ?>"><?php echo wp_strip_all_tags($profile['description']) ?></h3>
                </div>
                <div class="contactme">
                    <a target="_blank" href="<?php echo esc_url("https://bsky.app/profile/" . $profile['handle']) ?>"><div class="weixin">Follow</div></a>
                </div>
            </section>
            <div class="touxiang">
                <a href="<?php echo esc_url("https://bsky.app/profile/" . $profile['handle']) ?>" target="_top">
                    <img src="<?php echo esc_url($profile['avatar']) ?>" alt="Avatar">
                </a>
            </div>
        </header>
    </div>
    <div id="kratos-blog-post">
        <div id="container" class="container">
            <section id="contents" class="width">
                <aside id="aside" class="left">
                    <div class="inner">
                        <div class="sns web-info wow bounceInLeft">
                            <li class="frinum">
                                <a href="<?php echo esc_url("https://bsky.app/profile/" . $profile['handle'] . "/follows") ?>"><?php echo esc_html($profile['followsCount']) ?>
                                    <span>Following</span></a>
                            </li>
                            <li class="vitnum">
                                <a href="<?php echo esc_url("https://bsky.app/profile/" . $profile['handle'] . "/followers") ?>"><?php echo esc_html($profile['followersCount']) ?>
                                    <span>Followers</span></a>
                            </li>
                            <li class="ptnum">
                                <?php echo esc_html($profile['postsCount']) ?>
                                <span>Posts</span>
                            </li>
                        </div>
                    </div>
                </aside>
                <div id="loop" class="right">
                    <main id="main" class="width-half index" role="main" itemprop="mainContentOfPage" style="min-height: 514px;">
                        <?php foreach ($bluesky->posts as $post) : ?>
                            <div id="primary" class="list wow bounceInUp">
                                <article class="post">
                                    <div class="entry-header pull-left">
                                        <a href="<?php echo esc_url("https://bsky.app/profile/" . $profile['handle']) ?>" target="_blank" class="user-head c-pointer" style="background-image: url(<?php echo esc_url($profile['avatar']) ?>); border-radius: 50%;"></a>
                                    </div>
                                    <div class="entry-content">
                                        <div class="meta">
                                            <div class="author" itemprop="author">
                                                <span class="author-name"><?php echo esc_html($profile['displayName']) ?></span>
                                            </div>
                                            <time class="author-time"><?php echo esc_html(date('Y-m-d H:i:s', strtotime($post['indexedAt']))) ?></time>
                                        </div>
                                        <div class="summary" itemprop="description">
                                            <?php echo nl2br(esc_html($post['record']['text'])); ?>
                                            <?php if (isset($post['embed']['images'])) : ?>
                                                <div class="status-images" style="margin-top: 10px;">
                                                    <?php foreach ($post['embed']['images'] as $img) : ?>
                                                        <img class="content-img" src="<?php echo esc_url($img['fullsize']) ?>" style="max-width: 100%; margin-bottom: 5px;" />
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="status-webo">
                                        <ul class="items state">
                                            <li class="item fa fa-share-square-o"> <?php echo esc_html($post['repostCount']) ?></li>
                                            <li class="item fa fa-comment-o"> <?php echo esc_html($post['replyCount']) ?></li>
                                            <li class="item fa fa-thumbs-o-up"> <?php echo esc_html($post['likeCount']) ?></li>
                                        </ul>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </main>
                </div>
            </section>
        </div>
    </div>
</div>
<?php get_footer(); ?>
