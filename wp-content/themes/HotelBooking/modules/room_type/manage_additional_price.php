 <div class='headerdivh3'>
	<h3><?php _e('Seasonal Price','templatic');?></h3>
    <div class="divright"><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&price_page_type=add_price#option_display_room_price';?>" title="<?php _e('Add New Seasonal Price','templatic');?>" name="btnviewlisting" class="button-primary" /><?php _e('Add New Seasonal Price','templatic'); ?></a></div>
  <p><img src="<?php echo PLUGIN_URL_ROOM;?>images/info.png" alt="information icon">&nbsp;&nbsp;<?php _e('Additional amount charged as per from-date to to-date (for holiday/christmas seasons).','templatic');?></p>
</div>
<?php 
if($_REQUEST['addeditmsg']=='success'){?><br /><br />
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
		 <?php if($_REQUEST['msgtype'] == 'add'){
				_e('Seasonal Price Updated Successfully','templatic');
			} else {
				_e('Seasonal Price Updated Successfully.','templatic');
			}?>
	 </div>
	<?php } if($_REQUEST['msg']=='statussuccess'){?><br /><br />
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Status Changed Successfully','templatic'); ?>
	</div>
	<?php } if($_REQUEST['msg']=='delsuccess'){?><br /><br />
	<div class="updated fade below-h2" id="message" style="padding:5px; font-size:11px;" >
	  <?php _e('Seasonal Price Deleted Successfully.','templatic'); ?>
	</div>
	<?php }?>
<?php 
$targetpage = site_url('/wp-admin/admin.php?page=manage_room_type');
$pricerecordsperpage = 20;
$pagination = $_REQUEST['pagination'];
if($pagination == '')
{
	$pagination = 1;
}
$pricestrtlimit = ($pagination-1)*$pricerecordsperpage;
$priceendlimit = $pricestrtlimit+$pricerecordsperpage;
//----------------------------------------------------
$price_limit = " order by additional_price_id limit $pricestrtlimit,$pricerecordsperpage";
$price_qry = "select * from $additional_price_master ";
$price_sql = mysql_query($price_qry); 
$total_pages = mysql_num_rows($price_sql);
$final_price_qry = mysql_query($price_qry.$price_limit);
if($total_pages > 0) { ?>
	<form name="frm_price_status" id="frm_price_status" action="<?php echo site_url()?>/wp-admin/admin.php?page=manage_room_type&pagetype=ch_price_status" method="post">
	<table cellspacing="1" cellpadding="4" border="0" width="100%" style="border:0px;">
		<tr>
			<td align="left" valign="top" style="border:0px;width:140px;"><select name="price_add_status" id="price_add_status" style="width:120px;"><?php echo price_status_cmb(); ?></select></td>
			<td align="left" valign="top"><input type="submit" name="submit" id="save" value="<?php _e('Apply','templatic');?>"  class="button-primary" ></td>
		</tr>
	</table>
	<table width="100%" cellpadding="5" class="widefat post fixed" >
		<thead>						
		<tr>
			<th align="left" width="20"><input type="checkbox" name="chkprice" id="chkprice" value="" onclick="chk_price(document.getElementById('frm_price_status').additional_price_id)" ></th>
			<th align="left" width="15"><strong><?php _e('ID','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Time','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Room Type','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('NewPrice','templatic'); ?></strong></th>
			<th align="left"><strong><?php _e('Activated','templatic'); ?></strong></th>
		</tr>
		<?php
		
		while($price_data = mysql_fetch_array($final_price_qry)) { 
		if($price_data['price_status'] == 'Y') {
				$status = 'Yes';
			} else {
				$status = 'No';
			}
			$from_to_date = 'From '.date('m/d',strtotime($price_data['from_date'])).' to '.date('m/d',strtotime($price_data['to_date']));
		?>
			<tr>
				<td align="left" width="8" style="padding-left:15px;"><input type="checkbox" name="additional_price_id[]" id="additional_price_id" value="<?php echo $price_data['additional_price_id'];?>" ></td>
				<td><a href="<?php echo site_url().'/wp-admin/admin.php?page=manage_room_type&price_page_type=add_price&additional_price_id='.$price_data['additional_price_id'].'&#option_display_room_price';?>"><strong><?php echo $price_data['additional_price_id'];?></strong></a></td>
				<td><?php echo $from_to_date;?></td>
				<td><?php echo fecth_room_type_name($price_data['room_type_id']);?></td>
				<td><?php echo fetch_room_price($price_data['additional_price_id']);?></td>
				<td><?php echo $status;?></td>
			</tr>
		<?php }	?>
			<tr>
				<td colspan="6" align="left">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" align="left"><strong><?php _e('合计'); ?> : <?php echo $total_pages;?> <?php _e('人'); ?></strong></td>
				<td colspan="3" align="right"><?php if($total_pages>$pricerecordsperpage){
						echo get_pagination($targetpage,$total_pages,$pricerecordsperpage,$pagination,'#option_display_room_price');
					}?></td>
            </tr>
	</thead>					
	</table>
	</form>
<?php } else {
	echo '<center><h4>当前没有季节性价格</h4></center>';
}?>