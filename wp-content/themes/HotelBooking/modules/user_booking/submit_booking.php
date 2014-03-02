<?php
session_start();
include_once( 'wp-load.php' );
get_header(); ?>


<?php templ_page_title_above(); //page title above action hook?>

<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/dummy/s7.jpg) no-repeat center top">
    <div class="main_header_in">	
           	
           <div class="post-meta"><h1><?php _e('Confirm Your Booking','templatic');?></h1></div>
        </div>
    </div>
    <div class="main_sepretor"></div>
<?php templ_page_title_below(); //page title below action hook?>


  


<div id="pages" class="clear" >
	<div class="<?php templ_content_css();?>" >
<!--  CONTENT AREA START -->
		<div class="entry">
			<div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
				<div class="post-content">
			<?php
			$title = $_POST['title'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email_id'];
			$phone = $_POST['phone'];
			$country = $_POST['country'];
			$city = $_POST['city'];
			$street = $_POST['street'];
			$check_in_date = $_POST['check_in_date'];
			$check_out_date = $_POST['check_out_date'];
			$total_price = $_POST['payble_amount'];
			$no_rooms = $_POST['no_rooms'];
			$adults = $_POST['adults'];
			if($_POST['booking_id'] != ''){
			$booking_id = implode(',',$_POST['booking_id']);
			}
			if($_REQUEST['booking_add_coupon']!='') {
				$coupon_display = '';
				if(is_valid_coupon($_REQUEST['booking_add_coupon']))	{
					$payable_amount = get_payable_amount_with_coupon($_POST['payble_amount'],$_REQUEST['booking_add_coupon']);
					$discount_amt = get_discount_amount($_REQUEST['booking_add_coupon'],$_POST['payble_amount']);
					$coupon_display = '<label class="booking_label">Promotion</label> : '.display_amount_with_currency($discount_amt,display_currency()).'<br />
					</tr>';
				}else {
					$payable_amount = $_POST['payble_amount'];
					$coupon_display = '';
					echo '<div class="updated fade below-h2" id="message" style="padding:2px; font-size:11px;background-color: #FFEBE8;border:1px solid #CC0000;height:32px;" ><p>&nbsp;&nbsp;&nbsp;&nbsp;<strong><img src="'.PLUGIN_URL_RESERVATION.'images/error.gif" >&nbsp;&nbsp;'. WRONG_COUPON_MSG.'<br></strong></p></div>';
				}
			} else {
				$payable_amount = $_POST['payble_amount'];
			}
			$check_in_date = strtotime($_POST['check_in_date']);
			$check_out_date = strtotime($_POST['check_out_date']);
			$room_type = $_POST['room_type'];
			$price_total = $_POST['payble_amount'];
			$seprate_price = ($price_total / $no_rooms);
			$sup = '';
			$tax = 0;
			$service_price = 0;
			
			if($_POST['service_id'] != '') {
				$service_price = get_service_price($_POST['service_id']);
				$ss = implode(",",$_POST['service_id']);
			}	
			for($r = 0; $r < $no_rooms; $r++){
				if($r == ($no_rooms - 1)){
					$sup .= display_amount_with_currency($seprate_price,display_currency());
				} else {
					$sup .= display_amount_with_currency($seprate_price,display_currency()). '&nbsp;+&nbsp;';
				}
			}
			
			$service_with_price = $payable_amount + $service_price;
			if(tex_include($room_type)){
				if(fetch_global_settings('tax_type') == 'exact_amount'){
					$tax = display_amount_with_currency(fetch_global_settings('tax'),display_currency());
					$tax_price = $service_with_price + $tax;
				}else{
					$tax = fetch_global_settings('tax').'%';
					$tax_price = ($service_with_price * $tax ) / 100;
				}
			} 
		
			$without_deposite = $service_with_price + $tax_price;
			$deposite = fetch_global_settings('deposite_percentage');
			$final_total_price = (($service_with_price + $tax_price) * $deposite) / 100;
			$days_between = ceil(abs($check_out_date - $check_in_date) / 86400);
			$_SESSION['booking_info'] = $_POST;
			echo '<h3 class="btitle">'.REQUEST_TEXT.'</h3><div class="booking">
					<span><label class="booking_label">'.CUSTOMER_NAME_TITLE.'</label> : '.$_POST['title'].'&nbsp;'.$_POST['first_name'].'&nbsp;'.$_POST['last_name'].' </span>
					<span><label class="booking_label">'.CHECK_IN_TEXT.'</label> : '.date('d F Y',strtotime($_POST['check_in_date'])).'</span>
					<span><label class="booking_label">'.CHECK_OUT_TEXT.'</label> : '.date('d F Y',strtotime($_POST['check_out_date'])).'</span>
					<span><label class="booking_label">'.ROOM_TYPE.'</label> : '.fecth_room_type_name($room_type).'</span>
					<span><label class="booking_label">'.NO_ROOMS_TEXT.'</label> : '.$no_rooms.'</span>
					<span><label class="booking_label">'.OCCUPY_TEXT.'</label> : '.$adults.'</span>
					<span><label class="booking_label">'.DAYS_TEXT.'</label> : '.$days_between.'</span>
					<span><label class="booking_label">'.ROOM_PRICE_TEXT.'</label> : '.display_amount_with_currency($price_total,display_currency()).' ('.$sup.') </span>';
					echo $coupon_display;
					if(isset($_POST['service_id']) && $_POST['service_id'] != ''){
						foreach($_POST['service_id'] as $skey => $svalue){
							echo get_service_data($svalue);
						}
					}
					if(tex_include($room_type)){	
					echo '<span><label class="booking_label">'.TAX_TEXT.'</label> : '.$tax.'</span>';
					}
					
					echo '<span><label class="booking_label">'.DEPOSITE_TEXT.'</label> : '.fetch_global_settings('deposite_percentage').'% </span>
					<span><label class="booking_label">'.TOTAL_CHARGE_TEXT.'</label> : '.display_amount_with_currency($final_total_price,display_currency()) .'</span>';
					
				echo '</div>';
		?>	
		
	<form action="<?php echo get_option('siteurl');?>/?ptype=insert_booking" method="post" name="submit_booking_frm" onsubmit="return user_booking_validation();">
	<input type="hidden" name="reservationact" value="addreservation">
	<input type="hidden" name="room_type_id" id="room_type_id" value="<?php echo $room_type;?>">
	<input type="hidden" name="adults" id="adults" value="<?php echo $_REQUEST['adults'];?>">
	<input type="hidden" name="check_in_date" id="check_in_date" value="<?php echo $_POST['check_in_date'];?>">
	<input type="hidden" name="check_out_date" id="check_out_date" value="<?php echo $_POST['check_out_date'];?>">
	<input type="hidden" name="no_rooms" id="no_rooms" value="<?php echo $_REQUEST['no_rooms'];?>">
	<input type="hidden" name="final_total_price" id="final_total_price" value="<?php echo $final_total_price ;?>">
	<input type="hidden" name="booking_id" id="booking_id" value="<?php echo $_POST['booking_id'] ;?>">
	<input type="hidden" name="service_id" id="service_id" value="<?php echo $ss  ;?>">
	<input type="hidden" name="tax" id="tax" value="<?php echo $tax  ;?>">
	<input type="hidden" name="deposite" id="deposite" value="<?php echo fetch_global_settings('deposite_percentage')  ;?>">
	<input type="hidden" name="without_deposite_price" id="without_deposite_price" value="<?php echo $without_deposite  ;?>">
	<input type="hidden" name="promotion_amt" id="promotion_amt" value="<?php echo $discount_amt  ;?>">
	<input type="hidden" name="room_price" id="room_price" value="<?php echo display_amount_with_currency($price_total,display_currency()).' ('.$sup.')' ;?>">
	<input type="hidden" name="title" id="title" value="<?php echo $title  ;?>">
	<input type="hidden" name="first_name" id="first_name" value="<?php echo $first_name  ;?>">
	<input type="hidden" name="last_name" id="last_name" value="<?php echo $last_name  ;?>">
	<input type="hidden" name="email" id="email" value="<?php echo $email  ;?>">
	<input type="hidden" name="phone" id="phone" value="<?php echo $phone  ;?>">
	<input type="hidden" name="country" id="country" value="<?php echo $country  ;?>">
	<input type="hidden" name="city" id="city" value="<?php echo $city  ;?>">
	<input type="hidden" name="street" id="street" value="<?php echo $street  ;?>">
	<?php
	$extra_field_sql = mysql_query("select * from $booking_field order by fieldposition");
	while($extra_field_res = mysql_fetch_array($extra_field_sql)){
		if(isset($_POST[$extra_field_res['fieldname']]) && $_POST[$extra_field_res['fieldname']] != ''){
			if($extra_field_res['fieldtype'] == 'checkbox'){
				$final_data = implode(',',$_POST[$extra_field_res['fieldname']]);
				echo '<input type="hidden" name="'.$extra_field_res['fieldname'].'" value="'.$final_data.'">';
			} else {
				echo '<input type="hidden" name="'.$extra_field_res['fieldname'].'" value="'.$_POST[$extra_field_res['fieldname']].'">';
			}
		}
	}

if(fetch_global_settings('paid_submission') == 'E') {

	if($payable_amount>0)
	{
		$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_%' order by option_id";
		$paymentinfo = $wpdb->get_results($paymentsql);
		if($paymentinfo)
		{
		?>
	
    

    <div class="booking">
    
    	<h3 class="btitle"><?php _e(SELECT_PAY_MEHTOD_TEXT); ?></h3> 
 
  <ul class="payment_method">
	<?php
			$paymentOptionArray = array();
			$paymethodKeyarray = array();
			foreach($paymentinfo as $paymentinfoObj)
			{
				$paymentInfo = unserialize($paymentinfoObj->option_value);
				if($paymentInfo['isactive'])
				{
					$paymethodKeyarray[] = $paymentInfo['key'];
					$paymentOptionArray[$paymentInfo['display_order']][] = $paymentInfo;
				}
			}
			ksort($paymentOptionArray);
			if($paymentOptionArray)
			{
				foreach($paymentOptionArray as $key=>$paymentInfoval)
				{
					for($i=0;$i<count($paymentInfoval);$i++)
					{
						$paymentInfo = $paymentInfoval[$i];
						$jsfunction = 'onclick="showoptions(this.value);"';
						$chked = '';
						if($key==1)
						{
							$chked = 'checked="checked"';
						}
					?>
		<li id="<?php echo $paymentInfo['key'];?>">
		  <input <?php echo $jsfunction;?>  type="radio" value="<?php echo $paymentInfo['key'];?>" id="<?php echo $paymentInfo['key'];?>_id" name="paymentmethod" <?php echo $chked;?> />  <?php echo $paymentInfo['name']?>
		 
		  <?php
						if(file_exists(TEMPLATEPATH.'/library/payment/'.$paymentInfo['key'].'/'.$paymentInfo['key'].'.php'))
						{
						?>
		  <?php
							include_once(TEMPLATEPATH.'/library/payment/'.$paymentInfo['key'].'/'.$paymentInfo['key'].'.php');
							?>
		  <?php
						} 
					 ?> </li>
		  <?php
					}
				}
			}else
			{
			?>
			<li><?php _e(NO_PAYMENT_METHOD_MSG);?></li>
			<?php
			}
			
		?>
 	  
  </ul>
  <?php
		}
	}
	?>
	</div>
	<?php
}
else {
	echo '<div class="booking"><input type="hidden" name="paymentmethod" value="payondelevary"><h3>';
	_e('Currently Payment Process is Disabled');
	echo '</h3></div>';
}
?>

    <input type="submit" name="book_now" id="book_now" value="Book Now" class="book_left" >
	
	<a href="<?php echo get_option('siteurl');?>/?ptype=user_booking&err=false&backandedit=1" title="Go Back and Edit" class="right"><input type="button" name="go_back" id="go_back" value="Go Back and Edit" class="book_right" ></a>
	
	
 <script type="application/x-javascript">
function showoptions(paymethod)
{
<?php
for($i=0;$i<count($paymethodKeyarray);$i++)
{
?>
showoptvar = '<?php echo $paymethodKeyarray[$i]?>options';
if(eval(document.getElementById(showoptvar)))
{
	document.getElementById(showoptvar).style.display = 'none';
	if(paymethod=='<?php echo $paymethodKeyarray[$i]?>')
	{
		document.getElementById(showoptvar).style.display = '';
	}
}

<?php
}	
?>
}
<?php
for($i=0;$i<count($paymethodKeyarray);$i++)
{
?>
if(document.getElementById('<?php echo $paymethodKeyarray[$i];?>_id').checked)
{
showoptions(document.getElementById('<?php echo $paymethodKeyarray[$i];?>_id').value);
}
<?php
}	
?>
</script> 
	
	</form>

				</div>
			</div>
		</div>
        
  </div> <!-- content #end -->



<?php get_sidebar(); ?>
<!--  CONTENT AREA END -->

<?php get_footer(); ?>
