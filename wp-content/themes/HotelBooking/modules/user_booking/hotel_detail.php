<?php
include_once( 'wp-load.php' );
$room_type = $_REQUEST['room'];
global $room_type;
get_header();

$title = fecth_room_type_name($room_type);
?>
<?php templ_page_title_above(); //page title above action hook?>
	<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/dummy/s3.jpg) no-repeat center top">
		<div class="main_header_in"><div class="post-meta"><h1><?php _e($title,'templatic');?></h1></div>
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
			<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.4.2.js" type="text/javascript" ></script>
			<script src="<?php bloginfo('template_directory'); ?>/js/galleria.js" type="text/javascript" ></script>
			<div id="galleria">
			<?php 
			global $wpdb;
			$room_gallery = $wpdb->prefix . 'room_type_gallery';	
			$room_type_table = $wpdb->prefix . 'room_type_master';
			$room_gallery_list_sql = mysql_query("select * from $room_gallery where room_type_id = '".$room_type."'");
			while($room_gallery_list_res = mysql_fetch_array($room_gallery_list_sql)) {
			$cwupload_dir =  $room_gallery_list_res['file_url'];	
			$list_img_title = $room_gallery_list_res['file_title'];
			if($room_gallery_list_res['alternate_text'] == '') {
				$list_img_alt = $room_gallery_list_res['file_title'];
			}else {
				$list_img_alt = $room_gallery_list_res['alternate_text'];
			}if($room_gallery_list_res['img_description'] == '') {
				$list_img_description = $list_img_title ;
			}else {
				$list_img_description = $room_gallery_list_res['img_description'];
			}	
			echo '<div class="small"><a href="'.$cwupload_dir.'" title="'.$list_img_description.'"><img src="'.templ_thumbimage_filter($cwupload_dir,'&amp;w=150&amp;h=150&amp;zc=1&amp;q=80').'" alt="'.$list_img_alt.'" title="'.$list_img_title.'" /></a></div>';
			}?>
			</div> 
		<?php
			
		$fetch_room_desc_sql = mysql_query("select room_type_description from $room_type_table where room_type_id = '".$room_type."'");
		$fetch_room_desc_res = mysql_fetch_array($fetch_room_desc_sql);
		echo $fetch_room_desc_res['room_type_description'];
		
		
	?>
 </div>
   </div>
</div>
<script type="text/javascript">
    // Load theme
    Galleria.loadTheme('<?php bloginfo('template_directory'); ?>/js/galleria.classic.js');
    // run galleria and add some options
    jQuery('#galleria').galleria({
        image_crop: true, // crop all images to fit
        thumb_crop: true, // crop all thumbnails to fit
        transition: 'fade', // crossfade photos
        transition_speed: 700, // slow down the crossfade
		autoplay: true,
        data_config: function(img) {
            // will extract and return image captions from the source:
            return  {
                title: jQuery(img).parent().next('strong').html(),
                description: jQuery(img).parent().next('strong').next().html()
            };
        },
        extend: function() {
            this.bind(Galleria.IMAGE, function(e) {
                // bind a click event to the active image
                jQuery(e.imageTarget).css('cursor','pointer').click(this.proxy(function() {
                    // open the image in a lightbox
                    this.openLightbox();
                }));
            });
        }
    });
</script>
<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
