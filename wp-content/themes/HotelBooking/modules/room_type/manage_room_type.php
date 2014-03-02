 <div class='headerdivh3'>
	<h3><?php _e('Manage Room Type','templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&page_type=add_room_type';?>" title="<?php _e('Add New Room Type','templatic');?>" name="btnviewlisting" class="button-primary" /><?php _e('Add New Room Type','templatic'); ?></a></div>
   <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Here you can add, edit and manage room type options. They will be listed in book hotel section.','templatic');?></p>
</div>
	<?php if($_REQUEST['msg']=='success'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	    <?php if($_REQUEST['msgtype'] == 'add'){
				_e('Room Type inserted successfully.','templatic');
			} else {
				_e('Room Type updated successfully.','templatic');
			}?>
	</div>
	<?php }?>
	<?php if($_REQUEST['msg']=='delsuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Room Type deleted successfully.','templatic'); ?>
	</div>
	<?php }?>	
	
	<table width="100%" cellpadding="5" class="widefat post fixed" >
		<thead>						
		<tr>
			<th align="left" width="15"><strong><?php _e('ID','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Room Type Title','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Capacity','templatic'); ?></strong></th>
			<th align="left" width="50"><strong><?php _e('Action','templatic'); ?></strong></th>						 
		</tr>
		<?php
		$room_typesql = mysql_query("select * from $room_type_table");
		while($room_typedata = mysql_fetch_array($room_typesql)) { 
		
		?>
			<tr>
				<td><?php echo $room_typedata['room_type_id'];?></td>
				<td><?php echo $room_typedata['room_type_name'];?></td>
			
				<td><?php echo $room_typedata['room_type_capacity'];?></td>
				<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&page_type=add_room_type&room_type_id='.$room_typedata['room_type_id'].'&#option_add_room_type';?>" title="<?php _e('Edit Room Type','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Room Type','templatic');?>" border="0" /></a> &nbsp;&nbsp;<a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&pagetype=delete&room_type_id='.$room_typedata['room_type_id'];?>" onclick="return confirmSubmit();" title="<?php _e('Delete Room Type','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Room Type','templatic');?>" border="0" /></a></td>
			</tr>
		<?php }	?>
	</thead>					
	</table>
<div class="legend">
<h4 class="legend">图例 :</h4>
<label class="imglabel"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Room Type','templatic');?>" border="0" /></label> 编辑房间类型<br />
<label class="imglabel"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Room Type','templatic');?>" border="0" /></label> 删除房间类型<br />
</div>