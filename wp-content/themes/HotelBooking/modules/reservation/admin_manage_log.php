<?php 
	$fetch_booking_schedule_sql = mysql_query("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer,bm.pnr_no,bm.check_in_date,bm.check_out_date,bm.room_type_id,bl.total_room,bl.total_adult,bl.promotion_amt,bm.service_id,bl.tax_amt,bm.total_price,bl.without_deposite_price,bl.deposite,bl.room_price,bl.payment_method,bl.status from $booking_master bm,$booking_personal_info bp, $booking_log bl where bm.booking_id = bp.booking_id and bm.booking_id = bl.booking_id and bm.check_in_date <= '".$_POST['check_in_date']."' or bm.check_out_date >= '".$_POST['check_out_date']."' and bm.room_type_id = '".$_POST['room_type_id']."' and bm.booking_status = 'publish'");
	if(mysql_num_rows($fetch_booking_schedule_sql) > 0){
		echo '<h4>'.fecth_room_type_name($_POST['room_type_id']).':</h4><div>';
		while($fetch_booking_schedule_res = mysql_fetch_array($fetch_booking_schedule_sql)){
			echo '<div style="width:260px;float:left;padding:8px;margin:4px;border:1px solid #dddddd;"><label style="width:110px;float:left;">Name</label>: '.$fetch_booking_schedule_res['customer_name'].'<br /><label style="width:110px;float:left;">Check In Date</label>: '.date('F d, Y',strtotime($fetch_booking_schedule_res['check_in_date'])).' <br /><label style="width:110px;float:left;">Check Out Date</label>: '.date('F d, Y',strtotime($fetch_booking_schedule_res['check_out_date'])).'<br /><label style="width:110px;float:left;">Amount</label>: '.display_amount_with_currency($fetch_booking_schedule_res['total_price'],display_currency()).'</div>';
		}
		echo '</div>';
	} else {
		echo '<center><h4>Your requested information is available, you can book room.</h4></center>';
	}

?>	