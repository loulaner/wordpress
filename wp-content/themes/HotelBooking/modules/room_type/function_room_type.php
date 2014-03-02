<?php
define('TEMPL_ROOM_TYPE_MODULE', __("Manage Room Type",'templatic'));
define('FILEUSER', 'root');
define('TEMPL_ROOM_TYPE_CURRENT_VERSION', '1.0.0');
define('TEMPL_ROOM_TYPE_LOG_PATH','http://templatic.com/updates/modules/room_type/room_type_change_log.txt');
define('TEMPL_ROOM_TYPE_ZIP_FOLDER_PATH','http://templatic.com/updates/modules/room_type/room_type.zip');
define('TT_ROOM_TYPE_FOLDER','room_type');
define('TT_ROOM_TYPE_MODULES_PATH',TT_MODULES_FOLDER_PATH . TT_ROOM_TYPE_FOLDER.'/');
define ("PLUGIN_DIR_ROOM", basename(dirname(__FILE__)));
define ("PLUGIN_URL_ROOM", get_template_directory_uri().'/modules/'.PLUGIN_DIR_ROOM.'/');
$gen_root = $_SERVER['DOCUMENT_ROOT'];
define('DIR_FS_GALLERY_PATH',$gen_root.'/wordpress3/wp-content/uploads/');
define('DIR_WS_GALLERY_PATH',get_settings("siteurl").'/wp-content/uploads/');

//----------------------------------------------
     //MODULE AUTO UPDATE START//
