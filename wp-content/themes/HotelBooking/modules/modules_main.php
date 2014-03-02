<?php
if(file_exists(TT_MODULES_FOLDER_PATH . 'db_table_creation.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'db_table_creation.php');
	
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'custom_post_type/custom_post_type_lang.php'))
{
	include_once(TT_MODULES_FOLDER_PATH.'custom_post_type/custom_post_type_lang.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'custom_post_type/custom_post_type.php'))
{
	include_once(TT_MODULES_FOLDER_PATH.'custom_post_type/custom_post_type.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'package/db_package.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'package/db_package.php');
}

if(is_wp_admin() && file_exists(TT_MODULES_FOLDER_PATH . 'notifications/notification_functions.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'notifications/notification_functions.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'manage_city/city_functions.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'manage_city/city_functions.php');
}

if(is_wp_admin() && file_exists(TT_MODULES_FOLDER_PATH . 'bulk_upload/bulk_upload_function.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'bulk_upload/bulk_upload_function.php');
}

/*if(file_exists(TT_MODULES_FOLDER_PATH . 'manage_custom_fields/db_mange_custom_fields.php'))
{
	include_once(TT_MODULES_FOLDER_PATH . 'manage_custom_fields/db_mange_custom_fields.php');
}*/

/*if(file_exists(TT_MODULES_FOLDER_PATH . 'booking_settings/function_booking_settings.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'booking_settings/function_booking_settings.php');
}*/
if(file_exists(TT_MODULES_FOLDER_PATH . 'manage_settings/function_manage_settings.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'manage_settings/function_manage_settings.php');
}
if(file_exists(TT_MODULES_FOLDER_PATH . 'room_type/function_room_type.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'room_type/function_room_type.php');
	
}if(file_exists(TT_MODULES_FOLDER_PATH . 'reservation/function_reservation.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'reservation/function_reservation.php');
}if(file_exists(TT_MODULES_FOLDER_PATH . 'user_booking/user_booking_main.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'user_booking/user_booking_main.php');
}
if(file_exists(TT_MODULES_FOLDER_PATH . 'basic_settings.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'basic_settings.php');
	
}

?>