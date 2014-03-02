<?php
define('TEMPL_MANAGE_SETTINGS_MODULE', __("Booking Settings",'templatic'));
define('TEMPL_MANAGE_SETTINGS_CURRENT_VERSION', '1.0.0');
define('TEMPL_MANAGE_SETTINGS_LOG_PATH','http://templatic.com/updates/modules/manage_settings/manage_settings_change_log.txt');
define('TEMPL_MANAGE_SETTINGS_ZIP_FOLDER_PATH','http://templatic.com/updates/modules/manage_settings/manage_settings.zip');
define('TT_MANAGE_SETTINGS_FOLDER','manage_settings');
define('TT_MANAGE_SETTINGS_MODULES_PATH',TT_MODULES_FOLDER_PATH . TT_MANAGE_SETTINGS_FOLDER.'/');
define ("PLUGIN_DIR_MANAGE_SETTINGS", basename(dirname(__FILE__)));
define ("PLUGIN_URL_MANAGE_SETTINGS", get_template_directory_uri().'/modules/'.PLUGIN_DIR_MANAGE_SETTINGS.'/');
//----------------------------------------------
     //MODULE AUTO UPDATE START//
//----------------------------------------------
add_action('templ_module_auto_update','templ_module_auto_update_manage_settings_fun');
global $wpdb;
function templ_module_auto_update_manage_settings_fun()
{
	$curversion = TEMPL_MANAGE_SETTINGS_CURRENT_VERSION;
	$liveversion = tmpl_current_framework_version(TEMPL_MANAGE_SETTINGS_LOG_PATH);
	$is_update = templ_is_updated( $curversion, $liveversion);
	if($is_update)
	{
?>
<table border="0" cellpadding="0" cellspacing="0" style="border:0px; padding:10px 0px;">
	<tr>
		<td class="module"><h3><?php echo TEMPL_MANAGE_SETTINGS_MODULE;?></h3></td>
	</tr>
	<tr>
		<td>
			<form method="post"  name="framework_update" id="framework_update">
			<input type="hidden" name="action" value="<?php echo TT_MANAGE_SETTINGS_FOLDER;?>" />
			<input type="hidden" name="zip" value="<?php echo TEMPL_MANAGE_SETTINGS_ZIP_FOLDER_PATH;?>" />
			<input type="hidden" name="log" value="<?php echo TEMPL_MANAGE_SETTINGS_LOG_PATH;?>" />
			<input type="hidden" name="path" value="<?php echo TT_MANAGE_SETTINGS_MODULES_PATH;?>" />
			<?php wp_nonce_field('update-options'); ?>

			<?php echo sprintf(__('<h4>A new version of Manage Global settings Module is available.</h4>
			<p>This updater will collect a file from the templatic.com server. It will download and extract the files to your current theme&prime;s functions folder. 
			<br />We recommend backing up your theme files before updating. Only upgrade related module files if necessary.
			<br />If you are facing any problem in auto updating the framework, then please download the latest version of the theme from members area and then just overwrite the "<b>%s</b>" folder.
			<br /><br />&rArr; Your version: %s
			<br />&rArr; Current Version: %s </p>','templatic'),TT_MANAGE_SETTINGS_MODULES_PATH,$curversion,$liveversion);?>

			<input type="submit" class="button" value="<?php _e('Update','templatic');?>" onclick="document.getElementById('framework_upgrade_process_span_id').style.display=''" />
			</form>
		</td>
	</tr>
	<tr>
		<td style="border-bottom:5px solid #dedede;">&nbsp;</td>
	</tr>
</table>
<?php
	}
}
//----------------------------------------------
     //MODULE AUTO UPDATE END//
//----------------------------------------------


/////////admin menu settings start////////////////
add_action('templ_admin_menu', 'manage_settings_add_admin_menu');
function manage_settings_add_admin_menu()
{
	
	add_submenu_page('templatic_wp_admin_menu', TEMPL_MANAGE_SETTINGS_MODULE,TEMPL_MANAGE_SETTINGS_MODULE,TEMPL_ACCESS_USER, 'manage_settings', 'manage_settings');
}

function manage_settings()
{
	global $templ_module_path;
		include_once($templ_module_path . 'admin_manage_settings.php');

}
function allow_nt_allow($field_value = ''){
	$y_n_array = array("Y"=>"Yes","N"=>"No");
	$y_n_display = '';
	foreach($y_n_array as $ykey => $yvalue){
		if($ykey == $field_value){
			$yselect = "selected";
		} else {
			$yselect = "";
		}
		$y_n_display .= '<option value="'.$ykey.'" '.$yselect.'>'.$yvalue.'</option>';
	}
	return $y_n_display;
}
function enable_disable($field_value = ''){
	$e_d_array = array("E"=>"Enable","D"=>"Disable");
	$e_d_display = '';
	foreach($e_d_array as $edkey => $edvalue){
		if($edkey == $field_value){
			$edselect = "selected";
		} else {
			$edselect = "";
		}
		$e_d_display .= '<option value="'.$edkey.'" '.$edselect.'>'.$edvalue.'</option>';
	}
	return $e_d_display;
}function tax_type_cmb($tax_type = ''){
	$tax_array = array("exact_amount"=>"Exact Amount","percent"=>"Percent (%)");
	$tax_display = '';
	foreach($tax_array as $tkey => $tvalue){
		if($tkey == $tax_type){
			$tselect = "selected";
		} else {
			$tselect = "";
		}
		$tax_display .= '<option value="'.$tkey.'" '.$tselect.'>'.$tvalue.'</option>';
	}
	return $tax_display;
} function position_cmb($position = ''){
	$position_array = array("1"=>"Symbol Before amount","2"=>"Space between Before amount and Symbol","3"=>"Symbol After amount","4"=>"Space between After amount and Symbol");
	$position_display = '';
	foreach($position_array as $pkey => $pvalue){
		if($pkey == $position){
			$pselect = "selected";
		} else {
			$pselect = "";
		}
		$position_display .= '<option value="'.$pkey.'" '.$pselect.'>'.$pvalue.'</option>';
	}
	return $position_display;
} function currency_cmb($currency_value = ''){
	global $wpdb;
	$currency_table = $wpdb->prefix . "currency";
	$curreny_sql = mysql_query("select * from $currency_table order by currency_name");
	$currency_display = '';
	$currency_select = "";
	while($currency_res = mysql_fetch_array($curreny_sql)){
		if($currency_res['currency_code'] == $currency_value){
			$currency_select = "selected";
		} else {
			$currency_select = "";
		}
		$currency_display .= '<option value="'.$currency_res['currency_code'].'" '.$currency_select.'>'.$currency_res['currency_name'].'</option>';
	}
	return $currency_display;
}
/* Function For Select Box EOF */
/*payment Method Settings */
function templ_payment_option_radio()
{
	do_action('templ_payment_option_radio');	
}
					 
add_action('templ_payment_option_radio','templ_payment_option_radio_fun');
function templ_payment_option_radio_fun()
{
	global $wpdb;
	$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_%' order by option_id";
	$paymentinfo = $wpdb->get_results($paymentsql);
	if($paymentinfo)
	{
	?>
	<h3> <?php echo SELECT_PAY_MEHTOD_TEXT; ?></h3>
	<ul class="payment_method">
	<?php
		$paymentOptionArray = array();
		$paymethodKeyarray = array();
		foreach($paymentinfo as $paymentinfoObj)
		{
			$paymentInfo = unserialize($paymentinfoObj->option_value);
			if($paymentInfo['isactive'])
			{
				$paymethodKeyarray[] = $paymentInfo['key'];
				$paymentOptionArray[$paymentInfo['display_order']][] = $paymentInfo;
			}
		}
		ksort($paymentOptionArray);
		$array_pay_options = array();
		if($paymentOptionArray)
		{
			foreach($paymentOptionArray as $key=>$paymentInfoval)
			{
				for($i=0;$i<count($paymentInfoval);$i++)
				{
					$paymentInfo = $paymentInfoval[$i];
					$jsfunction = 'onclick="showoptions(this.value);"';
					$chked = '';
					if($key==1)
					{
						$chked = 'checked="checked"';
					}
				?>
	<li id="<?php echo $paymentInfo['key'];?>"><label>
	  <input <?php echo $jsfunction;?>  type="radio" value="<?php echo $paymentInfo['key'];?>" id="<?php echo $paymentInfo['key'];?>_id" name="paymentmethod" <?php echo $chked;?> />  <?php echo $paymentInfo['name']?></label></li>
	 
	  <?php
					if(file_exists(TEMPLATEPATH.'/library/includes/payment/'.$paymentInfo['key'].'/'.$paymentInfo['key'].'.php'))
					{
					?>
	  <?php
						$array_pay_options[] =TEMPLATEPATH.'/library/includes/payment/'.$paymentInfo['key'].'/'.$paymentInfo['key'].'.php';
						?>
	  <?php
					} 
				 ?> 
	  <?php
				}
			}
		}else
		{
		?>
		<li><?php echo NO_PAYMENT_METHOD_MSG;?></li>
		<?php
		}
		
	?>
	
	</ul>
    <?php
    if($array_pay_options)
	{
		for($i=0;$i<count($array_pay_options);$i++)	
		{
			include_once($array_pay_options[$i]);	
		}
	}
	?>
    <script type="text/javascript">
    function showoptions(paymethod)
    {
    <?php
    for($i=0;$i<count($paymethodKeyarray);$i++)
    {
    ?>
    showoptvar = '<?php echo $paymethodKeyarray[$i]?>options';
    if(eval(document.getElementById(showoptvar)))
    {
    document.getElementById(showoptvar).style.display = 'none';
    if(paymethod=='<?php echo $paymethodKeyarray[$i]?>')
    {
    document.getElementById(showoptvar).style.display = '';
    }
    }
    <?php
    }
    ?>
    }
    <?php
    for($i=0;$i<count($paymethodKeyarray);$i++)
    {
    ?>
    if(document.getElementById('<?php echo $paymethodKeyarray[$i];?>_id').checked)
    {
    showoptions(document.getElementById('<?php echo $paymethodKeyarray[$i];?>_id').value);
    }
    <?php
    }	
    ?>
    </script>
	<?php
	}	
}

function templ_nopayment_redirect()
{
	if(apply_filters('templ_skip_payment_method','0'))
	{
	}else
	{
		wp_redirect(apply_filters('templ_nopayment_redirect_url',site_url('/?ptype=submition&backandedit=1&emsg=nopaymethod')));	
		exit;
	}
}

add_filter('templ_submit_form_emsg_filter','templ_submit_form_emsg_payment');
function templ_submit_form_emsg_payment($msg)
{
	if($_REQUEST['emsg']=='nopaymethod')
	{
		return $msg.=__('Please select payment method on preview page.','templatic');
	}
}
/* Payment Method EOF */
/* Coupon BOF */

function get_payable_amount_with_coupon($total_amt,$coupon_code)
{
	$discount_amt = 0;
	if(function_exists('get_discount_amount'))
	{
		$discount_amt = get_discount_amount($coupon_code,$total_amt);	
	}	
	if($discount_amt>0)
	{
		return $total_amt-$discount_amt;
	}else
	{
		return $total_amt;
	}
}

function get_discount_amount($coupon,$amount)
{
	global $wpdb;
	if($coupon!='' && $amount>0)
	{
		$couponinfo = templ_get_coupon_info($coupon);
		
		if($couponinfo['dis_per']=='per')
		{
			$discount_amt = ($amount*$couponinfo['dis_amt'])/100;
		}else
		if($couponinfo['dis_per']=='amt')
		{
			$discount_amt = $couponinfo['dis_amt'];
		}
		return apply_filters('templ_discount_amount_filter',$discount_amt);		
	}
	return '0';			
}
function get_coupon_amount($coupon,$amount)
{
	global $wpdb;
	if($coupon!='' && $amount>0)
	{
		$couponinfo = templ_get_coupon_info($coupon);
		
		if($couponinfo['dis_per']=='per')
		{
			$discount_amt = ($amount*$couponinfo['dis_amt'])/100;
		}else
		if($couponinfo['dis_per']=='amt')
		{
			$discount_amt = $couponinfo['dis_amt'];
		}
		return apply_filters('templ_discount_amount_filter',$discount_amt);		
	}
	return '0';			
}

function templ_get_coupon_info($coupon)
{
	if($coupon!='')
	{
		$couponinfo = get_option('discount_coupons');
		if($couponinfo)
		{
			foreach($couponinfo as $key=>$value)
			{
				if($value['couponcode'] == $coupon)
				{
					return $value;
				}
			}
		}
	}
	return false;
}

add_filter('templ_submit_form_emsg_filter','templ_submit_form_emsg_fun');
function templ_submit_form_emsg_fun($msg)
{
	if($_REQUEST['emsg']=='invalid_coupon')
	{
		return $msg.=__('Invalid coupon','templatic');
	}
}
/* Coupon EOF */

?>