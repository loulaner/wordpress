<?php 
global $wpdb;
$currency_table = $wpdb->prefix . "currency";
/* Update Query BOF */
if(isset($_GET['pagetype']) && $_GET['pagetype'] == 'update_currency'){
	if($_REQUEST['currency_id'] == '') {
		$insert_currency = "insert into $currency_table(currency_id,currency_name,currency_code,currency_symbol) values(null,'".$_POST['currency_name']."','".$_POST['currency_code']."','".$_POST['currency_symbol']."')";
		$wpdb->query($insert_currency);
		$msgtype = 'add';
	} else {
		$update_currency = "update $currency_table set currency_name = '".$_POST['currency_name']."',currency_code = '".$_POST['currency_code']."',currency_symbol = '".$_POST['currency_symbol']."' where currency_id = '".$_POST['currency_id']."'" ;
		$wpdb->query($update_currency);
		$msgtype = 'edit';
	}
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#currency_setup" method=get name="currency_success">
	<input type=hidden name="page" value="manage_settings"><input type=hidden name="currencymsg" value="success"><input type=hidden name="msgtype" value="'.$msgtype.'"></form>';
	echo '<script>document.currency_success.submit();</script>';
	exit;
}	
/* Update Query EOF */
if(isset($_REQUEST['currency_id']) && $_REQUEST['currency_id'] != ''){
	$fetch_currency_sql = mysql_query("select * from $currency_table where currency_id = '".$_REQUEST['currency_id']."'");
	$fetch_currency_res = mysql_fetch_array($fetch_currency_sql);
	$currency_title = 'Edit Currency Detail';
} else {
	$currency_title = 'Add New Currency';
}
?>
<div class='headerdivh3'>
	<h3><?php _e($currency_title,'templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manage_settings#currency_setup" name="btnviewlisting" class="button-primary" title="<?php _e('Back to Currency List','templatic');?>"/><?php _e('&laquo; Back to Currency List','templatic'); ?></a></div>
    <p><img src="<?php echo PLUGIN_URL_MANAGE_SETTINGS;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Give the details about the currency you wish to use.','templatic');?></p>
</div>
<form name="frm_settings" id="frm_settings" action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_settings&&mod=currency&pagetype=update_currency" method="post" onsubmit="return currency_validation();">
<input type="hidden" name="currency_id" id="currency_id" value="<?php echo $fetch_currency_res['currency_id'];?>">
<table cellspacing="2" cellpadding="4" border="0" width="100%" class="widefat post fixed">
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Currency Name','templatic');?> </label></td>
		<td align="left" valign="top"><input type="text" name="currency_name" id="currency_name" value="<?php echo $fetch_currency_res['currency_name'];?>" style="width:200px;"></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Currency Code','templatic');?></label></label></td>
		<td align="left" valign="top"><input type="text" name="currency_code" id="currency_code" value="<?php echo $fetch_currency_res['currency_code'];?>" style="width:200px;"><label class="desc_lbl"><?php _e('(USD, GBP, etc.)','templatic');?></label></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="250px;"><label class="setting_lbl"><?php _e('Currency Symbol','templatic');?></label></td>
		<td align="left" valign="top"><input type="text" name="currency_symbol" id="currency_symbol" style="width:200px;" value="<?php echo $fetch_currency_res['currency_symbol'];?>"><label class="desc_lbl">(<?php _e('$, &euro;, etc.)','templatic');?></label></td>
	</tr>
	<tr>
			<td align="left" valign="top">&nbsp;</td>
			<td align="left" valign="top"><input type="submit" name="submit" value="<?php _e('Submit','templatic');?>" class="button-framework-imp"></td>
	</tr>
</table>

</form>