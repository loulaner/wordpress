**********************************************************
========MANAGE RESERVATION MODULE================
**********************************************************

This is the module which will give you the booking_settings management module integrated from wp-admin.

You need to follow steps as mention below to know how to install this module ::-

1)Get the complete folder "reservation".


2)insert the database include line to admin/admin_main.php file. 
It will give you functions available for user at front end of theme.
The php code need to add is :
---------------------------------------------
include_once (TT_ADMIN_FOLDER_PATH . 'reservation/function_reservation.php');
---------------------------------------------


3)You also need to add some code in admin/admin_menu.php file,
to show the hyperlink for "Booking log" from  sidebar.

-->Add the below php code in "templ_add_admin_menu()" function of the admin_menu.php file. This code will call the function "manage_reservation()" which is mention in the next point.
---------------------------------------------
if(file_exists(TT_ADMIN_FOLDER_PATH . 'reservation/admin_manage_reservation.php'))
{
		add_submenu_page('templatic_wp_admin_menu', __("Booking log",'templatic'), __("Booking log",'templatic'), TEMPL_ACCESS_USER, 'manage_reservation', 'manage_reservation');
}
---------------------------------------------

-->also need to add "manage_reservation()" function in the same admin_menu.php file which is called while the link of "Booking log" is clicked.
----------------------------------------------
function manage_reservation()
{
	if($_REQUEST['pagetype']=='addedit')
	{
		include_once(TT_ADMIN_FOLDER_PATH . 'reservation/admin_reservation.php');
	}else
	{
		include_once(TT_ADMIN_FOLDER_PATH . 'reservation/admin_manage_reservation.php');
	}
}
----------------------------------------------


++++++++++++++++++++++++Thank You+++++++++++++++++++++++++++++++++++++