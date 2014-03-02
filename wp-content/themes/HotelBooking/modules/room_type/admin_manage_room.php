<?php
global $wpdb;
$room_type_table = $wpdb->prefix . "room_type_master";
$room_table = $wpdb->prefix . "room_master";
?>
 <div class='headerdivh3'>
	<h3><?php _e('Manage Room','templatic');?></h3>
    <div class="divright">
	<a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&room_page_type=add_room#option_display_room';?>" title="<?php _e('Add New Room','templatic');?>" class="button-primary"><?php _e('Add New Room','templatic');?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Here you can add, edit and manage room.','templatic');?></p>
</div>
<?php if($_REQUEST['roommsg']=='success'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php if($_REQUEST['msgtype'] == 'add'){
				_e('Room inserted successfully.','templatic');
			} else {
				_e('Room updated successfully.','templatic');
			}?>
	</div>
	<?php }?>
	<?php if($_REQUEST['roommsg']=='delsuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Room deleted successfully.','templatic'); ?>
	</div>
	<?php }?>	
	<table width="100%" cellpadding="5" class="widefat post fixed" >
		<thead>						
		<tr>
			<th align="left" width="15"><strong><?php _e('ID','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Room Type','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Room Name','templatic'); ?></strong></th>
			<th align="left" style="width:80px;"><strong><?php _e('Status','templatic'); ?></strong></th>
			<th align="left" width="50"><strong><?php _e('Action','templatic'); ?></strong></th>
		</tr>
		<?php
		$room_sql = mysql_query("select * from $room_table");
		while($room_data = mysql_fetch_array($room_sql)) { 
		if($room_data['room_status'] == 'E') {
				$status = 'Enable';
			} else {
				$status = 'Disable';
			}
		?>
			<tr>
				<td><?php echo $room_data['room_id'];?></td>
				<td><?php echo fecth_room_type_name($room_data['room_type_id']);?></td>
				<td><?php echo $room_data['room_name'];?></td>
				<td style="width:80px;"><?php echo $status;?></td>
				<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&room_page_type=add_room&room_id='.$room_data['room_id'].'#option_display_room';?>" title="<?php _e('Edit Room Detail','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Room Detail','templatic');?>" border="0" /></a>&nbsp;&nbsp;<a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&pagetype=deleteroom&room_id='.$room_data['room_id'];?>#option_display_room" onclick="return confirmSubmit();" title="<?php _e('Delete Room Detail','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Room Detail','templatic');?>" border="0" /></a></td>
			</tr>
		<?php }	?>
	</thead>					
	</table>
<div class="legend">
<h4 class="legend">图例 :</h4>
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Room Detail','templatic');?>" border="0" /></label> 编辑房间详情<br />
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Room Detail','templatic');?>" border="0" /></label> 删除房间详情<br />
</div>
<?php 
/* Listing Room  EOF */
/* Delete Room BOF */
if($_REQUEST['pagetype'] == 'deleteroom' && $_REQUEST['room_id'] != '')
{
	$wpdb->query("DELETE from $room_table where room_id = '".$_REQUEST['room_id']."'");
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_room" method=get name="room_type_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="roommsg" value="delsuccess"></form>';
	echo '<script>document.room_type_success.submit();</script>';
	exit;
}
/* Delete Room EOF */ 