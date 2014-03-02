<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>

<?php if ( is_singular( get_post_type() ) ) { ?>

	<article <?php hybrid_post_attributes(); ?>>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'neutro' ) . '</span>', 'after' => '</p>', 'link_before' => '<span>', 'link_after' => '</span>', ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="single-entry-meta">' . __( '[entry-published] [entry-terms taxonomy="category"] [entry-terms] [entry-edit-link]', 'neutro' ) . '</div>' ); ?>

		</footer><!-- .entry-footer -->
		
	</article>

	

<?php } else { ?>

			<article <?php hybrid_post_attributes(); ?>>	

				<div class="entry-summary">
					<?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'neutro' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'neutro' ) . '</span>', 'after' => '</p>' ) ); ?>
				</div><!-- .entry-summary -->

			</article><!-- .hentry -->

<?php } ?>

	