//----------------------------------------------
add_action('templ_module_auto_update','templ_module_auto_update_room_type_fun');
function templ_module_auto_update_room_type_fun()
{
	$curversion = TEMPL_ROOM_TYPE_CURRENT_VERSION;
	$liveversion = tmpl_current_framework_version(TEMPL_ROOM_TYPE_LOG_PATH);
	$is_update = templ_is_updated( $curversion, $liveversion);
	if($is_update)
	{
?>
<table border="0" cellpadding="0" cellspacing="0" style="border:0px; padding:10px 0px;">
	<tr>
		<td class="module"><h3><?php echo TEMPL_ROOM_TYPE_MODULE;?></h3></td>
	</tr>
	<tr>
		<td>
			<form method="post"  name="framework_update" id="framework_update">
			<input type="hidden" name="action" value="<?php echo TT_ROOM_TYPE_FOLDER;?>" />
			<input type="hidden" name="zip" value="<?php echo TEMPL_ROOM_TYPE_ZIP_FOLDER_PATH;?>" />
			<input type="hidden" name="log" value="<?php echo TEMPL_ROOM_TYPE_LOG_PATH;?>" />
			<input type="hidden" name="path" value="<?php echo TT_ROOM_TYPE_MODULES_PATH;?>" />
			<?php wp_nonce_field('update-options'); ?>

			<?php echo sprintf(__('<h4>A new version of ManageRoom Type and Room Price Module is available.</h4>
			<p>This updater will collect a file from the templatic.com server. It will download and extract the files to your current theme&prime;s functions folder. 
			<br />We recommend backing up your theme files before updating. Only upgrade related module files if necessary.
			<br />If you are facing any problem in auto updating the framework, then please download the latest version of the theme from members area and then just overwrite the "<b>%s</b>" folder.
			<br /><br />&rArr; Your version: %s
			<br />&rArr; Current Version: %s </p>','templatic'),TT_ROOM_TYPE_MODULES_PATH,$curversion,$liveversion);?>

			<input type="submit" class="button" value="<?php _e('Update','templatic');?>" onclick="document.getElementById('framework_upgrade_process_span_id').style.display=''" />
			</form>
		</td>
	</tr>
	<tr>
		<td style="border-bottom:5px solid #dedede;">&nbsp;</td>
	</tr>
</table>
<?php
	}
}
//----------------------------------------------
     //MODULE AUTO UPDATE END//
//----------------------------------------------
/////////admin menu settings start////////////////
add_action('templ_admin_menu', 'room_type_add_admin_menu');
function room_type_add_admin_menu()
{
	add_submenu_page('templatic_wp_admin_menu', TEMPL_ROOM_TYPE_MODULE,TEMPL_ROOM_TYPE_MODULE, TEMPL_ACCESS_USER, 'manage_room_type', 'manage_room_type');
}
function manage_room_type()
{
	global $templ_module_path;
	if($_REQUEST['pagetype']=='addedit')
	{
		switch ($_REQUEST['mod']) {
			case 'roomtype':
				include_once($templ_module_path . 'admin_room_type.php');
				break;
			case 'price':
				include_once($templ_module_path . 'admin_room_type_price.php');
				break;
			case 'custom_field':
				include_once($templ_module_path . 'admin_custom_fields.php');
				break;
			case 'service':
				include_once($templ_module_path . 'admin_service.php');
				break;
			case 'gallery':
				include_once($templ_module_path . 'admin_room_gallery.php');
				break;
			case 'room':
				include_once($templ_module_path . 'admin_room.php');
				break;
		}
	}else {
			include_once($templ_module_path . 'admin_manage_room_type.php');
	}	
}
/////////admin menu settings end////////////////
function fecth_room_type_name($room_type_id){
	global $wpdb;
	$room_type_table = $wpdb->prefix . "room_type_master";
	$room_type_sql = mysql_query("select room_type_name from $room_type_table where room_type_id = '".$room_type_id."'");
	$room_type_res = mysql_fetch_array($room_type_sql);
	return $room_type_res['room_type_name'];
}
function room_type_cmb($room_type_id = ''){
	global $wpdb,$Cart,$General;
	$room_type_table = $wpdb->prefix . "room_type_master";
	$room_type_display = '';
	$room_type_sql = mysql_query("select room_type_name,room_type_id from $room_type_table");
	while($room_type_res = mysql_fetch_array($room_type_sql)){
		if($room_type_res['room_type_id'] == $room_type_id){
			$yselected = 'selected';
		} else {
			$yselected = '';
		}
		$room_type_display .= '<option value="'.$room_type_res['room_type_id'].'" '.$yselected.'>'.$room_type_res['room_type_name'].'</option>';
	}
	return $room_type_display;
}
function capability_cmb($capability = ''){
	$capability_display = '';
	$c = 1;
	for($c=1; $c < 11; $c++){
		if($capability == $c){
			$cselected = 'selected';
		} else {
			$cselected = '';
		}
		$capability_display .= '<option value="'.$c.'" '.$cselected.'>'.$c.'</option>';
	}
	return $capability_display;
}
function fetch_room_price($additional_price_id){
	global $wpdb;
	$additional_child_table = $wpdb->prefix . "additional_price_child";
	$display_price = '';
	$fetch_price_sql = "select additional_price from $additional_child_table where additional_price_id = '".$additional_price_id."'";
	$fetch_price_info = mysql_query($fetch_price_sql);
	$total_rec = mysql_num_rows($fetch_price_info);
	$rec = 1;
	while($price_res = mysql_fetch_array($fetch_price_info)) {
		if($rec == $total_rec){
			$display_price .= $price_res['additional_price'];
		} else {
			$display_price .= $price_res['additional_price'].',';
		}
	$rec++;
	}
	return $display_price;
}
function price_status_cmb($price_status = ''){
	$price_status_display = '';
	$price_status_array = array("Y"=>"Active","N"=>"Deactive","delete"=>"Delete");
	foreach($price_status_array as $price_status_key => $price_status_value){
		if($price_status == $price_status_key){
			$pselected = 'selected';
		} else {
			$pselected = '';
		}
		$price_status_display .= '<option value="'.$price_status_key.'" '.$pselected.'>'.$price_status_value.'</option>';
	}
	return $price_status_display;
}
/* ---------------------------------------------------------- Custom Field Functions BOF ------------------------------------------------------------------*/
function fetch_custom_field_type($fieldtype){
	$field_type_array = array("0"=>"Select your field type","text"=>"Text","textarea"=>"Text area","selectbox"=>"Select Box","checkbox"=>"Check box","multicheckbox"=>"Multi Check box","radio"=>"Radio button","datepicker"=>"Date");
	if($fieldtype == 'text'){
		return 'Text';
	} else if($fieldtype == 'textarea'){
		return 'Text area';
	} else if($fieldtype == 'selectbox'){
		return 'Select Box';
	} else if($fieldtype == 'checkbox'){
		return 'Check box';
	}else if($fieldtype == 'multicheckbox'){
		return 'Multi Check box';
	} else if($fieldtype == 'radio'){
		return 'Radio button';
	} else if($fieldtype == 'datepicker'){
		return 'Date';
	} else{
		return false;
	}
}
function custom_field_type_cmb($fieldtype = ''){
	$field_display = '';
	$field_type_array = array("0"=>"Select your field type","text"=>"Text","textarea"=>"Text area","selectbox"=>"Select Box","checkbox"=>"Check box","multicheckbox"=>"Multi Check box","radio"=>"Radio button","datepicker"=>"Date");
	foreach($field_type_array as $fieldkey => $fieldvalue){
		if($fieldtype == $fieldkey){
			$selected = 'selected';
		} else {
			$selected = '';
		}
		$field_display .= '<option value="'.$fieldkey.'" '.$selected.'>'.$fieldvalue.'</option>';
	}
	return $field_display;
}
function validation_type_cmb($validation_type = ''){
	$validation_type_display = '';
	$validation_type_array = array("require"=>"Require","phone_no"=>"Phone No.","digit"=>"Digit","email"=>"Email");
	foreach($validation_type_array as $validationkey => $validationvalue){
		if($validation_type == $validationkey){
			$vselected = 'selected';
		} else {
			$vselected = '';
		}
		$validation_type_display .= '<option value="'.$validationkey.'" '.$vselected.'>'.$validationvalue.'</option>';
	}
	return $validation_type_display;
}
/* ---------------------------------------------------------- Custom Field Functions EOF ------------------------------------------------------------------*/

?>