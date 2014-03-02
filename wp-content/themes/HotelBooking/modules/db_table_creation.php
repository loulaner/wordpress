<?php 
global $wpdb;
/* Global Settings Table Creation BOF */
$global_settings = $wpdb->prefix . "global_settings";
if($wpdb->get_var("SHOW TABLES LIKE \"$global_settings\"") != $global_settings) { 
	$create_global_settings = "CREATE TABLE " . $global_settings . " (setting_id int(8) NOT NULL AUTO_INCREMENT,
	  allow_reservation char(1) NOT NULL,
	  max_adults int(3) NOT NULL,
	  max_rooms int(3) NOT NULL,
	  paid_submission char(1) NOT NULL,
	  currency varchar(50) NOT NULL,
	  symbol_position varchar(100) NOT NULL,
	  tax int(3) NOT NULL,
	  tax_type varchar(20) NOT NULL,
	  deposite_percentage varchar(250) NOT NULL,
	  booking_success_msg text NOT NULL,
	  cash_success_msg text NOT NULL,
	  not_available_msg text NOT NULL,
	  PRIMARY KEY setting_id (setting_id));";
	$wpdb->query($create_global_settings);
	$booking_success_msg = stripslashes('<p>Congratulations, your booking request is confirmed.</p>
<p>In case you have any queries, please email us at <a href="mailto:[CONTACT_EMAIL]"><em>[CONTACT_EMAIL]</em></a> by quoting this transaction number. We will be glad to assist you.</p>');
	$cash_success_msg = stripslashes('<p>Please pay the booking amount on arrival at our reception desk.</p>
<p>In case you have any queries, please email us at <a href="mailto:[CONTACT_EMAIL]"><em>[CONTACT_EMAIL]</em></a> by  quoting this transaction number. We will be glad to assist you.</p>');
	$not_available_msg = stripslashes("<p>Sorry, currently no rooms are available matching your criteria.</p>
<p>Please try again at a later time</p>");
	$insert_global_config = "INSERT INTO " . $global_settings . "(setting_id,allow_reservation, max_adults,max_rooms,paid_submission,currency,symbol_position,tax,tax_type,deposite_percentage,booking_success_msg,cash_success_msg,not_available_msg ) VALUES('','Y','6','8','E','USD','1','10','percent','100','".addslashes($booking_success_msg)."','".addslashes($cash_success_msg)."','".addslashes($not_available_msg)."')";
	$wpdb->query($insert_global_config);
}
/* Global Settings Table Creation EOF */

/* Email Configuration Table Creation BOF */
$email_setting = $wpdb->prefix . "email_configuration";
if($wpdb->get_var("SHOW TABLES LIKE \"$email_setting\"") != $email_setting) { 
	$nl = "</br>";
	$href = "<a href='#'>";
	$ehref ="</a>";
	$reqemail = '<p>Hi [USER_NAME]<br />Thank you, your booking request is received successfully. We will contact you soon for the confirmation.</p>
<p>In case you have any queries, please email us at <a href="mailto:[CONTACT_EMAIL]"><em>[CONTACT_EMAIL]</em></a>. We will be glad to assist you.</p>
<p>If you want to cancel your booking request then click on link given below.<br />[CANCEL_URL]</p>
<p>[BOOKING_DETAIL]</p>
<p>Thank you for staying at our Hotel.<br />[ADMIN_NAME]</p>';
	$activateemail = '<p>Hi[USER_NAME],<br />Your booking is confirmed. We hope you enjoy the stay at our Hotel.</p>
<p>In case you have any queries, please email us at <a href="mailto:[CONTACT_EMAIL]"><em>[CONTACT_EMAIL]</em></a>. We will be glad to assist you.</p>
<p>If you want to cancel your booking request then click on link given below.</p>
<p>[CANCEL_URL]<br />Thank you for staying at our Hotel.</p>
<p><br />[ADMIN_NAME]</p>';
	$cancelemail = '<p>Hi[USER_NAME],<br />Your booking request is rejected. Please try again later.<br /><br />Thanks for your interest in our Hotel.<br />[ADMIN_NAME]</p>';
	$templatic_admin_record = $wpdb->prefix."users";
	$templatic_request_usermail = $wpdb->get_row("select * from $templatic_admin_record where user_login = 'admin'");
	$emailid = $templatic_request_usermail->user_email;
	$request_email_sub = "Booking- Email Confirmation";
	$active_email_sub = "Booking-Confirm";
	$cancel_email_sub = "Booking- Could not confirm";
	$create_email = "CREATE TABLE " . $email_setting . " (
		email_id int(8) NOT NULL AUTO_INCREMENT,
		user_email varchar(200) NOT NULL,
		request_email_sub varchar(250) NOT NULL,
		request_email text NOT NULL,
		active_email_sub varchar(250) NOT NULL,
		active_email text NOT NULL,
		cancel_email_sub varchar(250) NOT NULL,
		cancel_email text NOT NULL,
		PRIMARY KEY email_id (email_id));";
	$wpdb->query($create_email);
	$insert_email_config = "INSERT INTO " . $email_setting . "(email_id,user_email, request_email_sub,request_email,active_email_sub,active_email,cancel_email_sub,cancel_email) VALUES('','".$emailid."','".$request_email_sub."','".$reqemail."','".$active_email_sub."', '".$activateemail."','".$cancel_email_sub."','".$cancelemail."')";
	$wpdb->query($insert_email_config);
}
/* Email Configuration Table Creation EOF */

/* Hotel Information Table Creation BOF */
$hotel_info_table = $wpdb->prefix . "hotel_info_master";
if($wpdb->get_var("SHOW TABLES LIKE \"$hotel_info_table\"") != $hotel_info_table) { 
	$create_hotel_info = "CREATE TABLE " . $hotel_info_table . " (
	  hotel_id int(8) NOT NULL AUTO_INCREMENT,
	  hotel_name varchar(255) NOT NULL,
	  contact_hotel_mail varchar(255) NOT NULL,
	  hotel_country varchar(255) NOT NULL,
	  hotel_state varchar(255) NOT NULL,
	  hotel_street varchar(255) NOT NULL,
	  contact_phone_1 varchar(250) NOT NULL,
	  contact_phone_2 varchar(250) NOT NULL,
	  success_mail_status  char(1) NOT NULL,
	  mail_from varchar(255) NOT NULL,
	  PRIMARY KEY hotel_id (hotel_id));";
	$wpdb->query($create_hotel_info);
	$hotel_street = stripslashes("Hotel Oberoi, Mumbai");
	$insert_hotel_info = "INSERT INTO " . $hotel_info_table . "(hotel_id,hotel_name, contact_hotel_mail,hotel_country,hotel_state,hotel_street,contact_phone_1,contact_phone_2,success_mail_status,mail_from) VALUES('','Hotel Oberoi','testtemplatic@gmail.com','India','Mumbai', '".addslashes($hotel_street)."','111-222-333','111-222-333','E','[website_name]')";
	$wpdb->query($insert_hotel_info);
}
/* Hotel Information Table Creation EOF */

