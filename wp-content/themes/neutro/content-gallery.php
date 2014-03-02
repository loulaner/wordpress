<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>

<?php if ( is_singular( get_post_type() ) ) { ?>

	<article <?php hybrid_post_attributes(); ?>>

		<header class="entry-header">
			
			<h1 <?php ( function_exists('neutro_title_attribute') ? neutro_title_attribute() : '' ) ?>> <?php single_post_title(); ?> </h1>

			<?php if (neutro_has_get_the_image() ) if (comments_open() && !post_password_required()) 
				comments_popup_link('0', '1', '%','comment-counter'); ?>

				<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'size' => 'featured-image', 'width' => 768, 'height' => 372, 'image_class' => 'featured-thumbnail', 'before' => '<figure>', 'after' => '</figure>' ) ); ?>
		
			
		</header><!-- .entry-header -->

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

				<header class="entry-header">

					<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>

					<section class="gallery-thumbnail"><ul>
					
						<?php ( function_exists('neutro_get_several_gallery_thumbnail') ? neutro_get_several_gallery_thumbnail(3) : '' ) ?>

					</ul></section>
			
				</header><!-- .entry-header -->
				 <br/>
				
				<footer class="entry-meta">
					<?php echo apply_atomic_shortcode( 'entry_byline', '<p class="article-meta-extra">' . __( '[entry-author] | <a href="' . get_permalink() . '"> [entry-published] </a> | [entry-terms before="In " taxonomy="category"] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'neutro' ) . '</p>' ); ?>
					
				</footer><!-- .entry-footer -->

			</article><!-- .hentry -->

<?php } ?>

	