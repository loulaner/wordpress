<?php
session_start();
include_once( 'wp-load.php' );
get_header();
 
if($_REQUEST['backandedit']) {
	// Do nothing
}else{
	$_SESSION['booking_info'] = array();
}
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
			
			$time_check_in_date = strtotime($_SESSION['side_check_in_date']);
			$time_check_out_date = strtotime($_SESSION['side_check_out_date']);
			$no_rooms = $_SESSION['side_no_rooms'];
			$room_type = $_SESSION['side_room_type'];
			$adults = $_SESSION['side_adults'];
			$days_between = ceil(abs($time_check_out_date - $time_check_in_date) / 86400);
			global $wpdb;
			$additional_price_table = $wpdb->prefix . "additional_price_master";
			$additional_child_table = $wpdb->prefix . "additional_price_child";
			$price_table = $wpdb->prefix . "room_type_price";	
			$r_cnt = 0;
			$a_cnt = 0;
			
			$final_price = 0;
			$add_final_price = 0;
			$afinal_price = 0;
			$check_in_date = $_SESSION['side_check_in_date'];
			$check_out_date = $_SESSION['side_check_out_date'];
			$chk_additional_price_sql = mysql_query("select additional_price_id,from_date,to_date from $additional_price_table where room_type_id = '".$room_type."' and price_status ='Y' and from_date Between '".$check_in_date."' and '".$check_out_date."' and to_date Between '".$check_in_date."' and '".$check_out_date."'");
				if(mysql_num_rows($chk_additional_price_sql) > 0){
					while($chk_additional_price_res = mysql_fetch_array($chk_additional_price_sql)){
						$price_achild_sql = mysql_query("select * from $additional_child_table where additional_price_id = '".$chk_additional_price_res['additional_price_id']."' and person = '".$adults."'");
						$price_achild_res = mysql_fetch_array($price_achild_sql);
						$add_final_price = $days_between * $price_achild_res['additional_price'];
					}		
				}else {
					$price_child_sql = mysql_query("select * from $price_table where room_type_id = '".$room_type."' and person = '".$adults."'");
					$price_child_res = mysql_fetch_array($price_child_sql);
					$afinal_price = $days_between * $price_child_res['price'];
				}
			
			
			$ss = ($final_price + $add_final_price + $afinal_price) * $no_rooms;
			
			
			$room_error_msg = 'false';
			if(check_room_type_capacity($room_type) == 0){
				$room_error_msg = 'true';
				
			}
			
			elseif((check_room_type_capacity($room_type)) == $no_rooms || (check_room_type_capacity($room_type)) > $no_rooms) {
			
				$booking_check_avilability_table = $wpdb->prefix . 'booking_check_avilability';	
				$fetch_booking_schedule_sql = mysql_query("select * from $booking_check_avilability_table where room_type_id = '".$room_type."' and (check_in_date >= '".$check_in_date."' or check_in_date <= '".$check_in_date."') and (check_out_date <= '".$check_out_date."' or check_out_date >='".$check_out_date."')");
				
				if(mysql_num_rows($fetch_booking_schedule_sql) > 0){
					while($fetch_booking_schedule_res = mysql_fetch_array($fetch_booking_schedule_sql)){
						$chk_room_cnt = check_room_type_capacity($room_type) - $fetch_booking_schedule_res['total_room'];
						if($no_rooms == $chk_room_cnt || $no_rooms > $chk_room_cnt){
							$cancel_booking_msg = 'true';
						} else {
							$booking_id[] = $fetch_booking_schedule_res['booking_id'];
							$cancel_booking_msg = 'false';
						}
					} 
				}else {
					$cancel_booking_msg = 'false';
				}
				$room_error_msg = 'false';
			} else {
				$cancel_booking_msg = 'true';
				$room_error_msg = 'false';
			}
			$request_text = '<h3 class="btitle">'.REQUEST_TEXT.'</h3><div class="booking">
				<span><label class="booking_label">'.ROOM_TYPE.'</label> : '.fecth_room_type_name($room_type).' </span>
				<span><label class="booking_label">'.CHECK_IN_TEXT.'</label> : '.date('d F Y',strtotime($check_in_date)).'</span>
				<span><label class="booking_label">'.CHECK_OUT_TEXT.'</label> : '.date('d F Y',strtotime($check_out_date)).'</span>
				<span><label class="booking_label">'.DAYS_TEXT.'</label> : '.$days_between.'</span>
				<span><label class="booking_label">'.NO_ROOMS_TEXT.'</label> : '.$no_rooms.'</span>
				<span><label class="booking_label">'.OCCUPY_TEXT.'</label> : '.$adults.'</span>';
				if($ss != '0') {
					$request_text .= '<span><label class="booking_label">'.ROOM_PRICE_TEXT.'</label> : '.display_amount_with_currency($ss,display_currency()).'</span>';
				} 
				$request_text .= '</div>';
			if($cancel_booking_msg == 'true' && $room_error_msg == 'false'){
				echo '<div class="error_msg">'.fetch_global_settings('not_available_msg').'</div><br />';
				echo $request_text;
			} else if($cancel_booking_msg == 'false' && $room_error_msg == 'false') {
				echo $request_text;
				echo '<form name="booking_frm" id="booking_frm" action="'.get_option('siteurl').'/?ptype=submit_booking" method="post" class="booking_form" >
				<input type="hidden" name="booking_id[]" value="'.$booking_id.'" />
				<input type="hidden" name="check_in_date" value="'.$check_in_date.'" />
				<input type="hidden" name="check_out_date" value="'.$check_out_date.'" />
				<input type="hidden" name="no_rooms" value="'.$no_rooms.'" />
				<input type="hidden" name="room_type" value="'.$room_type.'" />
				<input type="hidden" name="adults" value="'.$adults.'" />';
				echo '<h3 class="btitle">'.PERSONAL_INFO_TEXT.'</h3>';
					personal_info_form('booking_frm');
				echo '<div class="booking_form_display"> <h3 class="btitle">'.SERVICE_COUPON_TEXT.'</h3>
					<div class="bfrl"> <label class="booking_label">'.SERVICE_TEXT.'</label>';
					$s_count = 0;
					$service_master = $wpdb->prefix . "service_master";
					$service_find_sql = mysql_query("select service_id,service_name,service_price from $service_master ");
					while($service_find_res = mysql_fetch_array($service_find_sql)){
						if($_SESSION['booking_info']['service_id'] != ''){
							$service_checked = '';
							$service_value = $_SESSION['booking_info']['service_id'][$s_count];
							if($service_find_res['service_id'] == $service_value){
								$service_checked = 'checked';
							} else {
								$service_checked = '';
							}
							$s_count ++;
						}
						echo '<span class="bfr_service"><input type="checkbox" value="'.$service_find_res['service_id'].'" name="service_id[]" id="service_id_'.$service_find_res['service_id'].'" "'.$service_checked.'" />&nbsp;'.$service_find_res['service_name'].'&nbsp;('.display_amount_with_currency($service_find_res['service_price'],display_currency()).')</span>';
					}
	echo '</div>' ; 
					if(get_option('is_allow_coupon_code')){
						echo '<h3 class="btitle">'.COUPON_CODE_TITLE_TEXT.'</h3> 
						  <div class="booking_form_display clearfix">
							<label class="booking_label">'.PRO_ADD_COUPON_TEXT.' : </label>
							<input type="text" name="booking_add_coupon" id="booking_add_coupon" class="textfield" value="'.esc_attr(stripslashes($booking_add_coupon)).'" />
							<span class="note">'.COUPON_NOTE_TEXT.'</span>
						</div>';
						
					}
				echo '</div>
				<input type="hidden" name="payble_amount" id="payble_amount" value="'.$ss.'" />	
				<input type="submit" name="book_now" id="book_now" value="Book Now"  class="button" />
				</form>	';
			} else if($room_error_msg == 'true') {
				echo '<p class="error_msg">There is no room available in '.fecth_room_type_name($room_type).'</p>';
				echo $request_text;
			} else {
				// Do nothing
			}
		
	?> 
	 </div>
   </div>
</div>
<!--  CONTENT AREA END -->
</div>
<?php
$validation_info = array();
 foreach($form_fields as $key=>$val)
			{			
				$str = ''; $fval = '';
				$field_val = $key.'_val';
				$validation_info[] = array(
											   'title'	=> $val['title'],
											   'name'	=> $key,
											   'espan'	=> $key.'_error',
											   'type'	=> $val['type'],
											   'text'	=> $val['text'],
											   'validation_type'	=> $val['validation_type']);
			}	
include_once(TEMPL_USER_BOOKING_FOLDER . 'submition_validation.php');
get_sidebar(); 
get_footer(); ?>