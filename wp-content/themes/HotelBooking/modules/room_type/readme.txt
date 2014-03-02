**********************************************************
========MANAGE ROOM TYPE MODULE================
**********************************************************

This is the module which will give you the booking_settings management module integrated from wp-admin.

You need to follow steps as mention below to know how to install this module ::-

1)Get the complete folder "room_type".


2)insert the database include line to admin/admin_main.php file. 
It will give you functions available for user at front end of theme.
The php code need to add is :
---------------------------------------------
include_once (TT_ADMIN_FOLDER_PATH . 'room_type/function_room_type.php');
---------------------------------------------


3)You also need to add some code in admin/admin_menu.php file,
to show the hyperlink for "Manage Room Type" from  sidebar.

-->Add the below php code in "templ_add_admin_menu()" function of the admin_menu.php file. This code will call the function "manage_room_type()" which is mention in the next point.
---------------------------------------------
if(file_exists(TT_ADMIN_FOLDER_PATH . 'room_type/admin_manage_room_type.php'))
{
		add_submenu_page('templatic_wp_admin_menu', __("Manage Room Type",'templatic'), __("Manage Room Type",'templatic'), TEMPL_ACCESS_USER, 'manage_room_type', 'manage_room_type');
}
---------------------------------------------

-->also need to add "manage_room_type()" function in the same admin_menu.php file which is called while the link of "Manage Room Type" is clicked.
----------------------------------------------
function manage_room_type()
{
	if($_REQUEST['pagetype']=='addedit')
	{
		include_once(TT_ADMIN_FOLDER_PATH . 'room_type/admin_room_type.php');
	}else
	{
		include_once(TT_ADMIN_FOLDER_PATH . 'room_type/admin_manage_room_type.php');
	}
}
----------------------------------------------


++++++++++++++++++++++++Thank You+++++++++++++++++++++++++++++++++++++