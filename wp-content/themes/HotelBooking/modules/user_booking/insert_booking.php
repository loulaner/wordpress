<?php get_header(); ?>


<?php templ_page_title_above(); //page title above action hook?>

<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/s4.jpg) no-repeat center top">
    <div class="main_header_in">	
           	
           <div class="post-meta"><h1><?php _e('Confirm Your Booking','templatic');?></h1></div>
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
				$booking_master = $wpdb->prefix . "booking_master";
				$room_master = $wpdb->prefix . "room_master";
				$booking_personal_info = $wpdb->prefix . "booking_personal_info";
				$booking_log = $wpdb->prefix . "booking_master_log";
				$title = $_POST['title'];
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$country = $_POST['country'];
				$city = $_POST['city'];
				$street = $_POST['street'];
				$check_in_date = $_POST['check_in_date'];
				$check_out_date = $_POST['check_out_date'];
				$room_type_id = $_POST['room_type_id'];
				$total_price = $_POST['final_total_price'];
				$no_rooms = $_POST['no_rooms'];
				$tax = $_POST['tax'];
				$deposite = $_POST['deposite'];
				$without_deposite_price = $_POST['without_deposite_price'];
				$promotion_amt = $_POST['promotion_amt'];
				$paymentmethod = $_REQUEST['paymentmethod'];
				$adults = $_POST['adults'];
				if($_POST['booking_id'] != '') {
					$booking_id = explode(',',$_POST['booking_id']);
					foreach($booking_id as $b_key => $b_value){
						$booking_sql = mysql_query("select room_id from $booking_master where booking_id = '".$b_value."'");
						if(mysql_num_rows($booking_sql) > 0){
							$booking_res = mysql_fetch_array($booking_sql);
							$room_booking = explode(',',$booking_res['room_id']);
							$room_master_sql = mysql_query("select * from $room_master where room_type_id = '".$room_type_id."'");
							while($room_master_res = mysql_fetch_array($room_master_sql)){
								$room_id[] = $room_master_res['room_id'];
							}
							$available = array_diff($room_id, $room_booking);
							$room_id_array = implode(',',$available);
						} 
					}
				} else {
					$room_id_array = '';
					$room_master_sql = mysql_query("select * from $room_master where room_type_id = '".$room_type_id."' and room_status = 'E'");
					while($room_master_res = mysql_fetch_array($room_master_sql)){
						$room_id_array .= $room_master_res['room_id'].',';
					}
				}	
				$array_cnt = explode(',',$room_id_array);
				$cnt = 0;
				foreach($array_cnt as $rskey => $rsvalue){
					$cnt ++;
					if($cnt > $no_rooms){
						// Do Nothing;
					} else {
						$room_ids[] = $rsvalue;
					}
				}
				$final_room_ids = implode(',',$room_ids);
				$len = strlen($final_room_ids);
				if((substr($final_room_ids,-1)) == ','){
					$final_room = substr($final_room_ids,0,($len-1));
				} else {
					$final_room = $final_room_ids;
				} 
				$booking_master_sql = "INSERT INTO $booking_master (booking_id,check_in_date,check_out_date,booking_date,room_type_id,total_price,room_id,service_id,booking_status,ip_address) VALUES('','".$check_in_date."','".$check_out_date."',now(),'".$room_type_id."','".$total_price."','".$final_room."','".$_POST['service_id']."','pending','".$_SERVER['REMOTE_ADDR']."') ";
				$wpdb->query($booking_master_sql);
				$booking_insert_id = mysql_insert_id();
				$pnr_no = 'HB'.$booking_insert_id;
				$wpdb->query("update $booking_master set pnr_no = '".$pnr_no."' where booking_id = '".$booking_insert_id."'");
				$booking_personal_sql = "INSERT INTO $booking_personal_info (personal_info_id,booking_id,title,first_name,last_name,email,phone,country,city,street) VALUES('', '".$booking_insert_id."', '".$title."','".$first_name."','".$last_name."','".$email."','".$phone."','".$country."','".$city."','".$street."') ";
				$wpdb->query($booking_personal_sql);
			
				$booking_log_sql = "INSERT INTO $booking_log (booking_log_id,booking_id,total_room,total_adult,tax_amt,room_price,deposite,without_deposite_price,promotion_amt,payable_amt,payment_method,status) VALUES('', '".$booking_insert_id."', '".$no_rooms."','".$adults."','".$tax."','".$_POST['room_price']."','".$deposite."','".$without_deposite_price."','".$promotion_amt."','".$total_price."','".$paymentmethod."','pending') ";
				$wpdb->query($booking_log_sql);
				
				insert_extra_field($booking_insert_id);
			
				$_SESSION['booking_id'] = $booking_insert_id;
				$_SESSION['payable_amount'] = $total_price;	
				$last_bookingid = $_SESSION['booking_id'];
				$payable_amount = $_SESSION['payable_amount'];
				$room_desc = fecth_room_type_name($room_type_id);
				global $last_bookingid,$room_desc,$payable_amount;
				$paymentSuccessFlag = 0;
				if($paymentmethod == 'prebanktransfer' || $paymentmethod == 'payondelevary')
				{
					$suburl .= "&booking_id=$booking_insert_id";
					echo '<script>location.href="'.site_url().'/?ptype=success&paydeltype='.$paymentmethod.$suburl.'";</script>';
				}
				else
				{
					if(file_exists( TEMPLATEPATH.'/library/payment/'.$paymentmethod.'/'.$paymentmethod.'_response.php'))
					{
						include_once(TEMPLATEPATH.'/library/payment/'.$paymentmethod.'/'.$paymentmethod.'_response.php');
					}
				}
				exit;	?>
		</div>
			</div>
		</div>
<!--  CONTENT AREA END -->
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
