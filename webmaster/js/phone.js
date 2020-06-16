function check_phone(id)
{
	if(isNaN(document.getElementById(id).value))
	{
		document.getElementById(id+"1").style.display='inline';
		//alert("Phone number should be numeric");
		document.getElementById(id).focus();
		
	}
	else
	{
		document.getElementById(id+"1").style.display='none';
	}
}