function getstateindex(id)
{
	
	var st='<select name=\"state_name\" id=\"state_name\" class=\"forminputelement\" disabled=\"disabled\" onchange=\"city_availability_add()\" onclick=\"city_availability_add()\"><option value=\"\" >Select State</option></select>';
	if(id!="")
	{
		var act='getstateindex';
		http.open('get','city_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestateindex;
		http.send(null);
	}
	else
	{
		document.getElementById("state").innerHTML = '';
		document.getElementById("state").innerHTML = st;
	}
}
function handleResponsestateindex() 
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText;
		//alert(response);
		if(response!="")
		{
			
			document.getElementById("state").innerHTML = '';
			document.getElementById("state").innerHTML = response;
		}
	}
}

// Add Section

function getstateindexAdd(id)
{
	var st='<select name=\"state_add\" id=\"state_add\" class=\"forminputelement\" disabled=\"disabled\" onchange=\"city_availability_add()\" onclick=\"city_availability_add()\"><option value=\"\" >Select State</option></select>';
	if(id!="")
	{
		var act='getstateindexAdd';
		http.open('get','city_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestateindexAdd;
		http.send(null);
	}
	else
	{
		document.getElementById("stateAdd").innerHTML = '';
		document.getElementById("stateAdd").innerHTML = st;
	}
}
function handleResponsestateindexAdd() 
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText;
		//alert(response);
		if(response!="")
		{
			
			document.getElementById("stateAdd").innerHTML = '';
			document.getElementById("stateAdd").innerHTML = response;
		}
	}
}