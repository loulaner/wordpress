<?php
if(fetch_global_settings('allow_reservation') == 'Y') {
$max_adults = fetch_global_settings('max_adults');
$max_rooms = fetch_global_settings('max_rooms');
?>
<script type="text/javascript">var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dhtmlgoodies_calendar.js"></script>
<form name="reservation_frm" id="reservation_frm" action="<?php echo get_option('siteurl');?>/?ptype=validate_form" method="post"  >
 	<div class="book_row">
			<input name="side_check_in_date" id="check_in_date" type="text" class="textfield calendar" readonly="readonly" value="入住" /><img src="<?php bloginfo('template_directory'); ?>/images/i_cale.png" alt="" class="cal"  onclick="displayCalendar(document.reservation_frm.side_check_in_date,'yyyy-mm-dd',this)" />
            </div>
          
		<div class="book_row ">
			<input name="side_check_out_date" id="check_out_date" type="text" class="textfield calendar" readonly="readonly" value="退房" /><img src="<?php bloginfo('template_directory'); ?>/images/i_cale.png" alt=""  class="cal" onclick="displayCalendar(document.reservation_frm.side_check_out_date,'yyyy-mm-dd',this)" />
           </div>
		
        <div class="book_row">
			<select name="side_adults" id="adults" class="booking_input adults"><option value=""><?php _e('Adults','templatic');?></option><?php  $a = 1;
				for($a=1;$a <= $max_adults ;$a++){
					echo '<option value="'.$a.'">'.$a.'</option>';
				} ?></select> 
                </div>
                
	  
        <div class="book_row ">
		<select name="side_no_rooms" id="no_rooms" class="booking_input room"><option value=""><?php _e('No. Of Rooms','templatic');?></option><?php  $n = 1;
		for($n=1;$n <= $max_rooms;$n++){
			echo '<option value="'.$n.'">'.$n.'</option>';
		} ?></select>
        </div>
     	
       	<div class="book_row ">
			<select name="side_room_type" id="room_type" class="booking_input roomtype"><option value="">选择房间类型</option><?php echo room_type_cmb();?></select>
        </div>    
  <input type="submit" name="submit" id="save" value="<?php _e('Submit','templatic');?>"  class="b_submit" />	
<?php 
} else {
	echo '<center>Booking currently closed by administrator...</center>';
}?>

</form>