/* Room Type Table Creation BOF*/
	$room_type_table = $wpdb->prefix . "room_type_master";
	$price_table = $wpdb->prefix . "room_type_price";
	$additional_price_table = $wpdb->prefix . "additional_price_master";
	$additional_child_table = $wpdb->prefix . "additional_price_child";
	if($wpdb->get_var("SHOW TABLES LIKE \"$room_type_table\"") != $room_type_table) {
		$create_room_type = "CREATE TABLE IF NOT EXISTS $room_type_table (
		room_type_id int(8) NOT NULL AUTO_INCREMENT,
		room_type_name varchar(255) NOT NULL,
		room_type_description text NOT NULL,
		room_type_capacity int(5) NOT NULL,
		has_tax char(1) NOT NULL,
		meta_title text NOT NULL,
		meta_description text NOT NULL,
		meta_keyword text NOT NULL,
		PRIMARY KEY (room_type_id))";
		$wpdb->query($create_room_type);
		
		$room_type_description = stripslashes("<p>We offers rooms with <strong>free Wi-Fi and satellite TV</strong>, just a 5-minute walk  from Central Station. It features a modern atrium breakfast  room and a stylish bar.</p>
<p>The air-conditioned rooms are modern and warmly decorated. They have a  luxurious private bathroom with a bath, climate control and coffee and  tea facilities. Room service is available.</p>
<p>Guests can start their day with a good breakfast in the trendy  restaurant, including fruits, eggs, and fresh orange juice. Even a glass  of Prosecco is available.</p>
<p>A cancellation is free of charge if done by <strong>02:00 PM </strong>(hotel local time). Penalty Charge for late cancellation is 1 night</p>
<p><strong>All our rooms come with the following  features:</strong><br />Satellite television | DVD Player | Wireless broadband  Internet access | Electronic Safe | 2 Line telephone with voice mail |  Plasma TV | Data port for internet connectivity | Mini bar with Premium  international brands | Personalized butler service | Non-smoking floor.</p>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,&nbsp; justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam&nbsp; ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo&nbsp; porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis&nbsp; ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean&nbsp; sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,&nbsp; odio.</p>
<p>Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce&nbsp; varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,&nbsp; libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat&nbsp; feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,&nbsp; sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.&nbsp; Donec nec libero</p>
<p>Vestibulum ut nisl. Donec eu mi sed turpis feugiat&nbsp; feugiat. Integer  turpis arcu, pellentesque eget, cursus et, fermentum ut,&nbsp; sapien. Fusce  metus mi, eleifend sollicitudin, molestie id, varius et, nibh.&nbsp; Donec  nec libero</p>");
		$page_title = stripslashes("Deluxe Room");
		$page_description = stripslashes("Deluxe Room");
		$page_keyword = stripslashes("Deluxe Room,Hotel Booking");
		
		$room_type_description2 = stripslashes("<p>Hotel Extea is situated just outside the centre of Amsterdam, which can be reached in 10 minutes by tram.There is free Wi-Fi.</p>
<p>The rooms have extra long beds and a flat-screen TV with several  interactive functions. The refrigerator in each room will keep your  drinks and food cooled.</p>
<p>A Dutch breakfast buffet is served each morning in the restaurant.  For lunch and dinner you can order international and seasonal dishes.</p>
<p>When temperatures are mild, the covered terrace is a relaxing place  for a drink. Light dishes and tapas are served in the bar with a view  over the surrounding area.</p>
<p>Dinner is served at the neighbouring restaurant McDonalds. The costs  can be charged to the guest's hotel account. A drink in the hotel bar  lounge is the perfect way to end the day.</p>
<p><strong>All our rooms come with the following  features:</strong><br /> Satellite television | DVD Player | Wireless broadband  Internet access | Electronic Safe | 2 Line telephone with voice mail |  Plasma TV | Data port for internet connectivity | Mini bar with Premium  international brands | Personalized butler service | Non-smoking floor.</p>
<p>Lorem  ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,&nbsp;  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy  quam&nbsp; ante ac quam. Maecenas urna purus, fermentum id, molestie in,  commodo&nbsp; porttitor, felis. Nam blandit quam ut lacus. Quisque ornare  risus quis&nbsp; ligula. Phasellus tristique purus a augue condimentum  adipiscing. Aenean&nbsp; sagittis. Etiam leo pede, rhoncus venenatis,  tristique in, vulputate at,&nbsp; odio.</p>
<p>Donec et ipsum et sapien  vehicula nonummy. Suspendisse potenti. Fusce&nbsp; varius urna id quam. Sed  neque mi, varius eget, tincidunt nec, suscipit id,&nbsp; libero. In eget  purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat&nbsp; feugiat.  Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,&nbsp;  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et,  nibh.&nbsp; Donec nec libero</p>
<p>Vestibulum ut nisl. Donec eu mi sed turpis feugiat&nbsp; feugiat. Integer  turpis arcu, pellentesque eget, cursus et, fermentum ut,&nbsp; sapien. Fusce  metus mi, eleifend sollicitudin, molestie id, varius et, nibh.&nbsp; Donec  nec libero</p>");
		$page_title2 = stripslashes("Executive Suite ");
		$page_description2 = stripslashes("Executive Suite ");
		$page_keyword2 = stripslashes("Executive Suite ,Hotel Booking");
		$room_type_capacity = 2;
		$insertroom_type = "INSERT INTO $room_type_table (room_type_id,room_type_name,room_type_description,room_type_capacity,has_tax,meta_title,meta_description,meta_keyword) VALUES('','Deluxe Room','".addslashes($room_type_description)."','2','N','".addslashes($page_title)."','".addslashes($page_description)."','".addslashes($page_keyword)."') ";
		
		$insertroom_type2 = "INSERT INTO $room_type_table (room_type_id,room_type_name,room_type_description,room_type_capacity,has_tax,meta_title,meta_description,meta_keyword) VALUES('','Executive Suite ','".addslashes($room_type_description2)."','2','N','".addslashes($page_title2)."','".addslashes($page_description2)."','".addslashes($page_keyword2)."') ";
		$wpdb->query($insertroom_type);
		$wpdb->query($insertroom_type2);
		
	}
	if($wpdb->get_var("SHOW TABLES LIKE \"$price_table\"") != $price_table) {
		$create_price = "CREATE TABLE IF NOT EXISTS $price_table (
		price_id int(8) NOT NULL AUTO_INCREMENT,
		room_type_id int(8) NOT NULL COMMENT 'Primary Key of room_type_master Table',
		person int(3) NOT NULL,
		price int(8) NOT NULL,
		modifieddate datetime NOT NULL,
		priority varchar(100) NOT NULL,
		price_status char(1) NOT NULL,
		PRIMARY KEY (price_id))";
		$wpdb->query($create_price);
		$insertroom_type_price = "INSERT INTO $price_table (price_id,room_type_id,person,price,modifieddate) VALUES('','1','1','100',now()) ";
		$wpdb->query($insertroom_type_price);
		$insertroom_type_price2 = "INSERT INTO $price_table (price_id,room_type_id,person,price,modifieddate) VALUES('','1','2','200',now()) ";
		$wpdb->query($insertroom_type_price2);
		$insertroom_type_price_2 = "INSERT INTO $price_table (price_id,room_type_id,person,price,modifieddate) VALUES('','2','1','200',now()) ";
		$wpdb->query($insertroom_type_price_2);
		$insertroom_type_price2_2 = "INSERT INTO $price_table (price_id,room_type_id,person,price,modifieddate) VALUES('','2','2','300',now()) ";
		$wpdb->query($insertroom_type_price2_2);
	}
	if($wpdb->get_var("SHOW TABLES LIKE \"$additional_price_table\"") != $additional_price_table) {
		$create_add_price = "CREATE TABLE IF NOT EXISTS $additional_price_table (
		  additional_price_id int(8) NOT NULL AUTO_INCREMENT,
		  room_type_id int(8) NOT NULL,
		  from_date date NOT NULL,
		  to_date date NOT NULL,
		  price_status char(1) NOT NULL,
		  PRIMARY KEY (additional_price_id))";
		$wpdb->query($create_add_price);
	}if($wpdb->get_var("SHOW TABLES LIKE \"$additional_child_table\"") != $additional_child_table) {
		$create_add_child_price = "CREATE TABLE IF NOT EXISTS $additional_child_table (
		  additional_child_id int(8) NOT NULL AUTO_INCREMENT,
		  additional_price_id int(8) NOT NULL ,
		  person int(8) NOT NULL,
		  additional_price int(8) NOT NULL,
		  PRIMARY KEY (additional_child_id))";
		$wpdb->query($create_add_child_price);
	}	
