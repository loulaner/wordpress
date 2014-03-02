<?php
/*
Template Name: 页面 - 房间
*/
?>
<?php
include_once( 'wp-load.php' );
get_header();
$title = 'Rooms';
?>
<?php templ_page_title_above(); //page title above action hook?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $banner = get_post_meta($post->ID, 'banner', $single = true);	?>

<?php endwhile; ?>
<?php endif; ?>

<div class="main_header" style="background:url(<?php if($banner=='') { bloginfo('template_directory'); echo '/images/dummy/s4.jpg'; } else { echo $banner; } ?>) no-repeat center top">
    <div class="main_header_in">	
           	
           <div class="post-meta"><h1><?php _e($title,'templatic');?></h1></div>
        </div>
    </div>
    <div class="main_sepretor"></div>
<?php templ_page_title_below(); //page title below action hook?>

<div id="pages" class="clear">

 
<div  class="<?php templ_content_css();?>" >
<!--  CONTENT AREA START -->
<div class="entry">
	<div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
		<div class="post-content">
			<?php
			global $wpdb;
			$room_gallery = $wpdb->prefix . 'room_type_gallery';	
			$room_type_table = $wpdb->prefix . 'room_type_master';	
			$room_list_sql = mysql_query("select room_type_description,room_type_id,room_type_name from $room_type_table ");
			while($room_list_res = mysql_fetch_array($room_list_sql)) {
				$room_gallery_sql = mysql_query("select * from $room_gallery where room_type_id = '".$room_list_res['room_type_id']."'");
				$room_gallery_res = mysql_fetch_array($room_gallery_sql);
				$front_cwupload_dir =  $room_gallery_res['file_url'];	
				$front_img_title = $room_gallery_res['file_title'];
				if($room_gallery_res['alternate_text'] == '') {
					$front_img_alt = $room_gallery_res['file_title'];
				}else {
					$front_img_alt = $room_gallery_res['alternate_text'];
				}if($room_gallery_res['img_description'] == '') {
					$front_img_description = $front_img_title;
				}else {
					$front_img_description = $room_gallery_res['img_description'];
				}	
				echo '<div class="roomtype" >
				
				<div class="divimg"><a href="'.get_option('siteurl').'/?ptype=hotel_detail&room='.$room_list_res['room_type_id'].'"><img src="'.templ_thumbimage_filter($front_cwupload_dir,'&amp;w=150&amp;h=150&amp;zc=1&amp;q=80').'" alt="'.$front_img_alt.'" title="'.$front_img_title.'" ></a></div>
				<div class="divdesc"><h3><a href="'.get_option('siteurl').'/?ptype=hotel_detail&room='.$room_list_res['room_type_id'].'">'.$room_list_res['room_type_name'].'</a></h3> '.tep_word_trim($room_list_res['room_type_description'],50).'&nbsp;&nbsp;<a class="more_link" href="'.get_option('siteurl').'/?ptype=hotel_detail&room='.$room_list_res['room_type_id'].'">Read more &raquo;</a></div></div>';
			}
			?>
		</div>
	</div>
</div>
<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>