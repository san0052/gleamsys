// Generate State For Consumer Add Section
function getStateList(CountryControl,StateControlName,StatePlaceHolder,CityControlName,CityPlaceHolder)
{
	value=document.getElementById(CountryControl).value;
	
	var st='<select name=\"'+StateControlName+'\" id=\"'+StateControlName+'\" class=\"forminputelement\" disabled=\"disabled\" onchange=\"getCityList(this.value,\"'+CityControlName+'\",\"'+CityPlaceHolder+'\")\"  style=\"width:127px;\"><option value=\"\" >-- Select State --</option></select>';
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
	var st='<select name=\"'+CityControlName+'\" id=\"'+CityControlName+'\" class=\"forminputelement\" disabled=\"disabled\"><option value=\"\" >-- Select City --</option></select>';
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