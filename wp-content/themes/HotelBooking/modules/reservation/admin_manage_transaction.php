<script>var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/normaldhtmlgoodies_calendar.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/library/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />
<div class='headerdivh3'>
	<h3><?php _e('Transaction Log','templatic');?></h3>
	<?php if(isset($_REQUEST['booking_id']) && $_REQUEST['booking_id'] != '') {
	$transaction_sql = mysql_query("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer_name,bm.pnr_no,bm.booking_id from $booking_personal_info bp,$booking_master bm where bm.booking_id = bp.booking_id and bm.booking_status = 'confirmed' and bm.booking_id = '".$_REQUEST['booking_id']."'");
	if(mysql_num_rows($transaction_sql) > 0){
			echo '<div class="divright"><a href="'.site_url().'/wp-admin/admin.php?page=manage_reservation&trans_page_type=add_trans&booking_id='.$_REQUEST['booking_id'].'#option_transaction" title="Add New Transaction" name="btnviewlisting" class="button-primary">Add New Transaction</a></div>'; 
		}
	} ?>
     <p><img src="<?php echo PLUGIN_URL_RESERVATION;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Here is a complete list of customer payment and other information','templatic');?> </p>
</div>
<form name="frm_chk_booking" id="frm_chk_booking" method="post" action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_reservation#option_transaction" >
<table width="100%" cellspacing="2" cellpadding="2" border="0" class="widefat post fixed" >	
	<tr>
		<td align="left" valign="top"  style="width:110px;border:0px;padding:5px;">*&nbsp;<?php _e('Check-In Date :','templatic');?></td>
		<td align="left" valign="top" style="border:0px;padding:5px;"><input name="t_check_in_date" type="text"  value="<?php echo $_POST['t_check_in_date'];?>" style="width:120px;" id="t_check_in_date"></td>
		<td align="left" valign="top" style="width:24px;border:0px;padding:5px;"><img src="<?php echo get_template_directory_uri().'/images/cal.gif';?>" alt="Calendar"  onclick="displayCalendar(document.frm_chk_booking.t_check_in_date,'yyyy-mm-dd',this)" class="i_calendar" align="absmiddle" border="0" /></td>		
		<td align="left" valign="top"  style="width:120px;border:0px;padding:5px;">*&nbsp;<?php _e('Check-Out Date :','templatic');?></td>
		<td align="left" valign="top" style="border:0px;padding:5px;"><input name="t_check_out_date" type="text"  value="<?php echo $_POST['t_check_out_date'];?>" style="width:120px;" id="t_check_out_date"></td>
		<td align="left" valign="top" style="width:24px;border:0px;padding:5px;"><img src="<?php echo get_template_directory_uri().'/images/cal.gif';?>" alt="Calendar"  onclick="displayCalendar(document.frm_chk_booking.t_check_out_date,'yyyy-mm-dd',this)" class="i_calendar" align="absmiddle" border="0" /></td>
	</tr>
	<tr>
		<td align="left" valign="top"  style="width:100px;padding:5px;">*&nbsp;<?php _e('Room Type :','templatic');?></td>
		<td align="left" valign="top" colspan="3"><select name="room_type_id" id="ch_room_type_id" style="width:200px;"><option value="">选择房间类型</option><?php echo room_type_cmb($_REQUEST['room_type_id']);?></select></td>		
		<td align="left" valign="top"  style="width:100px;" colspan="2"><input type="submit" name="submit" id="save" value="<?php _e('Submit','templatic');?>"  class="button-primary" ></td>
	</tr>
</table></form><br /><br />
	<?php if($_REQUEST['msg']=='deltransuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Transaction Deleted Successfully!','templatic'); ?>
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
$search_sql = "select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer_name,bt.booking_id,bt.booking_date,bt.transaction_date,bt.amount,bt.currency,bt.transaction_id from $booking_personal_info bp,$booking_transaction bt,$booking_master bm where bm.booking_id = bp.booking_id and bm.booking_id = bt.booking_id and bm.booking_status = 'confirmed'";
		if($_POST['t_check_in_date'] != ''){
			$search_sql .= " and  bm.check_in_date <= '".$_POST['t_check_in_date']."'";
		} if($_POST['t_check_out_date'] != '') {
			$search_sql .= " and  bm.check_out_date >= '".$_POST['t_check_out_date']."'";
		} if($_POST['room_type_id'] != '') {
			$search_sql .= " and  bm.room_type_id = '".$_POST['room_type_id']."'";
		}if(isset($_REQUEST['booking_id']) && $_REQUEST['booking_id'] != '') {
			
			$search_sql .= " and bm.booking_id = '".$_REQUEST['booking_id']."'";
		}
$transactionsql = mysql_query($search_sql); 
$total_pages = mysql_num_rows($transactionsql);
$final_reservation_qry = mysql_query($search_sql.$record_limit);
$total = 0;
if($total_pages > 0) {
	while($total_res = mysql_fetch_array($transactionsql)){
		$total += $total_res['amount'];
	}
	?>	
	<table width="100%" cellpadding="5" class="widefat post fixed" >
		<thead>						
		<tr>
			<th align="left"><strong><?php _e('Customer','templatic'); ?></strong></th>
			<th align="left" width="15"><strong><?php _e('ID','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Book Date','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Entry Date','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Amount','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Delete','templatic'); ?></strong></th>
		</tr>
		<?php	
		while($reservation_trans_data = mysql_fetch_array($final_reservation_qry)) { ?>	
			<tr>
				<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_reservation&trans_page_type=add_trans&booking_id='.$reservation_trans_data['booking_id'].'#option_transaction';?>" title="<?php _e('Add New Transaction','templatic');?>"><?php echo $reservation_trans_data['customer_name'];?></a></td>
				<td><?php echo $reservation_trans_data['booking_id'];?></td>
				<td><?php echo date('Y-m-d',strtotime($reservation_trans_data['booking_date']));?></td>
				<td><?php echo date('Y-m-d',strtotime($reservation_trans_data['transaction_date']));?></td>
				<td><?php echo display_amount_with_currency($reservation_trans_data['amount'],display_currency());?></td>
				<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_reservation&pagetype=deletetransaction&transaction_id='.$reservation_trans_data['transaction_id'].'&#option_transaction';?>" onclick="return confirmSubmit();" title="Delete Transaction"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Transaction','templatic');?>" border="0" /></a></td>
				
			</tr>
		<?php }	?>
		<tr>
			<td align="center" colspan="6" style="background:#eeeeee;padding:5px;"><strong>Total Amount : <?php echo display_amount_with_currency($total,display_currency()); ?></strong></td>
		</tr>
		<tr>
					<td colspan="6" align="left">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3" align="left"><strong><?php _e('合计'); ?> : <?php echo $total_pages;?> <?php _e('人'); ?></strong></td>
					<td colspan="3" align="right"><?php if($total_pages>$recordsperpage){
						echo get_pagination($targetpage,$total_pages,$recordsperpage,$pagination,'#option_transaction');
					}?></td>
              </tr>
	</thead>					
	</table>
	<div class="legend">
<h4 class="legend">Legend :</h4>
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Transaction','templatic');?>" border="0" /></label> Delete Transaction<br />
</div>
<?php } ?>