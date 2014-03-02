<li <?php hybrid_comment_attributes(); ?>>
	
	<article class="comment clearfix">
	
	<div class="comment-avatar pull-left"> <?php echo hybrid_avatar(); ?> </div>

	<?php echo apply_atomic_shortcode( 'comment_meta', '<div class="comment-meta">[comment-author] <div class="comment-meta-wrapper"><span class="genericon genericon-time"></span> [comment-published human_time="' . __( '%s ago', 'neutro' ) . '"] [comment-permalink] [comment-edit-link] </div> </div>' ); ?>

	</article>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>