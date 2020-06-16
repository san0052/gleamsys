// Generate State For Consumer Add Section
function getStateList(CountryControl,StateControlName,StatePlaceHolder,CityControlName,CityPlaceHolder)
{
	
	value=document.getElementById(CountryControl).value;
	var st='<select name=\"'+StateControlName+'\" id=\"'+StateControlName+'\" class=\"form-control\" disabled=\"disabled\" onchange=\"getCityList(this.value,\"'+CityControlName+'\",\"'+CityPlaceHolder+'\")\"><option value=\"\" >-- Select State --</option></select>';
	if(value!="")
	{
		var act='GetStateIndex';
		http.open('get','country_state_city_process.php?act='+act+'&value='+value+'&StateControlName='+StateControlName+'&StatePlaceHolder='+StatePlaceHolder+'&CityControlName='+CityControlName+'&CityPlaceHolder='+CityPlaceHolder);
		http.onreadystatechange = handleResponseStateIndex;
		http.send(null);
	}
	else
	{
		document.getElementById(StatePlaceHolder).innerHTML = '';
		document.getElementById(StatePlaceHolder).innerHTML = st;
	}
}
function handleResponseStateIndex() 
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText;
		if(response!="")
		{
			var arr=response.split("|||||");
			document.getElementById(arr[1]).innerHTML = '';
			document.getElementById(arr[1]).innerHTML = arr[0];
		}
	}
}

// Generate City For Consumer Add Section
function getCityList(value,CityControlName,CityPlaceHolder)
{
	var st='<select name=\"'+CityControlName+'\" id=\"'+CityControlName+'\" class=\"form-control\" disabled=\"disabled\"><option value=\"\" >-- Select City --</option></select>';
	if(value!="")
	{
		var act='GetCityIndex';
		http.open('get','country_state_city_process.php?act='+act+'&value='+value+'&CityControlName='+CityControlName+'&CityPlaceHolder='+CityPlaceHolder);
		http.onreadystatechange = handleResponseCityIndex;
		http.send(null);
	}
	else
	{
		document.getElementById(CityPlaceHolder).innerHTML = '';
		document.getElementById(CityPlaceHolder).innerHTML = st;
	}
}
function handleResponseCityIndex() 
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText;
		if(response!="")
		{
			var arr=response.split("|||||");
			document.getElementById(arr[1]).innerHTML = '';
			document.getElementById(arr[1]).innerHTML = arr[0];
		}
	}
}

function login_cust_val()
{
	//alert('1111');
	if(document.getElementById("cust_email").value=="")
	{
		alert("Please enter email address");
		document.getElementById("cust_email").focus();
		return false;
	}
	
	
	if(document.getElementById("cust_pass").value=="")
	{
		alert("Please enter password");
		document.getElementById("cust_pass").focus();
		return false;
	}	
}

function pass_cust_val()
{
	if(document.getElementById("pass_recovery_mail").value=="")
	{
		alert("Please enter email address");
		document.getElementById("pass_recovery_mail").focus();
		return false;
	}
	if(document.getElementById("pass_recovery_mail").value!=""){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(document.getElementById("pass_recovery_mail").value))
	{
		alert("Please enter valid email address");
		document.getElementById("pass_recovery_mail").focus();
		return false;
	}
	else{
	$.ajax({
	type: "POST",
	url: "login_process.php",
	data: "action=recovery&email="+document.getElementById("pass_recovery_mail").value

}).done(function( msg ) {
document.getElementById("recovery_msg").innerHTML='';
document.getElementById("recovery_msg").innerHTML=msg;
});
	document.getElementById("pass_recovery_mail").value='';
	setTimeout("close_recovery_msgs()",8000);
	}
	}
}
	
/*function close_recovery_msgs()
{
	document.getElementById("recovery_msg").innerHTML='';
	document.getElementById("pass_recovery_mail").value='';
	//document.getElementById('recovery_divs').style.display='none';
}
function forgot_pass_div()
{
	document.getElementById("recovery_msg").innerHTML='';
	document.getElementById("pass_recovery_mail").value='';
	document.getElementById('recovery_divs').style.display='block';
}
function close_forgot_pass_div()
{
	document.getElementById('recovery_divs').style.display='none';
}*/