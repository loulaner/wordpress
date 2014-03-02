<?php
global $wpdb;
$booking_field = $wpdb->prefix . "booking_field";
if($_POST['booking_settingsact'] == 'addbooking_settings')
{
	$fieldname = $_POST['fieldname'];
	$fieldtype = $_POST['fieldtype'];
	$field_front_title = $_POST['field_front_title'];
	$fieldvalue = $_POST['fieldvalue'];
	$fieldisoptional = $_POST['isfieldoptional'];
	$field_description = $_POST['field_description'];
	$position = $_POST['fieldposition'];
	$extra_parameter = $_POST['extra_parameter'];
	$validation_type = $_POST['validation_type'];
	$field_require_desc = stripslashes($_POST['field_require_desc']);
	$style_class = $_POST['style_class'];
		if($_POST['field_id'] == ''){
			$insertbooking_settings = "insert into $booking_field (field_id,fieldname,fieldtype,fieldvalue,field_front_title,isfieldoptional,field_require_desc,fieldposition,field_description,style_class,extra_parameter,validation_type) VALUES('', '".$fieldname."', '".$fieldtype."','".$fieldvalue."','".$field_front_title."','".$fieldisoptional."','".$position."','".$field_description."','".addslashes($field_require_desc)."','".$style_class."','".$extra_parameter."','".$validation_type."')";
			$wpdb->query($insertbooking_settings);
			$msg = "add"; 
			
		} else {
			$field_id = $_POST['field_id'];
			$wpdb->query("update $booking_field set fieldname = '".$fieldname."',fieldtype = '".$fieldtype."',fieldvalue = '".$fieldvalue."',field_front_title = '".$field_front_title."',	isfieldoptional = '".$fieldisoptional."',fieldposition = '".$position."',extra_parameter = '".$extra_parameter."',style_class = '".$style_class."',field_description = '".$field_description."',validation_type = '".$validation_type."',field_require_desc = '".addslashes($field_require_desc)."' where field_id = '".$field_id."'");
			$msg = "edit";
		}

		$location = site_url()."/wp-admin/admin.php";
		echo '<form action="'.$location.'#option_display_booking_settings" method=get name="booking_settings_success">
		<input type=hidden name="page" value="manage_room_type"><input type=hidden name="msg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"></form>';
		echo '<script>document.booking_settings_success.submit();</script>';
		
	
}
if($_REQUEST['field_id'] != '')
{
	$booking_settingssql = "select * from $booking_field where field_id = '".$_REQUEST['field_id']."'";
	$booking_settingsinfo = mysql_query($booking_settingssql);
	$booking_setting_res = mysql_fetch_array($booking_settingsinfo);
	$booking_field_title = 'Edit Custom Field';
	$booking_field_msg = '在这里可以编辑自定义字段.';
		
} else {
	$booking_field_title = 'Add New Custom Field';
	$booking_field_msg = '在这里可以添加新自定义字段.';
}
?>
 <div class='headerdivh3'>
	<h3><?php _e($booking_field_title,'templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_room_type#option_display_booking_settings" name="btnviewlisting" class="button-primary"/><?php _e('&laquo; Back to Manage Custom Fields List','templatic'); ?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e($booking_field_msg,'templatic');?></p>
</div>
<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_room_type&mod=custom_field&&pagetype=addedit&field_id=<?php echo $_REQUEST['field_id'];?>" method="post" name="booking_settings_frm" onsubmit="return settings_validtion();">
	<input type="hidden" name="booking_settingsact" value="addbooking_settings">
	<input type="hidden" name="field_id" value="<?php echo $_REQUEST['field_id'];?>">
	<table width="100%" cellspacing="2" cellpadding="2" border="0" class="widefat post fixed">	
		<tr>
			<td align="left" valign="top" style="width:150px;"><label class="setting_lbl"><?php _e('Field Title','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" id="field_front_title" name="field_front_title" value="<?php echo $booking_setting_res['field_front_title'];?>"><p><?php _e('Title which you wish to display in online booking form.','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top"><label class="setting_lbl"><?php _e('Field Name','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="fieldname" id="fieldname" value="<?php echo $booking_setting_res['fieldname'];?>"><p><?php _e('Field name which you wish to give element name as well its also consider as element ID. (IMPORTANT: Avoid space between words; Use underscore ( _ ) instead.)','templatic');?> </p></td>
		</tr>
		<tr>
			<td align="left" valign="top"><label class="setting_lbl"><?php _e('Field Type','templatic');?></label></td>
			<td align="left" valign="top"><select name="fieldtype" id="bookingfieldtype"><?php echo custom_field_type_cmb($booking_setting_res['fieldtype']);?></select><p><?php _e('Select field type. it will allow (text,textarea,radio,multicheckbox,etc.)','templatic');?></p></td>
		</tr>
		
		<tr>
			<td align="left" valign="top"><label class="setting_lbl"><?php _e('Field Value','templatic');?></label></td>
			<td align="left" valign="top"><textarea name="fieldvalue" id="fieldvalue"><?php echo $booking_setting_res['fieldvalue'];?></textarea><p><?php _e('Enter Field Value (If you select field type as select box,radio,checkbox. And enter value seperated by \',\')','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top"><label class="setting_lbl"><?php _e('Field Description','templatic');?></label></td>
			<td align="left" valign="top"><textarea name="field_description" id="field_description"><?php echo $booking_setting_res['field_description'];?></textarea><p><?php _e('Description will display below element in online booking form.','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top"><label class="setting_lbl"><?php _e('Is Optional?','templatic');?></label></td>
			<td align="left" valign="top"><input type="radio" id="isfieldoptional" name="isfieldoptional" value="1" <?php if($booking_setting_res['isfieldoptional'] == '1' || $booking_setting_res['isfieldoptional']==''){?>checked="checked"<?php }?> />&nbsp;<label><?php _e('Yes','templatic');?></label>&nbsp;&nbsp;&nbsp;<input type="radio" id="isfieldoptional" name="isfieldoptional" <?php if($booking_setting_res['isfieldoptional'] == '0'){?> checked="checked"<?php }?> value="0" />&nbsp;<label><?php _e('No','templatic');?></label><p><?php _e('Select No if you want set this field to field compolsory.','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top"><label class="setting_lbl"><?php _e('Field Require Message','templatic');?></label></td>
			<td align="left" valign="top"><textarea name="field_require_desc" id="field_require_desc"><?php echo $booking_setting_res['field_require_desc'];?></textarea><p><?php _e('This message will display when field is not optional and user not fill this field.','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top"><label class="setting_lbl"><?php _e('Validation Type','templatic');?></label></td>
			<td align="left" valign="top"><select name="validation_type" id="validation_type"><?php echo validation_type_cmb($booking_setting_res['validation_type']);?></select><p><?php _e('Validation Type if you select require this field must be have some value and if its email then you have to enter valid email address','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top"><label class="setting_lbl"><?php _e('Stylesheet Class','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="style_class" id="style_class" value="<?php echo $booking_setting_res['style_class']; ?>">
			<p><?php _e('This stylesheet class apply on field','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top"><label class="setting_lbl"><?php _e('Parameter','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="extra_parameter" id="extra_parameter" value="<?php echo $booking_setting_res['extra_parameter']; ?>"><p><?php _e('Extra Parameter (eg. maxlength, onchange etc.)','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top">&nbsp;</td>
			<td align="left" valign="top"><input type="submit" name="submit" value="<?php _e('Submit','templatic');?>" class="button-framework-imp"></td>
	</tr>
	</table>
</form>