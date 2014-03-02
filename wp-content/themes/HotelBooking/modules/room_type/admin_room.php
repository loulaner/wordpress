<?php
global $wpdb;
$room_master_table = $wpdb->prefix . "room_master";
if($_POST['roomact'] == 'addroom')
{	
	$room_type_id = $_POST['room_type_id'];
	$room_name = $_POST['room_name'];
	$sortorder = $_POST['sortorder'];
	$room_status = $_POST['room_status'];
	if($_POST['room_id'] == ''){
		$insert_room = "INSERT INTO $room_master_table ( room_id,room_type_id,room_name,room_status,sortorder) VALUES('','".$room_type_id."','".$room_name."','".$room_status."','".$sortorder."') ";
		$wpdb->query($insert_room);
		$msg = "add";
	} else {
		$room_id = $_POST['room_id'];
		$wpdb->query("update $room_master_table set room_type_id = '".$room_type_id."',room_name = '".$room_name."',room_status = '".$room_status."',sortorder = '".$sortorder."' where room_id = '".$room_id."'");
		$msg = "edit";
	}
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_room" method=get name="room_type_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="roommsg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"></form>';
	echo '<script>document.room_type_success.submit();</script>';
}
if($_REQUEST['room_id'] != '')
{
	$room_sql = "select * from $room_master_table where room_id = '".$_REQUEST['room_id']."'";
	$room_info = mysql_query($room_sql);
	$room_res = mysql_fetch_array($room_info);
	$room_title = '编辑房间';
	$room_msg = '你可以在这里编辑房间信息.';
} else {
	$room_title = 'Add New Room';
	$room_msg = '在这里你可以添加新房间.';
}
?>
 <div class='headerdivh3'>
	<h3><?php _e($room_title,'templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_room_type#option_display_room" name="btnviewlisting" class="button-primary" title="<?php _e('Back to Room List','templatic');?>"/><?php _e('&laquo; Back to Manage Room List','templatic'); ?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e($room_msg,'templatic');?></p>
</div>
<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_room_type&pagetype=addedit&mod=room&room_id=<?php echo $_REQUEST['room_id'];?>" method="post" name="room_frm" onsubmit="return room_validation();">
	<input type="hidden" name="roomact" value="addroom">
	<input type="hidden" name="room_id" value="<?php echo $_REQUEST['room_id'];?>">
	<table width="100%" cellspacing="2" cellpadding="2" border="0" class="widefat post fixed">	
		<tr>
			<td align="left" valign="top" style="width:150px;"><label class="setting_lbl"><?php _e('Room Type','templatic');?></label></td>
			<td align="left" valign="top" ><select name="room_type_id" id="r_room_type_id"><option value=""><?php _e('Select Room Type','templatic');?></option><?php echo room_type_cmb($room_res['room_type_id']);?></select><p><?php _e('Select room type which you want to add room under this room type','templatic'); ?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:150px;"><label class="setting_lbl"><?php _e('Room Name','templatic');?></label></td>
			<td align="left" valign="top" ><input type="text" name="room_name" id="room_name" value="<?php echo $room_res['room_name'];?>" ><p><?php _e('Enter Room title','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:150px;"><label class="setting_lbl"><?php _e('Sort Order','templatic');?></label></td>
			<td align="left" valign="top" ><input type="text" name="sortorder" id="sortorder" value="<?php echo $room_res['sortorder'];?>" ><p><?php _e('Specify the order in which the rooms are listed. (eg. 1, 2, 3)','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:150px;"><label class="setting_lbl"><?php _e('Status','templatic');?></label></td>
			<td align="left" valign="top" ><input type="radio" id="room_status" name="room_status" value="E" <?php if($room_res['room_status'] == 'E' || $room_res['room_status'] == ''){?>checked="checked"<?php }?> />
					<label><?php _e('Enable','templatic');?></label>
				
					<input type="radio" id="room_status" name="room_status" <?php if($room_res['price_status'] == 'D'){?> checked="checked"<?php }?> value="D" />
					<label><?php _e('Disable','templatic');?></label><p><?php _e('Select the status of this Room','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top">&nbsp;</td>
			<td align="left" valign="top"><input type="submit" name="submit" value="<?php _e('Submit','templatic');?>" class="button-framework-imp"></td>
		</tr>
	</table>
</form>