<?php
include_once( 'wp-load.php' );
get_header(); ?>

<?php templ_page_title_above(); //page title above action hook?>

<div class="main_header" style="background:url(<?php bloginfo('template_directory'); ?>/images/dummy/s1.jpg) no-repeat center top">
    <div class="main_header_in">	
           	
           <div class="post-meta"><?php echo templ_page_title_filter(get_the_title()); //page tilte filter?></div>
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
	$check_in_date = strtotime($_POST['check_in_date']);
	$check_out_date = strtotime($_POST['check_out_date']);
	$no_rooms = $_POST['no_rooms'];
	$room_type = $_POST['room_type'];
	if($_POST['booking_id'] != ''){
		$booking_id = implode(',',$_POST['booking_id']);
	}
	$adults = $_POST['adults'];
	$days_between = ceil(abs($check_out_date - $check_in_date) / 86400);
	echo '<table cellspacing="1" cellpadding="4" border="1">
			<tr>
				<td align="left" valign="top">Arrival/Check-in</td>
				<td align="left" valign="top">'.date('d F Y',strtotime($_POST['check_in_date'])).'</td>
			</tr>
			<tr>
				<td align="left" valign="top">Departure/Check-out</td>
				<td align="left" valign="top">'.date('d F Y',strtotime($_POST['check_out_date'])).'</td>
			</tr>
			<tr>
				<td align="left" valign="top">Number Rooms</td>
				<td align="left" valign="top">'.$no_rooms.'</td>
			</tr>
			<tr>
				<td align="left" valign="top">Occupancy</td>
				<td align="left" valign="top">'.$adults.'</td>
			</tr>
			<tr>
				<td align="left" valign="top">Day(s)</td>
				<td align="left" valign="top">'.$days_between.'</td>
			</tr>
		</table>';
	global $wpdb;
	echo '<form name="booking_frm" id="booking_frm" action="'.get_option('siteurl').'/?ptype=submit_booking" method="post">
	<input type="hidden" name="check_in_date" id="check_in_date" value="'.$_POST['check_in_date'].'">
	<input type="hidden" name="check_out_date" id="check_out_date" value="'.$_POST['check_out_date'].'">
	<input type="hidden" name="no_rooms" id="no_rooms" value="'.$_POST['no_rooms'].'">
	<input type="hidden" name="room_type" id="room_type" value="'.$_POST['room_type'].'">
	<input type="hidden" name="booking_id" id="booking_id" value="'.$booking_id.'">
	<input type="hidden" name="adults" id="adults" value="'.$_POST['adults'].'">';
	echo get_room_type_data($room_type,'inner',$no_rooms,$_POST['check_in_date'],$_POST['check_out_date']);
	global $wpdb;
	$additional_price_table = $wpdb->prefix . "additional_price_master";
	$additional_child_table = $wpdb->prefix . "additional_price_child";
	$price_table = $wpdb->prefix . "room_type_price";	
	$r_cnt = 0;
	$a_cnt = 0;
	
	$final_price = 0;
	$add_final_price = 0;
	$afinal_price = 0;
	for($r_cnt = 0; $r_cnt < $no_rooms ; $r_cnt++) {
	/*echo '<label style="width:200px;float:left;">Room '.($r_cnt+1).'('.fecth_room_type_name($room_type).') : </label><select name="room_price" id="room_price">'.chk_additional_price($room_type,$_POST['check_in_date'],$_POST['check_out_date'],$adults).'</select><br /><br />';*/
	echo '<table border="1" cellpadding="4" cellspacing="3">
		<tr>
			<td>Room '.($r_cnt+1).'('.fecth_room_type_name($room_type).') :</td>';
			$p_dis = '';
			for($a_cnt = 0; $a_cnt < $adults ; $a_cnt++) { 
				if(($a_cnt+1) == '1'){
					$p_dis = 'Person';
				}else {
					$p_dis = 'Persons';
				}
				echo '<td>'.($a_cnt+1).'&nbsp;'.$p_dis.'</td>';
			}
		echo '</tr>';
		for($i = $_POST['check_in_date']; $i <= $_POST['check_out_date']; $i++ ){
			$a_cnti = 0;
			echo '<tr>
			 <td>'.$i.'</td>';
			 for($a_cnt = 0; $a_cnt < $adults ; $a_cnt++) { 
				$chk_additional_price_sql = mysql_query("select additional_price_id,from_date,to_date from $additional_price_table where room_type_id = '".$room_type."' and price_status ='Y'");
				if(mysql_num_rows($chk_additional_price_sql) > 0){
				while($chk_additional_price_res = mysql_fetch_array($chk_additional_price_sql)){
					if($i < $chk_additional_price_res['from_date'] || $i > $chk_additional_price_res['to_date']) {
						$price_child_sql = mysql_query("select * from $price_table where room_type_id = '".$room_type."' and person = '".($a_cnt + 1)."'");
						$price_child_res = mysql_fetch_array($price_child_sql);
						if(($a_cnt+1) == $adults){
							$final_price += $price_child_res['price'];
						}
						echo '<td>'.display_amount_with_currency($price_child_res['price'],display_currency()).'</td>';
					}
					else {
						$price_child_sql = mysql_query("select * from $additional_child_table where additional_price_id = '".$chk_additional_price_res['additional_price_id']."' and person = '".($a_cnt + 1)."'");
						$price_child_res = mysql_fetch_array($price_child_sql);
						if(($a_cnt+1) == $adults){
							$add_final_price += $price_child_res['additional_price'];
						}
						echo '<td>'.display_amount_with_currency($price_child_res['additional_price'],display_currency()).'</td>';
					}
				}		
				}else {
					$price_child_sql = mysql_query("select * from $price_table where room_type_id = '".$room_type."' and person = '".($a_cnt + 1)."'");
					$price_child_res = mysql_fetch_array($price_child_sql);
					if(($a_cnt+1) == $adults){
						$afinal_price += $price_child_res['price'];
					}
					echo '<td>'.display_amount_with_currency($price_child_res['price'],display_currency()).'</td>';
				}
			}	
			
			echo '</tr>';
		}
	echo '</table><hr />';
	}
	$ss = ($final_price + $add_final_price + $afinal_price);
	echo '<br /><strong>Services :</strong><br />'.to_get_services();
	echo '<input type="hidden" name="payble_amount" id="payble_amount" value="'.$ss.'">';
	if(get_option('is_allow_coupon_code')){
		echo '<h5 class="form_title">'.COUPON_CODE_TITLE_TEXT.'</h5> 
		  <div class="form_row clearfix">
			<label>'.PRO_ADD_COUPON_TEXT.'</label>
			<input type="text" name="booking_add_coupon" id="booking_add_coupon" class="textfield" value="'.esc_attr(stripslashes($booking_add_coupon)).'" />
			<span class="message_note">'.COUPON_NOTE_TEXT.'</span>
		</div>';
	}
	
	echo '<input type="submit" name="book_now" id="book_now" value="Book Now"  class="b_submit" >';
 ?>
	
	</form>	
 </div>
   </div>
</div>
<!--  CONTENT AREA END -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
