<?php if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) { ?>

	<nav class="comments-nav clearfix">

		<?php previous_comments_link( __( 'Previous', 'neutro' ) ); ?>
		<?php next_comments_link( __( 'Next', 'neutro' ) ); ?>

	</nav><!-- .comments-nav -->
	
<?php } ?>