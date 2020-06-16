function bannerfrm_add()
{
	
		if(document.getElementById("image_add").value=="")
		{
			alert("Please choose image");
			document.getElementById("image_add").focus();
			return false;
		}
	
}
function banner_edit_fun()
{
	if(document.getElementById("image_edit").value=="")
		{
			alert("Please choose image");
			document.getElementById("image_edit").focus();
			return false;
		}
}