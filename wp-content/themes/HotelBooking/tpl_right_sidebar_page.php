<?php
/*
Template Name: 页面 - 右侧边栏
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $banner = get_post_meta($post->ID, 'banner', $single = true);	?>

<?php templ_page_title_above(); //page title above action hook?>
<div class="main_header" style="background:url(<?php if($banner=='') { bloginfo('template_directory'); echo '/images/dummy/s11.jpg'; } else { echo $banner; } ?>)no-repeat center top">
         	<div class="main_header_in">	
           	
           <div class="post-meta"> <?php echo templ_page_title_filter(get_the_title()); //page tilte filter?> </div>
        	</div>
        </div>
  	<div class="main_sepretor"></div>
     <?php templ_page_title_below(); //page title below action hook?>

<!-- Content  2 column - Right Sidebar  -->
<div id="pages" class="clear right_page_template"  >
<div class="content left">
  <?php if (function_exists('dynamic_sidebar')){ dynamic_sidebar('page_content_above'); }?>
  <div class="entry">
  
     <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
      <div class="post-content">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>
<!-- /Content -->
<?php endwhile; ?>
<?php endif; ?>
<div class="sidebar right" >
  <?php if (function_exists('dynamic_sidebar')){ dynamic_sidebar('sidebar1');}?>
</div>
<!-- sidebar #end -->
<!--Page 2 column - Right Sidebar #end  -->
<?php get_footer(); ?>
