function check_emailadd(email)	{
			
			if(email!="")
			{
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!filter.test(email))
				{
						document.getElementById("invalid_add").style.display = 'inline';
						document.getElementById("exists_add").style.display='none';
						document.getElementById("notexists_add").style.display='none';
						document.getElementById("cust_add_valid").value=2;
				}
				else
				{
					var act='check_emailadd';
					http.open('get','free_trail_process.php?act='+act+'&email='+email);
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
					document.getElementById("cust_add_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
					document.getElementById("notexists_add").style.display='inline';
				 	document.getElementById("exists_add").style.display='none';
					document.getElementById("invalid_add").style.display = 'none';
					document.getElementById("cust_add_valid").value=0;
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
						document.getElementById("cust_edit_valid").value=2;
				}
				else
				{
					var act='check_emailedit';
					http.open('get','free_trail_process.php?act='+act+'&email='+email+'&id='+id);
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
					document.getElementById("cust_edit_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
				 	
					document.getElementById("notexists_edit").style.display='inline';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("same_edit").style.display='none';
					document.getElementById("invalid_edit").style.display = 'none';
					document.getElementById("cust_edit_valid").value=0;
				 }
				 if(response==2)
				 {
				 	//alert(response);
				 	document.getElementById("same_edit").style.display='inline';
					document.getElementById("notexists_edit").style.display='none';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("invalid_edit").style.display = 'none';
					document.getElementById("cust_edit_valid").value=0;
				 }
			  }
		   }
		}
		
		
function cust_val_edit()
{
	
	if(document.getElementById("cust_email_edit").value=="")
	{
		alert("Please enter email id");
		document.getElementById("cust_email_edit").focus();
		return false;
	}
	if(document.getElementById("cust_edit_valid").value==1)
	{
		alert("This email id already exists");
		document.getElementById("cust_email_edit").focus();
		return false;
	}
	if(document.getElementById("cust_edit_valid").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("cust_email_edit").focus();
		return false;
	}
	if(document.getElementById("cust_pass_edit").value=="")
	{
		alert("Please enter password");
		document.getElementById("cust_pass_edit").focus();
		return false;
	}
	
	if(document.getElementById("cust_name_edit").value=="")
	{
		alert("Please enter billing name");
		document.getElementById("cust_name_edit").focus();
		return false;
	}
	if(document.getElementById("cust_addr_edit").value=="")
	{
		alert("Please enter address");
		document.getElementById("cust_addr_edit").focus();
		return false;
	}
	if(document.getElementById("cust_phone_edit").value=="")
	{
		alert("Please enter phone no");
		document.getElementById("cust_phone_edit").focus();
		return false;
	}
	if(document.getElementById("cust_phone_edit").value!="")
	{
		if(isNaN(document.getElementById("cust_phone_edit").value))
		{
			alert("Phone number should be numeric");
			document.getElementById("cust_phone_edit").focus();
			return false;
		}
	}
	if(document.getElementById("cust_country_edit").value=="")
	{
		alert("Please enter country");
		document.getElementById("cust_country_edit").focus();
		return false;
	}
	if(document.getElementById("cust_city_edit").value=="")
	{
		alert("Please enter city name");
		document.getElementById("cust_city_edit").focus();
		return false;
	}
	if(document.getElementById("cust_state_edit").value=="")
	{
		alert("Please enter state");
		document.getElementById("cust_state_edit").focus();
		return false;
	}
	if(document.getElementById("shipp_name_edit").value=="")
	{
		alert("Please enter shipping name");
		document.getElementById("shipp_name_edit").focus();
		return false;
	}
	if(document.getElementById("shipp_addr_edit").value=="")
	{
		alert("Please enter address");
		document.getElementById("shipp_addr_edit").focus();
		return false;
	}
	if(document.getElementById("shipp_phone_edit").value=="")
	{
		alert("Please enter phone no");
		document.getElementById("shipp_phone_edit").focus();
		return false;
	}
	if(document.getElementById("shipp_phone_edit").value!="")
	{
		if(isNaN(document.getElementById("shipp_phone_edit").value))
		{
			alert("Phone number should be numeric");
			document.getElementById("shipp_phone_edit").focus();
			return false;
		}
	}
	if(document.getElementById("shipp_country_edit").value=="")
	{
		alert("Please enter country");
		document.getElementById("shipp_country_edit").focus();
		return false;
	}
	if(document.getElementById("shipp_city_edit").value=="")
	{
		alert("Please enter city name");
		document.getElementById("shipp_city_edit").focus();
		return false;
	}
	if(document.getElementById("shipp_state_edit").value=="")
	{
		alert("Please enter state");
		document.getElementById("shipp_state_edit").focus();
		return false;
	}
	
}
function val()
{
	
	if(document.getElementById("fname_add").value=="")
	{
		alert("Please enter first name");
		document.getElementById("fname_add").focus();
		return false;
	}
	if(document.getElementById("lname_add").value=="")
	{
		alert("Please enter last name");
		document.getElementById("lname_add").focus();
		return false;
	}
	.getElementById("phone_add").value=="")
	{
		alert("Please enter phone no");
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
	if(document.getElementById("email_add").value=="")
	{
		alert("Please enter email id");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("add_valid").value==1)
	{
		alert("This email id already exists");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("add_valid").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("addr_add").value=="")
	{
		alert("Please enter address");
		document.getElementById("addr_add").focus();
		return false;
	}
	if(document
	if(document.getElementById("country_add").value=="")
	{
		alert("Please enter country");
		document.getElementById("country_add").focus();
		return false;
	}
	
	if(document.getElementById("state_add").value=="")
	{
		alert("Please enter state");
		document.getElementById("state_add").focus();
		return false;
	}
	if(document.getElementById("city_add").value=="")
	{
		alert("Please enter city name");
		document.getElementById("city_add").focus();
		return false;
	}
	if(document.getElementById("pin_add").value=="")
	{
		alert("Please enter pincode");
		document.getElementById("pin_add").focus();
		return false;
	}
	
	
}
