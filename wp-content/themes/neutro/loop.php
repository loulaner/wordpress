	<div <?php ( function_exists('neutro_wrapper_attribute') ? neutro_wrapper_attribute() : '' ) ?>>

		<?php if ( have_posts() ) { ?>

			<?php while ( have_posts() ) { ?>

				<?php the_post(); // Loads the post data. ?>

				<?php hybrid_get_content_template(); // Loads the content template. ?>

			<?php } // End while loop. ?>

		<?php } else { ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

		<?php } // End if check. ?>

	</div>

