<?php get_header(); // Loads the header.php template. ?>
    <section class="container" id="main-container">
    	<div class="row">
        	<div class="span8" id="content-wrapper">
				
				<?php get_template_part( 'breadcrumbs' ); // Loads the breadcrumbs.php template. ?>
				
				<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

				<?php get_template_part( 'featured-slider' ); // Loads the featured-slider.php template. ?>

				<?php get_template_part( 'loop' ); // Loads the loop.php template. ?>

				<?php get_template_part( 'author-box' ); // Loads the author-box.php template. ?>

				<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

				<?php if(is_singular() ) comments_template(); // Loads the comments.php template. ?>

			</div>
			<!-- End .span8 #content-wrapper -->

			<div class="span4" id="sidebar-wrapper">
				<div class="row">
				
					<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
							
					<?php get_sidebar( 'secondary' ); // Loads the sidebar-secondary.php template. ?>

					<?php get_sidebar( 'tertiary' ); // Loads the sidebar-tertiary.php template. ?>

				</div>
			</div>
			<!-- End .span4 #sidebar-wrapper -->
		</div>
		<!-- End .row -->
	</section>
	<!-- End #main-container -->

<?php get_footer(); // Loads the footer.php template. ?>