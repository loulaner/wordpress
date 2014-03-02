<?php 
/* Update Query BOF */
global $wpdb;
$global_settings = $wpdb->prefix . "global_settings";
if(isset($_GET['pagetype']) && $_GET['pagetype'] == 'update_notificaition'){
	global $wpdb;
	$booking_success_msg = stripslashes($_POST['booking_success_msg']);
	$cash_success_msg = stripslashes($_POST['cash_success_msg']);
	$not_available_msg = stripslashes($_POST['not_available_msg']);
	$update_settings = "update $global_settings set booking_success_msg = '".addslashes($booking_success_msg)."',cash_success_msg = '".addslashes($cash_success_msg)."',not_available_msg = '".addslashes($not_available_msg)."' where setting_id = '".$_POST['setting_id']."'" ;
	$wpdb->query($update_settings);
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#notification" method=get name="notification_success">
	<input type=hidden name="page" value="manage_settings"><input type=hidden name="msg" value="notificationsuccess"></form>';
	echo '<script>document.notification_success.submit();</script>';
	exit;
}	
/* Update Query EOF */

$fetch_global_settings_sql = mysql_query("select setting_id,booking_success_msg,not_available_msg,cash_success_msg from $global_settings");
$fetch_global_settings = mysql_fetch_array($fetch_global_settings_sql); ?>
<form name="frm_settings" id="frm_settings" action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_settings&pagetype=update_notificaition" method="post" onsubmit="return global_setting();">
<h3><?php _e('Notification','templatic');?></h3>
<div class="btn_divright" ><input type="submit" name="submit" value="<?php _e('Save all changes','templatic');?>" class="button-framework-imp"></div>
<p><?php 	_e('Edit notification messages from here. These messages will be shown in website.','templatic');	?> </p>
<?php if($_REQUEST['msg']=='notificationsuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	 <?php 	_e('Notification Successfully Updated.','templatic');	?>
	</div>
<?php }?>

<input type="hidden" name="setting_id" id="setting_id" value="<?php echo $fetch_global_settings['setting_id'];?>">

	<label class="setting_lbl"><?php _e('Booking Success Message','templatic');?></label>
	<br /><textarea name="booking_success_msg" id="booking_success_msg"><?php echo $fetch_global_settings['booking_success_msg'];?></textarea><p><?php _e('This message is displayed when the customer submits the booking form successfully.','templatic');?></p><br />
	<label class="setting_lbl"><?php _e('Pay Cash on Arrival Message','templatic');?></label><br /><textarea name="cash_success_msg" id="cash_success_msg"><?php echo $fetch_global_settings['cash_success_msg'];?></textarea><p><?php _e('This message is displayed when the customer selects "Pay Cash on Arrival" method.','templatic');?>
</p><br />
	<label class="setting_lbl"><?php _e('No Availability Message','templatic');?></label><br /><textarea name="not_available_msg" id="not_available_msg"><?php echo $fetch_global_settings['not_available_msg'];?></textarea><p><?php _e('This message is displayed when no rooms are available for booking (When all rooms are booked).','templatic');?></p>
	<input type="submit" name="submit" value="<?php _e('Save all changes','templatic');?>" class="button-framework-imp"></td>
</form>