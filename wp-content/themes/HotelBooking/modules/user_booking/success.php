<?php
include_once( 'wp-load.php' );
get_header(); ?>
<?php templ_page_title_above(); //page title above action hook?>
<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/dummy/s8.jpg) no-repeat center top">
    <div class="main_header_in">	
           	
           <div class="post-meta"><h1><?php _e('Successfully Booking','templatic');?></h1></div>
        </div>
    </div>
    <div class="main_sepretor"></div>
<?php templ_page_title_below(); //page title below action hook?>


<div id="pages" class="clear" >
	<div  class="<?php templ_content_css();?>" >
<!--  CONTENT AREA START -->
		<div class="entry">
			<div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
				<div class="post-content">
				
				<?php 
						
				$filecontent = '<h3>Thank you for booking with us...</h3> Your transaction no. is <strong>'.get_booking_data($_REQUEST['booking_id'],'pnr_no','bm').'</strong>. We\'ve sent e-mail confirming your booking at : <a href="mailto:'.get_booking_data($_REQUEST['booking_id'],'email','bp').'"><i>'.get_booking_data($_REQUEST['booking_id'],'email','bp').'</i></a>.';
			 
$booking_id = $_SESSION['booking_id'];
$payable_amt = $_SESSION['payable_amount'];	
$store_name = get_option('blogname');
$email_info = fetch_hotel_info('contact_hotel_mail');
if($_REQUEST['paydeltype'] == 'prebanktransfer' )
{
	$filecontent .= '<p>To complete the booking process please transfer the amount of <strong>'.display_amount_with_currency(get_booking_data($_REQUEST['booking_id'],'total_price','bm'),display_currency()).'</strong> to our bank account with the following information :</p>
					<p>Bank Name : <strong>[#$bank_name#]</strong></p>
					<p>Account Number : <strong>[#$account_number#]</strong></p>
					<br />
					<p>Please note down your reference number: <strong>'.get_booking_data($_REQUEST['booking_id'],'pnr_no','bm').'</strong></p>
					<p>In case you have any queries, please email us at [CONTACT_EMAIL] by quoting this reference number. We will be glad to assist you.</p>
					<p>Thank you for using our Online Booking facility at [#$store_name#].</p>';
	$paymentupdsql = "select option_value from $wpdb->options where option_name='payment_method_".$_REQUEST['paydeltype']."'";
	$paymentupdinfo = $wpdb->get_results($paymentupdsql);
	$paymentInfo = unserialize($paymentupdinfo[0]->option_value);
	$payOpts = $paymentInfo['payOpts'];
	$bankInfo = $payOpts[0]['value'];
	$accountinfo = $payOpts[1]['value'];
	$search_array = array('[#$payable_amt#]','[#$bank_name#]','[#$account_number#]','[#$booking_id#]','[#$store_name#]','[CONTACT_EMAIL]');
	$replace_array = array($payable_amt,$bankInfo,$accountinfo,$order_id,$store_name,$email_info);
	$filecontent = str_replace($search_array,$replace_array,$filecontent);	
}else {
	$filecontent .= fetch_global_settings('cash_success_msg');
	
	$search_array = array('[CONTACT_EMAIL]');
	$replace_array = array($email_info);
	$filecontent = str_replace($search_array,$replace_array,$filecontent);	
}
	
	$filecontent .= '<h4>Your Booking Detail</h4><div class="booking">'.success_text_display($_REQUEST['booking_id'],'0').'</div>'; 
	echo $filecontent;
if(fetch_hotel_info('success_mail_status') == 'E'){
	booking_request_mail($_REQUEST['booking_id']);
}
?>
				</div>
			</div>
		</div>
<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
