<?php get_header(); ?>
<?php
global $current_user;
if(isset($_GET['author_name'])) :
	$curauth = get_userdatabylogin($author_name);
else :
	$curauth = get_userdata(intval($author));
endif;
?>

<?php templ_page_title_above(); //page title above action hook?>
<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/dummy/s3.jpg) no-repeat center top">
         	<div class="main_header_in">	
           	
           <div class="post-meta"> <h1><?php echo $curauth->display_name;?></h1> </div>
        	</div>
        </div>
  	<div class="main_sepretor"></div>
     <?php templ_page_title_below(); //page title below action hook?>

 

<div id="pages" class="clear" >
<div  class="<?php templ_content_css();?>" >
<!--  CONTENT AREA START -->

<?php
global $current_user;
if(isset($_GET['author_name'])) :
	$curauth = get_userdatabylogin($author_name);
else :
	$curauth = get_userdata(intval($author));
endif;
?>
<?php templ_page_title_above(); //page title above action hook?>

<a href="javascript: void(0);" id="mode"<?php if ($_COOKIE['mode'] == 'grid') echo ' class="flip"'; ?>></a> 

<?php //empl_page_title_below(); //page title below action hook?>

<?php get_template_part('loop'); ?>
<?php get_template_part('pagination'); ?>

<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>