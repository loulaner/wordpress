<?php 
$file = dirname(__FILE__);
$file = substr($file,0,stripos($file, "wp-content"));
require($file . "/wp-load.php");
$booking_id = $_REQUEST['booking_id'];
global $wpdb;
$booking_master = $wpdb->prefix . "booking_master";
$booking_personal_info = $wpdb->prefix . "booking_personal_info";
$booking_transaction = $wpdb->prefix . "booking_transaction";
$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
$booking_log = $wpdb->prefix . "booking_master_log";
$fetch_booking_sql = $wpdb->get_row("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer,bm.pnr_no,bm.check_in_date,bm.check_out_date,bm.room_type_id,bl.total_room,bl.total_adult,bl.promotion_amt,bm.service_id,bl.tax_amt,bm.total_price,bl.without_deposite_price,bl.deposite,bl.room_price,bl.payment_method,bl.status,bm.booking_id from $booking_master bm,$booking_personal_info bp, $booking_log bl where bm.booking_id = bp.booking_id and bm.booking_id = bl.booking_id and bm.booking_id = '".$booking_id."' and bm.booking_status = 'publish'");
echo '<div style="padding:8px;margin:20px;">
<label style="width:140px;float:left;">Name</label>: '.$fetch_booking_sql->customer.'<br /><br />
<label style="width:140px;float:left;">Transaction No.</label>: '.$fetch_booking_sql->pnr_no.' <br /><br />
<label style="width:140px;float:left;">Payble amt</label>: '.display_amount_with_currency($fetch_booking_sql->total_price,display_currency()).'<br /><br />
<label style="width:140px;float:left;">Total Amt</label>: '.display_amount_with_currency($fetch_booking_sql->without_deposite_price,display_currency()).'<br /><br />
<form name="frmedit" id="frmedit" action="'.site_url().'/wp-admin/admin.php?page=manage_reservation&pagetype=update_amt#option_chk_avail" method="post">
<label style="width:140px;float:left;">Remaining Amount</label>: <input type="text" name="pending_amt" id="pending_amt" value=""><input type="hidden" name="booking_id" id="booking_id" value="'.$fetch_booking_sql->booking_id.'"><input type="hidden" name="total_price" id="total_price" value="'.$fetch_booking_sql->total_price.'"><br /><br /><label style="width:140px;float:left;">&nbsp;</label><input type="submit" name="submit" id="save" value="Submit"  class="button" >
</form></div>';

?>