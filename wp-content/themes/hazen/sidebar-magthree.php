
                           <!-- Sidebar Starts Here --> 
                            <div id="sidebar_magthree">



                            
                            
										<?php if ( dynamic_sidebar('magthree') ){
																			} else { ?>
																		<div class="sidebar_widget">
																			
																			<div class="widget widget_categories">
																				<h3 class="widgettitle"><?php _e('Categories', 'Hazen') ?></h3>
																				<ul>
																					<?php wp_list_categories('show_count=0&title_li='); ?>
																				</ul>	
																			</div>
																			
																		</div><!-- /widget -->
																		
																		<div class="sidebar_widget">
																			
																			<div class="widget widget_categories">
																				<h3 class="widgettitle"><?php _e('Archives', 'Hazen') ?></h3>
																				<ul>
																					<?php wp_get_archives('type=monthly'); ?>
																				</ul>
																			</div>
																			
																		</div><!-- /widget -->
																		
																		<div class="sidebar_widget">
																			
																			<div class="widget widget_categories">
																				<h3 class="widgettitle"><?php _e('Blogrolls', 'Hazen') ?></h3>
																				<ul>
																					<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
																				</ul>
																			</div>
																			
																		</div><!-- /widget -->
				
																		
																					
										<?php } ?>                           
                            
                            
                            
                            
                            </div> 
