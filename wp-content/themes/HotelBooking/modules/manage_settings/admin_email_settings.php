<?php 
	global $wpdb; 
	$email_setting = $wpdb->prefix . "email_configuration";
	$booking_email = "select * from $email_setting";
	$booking_emailinfo = $wpdb->get_row($booking_email);
   if(isset($_GET['pagetype']) && $_GET['pagetype'] == 'update_email'){          
		global $wpdb; 
		$email = $_POST['txtadminemail'];
		$request_email_sub = $_POST['txtrequest_mail_subject'];
		$request_email = stripslashes($_POST['txtemailreq']);
		$activate_email_sub = $_POST['txtactive_mail_subject'];
		$activate_email = stripslashes($_POST['txtemailactivate']);
		$cancel_email_sub = $_POST['txtreject_mail_subject'];
		$cancel_email = stripslashes($_POST['txtemailcancel']);
		$updateemail = $_POST['txtupdateeid'];
		$sqlupdateemail= $wpdb->query("Update $email_setting SET user_email ='".$email."',request_email_sub='".$request_email_sub."',request_email='".addslashes($request_email)."',active_email_sub ='".$activate_email_sub."',active_email ='".addslashes($activate_email)."',cancel_email_sub='".$cancel_email_sub."',cancel_email='".addslashes($cancel_email)."' where email_id='".$updateemail."'"); 
		$location = site_url()."/wp-admin/admin.php";
	echo '<form action="'.$location.'#email_setups" method=get name="email_success">
	<input type=hidden name="page" value="manage_settings"><input type=hidden name="success" value="emailsuccess"></form>';
	echo '<script>document.email_success.submit();</script>';
	exit;
	 }

	?>
<h3><?php _e('Email Settings','templatic');?></h3>
<?php if(isset($_REQUEST['success']) && $_REQUEST['success'] == 'emailsuccess') { 
		?><div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" ><?php _e('Email Settings updated successfully.','templatic');?></div>
	<?php }?>
	<form action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_settings&pagetype=update_email" method="post" onsubmit="return email_settings();">
	<div class="btn_divright" ><input type="submit" name="submit" value="<?php _e('Save all changes','templatic');?>" class="button-framework-imp"></div>
	  	<label for="Email" class="setting_lbl"><strong><?php _e('Email :','templatic');  ?></strong></label><br />
		<input name="txtadminemail" id="txtadminemail" type="text" value="<?php echo html_entity_decode($booking_emailinfo->user_email); ?>"><label class="desc_lbl"><?php _e('Please enter the Admin email address (Email to users will be sent through this email address).','templatic'); ?></label><br /><br />
		<h4 style="background:none repeat scroll 0 0 #EEEEEE;font-weight:bold;padding:4px;">预订请求发送通知邮件 </h4>
		<label for="Subject" class="setting_lbl"><strong><?php _e('Subject :','templatic');  ?></strong></label><br />
		<input name="txtrequest_mail_subject" id="txtrequest_mail_subject" type="text" value="<?php echo html_entity_decode($booking_emailinfo->request_email_sub); ?>" /><br />
		<label for="Email message" class="setting_lbl"><strong><?php  _e('Email :','templatic');?></strong></label><br />
        <textarea name="txtemailreq" id="txtemailreq" cols="60" rows="10"> <?php echo html_entity_decode($booking_emailinfo->request_email); ?></textarea><label class="desc_lbl"><?php _e('This is the acknowledgement message that the user will receive once they submit the request.','templatic'); ?></label><br /><br />
		<h4 style="background:none repeat scroll 0 0 #EEEEEE;font-weight:bold;padding:4px;">预订请求确认成功 </h4>
		<label for="Subject line for activation" class="setting_lbl"><strong><?php _e('Subject:','templatic');  ?></strong></label><br />
		<input name="txtactive_mail_subject" id="txtactive_mail_subject" type="text" value="<?php echo html_entity_decode($booking_emailinfo->active_email_sub); ?>" /><br />
		<label for="Accepted email" class="setting_lbl"><strong><?php _e('Email:','templatic'); ?></strong></label><br />
        <textarea name="txtemailactivate" id="txtemailactivate" cols="60" rows="10"><?php echo html_entity_decode($booking_emailinfo->active_email); ?> </textarea><label class="desc_lbl"><?php _e('Specify the message which the user will receive after you accept his/her booking request.','templatic'); ?></label><br /><br />
		<h4 style="background:none repeat scroll 0 0 #EEEEEE;font-weight:bold;padding:4px;">预订请求被拒绝 </h4>
		<label for="Subject line for rejection" class="setting_lbl"><strong><?php _e('Subject:','templatic');  ?></strong></label><br />
		<input name="txtreject_mail_subject" id="txtreject_mail_subject" type="text" value="<?php echo html_entity_decode($booking_emailinfo->cancel_email_sub); ?>" /><br />
		<label for="Rejection email" class="setting_lbl"><strong> <?php _e('Email:','templatic'); ?></strong></label><br />
        <textarea name="txtemailcancel" id="txtemailcancel" cols="60" rows="10"><?php echo html_entity_decode($booking_emailinfo->cancel_email); ?> </textarea><label class="desc_lbl"><?php _e('Specify the message which the user will receive if you cancel his/her booking request.','templatic'); ?></label><br /><br />
        <input name="txtupdateeid" id="txtupdateeid" type="hidden" value="<?php echo $booking_emailinfo->email_id; ?>"><input type="submit" name="submit" value="<?php _e('Save all changes','templatic');?>" class="button-framework-imp">
  </form>
