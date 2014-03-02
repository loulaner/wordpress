<?php 
global $wpdb;

if($_GET['status']!='' && $_GET['id']!='')
{
	$paymentupdsql = "select option_value from $wpdb->options where option_id='".$_GET['id']."'";
	$paymentupdinfo = $wpdb->get_results($paymentupdsql);
	if($paymentupdinfo)
	{
		foreach($paymentupdinfo as $paymentupdinfoObj)
		{
			$option_value = unserialize($paymentupdinfoObj->option_value);
			$option_value['isactive'] = $_GET['status'];
			$option_value_str = serialize($option_value);
			$message = "Status Updated Successfully.";
		}
	}
	
	$updatestatus = "update $wpdb->options set option_value= '$option_value_str' where option_id='".$_GET['id']."'";
	$wpdb->query($updatestatus);
}



//////////pay settings start////////
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	__("Merchant Id",'templatic'),
					"fieldname"		=>	"merchantid",
					"value"			=>	"myaccount@paypal.com",
					"description"	=>	__("Example : myaccount@paypal.com",'templatic'),
					);
	$payOpts[] = array(
					"title"			=>	__("Cancel Url",'templatic'),
					"fieldname"		=>	"cancel_return",
					"value"			=>	site_url("/?ptype=cancel_return&pmethod=paypal"),
					"description"	=>	sprintf(__("Example : %s",'templatic'),site_url("/?ptype=cancel_return&pmethod=paypal")),
					);
	$payOpts[] = array(
					"title"			=>	__("Return Url",'templatic'),
					"fieldname"		=>	"returnUrl",
					"value"			=>	site_url("/?ptype=return&pmethod=paypal"),
					"description"	=>	sprintf(__("Example : %s",'templatic'),site_url("/?ptype=return&pmethod=paypal")),
					);
	$payOpts[] = array(
					"title"			=>	__("Notify Url",'templatic'),
					"fieldname"		=>	"notify_url",
					"value"			=>	site_url("/?ptype=notifyurl&pmethod=paypal"),
					"description"	=>	sprintf(__("Example : %s",'templatic'),site_url("/?ptype=notifyurl&pmethod=paypal")),
					);
								
	$paymethodinfo[] = array(
						"name" 		=> __('Paypal','templatic'),
						"key" 		=> 'paypal',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'1',
						"payOpts"	=>	$payOpts,
						);
	//////////pay settings end////////
	
	//////////google checkout start////////
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	__("Merchant Id",'templatic'),
					"fieldname"		=>	"merchantid",
					"value"			=>	"1234567890",
					"description"	=>	__("示例 : 1234567890",'templatic')
					);
												
	$paymethodinfo[] = array(
						"name" 		=> __('Google Checkout','templatic'),
						"key" 		=> 'googlechkout',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'2',
						"payOpts"	=>	$payOpts,
						);

//////////google checkout end////////
//////////authorize.net start////////

$payOpts = array();
	$payOpts[] = array(
					"title"			=>	__("Login ID",'templatic'),
					"fieldname"		=>	"loginid",
					"value"			=>	"yourname@domain.com",
					"description"	=>	__("Example : yourname@domain.com",'templatic')
					);
	$payOpts[] = array(
					"title"			=>	__("Transaction Key",'templatic'),
					"fieldname"		=>	"transkey",
					"value"			=>	"1234567890",
					"description"	=>	__("Example : 1234567890",'templatic'),
					);
					
	$paymethodinfo[] = array(
						"name" 		=> __('Authorize.net','templatic'),
						"key" 		=> 'authorizenet',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'3',
						"payOpts"	=>	$payOpts,
						);

//////////authorize.net end////////
//////////worldpay start////////

	$payOpts = array();	
	$payOpts[] = array(
					"title"			=>	__("Instant Id",'templatic'),
					"fieldname"		=>	"instId",
					"value"			=>	"123456",
					"description"	=>	__("Example : 123456",'templatic')
					);
	$payOpts[] = array(
					"title"			=>	__("Account Id",'templatic'),
					"fieldname"		=>	"accId1",
					"value"			=>	"12345",
					"description"	=>	__("Example : 12345",'templatic')
					);
											
	$paymethodinfo[] = array(
						"name" 		=> __('Worldpay','templatic'),
						"key" 		=> 'worldpay',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'4',
						"payOpts"	=>	$payOpts,
						);
