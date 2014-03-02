<?php
define('COUPON_CODE_TITLE_TEXT',__('Coupon Code','templatic'));

define('PUBLISH_DAYS_TEXT',__('%s : number of publish days are %s (<span id="%s">%s %s</span>)','templatic'));

define('SUBMIT_POST_PREVIEW_DISCOUNT_MSG',__('<br>Your applied coupon code is "%s" and discount amount is %s, deducted from the payable amount.','templatic'));

define('GOING_TO_PAY_MSG',__('This is preview of your listing and it&acute;s not published yet. <br />If there is something wrong click "Go back and edit" or if you want to add the listing then click on "Publish".<br> You are going to pay <b>%s</b> and  your listing will be published for  <b>%s</b> days as a %s listing','templatic'));
define('SUBMIT_POST_PREVIEW_FREE_MSG',__('This is preview of your listing and it&acute;s not published yet. <br />If there is something wrong click "Go back and edit" or if you want to add the listing then click on "Publish".<br> Your listing will be published for  <b>%s</b> days as a %s listing','templatic'));

define('GOING_TO_UPDATE_MSG',__('This is preview of your listing and its not updated yet. <br />If there is something wrong then "Go back and edit" or if you want to add listing then click on "Update now"','templatic'));
define('WRONG_COUPON_MSG',__('Invalid Coupon Code','templatic'));
define('PRO_PREVIEW_BUTTON',__('Review Your Listing','templatic'));
define('CUSTOMER_NAME_TITLE',__('Customer name','templatic'));
define('NAME_TITLE',__('Title','templatic'));
define('FIRST_NAME_TEXT',__('First name','templatic'));
define('LAST_NAME_TEXT',__('Last name','templatic'));
define('CONTACT_NAME_TEXT',__('Name','templatic'));
define('COUNTRY_TEXT',__('Country','templatic'));
define('STREET_TEXT',__('Street','templatic'));
define('CITY_TEXT',__('City / State','templatic'));
define('STATE_TEXT',__('State','templatic'));
define('PHONE_TEXT',__('Phone','templatic'));
define('MOBILE_TEXT',__('Mobile Number','templatic'));
define('EMAIL_TEXT',__('Email','templatic'));
define('WEBSITE_TEXT',__('Website','templatic'));
define('TWITTER_TEXT',__('Twitter','templatic'));
define('FACEBOOK_TEXT',__('Facebook','templatic'));

define('REQUEST_TEXT',__('Confirm the details you provided: ','templatic'));
define('ROOM_TYPE',__('Room Type','templatic'));
define('CHECK_IN_TEXT',__('Arrival/Check-in','templatic'));
define('CHECK_OUT_TEXT',__('Departure/Check-out','templatic'));
define('DAYS_TEXT',__('Day(s)','templatic'));
define('NO_ROOMS_TEXT',__('Number Of Rooms','templatic'));
define('OCCUPY_TEXT',__('Occupancy','templatic'));
define('ADULT_TEXT',__('Adults','templatic'));
define('ROOM_PRICE_TEXT',__('Room Price','templatic'));
define('PERSONAL_INFO_TEXT',__('Provide more details about yourself: ','templatic'));
define('SERVICE_COUPON_TEXT',__('Services / Coupon ','templatic'));

define('SERVICE_TEXT',__('Services :','templatic'));
define('TAX_TEXT',__('TAX','templatic'));
define('DEPOSITE_TEXT',__('Deposit','templatic'));
define('TOTAL_CHARGE_TEXT',__('Total Charges','templatic'));
define('PROMOTION',__('Coupon Discount','templatic'));
define('PAYMENT_METHOD_TEXT',__('Payment Method','templatic'));
define('PAYMENT_STATUS_TEXT',__('Payment Status','templatic'));

define('NOTIFY_SUCCESS_TEXT',__('Dear, %s your Transaction No. is : %s'));

define('PRO_BACK_AND_EDIT_TEXT',__('&laquo; Go Back and Edit','templatic'));
define('PRO_UPDATE_BUTTON',__('Update Now','templatic'));
define('PRO_SUBMIT_BUTTON',__('Publish','templatic'));
define('PRO_CANCEL_BUTTON',__('Cancel','templatic'));
define('PRO_SUBMIT_PAY_BUTTON',__('Pay & Publish','templatic'));
define('CONTACT_DETAIL_TITLE',__('Publisher Information','templatic'));
define('LISTING_DETAILS_TEXT',__('Enter Listing Details','templatic'));

