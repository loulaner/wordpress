<?php
/*
Template Name: 页面 - 归档
*/
?>
<?php get_header(); ?> 


<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $banner = get_post_meta($post->ID, 'banner', $single = true);	?>

<?php templ_page_title_above(); //page title above action hook?>
<div class="main_header" style="background:url(<?php if($banner=='') { bloginfo('template_directory'); echo '/images/dummy/s8.jpg'; } else { echo $banner; } ?>)no-repeat center top">
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
      <?php endwhile; ?>
      <?php endif; ?>
      
       <div class="post-content">
    	 <?php the_content(); ?>
    </div>
      
      
      <?php
        global $wpdb;
		$cdate = date('Y-m-d H:i:s');
        $years = $wpdb->get_results("SELECT DISTINCT MONTH(post_date) AS month, YEAR(post_date) as year FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= \"$cdate\" and post_type = 'post' ORDER BY post_date DESC");
	if($years)
		{
			foreach($years as $years_obj)
			{
				$year = $years_obj->year;	
				$month = $years_obj->month;
				?>
      <?php query_posts("showposts=1000&year=$year&monthnum=$month"); ?>
      <div class="arclist">
        <h3> <?php echo  date('F', mktime(0,0,0,$month,1)).'-'. $year; ?> </h3>
        <ul>
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <li> <a href="<?php the_permalink() ?>">
            <?php the_title(); ?>
            </a> - <span class="arclist_date">
            <?php the_time('m月d日 ') ?>
            </span> </li>
          <?php endwhile; endif; ?>
        </ul>
      </div>
      <?php
			}
		}
		 ?>
    </div>
  </div>
</div>



<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>