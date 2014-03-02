function callAjax(elementID,PageUrl){
//alert("On called ajax:"+PageUrl+elementID);
	var http = false;

		if(navigator.appName == "Microsoft Internet Explorer") {
		  http = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
		  http = new XMLHttpRequest();
		}

		http.abort();
		http.open("GET", PageUrl, true);
		http.onreadystatechange=function() {
		    if(http.readyState == 4) {
		      if(http.responseText == "incorrect"){
					document.getElementById(elementID).innerHTML = "Please select room type...";
				
		      }else{
					document.getElementById(elementID).innerHTML = http.responseText;
					
		      }
		    }
		}
		http.send(null);
	
}