define('POST_DELETE_PRE_MSG',__('Are you really sure want to DELETE this listing? A deleted listing can not be recovered later','templatic'));
define('POST_DELETE_BUTTON',__('Yes, Delete Please!','templatic'));
define('IS_A_FEATURE_PRO_TEXT',__('This place is listed as Featured. Do you want to remove it from featured listing?','templatic'));
define('SELECT_PAY_MEHTOD_TEXT',__('Select Payment Method','templatic'));

//success.php
define('POSTED_SUCCESS_TITLE',__('Submission Successfully','templatic'));
define('RENEW_SUCCESS_TITLE',__('Listing Renewal Successful','templatic'));
define('POSTED_SUCCESS_MSG',__('<h2>Listing information posted successfully.</h2> <p> You can edit this message from language.php file at root of theme folder.</p>','templatic'));
//cancel.php
define('PAY_CANCELATION_TITLE',__('Your Booking is successfully Cancelled','templatic'));
define('PAY_CANCEL_MSG',__('Your Booking is successfully Cancelled','templatic'));

//return.php
define('PAYMENT_SUCCESS_TITLE',__('Payment Success','templatic'));
define('PAYMENT_SUCCESS_MSG',__('Thank you for joining us. Your payment was received and your booking is confirmed.<br>Thank you for booking room in our hotel.','templatic'));

//paypal_response.php
define('PAYPAL_MSG',__('Processing for paypal, Please wait...'));
//2co_response.php
define('TWOCO_MSG',__('Processing for 2Checkout, Please wait...'));
//authorizenet_response.php
define('AUTHORISE_NET_MSG',__('Processing for Authorize Net, Please wait...'));
//googlechekcout_response.php
define('GOOGLE_CHKOUT_MSG',__('Processing for Google Checkout, Please wait...'));
//2co_response.php
define('WORLD_PAY_MSG',__('Processing for WordPay, Please wait...'));
define('PRO_ADD_COUPON_TEXT',__('Enter Coupon Code'));
define('COUPON_NOTE_TEXT',__('Enter coupon code here (optional)'));
$form_fields = array();

$form_fields['first_name'] = array(
				   'title'	=> 'First Name',
				   'name'	=> 'first_name',
				   'espan'	=> 'first_name_error',
				   'type'	=> 'text',
				   'text'	=> 'Please provide your first name.',
				   'validation_type' => 'require');
$form_fields['last_name'] = array(
					'title'	=> 'Last Name',
				   'name'	=> 'last_name',
				   'espan'	=> 'last_name_error',
				   'type'	=> 'text',
				   'text'	=> 'Please provide your last name.',
				    'validation_type' => 'require');
$form_fields['email_id'] = array(
				   'title'	=> 'Emai ID',
				   'name'	=> 'email_id',
				   'espan'	=> 'email_id_error',
				   'type'	=> 'text',
				   'text'	=> 'Please provide your Email ID.',
				   'validation_type' => 'email');
$form_fields['phone'] = array(
				   'title'	=> 'Phone',
				   'name'	=> 'phone',
				   'espan'	=> 'phone_error',
				   'type'	=> 'text',
				   'text'	=> 'Please provide your Phone no.',
				   'validation_type' => 'phone');
$form_fields['country'] = array(
				   'title'	=> 'Country',
				   'name'	=> 'country',
				   'espan'	=> 'country_error',
				   'type'	=> 'text',
				   'text'	=> 'Please select your country.',
				    'validation_type' => 'require');
$form_fields['city'] = array(
				   'title'	=> 'City',
				   'name'	=> 'city',
				   'espan'	=> 'city_error',
				   'type'	=> 'text',
				   'text'	=> 'Please provide your city name.',
				   'validation_type' => 'require');	
$form_fields['street'] = array(
				   'title'	=> 'Street',
				   'name'	=> 'street',
				   'espan'	=> 'street_error',
				   'type'	=> 'text',
				   'text'	=> 'Please provide your street address.',
				   'validation_type' => 'require');	
   

global $wpdb;
$booking_field = $wpdb->prefix . "booking_field";
$extra_field_sql = mysql_query("select * from $booking_field where 	isfieldoptional = '0' order by fieldposition");
while($res = mysql_fetch_array($extra_field_sql)){
	$title = $res['field_front_title'];
	$name = $res['fieldname'];
	$type = $res['fieldtype'];
	$option_values = $res['fieldvalue'];
	$require_msg = $res['field_require_desc'];
	$validation_type = $res['validation_type'];
	$form_fields[$name] = array(
				   'title'	=> $title,
				   'name'	=> $name,
				   'espan'	=> $name.'_error',
				   'type'	=> $type,
				   'text'	=> $require_msg,
				   'validation_type' => $validation_type);	
	
}
?>