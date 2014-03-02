<?php
include_once( 'wp-load.php' );
get_header(); 
$title = 'Cancel Your Booking';
templ_page_title_above(); //page title above action hook?>
<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/s2.jpg) no-repeat center top">
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
$value = $_REQUEST['booking_id'];
					global $wpdb;
					$booking_master = $wpdb->prefix . "booking_master";
					$booking_personal_info = $wpdb->prefix . "booking_personal_info";
					$booking_transaction = $wpdb->prefix . "booking_transaction";
					$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
					$booking_log = $wpdb->prefix . "booking_master_log";
					$booking_transaction = $wpdb->prefix . "booking_transaction";
					$check_booking_sql = mysql_query("select * from $booking_master where booking_id = '".$_REQUEST['booking_id']."'");
					if(mysql_num_rows($check_booking_sql) > 0){
						echo '<center><h4>'.PAY_CANCEL_MSG.'</h4></center>';
						$wpdb->query("DELETE from $booking_master where booking_id = '".$_REQUEST['booking_id']."'");
						$wpdb->query("DELETE from $booking_personal_info where booking_id = '".$_REQUEST['booking_id']."'");
						$wpdb->query("DELETE from $booking_check_avilability where booking_id = '".$_REQUEST['booking_id']."'");
						$wpdb->query("DELETE from $booking_log where booking_id = '".$_REQUEST['booking_id']."'");
						$wpdb->query("DELETE from $booking_transaction where booking_id = '".$_REQUEST['booking_id']."'");
						echo '<center><h4>Your Booking Successfully Canceled.</h4></center>';
					} else {
						echo '<center><h4>You have been already canceled your booking...</h4></center>';
					}
?>
	</div>
			</div>
		</div>
<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>