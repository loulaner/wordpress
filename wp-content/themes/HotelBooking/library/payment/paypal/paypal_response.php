<?php
$paymentOpts = get_payment_optins($_REQUEST['paymentmethod']);
$merchantid = $paymentOpts['merchantid'];
$returnUrl = $paymentOpts['returnUrl'];
$cancel_return = $paymentOpts['cancel_return'];
$notify_url = $paymentOpts['notify_url'];
$currency_code = fetch_global_settings('currency');
global $payable_amount,$room_desc,$last_bookingid,$current_user;
?>
<form name="frm_payment_method" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" value="<?php echo $payable_amount;?>" name="amount"/>
<input type="hidden" value="<?php echo $returnUrl;?>&booking_id=<?php echo $last_bookingid;?>" name="return"/>
<input type="hidden" value="<?php echo $cancel_return;?>&booking_id=<?php echo $last_bookingid;?>" name="cancel_return"/>
<input type="hidden" value="<?php echo $notify_url;?>" name="notify_url"/>
<input type="hidden" value="_xclick" name="cmd"/>
<input type="hidden" value="<?php echo $room_desc;?>" name="item_name"/>
<input type="hidden" value="<?php echo $merchantid;?>" name="business"/>
<input type="hidden" value="<?php echo $currency_code;?>" name="currency_code"/>
<input type="hidden" value="<?php echo $last_bookingid;?>" name="custom" />
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="1">
</form>

<div class="wrapper" >
		<div class="clearfix container_message">
            	<center><h1 class="head2"><?php echo PAYPAL_MSG;?></h1></center>
         </div>
</div>
<script>
setTimeout("document.frm_payment_method.submit()",50); 
</script> 