//////////worldpay end////////
//////////2co start////////

	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	__("Vendor ID",'templatic'),
					"fieldname"		=>	"vendorid",
					"value"			=>	"1303908",
					"description"	=>	__("Enter Vendor ID Example : 1303908",'templatic')
					);
	$payOpts[] = array(
					"title"			=>	__("Notify Url",'templatic'),
					"fieldname"		=>	"ipnfilepath",
					"value"			=>	site_url("/?ptype=notifyurl&pmethod=2co"),
					"description"	=>	sprintf(__("Example : %s",'templatic'),site_url("/?ptype=notifyurl&pmethod=2co")),
					);
					
	$paymethodinfo[] = array(
						"name" 		=> __('2CO (2Checkout)','templatic'),
						"key" 		=> '2co',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'5',
						"payOpts"	=>	$payOpts,
						);
	
								
//////////2co end////////
//////////pre bank transfer start////////

	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	__("Bank Information",'templatic'),
					"fieldname"		=>	"bankinfo",
					"value"			=>	"ICICI Bank",
					"description"	=>	__("Enter the bank name to which you want to transfer payment",'templatic')
					);
	$payOpts[] = array(
					"title"			=>	__("Account ID",'templatic'),
					"fieldname"		=>	"bank_accountid",
					"value"			=>	"AB1234567890",
					"description"	=>	__("Enter your bank Account ID",'templatic'),
					);
					
	$paymethodinfo[] = array(
						"name" 		=> __('Pre Bank Transfer','templatic'),
						"key" 		=> 'prebanktransfer',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'6',
						"payOpts"	=>	$payOpts,
						);
											
//////////pre bank transfer end////////
//////////pay cash on devivery start////////
	$payOpts = array();
	$paymethodinfo[] = array(
						"name" 		=> __('Pay Cash On Arrival','templatic'),
						"key" 		=> 'payondelevary',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'7',
						"payOpts"	=>	$payOpts,
						);

//////////pay cash on devivery end////////
///////////////////////////////////////
for($i=0;$i<count($paymethodinfo);$i++)
{
	$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_".$paymethodinfo[$i]['key']."' order by option_id asc";
	$paymentinfo = $wpdb->get_results($paymentsql);
	if(count($paymentinfo)==0)
	{
		$paymethodArray = array(
						"option_name"	=>	'payment_method_'.$paymethodinfo[$i]['key'],
						"option_value"	=>	serialize($paymethodinfo[$i]),
						);
		$wpdb->insert( $wpdb->options, $paymethodArray );
	}
}

$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_%'";
$paymentinfo = $wpdb->get_results($paymentsql);
?>
<h3><?php _e('Manage Payment Option','templatic');?></h3>
<?php if($message){?>
<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
  <?php echo $message;?>
</div>
<?php }?>
<table style=" width:50%"  class="widefat post fixed" >
  <thead>
    <tr>
      <th width="180"><strong><?php _e('Method Name','templatic');?></strong></th>
      <th width="85"><strong><?php _e('Is Active','templatic');?></strong></th>
      <th width="85" align="center"><strong><?php _e('Sort Order','templatic');?></strong></th>
      <th width="85" align="center"><strong><?php _e('Action','templatic');?></strong></th>
      <th width="85" align="center"><strong><?php _e('Settings','templatic');?></strong></th>
      <th>&nbsp;</th>
    </tr>
    <?php
if($paymentinfo)
{
	foreach($paymentinfo as $paymentinfoObj)
	{
		$paymentInfo = unserialize($paymentinfoObj->option_value);
		$option_id = $paymentinfoObj->option_id;
		$paymentInfo['option_id'] = $option_id;
		$paymentOptionArray[$paymentInfo['display_order']][] = $paymentInfo;
	}
	ksort($paymentOptionArray);
	foreach($paymentOptionArray as $key=>$paymentInfoval)
	{
		for($i=0;$i<count($paymentInfoval);$i++)
		{
			$paymentInfo = $paymentInfoval[$i];
			$option_id = $paymentInfo['option_id'];
		?>
	<tr>
      <td><?php echo $paymentInfo['name'];?></td>
      <td><?php if($paymentInfo['isactive']){ _e("Yes",'templatic');}else{	_e("No",'templatic');}?></td>
      <td><?php echo $paymentInfo['display_order'];?></td>
      <td><?php if($paymentInfo['isactive']==1)
	{
		echo '<a href="'.site_url().'/wp-admin/admin.php?page=manage_settings&status=0&id='.$option_id.'#option_payment">'.__('Deactivate','templatic').'</a>';
	}else
	{
		echo '<a href="'.site_url().'/wp-admin/admin.php?page=manage_settings&status=1&id='.$option_id.'#option_payment">'.__('Activate','templatic').'</a>';
	}
	?></td>
      <td><?php
    echo '<a href="'.site_url().'/wp-admin/admin.php?page=manage_settings&payact=setting&id='.$option_id.'#option_payment">'.__('Settings','templatic').'</a>';
	?></td>
      <td>&nbsp;</td>
    </tr>
	
	
    <?php
		}
	}
}
?>
  </thead>
</table>