/* Room Type Table Creation EOF*/

/* Room Table Creation BOF*/
$room_table = $wpdb->prefix . "room_master";
	if($wpdb->get_var("SHOW TABLES LIKE \"$room_table\"") != $room_table) {
		$create_room_table = "CREATE TABLE IF NOT EXISTS $room_table (
		room_id int(8) NOT NULL AUTO_INCREMENT,
		room_type_id int(8) NOT NULL COMMENT 'Primary Key of room_type_master Table',
		room_name varchar(255) NOT NULL,
		room_status char(1) NOT NULL COMMENT 'E - Enable , D- Disable',
		sortorder int(8) NOT NULL,
		PRIMARY KEY (room_id))";
		$wpdb->query($create_room_table);
		$wpdb->query("INSERT INTO $room_table ( room_id,room_type_id,room_name,room_status,sortorder) VALUES('','1','Deluxe Room 1','E','1') ");
		$wpdb->query("INSERT INTO $room_table ( room_id,room_type_id,room_name,room_status,sortorder) VALUES('','1','Deluxe Room 2','E','2') ");
		$wpdb->query("INSERT INTO $room_table ( room_id,room_type_id,room_name,room_status,sortorder) VALUES('','2','Executive Suite Room 1','E','3') ");
		$wpdb->query("INSERT INTO $room_table ( room_id,room_type_id,room_name,room_status,sortorder) VALUES('','2','Executive Suite Room 2','E','4') ");
	}
