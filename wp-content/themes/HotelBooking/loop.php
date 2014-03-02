<?php templ_before_loop(); // before loop hooks?>
<?php if ( have_posts() ) : ?>
<div id="loop" class="<?php if ($_COOKIE['mode'] == 'grid') echo 'grid'; else echo 'list clear'; ?> ">
  <?php 
	$pcount=0; 
	while ( have_posts() ) : the_post(); 
	$pcount++;
	?>
  <div <?php post_class('post'); ?> id="post_<?php the_ID(); ?>">
    
    
    <!--  Post Title Condition for Post Format-->
    <?php if ( has_post_format( 'chat' )){?>
    <h2><a href="<?php the_permalink() ?>">
      <?php the_title(); ?>
      </a></h2>
     <?php }elseif(has_post_format( 'gallery' )){?>
      <h2><a href="<?php the_permalink() ?>">
      <?php the_title(); ?>
      </a></h2>
     <?php }elseif(has_post_format( 'image' )){?>
       <h2><a href="<?php the_permalink() ?>">
      <?php the_title(); ?>
      </a></h2>
     <?php }elseif(has_post_format( 'link' )){?>
       <h2><a href="<?php the_permalink() ?>">
      <?php the_title(); ?>
      </a></h2>
     <?php }elseif(has_post_format( 'video' )){?>
       <h2><a href="<?php the_permalink() ?>">
      <?php the_title(); ?>
      </a></h2>
     <?php }elseif(has_post_format( 'audio' )){?>
       <h2><a href="<?php the_permalink() ?>">
      <?php the_title(); ?>
      </a></h2>
       <?php }else{?>
       <h2><a href="<?php the_permalink() ?>">
      <?php the_title(); ?>
      </a></h2>
       <?php }?>
     <!--  Post Title Condition for Post Format-->
       
    <div class="post-meta">
      <?php if(templ_is_show_listing_author()){?>
      by <span class="post-author"> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="Posts by <?php the_author(); ?>">
      <?php the_author(); ?>
      </a> </span>
      <?php } ?>
      
      <?php if(templ_is_show_listing_category()){?>
    	  in  <span class="post-category">
    <?php the_category(' / '); ?>
    </span>
    <?php } ?>
      
      <?php if(templ_is_show_listing_date()){?>
      on <span class="post-date">
      <?php the_time(templ_get_date_format()) ?>
      </span>
      <?php } ?>
      <?php if(templ_is_show_listing_comment()){?>
      <em>&bull; </em>
      <?php comments_popup_link(__('No Comments','templatic'), __('1 Comment','templatic'), __('% Comments','templatic'), '', __('Comments Closed','templatic')); ?>
      <?php } ?>
      
       <?php if(get_post_format( $post->ID )){
		$format = get_post_format( $post->ID );
		?>
      <em>&bull; </em>
      <a href="<?php echo get_post_format_link($format); ?>" title="<?php esc_attr_e( 'View '. $format, 'templatic' ); ?>"><?php _e( 'More '. $format, 'templatic' ); ?></a>
      <?php } ?>
      <?php if(templ_is_show_listing_tags()){?>
      <em>&bull; </em>
      <?php the_tags('<span class="post-tags">', ', ', '</span>'); ?>
      <?php } ?>
      <?php edit_post_link( __( 'Edit entry','templatic'), '<em>&bull; </em>'); ?>
    </div>
    <?php templ_before_loop_post_content(); // before loop post content hooks?>
    
    <!--  Post Content Condition for Post Format-->
    <?php if ( has_post_format( 'chat' )){?>
    
    <div class="post-content">
      <?php templ_get_listing_content()?>
    </div>
    
    <?php }elseif(has_post_format( 'gallery' )){?>
    
    <div class="post-content">
      <?php 
            if(get_the_post_thumbnail( $post->ID)){?>
      <a href="<?php the_permalink(); ?>"> <?php echo get_the_post_thumbnail( $post->ID, array(150,150),array('class'	=> "alignleft",));?> </a>
      <?php }elseif($post_images = bdw_get_images($post->ID,'thumb')){ 
	  echo $post_images[0];?>
      <a  href="<?php the_permalink(); ?>"> <img class="alignleft" src="<?php echo templ_thumbimage_filter($post_images[0],'&amp;w=150&amp;h=150&amp;zc=1&amp;q=80');?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /> </a>
      <?php
            }?>
    </div>
    
     <?php }elseif(has_post_format( 'image' )){?>
     
     <div class="post-content">
      <?php 
            if(get_the_post_thumbnail( $post->ID)){?>
      <a href="<?php the_permalink(); ?>"> <?php echo get_the_post_thumbnail( $post->ID, array(150,150),array('class'	=> "alignleft",));?> </a>
      <?php }elseif($post_images = bdw_get_images($post->ID,'thumb')){ ?>
      <a  href="<?php the_permalink(); ?>"> <img class="alignleft" src="<?php echo templ_thumbimage_filter($post_images[0],'&amp;w=150&amp;h=150&amp;zc=1&amp;q=80');?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /> </a>
      <?php
            }?>
      <?php templ_get_listing_content()?>
    </div>
    
     <?php }elseif(has_post_format( 'link' )){?>
     
      <div class="post-content">
      <?php templ_get_listing_content()?>
      </div>
      
     <?php }elseif(has_post_format( 'video' )){?>
     
     <div class="post-content">
      <?php templ_get_listing_content()?>
      </div>
      
     <?php }elseif(has_post_format( 'audio' )){?>
     
     <div class="post-content">
      <?php templ_get_listing_content()?>
      </div>
      
     <?php }elseif(has_post_format( 'quote' )){?> 
     
     <div class="post-content">
      <?php templ_get_listing_content()?>
      </div>
      
     <?php }elseif(has_post_format( 'status' )){?> 
     
     <div class="post-content">
      <?php templ_get_listing_content()?>
      </div>
      
      <?php }else{?>
      
       <div class="post-content">
      <?php 
            if(get_the_post_thumbnail( $post->ID)){
			?>
      <a href="<?php the_permalink(); ?>"> <?php echo get_the_post_thumbnail( $post->ID, array(150,150),array('class'	=> "alignleft",));?> </a>
      <?php }elseif($post_images = bdw_get_images($post->ID)){ ?>
      <a  href="<?php the_permalink(); ?>"> <img class="alignleft" src="<?php echo templ_thumbimage_filter($post_images[0],'&amp;w=150&amp;h=150&amp;zc=1&amp;q=80');?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /> </a>
      <?php
            }?>
      <?php templ_get_listing_content()?>
     </div>
      <?php }?>  
    <!--  Post Content Condition for Post Format-->
     <?php templ_after_loop_post_content(); // after loop post content hooks?>
  </div>
        <?php 
		$page_layout = templ_get_page_layout();
		if($page_layout=='full_width'){
					if($pcount==3){
					$pcount=0; 
					?>
                 		<div class="hr clearfix"></div>
                <?php } }
				else if(($page_layout=='3_col_fix' ) || ($page_layout=='3_col_right') ||( $page_layout=='3_col_left')){
					if($pcount==2){
					$pcount=0; 
					?>
                 		<div class="hr clearfix"></div>
                <?php }
				}
				else if ($pcount==2){
					$pcount=0; 
					?>
                <div class="hr clearfix"></div>
                <?php }?>
        
  <?php endwhile; ?>
</div>
<?php else : ?>	
<?php get_search_form(); ?>
<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'templatic' ); ?></p>
<?php endif; ?>
<?php templ_after_loop(); // after loop hooks?>