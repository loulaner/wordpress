<?php
global $wpdb;
$room_type_table = $wpdb->prefix . "room_type_master";
$room_type_price_table = $wpdb->prefix . "room_type_price";
$postmeta = $wpdb->prefix . "postmeta";
if($_POST['room_typeact'] == 'addroom_type')
{
	$room_type_name = $_POST['room_type_name'];
	$room_type_description = stripslashes($_POST['room_type_description']);
	$page_title = stripslashes($_POST['page_title']);
	$page_description = stripslashes($_POST['page_description']);
	$page_keyword = stripslashes($_POST['page_keyword']);
	
	$room_type_capacity = $_POST['room_type_capacity'];
	if($_POST['has_tax'] != ''){
		$has_tax = 'Y';
	} else{
		$has_tax = 'N';
	}
	$set_default = $_POST['set_default'];
	$room_type_capacity = $_POST['room_type_capacity'];
	if($room_type_name)
	{
		if($_POST['room_type_id'] == ''){
			$insertroom_type = "INSERT INTO $room_type_table (room_type_id,room_type_name,room_type_description,room_type_capacity,has_tax,meta_title,meta_description,meta_keyword) VALUES('','".$room_type_name."','".addslashes($room_type_description)."','".$room_type_capacity."','".$has_tax."','".addslashes($page_title)."','".addslashes($page_description)."','".addslashes($page_keyword)."') ";
			
					
			$wpdb->query($insertroom_type);
			$room_type_insert_id = mysql_insert_id();
			$rc = 1;
			
			for($rc = 1; $rc < ($room_type_capacity + 1); $rc++){
				$t_price = 'roomtype_cap_price_'.$rc;
				if($_POST[$t_price] != ''){
					$price = $_POST[$t_price];
					$person = $rc;
					$insertroom_type_price = "INSERT INTO $room_type_price_table (price_id,room_type_id,person,price,modifieddate) VALUES('','".$room_type_insert_id."','".$person."','".$price."',now()) ";
					$wpdb->query($insertroom_type_price);
					
				}
			}
			$msg = "add";
		} else {
			$room_type_id = $_POST['room_type_id'];
			$wpdb->query("update $room_type_table set room_type_name = '".$room_type_name."',room_type_description = '".addslashes($room_type_description)."',room_type_capacity = '".$room_type_capacity."',has_tax = '".$has_tax."',meta_title = '".addslashes($page_title)."',meta_description = '".addslashes($page_description)."', meta_keyword = '".addslashes($page_keyword)."' where room_type_id = '".$room_type_id."'");
			$rc = 0;
			for($rc = 0; $rc < ($room_type_capacity); $rc++){
				$t_price = 'roomtype_cap_price_'.($rc+1);
				if($_POST[$t_price] != ''){
					$price_id = $_POST['room_type_price_id'][$rc];
					$price = $_POST[$t_price];
					$person = $rc + 1;
					$room_type_price_sql = mysql_query("select * from $room_type_price_table where room_type_id = '".$room_type_id."' and person = '".$person."'");
					if(mysql_num_rows($room_type_price_sql) > 0){
						$updateroom_type_price = "update $room_type_price_table set room_type_id = '".$room_type_id."',person = '".$person."',price = '".$price."',modifieddate = now() where price_id = '".$price_id."'";
					} else {
						$insertroom_type_price = "INSERT INTO $room_type_price_table (price_id,room_type_id,person,price,modifieddate) VALUES('','".$room_type_id."','".$person."','".$price."',now()) ";
						$wpdb->query($insertroom_type_price);
					}	
					$wpdb->query($updateroom_type_price);
				}
			}
			
			$msg = "edit";
		}
	
		$location = site_url()."/wp-admin/admin.php";
		echo '<form action="'.$location.'" method=get name="room_type_success">
		<input type=hidden name="page" value="manage_room_type"><input type=hidden name="msg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"></form>';
		echo '<script>document.room_type_success.submit();</script>';
		exit;
	}
}
if($_REQUEST['room_type_id'] != '')
{
	$room_typesql = "select * from $room_type_table where room_type_id = '".$_REQUEST['room_type_id']."'";
	$room_typeinfo = mysql_query($room_typesql);
	$room_type_res = mysql_fetch_array($room_typeinfo);
	$room_type_title = 'Edit Room Type';
	$room_type_msg = '在这里你可以编辑房间类型';
} else {
	$room_type_title = 'Add New Room Type';
	$room_type_msg = '在这里你可以添加新房间类型.';
}
?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
// TinyMCE BOF
tinyMCE.init({
		// General options
		mode : "textareas",
		editor_selector : "mce",
		theme : "advanced",
		plugins :"advimage,advlink,emotions,iespell,",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,blockquote,|,link,unlink,anchor,image,code",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,
		width : "400",
		height : "200",
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
		username : "Some User",
		staffid : "991234",
		}
	});

