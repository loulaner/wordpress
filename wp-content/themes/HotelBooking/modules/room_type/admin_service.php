<?php
global $wpdb;
$service_table = $wpdb->prefix . "service_master";
if($_POST['serviceact'] == 'addservice')
{
	$service_name = $_POST['service_name'];
	$service_price = $_POST['service_price'];
	$service_status = $_POST['service_status'];
	$sortorder = $_POST['sortorder'];
	if($service_name)
	{
		if($_POST['service_id'] == ''){
			$insertservice = "INSERT INTO $service_table (service_id,service_name,service_price,service_status,sortorder) VALUES('', '".$service_name."', '".$service_price."','".$service_status."','".$sortorder."') ";
			$wpdb->query($insertservice);
			$msg = "add";
		} else {
			$service_id = $_POST['service_id'];
			$wpdb->query("update $service_table set service_name = '".$service_name."',service_price = '".$service_price."',service_status = '".$service_status."',sortorder = '".$sortorder."' where service_id = '".$service_id."'");
			$msg = "edit";
		}
		$location = site_url()."/wp-admin/admin.php";
		echo '<form action="'.$location.'#option_display_service" method=get name="service_success">
		<input type=hidden name="page" value="manage_room_type"><input type=hidden name="msg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"></form>';
		echo '<script>document.service_success.submit();</script>';
		
	}
}
if($_REQUEST['service_id'] != '')
{
	$servicesql = "select * from $service_table where service_id = '".$_REQUEST['service_id']."'";
	$serviceinfo = mysql_query($servicesql);
	$service_res = mysql_fetch_array($serviceinfo);
	$service_title = 'Edit Service';
	$service_msg = '在这里可以编辑服务';
} else {
	$service_title = 'Add New Service';
	$service_msg = '在这里可以添加新服务.';
}
?>
 <div class='headerdivh3'>
	<h3><?php _e($service_title,'templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_room_type#option_display_service" name="btnviewlisting" class="button-primary" title="<?php _e('Back to Service List','templatic');?>"/><?php _e('&laquo; Back to Service List','templatic'); ?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e($service_msg,'templatic');?></p>
</div>
<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_room_type&mod=service&pagetype=addedit&service_id=<?php echo $_REQUEST['service_id'];?>" method="post" name="service_frm" onsubmit="return service_validation();">
	<input type="hidden" name="serviceact" value="addservice">
	<input type="hidden" name="service_id" value="<?php echo $_REQUEST['service_id'];?>">
	<table width="100%" cellspacing="2" cellpadding="2" border="0" class="widefat post fixed">	
		<tr>
			<td align="left" valign="top" style="width:150px;"><label class="setting_lbl"><?php _e('Service Name : ','templatic');?></td>
			<td align="left" valign="top"><input type="text" name="service_name" id="service_name" value="<?php echo $service_res['service_name'];?>"><p><?php _e('Enter Service Name','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:150px;"><label class="setting_lbl"><?php _e('Service Price : ','templatic');?></td>
			<td align="left" valign="top"><input type="text" name="service_price" id="service_price" value="<?php echo $service_res['service_price'];?>"><p><?php _e('Enter Service Price','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:150px;"><label class="setting_lbl"><?php _e('Service Status : ','templatic');?></td>
			<td align="left" valign="top"><input type="radio" id="service_status" name="service_status" value="E" <?php if($service_res['service_status'] == 'E' || $service_res['service_status'] == ''){?>checked="checked"<?php }?> />&nbsp;&nbsp;<?php _e('Enable','templatic');?>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="service_status" name="service_status" <?php if($service_res['service_status'] == 'D'){?> checked="checked"<?php }?> value="D" />&nbsp;&nbsp;<?php _e('Disable','templatic');?><br /><br /><p><?php _e('Enabing and disabling this setting will show and hide this service respectively.','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:150px;"><label class="setting_lbl"><?php _e('Sort Order : ','templatic');?></td>
			<td align="left" valign="top"><input type="text" name="sortorder" id="sortorder" value="<?php echo $service_res['sortorder'];?>"><p><?php _e('Specify the order in which the services are listed. (eg. 1, 2, 3)','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top">&nbsp;</td>
			<td align="left" valign="top"><input type="submit" name="submit" value="<?php _e('Submit','templatic');?>" class="button-framework-imp"></td>
		</tr>
	</table>
		
</form>