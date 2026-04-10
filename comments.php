<?php if(post_password_required()) return; ?>
<div id="comments" class="comments-area">
    <ol class="comment-list">
    <?php if(have_comments()){ ?>
        <?php wp_list_comments(array('style'=>'ol','short_ping'=>true,'avatar_size'=>50,)); ?>
    </ol>
        <?php if(get_comment_pages_count()>1&&get_option('page_comments')){ ?>
            <div id="comments-nav">
                <?php paginate_comments_links('prev_text=Previous Page&next_text=Next Page');?>
            </div>
        <?php }
    }else echo '</ol>';
     //echo("<script>console.log('".json_encode($commenter)."');</script>");
    $fields=array(
        'uid'=>'<div class="wow bounceInLeft"><div class="comment-form-bilibili form-group has-feedback"><div class="input-group"><div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div><input class="form-control" placeholder="Bilibili UID" id="uid" name="uid" type="text" value="'.esc_attr($_COOKIE["Buid"]).'" size="30" /><span class="form-control-feedback required">*</span></div></div></div>',
        'author'=>'<div class="wow bounceInRight"><div class="comment-form-author form-group has-feedback"><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div><input class="form-control" placeholder="Nickname" id="author" name="author" type="text" value="'.esc_attr($commenter['comment_author']).'" size="30" /><span class="form-control-feedback required">*</span></div></div></div>',
        'email'=>'<div class="wow bounceInLeft"><div class="comment-form-email form-group has-feedback wow jackInTheBox"><div class="input-group"><div class="input-group-addon"><i class="fa fa-envelope-o"></i></div><input class="form-control" placeholder="Email" id="email" name="email" type="text" value="'.esc_attr($commenter['comment_author_email']).'" size="30" /><span class="form-control-feedback required">*</span></div></div></div>',
        'url'=>'<div class="wow bounceInRight"><div class="comment-form-url form-group has-feedback wow jackInTheBox"><div class="input-group"><div class="input-group-addon"><i class="fa fa-link"></i></div><input class="form-control" placeholder="Website" id="url" name="url" type="text" value="'.esc_attr($commenter['comment_author_url']).'" size="30" /></div></div></div>',
        'cookies'=>'',
    );
    $args=array(
        'title_reply_before'=>'<h4 id="reply-title" class="comment-reply-title">',
        'title_reply_after'=>'</h4>',
        'fields'=>$fields,
        'class_submit'=>'btn btn-primary',
        'comment_notes_before' => '<p class="comment-notes">Nickname or UID can be chosen，Email is required(you will receive an email after a reply)<br>tips:entering UID can quickly fetch your nickname and avatar</p>',
        'comment_field'=>'<div class="comment form-group has-feedback"><div class="input-group"><textarea class="form-control" id="comment" placeholder="Looking forward to your comments~" name="comment" rows="5" aria-required="true" required  onkeydown="if(event.ctrlKey){if(event.keyCode==13){document.getElementById(\'submit\').click();return false}};"></textarea></div><div class="OwO"></div></div>',
    );
    comment_form($args); ?>
</div>