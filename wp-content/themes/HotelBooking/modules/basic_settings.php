<?php 
function fetch_global_settings($field_name){
	global $wpdb;
	$global_settings = $wpdb->prefix . "global_settings";
	$global_settings_sql = mysql_query("select ".$field_name." from $global_settings");
	$global_settings = mysql_fetch_array($global_settings_sql);
	return $global_settings[$field_name];
} function fetch_hotel_info($field_name){
	global $wpdb;
	$hotel_info_table = $wpdb->prefix . "hotel_info_master";
	$hotel_info_sql = mysql_query("select ".$field_name." from $hotel_info_table");
	$hotel_info = mysql_fetch_array($hotel_info_sql);
	return $hotel_info[$field_name];
} function fetch_currency($currency_code){
	global $wpdb;
	$currency_table = $wpdb->prefix . "currency";
	$currency_sql = mysql_query("select currency_symbol from $currency_table where currency_code = '".$currency_code."'");
	$currency_res = mysql_fetch_array($currency_sql);
	return $currency_res['currency_symbol'];
} function display_amount_with_currency($amount,$currency){
	$amt_display = '';
	$position = fetch_global_settings('symbol_position');
	if($position == '1'){
		$amt_display = $currency.$amount;
	} else if($position == '2'){
		$amt_display = $currency.' '.$amount;
	} else if($position == '3'){
		$amt_display = $amount.$currency;
	} else {
		$amt_display = $amount.' '.$currency;
	}
	return $amt_display;
}
function display_currency(){
$currency_code = fetch_global_settings('currency');
$currency = fetch_currency($currency_code);
return $currency;
}
function is_valid_coupon($coupon)
{
	global $wpdb;
	$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
	$couponinfo = $wpdb->get_results($couponsql);
	if($couponinfo)
	{
		foreach($couponinfo as $couponinfoObj)
		{
			$option_value = unserialize($couponinfoObj->option_value);
			foreach($option_value as $key=>$value)
			{
				if($value['couponcode'] == $coupon)
				{
					return true;
				}
			}
		}
	}
	return false;
}
function check_room_type_capacity($room_type_id){
	global $wpdb;
	$room_master = $wpdb->prefix . "room_master";
	$room_type_sql = $wpdb->get_row("select count(*) as total_room from  $room_master where room_status = 'E' and room_type_id = '".$room_type_id."'");
	return $room_type_sql->total_room;
}
function sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$message,$extra=''){
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	// Additional headers
	$headers .= 'To: '.$toEmailName.' <'.$toEmail.'>' . "\r\n";
	$headers .= 'From: '.$fromEmailName.' <'.$fromEmail.'>' . "\r\n";
	wp_mail( $toEmail, $subject, $message, $headers );
}
?>