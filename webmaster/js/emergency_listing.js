
		
function listing_val_edit()
{
	if(document.getElementById("name_edit").value=="")
	{
		alert("Please enter name");
		document.getElementById("name_edit").focus();
		return false;
	}
	if(document.getElementById("addr_edit").value=="")
	{
		alert("Please enter address");
		document.getElementById("addr_edit").focus();
		return false;
	}
	if(document.getElementById("phone_edit").value=="")
	{
		alert("Please enter phone number");
		document.getElementById("phone_edit").focus();
		return false;
	}
	if(document.getElementById("phone_edit").value!="")
	{
		if(isNaN(document.getElementById("phone_edit").value))
		{
			alert("Phone number should be numeric");
			document.getElementById("phone_edit").focus();
			return false;
		}
	}
	
}
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
	if(document.getElementById("addr_add").value=="")
	{
		alert("Please enter address");
		document.getElementById("addr_add").focus();
		return false;
	}
	if(document.getElementById("phone_add").value=="")
	{
		alert("Please enter phone number");
		document.getElementById("phone_add").focus();
		return false;
	}
	if(document.getElementById("phone_add").value!="")
	{
		if(isNaN(document.getElementById("phone_add").value))
		{
			alert("Phone number should be numeric");
			document.getElementById("phone_add").focus();
			return false;
		}
	}
	
}