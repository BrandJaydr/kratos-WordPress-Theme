<?php
/**
template name: YouTube Dynamics Template
 */
get_header();

$apiKey = kratos_option('youtube_api_key');
$channelId = kratos_option('youtube_channel_id');

require_once (get_template_directory() . "/inc/youtube.php");
$youtube = new YouTube($apiKey, $channelId);
$channel = $youtube->channel;

if (!$channel) {
    echo '<div class="container" style="padding-top: 100px; text-align: center;"><h1>Configuration Error</h1><p>Unable to fetch YouTube channel data. Please check your API Key and Channel ID in theme settings.</p></div>';
    get_footer();
    return;
}
?>
<div id="wrapper" class="theme" style="background:url(<?php echo kratos_option('bibo_background')?>) no-repeat top center; padding-top:50px;background-color: white;background-attachment:fixed;background-size:100%;">
    <div class="wow tada">
        <header id="header" class="site-header">
            <section class="banner bg" style="background-image: url(<?php echo esc_url($channel['banner']) ?>)">
                <div class="big-title">
                    <h1 class="big-title-h1"><?php echo esc_html($channel['title']) ?>
                        <span class="is-author icon" style="font-size: 14px; background: #ff0000; color: white; padding: 2px 5px; border-radius: 3px; vertical-align: middle; margin-left: 10px;">YouTube</span>
                    </h1>
                    <h3 class="big-title-h3 tips-top" aria-label="<?php echo esc_attr(wp_strip_all_tags($channel['description'])) ?>"><?php echo wp_strip_all_tags($channel['description']) ?></h3>
                </div>
                <div class="contactme">
                    <a target="_blank" href="<?php echo esc_url("https://www.youtube.com/channel/" . $channelId) ?>"><div class="weixin">Subscribe</div></a>
                </div>
            </section>
            <div class="touxiang">
                <a href="<?php echo esc_url("https://www.youtube.com/channel/" . $channelId) ?>" target="_top">
                    <img src="<?php echo esc_url($channel['thumbnail']) ?>" alt="Avatar">
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
                                <a><?php echo esc_html(number_format($channel['subscriberCount'])) ?>
                                    <span>Subscribers</span></a>
                            </li>
                            <li class="vitnum">
                                <a><?php echo esc_html(number_format($channel['viewCount'])) ?>
                                    <span>Total Views</span></a>
                            </li>
                            <li class="ptnum">
                                <?php echo esc_html(number_format($channel['videoCount'])) ?>
                                <span>Videos</span>
                            </li>
                        </div>
                    </div>
                </aside>
                <div id="loop" class="right">
                    <main id="main" class="width-half index" role="main" itemprop="mainContentOfPage" style="min-height: 514px;">
                        <?php foreach ($youtube->videos as $video) : ?>
                            <div id="primary" class="list wow bounceInUp">
                                <article class="post">
                                    <div class="entry-header pull-left">
                                        <a href="<?php echo esc_url("https://www.youtube.com/channel/" . $channelId) ?>" target="_blank" class="user-head c-pointer" style="background-image: url(<?php echo esc_url($channel['thumbnail']) ?>); border-radius: 50%;"></a>
                                    </div>
                                    <div class="entry-content">
                                        <div class="meta">
                                            <div class="author" itemprop="author">
                                                <span class="author-name"><?php echo esc_html($channel['title']) ?></span>
                                            </div>
                                            <time class="author-time"><?php echo esc_html(date('Y-m-d H:i:s', strtotime($video['publishedAt']))) ?></time>
                                        </div>
                                        <div class="summary" itemprop="description">
                                            <h4 style="margin-bottom: 10px;"><a href="<?php echo esc_url("https://www.youtube.com/watch?v=" . $video['id']) ?>" target="_blank"><?php echo esc_html($video['title']) ?></a></h4>
                                            <div class="video-container">
                                                <iframe src="<?php echo esc_url("https://www.youtube.com/embed/" . $video['id']) ?>" allowfullscreen width="100%" height="300" frameborder="0"></iframe>
                                            </div>
                                            <p style="margin-top: 10px;"><?php echo esc_html($video['description']) ?></p>
                                        </div>
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