// TinyMCE EOF
</script>
 <div class='headerdivh3'>
	<h3><?php _e($room_type_title,'templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_room_type" name="btnviewlisting" class="button-primary" title="<?php _e('Back to Manage Room Type List','templatic');?>"/><?php _e('&laquo; Back to Manage Room Type List','templatic'); ?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e($room_type_msg,'templatic');?></p>
</div>
<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_room_type&pagetype=addedit&mod=roomtype&room_type_id=<?php echo $_REQUEST['room_type_id'];?>" method="post" name="room_type_frm" onsubmit="return check_room_type_frm();">
	<input type="hidden" name="room_typeact" value="addroom_type">
	<input type="hidden" name="room_type_id" value="<?php echo $_REQUEST['room_type_id'];?>">
	<table width="100%" cellspacing="2" cellpadding="2" border="0" class="widefat post fixed">	
		<tr>
			<td align="left" valign="top" style="width:160px;"><label class="setting_lbl"><?php _e('Room Type Name : ','templatic');?></td>
			<td align="left" valign="top"><input type="text" name="room_type_name" id="room_type_name" value="<?php echo $room_type_res['room_type_name'];?>"><p><?php _e('Enter Room Type Name','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" ><label class="setting_lbl"><?php _e('Room Type Description : ','templatic');?></td>
			<td align="left" valign="top"><textarea name="room_type_description" id="room_type_description" class="mce"><?php if($room_type_res['room_type_description'] != '') { echo $room_type_res['room_type_description']; } else { echo "Enter Room Type Description"; }?></textarea><p><?php _e('Enter Room Type Description','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:160px;"><label class="setting_lbl"><?php _e('Include Tax?','templatic');?></td>
			<td align="left" valign="top"><input type="checkbox" name="has_tax" id="has_tax" value="Y">&nbsp;&nbsp;<?php _e('Yes','templatic');?><p><?php _e('If checked, tax amount will be included in the final payable amount.','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:160px;"><label class="setting_lbl"><?php _e('Capacity : ','templatic');?></td>
			<td align="left" valign="top"><select name="room_type_capacity" id="room_type_capacity" onchange="cap_price();"><?php echo capability_cmb($room_type_res['room_type_capacity']);?></select><p><?php _e('Enter Capacity','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" colspan="2" style="border:0px;">
				<table width="100%" id = "display_cap_price" style="border:0px;">
				<?php if($_REQUEST['room_type_id'] != '') {	
					$room_type_price_sql = mysql_query("select * from $room_type_price_table where room_type_id = '".$_REQUEST['room_type_id']."'");
					$chekd_set = '';
					while($room_type_price_res = mysql_fetch_array($room_type_price_sql)){
						if($room_type_price_res['person'] == $room_type_res['set_default']){
							$chekd_set = "checked";
						} else{
							$chekd_set = "";
						}?>
						<tr>
							<td style="width:160px;" align="left" valign="top"><label for="price" class="setting_lbl">价格为 <?php echo $room_type_price_res['person'];?> 人: </label></td>
							<td align="left" valign="top"><input type="hidden" name="room_type_price_id[]" value="<?php echo $room_type_price_res['price_id'];?>" /><input type="text" name="roomtype_cap_price_<?php echo $room_type_price_res['person'];?>" value="<?php echo $room_type_price_res['price'];?>" onkeypress="return EnterNumber(event)" /></td>	
						</tr>	
				<?php }
				} else {?>
				<tr>
					<td style="width:160px;" align="left" valign="top"><label for="price" class="setting_lbl">价格为1人: </label></td>
					<td align="left" valign="top"><input type="text" name="roomtype_cap_price_1" value="" onkeypress="return EnterNumber(event)" /></td>	
				</tr>
				<?php } ?>	
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="border:0px;"><h3>SEO设置 : </h3></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:160px;"><label class="setting_lbl"><?php _e('Meta Title : ','templatic');?></td>
			<td align="left" valign="top"><input type="text" name="page_title" id="page_title" value="<?php echo $room_type_res['meta_title'];?>"><p><?php _e('Enter Page Title','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:160px;"><label class="setting_lbl"><?php _e('Meta Description : ','templatic');?></td>
			<td align="left" valign="top"><textarea name="page_description" id="page_description" rows="8" cols="40"><?php echo $room_type_res['meta_description'];?></textarea><p><?php _e('Enter Page Description','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="width:160px;"><label class="setting_lbl"><?php _e('Meta Keyword (comma separated) : ','templatic');?></td>
			<td align="left" valign="top"><textarea name="page_keyword" id="page_keyword"  rows="8" cols="40"><?php echo $room_type_res['meta_keyword'];?></textarea><p><?php _e('Enter Page Keyword','templatic');?></p></td>
		</tr>
		<tr>
			<td align="left" valign="top">&nbsp;</td>
			<td align="left" valign="top"><input type="submit" name="submit" value="<?php _e('Submit','templatic');?>" class="button-framework-imp"></td>
		</tr>
	</table>
		
</form>