/* Room Table Creation EOF*/

/* Room Gallery Creation BOF*/
	$room_gallery_table = $wpdb->prefix . "room_type_gallery";
	if($wpdb->get_var("SHOW TABLES LIKE \"$room_gallery_table\"") != $room_gallery_table) {
		$create_room_gallery = "CREATE TABLE IF NOT EXISTS $room_gallery_table (
		gallery_id int(8) NOT NULL AUTO_INCREMENT,
		room_type_id int(8) NOT NULL COMMENT 'Primary Key of room_type_master Table',
		file_title varchar(255) NOT NULL,
		alternate_text varchar(255) NOT NULL,
		img_description text NOT NULL,
		gallery_photo varchar(100) NOT NULL,
		file_url text NOT NULL,
		sortorder int(8) NOT NULL,
		PRIMARY KEY (gallery_id))";
		$wpdb->query($create_room_gallery);
	}	
/* Room Gallery Creation EOF*/


/* Custom Field Table Creation BOF */
$booking_field = $wpdb->prefix . "booking_field";
	if($wpdb->get_var("SHOW TABLES LIKE \"$booking_field\"") != $booking_field) {
		$create_booking_field = "CREATE TABLE IF NOT EXISTS $booking_field (
		field_id int(8) NOT NULL AUTO_INCREMENT,
		fieldname varchar(200) NOT NULL,
		fieldtype varchar(20) NOT NULL,
		fieldvalue text NOT NULL,
		field_front_title text NOT NULL,
		isfieldoptional int(1) NOT NULL COMMENT '1 - Yes , 0 - No',
		fieldposition int(5) NOT NULL,
		field_require_desc text NOT NULL,
		field_description text NOT NULL,
		style_class varchar(200) NOT NULL,
		extra_parameter text NOT NULL,
		validation_type varchar(20) NOT NULL,
		PRIMARY KEY (field_id))";
		$wpdb->query($create_booking_field);
	}
