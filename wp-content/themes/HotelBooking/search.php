<?php get_header(); ?>


 <?php templ_page_title_above(); //page title above action hook?>

<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/dummy/s5.jpg) no-repeat center top">
    <div class="main_header_in">	
           	
           <div class="post-meta"> 
           
           <?php ob_start(); // don't remove this code?>
  <?php if($_REQUEST['catdrop']) _e('Search Result for category','templatic'); elseif($_REQUEST['todate'] || $_REQUEST['frmdate']) _e('Search Result for date','templatic'); elseif($_REQUEST['articleauthor']) _e('Search Result for author','templatic'); else _e('Search Result for ','templatic');?>
  <?php the_search_query(); ?>
  <?php
        $page_title = ob_get_contents(); // don't remove this code
		ob_end_clean(); // don't remove this code
		?>
  <?php echo templ_page_title_filter($page_title); //page tilte filter?> 
  
   
          
          </div>
        </div>
    </div>
    <div class="main_sepretor"></div>
           
<?php templ_page_title_below(); //page title below action hook?>

 


<div id="pages" class="clear" >
<div  class="<?php templ_content_css();?>" >
<!--  CONTENT AREA START -->


<?php if ( have_posts() ) : ?>

<a href="javascript: void(0);" id="mode"<?php if ($_COOKIE['mode'] == 'grid') echo ' class="flip"'; ?>></a> 


<?php templ_page_title_above(); //page title above action hook?>

 
<?php get_template_part('loop'); ?>
<?php else : ?>

 
<div class="entry">
  <div class="single clear">
    <div class="post-content">
       		<?php get_search_form(); ?> 
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'templatic' ); ?></p>
            
            
            <div class="arclist">
        <h3><?php _e('Archives','templatic');?></h3>
        <ul>
          <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
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
            
     </div>
  </div>
</div>
<?php endif; ?>
<?php get_template_part('pagination'); ?>


<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>