<?php
global $wpdb;
$room_type_table = $wpdb->prefix . "room_type_master";
$room_gallery_table = $wpdb->prefix . "room_type_gallery";
?>
<!-- Listing Gallery BOF -->
 <div class='headerdivh3'>
	<h3><?php _e('Manage Room Gallery','templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&gallery_page_type=add_gallery#option_display_room_gallery';?>" title="<?php _e('Add New Gallery Photo','templatic');?>" name="btnviewlisting" class="button-primary" /><?php _e('Add New Gallery Photo','templatic'); ?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Here you can add, edit and manage rooms gallery.','templatic');?> </p>
</div>
<?php if($_REQUEST['gallerymsg']=='success'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php if($_REQUEST['msgtype'] == 'add'){
				_e('Image Uploaded successfully.','templatic');
			} else {
				_e('Image updated successfully.','templatic');
			}?>
	</div>
	<?php }?>
	<?php if($_REQUEST['gallerymsg']=='delsuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Image deleted successfully.','templatic'); ?>
	</div>
	<?php } if(isset($_POST['room_type']) && $_POST['room_type'] != ''){
		$_SESSION['room_type'] = $_POST['room_type'];
		}?>
<form name="frm_room_type" id="frm_room_type" action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_room_type&mod=gallery#option_display_room_gallery" method="post">

	<table cellspacing="1" cellpadding="4" border="0" width="100%" style="border:0px;">
		<tr>
			<td align="left" valign="top" style="width:150px;"><p>搜索房间类型 :</p></td>
			<td align="left" valign="top" style="width:160px;"><select name="room_type" id="room_type" style="width:150px;"><option value=""><?php _e('Select Room Type','templatic');?></option><?php echo room_type_cmb($_SESSION['room_type']);?></select></td>
			<td align="left" valign="top"><input type="submit" name="submit" id="save" value="搜索"  class="button-primary" ></td>
		</tr>
	</table>
</form>	
<?php 
$targetpage = site_url('/wp-admin/admin.php?page=manage_room_type&mod=gallery');
$recordsperpage = 10;
$pagination = $_REQUEST['pagination'];
if($pagination == '')
{
	$pagination = 1;
}
$strtlimit = ($pagination-1)*$recordsperpage;
$endlimit = $strtlimit+$recordsperpage;
//----------------------------------------------------
$gallery_limit = " order by gallery_id limit $strtlimit,$recordsperpage";
$gallery_qry = "select * from $room_gallery_table";
	if(isset($_POST['room_type']) && $_POST['room_type'] != ''){
		$gallery_qry .= " where room_type_id = '".$_SESSION['room_type']."'";
	}
	$gallery_sql = mysql_query($gallery_qry); 
	$total_pages = mysql_num_rows($gallery_sql);
	$final_gallery_qry = mysql_query($gallery_qry.$gallery_limit);
	
	if($total_pages > 0) {?>
		<table width="100%" cellpadding="5" class="widefat post fixed" >
			<thead>						
				<tr>
					<th align="left" width="15"><strong><?php _e('ID','templatic'); ?></strong></th>
					<th align="left"><strong><?php _e('Room Type','templatic'); ?></strong></th>
					<th align="left"><strong><?php _e('Image','templatic'); ?></strong></th>
					<th align="left"><strong><?php _e('Sort Order','templatic'); ?></strong></th>
					<th align="left" width="50"><strong><?php _e('Action','templatic'); ?></strong></th>
				</tr>
			<?php
				while($gallery_data = mysql_fetch_array($final_gallery_qry)) { 
					if($gallery_data['room_status'] == 'E') {
						$status = 'Enable';
					} else {
						$status = 'Disable';
					}
					$img_title = $gallery_data['file_title'];
					if($gallery_data['alternate_text'] == '') {
						$img_alt = $gallery_data['file_title'];
					}?>
				<tr>
					<td align="left"><?php echo $gallery_data['gallery_id'];?></td>
					<td align="left"><?php echo fecth_room_type_name($gallery_data['room_type_id']);?></td>
					<td align="left"><?php echo '<img src="'.templ_thumbimage_filter($gallery_data['file_url'],'&amp;w=80&amp;h=80&amp;zc=1&amp;q=80').'" alt="'.$img_alt.'" title="'.$img_title.'" />';?></td>
					<td align="left"><?php echo $gallery_data['sortorder'];?></td>
					<td align="left"><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&gallery_page_type=add_gallery&gallery_id='.$gallery_data['gallery_id'].'&#option_display_room_gallery';?>" title="<?php _e('Edit Image','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Image','templatic');?>" border="0" /></a> &nbsp;&nbsp;<a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&pagetype=deletegallery&gallery_id='.$gallery_data['gallery_id'];?>#option_display_room_gallery" onclick="return confirmSubmit();" title="<?php _e('Delete Image','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Image','templatic');?>" border="0" /></a></td>
				</tr>
		<?php }	?>
				<tr>
					<td colspan="5" align="left">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3" align="left"><strong><?php _e('合计'); ?> : <?php echo $total_pages;?> <?php _e('人'); ?></strong></td>
					<td colspan="2" align="right"><?php if($total_pages>$recordsperpage){
						echo get_pagination($targetpage,$total_pages,$recordsperpage,$pagination,'#option_display_room_gallery');
					}?></td>
              </tr>
			</thead>					
		</table>
<?php } else {
	echo '<center><h4>找不到记录.</h4></center>';
}?>
<div class="legend">
<h4 class="legend">图例 :</h4>
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Image','templatic');?>" border="0" /></label> 编辑图片<br />
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Image','templatic');?>" border="0" /></label> 删除图片<br />
</div>
<?php
/* Listing Gallery  EOF */
/* Delete Gallery BOF */
if($_REQUEST['pagetype'] == 'deletegallery' && $_REQUEST['gallery_id'] != '')
{
	$wpdb->query("DELETE from $room_gallery_table where gallery_id = '".$_REQUEST['gallery_id']."'");
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_room_gallery" method=get name="gallery_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="gallerymsg" value="delsuccess"></form>';
	echo '<script>document.gallery_success.submit();</script>';
	
}
/* Delete Gallery EOF */ 