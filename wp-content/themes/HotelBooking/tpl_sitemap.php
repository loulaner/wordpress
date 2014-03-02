<?php
/*
Template Name: 页面 - 网站地图
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $banner = get_post_meta($post->ID, 'banner', $single = true);	?>
 
 <?php templ_page_title_above(); //page title above action hook?>
 <div class="main_header" style="background:url(<?php if($banner=='') { bloginfo('template_directory'); echo '/images/dummy/s13.jpg'; } else { echo $banner; } ?>)no-repeat center top">
         	<div class="main_header_in">	
           	
           <div class="post-meta"> <?php echo templ_page_title_filter(get_the_title()); //page tilte filter?> </div>
        	</div>
        </div>
  	<div class="main_sepretor"></div>
     <?php templ_page_title_below(); //page title below action hook?>
 

<div id="pages" class="clear" >
<!--  CONTENT AREA START -->
<div  class="<?php templ_content_css();?>" >
<div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
    <div class="post-content">
    
    <?php the_content(); ?>
      <div class="arclist">
        <h3><?php _e('Pages','templatic');?></h3>
        <ul>
          <?php wp_list_pages('title_li='); ?>
        </ul>
      </div>
      <!--/arclist -->
      <div class="arclist">
        <h3><?php _e('Posts','templatic');?></h3>
        <ul>
          <?php $archive_query = new WP_Query('showposts=60');
            while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
          <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
            <?php the_title(); ?>
            </a> <span class="arclist_comment">
            <?php comments_number(__('0 comment','templatic'), __('1 comment','templatic'),__('% Comments','templatic')); ?>
            </span></li>
          <?php endwhile; ?>
        </ul>
      </div>
      <!--/arclist -->
      <div class="arclist">
        <h3><?php _e('Archives','templatic');?></h3>
        <ul>
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
      </div>
      <!--/arclist -->
      <div class="arclist">
        <h3><?php _e('Categories','templatic');?></h3>
        <ul>
          <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>
        </ul>
      </div>
      <!--/arclist -->
      <div class="arclist">
        <h3><?php _e('Meta','templatic');?></h3>
        <ul>
          <li><a href="<?php bloginfo('rdf_url'); ?>" title="RDF/RSS 1.0 feed">
          RDF/<?php _e('RSS','templatic')?> <?php _e('1.0 feed','templatic')?></a></li>
          <li><a href="<?php bloginfo('rss_url'); ?>" title="RSS 0.92 feed"><?php _e('RSS','templatic')?> <?php _e('0.92 feed','templatic')?></a></li>
          <li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0 feed"><?php _e('RSS','templatic')?><?php _e('2.0 feed','templatic')?></a></li>
          <li><a href="<?php bloginfo('atom_url'); ?>" title="Atom feed"><?php _e('Atom feed','templatic')?></a></li>
        </ul>
      </div>
      <!--/arclist -->
    </div>
    <div class="post-footer">
      <?php the_tags(__('<strong>Tags: </strong>','templatic'), ', '); ?>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php endif; ?>


<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>