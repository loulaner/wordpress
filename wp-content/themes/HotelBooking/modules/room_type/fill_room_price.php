<?php 
$file = dirname(__FILE__);
$file = substr($file,0,stripos($file, "wp-content"));
require($file . "/wp-load.php");
$room_type_id = $_REQUEST['room_type_id'];
global $wpdb;
$room_price_master = $wpdb->prefix . "room_type_price";
$additional_price_master = $wpdb->prefix . "additional_price_master";
$additional_child_table = $wpdb->prefix . "additional_price_child";
$room_price_sql = mysql_query("select person,price from $room_price_master where room_type_id = '".$room_type_id."'");
echo '<strong>'.fecth_room_type_name($room_type_id).'</strong>:<br /><br /><table width="100%" cellspacing="2" cellpadding="6" border="0" class="widefat post fixed">';
while($room_price_res = mysql_fetch_array($room_price_sql)){
	$price_person = '';
	if($room_price_res['person'] == '1'){
		$price_person = 'person';
	} else {
		$price_person = 'persons';
	}
	$additional_price_sql = mysql_query("select ac.additional_price from $additional_price_master am,$additional_child_table ac where am.additional_price_id = ac.additional_price_id and am.room_type_id = '".$room_type_id."' and ac.person = '".$room_price_res['person']."'");
	if(mysql_num_rows($additional_price_sql) > 0){
		$add_res = mysql_fetch_array($additional_price_sql);
		$price = $add_res['additional_price'];
	}else {
		$price = $room_price_res['price'];
	}
	echo '<tr>
			<td align="left" valign="top"  style="width:80px;border:none;"><strong>'.$room_price_res['person'].'&nbsp;'.$price_person.' :</strong></td>
			<td align="left" valign="top"  style="width:50px;border:none;">Old Price :</td>
			<td align="left" valign="top"  style="width:120px;border:none;"><input type="text" value="'.$price.'" name="total_price[]" id="total_price" readonly style="width:100px;"><input type="hidden" value="'.$room_price_res['person'].'" name="person[]" id="person" readonly style="width:100px;"></td>
			<td align="left" valign="top"  style="width:60px;border:none;">New Price :</td>
			<td align="left" valign="top"  style="width:120px;border:none;"><input type="text" value="'.$price.'" name="new_total_price[]" id="new_total_price" style="width:100px;"></td>
		</tr>';
}
echo '</table>';
?>