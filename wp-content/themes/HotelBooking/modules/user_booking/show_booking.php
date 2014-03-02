<?php
include_once( 'wp-load.php' );
get_header(); ?>


<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/dummy/s6.jpg) no-repeat center top">
    <div class="main_header_in">	
		<div class="post-meta"> <h1>Your Booking Detail</h1></div>
    </div>
 </div>
 <div class="main_sepretor"></div>
<?php templ_page_title_below(); //page title below action hook?>

</div> <!-- banner #end -->
<div id="pages" class="clear" >
	<div  class="<?php templ_content_css();?>" >
<!--  CONTENT AREA START -->
		<div class="entry">
			<div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
				<div class="post-content">
		<?php 
		global $wpdb;
		$booking_master = $wpdb->prefix . "booking_master";
		$booking_personal_info = $wpdb->prefix . "booking_personal_info";
		$booking_transaction = $wpdb->prefix . "booking_transaction";
		$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
		$booking_log = $wpdb->prefix . "booking_master_log";
		$display_booking_sql = $wpdb->get_row("select concat(bp.title,' ',bp.first_name,' ',bp.last_name) as customer,bm.pnr_no,bm.check_in_date,bm.check_out_date,bm.room_type_id,bl.total_room,bl.total_adult,bl.promotion_amt,bm.service_id,bl.tax_amt,bm.total_price,bl.without_deposite_price,bl.deposite,bl.room_price,bl.payment_method,bl.status from $booking_master bm,$booking_personal_info bp, $booking_log bl where bm.booking_id = bp.booking_id and bm.booking_id = bl.booking_id and bm.booking_id = '".$_REQUEST['booking_id']."'");
		if(mysql_affected_rows() > 0) {			
				$check_in_date = strtotime($display_booking_sql->check_in_date);
				$check_out_date = strtotime($display_booking_sql->check_out_date);
				$days_between = ceil(abs($check_out_date - $check_in_date) / 86400);
				$service = explode(',',$display_booking_sql->service_id);
				$paymentupdsql = "select option_value from $wpdb->options where option_name ='payment_method_".$display_booking_sql->payment_method."'";
				$paymentupdinfo = $wpdb->get_results($paymentupdsql);
				if($paymentupdinfo){
					foreach($paymentupdinfo as $paymentupdinfoObj)	{
						$option_value = unserialize($paymentupdinfoObj->option_value);
						$name = $option_value['name'];
						$option_value_str = serialize($option_value);
					}
				}
				echo '<h4>'.sprintf(NOTIFY_SUCCESS_TEXT,$display_booking_sql->customer,$display_booking_sql->pnr_no).'</h4>
				<div class="booking">
					'.success_text_display($_REQUEST['booking_id']).'<br />
					'.PAYMENT_STATUS_TEXT.': '.$display_booking_sql->status.'
					</div>'; 
			} else {
				echo '<h3>No record found for the booking ID you requested.</h3>';
			
			}?>	
				</div>
			</div>
		</div>
<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>