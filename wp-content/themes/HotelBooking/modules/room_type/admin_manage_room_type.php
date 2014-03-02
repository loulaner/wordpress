<?php
include 'tab_header.php';
global $wpdb;
/* -------------------------------------------------------------- Room Type BOF -------------------------------------------------------------------- */
$room_type_table = $wpdb->prefix . "room_type_master";
$price_table = $wpdb->prefix . "room_type_price";
$room_table = $wpdb->prefix . "room_master";
$room_gallery_table = $wpdb->prefix . "room_type_gallery";
$additional_price_master = $wpdb->prefix . "additional_price_master";
$additional_child_table = $wpdb->prefix . "additional_price_child";
$wupload_dir =  DIR_WS_GALLERY_PATH;
if($_REQUEST['pagetype'] == 'delete' && $_REQUEST['room_type_id'] != '')
{
	$wpdb->query("DELETE from $room_type_table where room_type_id = '".$_REQUEST['room_type_id']."'");
	$wpdb->query("DELETE from $price_table where room_type_id = '".$_REQUEST['room_type_id']."'");
	$wpdb->query("DELETE from $room_table where room_type_id = '".$_REQUEST['room_type_id']."'");
	$wpdb->query("DELETE from $room_gallery_table where room_type_id = '".$_REQUEST['room_type_id']."'");
	$room_price_sql = mysql_query("select additional_price_id from $additional_price_master where room_type_id = '".$_REQUEST['room_type_id']."'");
	while($room_price_res = mysql_fetch_array($room_price_sql)){
		$wpdb->query("DELETE from $additional_child_table where additional_price_id = '".$room_price_res['additional_price_id']."'");
	}
	$wpdb->query("DELETE from $additional_price_master where room_type_id = '".$_REQUEST['room_type_id']."'");
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'" method=get name="room_type_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="msg" value="delsuccess"></form>';
	echo '<script>document.room_type_success.submit();</script>';
	exit;
}

?>
<script type="text/javascript" src="<?php echo PLUGIN_URL_ROOM;?>js/manage_room.js"></script>
<link rel="stylesheet" href="<?php echo PLUGIN_URL_ROOM;?>css/style.css">
<div class="block" id="option_display_room_type">
<?php 
	if($_GET['page_type'] == 'add_room_type') {
			include_once("admin_room_type.php");
		} else {
	include_once("manage_room_type.php");
	}?>
</div> 
<?php /* ------------------------------------------------------------------------ Room Type EOF ------------------------------------------------------------------- */

/* ------------------------------------------------------------------------------ Room Type Price BOF ------------------------------------------------------------- */ 
?>
<div class="block" id="option_display_room_price">
	<?php  if($_GET['price_page_type'] == 'add_price') {
			include_once("admin_room_type_price.php");
		} else {
			include_once("manage_additional_price.php");
	}?>
</div> 
<?php 


/* Delete Price BOF */
if($_REQUEST['pagetype'] == 'deleteprice' && $_REQUEST['additional_price_id'] != '') {
	$wpdb->query("DELETE from $additional_child_table where additional_price_id = '".$_REQUEST['additional_price_id']."'");
	$wpdb->query("DELETE from $additional_price_master where additional_price_id = '".$_REQUEST['additional_price_id']."'");
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_room_price" method=get name="room_type_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="addeditmsg" value="delsuccess"></form>';
	echo '<script>document.room_type_success.submit();</script>';
	exit;
}
/* Update Status Reservation Record BOF */
if($_REQUEST['pagetype'] == 'ch_price_status' && $_REQUEST['additional_price_id'] != '' )
{
	foreach($_REQUEST['additional_price_id'] as $akey => $avalue) {
		if($_REQUEST['price_add_status'] == 'delete'){
			$wpdb->query("DELETE from $additional_child_table where additional_price_id = '".$avalue."'");
			$wpdb->query("DELETE from $additional_price_master where additional_price_id = '".$avalue."'");
			$msg_type = "delsuccess";
		} else {
			$wpdb->query("update $additional_price_master set price_status = '".$_REQUEST['price_add_status']."' where additional_price_id = '".$avalue."'");
			$msg_type = "statussuccess";
		}
	}
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_room_price" method=get name="room_type_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="msg" value="'.$msg_type.'"></form>';
	echo '<script>document.room_type_success.submit();</script>';
	exit;
}
/* Update Status Reservation Record EOF */
/* Delete Price EOF */ 


/* ----------------------------------------------------------------- Room Type Price EOF ----------------------------------------------------*/
/* ----------------------------------------------------------------- custom field BOF ----------------------------------------------------*/
echo '<div class="block" id="option_display_booking_settings">';
	if($_GET['field_page_type'] == 'add_field') {
		include( 'admin_custom_fields.php' ); 	
	} else {
		include( 'admin_manage_custom_fields.php' ); 
	}
echo '</div>';
/* ----------------------------------------------------------------- custom field EOF ----------------------------------------------------*/
/* ----------------------------------------------------------------- Service BOF ----------------------------------------------------*/
echo '<div class="block" id="option_display_service">';
	if($_GET['service_page_type'] == 'add_service') {
		include( 'admin_service.php' ); 	
	} else {
		include( 'admin_manage_service.php' ); 
	}
echo '</div>';
/* ----------------------------------------------------------------- Service EOF ----------------------------------------------------*/
/* ----------------------------------------------------------------- Gallery BOF ----------------------------------------------------*/
echo '<div class="block" id="option_display_room_gallery">';
	if($_GET['gallery_page_type'] == 'add_gallery') {
		include( 'admin_room_gallery.php' ); 	
	} else {
		include( 'admin_manage_room_gallery.php' ); 
	}
echo '</div>';
/* ----------------------------------------------------------------- Gallery EOF ----------------------------------------------------*/
/* ----------------------------------------------------------------- Room BOF ----------------------------------------------------*/
echo '<div class="block" id="option_display_room">';
	if($_GET['room_page_type'] == 'add_room') {
		include( 'admin_room.php' ); 	
	} else {
		include( 'admin_manage_room.php' ); 
	}
echo '</div>';
/* ----------------------------------------------------------------- Room EOF ----------------------------------------------------*/
include TT_ADMIN_TPL_PATH.'footer.php';?>