<?php get_header(); ?>

								
			<?php
							
								if ( of_get_option('homepage_layout') == 'magthree' ) {
									$homelayout = 'magthree';
								} elseif ( of_get_option('homepage_layout') == 'magfour' ) {
									$homelayout = 'magfour';
								} else {
									$homelayout = 'standard';
								}
							
								get_template_part( 'single', $homelayout );
							
							
			?>		


                    
           			<?php get_footer(); ?>
							
								
									

							
								
									
