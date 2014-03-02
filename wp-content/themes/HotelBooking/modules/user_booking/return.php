<?php
include_once( 'wp-load.php' );
get_header(); 
$title = PAYMENT_SUCCESS_TITLE;
templ_page_title_above(); //page title above action hook?>
<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/dummy/s6.jpg) no-repeat center top">
    <div class="main_header_in">	
		<div class="post-meta"><h1><?php _e($title,'templatic');?></h1></div>
    </div>
 </div>
 <div class="main_sepretor"></div>
<?php templ_page_title_below(); //page title below action hook?>

<div id="pages" class="clear" >
<div  class="<?php templ_content_css();?>" >
<!--  CONTENT AREA START -->
<div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
    <div class="post-content"><?php
$filecontent = stripslashes(get_option('post_payment_success_msg_content'));
if(!$filecontent)
{
	$filecontent = PAYMENT_SUCCESS_MSG;
}
$store_name = get_option('blogname');
$value = $_REQUEST['booking_id'];
global $wpdb;
$booking_master = $wpdb->prefix . "booking_master";
$booking_personal_info = $wpdb->prefix . "booking_personal_info";
$booking_transaction = $wpdb->prefix . "booking_transaction";
$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
$booking_log = $wpdb->prefix . "booking_master_log";
$wpdb->query("update $booking_master set booking_status = 'confirmed' where booking_id = '".$value."'");
		$wpdb->query("update $booking_log set status = 'confirmed' where booking_id = '".$value."'");
		
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
	
$post_link = site_url().'/?ptype=booking_list&booking_id='.$_REQUEST['booking_id'];	


$search_array = array('[#site_name#]','[#submited_information_link#]');
$replace_array = array($store_name,$post_link);

echo $filecontent;
?>
</div>
			</div>
		</div>
<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>