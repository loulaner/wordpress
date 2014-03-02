<?php
define('TEMPL_RESERVATION_MODULE', __("Booking Log",'templatic'));
define('TEMPL_RESERVATION_CURRENT_VERSION', '1.0.0');
define('TEMPL_RESERVATION_LOG_PATH','http://templatic.com/updates/modules/reservation/reservation_change_log.txt');
define('TEMPL_RESERVATION_ZIP_FOLDER_PATH','http://templatic.com/updates/modules/reservation/reservation.zip');
define('TT_RESERVATION_FOLDER','reservation');
define('TT_RESERVATION_MODULES_PATH',TT_MODULES_FOLDER_PATH . TT_RESERVATION_FOLDER.'/');
define ("PLUGIN_DIR_RESERVATION", basename(dirname(__FILE__)));
define ("PLUGIN_URL_RESERVATION", get_template_directory_uri().'/modules/'.PLUGIN_DIR_RESERVATION.'/');
//----------------------------------------------
     //MODULE AUTO UPDATE START//
//----------------------------------------------

function upcoming_transaction_add_dashboard_widgets() {
	wp_add_dashboard_widget('templatic_upcoming_transaction', 'Upcoming Booking Requests', 'upcoming_transaction_dashboard_widget');

	global $wp_meta_boxes;

	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

	$example_widget_backup = array('templatic_upcoming_appointments' => $normal_dashboard['templatic_upcoming_transaction']);
	unset($normal_dashboard['templatic_upcoming_transaction']);

	$sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);

	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
} 
add_action('wp_dashboard_setup', 'upcoming_transaction_add_dashboard_widgets' );
add_action('templ_module_auto_update','templ_module_auto_update_reservation_fun');
function templ_module_auto_update_reservation_fun()
{
	$curversion = TEMPL_RESERVATION_CURRENT_VERSION;
	$liveversion = tmpl_current_framework_version(TEMPL_RESERVATION_LOG_PATH);
	$is_update = templ_is_updated( $curversion, $liveversion);
	if($is_update)
	{
?>
<table border="0" cellpadding="0" cellspacing="0" style="border:0px; padding:10px 0px;">
	<tr>
		<td class="module"><h3><?php echo TEMPL_RESERVATION_MODULE;?></h3></td>
	</tr>
	<tr>
		<td>
			<form method="post"  name="framework_update" id="framework_update">
			<input type="hidden" name="action" value="<?php echo TT_RESERVATION_FOLDER;?>" />
			<input type="hidden" name="zip" value="<?php echo TEMPL_RESERVATION_ZIP_FOLDER_PATH;?>" />
			<input type="hidden" name="log" value="<?php echo TEMPL_RESERVATION_LOG_PATH;?>" />
			<input type="hidden" name="path" value="<?php echo TT_RESERVATION_MODULES_PATH;?>" />
			<?php wp_nonce_field('update-options'); ?>

			<?php echo sprintf(__('<h4>A new version of Manage Booking settings Module is available.</h4>
			<p>This updater will collect a file from the templatic.com server. It will download and extract the files to your current theme&prime;s functions folder. 
			<br />We recommend backing up your theme files before updating. Only upgrade related module files if necessary.
			<br />If you are facing any problem in auto updating the framework, then please download the latest version of the theme from members area and then just overwrite the "<b>%s</b>" folder.
			<br /><br />&rArr; Your version: %s
			<br />&rArr; Current Version: %s </p>','templatic'),TT_RESERVATION_MODULES_PATH,$curversion,$liveversion);?>

			<input type="submit" class="button" value="<?php _e('Update','templatic');?>" onclick="document.getElementById('framework_upgrade_process_span_id').style.display=''" />
			</form>
		</td>
	</tr>
	<tr>
		<td style="border-bottom:5px solid #dedede;">&nbsp;</td>
	</tr>
</table>
<?php
	}
}
//----------------------------------------------
     //MODULE AUTO UPDATE END//
//----------------------------------------------


/////////admin menu settings start////////////////
add_action('templ_admin_menu', 'reservation_add_admin_menu');
function reservation_add_admin_menu()
{
	add_submenu_page('templatic_wp_admin_menu', TEMPL_RESERVATION_MODULE,TEMPL_RESERVATION_MODULE, TEMPL_ACCESS_USER, 'manage_reservation', 'manage_reservation');
}

function manage_reservation()
{
	global $templ_module_path;
	if($_REQUEST['pagetype']=='addedit')
	{
		if($_GET['mod'] == 'transaction'){
			include_once($templ_module_path . 'admin_transaction.php');
		} else {
			include_once($templ_module_path . 'admin_reservation.php');
		}
	}else
	{
		include_once($templ_module_path . 'admin_manage_reservation.php');
	}
}

/////////admin menu settings end////////////////
function title_cmb($title = ''){
	$title_display = '';
	$title_array = array("Mr.","Mrs.","Ms.");
	foreach($title_array as $title_key => $title_value){
		if($title == $title_value){
			$tselected = 'selected';
		} else {
			$tselected = '';
		}
		$title_display .= '<option value="'.$title_value.'" '.$tselected.'>'.$title_value.'</option>';
	}
	return $title_display;
}function status_cmb($status = ''){
	$status_display = '';
	$status_array = array("0"=>"Bulk Action","pending"=>"Pending","confirmed"=>"Confirmed","cancelled"=>"Cancelled");
	foreach($status_array as $status_key => $status_value){
		if($status == $status_key){
			$sselected = 'selected';
		} else {
			$sselected = '';
		}
		$status_display .= '<option value="'.$status_key.'" '.$sselected.'>'.$status_value.'</option>';
	}
	return $status_display;
}
function country_cmb($country = ''){
	global $wpdb;
	$country_table = $wpdb->prefix . "country";
	$country_display = '';
	$country_table_sql = mysql_query("select title from $country_table order by title");
	while($country_table_res = mysql_fetch_array($country_table_sql)){
		if($country_table_res['title'] == $country){
			$yselected = 'selected';
		} else {
			$yselected = '';
		}
		$country_display .= '<option value="'.$country_table_res['title'].'" '.$yselected.'>'.$country_table_res['title'].'</option>';
	}
	return $country_display;
}
function fetch_room_select($booking_id){
	global $wpdb;
	$booking_master_table = $wpdb->prefix . "booking_master";
	$booking_fetch_sql = mysql_query("select room_id from $booking_master_table where booking_id = '".$booking_id."'");
	$booking_res = mysql_fetch_array($booking_fetch_sql);
	$room_array = explode(',',$booking_res['room_id']);
	return $room_array;
}
function fetch_service_select($booking_id){
	global $wpdb;
	$booking_master_table = $wpdb->prefix . "booking_master";
	$booking_service_fetch_sql = mysql_query("select service_id from $booking_master_table where booking_id = '".$booking_id."'");
	$booking_service_res = mysql_fetch_array($booking_service_fetch_sql);
	$service_array = explode(',',$booking_service_res['service_id']);
	return $service_array;
}
function fill_room_detail($room_type_id,$booking_id){
	$room_display = '';
	global $wpdb;
	$room_master = $wpdb->prefix . "room_master";
	$service_master = $wpdb->prefix . "service_master";
	$room_find_sql = mysql_query("select room_id,room_name from $room_master where room_type_id = '".$room_type_id."' and room_status = 'E'");
	$service_find_sql = mysql_query("select service_id,service_name,service_price from $service_master ");
	$room_display .= '<label style="float:left;width:130px;">*&nbsp;Room :</label>';
	$room_count = 0;
	while($room_find_res = mysql_fetch_array($room_find_sql)){
		$room_count ++;
		$room_array = fetch_room_select($booking_id);
		if (in_array($room_find_res["room_id"], $room_array)) {
			$chked = "checked";
		} else {
			$chked = "";
		}
		$room_display .= '<input type="checkbox" value="'.$room_find_res['room_id'].'" name="room_id[]" id="room_id" '.$chked.'>&nbsp;'.$room_find_res['room_name'].'&nbsp;&nbsp;&nbsp;';
		if($room_count > 2){
			$room_display .= '<br /><label style="float:left;width:130px;">&nbsp;</label>';	
			$room_count = 0;
		}
	}
	$room_display .= '<br /><br /><label style="float:left;width:130px;">&nbsp;&nbsp;Services :</label>';
	$service_iarray = fetch_service_select($booking_id);
	while($service_find_res = mysql_fetch_array($service_find_sql)){
		if (in_array($service_find_res["service_id"], $service_iarray)) {
			$schecked = "checked";
		} else {
			$schecked = "";
		}
		$room_display .= '<input type="checkbox" value="'.$service_find_res['service_id'].'" name="service_id[]" id="service_id" '.$schecked.'>&nbsp;'.$service_find_res['service_name'].'&nbsp;('.display_amount_with_currency($service_find_res['service_price'],display_currency()).')&nbsp;&nbsp;';
	}
	return $room_display;
}
function fetch_booking_data($booking_id){
	global $wpdb;
	$booking_master_table = $wpdb->prefix . "booking_master";
	$booking_sql = mysql_query("select * from $booking_master_table where booking_id = '".$booking_id."'");
	$booking_res = mysql_fetch_array($booking_sql);
	return $booking_res;
}
function check_booking_transaction($booking_id){
	global $wpdb;
	$booking_transaction = $wpdb->prefix . "booking_transaction";
	$booking_trans_sql = mysql_query("select booking_id from $booking_transaction where booking_id = '".$booking_id."'");
	if(mysql_num_rows($booking_trans_sql) > 0){
		return false;
	} else {
		return true;
	}
}function check_booking_availability($booking_id){
	global $wpdb;
	$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
	$booking_chk_sql = mysql_query("select booking_id from $booking_check_avilability where booking_id = '".$booking_id."'");
	if(mysql_num_rows($booking_chk_sql) > 0){
		return false;
	} else {
		return true;
	}
}
function upcoming_transaction_dashboard_widget() {
	global $wpdb;
	$upcoming_display = '';
	$booking_master = $wpdb->prefix . "booking_master";
	$booking_personal_info = $wpdb->prefix . "booking_personal_info";
	$booking_log = $wpdb->prefix . "booking_master_log";
	$upcoming_transaction_sql = mysql_query("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer,bm.pnr_no,bm.check_in_date,bm.check_out_date,bm.booking_id,bm.total_price,bm.booking_status,bm.room_type_id,bm.pnr_no from $booking_master bm,$booking_personal_info bp, $booking_log bl where bm.booking_id = bp.booking_id and bm.booking_id = bl.booking_id and (bm.check_in_date <= now() or bm.check_out_date >= now())");
	if(mysql_num_rows($upcoming_transaction_sql) > 0){
		$upcoming_display .= '<table class="widefat"  width="100%" >
			<thead>	
			<tr>
				<th valign="top" align="left">Customer</th>
				<th valign="top" align="left">PNR No.</th>
				<th valign="top" align="left">Room</th>
				<th valign="top" align="left">Check-in date</th>
				<th valign="top" align="left">Check-out date</th>
				<th valign="top" align="left">Amount</th>
				<th valign="top" align="left">Status</th>
			</tr>';   
		while($upcoming_transaction_res = mysql_fetch_array($upcoming_transaction_sql)){
			$upcoming_display .= '<tr>
				<td valign="top" align="left"><a href="'.site_url().'/wp-admin/admin.php?page=manage_reservation&booking_id='.$upcoming_transaction_res['booking_id'].'#option_transaction">'.$upcoming_transaction_res['customer'].'</a></td>
				<td valign="top" align="left">'.$upcoming_transaction_res['pnr_no'].'</td>
				<td valign="top" align="left">'.fecth_room_type_name($upcoming_transaction_res['room_type_id']).'</td>
				<td valign="top" align="left">'.$upcoming_transaction_res['check_in_date'].'</td>
				<td valign="top" align="left">'.$upcoming_transaction_res['check_out_date'].'</td>
				<td valign="top" align="left">'.display_amount_with_currency($upcoming_transaction_res['total_price'],display_currency()).'</td>
				<td valign="top" align="left">';  
			if($upcoming_transaction_res['booking_status'] == 'confirmed') {
				$upcoming_display .= '<span style="color:green;">Confirmed</span>';
			} elseif($upcoming_transaction_res['booking_status'] == 'pending'){ 
				$upcoming_display .= '<span style="color:#FF8000;">Pending</span>';
			}else {
			 	$upcoming_display .= '<span style="color:#ff0000;">Cancelled</span>';	
			}
			$upcoming_display .= '</td></tr>';
		}
		$upcoming_display .= '</thead>	</table>';
	} else {
		$upcoming_display .= '<center><h4>No Booking Log</h4></center>';
	}
   	$upcoming_display .= '<br /><div style="float:right;margin-right:10px;margin-bottom:10px;"><a class="button rbutton" href="'.site_url().'/wp-admin/admin.php?page=manage_reservation">View all Booking Log</a></div><br /><br />';
	echo $upcoming_display;
}
function booking_reject_mail($booking_id) { 
global $wpdb; 
	$booking_personal_info = $wpdb->prefix . "booking_personal_info";
	$templatic_last_booking = $wpdb->get_row("select concat(title,' ',first_name,' ',last_name)as customer_name,email from $booking_personal_info where booking_id ='".$booking_id."'");
	$email_setting = $wpdb->prefix . "email_configuration";
	$templatic_request_mail = $wpdb->get_row("select * from $email_setting");
	$request_email = $templatic_request_mail->cancel_email;
	$cancel="<a href='".get_option('siteurl')."/?ptype=cancel_booking&booking_id=".$booking_id."'>".get_option('siteurl')."/?ptype=cancel_booking&booking_id=".$booking_id."</a>";
	$templatic_booking_list_user = $wpdb->get_row("select * from $email_setting");
	$request_usermail = str_replace('[USER_NAME]',$templatic_last_booking->customer_name,$request_email);
	$regard_content = '<strong>'.fetch_hotel_info('hotel_name').'</strong><br />'.fetch_hotel_info('hotel_street').'<br />'.fetch_hotel_info('hotel_state').', '.fetch_hotel_info('hotel_country');
	$email_info = fetch_hotel_info('contact_hotel_mail');
	$cnt_mail = str_replace('[CONTACT_EMAIL]',$email_info,$request_usermail);
	$request_mail = str_replace('[CANCEL_URL]',$cancel,$cnt_mail);
	$booking_email = str_replace('[ADMIN_NAME]',$regard_content,$request_mail);
	 
	$to = $templatic_last_booking->email;
	$to_name = $templatic_last_booking->customer_name;
	$from = fetch_hotel_info('mail_from');
	$from_email = $templatic_request_mail->user_email;
	$subject = $templatic_request_mail->cancel_email_sub;
	$templatic_booking_message = $booking_email;
	sendEmail($from_email,$from,$to,$to_name,$subject,$templatic_booking_message,$extra='');
}
function booking_success_mail($booking_id) { 
global $wpdb; 
	$booking_personal_info = $wpdb->prefix . "booking_personal_info";
	$templatic_last_booking = $wpdb->get_row("select concat(title,' ',first_name,' ',last_name)as customer_name,email from $booking_personal_info where booking_id ='".$booking_id."'");
	$email_setting = $wpdb->prefix . "email_configuration";
	$templatic_request_mail = $wpdb->get_row("select * from $email_setting");
	$request_email = $templatic_request_mail->active_email;
	$cancel="<a href='".get_option('siteurl')."/?ptype=cancel_booking&booking_id=".$booking_id."'>".get_option('siteurl')."/?ptype=cancel_booking&booking_id=".$booking_id."</a>";
	$templatic_booking_list_user = $wpdb->get_row("select * from $email_setting");
	$request_usermail = str_replace('[USER_NAME]',$templatic_last_booking->customer_name,$request_email);
	$regard_content = '<strong>'.fetch_hotel_info('hotel_name').'</strong><br />'.fetch_hotel_info('hotel_street').'<br />'.fetch_hotel_info('hotel_state').', '.fetch_hotel_info('hotel_country');
	$email_info = fetch_hotel_info('contact_hotel_mail');
	$cnt_mail = str_replace('[CONTACT_EMAIL]',$email_info,$request_usermail);
	$request_mail = str_replace('[CANCEL_URL]',$cancel,$cnt_mail);
	$booking_email = str_replace('[ADMIN_NAME]',$regard_content,$request_mail);
	 
	$to = $templatic_last_booking->email;
	$to_name = $templatic_last_booking->customer_name;
	$from = fetch_hotel_info('mail_from');
	$from_email = $templatic_request_mail->user_email;
	$subject = $templatic_request_mail->active_email_sub;
	$templatic_booking_message = $booking_email;
	sendEmail($from_email,$from,$to,$to_name,$subject,$templatic_booking_message,$extra='');
}
?>