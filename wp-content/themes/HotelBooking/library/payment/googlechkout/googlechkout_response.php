<?php
$paymentOpts = get_payment_optins($_REQUEST['paymentmethod']);
$merchantid = $paymentOpts['merchantid'];
global $payable_amount,$room_desc,$last_bookingid,$current_user;
$currency_code = fetch_global_settings('currency');
$display_name = get_booking_data($last_bookingid,'first_name','bp').' '.get_booking_data($last_bookingid,'last_name','bp');
$user_email = get_booking_data($last_bookingid,'email','bp');

?>
<form method="POST" name="frm_payment_method"  action="https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/<?php echo $merchantid;?>"  accept-charset="utf-8">
<input type="hidden" name="item_name_1" value="<?php echo $room_desc;?>"/>
<input type="hidden" name="item_description_1" value="<?php echo $room_desc;?>"/>
<input type="hidden" name="item_quantity_1" value="1"/>
<input type="hidden" name="item_price_1" value="<?php echo $payable_amount;?>"/>
<input type="hidden" name="item_currency_1" value="<?php echo $currency_code;?>"/>
<input type="hidden" name="_charset_"/>
</form>
 
 
  <div class="wrapper" >
		<div class="clearfix container_message">
            	<h1 class="head2"><?php echo GOOGLE_CHKOUT_MSG;?></h1>
            </div>
 
<script>
setTimeout("document.frm_payment_method.submit()",50);
</script>
