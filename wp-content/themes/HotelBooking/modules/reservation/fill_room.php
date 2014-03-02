<?php 
$file = dirname(__FILE__);
$file = substr($file,0,stripos($file, "wp-content"));
require($file . "/wp-load.php");
$room_type_id = $_REQUEST['room_type_id'];
$booking_id = $_REQUEST['booking_id'];
global $wpdb;
$room_master = $wpdb->prefix . "room_master";
$service_master = $wpdb->prefix . "service_master";
$room_find_sql = mysql_query("select room_id,room_name from $room_master where room_type_id = '".$room_type_id."' and room_status = 'E'");
$service_find_sql = mysql_query("select service_id,service_name,service_price from $service_master ");
echo '<label style="float:left;width:125px;">*&nbsp;Room :</label>';
$room_count = 0;
while($room_find_res = mysql_fetch_array($room_find_sql)){
	$room_count ++;
	$room_array = fetch_room_select($booking_id);
	if (in_array($room_find_res["room_id"], $room_array)) {
		$chked = "checked";
	} else {
		$chked = "";
	} echo '<input type="checkbox" value="'.$room_find_res['room_id'].'" name="room_id[]" id="room_id" '.$chked.'>&nbsp;'.$room_find_res['room_name'].'&nbsp;&nbsp;&nbsp;';
	if($room_count > 2){
		echo '<br /><label style="float:left;width:125px;">&nbsp;</label>';	
		$room_count = 0;
	}
}
echo '<br /><br /><label style="float:left;width:125px;">&nbsp;&nbsp;Services :</label>';
$service_iarray = fetch_service_select($booking_id);
$service_count = 0;
while($service_find_res = mysql_fetch_array($service_find_sql)){
	$service_count ++;
	if (in_array($service_find_res["service_id"], $service_iarray)) {
		$schecked = "checked";
	} else {
		$schecked = "";
	} echo '<input type="checkbox" value="'.$service_find_res['service_id'].'" name="service_id[]" id="service_id" '.$schecked.'>&nbsp;'.$service_find_res['service_name'].'&nbsp;('.display_amount_with_currency($service_find_res['service_price'],display_currency()).')&nbsp;&nbsp;';
	if($service_count > 2){
		echo '<br /><label style="float:left;width:125px;">&nbsp;</label>';	
		$service_count = 0;
	}
	
}
?>