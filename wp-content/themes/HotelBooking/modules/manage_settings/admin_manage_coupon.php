<?php
global $wpdb;	
if($_REQUEST['pagetype'] == 'deletecoupon' && $_REQUEST['code'] != '')
{
	$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
	$couponinfo = $wpdb->get_results($couponsql);
	if($couponinfo)
	{
		foreach($couponinfo as $couponinfoObj)
		{
			$option_value = unserialize($couponinfoObj->option_value);
			unset($option_value[$_REQUEST['code']]);
			$option_value_str = serialize($option_value);
			$updatestatus = "update $wpdb->options set option_value= '$option_value_str' where option_name='discount_coupons'";
			$wpdb->query($updatestatus);
		}
	}
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#option_display_coupon" method=get name="coupon_success">
	<input type=hidden name="page" value="manage_settings"><input type=hidden name="msg" value="delsuccess"></form>';
	echo '<script>document.coupon_success.submit();</script>';
	exit;
} ?>
<h3><?php _e('Allow coupon option on booking page','templatic');?></h3>
<?php if($_POST['save_allow_coupon_opt'])	{ ?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	<?php _e('Coupon option updated successfully.','templatic'); ?>
	</div>
<?php update_option('is_allow_coupon_code',$_REQUEST['is_allow_coupon_code']);
 }	?>
<form method="post" action="#option_display_coupon" name="allow_coupon_frm">
	<input type="hidden" name="save_allow_coupon_opt" value="1" />
	<input type="radio" name="is_allow_coupon_code" id="is_allow_coupon_code" <?php if(get_option('is_allow_coupon_code')==1){ echo 'checked="checked"';}?>  value="1" />
	<label><?php _e('Yes','templatic');?></label>&nbsp;&nbsp;&nbsp;<input type="radio" name="is_allow_coupon_code" id="is_allow_coupon_code" value="0" <?php if(get_option('is_allow_coupon_code')==0){ echo 'checked="checked"';}?> />
	<label><?php _e('No','templatic');?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="submit" value="Save" class="button-primary" />
</form><br /><br />
 <div class='headerdivh3'>
 	<h3><?php _e('Manage Coupon','templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_settings&mod=coupon#option_display_coupon';?>" title="<?php _e('Add New Coupon','templatic');?>" name="btnviewlisting" class="button-primary" /><?php _e('Add New Coupon','templatic'); ?></a></div>
   <p><img src="<?php echo PLUGIN_URL_MANAGE_SETTINGS;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Add/Edit/Delete Coupon codes from here. Click on "Add New Coupon" to add a new coupon code','templatic');?></p>
</div>
<?php if($_REQUEST['msg']=='success'){?><br />
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	 <?php if($_REQUEST['msg_type'] == 'update'){
	 	 _e('Coupon updated successfully.','templatic'); } else{
		 _e('Coupon created successfully.','templatic');
		 }?>
	</div>
<?php }?>
<?php if($_REQUEST['msg']=='delsuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
  <?php _e('Coupon deleted successfully.','templatic'); ?>
	</div>
<?php }?>	
<table width="100%" cellpadding="5" class="widefat post fixed" >
	<thead>						
		<tr>
		  <th align="left"><strong><?php _e('Coupon Code','templatic'); ?></strong></th>
		  <th align="left"><strong><?php _e('Discount Type','templatic'); ?></strong></th>
		  <th align="left"><strong><?php _e('Discount Amount','templatic'); ?></strong></th>
		  <th align="left" width="50"><strong><?php _e('Action','templatic'); ?></strong></th>
		</tr>
		<?php
		$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
		$couponinfo = $wpdb->get_results($couponsql);
		if($couponinfo)
		{
		foreach($couponinfo as $couponinfoObj)
		{
			$option_value = unserialize($couponinfoObj->option_value);
			foreach($option_value as $key=>$value)
			{
		?>
		<tr>
		  <td><?php echo $value['couponcode'];?></td>
		  <td><?php echo $value['dis_per'];?></td>
		  <td><?php echo $value['dis_amt'];?></td>
		  <td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_settings&mod=coupon&code='.$key.'&#option_display_coupon';?>" title="Edit Coupon"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Coupon','templatic');?>" border="0" /></a> &nbsp;&nbsp;<a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_settings&pagetype=deletecoupon&code='.$key;?>" title="Delete Coupon" onclick="return confirmSubmit();"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Coupon','templatic');?>" border="0" /></a></td>
		</tr>
<?php		}
		}
	}
?>
	</thead>					
</table>
<div class="legend">
<h4 class="legend">图例：</h4>
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Coupon','templatic');?>" border="0" /></label> 编辑优惠券<br />
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Coupon','templatic');?>" border="0" /></label> 删除优惠券<br />
</div>