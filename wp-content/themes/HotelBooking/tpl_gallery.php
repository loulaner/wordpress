<?php
/*
Template Name: 页面 - 相册
*/
?>
<?php
add_action('wp_head','templ_header_tpl_gallery');
function templ_header_tpl_gallery()
{
	?>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <script type="text/javascript">
   <!--
   var $n = jQuery.noConflict();
        $n(document).ready(function() {    
            $n("a[rel=example_group]").fancybox({
                'transitionIn'		: 'none',
                'transitionOut'		: 'none',
                'titlePosition' 	: 'over',
                'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                    return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                }
            });    
        });
		//-->
    </script> 
    <?php
}
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $banner = get_post_meta($post->ID, 'banner', $single = true);	
$post_large = bdw_get_images(get_the_ID(),'large');
$post_images = bdw_get_images(get_the_ID(),'thumb'); 
?>

<?php templ_page_title_above(); //page title above action hook?>
<div class="main_header" style="background:url(<?php if($banner=='') { bloginfo('template_directory'); echo '/images/dummy/s10.jpg'; } else { echo $banner; } ?>)no-repeat center top">
         	<div class="main_header_in">	
           	
           <div class="post-meta"> <?php echo templ_page_title_filter(get_the_title()); //page tilte filter?> </div>
        	</div>
        </div>
  	<div class="main_sepretor"></div>
     <?php templ_page_title_below(); //page title below action hook?>

<div id="pages" class="clear"  >
<div  class="<?php templ_content_css();?>" >
<!--  CONTENT AREA START -->

 

<div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
   
    <div class="post-content">
      <?php the_content(); ?>
      <ul class="page_gallery">
        <?php
		if(count($post_images))
		{
			for($im=0;$im<count($post_images);$im++)
			{
				if($post_images[$im])
				{
				?>
				<li> <a  href="<?php echo $post_large[$im];?>" rel="example_group"  > <img class="left" src="<?php echo $post_images[$im];?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" style="height:150px;"  />  <span class="gallery_zoom"></span> </a></li>
				<?php
				}
			}
		}
			?>
      </ul>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php endif; ?>


<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>