function check_emailadd(email)	{
			
			if(email!="")
			{
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!filter.test(email))
				{
						document.getElementById("invalid_add").style.display = 'inline';
						document.getElementById("exists_add").style.display='none';
						document.getElementById("notexists_add").style.display='none';
						document.getElementById("dist_add_valid").value=2;
				}
				else
				{
					var act='check_emailadd';
					http.open('get','distributor_process.php?act='+act+'&email='+email);
					http.onreadystatechange = handleResponseEmailAdd;
					http.send(null);
				}
			}
			else
			{
				document.getElementById("exists_add").style.display='none';
				document.getElementById("notexists_add").style.display='none';
				document.getElementById("invalid_add").style.display = 'none';
			}
		}
		function handleResponseEmailAdd() {
		   if(http.readyState == 4 && http.status == 200){
			  var response = http.responseText;
			  if(response!="")
			  {
				 if(response==1)
				 {
				 	//alert(response);
					document.getElementById("exists_add").style.display='inline';
					document.getElementById("notexists_add").style.display='none';
					document.getElementById("invalid_add").style.display = 'none';
					document.getElementById("dist_add_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
					document.getElementById("notexists_add").style.display='inline';
				 	document.getElementById("exists_add").style.display='none';
					document.getElementById("invalid_add").style.display = 'none';
					document.getElementById("dist_add_valid").value=0;
				 }
			  }
		   }
		}
		
	  function check_emailedit(email,id)	{
		 
			
			if(email!="")
			{
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!filter.test(email))
				{
						document.getElementById("invalid_edit").style.display = 'inline';
						document.getElementById("exists_edit").style.display='none';
						document.getElementById("notexists_edit").style.display='none';
						document.getElementById("same_edit").style.display='none';
						document.getElementById("dist_edit_valid").value=2;
				}
				else
				{
					var act='check_emailedit';
					http.open('get','distributor_process.php?act='+act+'&email='+email+'&id='+id);
					http.onreadystatechange = handleResponseEmailEdit;
					http.send(null);
				}
			}
			else
			{
				document.getElementById("notexists_edit").style.display='none';
				document.getElementById("exists_edit").style.display='none';
				document.getElementById("same_edit").style.display='none';
				document.getElementById("invalid_edit").style.display = 'none';
			}
		}
		function handleResponseEmailEdit() {
		   if(http.readyState == 4 && http.status == 200){
			  var response = http.responseText;
			  if(response!="")
			  {
				  
				 if(response==1)
				 {
				 	//alert(response);
				 	
					document.getElementById("exists_edit").style.display='inline';
					document.getElementById("notexists_edit").style.display='none';
					document.getElementById("same_edit").style.display='none';
					document.getElementById("invalid_edit").style.display = 'none';
					document.getElementById("dist_edit_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
				 	
					document.getElementById("notexists_edit").style.display='inline';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("same_edit").style.display='none';
					document.getElementById("invalid_edit").style.display = 'none';
					document.getElementById("dist_edit_valid").value=0;
				 }
				 if(response==2)
				 {
				 	//alert(response);
				 	document.getElementById("same_edit").style.display='inline';
					document.getElementById("notexists_edit").style.display='none';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("invalid_edit").style.display = 'none';
					document.getElementById("dist_edit_valid").value=0;
				 }
			  }
		   }
		}
		
		
function dist_val_edit()
{
	if(document.getElementById("dist_name_edit").value=="")
	{
		alert("Please enter distributor name");
		document.getElementById("dist_name_edit").focus();
		return false;
	}
	if(document.getElementById("dist_email_edit").value=="")
	{
		alert("Please enter email id");
		document.getElementById("dist_email_edit").focus();
		return false;
	}
	if(document.getElementById("dist_edit_valid").value==1)
	{
		alert("This email id already exists");
		document.getElementById("dist_email_edit").focus();
		return false;
	}
	if(document.getElementById("dist_edit_valid").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("dist_email_edit").focus();
		return false;
	}
	if(document.getElementById("dist_pass_edit").value=="")
	{
		alert("Please enter password");
		document.getElementById("dist_pass_edit").focus();
		return false;
	}
	if(document.getElementById("dist_addr_edit").value=="")
	{
		alert("Please enter address");
		document.getElementById("dist_addr_edit").focus();
		return false;
	}
	if(document.getElementById("dist_phone_edit").value=="")
	{
		alert("Please enter phone no");
		document.getElementById("dist_phone_edit").focus();
		return false;
	}
	if(document.getElementById("dist_phone_edit").value!="")
	{
		if(isNaN(document.getElementById("dist_phone_edit").value))
		{
			alert("Phone number should be numeric");
			document.getElementById("dist_phone_edit").focus();
			return false;
		}
	}
	if(document.getElementById("dist_country_edit").value=="")
	{
		alert("Please enter country");
		document.getElementById("dist_country_edit").focus();
		return false;
	}
	if(document.getElementById("dist_city_edit").value=="")
	{
		alert("Please enter city name");
		document.getElementById("dist_city_edit").focus();
		return false;
	}
	if(document.getElementById("dist_state_edit").value=="")
	{
		alert("Please enter state");
		document.getElementById("dist_state_edit").focus();
		return false;
	}
	
}
function add_dist_val()
{
	if(document.getElementById("dist_name_add").value=="")
	{
		alert("Please enter distributor name");
		document.getElementById("dist_name_add").focus();
		return false;
	}
	if(document.getElementById("dist_email_add").value=="")
	{
		alert("Please enter email id");
		document.getElementById("dist_email_add").focus();
		return false;
	}
	if(document.getElementById("dist_add_valid").value==1)
	{
		alert("This email id already exists");
		document.getElementById("dist_add_valid").focus();
		return false;
	}
	if(document.getElementById("dist_add_valid").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("dist_add_valid").focus();
		return false;
	}
	if(document.getElementById("dist_pass_add").value=="")
	{
		alert("Please enter password");
		document.getElementById("dist_pass_add").focus();
		return false;
	}
	if(document.getElementById("dist_addr_add").value=="")
	{
		alert("Please enter address");
		document.getElementById("dist_addr_add").focus();
		return false;
	}
	if(document.getElementById("dist_phone_add").value=="")
	{
		alert("Please enter phone no");
		document.getElementById("dist_phone_add").focus();
		return false;
	}
	if(document.getElementById("dist_phone_add").value!="")
	{
		if(isNaN(document.getElementById("dist_phone_add").value))
		{
			alert("Phone number should be numeric");
			document.getElementById("dist_phone_add").focus();
			return false;
		}
	}
	if(document.getElementById("dist_country_add").value=="")
	{
		alert("Please enter country");
		document.getElementById("dist_country_add").focus();
		return false;
	}
	if(document.getElementById("dist_city_add").value=="")
	{
		alert("Please enter city name");
		document.getElementById("dist_city_add").focus();
		return false;
	}
	if(document.getElementById("dist_state_add").value=="")
	{
		alert("Please enter state");
		document.getElementById("dist_state_add").focus();
		return false;
	}
	
	
}