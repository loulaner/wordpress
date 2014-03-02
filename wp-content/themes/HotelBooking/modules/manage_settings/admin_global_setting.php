<?php 
/* Update Query BOF */
global $wpdb;
$global_settings = $wpdb->prefix . "global_settings";
if(isset($_GET['pagetype']) && $_GET['pagetype'] == 'update_global_settings'){
	global $wpdb;
	$update_settings = "update $global_settings set allow_reservation = '".$_POST['allow_reservation']."',max_adults = '".$_POST['max_adults']."',max_rooms = '".$_POST['max_rooms']."',paid_submission = '".$_POST['paid_submission']."',currency = '".$_POST['currency']."',symbol_position = '".$_POST['symbol_position']."',tax = '".$_POST['tax']."',tax_type = '".$_POST['tax_type']."',deposite_percentage = '".$_POST['deposite_percentage']."' where setting_id = '".$_POST['setting_id']."'" ;
	$wpdb->query($update_settings);
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#global_settings" method=get name="setting_success">
	<input type=hidden name="page" value="manage_settings"><input type=hidden name="msg" value="settingsuccess"></form>';
	echo '<script>document.setting_success.submit();</script>';
	exit;
}	
/* Update Query EOF */

$fetch_global_settings_sql = mysql_query("select * from $global_settings");
$fetch_global_settings = mysql_fetch_array($fetch_global_settings_sql); ?>
<h3><?php _e('General Settings','templatic');?></h3>
<?php if($_REQUEST['msg']=='settingsuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	 <?php 	_e('General Settings Successfully Updated.','templatic');	?>
	</div>
<?php }?>

<form name="frm_settings" id="frm_settings" action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_settings&pagetype=update_global_settings" method="post" onsubmit="return global_setting();">
<div class="btn_divright" ><input type="submit" name="submit" value="<?php _e('Save all changes','templatic');?>" class="button-framework-imp"></div>
<input type="hidden" name="setting_id" id="setting_id" value="<?php echo $fetch_global_settings['setting_id'];?>">

<table cellspacing="2" cellpadding="4" border="0" width="100%" class="widefat post fixed">
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Display Booking Form in frontend','templatic');?></label> <br /><label class="desc_lbl"><?php _e('This setting will show/hide the booking form on the website.','templatic');?></label></td>
		<td align="left" valign="top"><select name="allow_reservation" id="allow_reservation" style="width:100px;"><?php echo allow_nt_allow($fetch_global_settings['allow_reservation']);?></select></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Maximum Adults','templatic');?></label> <br /><label class="desc_lbl"><?php _e('Specify the maximum number of adults who can book at once.','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="max_adults" id="max_adults" value="<?php echo $fetch_global_settings['max_adults'];?>" style="width:200px;" onkeypress="return EnterNumber(event)"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Maximum Rooms','templatic');?></label> <br /><label class="desc_lbl"><?php _e('This is the maximum number of rooms you wish to display in the booking form.','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="max_rooms" id="max_rooms" value="<?php echo $fetch_global_settings['max_rooms'];?>" style="width:200px;" onkeypress="return EnterNumber(event)"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Allow Payment Option?','templatic');?></label> <br /><label class="desc_lbl"><?php _e('If \'Enabled\' your customers will be required to pay for room bookings. If \'disabled\' the online payment facility will be unavailable.','templatic');?></label></td>
		<td align="left" valign="top"><select name="paid_submission" id="paid_submission" style="width:100px;"><?php echo enable_disable($fetch_global_settings['paid_submission']);?></select></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _E('选择货币','templatic');?></label> <br /><?php _e('You can add currency from "Manage Currency" section','templatic');?><label class="desc_lbl"></label></td>
		<td align="left" valign="top"><select name="currency" id="currency" style="width:200px;"><?php echo currency_cmb($fetch_global_settings['currency']);?></select></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Currency Symbol position','templatic');?></label> <br /><label class="desc_lbl"><?php _e('Specify where the currency symbol will be displayed.','templatic');?></label></td>
		<td align="left" valign="top"><select name="symbol_position" id="symbol_position" style="width:220px;"><?php echo position_cmb($fetch_global_settings['symbol_position']);?></select>
		<p >例如:<span id="ex_position">500</span></p></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Deposit Percent','templatic');?></label> <br /><label class="desc_lbl"><?php _e('Minimum amount that needs to be paid by the customer before the booking is confirmed.','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="deposite_percentage" id="deposite_percentage" value="<?php echo $fetch_global_settings['deposite_percentage'];?>" style="width:200px;" onkeypress="return EnterNumber(event)"></td>
	</tr>
</table><br /><br />
<h3>税</h3>
<table cellspacing="2" cellpadding="4" border="0" width="100%" class="widefat post fixed">
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Amount','templatic');?></label> <br /><label class="desc_lbl"><?php _e('This is the additional surcharge beside regular payment for booking.','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="tax" id="tax" value="<?php echo $fetch_global_settings['tax'];?>" style="width:100px;" onkeypress="return EnterNumber(event)"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Type','templatic');?></label> <br /><label class="desc_lbl"><?php _e('There are two types of surcharge: Exact Amount (direct surcharge) or Percent (depends on the total payment amount). If you choose \'Percent\', please do not enter \'Amount\' more than 100.','templatic');?></label></td>
		<td align="left" valign="top"><select name="tax_type" id="tax_type" style="width:200px;"><?php echo tax_type_cmb($fetch_global_settings['tax_type']);?></select></td>
	</tr>
	<tr>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top"><input type="submit" name="submit" value="<?php _e('Save all changes','templatic');?>" class="button-framework-imp"></td>
	</tr>
</table>
</form>