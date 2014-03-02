                            <?php 
								if ( of_get_option('magpro_slider') ) {
									$dslider = of_get_option('magpro_slider');
								} else {
									$dslider = 'cheader';
								}
								get_template_part( 'slider', $dslider ); 
							?> 