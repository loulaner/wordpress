<?php get_header(); ?>

<?php templ_page_title_above(); //page title above action hook?>
	 
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $banner = get_post_meta($post->ID, 'banner', $single = true);	?>
      
	<div class="main_header" style="background:url(<?php if($banner=='') { bloginfo('template_directory'); echo '/images/dummy/s4.jpg'; } else { echo $banner; } ?>) no-repeat center top">
         	<div class="main_header_in">	
           	
           <div class="post-meta"> <?php echo templ_page_title_filter(get_the_title()); //page tilte filter?> </div>
        	</div>
        </div>
  	<div class="main_sepretor"></div>
     <?php templ_page_title_below(); //page title below action hook?>


<div id="pages" class="clear" >
<div  class="<?php templ_content_css();?>" >
<!--  CONTENT AREA START -->

<div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
    
    <div class="post-content">
      <?php the_content(); ?>
    </div>
   </div>
</div>
<?php endwhile; ?>
<?php endif; ?>

</div>
<!--  CONTENT AREA END -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>