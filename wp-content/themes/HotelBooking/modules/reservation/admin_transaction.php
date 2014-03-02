<?php
global $wpdb;
$booking_master = $wpdb->prefix . "booking_master";
$booking_personal_info = $wpdb->prefix . "booking_personal_info";
$booking_transaction = $wpdb->prefix . "booking_transaction";
$currency = display_currency();
$booking_transaction_sql = mysql_query("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer_name,bm.pnr_no,bm.booking_date,bm.booking_id from $booking_personal_info bp,$booking_master bm where bm.booking_id = bp.booking_id and bm.booking_status = 'confirmed' and bm.booking_id = '".$_REQUEST['booking_id']."'");
$transaction_res = mysql_fetch_array($booking_transaction_sql);
if($_GET['pagetype'] == 'addedit'){
	$add_transaction = $wpdb->query("INSERT INTO $booking_transaction(transaction_id,booking_id,booking_date,transaction_date,amount,currency) VALUES('','".$_REQUEST['booking_id']."','".$transaction_res['booking_date']."',now(),'".$_POST['pay_amount']."','".$currency."')");
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_transaction" method="get" name="reservation_success" >
	<input type=hidden name="page" value="manage_reservation"><input type=hidden name="msg" value="success"><input type=hidden name="msgtype" value="'.$msg.'"><input type=hidden name="not_avl" value="false"></form>';
	echo '<script>document.reservation_success.submit();</script>';
}
$booking_transaction_sql = mysql_query("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer_name,bm.pnr_no,bm.booking_id from $booking_personal_info bp,$booking_master bm where bm.booking_id = bp.booking_id and bm.booking_status = 'confirmed' and bm.booking_id = '".$_REQUEST['booking_id']."'");
$transaction_res = mysql_fetch_array($booking_transaction_sql);
?>
<div class='headerdivh3'>
	<h3><?php _e('Add New Transaction','templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_reservation#option_transaction" name="btnviewlisting" class="button-primary" title="<?php _e('Back to Transaction Log','templatic');?>"/><?php _e('&laquo; Back to Transaction Log','templatic'); ?></a></div>
    <p><img src="<?php echo PLUGIN_URL_RESERVATION;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Here you can add new transaction for particular customer','templatic');?> </p>
</div>
<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_reservation&mod=transaction&pagetype=addedit&booking_id=<?php echo $_REQUEST['booking_id'];?>#option_transaction" method="post" name="transaction_frm" id="transaction_frm" onsubmit="return transaction_validation();">
<input type="hidden" name="trans_act" value="addtransaction">
<input type="hidden" name="booking_id" id="booking_id" value="<?php echo $_REQUEST['booking_id'];?>">
	<table width="100%" cellspacing="2" cellpadding="6" border="0" class="widefat post fixed">
		<tr>
			<td align="left" valign="top" style="width:250px;"><label class="setting_lbl">&nbsp;&nbsp;<?php _e('Customer Name :','templatic');?></label></td>
			<td align="left" valign="top"><?php echo $transaction_res['customer_name'];?></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:250px;"><label class="setting_lbl">*&nbsp;<?php _e('Pay Amount :','templatic');?></label></td>
			<td align="left" valign="top"><input type="text" name="pay_amount" id="pay_amount" value="" style="width:100px;"></td>
		</tr>
		<tr>
			<td align="left" valign="top"  style="width:100px;">&nbsp;</td>
			<td align="left" valign="top"><input type="submit" name="sub_transaction" id="sub_transaction" value="<?php _e('Add Transaction','templatic')?>" class="button-framework-imp"></td>
		</tr>
	</table>
</form>