<?php
include 'tab_header.php';
global $wpdb,$Cart,$General;
$booking_master = $wpdb->prefix . "booking_master";
$booking_personal_info = $wpdb->prefix . "booking_personal_info";
$booking_transaction = $wpdb->prefix . "booking_transaction";
$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
$booking_log = $wpdb->prefix . "booking_master_log";
$currency = display_currency();
/* Delete Reservation Record BOF */
if($_REQUEST['pagetype'] == 'delete' && $_REQUEST['booking_id'] != '')
{
	$wpdb->query("DELETE from $booking_master where booking_id = '".$_REQUEST['booking_id']."'");
	$wpdb->query("DELETE from $booking_personal_info where booking_id = '".$_REQUEST['booking_id']."'");
	$wpdb->query("DELETE from $booking_check_avilability where booking_id = '".$_REQUEST['booking_id']."'");
	$wpdb->query("DELETE from $booking_log where booking_id = '".$_REQUEST['booking_id']."'");
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_reservation" method="get" name="reservation_success">
	<input type=hidden name="page" value="manage_reservation"><input type=hidden name="msg" value="delsuccess"></form>';
	echo '<script>document.reservation_success.submit();</script>';
	exit;
}
/* Delete Reservation Record EOF */
/* Delete Reservation Transaction Record BOF */
if($_REQUEST['pagetype'] == 'deletetransaction' && $_REQUEST['transaction_id'] != '')
{
	$wpdb->query("DELETE from $booking_transaction where transaction_id = '".$_REQUEST['transaction_id']."'");
	
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_transaction" method=get name="reservation_success">
	<input type=hidden name="page" value="manage_reservation"><input type=hidden name="msg" value="deltransuccess"></form>';
	echo '<script>document.reservation_success.submit();</script>';
	exit;
}
/* Delete Reservation Transaction Record EOF */
/* Update Status Reservation Record BOF */
if($_REQUEST['pagetype'] == 'ch_status' && $_REQUEST['booking_id'] != '' && $_REQUEST['booking_status'] != '0')
{
	foreach($_REQUEST['booking_id'] as $key => $value) {
		$wpdb->query("update $booking_master set booking_status = '".$_REQUEST['booking_status']."' where booking_id = '".$value."'");
		$wpdb->query("update $booking_log set status = '".$_REQUEST['booking_status']."' where booking_id = '".$value."'");
		if($_REQUEST['booking_status'] == 'confirmed'){
			$booking_data = fetch_booking_data($value);
			if(check_booking_transaction($value)){
				$booking_trans_sql = "INSERT INTO $booking_transaction(transaction_id,booking_id,booking_date,transaction_date,amount,currency) VALUES('','".$value."','".$booking_data['booking_date']."',now(),'".$booking_data['total_price']."','".$currency."') ";
				$wpdb->query($booking_trans_sql);
			} if(check_booking_availability($value)){
				$room_ids = explode(",",$booking_data['room_id']);
				$r_count = count($room_ids);
				$booking_avalability_sql = "INSERT INTO $booking_check_avilability(check_availability_id,booking_id,check_in_date,check_out_date,room_type_id,total_room) VALUES('','".$value."','".$booking_data['check_in_date']."','".$booking_data['check_out_date']."','".$booking_data['room_type_id']."','".$r_count."') ";
				$wpdb->query($booking_avalability_sql);
			}
			if(fetch_hotel_info('success_mail_status') == 'E'){
				booking_success_mail($value);
			}
		}else if($_REQUEST['booking_status'] == 'pending') {
			$booking_avalability_delete = $wpdb->query("DELETE from $booking_check_avilability where booking_id = '".$value."'");
		} else {
			$booking_avalability_delete = $wpdb->query("DELETE from $booking_check_avilability where booking_id = '".$value."'");
			booking_reject_mail($value);
		}
	}
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'" method=get name="reservation_success">
	<input type=hidden name="page" value="manage_reservation"><input type=hidden name="msg" value="statussuccess"></form>';
	echo '<script>document.reservation_success.submit();</script>';
	exit;
}
/* Update Status Reservation Record EOF */
?>
<script type="text/javascript" src="<?php echo PLUGIN_URL_RESERVATION;?>js/reservation.js"></script>
<link href="<?php echo PLUGIN_URL_RESERVATION;?>css/style.css" rel="stylesheet" type="text/css" />
<!-- Listing Reservation BOF -->
<div class="block" id="option_display_reservation">
<?php if($_GET['page_type'] == 'add_booking'){
 include('admin_reservation.php'); 
} else { ?>
 <div class='headerdivh3'>
	<h3><?php _e('Manage Booking List','templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_reservation&page_type=add_booking#option_display_reservation';?>" title="<?php _e('Add New Booking','templatic');?>" name="btnviewlisting" class="button-primary" /><?php _e('Add New Booking','templatic'); ?></a></div>
    <p><img src="<?php echo PLUGIN_URL_RESERVATION;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Here you can add, edit and manage booking (Click on Customer name to know more about him/her)','templatic');?> </p>
</div>
<?php if($_REQUEST['msg']=='success'){ ?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	 <?php if($_REQUEST['msgtype'] == 'add'){
				_e('Reservation inserted successfully.','templatic');
			} else {
				_e('Reservation updated successfully.','templatic');
		}?>
	</div>
<?php }?>
<?php if($_REQUEST['msg']=='delsuccess'){ ?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Reservation deleted successfully.','templatic'); ?>
	</div>
<?php }?>
<?php if($_REQUEST['msg']=='statussuccess'){ ?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Status Changed Successfully','templatic'); ?>
	</div>
<?php }
$targetpage = site_url('/wp-admin/admin.php?page=manage_reservation');
$recordsperpage = 20;
$pagination = $_REQUEST['pagination'];
if($pagination == '')
{
	$pagination = 1;
}
$strtlimit = ($pagination-1)*$recordsperpage;
$endlimit = $strtlimit+$recordsperpage;
//----------------------------------------------------
$record_limit = " order by bm.booking_id desc limit $strtlimit,$recordsperpage";
$search_sql = "select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer_name,bm.room_type_id,bm.check_in_date,bm.check_out_date,bm.booking_date,bm.total_price,bm.booking_status,bm.booking_id from $booking_master bm,$booking_personal_info bp where bm.booking_id = bp.booking_id";
$reservationsql = mysql_query($search_sql); 
$total_pages = mysql_num_rows($reservationsql);
$final_reservation_qry = mysql_query($search_sql.$record_limit);
if($total_pages > 0) { ?>
	<form name="frm_status" id="frm_status" action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_reservation&pagetype=ch_status" method="post">
	<table cellspacing="1" cellpadding="4" border="0" width="100%" style="border:0px;">
		<tr>
			<td align="left" valign="top" style="border:0px;width:160px;font-size:11px;"><?php _e('<b>Change booking status : </b>','templatic');?></td>
			<td align="left" valign="top" style="border:0px;width:140px;"><select name="booking_status" id="booking_status" style="width:120px;"><?php echo status_cmb(); ?></select></td>
			<td align="left" valign="top"><input type="submit" name="submit" id="save" value="<?php _e('Apply','templatic');?>"  class="button-primary" ></td>
		</tr>
	</table>		
	<table width="100%" cellpadding="5" class="widefat post fixed" >
		<thead>	
		<tr>
			<th align="center" style="width:28px;"><input type="checkbox" name="chk" id="chk" value="" onclick="chk_customer(document.getElementById('frm_status').booking_id)" ></th>
			<th align="left"><strong><?php _e('Customer','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Type','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Check-In','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Check-Out','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Status','templatic'); ?></strong></th>
		</tr>	
		<?php
		while($reservationdata = mysql_fetch_array($final_reservation_qry)) { 
		 if($reservationdata['booking_status'] == 'confirmed'){
			$booking_status = '<span style="color:green;">确认</span>';
		 } else if($reservationdata['booking_status'] == 'pending') {
			$booking_status = '<span style="color:#FF8000;">待处理</span>';	
		 } else {
			$booking_status = '<span style="color:#ff0000;">注销</span>';	
		 }?>	
			<tr>
				<td align="center" ><input type="checkbox" name="booking_id[]" id="booking_id" value="<?php echo $reservationdata['booking_id'];?>" ></td>
				<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_reservation&page_type=add_booking&booking_id='.$reservationdata['booking_id'].'&#option_add_reservation';?>"><?php echo $reservationdata['customer_name'];?></a></td>
				<td><?php echo fecth_room_type_name($reservationdata['room_type_id']);?></td>
				<td><?php echo $reservationdata['check_in_date'];?></td>
				<td><?php echo $reservationdata['check_out_date'];?></td>
				<td><?php echo $booking_status;?></td>
			</tr>
		<?php }	?>
			<tr>
				<td colspan="6" align="left">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" align="left"><strong><?php _e('合计'); ?> : <?php echo $total_pages;?> <?php _e('人'); ?></strong></td>
				<td colspan="3" align="right"><?php if($total_pages>$recordsperpage){
						echo get_pagination($targetpage,$total_pages,$recordsperpage,$pagination);
					}?></td>
            </tr>
	</thead>					
	</table>
	</form> <?php } else {
		echo '<center><h4>没有找到记录.</h4></center>';
	}
}?>
</div> 
<!-- Listing Reservation EOF -->	
<!-- Listing Reservation BOF -->
<div class="block" id="option_transaction">
<?php if($_GET['trans_page_type'] == 'add_trans'){
 include('admin_transaction.php'); 
} else { 
	include('admin_manage_transaction.php'); 
}?>
</div> 
<!-- Listing Reservation EOF -->
<!--<div class="block" id="option_chk_avail">
<p><img src="<?php echo PLUGIN_URL_RESERVATION;?>images/info.png" alt="information icon">&nbsp;&nbsp;Here you can manage transaction. if customer will pay the pending amout then you can add transaction from here </p>
<?php //include("admin_manage_booking.php");?>
</div>-->
<?php include TT_ADMIN_TPL_PATH.'footer.php';?>