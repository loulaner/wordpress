<?php
global $wpdb;
$additional_price_master = $wpdb->prefix . "additional_price_master";
$room_type_table = $wpdb->prefix . "room_type_master";
$price_table = $wpdb->prefix . "room_type_price";
$additional_child_table = $wpdb->prefix . "additional_price_child";
if($_POST['priceact'] == 'addprice')
{	
	$room_type_id = $_POST['room_type_id'];
	$from_date	= $_POST['from_date'];
	$to_date	= $_POST['to_date'];
	
	$price_status = $_POST['price_status'];
	
	if($_POST['additional_price_id'] == ''){
		$insert_price_master = "INSERT INTO $additional_price_master (additional_price_id,room_type_id,from_date,to_date,price_status) VALUES('','".$room_type_id."','".$from_date."','".$to_date."','".$price_status."') ";
		$wpdb->query($insert_price_master);
		$add_insert_id = mysql_insert_id();
		if($_POST['person'] != '') {
			foreach($_POST['person'] as $room_key => $room_value){
				$total_price = $_POST['new_total_price'][$room_key];
				$insert_price_child = "INSERT INTO $additional_child_table (additional_child_id,additional_price_id,person,additional_price) VALUES('','".$add_insert_id."','".$room_value."','".$total_price."') ";
				$wpdb->query($insert_price_child);
			}
		} 
		$msg = "add";
	} else {
		$additional_price_id = $_POST['additional_price_id'];
		$wpdb->query("update $additional_price_master set room_type_id = '".$room_type_id."',from_date = '".$from_date."',to_date = '".$to_date."',price_status = '".$price_status."' where additional_price_id = '".$additional_price_id."'");
		if($_POST['person'] != '') {
			foreach($_POST['person'] as $room_key => $room_value){
				$total_price = $_POST['new_total_price'][$room_key];
				$update_price_child = "update $additional_child_table set additional_price = '".$total_price."' where additional_price_id = '".$additional_price_id."' and person = '".$room_value."'";
				$wpdb->query($update_price_child);
			}
		} 
		$msg = "edit";
	}

	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_room_price" method=get name="room_type_success">
	<input type=hidden name="page" value="manage_room_type"><input type=hidden name="addeditmsg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"></form>';
	echo '<script>document.room_type_success.submit();</script>';
}
if($_REQUEST['additional_price_id'] != '')
{
	$price_sql = "select am.*,ac.* from $additional_price_master am,$additional_child_table ac where am.additional_price_id = '".$_REQUEST['additional_price_id']."' and am.additional_price_id = ac.additional_price_id";
	$price_info = mysql_query($price_sql);
	$price_res = mysql_fetch_array($price_info);
	$price_title = 'Edit Additional Room Price';
	$price_msg = '在这里可以编辑季节性价格.';
} else {
	$price_title = '添加季节性房间价格';
	$price_msg = '在这里可以添加季节性价格.';
}
?>
<script>var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dhtmlgoodies_calendar.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/library/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />
<script src="<?php echo PLUGIN_URL_ROOM;?>js/ajax.js"></script>
 <div class='headerdivh3'>
	<h3><?php _e($price_title,'templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_room_type#option_display_room_price"" name="btnviewlisting" class="button-primary" title="<?php _e('Back to Seasonal Price List','templatic');?>"/><?php _e('&laquo; Back to Seasonal Price List','templatic'); ?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e($price_msg,'templatic');?></p>
</div>
<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_room_type&pagetype=addedit&mod=price&additional_price_id=<?php echo $_REQUEST['additional_price_id'];?>" method="post" name="price_frm" id="price_frm" onsubmit="return room_price_validation();">
	<input type="hidden" name="priceact" value="addprice">
	<input type="hidden" name="additional_price_id" value="<?php echo $_REQUEST['additional_price_id'];?>">
	<h3><?php _e('Select Duration :','templatic');?> </h3>
	<table width="100%" cellspacing="2" cellpadding="2" border="0" class="widefat post fixed">	
		<tr>
			<td align="left" valign="top"  style="width:100px;">*&nbsp;<?php _e('From Date :','templatic');?></td>
			<td align="left" valign="top"><input name="from_date" type="text"  value="<?php echo $price_res['from_date'];?>" style="width:120px;" id="from_date"></td>
			<td align="left" valign="top" style="width:24px;"><img src="<?php echo get_template_directory_uri().'/images/cal.gif';?>" alt="Calendar"  onclick="displayCalendar(document.price_frm.from_date,'yyyy-mm-dd',this)" class="i_calendar" align="absmiddle" border="0" /></td>		
			<td align="left" valign="top"  style="width:100px;">*&nbsp;<?php _e('To Date :','templatic');?></td>
			<td align="left" valign="top"><input name="to_date" type="text"  value="<?php echo $price_res['to_date'];?>" style="width:120px;" id="to_date"></td>
			<td align="left" valign="top" style="width:24px;"><img src="<?php echo get_template_directory_uri().'/images/cal.gif';?>" alt="Calendar"  onclick="displayCalendar(document.price_frm.to_date,'yyyy-mm-dd',this)" class="i_calendar" align="absmiddle" border="0" />
			</td>
		</tr>
	</table><p><?php _e('Seasonal price will be applied between the dates selected in this calendar','templatic');?> </p>
	
		<?php if($_REQUEST['additional_price_id'] == ''){ ?>
		<h3><?php _e('Select Room Type :','templatic');?></h3>
		<select name="room_type_id" id="room_type_id" onchange="fill_room_price(this.value);"><option value="">选择房间类型</option><?php echo room_type_cmb($price_res['room_type_id']);?></select>
		<?php } else {
			echo '<input type="hidden" name="room_type_id" id="room_type_id" value="'.$price_res['room_type_id'].'">';
		}?>
		<div id="filldiv"><?php if($_REQUEST['additional_price_id'] != ''){
			$room_price_master = $wpdb->prefix . "room_type_price";
			$room_price_sql = mysql_query("select person,price from $room_price_master where room_type_id = '".$price_res['room_type_id']."'");
			echo '<strong>'.fecth_room_type_name($price_res['room_type_id']).'</strong>:<br /><br /><table width="100%" cellspacing="2" cellpadding="6" border="0" class="widefat post fixed">';
			while($room_price_res = mysql_fetch_array($room_price_sql)){
				$price_person = '';
				if($room_price_res['person'] == '1'){
					$price_person = 'person';
				} else {
					$price_person = 'persons';
				}
				
				$additional_price_sql = mysql_query("select ac.additional_price from $additional_price_master am,$additional_child_table ac where am.additional_price_id = ac.additional_price_id and am.room_type_id = '".$price_res['room_type_id']."' and ac.person = '".$room_price_res['person']."'");
				if(mysql_num_rows($additional_price_sql) > 0){
					$add_res = mysql_fetch_array($additional_price_sql);
					$price = $add_res['additional_price'];
				}else {
					$price = $room_price_res['price'];
				}
				echo '<tr>
						<td align="left" valign="top"  style="width:80px;border:none;"><strong>'.$room_price_res['person'].'&nbsp;'.$price_person.' :</strong></td>
						<td align="left" valign="top"  style="width:50px;border:none;">原价格 :</td>
						<td align="left" valign="top"  style="width:120px;border:none;"><input type="text" value="'.$price.'" name="total_price[]" id="total_price" readonly style="width:100px;"><input type="hidden" value="'.$room_price_res['person'].'" name="person[]" id="person" readonly style="width:100px;"></td>
						<td align="left" valign="top"  style="width:60px;border:none;">新价格 :</td>
						<td align="left" valign="top"  style="width:120px;border:none;"><input type="text" value="'.$price.'" name="new_total_price[]" id="new_total_price" style="width:100px;"></td>
					</tr>';
			}
			echo '</table>';
		}
		?></div>
	<br /><br />
	
	<table width="100%" cellspacing="2" cellpadding="6" border="0" class="widefat post fixed">	
		<tr>		
			<td align="left" valign="top"  style="width:120px;">*&nbsp;<?php _e('Activated :','templatic');?></td>
			<td align="left" valign="top" colspan="2"><input type="radio" id="price_status" name="price_status" value="Y" <?php if($price_res['price_status'] == 'Y' || $price_res['price_status'] == ''){?>checked="checked"<?php }?> /><label><?php _e('Yes','templatic');?></label>&nbsp;&nbsp;<input type="radio" id="price_status" name="price_status" <?php if($price_res['price_status'] == 'N'){?> checked="checked"<?php }?> value="N" />
					<label><?php _e('No','templatic');?></label>
			</td>
		</tr>
		<tr>
		<td align="left" valign="top" colspan="2"><input type="submit" name="submit" value="<?php _e('Submit','templatic');?>" class="button"></td>
	</tr>
	</table><br /><br />
	</form>
<script>
function fill_room_price(room_type_id){
	if (document.getElementById('room_type_id').value == "") {
		document.getElementById('filldiv').innerHTML = '<img src="<?php echo PLUGIN_URL_ROOM;?>images/error.gif">&nbsp;&nbsp;<font style="color:#990000;font-weight:bold;">请选择房间类型</font>'; 
	} else {
		document.getElementById('filldiv').innerHTML = '<img src="<?php echo PLUGIN_URL_ROOM;?>images/LoadingImg.gif">&nbsp;&nbsp;<font style="color:#990000;font-weight:bold;">Please wait while data is loading.</font>';
		url = "<?php echo PLUGIN_URL_ROOM;?>fill_room_price.php?room_type_id="+room_type_id
		callAjax("filldiv",url);
	}
}

</script>