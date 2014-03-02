<?php
/******************************************************************
=======  PLEASE DO NOT CHANGE BELOW CODE  =====
You can add in below code but don't remove original code.
This code to include add post,edit and preview from front end.
This file is included in functions.php of theme root at very last php coding line.

You can call add post,edit and preview page by the link 
Add New Post : http://mydomain.com/?ptype=submition  => echo site_url('/?ptype=submition');
Preview New Post : http://mydomain.com/?ptype=register => echo site_url('/?ptype=preview');
Payment New Post : http://mydomain.com/?ptype=register => echo site_url('/?ptype=paynow');
Payment Cancel Return : http://mydomain.com/?ptype=register => echo site_url('/?ptype=cancel_return');
Payment Payment Success : http://mydomain.com/?ptype=register => echo site_url('/?ptype=payment_success');
Payment Success : http://mydomain.com/?ptype=register => echo site_url('/?ptype=payment_success');
Paypal Return : http://mydomain.com/?ptype=register => echo site_url('/?ptype=return');
Paypal Success : http://mydomain.com/?ptype=register => echo site_url('/?ptype=success');
********************************************************************/
define('TEMPL_USER_BOOKING_FOLDER',TT_MODULES_FOLDER_PATH . "user_booking/");
define('TEMPL_USER_BOOKING_URI',get_bloginfo('template_directory') . "/modules/user_booking/");

include_once(TEMPL_USER_BOOKING_FOLDER.'lang_user_booking.php'); // language file

////////filter to retrive the page HTML from the url.
add_filter('templ_add_template_page_filter','templ_add_template_booking_page'); //filter to add pages like addpost,preveiw,delete and etc....
include_once(TEMPL_USER_BOOKING_FOLDER.'functions_user_booking.php'); // function file
function templ_add_template_booking_page($template)
{
	if($_GET['ptype'] == 'user_booking')
	{
		$template = TEMPL_USER_BOOKING_FOLDER.'user_booking.php';
	}if($_GET['ptype'] == 'select_room')
	{
		$template = TEMPL_USER_BOOKING_FOLDER.'room_price.php';
	}if($_GET['ptype'] == 'hotel_detail')
	{
		$template = TEMPL_USER_BOOKING_FOLDER.'hotel_detail.php';
	}if($_GET['ptype'] == 'submit_booking')
	{
		$template = TEMPL_USER_BOOKING_FOLDER.'submit_booking.php';
	}if($_GET['ptype'] == 'insert_booking')
	{
		$template = TEMPL_USER_BOOKING_FOLDER.'insert_booking.php';
	}if($_GET['ptype'] == 'success')
	{
		$template = TEMPL_USER_BOOKING_FOLDER.'success.php';
	}if($_GET['ptype'] == 'cancel_booking') {
		$template = TEMPL_USER_BOOKING_FOLDER.'cancel_booking.php';
	}if($_GET['ptype'] == 'booking_list') {
		$template = TEMPL_USER_BOOKING_FOLDER.'show_booking.php';
	}if($_GET['ptype'] == 'return') {
		$template = TEMPL_USER_BOOKING_FOLDER.'return.php';
	}if($_GET['ptype'] == 'cancel_return') {
		$template = TEMPL_USER_BOOKING_FOLDER.'cancel.php';
	}if($_GET['ptype'] == 'notifyurl') {
		$template = TEMPL_USER_BOOKING_FOLDER.'notifyurl.php';
	}if($_GET['ptype'] == 'validate_form') {
		$template = TEMPL_USER_BOOKING_FOLDER.'validate_form.php';
	}
	
	return $template;
}
?>