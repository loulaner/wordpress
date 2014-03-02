<?php
global $wpdb;
$booking_master = $wpdb->prefix . "booking_master";
$booking_personal_info = $wpdb->prefix . "booking_personal_info";
$booking_transaction = $wpdb->prefix . "booking_transaction";
$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
$booking_log = $wpdb->prefix . "booking_master_log";
include('extra_field_display.php');
/*$roomNums = array('A','B','H','J','K','L','M','P','T');
$roomNumsBooked = array('A','B','L','T');
$available = array_diff($roomNums, $roomNumsBooked);
print_r($available);
echo '<br /><br />' . implode(', ', $available); */
if($_REQUEST['booking_id'] != '')
{
	$reservationsql = "select bp.*,bm.* from $booking_personal_info bp, $booking_master bm where bm.booking_id = '".$_REQUEST['booking_id']."' and bm.booking_id = bp.booking_id";
	$reservationinfo = mysql_query($reservationsql);
	$reservation_res = mysql_fetch_array($reservationinfo);
	$reservation_title = 'Edit Booking';
	$reservation_msg = '在这里可以编辑预订.';
} else {
	$reservation_title = 'Add New Booking';
	$reservation_msg = '在这里，你可以手动添加新的预订';
}
if($_POST['reservationact'] == 'addreservation')
{
	$title = $_POST['title'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$country = $_POST['country'];
	$city = $_POST['city'];
	$street = $_POST['street'];
	$check_in_date = $_POST['check_in_date'];
	$check_out_date = $_POST['check_out_date'];
	$room_type_id = $_POST['room_type_id'];
	$total_price = $_POST['total_price'];
	$no_rooms = count($_POST['room_id']);
	$deposite = fetch_global_settings('deposite_percentage');
	if($_POST['room_id'] != '') {
		$room_id_array = '';
		$last_room = count($_POST['room_id']) - 1;
		$r = 0;	
		foreach($_POST['room_id'] as $room_key => $room_value){
			if($r == $last_room) {
				$room_id_array .= $room_value;
			} else{
				$room_id_array .= $room_value.',';
			}
			$r++;	
		}
	}
	if($_POST['service_id'] != '') {
		$service_id_array = '';
		$last_service = count($_POST['service_id']) - 1;
		$s = 0;	
		foreach($_POST['service_id'] as $service_key => $service_value){
			if($s == $last_service) {
				$service_id_array .= $service_value;
			} else{
				$service_id_array .= $service_value.',';
			}
			$s++;
		}
	}
	if(tex_include($room_type_id)){
			if(fetch_global_settings('tax_type') == 'exact_amount'){
				$tax = display_amount_with_currency(fetch_global_settings('tax'),display_currency());
			}else{
				$tax = fetch_global_settings('tax').'%';
				
			}
		}
	$not_avl = 'false';
	if($_POST['booking_id'] == ''){
		
	
		$booking_master_sql = "INSERT INTO $booking_master (booking_id,check_in_date,check_out_date,booking_date,room_type_id,total_price,room_id,service_id,booking_status,ip_address) VALUES('','".$check_in_date."','".$check_out_date."',now(),'".$room_type_id."','".$total_price."','".$room_id_array."','".$service_id_array."','pending','".$_SERVER['REMOTE_ADDR']."') ";
		$wpdb->query($booking_master_sql);
		$booking_insert_id = mysql_insert_id();
		$pnr_no = 'HB'.$booking_insert_id;
		$wpdb->query("update $booking_master set pnr_no = '".$pnr_no."' where booking_id = '".$booking_insert_id."'");
		$booking_personal_sql = "INSERT INTO $booking_personal_info (personal_info_id,booking_id,title,first_name,last_name,email,phone,country,city,street) VALUES('','".$booking_insert_id."', '".$title."','".$first_name."','".$last_name."','".$email."','".$phone."','".$country."','".$city."','".$street."') ";
		$booking_log_sql = "INSERT INTO $booking_log (booking_log_id,booking_id,total_room,total_adult,tax_amt,room_price,deposite,without_deposite_price,promotion_amt,payable_amt,payment_method,status) VALUES('', '".$booking_insert_id."', '".$no_rooms."','".$no_rooms."','".$tax."','".display_amount_with_currency($total_price,display_currency())."','".$deposite."','".$total_price."','0.00','".$total_price."','payondelevary','pending') ";
		$wpdb->query($booking_log_sql);
		$wpdb->query($booking_personal_sql);
		booking_insert_extra_field($booking_insert_id);
		$not_avl = 'false';
		$msg = "add";
	} else {
		$booking_id = $_POST['booking_id'];
		if($reservation_res['room_type_id'] == $room_type_id){
			$room_arr_id = explode(',',$reservation_res['room_id']);
			$chk_rooms = array_diff($_POST['room_id'],$room_arr_id);
			$cnt = count($chk_rooms);
			if($cnt == '0'){
				$not_avl = 'false';
			} else {
				$not_avl = 'true';
				$location = site_url()."/wp-admin/admin.php#option_add_reservation";
		echo '<form action="'.$location.'" method="get" name="reservation_success" >
		<input type=hidden name="page" value="manage_reservation"><input type=hidden name="msg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"><input type=hidden name="not_avl" value="true"><input type=hidden name="booking_id" value="'.$booking_id.'"></form>';
		echo '<script>document.reservation_success.submit();</script>';
			}
			$msg = "edit";
		} 
			$wpdb->query("update $booking_master set check_in_date = '".$check_in_date."',check_out_date = '".$check_out_date."',booking_date = now(),room_type_id = '".$room_type_id."',total_price = '".$total_price."', room_id = '".$room_id_array."',service_id = '".$service_id_array."' where booking_id = '".$booking_id."'");
			$wpdb->query("update $booking_personal_info set title = '".$title."',first_name = '".$first_name."',last_name = '".$last_name."',email = '".$email."',phone = '".$phone."',country = '".$country."',city = '".$city."',street = '".$street."' where booking_id = '".$booking_id."'");
			$wpdb->query("update $booking_log set total_room = '".$no_rooms."',total_adult = '".$no_rooms."',tax_amt = '".$tax."',room_price = '".display_amount_with_currency($total_price,display_currency())."',deposite = '".$deposite."',without_deposite_price = '".$total_price."',payable_amt = '".$total_price."' where booking_id = '".$booking_id."'");
			$chk_avalability = mysql_query("select * from $booking_check_avilability where booking_id = '".$booking_id."'");
			if(mysql_num_rows($chk_avalability) > 0){
				$room_ids = explode(",",$room_id_array);
				$r_count = count($room_ids);
				$wpdb->query("update $booking_check_avilability set room_type_id = '".$room_type_id."',check_in_date = '".$check_in_date."',check_out_date = '".$check_out_date."',total_room = '".$r_count."' where booking_id = '".$booking_id."'");
			}	
			booking_update_extra_field($booking_id);
			$msg = "edit";
			$not_avl = 'false';
	}

	if($not_avl == 'true'){
		$location = site_url()."/wp-admin/admin.php#option_add_reservation";
		echo '<form action="'.$location.'" method="get" name="reservation_success" >
		<input type=hidden name="page" value="manage_reservation"><input type=hidden name="msg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"><input type=hidden name="not_avl" value="true"><input type=hidden name="booking_id" value="'.$booking_id.'"></form>';
		echo '<script>document.reservation_success.submit();</script>';
	} else {
		$location = site_url()."/wp-admin/admin.php";
		echo '<form action="'.$location.'" method="get" name="reservation_success" >
		<input type=hidden name="page" value="manage_reservation"><input type=hidden name="msg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"><input type=hidden name="not_avl" value="false"></form>';
		echo '<script>document.reservation_success.submit();</script>';
	}	
} ?>
<div class='headerdivh3'>
	<h3><?php _e($reservation_title,'templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_reservation#option_display_reservation" name="btnviewlisting" class="button-primary" title="<?php _e('Back to Booking Log','templatic');?>"/><?php _e('&laquo; Back to Booking Log','templatic'); ?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e($reservation_msg,'templatic');?></p>
</div>
<script src="<?php echo PLUGIN_URL_RESERVATION;?>js/ajax.js"></script>
<?php if($_REQUEST['not_avl'] == 'true') {
		echo '<div class="updated fade below-h2" id="message" style="padding:2px; font-size:11px;background-color: #FFEBE8;border:1px solid #CC0000;height:32px;" ><p><strong><img src="'.PLUGIN_URL_RESERVATION.'images/error.gif" >&nbsp;&nbsp;Your room(s) had been booking by the other customer from '.date('m/d/Y',strtotime($reservation_res['check_in_date'])).' to '.date('m/d/Y',strtotime($reservation_res['check_out_date'])).'<br></strong></p></div>';	
	}	
	
	?>
<script>var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dhtmlgoodies_calendar.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/library/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />
<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_reservation&pagetype=addedit&booking_id=<?php echo $_REQUEST['booking_id'];?>" method="post" name="reservation_frm" id="reservation_frm" onsubmit="return check_reservation_frm();">
	<input type="hidden" name="reservationact" value="addreservation">
	<input type="hidden" name="booking_id" id="booking_id" value="<?php echo $_REQUEST['booking_id'];?>">
	<h3><?php _e('Customer Information','templatic'); ?></h3>
	<table width="100%" cellspacing="2" cellpadding="6" border="0" class="widefat post fixed">
		<tr>
			<td align="left" valign="top" style="width:100px;"><label class="setting_lbl">&nbsp;&nbsp;<?php _e('Title :','templatic');?></label></td>
			<td align="left" valign="top"><select name="title" id="title" style="width:100px;"><?php echo title_cmb($reservation_res['title']);?></select></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;"><label class="setting_lbl">*&nbsp;<?php _e('First Name :','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="first_name" id="first_name" value="<?php echo $reservation_res['first_name'];?>"></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;"><label class="setting_lbl">*&nbsp;<?php _e('Last Name :','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="last_name" id="last_name" value="<?php echo $reservation_res['last_name'];?>"></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;"><label class="setting_lbl">*&nbsp;<?php _e('Email :','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="email" id="email" value="<?php echo $reservation_res['email'];?>"></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;"><label class="setting_lbl">*&nbsp;<?php _e('Phone :','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="phone" id="phone" value="<?php echo $reservation_res['phone'];?>"></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;"><label class="setting_lbl">*&nbsp;<?php _e('省份 :','templatic');?></label></td>
			<td align="left" valign="top"><select name="country" id="country"><?php echo country_cmb($reservation_res['country']);?></select></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;"><label class="setting_lbl">*&nbsp;<?php _e('City / State :','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="city" id="city" value="<?php echo $reservation_res['city'];?>"></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;"><label class="setting_lbl">*&nbsp;<?php _e('Street :','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="street" id="street" value="<?php echo $reservation_res['street'];?>"></td>
		</tr>
		<?php echo booking_display_extra_field('reservation_frm',$_REQUEST['booking_id']);?>
	</table><br /><br />
	<h3><?php _e('Reservation Information','templatic'); ?></h3>
	<table width="100%" cellspacing="2" cellpadding="6" border="0" class="widefat post fixed">	
		<tr>
			<td align="left" valign="top"  style="width:125px;"><label class="setting_lbl">*&nbsp;<?php _e('Check-In Date :','templatic');?></label></td>
			<td align="left" valign="top"><input name="check_in_date" type="text"  value="<?php echo $reservation_res['check_in_date'];?>" readonly="readonly"></td>
			<td align="left" valign="top" style="width:24px;"><img src="<?php echo get_template_directory_uri().'/images/cal.gif';?>" alt="Calendar"  onclick="displayCalendar(document.reservation_frm.check_in_date,'yyyy-mm-dd',this)" class="i_calendar" align="absmiddle" border="0" /></td>		
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:125px;"><label class="setting_lbl">*&nbsp;<?php _e('Check-Out Date :','templatic');?></label></td>
			<td align="left" valign="top"><input name="check_out_date" type="text"  value="<?php echo $reservation_res['check_out_date'];?>" readonly="readonly"></td>
			<td align="left" valign="top" style="width:24px;"><img src="<?php echo get_template_directory_uri().'/images/cal.gif';?>" alt="Calendar"  onclick="displayCalendar(document.reservation_frm.check_out_date,'yyyy-mm-dd',this)" class="i_calendar" align="absmiddle" border="0" /></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;"><label class="setting_lbl">*&nbsp;<?php _e('Room Type :','templatic');?></label></td>
			<td align="left" valign="top" colspan="2"><select name="room_type_id" id="room_type_id" onchange="fillroom_detail();"><option value="">选择房间类型</option><?php echo room_type_cmb($reservation_res['room_type_id']);?></select></td>
		</tr>
		<tr>
			<td align="left" valign="top" colspan="3" style="border:none;padding-bottom:10px;"><div id="filldiv">
			<?php if($_REQUEST['booking_id'] != ''){
				echo fill_room_detail($reservation_res['room_type_id'],$_REQUEST['booking_id']);	
			}?>
			</div></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;"><label class="setting_lbl">*&nbsp;<?php _e('Total Price :','templatic');?></label></td>
			<td align="left" valign="top" colspan="2"><input type="text" name="total_price" id="total_price" value="<?php echo $reservation_res['total_price'];?>"></td>
		</tr>
		<tr>
			<td align="left" valign="top">&nbsp;</td>
			<td align="left" valign="top" colspan="2"><input type="submit" name="submit" id="save" value="<?php _e('Submit','templatic');?>"  class="button-framework-imp" ></td>
		</tr>
	</table>
</form><br />
<?php 
$booking_transaction_sql = mysql_query("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer_name,bm.pnr_no,bt.booking_id,bt.booking_date,bt.transaction_date,bt.amount,bt.currency,bt.transaction_id from $booking_personal_info bp,$booking_transaction bt,$booking_master bm where bm.booking_id = bp.booking_id and bm.booking_id = bt.booking_id and bm.booking_status = 'confirm' and bm.booking_id = '".$_REQUEST['booking_id']."'");
if(mysql_num_rows($booking_transaction_sql) > 0) {?>
	<h3><?php _e('Transaction Detail','templatic');?></h3>
	<div class="divright"><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_reservation&trans_page_type=add_trans&booking_id='.$_REQUEST['booking_id'].'#option_transaction';?>" title="<?php _e('Add New Transaction','templatic');?>"><input type="button" name="submit" value="<?php _e('Add New Transaction','templatic');?>"  class="button-primary" ></a></div>
	<table width="100%" cellpadding="5" class="widefat post fixed" >
		<thead>						
		<tr>
			<th align="left"><strong><?php _e('Customer','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Transaction no.','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Book Date','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Entry Date','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Amount','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Delete','templatic'); ?></strong></th>
		</tr>
		<?php
		$total = 0;
		while($reservation_trans_data = mysql_fetch_array($booking_transaction_sql)) { 
			$total += $reservation_trans_data['amount'];		?>	
			<tr>
				<td><?php echo $reservation_trans_data['customer_name'];?></td>
				<td><?php echo $reservation_trans_data['pnr_no'];?></td>
				<td><?php echo date('Y-m-d',strtotime($reservation_trans_data['booking_date']));?></td>
				<td><?php echo date('Y-m-d',strtotime($reservation_trans_data['transaction_date']));?></td>
				<td><?php echo display_amount_with_currency($reservation_trans_data['amount'],display_currency());?></td>
				<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_reservation&pagetype=deletetransaction&transaction_id='.$reservation_trans_data['transaction_id'].'&#option_transaction';?>" onclick="return confirmSubmit();" title="<?php _e('Delete','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete','templatic');?>" border="0" /></a></td>
				
			</tr>
		<?php }	?>
		<tr>
			<td align="center" colspan="6" style="background:#eeeeee;padding:5px;"><strong><?php _e('Total Amount :','templatic'); ?> <?php echo display_amount_with_currency($total,display_currency()); ?></strong></td>
		</tr>
	</thead>					
	</table>
<?php } ?>
<script>
function fillroom_detail(){
	var room_type_id = document.getElementById('room_type_id').value;
	var booking_id = document.getElementById('booking_id').value;
	if(room_type_id != ''){
		if(booking_id != ''){
			document.getElementById('filldiv').innerHTML = '<img src="<?php echo PLUGIN_URL_RESERVATION;?>images/LoadingImg.gif">&nbsp;&nbsp;<font style="color:#990000;font-weight:bold;">Please wait while data is loading.</font>';
			url = "<?php echo PLUGIN_URL_RESERVATION;?>fill_room.php?room_type_id="+room_type_id+"&booking_id="+booking_id
			callAjax("filldiv",url);
		} else {
			document.getElementById('filldiv').innerHTML = '<img src="<?php echo PLUGIN_URL_RESERVATION;?>images/LoadingImg.gif">&nbsp;&nbsp;<font style="color:#990000;font-weight:bold;">Please wait while data is loading.</font>';
			url = "<?php echo PLUGIN_URL_RESERVATION;?>fill_room.php?room_type_id="+room_type_id
			callAjax("filldiv",url);
		}
	} else{
		document.getElementById('filldiv').innerHTML = '<img src="<?php echo PLUGIN_URL_RESERVATION;?>images/error.gif">&nbsp;&nbsp;<font style="color:#990000;font-weight:bold;">请选择房间类型</font>';
	}	
}

function check_reservation_frm()
{
	
	var ErrorMsg = "Following fields must be completed.. \n\n";
	var Error = 0;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regphone = /^((\+)?[1-9]{1,2})?([-\s\.])?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}$/;
	var regex = new RegExp("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i");
	
	if(document.getElementById('first_name').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter First Name \n\n";
		Error = 1;
	}if(document.getElementById('last_name').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Last Name \n\n";
		Error = 1;
	}if(reg.test(document.getElementById('email').value) == false) {
			ErrorMsg = ErrorMsg + "Enter Valid Email \n\n";
			Error = 1;
	}if(document.getElementById('phone').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Phone No. \n\n";
		Error = 1;
	}else {
		if(regphone.test(document.getElementById('phone').value) == false) {
			ErrorMsg = ErrorMsg + "Please Enter Valid Phone No.\n\n";
			Error = 1;
		}
	}if(document.getElementById('city').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter City \n\n";
		Error = 1;
	}if(document.getElementById('street').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Street \n\n";
		Error = 1;
	}<?php 
	$booking_field = $wpdb->prefix . "booking_field";
	$extra_field_sql = mysql_query("select * from $booking_field where isfieldoptional = '0' order by fieldposition");
	while($extra_field_res = mysql_fetch_array($extra_field_sql)){ 
		if($extra_field_res['fieldtype'] == 'checkbox' || $extra_field_res['fieldtype'] == 'radio' || $extra_field_res['fieldtype'] == 'multicheckbox'){ ?>
			var errors = 0;
			var i = 0;
			dml=document.forms['reservation_frm'];
			chk = dml.elements['<?php echo $extra_field_res['fieldname'];?>'];
			len = dml.elements['<?php echo $extra_field_res['fieldname'];?>'].length;
			if(len == 1){
				if ((dml.elements['<?php echo $extra_field_res['fieldname'];?>'].checked == false)) {
					ErrorMsg = ErrorMsg + "<?php echo  $extra_field_res['field_require_desc'];?>\n\n";
					Error = 1;
				} 
			} else {
				for( i=0 ; i<len ; i++)  {
					if ((chk[i].checked == true)) {
						errors = 0;
						break;
					} else {
						errors = 1;	
					}
				}
			}
		if(errors == 1){
			ErrorMsg = ErrorMsg + "<?php echo  $extra_field_res['field_require_desc'];?>\n\n";
			Error = 1;
		}
		<?php } else {?>
		if(document.getElementById('<?php echo $extra_field_res['fieldname'];?>').value=='')
		{
			ErrorMsg = ErrorMsg + "<?php echo  $extra_field_res['field_require_desc'];?> \n\n";
			Error = 1;
		}	
	<?php 
		}
	}	?>
	
	
	if(document.getElementById('total_price').value=='')	{
		ErrorMsg = ErrorMsg + "Please Enter Total Price \n\n";
		Error = 1;
	} 
	if(document.getElementById('room_type_id').value=='')
	{
		ErrorMsg = ErrorMsg + "请选择房间类型 \n\n";
		Error = 1;
	} else {
		var errors = 0;
		var i = 0;
		dml=document.forms['reservation_frm'];
		chk = dml.elements['room_id'];
		len = dml.elements['room_id'].length;

		for( i=0 ; i<len ; i++)  {
			if ((chk[i].checked == true)) {
				errors = 0;
				break;
			} else {
				errors = 1;	
		    }
		}
		if(errors == 1){
			ErrorMsg = ErrorMsg + "Please Select At Least One Room  \n\n";
			Error = 1;
		}
	}
	
	if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}
</script>