$booking_field_value = $wpdb->prefix . "booking_field_value";
	if($wpdb->get_var("SHOW TABLES LIKE \"$booking_field_value\"") != $booking_field_value) {
		$create_booking_field = "CREATE TABLE IF NOT EXISTS $booking_field_value (
		field_value_id bigint(11) NOT NULL AUTO_INCREMENT,
		booking_id bigint(11) NOT NULL,
		field_id int(8) NOT NULL,
		field_value text NOT NULL,
		PRIMARY KEY (field_value_id))";
		$wpdb->query($create_booking_field);
	}
  
/* Custom Field Table Creation EOF */



/*Booking Table Creation BOF */
	$booking_master = $wpdb->prefix . "booking_master";
	$booking_personal_info = $wpdb->prefix . "booking_personal_info";
	$booking_transaction = $wpdb->prefix . "booking_transaction";
	$booking_check_avilability = $wpdb->prefix . "booking_check_avilability";
	$booking_log = $wpdb->prefix . "booking_master_log";
	if($wpdb->get_var("SHOW TABLES LIKE \"$booking_master\"") != $booking_master) {
		$create_booking_master = "CREATE TABLE IF NOT EXISTS $booking_master (
		booking_id bigint(11) NOT NULL AUTO_INCREMENT,
		pnr_no varchar(100) NOT NULL,
		check_in_date date NOT NULL,
		check_out_date date NOT NULL,
		booking_date datetime NOT NULL,
		room_type_id int(8) NOT NULL,
		total_price int(8) NOT NULL,
		room_id varchar(255) NOT NULL,
		service_id varchar(255) NOT NULL,
		booking_status varchar(20) NOT NULL,
		ip_address varchar(100) NOT NULL,
		PRIMARY KEY (booking_id))";
		$wpdb->query($create_booking_master);
	}
	if($wpdb->get_var("SHOW TABLES LIKE \"$booking_personal_info\"") != $booking_personal_info) {
		$create_booking_personal_info = "CREATE TABLE IF NOT EXISTS $booking_personal_info (
		personal_info_id bigint(11) NOT NULL AUTO_INCREMENT,
		booking_id bigint(11) NOT NULL,
		title varchar(10) NOT NULL,
		first_name varchar(255) NOT NULL,
		last_name varchar(255) NOT NULL,
		email varchar(200) NOT NULL,
		phone varchar(200) NOT NULL,
		country varchar(200) NOT NULL,
		city varchar(100) NOT NULL,
		street varchar(255) NOT NULL,
		PRIMARY KEY (personal_info_id))";
		$wpdb->query($create_booking_personal_info);
	}if($wpdb->get_var("SHOW TABLES LIKE \"$booking_transaction\"") != $booking_transaction) {
		$create_booking_personal_info = "CREATE TABLE IF NOT EXISTS $booking_transaction (
		transaction_id bigint(11) NOT NULL AUTO_INCREMENT,
		booking_id bigint(11) NOT NULL,
		booking_date datetime NOT NULL,
		transaction_date datetime NOT NULL,
		amount decimal(8,2) NOT NULL,
		currency varchar(5) NOT NULL,
		PRIMARY KEY (transaction_id))";
		$wpdb->query($create_booking_personal_info);
	}	
	if($wpdb->get_var("SHOW TABLES LIKE \"$booking_check_avilability\"") != $booking_check_avilability) {
		$create_booking_check_avilability = "CREATE TABLE IF NOT EXISTS $booking_check_avilability (
		check_availability_id bigint(11) NOT NULL AUTO_INCREMENT,
		booking_id bigint(11) NOT NULL,
		check_in_date date NOT NULL,
		check_out_date date NOT NULL,
		room_type_id int(8) NOT NULL,
		total_room int(3) NOT NULL,
		PRIMARY KEY (check_availability_id))";
		$wpdb->query($create_booking_check_avilability);
	}if($wpdb->get_var("SHOW TABLES LIKE \"$booking_log\"") != $booking_log) {
		$create_booking_log = "CREATE TABLE IF NOT EXISTS $booking_log (
		booking_log_id bigint(11) NOT NULL AUTO_INCREMENT,
		booking_id bigint(11) NOT NULL,
		total_room int(4) NOT NULL,
		total_adult int(4) NOT NULL,
		tax_amt varchar(10) NOT NULL,
		room_price varchar(255) NOT NULL,
		deposite varchar (8) NOT NULL,
		without_deposite_price decimal(8,2) NOT NULL,
		promotion_amt decimal(8,2) NOT NULL,
		payable_amt decimal(8,2) NOT NULL,
		payment_method varchar(100) NOT NULL,
		status varchar(10) NOT NULL,
		PRIMARY KEY (booking_log_id))";
		$wpdb->query($create_booking_log);
	}
