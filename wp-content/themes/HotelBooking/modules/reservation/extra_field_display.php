<?php 
function booking_display_extra_field($form_name,$booking_id = ''){
	$display_extra_field = '';
	global $wpdb;
	$booking_field = $wpdb->prefix . "booking_field";
	$booking_field_value = $wpdb->prefix . "booking_field_value";
	$extra_field_sql = mysql_query("select * from $booking_field order by fieldposition");
	while($extra_field_res = mysql_fetch_array($extra_field_sql)){
		/* Is required CHECK BOF */
		$is_required = '';
		$input_type = '';
		if($extra_field_res['fieldoptional'] == '0'){
			$is_required = '*';
		} else {
			$is_required = '';
		
		}
		if($booking_id != ''){
			$extra_field_value_sql = mysql_query("select * from $booking_field_value where booking_id = '".$booking_id."' and field_id = '".$extra_field_res['field_id']."'");
			$extra_field_value_res = mysql_fetch_array($extra_field_value_sql);
			$extra_field_value = $extra_field_value_res['field_value'];
		}
		/* Is required CHECK EOF */
		switch($extra_field_res['fieldtype']){
			case 'text':
				$input_type = '<input type="text" name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" value="'.$extra_field_value.'"  '.$extra_field_res['extra_parameter'].'>';
				break;
			case 'textarea':
				$input_type = '<teaxtarea name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" '.$extra_field_res['extra_parameter'].'>'.$extra_field_value.'</textarea>';
				break;
			case 'selectbox':
				$input_type = '<select name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'"  '.$extra_field_res['extra_parameter'].'>';
				$input_type .= '<option value="">Select '.$extra_field_res['field_front_title'].'</option>';
				if($extra_field_res['fieldvalue'] != ''){
					$field_value = explode(",",$extra_field_res['fieldvalue']);
					$sselected = '';
					foreach($field_value as $vkey => $vvalue){
						if($vvalue == $extra_field_value){
							$sselected = 'selected';
						} else {
							$sselected = '';
						}
						$input_type .= '<option value="'.$vvalue.'" '.$sselected.'>'.$vvalue.'</option>';
					}
				}
				$input_type .= '</select>';
				break;
			case 'checkbox':
				if($extra_field_res['fieldvalue'] != ''){
					$field_value = explode(",",$extra_field_res['fieldvalue']);
					foreach($field_value as $vkey => $vvalue){
						if($vvalue == $extra_field_value){
							$checked = 'checked';
						} else {
							$checked = '';
						}
						$input_type .= '<input type="checkbox" name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" value="'.$vvalue.'"  '.$extra_field_res['extra_parameter'].' '.$checked.'>'.$vvalue.'&nbsp;&nbsp;&nbsp;';
					}
				}
				break;
			case 'multicheckbox':
				if($extra_field_res['fieldvalue'] != ''){
					$field_value = explode(",",$extra_field_res['fieldvalue']);
					$extra_field_value_array = explode(",",$extra_field_value);
					foreach($field_value as $vkey => $vvalue){
						if(in_array($vvalue,$extra_field_value_array)){
						
							$checked = 'checked';
						} else {
							$checked = '';
						}
						$input_type .= '<input type="checkbox" name="'.$extra_field_res['fieldname'].'[]" id="'.$extra_field_res['fieldname'].'" value="'.$vvalue.'"  '.$extra_field_res['extra_parameter'].' '.$checked.'>'.$vvalue.'&nbsp;&nbsp;&nbsp;';
					}
				}
				break;
			case 'radio':
				if($extra_field_res['fieldvalue'] != ''){
					$field_value = explode(",",$extra_field_res['fieldvalue']);
					foreach($field_value as $vkey => $vvalue){
						if($vvalue == $extra_field_value){
							$checked = 'checked';
						} else {
							$checked = '';
						}
						$input_type .= '<input type="radio" name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" value="'.$vvalue.'" '.$extra_field_res['extra_parameter'].'  '.$checked.'>'.$vvalue.'&nbsp;&nbsp;&nbsp;';
					}
				}
				break;
			case 'datepicker':
				$input_type = '<input name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" type="text" class="calendar" readonly="readonly" value="'.$extra_field_value.'"/><img src="'.get_template_directory_uri().'/images/i_cale.png" alt=""  class="i_calendar" style="position:inline;" onclick="displayCalendar(document.'.$form_name.'.'.$extra_field_res['fieldname'].',\'yyyy-mm-dd\',this)" />';
				break;
		}
		$display_extra_field .= '<tr>
									<td align="left" valign="top" style="width:100px;"><label class="setting_lbl">'.$is_required.'&nbsp;'.$extra_field_res['field_front_title'].' : </td><td align="left" valign="top">'.$input_type.'<p>'.$extra_field_res['field_description'].'</p></td>
								</tr>';
		
	}
	return $display_extra_field;
}
function booking_insert_extra_field($booking_id){
	global $wpdb;
	$booking_field = $wpdb->prefix . "booking_field";
	$booking_field_value = $wpdb->prefix . "booking_field_value";
	$extra_field_sql = mysql_query("select * from $booking_field order by fieldposition");
	while($extra_field_res = mysql_fetch_array($extra_field_sql)){
		if(isset($_POST[$extra_field_res['fieldname']]) && $_POST[$extra_field_res['fieldname']] != '') {
			if(is_array($_POST[$extra_field_res['fieldname']])) { 
				$field_value = implode(',',$_POST[$extra_field_res['fieldname']]);
			} else {
				$field_value = $_POST[$extra_field_res['fieldname']];
			}
			$insert_extra_field = "insert into $booking_field_value values(null,'".$booking_id."','".$extra_field_res['field_id']."','".$field_value."')";
			$wpdb->query($insert_extra_field);
		}
	}
}
function booking_update_extra_field($booking_id){
	global $wpdb;
	$field_value = '';
	$booking_field = $wpdb->prefix . "booking_field";
	$booking_field_value = $wpdb->prefix . "booking_field_value";
	$extra_field_sql = mysql_query("select * from $booking_field order by fieldposition");
	while($extra_field_res = mysql_fetch_array($extra_field_sql)){
		if(isset($_POST[$extra_field_res['fieldname']]) && $_POST[$extra_field_res['fieldname']] != '') {
			if(is_array($_POST[$extra_field_res['fieldname']])) { 
				$field_value = implode(',',$_POST[$extra_field_res['fieldname']]);
			} else {
				$field_value = $_POST[$extra_field_res['fieldname']];
			}
			$chk_sql = mysql_query("select * from $booking_field_value where booking_id = '".$booking_id."' and field_id = '".$extra_field_res['field_id']."'");
			if(mysql_num_rows($chk_sql) > 0){
				$update_extra_field = "update $booking_field_value set field_value = '".$field_value."' where booking_id = '".$booking_id."' and field_id = '".$extra_field_res['field_id']."'";
				$wpdb->query($update_extra_field);
			} else {
				$insert_extra_field = "insert into $booking_field_value values(null,'".$booking_id."','".$extra_field_res['field_id']."','".$field_value."')";
				$wpdb->query($insert_extra_field);
			}
		}
	}
}
?>