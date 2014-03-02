<?php
global $wpdb;
$currency_table = $wpdb->prefix . "currency";	
if($_REQUEST['pagetype'] == 'deletecuurency' && $_REQUEST['currency_id'] != '')
{
	$wpdb->query("DELETE from $currency_table where currency_id = '".$_REQUEST['currency_id']."'");
	$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#currency_setup" method=get name="currency_success">
	<input type=hidden name="page" value="manage_settings"><input type=hidden name="currencymsg" value="delsuccess"></form>';
	echo '<script>document.currency_success.submit();</script>';
	exit;
}
?>
 <div class='headerdivh3'>
	<h3><?php _e('Manage Currency','templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_settings&mod=currency#currency_setup';?>" title="<?php _e('Add New Currency','templatic');?>" name="btnviewlisting" class="button-primary" /><?php _e('Add New Currency','templatic'); ?></a></div>
   <p><img src="<?php echo PLUGIN_URL_MANAGE_SETTINGS;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Here you can edit,delete and manage currency values.','templatic');?></p>
</div>
<?php if($_REQUEST['currencymsg']=='success'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
		<?php if($_REQUEST['msgtype'] == 'add'){
				_e('Currency inserted successfully.','templatic');
			} else {
				_e('Currency updated successfully.','templatic');
		}?>
	</div>
	<?php }?>
	<?php if($_REQUEST['currencymsg']=='delsuccess'){?>
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Currency deleted successfully.','templatic'); ?>
	</div>
	<?php }?>	
	<table width="100%" cellpadding="5" class="widefat post fixed" >
		<thead>						
		<tr>
			<th align="left"><strong><?php _e('ID','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Currency','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Code','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Symbol','templatic'); ?></strong></th>
			<th align="left" width="50"><strong><?php _e('Action','templatic'); ?></strong></th>						 
		</tr>
		<?php
		$currency_table = $wpdb->prefix . "currency";
		$currency_sql = mysql_query("select * from $currency_table");
		while($currency_data = mysql_fetch_array($currency_sql))	{?>
		<tr>
			<td><?php echo $currency_data['currency_id'];?></td>
			<td><?php echo $currency_data['currency_name'];?></td>
			<td><?php echo $currency_data['currency_code'];?></td>
			<td><?php echo $currency_data['currency_symbol'];?></td>
			<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_settings&mod=currency&currency_id='.$currency_data['currency_id'].'#currency_setup';?>" title="<?php _e('Edit Currency','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Currency','templatic');?>" border="0" /></a>&nbsp;&nbsp;<a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_settings&pagetype=deletecuurency&currency_id='.$currency_data['currency_id'];?>#currency_setup" onclick="return confirmSubmit();" title="<?php _e('Delete Currency','templatic');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Currency','templatic');?>" border="0" /></a></td>
		</tr>
		<?php 	}	?>
	</thead>					
	</table>
<div class="legend">
<h4 class="legend">图例：</h4>
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e('Edit Currency','templatic');?>" border="0" /></label> 编辑货币<br />
<label class="imglabel" style="cursor:default"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png" alt="<?php _e('Delete Currency','templatic');?>" border="0" /></label> 删除货币<br />
</div>