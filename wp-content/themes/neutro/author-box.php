<?php
/**
 * The template for displaying Author information on Singular.
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>
<?php if(is_singular() ) : ?>

	<div class="author-profile vcard article-author media">
		<figure class="pull-left">
			<?php echo get_avatar( get_the_author_meta( 'email' ), '96', false , get_the_author_meta('display_name') ); ?>
		</figure>

		<div class="author-detail media-body">
			<h5 class="author-name fn n">Posted by <?php the_author_posts_link(); ?></h5>
			<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
		</div>
	</div>

<?php endif; ?>