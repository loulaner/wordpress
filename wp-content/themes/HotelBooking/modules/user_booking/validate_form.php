<?php
session_start();
include_once( 'wp-load.php' );
get_header(); 

?>
<?php templ_page_title_above(); //page title above action hook?>
<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/dummy/s9.jpg) no-repeat center top">
    <div class="main_header_in">	
        <div class="post-meta"><h1><?php _e('Book Your Stay','templatic');?></h1></div>
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
	<script type='text/javascript'>var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dhtmlgoodies_calendar.js"></script>
	<?php 
		$error_validate = 'false';
		$error_msg_stringi = '<strong>Following fields must be corrected</strong><br /><br />';
		if($_POST['side_check_in_date'] == 'Check-In' || $_POST['side_check_in_date'] == ''){
			$error_validate = 'true';
			$error_msg_stringi .= 'Please Enter check in date<br />';
		}if($_POST['side_check_out_date'] == 'Check-Out' || $_POST['side_check_out_date'] == '') {
			$error_validate = 'true';
			$error_msg_stringi .= 'Please Enter check out date<br />';
		} else {
			$error_validate = 'true';
			if($_POST['side_check_in_date'] >= $_POST['side_check_out_date']) {
				$error_msg_stringi .= 'Check out date must be greater than check in date<br />';
			}
		} if($_POST['side_no_rooms'] == '') {
			$error_validate = 'true';
			$error_msg_stringi .= 'Please Select No. Of Rooms<br />';
		} if($_POST['side_adults'] == '') {
			$error_validate = 'true';
			$error_msg_stringi .= 'Please Select Adults<br />';
		}if($_POST['side_room_type'] == '') {
			$error_validate = 'true';
			$error_msg_stringi .= '请选择房间类型<br />';
		} if($_POST['side_check_in_date'] != 'Check-In' && $_POST['side_check_in_date'] != '' && $_POST['side_check_out_date'] != 'Check-Out' && $_POST['side_check_out_date'] != '' && $_POST['side_check_in_date'] < $_POST['side_check_out_date'] && $_POST['side_no_rooms'] != '' && $_POST['side_adults'] != '' && $_POST['side_room_type'] != '') {
			$error_validate = 'false';
		} 
		$_SESSION['side_check_in_date'] = $_POST['side_check_in_date'];
			$_SESSION['side_check_out_date'] = $_POST['side_check_out_date'];
			$_SESSION['side_no_rooms'] = $_POST['side_no_rooms'];
			$_SESSION['side_adults'] = $_POST['side_adults'];
			$_SESSION['side_room_type'] = $_POST['side_room_type'];	
			
		if($error_validate == 'true' ) {
			echo '<p class="error_msg" style="text-align:left;">'.$error_msg_stringi.'</p>
			<form name="minibooking_frm" id="minibooking_frm" action="'.get_option('siteurl').'/?ptype=validate_form" method="post" class="booking_form" >';
			echo widget_user_form_booking('minibooking_frm');
			echo '<input type="submit" name="book_now" id="book_now" value="Book Now"  class="button" /></form>';
		} else {
			
			echo "<script>location.href='".get_option('siteurl')."/?ptype=user_booking';</script>";
		}
			?> 
	 </div>
   </div>
</div>
<!--  CONTENT AREA END -->
</div>
<?php 
get_sidebar(); 
get_footer(); ?>