<?php
global $wpdb;
$booking_field = $wpdb->prefix . "booking_field";
$booking_field_value = $wpdb->prefix . "booking_field_value";
/* Delete Service Record BOF */
if($_REQUEST['pagetype'] == 'delete' && $_REQUEST['field_id'] != '') {
	$wpdb->query("DELETE from $booking_field where field_id = '".$_REQUEST['field_id']."'");
	$wpdb->query("DELETE from $booking_field_value where field_id = '".$_REQUEST['field_id']."'");
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_booking_settings" method=get name="booking_settings_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="msg" value="delsuccess"></form>';
	echo '<script>document.booking_settings_success.submit();</script>';
	exit;
}
/* Delete Service Record EOF */
?>
<!-- Listing Custom Fields BOF -->
 <div class='headerdivh3'>
	<h3><?php _e('Manage Custom Fields','templatic');?></h3>
    <div class="divright">
	<a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&field_page_type=add_field#option_display_booking_settings';?>" title="<?php _e('Add New Custom Field','templatic');?>" class="button-primary"><?php _e('Add New Custom Field','templatic');?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('In this section, you can add, delete and manage the custom fields appearing in the online booking form.','templatic');?></p>
</div>
	<?php if($_REQUEST['msg']=='success'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
		<?php if($_REQUEST['msgtype'] == 'add'){
				_e('Custom Field inserted successfully.','templatic');
			} else {
				_e('Custom Field updated successfully.','templatic');
		}?>
	</div>
	<?php }?>
	<?php if($_REQUEST['msg']=='delsuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Custom Field deleted successfully.','templatic'); ?>
	</div>
	<?php }?>	
	<table width="100%" cellpadding="5" class="widefat post fixed" >
		<thead>						
		<tr>
			<th align="left" style="width:15px;"><strong><?php _e('ID','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Field Name','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Title','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Field Type','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Optional','templatic'); ?></strong></th>
			<th align="left" width="50"><strong><?php _e('Action','templatic'); ?></strong></th>
		</tr>
		<?php
		$booking_field = $wpdb->prefix . "booking_field";
		$booking_settingssql = mysql_query("select * from $booking_field");
		while($fielddata = mysql_fetch_array($booking_settingssql))	{ ?>
		<tr>
			<td><?php echo $fielddata['field_id'];?></td>
			<td><?php echo $fielddata['fieldname'];?></td>
			<td><?php echo $fielddata['field_front_title'];?></td>
			<td><?php echo fetch_custom_field_type($fielddata['fieldtype']);?></td>
			<td><?php echo $fielddata['isfieldoptional'];?></td>
			<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&field_page_type=add_field&field_id='.$fielddata['field_id'].'&#option_display_booking_settings';?>" title="<?php _e('Edit Field','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Field','templatic');?>" border="0" /></a> &nbsp;&nbsp;<a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&pagetype=delete&field_id='.$fielddata['field_id'];?>#option_display_booking_settings" onclick="return confirmSubmit();" title="<?php _e('Delete Field','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Field','templatic');?>" border="0" /></a></td>
		</tr>
		<?php }	?>
		</thead>					
	</table>
<div class="legend">
<h4 class="legend">图例 :</h4>
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Field','templatic');?>" border="0" /></label> 编辑自定义字段<br />
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Field','templatic');?>" border="0" /></label> 删除自定义字段<br />
</div>