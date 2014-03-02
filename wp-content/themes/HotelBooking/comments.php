<?php if ( comments_open() ) : ?>
<div class="comments">
  <?php if ( post_password_required() ) : ?>
  <p class="nopassword">
    <?php _e('This post is password protected. Enter the password to view any comments.','templatic'); ?>
  </p>
</div>
<!-- #comments -->
<?php  return; endif; ?>
<div id="comments">
  <?php if (have_comments()) : ?>
  <h3><?php printf(_n(__('1 comment','templatic'), __('%1$s comments','templatic'), get_comments_number()), number_format_i18n( get_comments_number() ), '' ); ?></h3>
  <div class="comment_list">
    <ol>
      <?php wp_list_comments(array('callback' => 'commentslist')); ?>
    </ol>
  </div>
  <?php endif; // end have_comments() ?>
</div>
<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
  <h3><?php _e('What do you think?','templatic');?></h3>
  <div class="comment_form">
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    <p class="comment_message">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      <?php if ( $user_ID ) : ?>
      <p class="comment_message"><?php _e('Logged in as','templatic');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out &raquo;','templatic');?></a></p>
      <table>
        <tr>
          <td><div class="commform-textarea">
              <textarea name="comment" id="comment" cols="50" rows="7" tabindex="1"></textarea>
            </div></td>
        </tr>
      </table>
      <?php else : ?>
      
      <table>
        <tr>
          <td><div class="commform-textarea">
              <textarea name="comment" id="comment" cols="50" rows="7" tabindex="1"></textarea>
            </div></td>
        </tr>
      </table>
      
      <table>
         <tr>
          <td class="commform-author"><p><?php _e('Name','templatic');?> <span><?php _e('required','templatic');?></span></p>
            <div>
              <input type="text" name="author" id="author" tabindex="2" />
            </div></td>
          <td class="commform-email"><p><?php _e('Email','templatic');?> <span><?php _e('required','templatic');?></span></p>
            <div>
              <input type="text" name="email" id="email" tabindex="3" />
            </div></td>
          <td class="commform-url"><p><?php _e('Website','templatic');?></p>
            <div>
              <input type="text" name="url" id="url" tabindex="4" />
            </div></td>
        </tr>
      </table>
      <?php endif; ?>
      <div class="submit clear">
        <input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit','templatic');?>" />
        <p id="cancel-comment-reply">
          <?php cancel_comment_reply_link() ?>
        </p>
      </div>
      <div>
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
      </div>
    </form>
    <?php endif; // If registration required and not logged in ?>
  </div>
  <?php endif; // if you delete this the sky will fall on your head ?>
</div>
</div>
<?php endif; // end ! comments_open() ?>
<!-- #comments -->
