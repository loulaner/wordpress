	<?php if ( is_attachment() ) : ?>

		<div class="loop-nav">
			<?php previous_post_link( '%link', '<span class="previous">' . __( '<span class="meta-nav">&larr;</span> Return to entry', 'neutro' ) . '</span>' ); ?>
		</div><!-- .loop-nav -->

	<?php elseif ( is_singular( 'post' ) ) : ?>

		<?php $next_post = get_next_post(); ?>
		<?php $previous_post = get_previous_post(); ?>

		<div class="loop-nav articles-pager">
			<?php previous_post_link( '%link', '<div class="arrow"></div> <span class="wrap"> <span class="txt visible-phone">' . __( 'Previous', 'neutro' ) . '</span> <span class="txt hidden-phone">' . __( 'Previous Post', 'neutro' ) . ' </span> <p class="ellipsis"> ' . ( (!empty($previous_post)) ? $previous_post->post_title : '' )  . ' </p> </span>' ); ?>
			<?php next_post_link( '%link', '<div class="arrow"></div> <span class="wrap">  <span class="txt visible-phone"> ' . __( 'Next', 'neutro' ) . ' </span> <span class="txt hidden-phone"> ' . __( 'Next Post', 'neutro' ) . ' </span> <p class="ellipsis"> ' .  ( (!empty($next_post)) ? $next_post->post_title : '' ) . ' </p> </span>' ); ?>
		</div><!-- .loop-nav -->

	<?php elseif ( !is_singular() && current_theme_supports( 'loop-pagination' ) ) : loop_pagination( array( 'prev_text' => __( 'Previous', 'neutro' ), 'next_text' => __( 'Next', 'neutro' ) ) ); ?>

	<?php elseif ( !is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<span class="previous">' . __( 'Previous', 'neutro' ) . '</span>', 'nxtlabel' => '<span class="next">' . __( 'Next', 'neutro' ) . '</span>' ) ) ) : ?>

		<div class="loop-nav">
			<?php echo $nav; ?>
		</div><!-- .loop-nav -->

	<?php endif; ?>