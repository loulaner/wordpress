<div class="entry-meta">
	<?php if(options::logic( 'blog_post' , 'enb-next-prev' ) && is_single()){ ?>
	<div class="project-number">
		<?php 

			
			$count_posts = wp_count_posts();
			$published_posts = $count_posts->publish;
			$currentID = get_the_ID();
			
			$currentNumber = Get_Post_Number($currentID);

			$nav = sprintf(__('Project %s of %s','cosmotheme'),'<b>'. $currentNumber .'</b>', '<b>'. $published_posts .'</b>');
			echo $nav;
		?>
		
		<div class="project-controls">
			<?php
				$ppost = get_previous_post();
	            $npost = get_next_post();
	            if( !empty( $ppost ) ){
	                echo '<a class="prev" href="' . get_permalink( $ppost -> ID ) . '" title="'.$ppost -> post_title.'"><span class="prev-project"></span></a>';
	            }

	            if( !empty( $npost ) ){
	                echo '<a class="next" href="' . get_permalink( $npost -> ID ) . '" title="'.$npost -> post_title.'"><span class="next-project"></span></a>';
	            }
            ?>
			
		</div>
	</div>
	<?php } ?>
	<ul>
		<?php if( options::logic( 'general' , 'enb_likes' ) ){ ?>
            
                <?php like::content($post->ID,2,false,'like',$show_label = true); ?>
                <?php like::content($post->ID,2,false,'hate',$show_label = true); ?>
            
        <?php } ?>
		
		<?php
            if (comments_open($post->ID)) {
                $comments_label = __('Replies','cosmotheme');  
                if (options::logic('general', 'fb_comments')) {
        ?>
                    <li >
                    	<i class="replies">
		            		<a href="<?php echo get_comments_link($post->ID); ?>"> 
			        			<em><div><?php  echo $comments_label;  ?></div>
			        				<strong><fb:comments-count href="<?php echo get_permalink($post->ID) ?>"></fb:comments-count>  </strong>
			        			</em>
			        		</a>
		        		</i>
			    	</li>
        <?php
                } else {
                    
                    if(get_comments_number($post->ID) == 1){
                        $comments_label = __('comment','cosmotheme');
                    }
        ?>
                    <li  title="<?php echo get_comments_number($post->ID); echo ' '.$comments_label; ?>">
                    	<i class="replies">
		            		<a href="<?php echo get_comments_link($post->ID); ?>"> 
			        			<em><div><?php  echo $comments_label;  ?></div>
			        				<strong><?php echo get_comments_number($post->ID) ?>   </strong>
			        			</em>
			        		</a>
		        		</i>
			    	</li>
        <?php
                }
            }
        ?> 
		<?php 
            if ( function_exists( 'stats_get_csv' ) ){  
            $views = stats_get_csv( 'postviews' , "&post_id=" . $post -> ID);    
        ?>
        <li class="views">
        	<i class="views">
    			<em>
    				<div>
    					<?php
    						if( (int)$views[0]['views'] == 1) {
				                _e( 'View' , 'cosmotheme');
				            }else{
				                _e( 'Views' , 'cosmotheme' );
				            } 
    					?>
    				</div>
    				<strong><?php echo (int)$views[0]['views']; ?></strong>
    			</em>
    		</i>
    	</li>
        <?php } ?> 
		
		<?php
			if(strlen(post::get_client($post -> ID))){
		?>
				<li>
					<i class="client">
		    			<em><div><?php _e( 'Client' , 'cosmotheme'); ?></div>
		    				<strong><?php echo post::get_client($post -> ID); ?></strong>
		    			</em>
		    		</i>
				</li>
		<?php		
			}
		?>
		

		
		<?php
			if(strlen(post::get_services($post -> ID))){
		?>
				<li>
					
		        	<i class="services">
		    			<em><div><?php _e( 'Services' , 'cosmotheme'); ?></div>
		    				<strong><?php echo post::get_services($post -> ID); ?></strong>
		    			</em>
		    		</i>
					
				</li>
		<?php		
			}
		?>
		
		<?php
			if(strlen(post::get_source($post -> ID))){
		?>
				<li>
					<i class="url">
		    			<em><div><?php _e( 'URL' , 'cosmotheme'); ?></div>
		    				<strong><?php echo link_souce(post::get_source($post -> ID));   ?></strong>
		    			</em>
		    		</i>
				</li>
		<?php		
			}
		?>
		<?php if(options::logic( 'upload' , 'enb_edit_delete' ) && is_user_logged_in() && ($post->post_author == get_current_user_id() ||  current_user_can('administrator') ) && is_numeric(options::get_value( 'upload' , 'post_item_page' ))){ ?> 
            <li class="edit_post" title="<?php _e('Edit post','cosmotheme') ?>">
            	<i class="edit_post">
            		<a href="<?php  echo add_query_arg( 'post', $post->ID, get_page_link(options::get_value( 'upload' , 'post_item_page' ))  ) ;  ?>"  ><?php echo _e('Edit','cosmotheme'); ?></a>
            	</i>
            </li>    
        <?php }   ?>
		<?php if( options::logic( 'upload' , 'enb_edit_delete' )  && is_user_logged_in() && ($post->post_author == get_current_user_id() || current_user_can('administrator'))  ) {  
			$confirm_delete = __('Confirm to delete this post.','cosmotheme');
		?>
		<li class="delete_post" title="<?php _e('Remove post','cosmotheme') ?>">
			<i class="delete_post">
				<a href="javascript:void(0)" onclick="if(confirm('<?php echo $confirm_delete; ?> ')){ removePost('<?php echo $post->ID; ?>','<?php echo home_url() ?>');}" ><?php echo _e('Delete','cosmotheme'); ?></a>
			</i>
		</li>
		<?php  } ?>
		
	</ul>
</div>
<?php
$tags = wp_get_post_terms($post->ID, 'post_tag');

if (!empty($tags)) {
?>
<div class="entry-tags">
	<ul>
		<?php
        foreach ($tags as $tag) {
            $t = get_tag($tag);
            echo '<li><a href="' . get_tag_link($tag) . '" rel="tags">' . $t->name . '</a></li>';
        }
        ?>
		
	</ul>
</div>
    
<?php
}
?>