/*Booking Table Creation EOF */

/*Currency Table Creation BOF */
$currency = $wpdb->prefix . "currency";
define('DIR_FS_CSV_PATH',TT_MODULES_FOLDER_PATH.'csv/');
if($wpdb->get_var("SHOW TABLES LIKE \"$currency\"") != $currency) { 
	$create_currency = "CREATE TABLE " . $currency . " (
	  currency_id int(8) NOT NULL AUTO_INCREMENT,
	  currency_name varchar(100) NOT NULL,
	  currency_code varchar(10) NOT NULL,
	  currency_symbol varchar(10) NOT NULL,
	  PRIMARY KEY currency_id (currency_id));";
	$wpdb->query($create_currency);
	$currency_file = DIR_FS_CSV_PATH."currency.csv";
	$currency_handel = fopen($currency_file, 'r');
	$theData = fgets($currency_handel);
	$i = 0;
	while (!feof($currency_handel)) { 
		$currency_data[] = fgets($currency_handel, 1024); 
		$currency_array = explode(",",$currency_data[$i]);
		$insert_currency = "Insert into $currency values('".trim($currency_array[0])."','".trim($currency_array[1])."','".trim($currency_array[2])."','".trim($currency_array[3])."')";
		$wpdb->query($insert_currency);
		$i++;
	}	 
	fclose($currency_handel);
}
/*Currency Table Creation EOF */

