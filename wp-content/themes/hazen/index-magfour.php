

								
                    <!-- Inner Content Section starts here -->
                    <div id="inner_content_section">

                        
                        	             
                        <!-- Main Content Section starts here -->
                        <div id="main_content_section_magthree">
                

                                    <!--Right column starts here-->					
                                    <div id="magfour_right">

                                        <?php get_sidebar('magthree'); ?>
                                    
                                    </div>	
                                    <!--Right column ends here--> 

                                    <!--Left column starts here-->
                                    <div id="magfour_left">			
                                    <?php if (have_posts()) : ?>
                                    <?php while (have_posts()) : the_post(); ?>	
                                    	<?php 
													$magprorecentthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Hazenthumb', false, '' ); 
													if( !empty($magprorecentthumb) && ( !of_get_option('show_postthumbnail_magfour') || of_get_option('show_postthumbnail_magfour') == 'true' ) ){
														$excertclassmagthree = 'excerpt_magthree';
													}else {
														$excertclassmagthree = 'excerpt_magthree_full';
													}
										
										?>				
                                        <div class="magthree_left_individual_post">

                                            <?php if( !empty($magprorecentthumb) && ( !of_get_option('show_postthumbnail_magfour') || of_get_option('show_postthumbnail_magfour') == 'true' ) ) :?>
                                            <div class="magthree_featured_image">
                                                <img src="<?php echo $magprorecentthumb[0]; ?>" alt="<?php echo Hazen_get_limited_string(get_the_title(), 40, '...') ?>" />
                                            </div>
                                            <?php endif; ?>
                                            <div class="<?php echo $excertclassmagthree; ?>">
                                                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Hazen' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    								
                                                    <?php if ( function_exists('the_ratings') && (!of_get_option('show_ratings_magfour') || of_get_option('show_ratings_magfour') == 'true')) : ?>
                                                    <div class="metadatamagthreeratings">
													<?php the_ratings(); ?>
                                                    </div>
                    								<?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
												<?php 
													$next_page = get_next_posts_link(__('Previous', 'Hazen')); 
													$prev_pages = get_previous_posts_link(__('Next', 'Hazen'));
													if(!empty($next_page) || !empty($prev_pages)) :
													?>
													<div class="pagination">
														<?php if(!function_exists('wp_pagenavi')) : ?>
														<div class="al"><?php echo $next_page; ?></div>
														<div class="ar"><?php echo $prev_pages; ?></div>
														<?php else : wp_pagenavi(); endif; ?>
													</div><!-- /pagination -->
													<?php endif; ?>
													
												<?php else : ?>
													<div class="nopost">
														<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'Hazen') ?></p>
													 </div><!-- /nopost -->
												<?php endif; ?>
                                    </div>
                                    <!--Left column ends here--> 
                                    
                                                  				

                
                
                        </div>	
                        <!-- Main Content Section ends here -->

                        <!-- Sidebar Section starts here -->
                        <?php get_sidebar(); ?> 
                        <!-- Sidebar Section ends here -->



                    </div>	
                    <!-- Inner Content Section ends here -->
							
								
									
