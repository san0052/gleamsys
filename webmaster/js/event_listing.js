function add_event_val()
{
	if(document.getElementById("title").value=="")
	{
		alert("Please enter the Title ");
		document.getElementById("title").focus();
		return false;
	}
	if(document.getElementById("date_time").value=="")
	{
		alert("Please enter the date ");
		document.getElementById("date_time").focus();
		return false;
	}
	if(document.getElementById("price").value=="")
	{
		alert("Please enter the price ");
		document.getElementById("price").focus();
		return false;
	}
	if(document.getElementById("price").value!="")
	{
		if(isNaN(document.getElementById("price").value))
		{
			alert("Price should be numeric");
			document.getElementById("price").focus();
			return false;
		}
	}
}

//edit
function edit_event_val()
{
	if(document.getElementById("title_edit").value=="")
	{
		alert("Please enter the Title ");
		document.getElementById("title_edit").focus();
		return false;
	}
	if(document.getElementById("date_time_edit").value=="")
	{
		alert("Please enter the date ");
		document.getElementById("date_time_edit").focus();
		return false;
	}
	if(document.getElementById("price_edit").value=="")
	{
		alert("Please enter the price ");
		document.getElementById("price_edit").focus();
		return false;
	}
	if(document.getElementById("price_edit").value!="")
	{
		if(isNaN(document.getElementById("price_edit").value))
		{
			alert("Price should be numeric");
			document.getElementById("price_edit").focus();
			return false;
		}
	}
}