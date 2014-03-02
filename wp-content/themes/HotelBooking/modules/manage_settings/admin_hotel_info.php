<?php 
global $wpdb;
$hotel_info_table = $wpdb->prefix . "hotel_info_master";


/* Update Query BOF */
if(isset($_GET['pagetype']) && $_GET['pagetype'] == 'update_hotel_info'){
	global $wpdb;
	$success_mail_content = stripslashes($_POST['success_mail_content']);
	$success_mail_subject = stripslashes($_POST['success_mail_subject']);
	$hotel_street = stripslashes($_POST['hotel_street']);
	$update_settings = "update $hotel_info_table set hotel_name = '".$_POST['hotel_name']."',contact_hotel_mail = '".$_POST['contact_hotel_mail']."',hotel_country = '".$_POST['hotel_country']."',hotel_state = '".$_POST['hotel_state']."',hotel_street = '".addslashes($hotel_street)."',contact_phone_1 = '".$_POST['contact_phone_1']."',contact_phone_2 = '".$_POST['contact_phone_2']."',success_mail_status = '".$_POST['success_mail_status']."',mail_from = '".$_POST['mail_from']."' where hotel_id = '".$_POST['hotel_id']."'" ;
	$wpdb->query($update_settings);
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#hotel_info" method=get name="hotelinfo_success">
	<input type=hidden name="page" value="manage_settings"><input type=hidden name="msg" value="hotelinfosuccess"></form>';
	echo '<script>document.hotelinfo_success.submit();</script>';
	exit;
}	
/* Update Query EOF */
$fetch_hotel_info_sql = mysql_query("select * from $hotel_info_table");
$fetch_hotel_info = mysql_fetch_array($fetch_hotel_info_sql);?>
<h3><?php _e('Hotel Information','templatic');?></h3> 
<span style="font-size:10px;" ><?php _e('Please enter your Hotel Information here','templatic');?></span> 
<?php 
if($_REQUEST['msg']=='hotelinfosuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	 <?php 	_e('Hotel Information Successfully Updated.','templatic');	?>
	</div>
<?php }?>

<form name="frm_settings" id="frm_settings" action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_settings&pagetype=update_hotel_info" method="post" onsubmit="return hotel_settings();">
<input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $fetch_hotel_info['hotel_id'];?>">
<table cellspacing="2" cellpadding="4" border="0" width="100%" class="widefat post fixed">
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Hotel Name','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="hotel_name" id="hotel_name" value="<?php echo $fetch_hotel_info['hotel_name'];?>" style="width:200px;"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Contact Email','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="contact_hotel_mail" id="contact_hotel_mail" value="<?php echo $fetch_hotel_info['contact_hotel_mail'];?>" style="width:200px;"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Hotel Country','templatic');?></label></td>
		<td align="left" valign="top"><select name="hotel_country" id="hotel_country" style="width:200px;"><?php echo country_cmb($fetch_hotel_info['hotel_country']);?></select></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Hotel State','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="hotel_state" id="hotel_state" value="<?php echo $fetch_hotel_info['hotel_state'];?>" style="width:200px;"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Hotel Street','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="hotel_street" id="hotel_street" value="<?php echo $fetch_hotel_info['hotel_street'];?>" style="width:200px;"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Contact Phone 1','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="contact_phone_1" id="contact_phone_1" value="<?php echo $fetch_hotel_info['contact_phone_1'];?>" style="width:200px;"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Contact Phone 2','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="contact_phone_2" id="contact_phone_2" value="<?php echo $fetch_hotel_info['contact_phone_2'];?>" style="width:200px;"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Success Mail','templatic');?></label> <br /><label class="desc_lbl"><?php _e('This email is sent when a customer successfully completes the payment process.','templatic');?></label></td>
		<td align="left" valign="top"><select name="success_mail_status" id="success_mail_status" style="width:100px;"><?php echo enable_disable($fetch_hotel_info['success_mail_status']);?></select></td>
	</tr>
	<tr>
		<td align="left" valign="top" ><label class="setting_lbl"><?php _e('Mail From','templatic');?></label><br/><label class="desc_lbl"><?php _e('Enter the Name which you wish to use in the Email','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="mail_from" id="mail_from" value="<?php echo $fetch_hotel_info['mail_from'];?>" style="width:200px;"></td>
	</tr>
	<tr>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top"><input type="submit" name="submit" value="<?php _e('Submit','templatic');?>" class="button-framework-imp"></td>
	</tr>
</table>
</form>