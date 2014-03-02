function settings_validtion()
{
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regex = new RegExp("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i");
	
	if(document.getElementById('fieldname').value=='')
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
function confirmSubmit()
{
var agree=confirm("Are you sure you want to delete?");
if (agree)
	return true ;
else
	return false ;
}
jQuery(document).ready(function(){
	var check_position = '';
	var symbol = '$';
	jQuery('#symbol_position').change(function(){
		check_position = jQuery('#symbol_position').val();
		if(check_position == '1')
		{
			jQuery('#ex_position').html(symbol + '500');
		}else if(check_position == '2')
		{
			jQuery('#ex_position').html(symbol + ' 500');
		}else if(check_position == '3')
		{
			jQuery('#ex_position').html('500' + symbol);
		}else if(check_position == '4')
		{
			jQuery('#ex_position').html('500 ' + symbol);
		}
	});
});
// TinyMCE BOF
tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins :"advimage,advlink,emotions,iespell,",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,blockquote,|,link,unlink,anchor,image,code",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,
		width : "550",
		height : "150",
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
		username : "Some User",
		staffid : "991234",
		}
	});

// TinyMCE EOF

function IsNumeric(sText) {
	var ValidChars = "123456789";
	var IsNumber=true;
	var Char;
	for (i = 0; i < sText.length && IsNumber == true; i++){ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1){
			IsNumber = false;
		}
	}
	return IsNumber;
}
function perIsNumeric(sText) {
	var ValidChars = "0123456789.";
	var IsNumber=true;
	var Char;
	for (i = 0; i < sText.length && IsNumber == true; i++){ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1){
			IsNumber = false;
		}
	}
	return IsNumber;
}
function global_setting(){
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	if(document.getElementById('max_adults').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Maximum Adults \n\n";
		Error = 1;
	} else {
		if(regadult.test(document.getElementById('max_adults').value) == false) {
			ErrorMsg = ErrorMsg + "Maximum Adults Field Allow only digit\n\n";
			Error = 1;
		}
	}if(document.getElementById('max_rooms').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Maximum Rooms \n\n";
		Error = 1;
	} else {
		if(regroom.test(document.getElementById('max_rooms').value) == false) {
			ErrorMsg = ErrorMsg + "Maximum Rooms Field Allow only digit\n\n";
			Error = 1;
		}
	}
	if(document.getElementById('deposite_percentage').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Deposit Percentage \n\n";
		Error = 1;
	}if(document.getElementById('tax').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Tax \n\n";
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
function email_settings()
{
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regex = new RegExp("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i");
	
	if(reg.test(document.getElementById('txtadminemail').value) == false){
		ErrorMsg = ErrorMsg + "Please Enter Valid Email Address \n\n";
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
function hotel_settings()
{
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	var reghotel = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regphone =  /^((\+)?[1-9]{1,2})?([-\s\.])?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}$/;

	var regphone_2 = /^((\+)?[1-9]{1,2})?([-\s\.])?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}$/;
		
	if(document.getElementById('hotel_name').value=='')	{
		ErrorMsg = ErrorMsg + "Please Enter Hotel Name \n\n";
		Error = 1;
	}if(reghotel.test(document.getElementById('contact_hotel_mail').value) == false)
	{
		ErrorMsg = ErrorMsg + "Please Enter Valid Email Address \n\n";
		Error = 1;
	}if(document.getElementById('hotel_state').value=='') {
		ErrorMsg = ErrorMsg + "Please Enter Hotel State \n\n";
		Error = 1;
	}if(document.getElementById('hotel_street').value=='') {
		ErrorMsg = ErrorMsg + "Please Enter Hotel Street \n\n";
		Error = 1;
	}if(document.getElementById('contact_phone_1').value=='') {
		ErrorMsg = ErrorMsg + "Please Enter Hotel Conatct Phone no. \n\n";
		Error = 1;
	} else {
		if(regphone.test(document.getElementById('contact_phone_1').value) == false) {
			ErrorMsg = ErrorMsg + "Enter Valid Contact Phone no. 1\n\n";
			Error = 1;
		}
	}if(document.getElementById('contact_phone_2').value != ''){
		if(regphone_2.test(document.getElementById('contact_phone_2').value) == false) {
			ErrorMsg = ErrorMsg + "Enter Valid Contact Phone no. 2\n\n";
			Error = 1;
		}
	}
	if(document.getElementById('mail_from').value=='') {
		ErrorMsg = ErrorMsg + "Please Enter Mail From \n\n";
		Error = 1;
	}if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}
function currency_validation() {
	var ErrorMsg = "Following fields must be corrected \n\n";
	var Error = 0;
	if(document.getElementById('currency_name').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Currency Name \n\n";
		Error = 1;
	}
	if(document.getElementById('currency_code').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Currency Code \n\n";
		Error = 1;
	}if(document.getElementById('currency_symbol').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Currency Symbol \n\n";
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