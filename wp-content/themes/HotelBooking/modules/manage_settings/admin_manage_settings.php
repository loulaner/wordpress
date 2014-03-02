<?php
include 'tab_header.php';
?>
<!-- Add /Edit Form For Custom Fields BOF -->
<link rel="stylesheet" href="<?php echo PLUGIN_URL_MANAGE_SETTINGS;?>css/style.css">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo PLUGIN_URL_MANAGE_SETTINGS;?>js/booking_settings.js"></script>
<div class="block" id="global_settings">	
  <?php include( 'admin_global_setting.php' ); ?>
</div>
<div class="block" id="notification">
  <?php include( 'admin_notification.php' ); ?>
</div>
<div class="block" id="email_setups">
  <?php include( 'admin_email_settings.php' ); ?>
</div><div class="block" id="hotel_info">
  <?php include( 'admin_hotel_info.php' ); ?>
</div>
<div class="block" id="currency_setup">	
	<?php if($_GET['mod']=='currency')
	{
		include_once('admin_currency.php');
	} else {
		include( 'admin_manage_currency.php' ); 
	} ?>
</div>
<div class="block" id="option_display_coupon">
	<?php if($_GET['mod']=='coupon')
	{
		include_once('admin_coupon.php');
	} else {
		include('admin_manage_coupon.php' ); 
	} ?>
</div>

<div class="block" id="option_payment">	
<?php if($_GET['payact']=='setting' && $_GET['id']!='')
	{
		include_once('admin_paymethods_add.php');
	} else {
		include( 'admin_paymethods_list.php' ); 
	} ?>
</div>
<?php include TT_ADMIN_TPL_PATH.'footer.php';?>