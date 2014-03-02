<?php
global $wpdb;
if($_POST['couponact'] == 'addcoupon')
{
	$couponcode = $_POST['couponcode'];
	$coupondisc = $_POST['coupondisc'];
	$couponamt = $_POST['couponamt'];
	if($couponcode)
	{
		$discount_coupons['couponcode'] = $couponcode;
		$discount_coupons['dis_per'] = $coupondisc;
		$discount_coupons['dis_amt'] = $couponamt;
		
		$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
		$couponinfo = $wpdb->get_results($couponsql);
		if($couponinfo)
		{
			foreach($couponinfo as $couponinfoObj)
			{
				$option_value = unserialize($couponinfoObj->option_value);
			}
			if($_POST['code'] != '')
			{
				$option_value[$_POST['code']]  = $discount_coupons;
			}else
			{
				for($i=0;$i<count($option_value);$i++)
				{
					if($option_value[$i]['couponcode'] == $couponcode)
					{
						echo $location = site_url()."/wp-admin/admin.php";
						echo '<form action="'.$location.'#option_add_coupon" method=get name="coupon_success">
						<input type=hidden name="page" value="manage_settings"><input type=hidden name="msg" value="exist"></form>';
						echo '<script>document.coupon_success.submit();</script>';
						//wp_redirect($location);
						exit;
					}
				}
				$option_value[count($option_value)]  = $discount_coupons;
			}			
			$option_value_str = serialize($option_value);
			$updatestatus = "update $wpdb->options set option_value= '$option_value_str' where option_name='discount_coupons'";
			$wpdb->query($updatestatus);
			$msg_type = 'update';
		}else		{
			$option_value[] = $discount_coupons;
			$option_value_str = serialize($option_value);
			$insertcoupon = "insert into $wpdb->options (option_name,option_value) values ('discount_coupons','$option_value_str')";
			$wpdb->query($insertcoupon);
			$msg_type = 'create';
		}
		$location = site_url()."/wp-admin/admin.php";
		echo '<form action="'.$location.'#option_display_coupon" method=get name="coupon_success">
		<input type=hidden name="page" value="manage_settings"><input type=hidden name="msg" value="success"><input type=hidden name="msg_type" value="'.$msg_type.'"></form>';
		echo '<script>document.coupon_success.submit();</script>';
		//wp_redirect($location);
		exit;
	}
}
if($_REQUEST['code']!='')
{
	$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
	$couponinfo = $wpdb->get_results($couponsql);
	if($couponinfo)
	{
		foreach($couponinfo as $couponinfoObj)
		{
			$option_value = unserialize($couponinfoObj->option_value);
		}
		$coupon = $option_value[$_REQUEST['code']];
	}	
	$coupon_title = 'Edit Coupon Detail';
	$coupon_msg = 'Here you can edit coupon detail.';
	
} else {
	$coupon_title = 'Add New Coupon';
	$coupon_msg = 'Here you can add a new coupon.';
}
?>
 <div class='headerdivh3'>
	<h3><?php _e($coupon_title,'templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_settings#option_display_coupon" name="btnviewlisting" class="button-primary" title="<?php _e('Back to Coupon List','templatic');?>"/><?php _e('&laquo; Back to Coupon List','templatic'); ?></a></div>
     <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e($coupon_msg,'templatic');?></p>
</div>
<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_settings&mod=coupon&pagetype=addedit&code=<?php echo $_REQUEST['code'];?>" method="post" name="coupon_frm">
	<input type="hidden" name="couponact" value="addcoupon">
	<input type="hidden" name="code" value="<?php echo $_REQUEST['code'];?>">
	<?php if($_REQUEST['msg']=='exist'){?>
		<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
			<?php _e('Coupon code already exists, Please use different one.','templatic');?></p>
		</div>
	<?php }?>
	<table cellspacing="2" cellpadding="4" border="0" width="100%" class="widefat post fixed">
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Coupon Code : ','templatic');?></label></td>
		<td align="left" valign="top" ><input type="text" name="couponcode" id="couponcode" value="<?php echo $coupon['couponcode']?>"><p><?php _e('Enter Coupon code','templatic');?></p>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Discount Type : ','templatic');?></label></td>
		<td align="left" valign="top" ><input type="radio" id="coupondiscper" name="coupondisc" value="per" <?php if($coupon['dis_per'] == 'per' || $coupon['dis_per']==''){?>checked="checked"<?php }?> /><label><?php _e('Percentage','templatic');?>(%)</label><br /><input type="radio" id="coupondiscamt" name="coupondisc" <?php if($coupon['dis_per'] == 'amt'){?> checked="checked"<?php }?> value="amt" /><label><?php _e('Amount','templatic');?></label><br /><br /><p><?php _e('Select Discount Type','templatic');?></p></td>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Discount amount : ','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="couponamt" id="couponamt" value="<?php echo $coupon['dis_amt']?>"><p><?php _e('Enter Discount Amount','templatic');?></p></td>
	</tr>
	<tr>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top"><input type="submit" name="submit" value="<?php _e('Submit','templatic');?>" class="button-framework-imp" onclick="return check_frm();"></td>
	</tr>
	
</table>	
		
</form>
<script>
function check_frm()
{
	if(document.getElementById('coupondiscper').checked)
	{
		if(document.getElementById('couponamt').value > 100)
		{
			alert("<?php _e('Percentage should be less than or equal to 100','templatic');?>");
			return false;
		}
	}
	if(document.getElementById('couponcode').value=='')
	{
		alert("<?php _e('Please Enter Coupon Code','templatic');?>");
		return false;
	}
	return true;
}
</script>
