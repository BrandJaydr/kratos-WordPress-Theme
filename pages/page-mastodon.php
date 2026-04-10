<?php
/**
template name: Mastodon Dynamics Template
 */
get_header();

$instance = kratos_option('mastodon_instance');
$userId = kratos_option('mastodon_user_id');

require_once (get_template_directory() . "/inc/mastodon.php");
$mastodon = new Mastodon($instance, $userId);
$user = $mastodon->user;

if (!$user) {
    echo '<div class="container" style="padding-top: 100px; text-align: center;"><h1>Configuration Error</h1><p>Unable to fetch Mastodon user data. Please check your Instance URL and User ID in theme settings.</p></div>';
    get_footer();
    return;
}
?>
<div id="wrapper" class="theme" style="background:url(<?php echo kratos_option('bibo_background')?>) no-repeat top center; padding-top:50px;background-color: white;background-attachment:fixed;background-size:100%;">
    <div class="wow tada">
        <header id="header" class="site-header">
            <section class="banner bg" style="background-image: url(<?php echo $user['header'] ?>)">
                <div class="big-title">
                    <h1 class="big-title-h1"><?php echo $user['username'] ?>
                        <span class="is-author icon" style="font-size: 14px; background: #2b90d9; color: white; padding: 2px 5px; border-radius: 3px; vertical-align: middle; margin-left: 10px;">Mastodon</span>
                    </h1>
                    <h3 class="big-title-h3 tips-top" aria-label="<?php echo wp_strip_all_tags($user['note']) ?>"><?php echo wp_strip_all_tags($user['note']) ?></h3>
                </div>
                <div class="contactme">
                    <a target="_blank" href="<?php echo $user['url'] ?>"><div class="weixin">Follow</div></a>
                </div>
            </section>
            <div class="touxiang">
                <a href="<?php echo $user['url'] ?>" target="_top">
                    <img src="<?php echo $user['avatar'] ?>" alt="Avatar">
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
                                <a href="<?php echo $user['url'] ?>/following"><?php echo $user['following_count'] ?>
                                    <span>Following</span></a>
                            </li>
                            <li class="vitnum">
                                <a href="<?php echo $user['url'] ?>/followers"><?php echo $user['followers_count'] ?>
                                    <span>Followers</span></a>
                            </li>
                            <li class="ptnum">
                                <?php echo $user['statuses_count'] ?>
                                <span>Statuses</span>
                            </li>
                        </div>
                        <div class="sns master-info wow bounceInLeft">
                            <div class="person-info">
                                <?php foreach ($user['fields'] as $field) : ?>
                                    <div class="row user-auth" style="margin-bottom: 10px;">
                                        <strong><?php echo $field['name'] ?>:</strong> <?php echo wp_strip_all_tags($field['value']) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </aside>
                <div id="loop" class="right">
                    <main id="main" class="width-half index" role="main" itemprop="mainContentOfPage" style="min-height: 514px;">
                        <?php foreach ($mastodon->statuses as $status) : ?>
                            <div id="primary" class="list wow bounceInUp">
                                <article class="post">
                                    <div class="entry-header pull-left">
                                        <a href="<?php echo $user['url'] ?>" target="_blank" class="user-head c-pointer" style="background-image: url(<?php echo $user['avatar'] ?>); border-radius: 50%;"></a>
                                    </div>
                                    <div class="entry-content">
                                        <div class="meta">
                                            <div class="author" itemprop="author">
                                                <span class="author-name"><?php echo $user['username'] ?></span>
                                            </div>
                                            <time class="author-time"><?php echo date('Y-m-d H:i:s', strtotime($status['created_at'])) ?></time>
                                        </div>
                                        <div class="summary" itemprop="description">
                                            <?php echo $status['content']; ?>
                                            <?php if (!empty($status['media_attachments'])) : ?>
                                                <div class="status-images" style="margin-top: 10px;">
                                                    <?php foreach ($status['media_attachments'] as $media) : ?>
                                                        <?php if ($media['type'] == 'image') : ?>
                                                            <img class="content-img" src="<?php echo $media['preview_url'] ?>" style="max-width: 100%; margin-bottom: 5px;" />
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="status-webo">
                                        <ul class="items state">
                                            <li class="item fa fa-share-square-o"> <?php echo $status['reblogs_count'] ?></li>
                                            <li class="item fa fa-comment-o"> <?php echo $status['replies_count'] ?></li>
                                            <li class="item fa fa-thumbs-o-up"> <?php echo $status['favourites_count'] ?></li>
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
