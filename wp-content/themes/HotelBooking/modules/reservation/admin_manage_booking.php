<script>var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dhtmlgoodies_calendar.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/library/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />
<script src="<?php echo PLUGIN_URL_RESERVATION;?>js/ajax.js"></script>
<form name="frm_chk_booking" id="frm_chk_booking" method="post" action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_reservation&pagetype=fil_reservation#option_chk_avail" onsubmit="return chk_booking_validation();">
<table width="100%" cellspacing="2" cellpadding="2" border="0" class="widefat post fixed" >	
	<tr>
		<td align="left" valign="top"  style="width:110px;border:0px;padding:5px;">*&nbsp;<?php _e('Check In Date :','templatic');?></td>
		<td align="left" valign="top" style="border:0px;padding:5px;"><input name="check_in_date" type="text"  value="<?php echo $_POST['check_in_date'];?>" style="width:120px;" id="check_in_date"></td>
		<td align="left" valign="top" style="width:24px;border:0px;padding:5px;"><img src="<?php echo get_template_directory_uri().'/images/cal.gif';?>" alt="Calendar"  onclick="displayCalendar(document.frm_chk_booking.check_in_date,'yyyy-mm-dd',this)" class="i_calendar" align="absmiddle" border="0" /></td>		
		<td align="left" valign="top"  style="width:120px;border:0px;padding:5px;">*&nbsp;<?php _e('Check Out Date :','templatic');?></td>
		<td align="left" valign="top" style="border:0px;padding:5px;"><input name="check_out_date" type="text"  value="<?php echo $_POST['check_out_date'];?>" style="width:120px;" id="check_out_date"></td>
		<td align="left" valign="top" style="width:24px;border:0px;padding:5px;"><img src="<?php echo get_template_directory_uri().'/images/cal.gif';?>" alt="Calendar"  onclick="displayCalendar(document.frm_chk_booking.check_out_date,'yyyy-mm-dd',this)" class="i_calendar" align="absmiddle" border="0" /></td>
	</tr>
	<tr>
		<td align="left" valign="top"  style="width:100px;padding:5px;">*&nbsp;<?php _e('Room Type :','templatic');?></td>
		<td align="left" valign="top" colspan="3"><select name="room_type_id" id="ch_room_type_id" style="width:200px;"><option value="">选择房间类型</option><?php echo room_type_cmb($_REQUEST['room_type_id']);?></select></td>		
		<td align="left" valign="top"  style="width:100px;" colspan="2"><input type="submit" name="submit" id="save" value="<?php _e('Submit','templatic');?>"  class="button" ></td>
	</tr>
</table>
<?php 
if($_REQUEST['pagetype'] == 'fil_reservation'){
	$fetch_booking_schedule_sql = mysql_query("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer,bm.pnr_no,bm.check_in_date,bm.check_out_date,bm.room_type_id,bl.total_room,bl.total_adult,bl.promotion_amt,bm.service_id,bl.tax_amt,bm.total_price,bl.without_deposite_price,bl.deposite,bl.room_price,bl.payment_method,bl.status,bm.booking_id from $booking_master bm,$booking_personal_info bp, $booking_log bl where bm.booking_id = bp.booking_id and bm.booking_id = bl.booking_id and (bm.check_in_date <= '".$_POST['check_in_date']."' or bm.check_out_date >= '".$_POST['check_out_date']."') and bm.room_type_id = '".$_POST['room_type_id']."' and bm.booking_status = 'publish'");
	if(mysql_num_rows($fetch_booking_schedule_sql) > 0){
		echo '<h4>'.fecth_room_type_name($_POST['room_type_id']).':</h4><div>';
		while($fetch_booking_schedule_res = mysql_fetch_array($fetch_booking_schedule_sql)){
			echo '<div style="width:260px;float:left;padding:8px;margin:4px;border:1px solid #dddddd;"><label style="width:110px;float:left;">Name</label>: '.$fetch_booking_schedule_res['customer'].'<br />
			<label style="width:110px;float:left;">Transaction No.</label>: '.$fetch_booking_schedule_res['pnr_no'].' <br />
			<label style="width:110px;float:left;">Check In Date</label>: '.date('F d, Y',strtotime($fetch_booking_schedule_res['check_in_date'])).' <br />
			<label style="width:110px;float:left;">Check Out Date</label>: '.date('F d, Y',strtotime($fetch_booking_schedule_res['check_out_date'])).'<br />
			<label style="width:110px;float:left;">No. of room(s)</label>: '.$fetch_booking_schedule_res['total_room'].'<br />
			<label style="width:110px;float:left;">Occupancy</label>: '.$fetch_booking_schedule_res['total_adult'].'<br />
			<label style="width:110px;float:left;">Payble amt</label>: '.display_amount_with_currency($fetch_booking_schedule_res['total_price'],display_currency()).'<br />
			<label style="width:110px;float:left;">Payment Type</label>: '.$fetch_booking_schedule_res['payment_method'].'<br />
			<label style="width:110px;float:left;">Deposite</label>: '.$fetch_booking_schedule_res['deposite'].' %<br />
			<label style="width:110px;float:left;">Total Amt</label>: '.display_amount_with_currency($fetch_booking_schedule_res['without_deposite_price'],display_currency()).'<br /><a href="'.PLUGIN_URL_RESERVATION.'edit_transaction.php?booking_id='.$fetch_booking_schedule_res['booking_id'].'" class="thickbox" title="Edit Transaction">Edit Transaction</a></div>';
		}
		echo '</div>';
	} else {
		echo '<center><h4>No record found...</h4></center>';
	}
}
if($_REQUEST['pagetype'] == 'update_amt'){
	$total_price = $_POST['total_price'] + $_POST['pending_amt'];
	$upd_amt = $wpdb->query("update $booking_master set total_price = '".$total_price."' where booking_id = '".$_POST['booking_id']."'");
	$upd_amt_log = $wpdb->query("update $booking_log set payable_amt = '".$total_price."' where booking_id = '".$_POST['booking_id']."'");
	$booking_trans_sql = "INSERT INTO $booking_transaction(transaction_id,booking_id,booking_date,amount,currency) VALUES('','".$_POST['booking_id']."',now(),'".$_POST['pending_amt']."','".display_currency()."') ";
	$insert_amt = $wpdb->query($booking_trans_sql);
}
?>	