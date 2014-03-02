<?php
function get_room_type_data($room_type_id,$mode,$total_room = '',$check_in_date = '',$check_out_date = ''){
	global $wpdb;
	$room_type_table = $wpdb->prefix . 'room_type_master';	
	$room_gallery = $wpdb->prefix . 'room_type_gallery';	
	$room_type_display = '';
	$fetch_room_capacity_sql = mysql_query("select * from $room_type_table where room_type_id = '".$room_type_id."'");
	$fetch_room_capacity_res = mysql_fetch_array($fetch_room_capacity_sql);
	$fetch_room_gallery_sql = mysql_query("select * from $room_gallery where room_type_id = '".$room_type_id."'");
	$fetch_room_gallery_res = mysql_fetch_array($fetch_room_gallery_sql);
	$cwupload_dir =  $fetch_room_gallery_res['file_url'];	
	$img_title = $fetch_room_gallery_res['file_title'];
	$room_type_display .= '<h4>'.fecth_room_type_name($fetch_room_capacity_res['room_type_id']).':</h4>';
	if($fetch_room_gallery_res['alternate_text'] == '') {
		$img_alt = $fetch_room_gallery_res['file_title'];
	}if($mode == 'full'){
		$room_type_display .= '<div style="width:100%;float:left;">
			<div class="divimg"><img src="'.templ_thumbimage_filter($cwupload_dir,'&amp;w=150&amp;h=150&amp;zc=1&amp;q=80').'" alt="'.$img_alt.'" title="'.$img_title.'" class="alignleft"></div>
			<div class="divdesc">'.tep_word_trim($fetch_room_capacity_res['room_type_description'],40).'</div><br />
			<div class="leftbtn"><a href="'.get_option('siteurl').'/?ptype=hotel_detail&room='.$room_type_id.'" title="'.fecth_room_type_name($room_type_id).'" target="_blank">View Detail</a></div>
			<div class="rightbtn"><input type="submit" name="book_now" id="book_now" value="Book Now"  class="b_submit" ></div>
		</div>'; 
	} else if($mode == 'inner') {
		$r_cnt = 0;
		$room_type_display .= '<div style="width:100%;float:left;">
			<div class="divimg"><img src="'.templ_thumbimage_filter($cwupload_dir,'&amp;w=150&amp;h=150&amp;zc=1&amp;q=80').'" alt="'.$img_alt.'" title="'.$img_title.'" class="alignleft"></div>
			<div class="divdesc">'.tep_word_trim($fetch_room_capacity_res['room_type_description'],40).'</div><br />
		</div><br />';
	
		
	} else {
		$room_type_display .= '<div style="width:100%;float:left;">
			<div class="divimg"><img src="'.templ_thumbimage_filter($cwupload_dir,'&amp;w=150&amp;h=150&amp;zc=1&amp;q=80').'" alt="'.$img_alt.'" title="'.$img_title.'" class="alignleft"></div>
			<div class="divdesc">'.$fetch_room_capacity_res['room_type_description'].'</div><br />
		</div>'; 	
	}
	return $room_type_display;
} 
function get_price_cmb($room_type_id,$check_in_date = '',$check_out_date = ''){
	global $wpdb;
	$additional_price_table = $wpdb->prefix . "additional_price_master";
	$additional_child_table = $wpdb->prefix . "additional_price_child";
	$price_table = $wpdb->prefix . "room_type_price";
	$check_ain_date = strtotime($check_in_date);
	$check_aout_date = strtotime($check_out_date);
	$check_days_between = ceil(abs($check_aout_date - $check_ain_date) / 86400);
	$chk_additional_price_sql = mysql_query("select additional_price_id from $additional_price_table where from_date <= '".$check_in_date."' and room_type_id = '".$room_type_id."'");
	if(mysql_num_rows($chk_additional_price_sql) > 0){
		$from_date = strtotime($from_date);
		$to_date = strtotime($to_date);
		$from_days_between = ceil(abs($to_date - $from_date) / 86400);
		return true;
	} else {
		return false;
	}
}
function chk_additional_price($room_type_id,$check_in_date = '',$check_out_date = '',$person = ''){
	$chk_cmb_display = '';
	global $wpdb;
	$additional_price_table = $wpdb->prefix . "additional_price_master";
	$additional_child_table = $wpdb->prefix . "additional_price_child";
	$price_table = $wpdb->prefix . "room_type_price";
	$chk_additional_price_sql = mysql_query("select additional_price_id from $additional_price_table where (from_date <= '".$check_in_date."' or to_date >= '".$check_out_date."') and room_type_id = '".$room_type_id."' and price_status ='Y'");
	if(mysql_num_rows($chk_additional_price_sql) > 0){
		$chk_additional_price_res = mysql_fetch_array($chk_additional_price_sql);
		$price_child_sql = mysql_query("select additional_price,person from $additional_child_table where additional_price_id = '".$chk_additional_price_res['additional_price_id']."' order by person");
		while($price_child_res = mysql_fetch_array($price_child_sql)){
			if($person == $price_child_res['person']){
				$person_select = "selected";
			} else {
				$person_select = "";
			}	
			if($price_child_res['person'] == '1'){
				$person = $price_child_res['person'].' Person';
			} else {
				$person = $price_child_res['person'].' Persons';
			}
			$chk_cmb_display .= '<option value="'.$price_child_res['additional_price'].'" '.$person_select.'>'.$person.' '.display_amount_with_currency($price_child_res['additional_price'],display_currency()).'</option>';
		}	
	}else {
		$price_child_sql = mysql_query("select price,person from $price_table where room_type_id = '".$room_type_id."' order by person");
		while($price_child_res = mysql_fetch_array($price_child_sql)){
			if($price_child_res['person'] == '1'){
				$person = $price_child_res['person'].' Person';
			} else {
				$person = $price_child_res['person'].' Persons';
			}
			if($person == $price_child_res['person']){
				$person_select = "selected";
			} else {
				$person_select = "";
			}
			$chk_cmb_display .= '<option value="'.$price_child_res['price'].'" '.$person_select.'>'.$person.' '.display_amount_with_currency($price_child_res['price'],display_currency()).'</option>';
		}
	}
	return $chk_cmb_display;
}
function to_get_services(){
	$service_display = '';
	global $wpdb;
	$s_count = 0;
	$service_master = $wpdb->prefix . "service_master";
	$service_find_sql = mysql_query("select service_id,service_name,service_price from $service_master ");
	while($service_find_res = mysql_fetch_array($service_find_sql)){
		if($_SESSION['booking_info']['service_id'] != ''){
			$service_checked = '';
			$service_value = $_SESSION['booking_info']['service_id'][$s_count];
			
			if($service_find_res['service_id'] == $service_value){
				$service_checked = 'checked';
			} else {
				$service_checked = '';
			}
			$s_count ++;
		}
		$service_display .= '<span class="bfr_service"><input type="checkbox" value="'.$service_find_res['service_id'].'" name="service_id[]" id="service_id_'.$service_find_res['service_id'].'" '.$service_checked.' />&nbsp;'.$service_find_res['service_name'].'&nbsp;('.display_amount_with_currency($service_find_res['service_price'],display_currency()).')</span>';
	}
	return $service_display;
}
function tep_word_trim($string, $count, $ellipsis = FALSE){
	$words = explode(' ', strip_tags($string));
	if (count($words) > $count)	{
		array_splice($words, $count);
		$string = implode(' ', $words);
		if (is_string($ellipsis)){
			$string .= $ellipsis;
		}elseif ($ellipsis){
			$string .= '&hellip;';
		}
	}
	return $string;
}
function get_service_data($service_id){
	global $wpdb;
	$service_master = $wpdb->prefix . "service_master";
	$service_display = '';
	$service_find_sql = mysql_query("select service_id,service_name,service_price from $service_master where service_id = '".$service_id."'");
	$service_find_res = mysql_fetch_array($service_find_sql);
	$service_display .= '<span><label class="booking_label">'.$service_find_res['service_name'].'</label> : '.display_amount_with_currency($service_find_res['service_price'],display_currency()).'</span>';
	return $service_display;
}
function tex_include($room_type_id){
	global $wpdb;
	$room_type_master = $wpdb->prefix . "room_type_master";
	$has_tax_value = mysql_query("select has_tax from $room_type_master where room_type_id = '".$room_type_id."'");
	$has_tax_res = mysql_fetch_array($has_tax_value);
	if($has_tax_res['has_tax'] == 'Y'){
		return true;	
	} else {
		return false;	
	}
}
function get_service_price($service_id){
	global $wpdb;
	$service_master = $wpdb->prefix . "service_master";
	$service_price = 0;
	foreach($service_id as $skey => $svalue){
		$service_find_sql = mysql_query("select service_price from $service_master where service_id = '".$svalue."'");
		$service_find_res = mysql_fetch_array($service_find_sql);
		$service_price += $service_find_res['service_price'];
	}
	return $service_price;
}
function get_booking_data($booking_id,$field_name,$prefix){
	global $wpdb;
	$booking_master = $wpdb->prefix . "booking_master";
	$booking_personal_info = $wpdb->prefix . "booking_personal_info";
	$booking_data_sql = mysql_query("select ".$prefix.'.'.$field_name." from $booking_master bm,$booking_personal_info bp where bm.booking_id = '".$booking_id."' and bm.booking_id = bp.booking_id");
	$booking_data_res = mysql_fetch_array($booking_data_sql);
	return $booking_data_res[$field_name];
}
function booking_request_mail($booking_id) { 
global $wpdb; 
	$booking_personal_info = $wpdb->prefix . "booking_personal_info";
	$templatic_last_booking = $wpdb->get_row("select concat(title,' ',first_name,' ',last_name)as customer_name,email from $booking_personal_info where booking_id ='".$booking_id."'");
	$email_setting = $wpdb->prefix . "email_configuration";
	$templatic_request_mail = $wpdb->get_row("select * from $email_setting");
	$request_email = $templatic_request_mail->request_email;
	$cancel="<a href='".get_option('siteurl')."/?ptype=cancel_booking&booking_id=".$booking_id."'>".get_option('siteurl')."/?ptype=cancel_booking&booking_id=".$booking_id."</a>";
	$templatic_booking_list_user = $wpdb->get_row("select * from $email_setting");
	$request_usermail = str_replace('[USER_NAME]',$templatic_last_booking->customer_name,$request_email);
	$regard_content = '<strong>'.fetch_hotel_info('hotel_name').'</strong><br />'.fetch_hotel_info('hotel_street').'<br />'.fetch_hotel_info('hotel_state').', '.fetch_hotel_info('hotel_country');
	$email_info = fetch_hotel_info('contact_hotel_mail');
	$cnt_mail = str_replace('[CONTACT_EMAIL]',$email_info,$request_usermail);
	$booking_detail = mail_success_text_display($booking_id,'1');
	$detail_mail = str_replace('[BOOKING_DETAIL]',$booking_detail,$cnt_mail);
	$request_mail = str_replace('[CANCEL_URL]',$cancel,$detail_mail);
	$booking_email = str_replace('[ADMIN_NAME]',$regard_content,$request_mail);
	 
	$to = $templatic_last_booking->email;
	$to_name = $templatic_last_booking->customer_name;
	$from = fetch_hotel_info('mail_from');
	$from_email = $templatic_request_mail->user_email;
	$subject = $templatic_request_mail->request_email_sub;
	$templatic_booking_message = $booking_email;
	sendEmail($from_email,$from,$to,$to_name,$subject,$templatic_booking_message,$extra='');
}
function widget_user_form_booking($form_name){
	$max_adults = fetch_global_settings('max_adults');
	$max_rooms = fetch_global_settings('max_rooms');
	$form_display = '<div class="booking_form_display">
		<div class="bfr"><label class="booking_label">'.CHECK_IN_TEXT.'<small>*</small> </label> <input name="side_check_in_date" id="check_in_date" type="text" class="textfield calendar" readonly="readonly"  value="'.$_POST['side_check_in_date'].'"/><img src="'.get_template_directory_uri().'/images/i_cale.png" alt="" class="cal"  onclick="displayCalendar(document.'.$form_name.'.side_check_in_date,\'yyyy-mm-dd\',this)" />
		<span class="note">Please enter check-in date.</span> 
		</div>
		
		<div class="bfr"><label class="booking_label">'.CHECK_OUT_TEXT.'<small>*</small> </label> <input name="side_check_out_date" id="check_out_date" type="text" class="textfield calendar" readonly="readonly"  value="'.$_POST['side_check_out_date'].'" /><img src="'.get_template_directory_uri().'/images/i_cale.png" alt="" class="cal"  onclick="displayCalendar(document.'.$form_name.'.side_check_out_date,\'yyyy-mm-dd\',this)" />
		<span class="note">Please enter check-out date.</span>
		</div>
		 
		 <div class="bfr">
		<label class="booking_label">'.ADULT_TEXT.'<small>*</small></label> 
		<select name="side_adults" id="adults" class="textfield"><option value="">'.ADULT_TEXT.'</option>';
		 $a = 1;
		for($a=1;$a <= $max_adults ;$a++){
			
			$form_display .= '<option value="'.$a.'" >'.$a.'</option>';
		} 
		$form_display .= '</select> 
		<span class="note">请选择成人数.</span>
		</div>     
		
		<div class="bfr">
		<label class="booking_label">'.NO_ROOMS_TEXT.'<small>*</small></label> 
		<select name="side_no_rooms" id="side_no_rooms" class="textfield"><option value="">'.NO_ROOMS_TEXT.'</option>';
		 $n = 1;
		for($n=1;$n <= $max_rooms ;$n++){
			
			$form_display .= '<option value="'.$n.'" >'.$n.'</option>';
		} 
		$form_display .= '</select> 
		<span class="note">请选择房间数</span>
		
		</div>  
		
		<div class="bfr">
		<label class="booking_label">'.ROOM_TYPE.'<small>*</small> </label><select name="side_room_type" id="room_type" class="textfield"><option value="">选择房间类型</option>'.room_type_cmb().'</select>
		<span class="note">请选择房间类型</span>
			</div>
		</div>';
		return $form_display ;
}
function personal_info_form($form_name){
	echo '<div class="booking_form_display">
		<div class="bfr"><label class="booking_label">'.NAME_TITLE.'<small>*</small> </label> <select name="title" id="title" class="select" >'.title_cmb($_SESSION['booking_info']['title']).'</select>
		</div>
		
		<div class="bfr">
		<label class="booking_label">'.FIRST_NAME_TEXT.'<small>*</small> </label> <input type="text" name="first_name" id="first_name" value="'.$_SESSION['booking_info']['first_name'].'" class="textfield" /> 
		<!--<span class="note">提供姓.</span>--> 
		<span id="first_name_error"></span> 
		 </div>
		 
		 <div class="bfr">
		<label class="booking_label">'.LAST_NAME_TEXT.'<small>*</small></label> 
		<input type="text" name="last_name" id="last_name" value="'.$_SESSION['booking_info']['last_name'].'" class="textfield" /> 
		<!--<span class="note">提供名字.</span>--> 
		<span id="last_name_error"></span>
		</div>     
		
		<div class="bfr">
		<label class="booking_label">'.EMAIL_TEXT.'<small>*</small> </label><input type="text" name="email_id" id="email_id" value="'.$_SESSION['booking_info']['email_id'].'" class="textfield" /> 
		<!--<span class="note">提供有效的邮箱.</span>--> 
		<span id="email_id_error"></span>
		</div>
		
		<div class="bfr">
		<label class="booking_label">'.PHONE_TEXT.'<small>*</small> </label> <input type="text" name="phone" id="phone" value="'.$_SESSION['booking_info']['phone'].'" class="textfield" /> 
		<!--<span class="note">Provide Phone no.</span>--> 
		<span id="phone_error"></span>
		</div>
		
		<div class="bfr">
		<label class="booking_label">'.COUNTRY_TEXT.'<small>*</small> </label> <select name="country" id="country" class="select">'.country_cmb($_SESSION['booking_info']['country']).'</select>  <!--<span class="note">Provide your country.</span>--> 
		<span id="country_error"></span>
		</div>
		
		<div class="bfr">
		<label class="booking_label">'.CITY_TEXT.'<small>*</small> </label> <input type="text" name="city" id="city" value="'.$_SESSION['booking_info']['city'].'" class="textfield" /> 
		<!--<span class="note">Provide city.</span> --> 
		<span id="city_error"></span>
		</div>
		
		
		<div class="bfr">
		<label class="booking_label">'.STREET_TEXT.'<small>*</small> </label> <input type="text" name="street" id="street" value="'.$_SESSION['booking_info']['street'].'" class="textfield" /> 
		<!--<span class="note">Provide street.</span> --> 
		<span id="street_error"></span>
		</div>
		'.display_extra_field($form_name).'</div>';
} 
function display_extra_field($form_name){
	$display_extra_field = '';
	global $wpdb;
	$booking_field = $wpdb->prefix . "booking_field";
	$extra_field_sql = mysql_query("select * from $booking_field order by fieldposition");
	
	while($extra_field_res = mysql_fetch_array($extra_field_sql)){
		/* Is required CHECK BOF */
		$is_required = '';
		$input_type = '';
		if($extra_field_res['isfieldoptional'] == '0'){
			$is_required = '<small>*</small>';
			$is_required_msg = '<span id="'.$extra_field_res['fieldname'].'_error"></span>';
		} else {
			$is_required = '';
			$is_required_msg = '';
		}
		/* Is required CHECK EOF */
		
		switch($extra_field_res['fieldtype']){
			case 'text':
				$input_type = '<input type="text" name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" value="'.$_SESSION['booking_info'][$extra_field_res['fieldname']].'" class="'.$extra_field_res['style_class'].' textfield" '.$extra_field_res['extra_parameter'].' />';
				break;
			case 'textarea':
				$input_type = '<teaxtarea name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" class="'.$extra_field_res['style_class'].' " '.$extra_field_res['extra_parameter'].'>'.$_SESSION['booking_info'][$extra_field_res['fieldname']].'</textarea>';
				break;
			case 'selectbox':
				$input_type = '<select name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" class="'.$extra_field_res['style_class'].' select" '.$extra_field_res['extra_parameter'].'>';
				$input_type .= '<option value="">Select '.$extra_field_res['field_front_title'].'</option>';
				if($extra_field_res['fieldvalue'] != ''){
					$sselected = '';
					$field_value = explode(",",$extra_field_res['fieldvalue']);
					foreach($field_value as $vkey => $vvalue){
						if($vvalue == $_SESSION['booking_info'][$extra_field_res['fieldname']]){
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
					$checked = '';
					$field_value = explode(",",$extra_field_res['fieldvalue']);
					foreach($field_value as $vkey => $vvalue){
						if($vvalue == $_SESSION['booking_info'][$extra_field_res['fieldname']]){
							$checked = 'checked';
						} else {
							$checked = '';
						}
						$input_type .= '<input type="checkbox" name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" value="'.$vvalue.'" class="'.$extra_field_res['style_class'].'" '.$extra_field_res['extra_parameter'].' '.$checked.' />'.$vvalue.'&nbsp;&nbsp;&nbsp;';
					}
				}
				break;
			case 'multicheckbox':
				if($extra_field_res['fieldvalue'] != ''){
					$checked = '';
					$field_value = explode(",",$extra_field_res['fieldvalue']);
					foreach($field_value as $vkey => $vvalue){
						if(in_array($vvalue,$_SESSION['booking_info'][$extra_field_res['fieldname']])){
							$checked = 'checked';
						} else {
							$checked = '';
						}
						$input_type .= '<input type="checkbox" name="'.$extra_field_res['fieldname'].'[]" id="'.$extra_field_res['fieldname'].'" value="'.$vvalue.'" class="'.$extra_field_res['style_class'].'" '.$extra_field_res['extra_parameter'].' '.$checked.' />'.$vvalue.'&nbsp;&nbsp;&nbsp;';
					}
				}
				break;
			case 'radio':
				if($extra_field_res['fieldvalue'] != ''){
					$field_value = explode(",",$extra_field_res['fieldvalue']);
					$checked = '';
					foreach($field_value as $vkey => $vvalue){
						if($vvalue == $_SESSION['booking_info'][$extra_field_res['fieldname']]){
							$checked = 'checked';
						} else {
							$checked = '';
						}
						$input_type .= '<input type="radio" name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" value="'.$vvalue.'" '.$extra_field_res['extra_parameter'].' '.$checked.'/>'.$vvalue.'&nbsp;&nbsp;&nbsp;';
					}
				}
				break;
			case 'datepicker':
				$input_type = '<input name="'.$extra_field_res['fieldname'].'" id="'.$extra_field_res['fieldname'].'" type="text" class="'.$extra_field_res['style_class'].' textfield calendar" readonly="readonly" value="'.$_SESSION['booking_info'][$extra_field_res['fieldname']].'"/><img src="'.get_template_directory_uri().'/images/i_cale.png" alt=""  class="i_calendar" style="position:inline;" onclick="displayCalendar(document.'.$form_name.'.'.$extra_field_res['fieldname'].',\'yyyy-mm-dd\',this)" />';
				break;
		}
		$display_extra_field .= '<div class="bfr"><label class="booking_label">'.$extra_field_res['field_front_title'].' '.$is_required.'</label>  '.$input_type;
		if($extra_field_res['field_description'] != ''){
			$display_extra_field .= '<span class="note">'.$extra_field_res['field_description'].'</span>';	
		}
		$display_extra_field .= $is_required_msg.'</div>';
	}
	return $display_extra_field;
}
function insert_extra_field($booking_id){
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
function success_text_display($booking_id,$border='0'){
	global $wpdb;
	$booking_master = $wpdb->prefix . "booking_master";
	$booking_personal_info = $wpdb->prefix . "booking_personal_info";
	$booking_transaction = $wpdb->prefix . "booking_transaction";
	$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
	$booking_log = $wpdb->prefix . "booking_master_log";
	$display_booking_sql = $wpdb->get_row("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer,bm.pnr_no,bm.check_in_date,bm.check_out_date,bm.room_type_id,bl.total_room,bl.total_adult,bl.promotion_amt,bm.service_id,bl.tax_amt,bm.total_price,bl.without_deposite_price,bl.deposite,bl.room_price,bl.payment_method,bl.status from $booking_master bm,$booking_personal_info bp, $booking_log bl where bm.booking_id = bp.booking_id and bm.booking_id = bl.booking_id and bm.booking_id = '".$booking_id."'");
	$check_in_date = strtotime($display_booking_sql->check_in_date);
	$check_out_date = strtotime($display_booking_sql->check_out_date);
	$days_between = ceil(abs($check_out_date - $check_in_date) / 86400);
	if($display_booking_sql->service_id != ''){
		$service = explode(',',$display_booking_sql->service_id);
	} else {
		$service = '';
	}
	$paymentupdsql = "select option_value from $wpdb->options where option_name ='payment_method_".$display_booking_sql->payment_method."'";
	$paymentupdinfo = $wpdb->get_results($paymentupdsql);
	if($paymentupdinfo){
		foreach($paymentupdinfo as $paymentupdinfoObj)	{
			$option_value = unserialize($paymentupdinfoObj->option_value);
			$name = $option_value['name'];
			$option_value_str = serialize($option_value);
		}
	}
	$s_filecontent = '<table width="100%" border="'.$border.'" cellpadding="0" cellspacing="0" class="table">
			<tr>
				<td align="center" class="title">Room Type</th>
				<td align="center" class="title">Check-In/Check-Out Date</th>
				<td align="center" class="title">Total Days</th>
				<td align="center" class="title">'.OCCUPY_TEXT.'</th>
				<td align="right" class="title">Total Price</th>
			</tr>
			<tr>
				<td class="row1">'.$display_booking_sql->total_room.' x '.fecth_room_type_name($display_booking_sql->room_type_id).'</td>
				<td class="row1">'.date('d/m/Y',strtotime($display_booking_sql->check_in_date)).' to '.date('d/m/Y',strtotime($display_booking_sql->check_out_date)).'</td>
				<td class="row1">'.$days_between.'</td>
				<td class="row1">'.$display_booking_sql->total_adult.'</td>
				<td align="right" class="row1">'.$display_booking_sql->room_price.'</td>
			</tr>';
			if($display_booking_sql->promotion_amt != '0.00'){
				$s_filecontent .= '<tr>
				<td colspan="3" align="right" class="row1">'.PROMOTION.'</td>
				<td align="right" class="row1">'.display_amount_with_currency($display_booking_sql->promotion_amt,display_currency()).'</td></tr>';
			}
			if($service != ''){
				foreach($service as $skey => $svalue){
					global $wpdb;
					$service_master = $wpdb->prefix . "service_master";
					$service_find_sql = mysql_query("select service_id,service_name,service_price from $service_master where service_id = '".$svalue."'");
					$service_find_res = mysql_fetch_array($service_find_sql);
					$s_filecontent .= '<tr>
					<td colspan="4" align="right" class="row1">'.$service_find_res['service_name'].' : </td><td align="right" class="row1">'.display_amount_with_currency($service_find_res['service_price'],display_currency());
					$s_filecontent .= '</td></tr>';
				}
			}
			if(tex_include($display_booking_sql->room_type_id)){
				$s_filecontent .= '<tr>
				<td colspan="4" align="right" class="row1">'.TAX_TEXT.' : </td><td align="right" class="row1">'.$display_booking_sql->tax_amt.'</td></tr>';
			}
			$s_filecontent .= '<tr>
				<td colspan="4" align="right" class="row1">'.DEPOSITE_TEXT.' : </td><td align="right" class="row1">'.$display_booking_sql->deposite.' %</td></tr>
				<tr>
				<td colspan="4" align="right" class="total_amount_title">'.TOTAL_CHARGE_TEXT.' : </td><td align="right" class="total_amount_title">'.display_amount_with_currency($display_booking_sql->total_price,display_currency()).'</td></tr>
		</table>
		<h4>Customer Address : </h4>
		<strong>'.$display_booking_sql->customer.'</strong><br />
		'.get_booking_data($booking_id,'street','bp').', '.get_booking_data($booking_id,'city','bp').',<br />'.get_booking_data($booking_id,'country','bp').'<br /> Phone : '.get_booking_data($booking_id,'phone','bp').'
		<h4>Payment Mode : </h4>'.$name;
		return $s_filecontent;
}function mail_success_text_display($booking_id,$border='0'){
	global $wpdb;
	$booking_master = $wpdb->prefix . "booking_master";
	$booking_personal_info = $wpdb->prefix . "booking_personal_info";
	$booking_transaction = $wpdb->prefix . "booking_transaction";
	$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
	$booking_log = $wpdb->prefix . "booking_master_log";
	$display_booking_sql = $wpdb->get_row("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer,bm.pnr_no,bm.check_in_date,bm.check_out_date,bm.room_type_id,bl.total_room,bl.total_adult,bl.promotion_amt,bm.service_id,bl.tax_amt,bm.total_price,bl.without_deposite_price,bl.deposite,bl.room_price,bl.payment_method,bl.status from $booking_master bm,$booking_personal_info bp, $booking_log bl where bm.booking_id = bp.booking_id and bm.booking_id = bl.booking_id and bm.booking_id = '".$booking_id."'");
	$check_in_date = strtotime($display_booking_sql->check_in_date);
	$check_out_date = strtotime($display_booking_sql->check_out_date);
	$days_between = ceil(abs($check_out_date - $check_in_date) / 86400);
	if($display_booking_sql->service_id != ''){
		$service = explode(',',$display_booking_sql->service_id);
	} else {
		$service = '';
	}
	
	$paymentupdsql = "select option_value from $wpdb->options where option_name ='payment_method_".$display_booking_sql->payment_method."'";
	$paymentupdinfo = $wpdb->get_results($paymentupdsql);
	if($paymentupdinfo){
		foreach($paymentupdinfo as $paymentupdinfoObj)	{
			$option_value = unserialize($paymentupdinfoObj->option_value);
			$name = $option_value['name'];
			$option_value_str = serialize($option_value);
		}
	}
	$s_filecontent = '<h4>Your Booking Details are : </h4>
					<span><label style="width:150px;float:left;font-weight:bold;">'.CHECK_IN_TEXT.'</label> : '.date('d F Y',strtotime($display_booking_sql->check_in_date)).'</span><br />
					<span><label style="width:150px;float:left;font-weight:bold;">'.CHECK_OUT_TEXT.'</label> : '.date('d F Y',strtotime($display_booking_sql->check_out_date)).'</span><br />
					<span><label style="width:150px;float:left;font-weight:bold;">'.ROOM_TYPE.'</label> : '.fecth_room_type_name($display_booking_sql->room_type_id).'</span><br />
					<span><label style="width:150px;float:left;font-weight:bold;">'.NO_ROOMS_TEXT.'</label> : '.$display_booking_sql->total_room.'</span><br />
					<span><label style="width:150px;float:left;font-weight:bold;">'.OCCUPY_TEXT.'</label> : '.$display_booking_sql->total_adult.'</span><br />
					<span><label style="width:150px;float:left;font-weight:bold;">'.DAYS_TEXT.'</label> : '.$days_between.'</span><br />
					<span><label style="width:150px;float:left;font-weight:bold;">'.ROOM_PRICE_TEXT.'</label> : '.$display_booking_sql->room_price.' </span><br />';
					if($display_booking_sql->promotion_amt != '0.00'){
					$s_filecontent .= '<span><label style="width:150px;float:left;font-weight:bold;">'.PROMOTION.'</label> : '.display_amount_with_currency($display_booking_sql->promotion_amt,display_currency()).' </span><br />';
					}
					if($service != ''){
						foreach($service as $skey => $svalue){
							global $wpdb;
							$service_master = $wpdb->prefix . "service_master";
							$service_find_sql = mysql_query("select service_id,service_name,service_price from $service_master where service_id = '".$svalue."'");
							$service_find_res = mysql_fetch_array($service_find_sql);
							$s_filecontent .= '<span><label style="width:150px;float:left;font-weight:bold;">'.$service_find_res['service_name'].'</label> : '.display_amount_with_currency($service_find_res['service_price'],display_currency()).'</span><br />';
						}
					}
					if(tex_include($room_type)){	
					$s_filecontent .= '<span><label style="width:150px;float:left;font-weight:bold;">'.TAX_TEXT.'</label> : '.$display_booking_sql->tax_amt.'</span><br />';
					}
					
					$s_filecontent .= '<span><label style="width:150px;float:left;font-weight:bold;">'.DEPOSITE_TEXT.'</label> : '.$display_booking_sql->deposite.'% </span><br />
					<span><label style="width:150px;float:left;font-weight:bold;">'.TOTAL_CHARGE_TEXT.'</label> : '.display_amount_with_currency($display_booking_sql->total_price,display_currency()) .'</span><br />
		<h4>Customer Address : </h4>
		<strong>'.$display_booking_sql->customer.'</strong><br />
		'.get_booking_data($booking_id,'street','bp').', '.get_booking_data($booking_id,'city','bp').',<br />'.get_booking_data($booking_id,'country','bp').'<br /> Phone : '.get_booking_data($booking_id,'phone','bp').'
		<h4>Payment Mode : </h4>'.$name;
		return $s_filecontent;
}
?>