function side_bar_validation(){
	var Error = 0;
	var ErrorMsg = "Following fields must be corrected \n\n";
	if(document.getElementById('check_in_date').value == 'Check-In')
	{
		ErrorMsg = ErrorMsg + "Please Enter check in date \n\n";
		Error = 1;
	}if(document.getElementById('check_out_date').value == 'Check-Out')
	{
		ErrorMsg = ErrorMsg + "Please Enter check out date \n\n";
		Error = 1;
	} else {
		if(document.getElementById('check_in_date').value > document.getElementById('check_out_date').value){
			ErrorMsg = ErrorMsg + "Check out date must be greater than check in date \n\n";
			Error = 1;
		} 
	}if(document.getElementById('adults').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Select Adults \n\n";
		Error = 1;
	}if(document.getElementById('no_rooms').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Select No. Of Rooms \n\n";
		Error = 1;
	}if(document.getElementById('room_type').value=='')
	{
		ErrorMsg = ErrorMsg + "Please Select Room Type \n\n";
		Error = 1;
	}if(Error == 1){
		alert(ErrorMsg);
		return false;
	}
	else{
		return true;
	}
}