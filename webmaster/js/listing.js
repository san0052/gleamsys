function listing_add_val()
{
	if(document.getElementById("category_add").value=="")
	{
		alert("Please select category name");
		document.getElementById("category_add").focus();
		return false;
	}
	if(document.getElementById("name_add").value=="")
	{
		alert("Please enter name");
		document.getElementById("name_add").focus();
		return false;
	}	
	if(document.getElementById("price_add").value=="")
	{
		alert("Please enter price");
		document.getElementById("price_add").focus();
		return false;
	}	
	
	if(document.getElementById("price_add").value!="")
	{
		if(isNaN(document.getElementById("price_add").value))
		{
			alert("Price should be numeric");
			document.getElementById("price_add").focus();
			return false;
		}
	}
	
}

function listing_val_edit()
{
	if(document.getElementById("name_edit").value=="")
	{
		alert("Please enter name");
		document.getElementById("name_edit").focus();
		return false;
	}
	if(document.getElementById("price_edit").value=="")
	{
		alert("Please enter price");
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