/*Country Table Creation BOF */
$country = $wpdb->prefix . "country";
$csv_gen_root = $_SERVER['DOCUMENT_ROOT'];
if($wpdb->get_var("SHOW TABLES LIKE \"$country\"") != $country) {
	$create_country = "CREATE TABLE IF NOT EXISTS $country (
	country_id int(8) NOT NULL AUTO_INCREMENT,
	country varchar(2) NOT NULL,
	title varchar(200) NOT NULL,
	tag int(5) NOT NULL,
	status enum('added','changed') NOT NULL,
	PRIMARY KEY (country_id))";
	$wpdb->query($create_country);
	$country_file = DIR_FS_CSV_PATH."country.csv";
	$country_handel = fopen($country_file, 'r');
	$theData = fgets($country_handel);
	$i = 0;
	while (!feof($country_handel)) { 
		$country_data[] = fgets($country_handel, 1024); 
		$country_array = explode(",",$country_data[$i]);
		$insert_country = "Insert into $country values('".trim($country_array[0])."','".trim($country_array[1])."','".trim($country_array[2])."','".trim($country_array[3])."','".trim($country_array[3])."')";
		$wpdb->query($insert_country);
		$i++;
	}	 
	fclose($country_handel);
}
/*Country Table Creation EOF */

/* Service Table Creation BOF*/
	$service_master = $wpdb->prefix . "service_master";
	if($wpdb->get_var("SHOW TABLES LIKE \"$service_master\"") != $service_master) {
		$create_service = "CREATE TABLE IF NOT EXISTS $service_master (
		service_id int(8) NOT NULL AUTO_INCREMENT,
		service_name varchar(200) NOT NULL,
		service_price int(5) NOT NULL,
		service_status char(1) NOT NULL COMMENT 'E - Enable , D- Disable',
		sortorder int(8) NOT NULL,
		PRIMARY KEY (service_id)) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
		$wpdb->query($create_service);
		$insert_service = "Insert into $service_master values('','Pick Up From Air Port','10','E','1')";
		$insert_service2 = "Insert into $service_master values('','Loundry','5','E','2')";
		$wpdb->query($insert_service);
		$wpdb->query($insert_service2);
	}
/* Service Table Creation EOF*/

add_option("booking_db_version", "2.0");
add_option("booking_security_plugin","5");
add_option("booking_security_settings","14");
update_option("booking_db_version", "2.0");
?>