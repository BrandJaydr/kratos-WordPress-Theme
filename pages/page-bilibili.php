<?php
/**
template name: Bilibili Anime Tracking Template
*/
get_header(); ?>

<div id="container" class="container" >
    <div class="page-header">
        <h1>My Anime List
         <?php
             if(!function_exists('kratos_progress_precentage')){
                 function kratos_progress_precentage($str1, $str2) {
                     if (is_numeric($str1) && is_numeric($str2) && $str2 > 0) return $str1 / $str2 * 100;
                     if ($str1 == "No record!") return 0;
                     return 100;
                 }
             }
             if (kratos_option('anilist_username')) {
                 require_once (get_template_directory() . "/inc/anilist.php");
                 $ani = new AniList(kratos_option('anilist_username'));
                 echo "<small>Currently following ".$ani->sum." series, keep it up!</small></h1></div><div class=\"bilibili\">";
                 for ($i = 0; $i < $ani->sum; $i++) {
                     echo "<a class=\"bgm-item\" href=\"".esc_url("https://anilist.co/anime/".$ani->media_id[$i])."\" target=\"_blank\"><div class=\"bgm-item-thumb\" style=\"background-image:url(".esc_url($ani->image_url[$i]).")\"></div><div class=\"bgm-item-info\"><span class=\"bgm-item-titlemain\">".esc_html($ani->title[$i])."</span><span class=\"bgm-item-title\">".esc_html($ani->evaluate[$i])."</span></div><div class=\"bgm-item-statusBar-container\"><div class=\"bgm-item-statusBar\" style=\"width:".esc_attr(kratos_progress_precentage($ani->progress[$i],$ani->total[$i]))."%\"></div>Progress ".esc_html($ani->progress[$i])."/". esc_html($ani->total[$i])."</div></a>";
                 }
             } else {
                 require_once ("bilibili/bilibiliAnime.php");
                 $bili = new bilibiliAnime(kratos_option('bilibili_uid'), kratos_option('bilibili_cookie'));
                 echo "<small>Currently following ".$bili->sum." series, keep it up!</small></h1></div><div class=\"bilibili\">";
                 for($i=0;$i<$bili->sum;$i++)
                 {
                     echo "<a class=\"bgm-item\" href=\"https://www.bilibili.com/bangumi/play/ss".$bili->season_id[$i]."/ \" target=\"_blank\"><div class=\"bgm-item-thumb\" style=\"background-image:url(".$bili->image_url[$i].")\"></div><div class=\"bgm-item-info\"><span class=\"bgm-item-titlemain\">".$bili->title[$i]."</span><span class=\"bgm-item-title\">".$bili->evaluate[$i]."</span></div><div class=\"bgm-item-statusBar-container\"><div class=\"bgm-item-statusBar\" style=\"width:".kratos_progress_precentage($bili->progress[$i],$bili->total[$i])."%\"></div>Progress ".$bili->progress[$i]."/". $bili->total[$i]."</div></a>";
                 }
             }
        ?>
    </div>
  </div>

<?php get_footer(); ?>










