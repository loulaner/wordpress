function check_room_type_frm()
{
	
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regex = new RegExp("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i");
	
	if(document.getElementById('room_type_name').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Room Type Name \n\n";
		Error = 1;
	}
	if(document.getElementById('room_type_capacity').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Room Type Capacity \n\n";
		Error = 1;
	}
	if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}
function EnterNumber(e)	{
	var keynum;
	var keychar;
	if(window.event) // IE 
	{
		keynum = e.keyCode;
	}else if(e.which) // Netscape/Firefox/Opera
	{
		keynum = e.which;
	}			
	if(keynum == 8){
		var numcheck = new RegExp("^[^a-z^A-Z]");			
	}else{
		var numcheck = new RegExp("^[0-9.,]");
	}
	keychar = String.fromCharCode(keynum);	
	return numcheck.test(keychar);
}

function cap_price(){ 
	if (jQuery('#room_type_capacity').val() == ''){					
	}else{
		var num = parseInt( jQuery('#room_type_capacity').val() );
		field = '',
		count = jQuery('#display_cap_price').find('tr').length;
		if ( num > count )	{
			for( i = 1 ; i <= num - count; i++ ) {
				index = i + count;
				field += '<tr>';
				field += '<td align="left" valign="top" style="width:150px;"><label class="setting_lbl" for="price">Price for ' + index + ' Person : </label></td><td align="left" valign="top"><input type="text" onkeypress="return EnterNumber(event)" name="roomtype_cap_price_' + index + '" /></td></tr>';
			} if ( field != '' ) jQuery('#display_cap_price').append(field);
		} else if( num < count  ) {
			for( i = 1 ; i <= (count - num); i++) {
				jQuery('#display_cap_price').find('tr').last().remove();
			}
		}//display_cap_price(jQuery('#room_type_capacity').val(),jQuery('#price_roomtype').val());				
	}
}
function display_cap_price(room_type_capacity, price_roomtype){				
	jQuery.ajax({
		type: 'post',
		url: "<?php echo get_site_url();?>/?do_ajax=ajax_capability_price_process",
		data: {
			action: 'ajax_capability_price',
			room_type_capacity: '' + room_type_capacity,
			price_roomtype: '' + price_roomtype
		},						
		success: function(data){							
			jQuery('#display_cap_price').html(data.content);
		}	
	});
}
function confirmSubmit() {
var agree=confirm("Are you sure you want to delete?");
if (agree)
	return true ;
else
	return false ;
}
function chk_price(field){
	if(document.getElementById('chkprice').checked == true){
		pricecheckAll(field)
	} else {
		priceuncheckAll(field)
	}
}
function pricecheckAll(field){
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}
function priceuncheckAll(field){
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}

function room_validation()
{
	
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regex = new RegExp("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i");
	if(document.getElementById('r_room_type_id').value=='')
	{
		ErrorMsg = ErrorMsg + "请选择房间类型 \n\n";
		Error = 1;
	}
	
	if(document.getElementById('room_name').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Room Name \n\n";
		Error = 1;
	}if(document.getElementById('sortorder').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Sortorder \n\n";
		Error = 1;
	}
	if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}

function room_gallery_validation()
{
	
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regex = new RegExp("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i");
	var re_text = /\.jpg|\.JPG|\.gif|\.GIF|\.JPEG|\.jpeg|\.png|\.PNG/i;
	var filename = document.getElementById('gallery_photo').value;

	
	if(document.getElementById('g_room_type_id').value=='')
	{
		ErrorMsg = ErrorMsg + "请选择房间类型 \n\n";
		Error = 1;
	}if(document.getElementById('file_title').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Title \n\n";
		Error = 1;
	}
	if(document.getElementById('prev_gallery_photo').value=='')
	{
		if(document.getElementById('gallery_photo').value=='') {
			ErrorMsg = ErrorMsg + "Please Browse Image \n\n";
			Error = 1;
		}else {
			if (filename.search(re_text) == -1)
			{
				ErrorMsg = ErrorMsg + "File allow only (jpg,png,gif)  extension \n\n";
				Error = 1;
			}
		}
	}
if(document.getElementById('g_sortorder').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Sortorder \n\n";
		Error = 1;
	}
	if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}

function room_price_validation()
{
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regex = new RegExp("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i");
	
	if(document.getElementById('room_type_id').value=='')
	{
		ErrorMsg = ErrorMsg + "请选择房间类型 \n\n";
		Error = 1;
	}if(document.getElementById('from_date').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Select From Date \n\n";
		Error = 1;
	}if(document.getElementById('to_date').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Select To Date \n\n";
		Error = 1;
	}
	
	if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}
function settings_validtion()
{
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regex = new RegExp("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i");
	
	if(document.getElementById('field_front_title').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Field Title \n\n";
		Error = 1;
	}if(document.getElementById('fieldname').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Field Name \n\n";
		Error = 1;
	}
	if(document.getElementById('bookingfieldtype').value=='0')
	{
		ErrorMsg = ErrorMsg + "Please Select Fieldtype \n\n";
		Error = 1;
	}
	if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}
function service_validation()
{
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regex = new RegExp("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i");
	
	if(document.getElementById('service_name').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Service Name \n\n";
		Error = 1;
	}
	if(document.getElementById('service_price').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Service Price \n\n";
		Error = 1;
	}if(document.getElementById('sortorder').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Service sortorder \n\n";
		Error = 1;
	}
	if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}