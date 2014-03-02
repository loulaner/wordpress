<?php
global $wpdb;
$room_gallery_table = $wpdb->prefix . "room_type_gallery";
if($_POST['galleryact'] == 'addgallery')
{	
	$room_type_id = $_POST['room_type_id'];
	$sortorder = $_POST['sortorder'];
	$file_title = stripslashes($_POST['file_title']);
	$alternate_text = stripslashes($_POST['alternate_text']);
	$img_description = stripslashes($_POST['img_description']);
	$room_type = fecth_room_type_name($room_type_id);
	$imgtype = strtolower(substr($_FILES['gallery_photo']['name'], strrpos($_FILES['gallery_photo']['name'], '.'),strlen($_FILES['gallery_photo']['name']) ));
	$dirinfo = wp_upload_dir();
	$path = $dirinfo['path'];
	$url = $dirinfo['url'];
	$destination_path = $path."/";
	$destination_url = $url."/";
	
				
	if($_POST['gallery_id'] == ''){
		$insertroom_gallery = "INSERT INTO $room_gallery_table (gallery_id,room_type_id,file_title,alternate_text,img_description,sortorder) VALUES('','".$room_type_id."','".addslashes($file_title)."','".addslashes($alternate_text)."','".addslashes($img_description)."','".$sortorder."') ";
		$wpdb->query($insertroom_gallery);
		$gallery_insert_id = mysql_insert_id();
		$final_name = str_replace(array(' ','-'),array('_'),strtolower($room_type)).'_'.$gallery_insert_id.$imgtype;
		$target_file = $destination_path.$final_name;
		if(move_uploaded_file($_FILES['gallery_photo']['tmp_name'],$target_file)){
			$image_path = $destination_url.$final_name;
		}else{
			$image_path = '';	
		}
		$wpdb->query("update $room_gallery_table set gallery_photo = '".$final_name."',file_url = '".$image_path."' where gallery_id = '".$gallery_insert_id."'");
		$msg = "add";
				
	} else {
		$gallery_id = $_POST['gallery_id'];
		$wupload_dir =  DIR_WS_GALLERY_PATH.$_POST['year'].'/'.$_POST['month'].'/roomgallery/';	
		if($_FILES['gallery_photo']['tmp_name'] != ''){
			@unlink($_POST['file_url']);
			$final_name = str_replace(array(' ','-'),array('_'),strtolower($room_type)).'_'.$gallery_id.$imgtype;
			$target_file = $destination_path.$final_name;
			if(move_uploaded_file($_FILES['gallery_photo']['tmp_name'],$target_file)){
				$image_path = $destination_url.$final_name;
			}else{
				$image_path = '';	
			}
			move_uploaded_file($_FILES['gallery_photo']['tmp_name'],DIR_FS_GALLERY_PATH.'/'.$final_name);
		} else {
			$final_name = $_POST['prev_gallery_photo'];
			$image_path = $_POST['file_url'];	
		}
		$wpdb->query("update $room_gallery_table set room_type_id = '".$room_type_id."',file_title = '".addslashes($file_title)."',alternate_text = '".addslashes($alternate_text)."',img_description = '".addslashes($img_description)."',gallery_photo = '".$final_name."',file_url = '".$image_path."',sortorder = '".$sortorder."' where gallery_id = '".$gallery_id."'");
		$msg = "edit";
	}

	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_room_gallery" method=get name="room_gallery_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="gallerymsg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"></form>';
	echo '<script>document.room_gallery_success.submit();</script>';
}
if($_REQUEST['gallery_id'] != '')
{
	$gallery_sql = "select * from $room_gallery_table where gallery_id = '".$_REQUEST['gallery_id']."'";
	$gallery_info = mysql_query($gallery_sql);
	$gallery_res = mysql_fetch_array($gallery_info);
	$gallery_title = 'Edit Gallery Photo';
	$gallery_msg = '在这里可以编辑相册.';
} else {
	$gallery_title = 'Add New Gallery Photo';
	$gallery_msg = '在这里可以添加新相册.';
}
?>
 <div class='headerdivh3'>
	<h3><?php _e($gallery_title,'templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_room_type#option_display_room_gallery" name="btnviewlisting" class="button-primary" title="<?php _e('Back to Room Gallery List','templatic');?>"/><?php _e('&laquo; Back to Room Gallery List','templatic'); ?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e($gallery_msg ,'templatic');?></p>
</div>
<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_room_type&pagetype=addedit&mod=gallery&gallery_id=<?php echo $_REQUEST['gallery_id'];?>" method="post" name="room_frm" onsubmit="return room_gallery_validation();" enctype="multipart/form-data">
	<input type="hidden" name="galleryact" value="addgallery">
	<input type="hidden" name="gallery_id" value="<?php echo $_REQUEST['gallery_id'];?>">
	<input type="hidden" name="file_url" value="<?php echo $gallery_res['file_url'];?>">
	<table width="100%" cellspacing="2" cellpadding="2" border="0" class="widefat post fixed" >	
		<tr>
			<td align="left" valign="top"  style="width:110px;padding:5px;"><label class="setting_lbl"><?php _e('Room Type : ','templatic');?></label></td>
			<td align="left" valign="top"  style="padding:5px;"><select name="room_type_id" id="g_room_type_id"><option value=""><?php _e('Select Room Type','templatic');?></option><?php echo room_type_cmb($gallery_res['room_type_id']);?></select></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:110px;padding:5px;"><label class="setting_lbl"><?php _e('Gallery Photo : ','templatic');?></label></td>
			<td align="left" valign="top"  style="padding:5px;"><input type="file" name="gallery_photo" id="gallery_photo" value="<?php echo $gallery_res['gallery_photo'];?>" ><input type="hidden" name="prev_gallery_photo" id="prev_gallery_photo" value="<?php echo $gallery_res['gallery_photo'];?>" ><br />
			<?php
			if( $gallery_res['gallery_photo'] != '') { 
					$img_title = $gallery_res['file_title'];
				if($gallery_res['alternate_text'] == '') {
					$img_alt = $gallery_res['file_title'];
				}
				echo '<img src="'.$gallery_res['file_url'].'" width="80" height="80" alt="'.$img_alt.'" title="'.$img_title.'" >'; }?>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:110px;padding:5px;"><label class="setting_lbl"><?php _e('Title : ','templatic');?></label></td>
			<td align="left" valign="top"  style="padding:5px;"><input type="text" name="file_title" id="file_title" value="<?php echo $gallery_res['file_title'];?>" ><p><?php _e('Select room type which you want to add image under this room type','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:110px;padding:5px;"><label class="setting_lbl"><?php _e('Alternate Text : ','templatic');?></label></td>
			<td align="left" valign="top"  style="padding:5px;"><input type="text" name="alternate_text" id="alternate_text" value="<?php echo $gallery_res['alternate_text'];?>" ><p><?php _e('Enter alternate text it will consider as \'alt\' tag in \'img\' element','templatic');?> </p></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:110px;padding:5px;"><label class="setting_lbl"><?php _e('Description : ','templatic');?></label></td>
			<td align="left" valign="top"  style="padding:5px;"><textarea name="img_description" id="img_description"  ></textarea><p><?php _e('Enter Image description','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:110px;padding:5px;"><label class="setting_lbl"><?php _e('Sort Order : ','templatic');?></label></td>
			<td align="left" valign="top"  style="padding:5px;"><input type="text" name="sortorder" id="g_sortorder" value="<?php echo $gallery_res['sortorder'];?>" ><p><?php _e('Specify the order in which the images are listed. (eg. 1, 2, 3)','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top">&nbsp;</td>
			<td align="left" valign="top"><input type="submit" name="submit" value="<?php _e('Submit','templatic');?>" class="button-framework-imp"></td>
		</tr>
	</table>
</form>