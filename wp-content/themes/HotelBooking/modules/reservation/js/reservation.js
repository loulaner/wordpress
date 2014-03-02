function chk_customer(field){
	if(document.getElementById('chk').checked == true){
		checkAll(field)
	} else {
		uncheckAll(field)
	}
}
function checkAll(field){
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}
function uncheckAll(field){
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}
function confirmSubmit()
{
var agree=confirm("Are you sure you want to delete?");
if (agree)
	return true ;
else
	return false ;
}
function chk_booking_validation(){
	var ErrorMsg = "Following fields must be completed.. \n\n";
	var Error = 0;
	if(document.getElementById('check_in_date').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Select Check In Date \n\n";
		Error = 1;
	}if(document.getElementById('check_out_date').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Select Check Out Date \n\n";
		Error = 1;
	}if(document.getElementById('ch_room_type_id').value=='')
	{
		ErrorMsg = ErrorMsg + "请选择房间类型 \n\n";
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
function transaction_validation(){
	var ErrorMsg = "Following fields must be completed.. \n\n";
	var Error = 0;
	var regamt = /^[0-9.,]/;
	if(document.getElementById('pay_amount').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Enter Payable Amount \n\n";
		Error = 1;
	} else {
		if(regamt.test(document.getElementById('pay_amount').value) == false) {
			ErrorMsg = ErrorMsg + "Payable Amount Field Allow only digit\n\n";
			Error = 1;
		}
	}if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}
