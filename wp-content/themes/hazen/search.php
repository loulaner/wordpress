<?php
/*
Template Name: Page With No Sidebar
*/
?>
<?php get_header(); ?>

								
                    <!-- Inner Content Section starts here -->
                    <div id="inner_content_section">

                        <!-- Main Content Section starts here -->
                        <div id="main_content_section_search_title"> 
                        
                        	
                        		<h2 class="main_content_section_search_title"><?php _e('Search Results for : ', 'Hazen') ?><?php echo get_search_query(); ?></h2>
                           
                        
                        </div>	
                        <!-- Main Content Section ends here -->                          
                        	             
                        <!-- Main Content Section starts here -->
                        <div id="main_content_section_search">
                

		
                                    <?php if (have_posts()) : ?>
                                    <?php while (have_posts()) : the_post(); ?>	
                                    	<?php 
													$magprorecentthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Hazenthumb', false, '' ); 
													if( !empty($magprorecentthumb) && ( !of_get_option('show_postthumbnail_magthree') || of_get_option('show_postthumbnail_magthree') == 'true' ) ) {
														$excertclassmagthree = 'excerpt_magthree';
													}else {
														$excertclassmagthree = 'excerpt_magthree_full';
													}
										
										?>				
                                        <div class="magthree_left_individual_post">

                                            <?php if( !empty($magprorecentthumb) && ( !of_get_option('show_postthumbnail_magthree') || of_get_option('show_postthumbnail_magthree') == 'true' ) ) :?>
                                            <div class="magthree_featured_image">
                                                <img src="<?php echo $magprorecentthumb[0]; ?>" alt="<?php echo Hazen_get_limited_string(get_the_title(), 40, '...') ?>" />
                                            </div>
                                            <?php endif; ?>
                                            <div class="<?php echo $excertclassmagthree; ?>">
                                                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Hazen' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    								
                                                    <?php if ( function_exists('the_ratings') && (!of_get_option('show_ratings_magthree') || of_get_option('show_ratings_magthree') == 'true')) : ?>
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
                        <!-- Main Content Section ends here -->






                    </div>	
                    <!-- Inner Content Section ends here -->
							
			<?php get_footer(); ?>								
									

							
								
									
