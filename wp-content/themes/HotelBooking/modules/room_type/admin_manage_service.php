<?php
/* Delete Service Record BOF */
global $wpdb;
$service_table = $wpdb->prefix . "service_master";
if($_REQUEST['pagetype'] == 'delete' && $_REQUEST['service_id'] != '')
{
	$wpdb->query("DELETE from $service_table where service_id = '".$_REQUEST['service_id']."'");
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_service" method=get name="service_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="msg" value="delsuccess"></form>';
	echo '<script>document.service_success.submit();</script>';
	exit;
}
/* Delete Service Record EOF */
?>
 <div class='headerdivh3'>
	<h3><?php _e('Manage Service','templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&service_page_type=add_service#option_display_service';?>" title="<?php _e('Add New Service','templatic');?>" name="btnviewlisting" class="button-primary" /><?php _e('Add New Service','templatic'); ?></a></div>
    <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Here you can add, edit and manage services that you wish to offer. These services will be listed in book hotel section. e.g. airport pickup, laundry, etc','templatic');?> </p>
</div>
<?php if($_REQUEST['msg']=='success'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	 <?php if($_REQUEST['msgtype'] == 'add'){
				_e('Service inserted successfully.','templatic');
			} else {
				_e('Service updated successfully.','templatic');
		}?>
	</div>
	<?php }
	if($_REQUEST['msg']=='delsuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Service deleted successfully.','templatic'); ?>
	</div>
	<?php }?>	
	<table width="100%" cellpadding="5" class="widefat post fixed" >
		<thead>						
		<tr>
			<th align="left" width="20"><strong><?php _e('ID','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Service Title','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Service Price','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Service Status','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Sort Order','templatic'); ?></strong></th>
			<th align="left" ><strong><?php _e('Action','templatic'); ?></strong></th>						 
		</tr>
		<?php
		$servicesql = mysql_query("select * from $service_table");
		while($servicedata = mysql_fetch_array($servicesql)) { 
		if($servicedata['service_status'] == 'E') {
				$status = 'Enable';
			} else {
				$status = 'Disable';
			}
		?>	<tr>
				<td><?php echo $servicedata['service_id'];?></td>
				<td><?php echo $servicedata['service_name'];?></td>
				<td><?php echo display_amount_with_currency($servicedata['service_price'],display_currency());?></td>
				<td><?php echo $status;?></td>
				<td><?php echo $servicedata['sortorder'];?></td>
				<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&service_page_type=add_service&service_id='.$servicedata['service_id'].'&#option_display_service';?>" title="<?php _e('Edit Service','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Service','templatic');?>" border="0" /></a>&nbsp;&nbsp;<a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&pagetype=delete&service_id='.$servicedata['service_id'];?>#option_display_service" onclick="return confirmSubmit();" title="<?php _e('Delete Services','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Service','templatic');?>" border="0" /></a></td>
			</tr>
		<?php }	?>
	</thead>					
	</table>
<div class="legend">
<h4 class="legend">图例 :</h4>
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Service','templatic');?>" border="0" /></label> 编辑服务<br />
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Service','templatic');?>" border="0" /></label> 删除服务<br />
</div>