<?php if ( have_comments() ) { ?>

	<h3 class="comment-area-title" id="comments-number"><?php comments_number( '', __( 'One Response for this post', 'neutro' ), __( '% Responses for this post', 'neutro' ) ); ?></h3>

	<ol class="comment-list">
		<?php wp_list_comments( hybrid_list_comments_args() ); ?>
	</ol><!-- .comment-list -->

	<?php get_template_part( 'comments-loop-nav' ); // Loads the comment-loop-nav.php template. ?>

<?php } // End check for comments. ?>

<?php get_template_part( 'comments-loop-error' ); // Loads the comments-loop-error.php template. ?>