function check_emailtrial(email)
{
			
			if(email!="")
			{
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!filter.test(email))
				{
						document.getElementById("invalid_add").style.display = 'inline';
						document.getElementById("exists_add").style.display='none';
						document.getElementById("notexists_add").style.display='none';
						document.getElementById("trial_add_valid").value=2;
				}
				else
				{
					var act='check_emailadd';
					http.open('get','free_trial_process.php?act='+act+'&email='+email);
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
					document.getElementById("trial_add_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
					document.getElementById("notexists_add").style.display='inline';
				 	document.getElementById("exists_add").style.display='none';
					document.getElementById("invalid_add").style.display = 'none';
					document.getElementById("trial_add_valid").value=0;
				 }
			  }
		   }
		}
		
	  function check_emailtrial_edit(email,id)	{
			
			if(email!="")
			{
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!filter.test(email))
				{
						document.getElementById("invalid_edit").style.display = 'inline';
						document.getElementById("exists_edit").style.display='none';
						document.getElementById("notexists_edit").style.display='none';
						document.getElementById("same_edit").style.display='none';
						document.getElementById("trial_edit_valid").value=2;
				}
				else
				{
					var act='check_emailedit';
					http.open('get','free_trial_process.php?act='+act+'&email='+email+'&id='+id);
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
					document.getElementById("trial_edit_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
				 	
					document.getElementById("notexists_edit").style.display='inline';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("same_edit").style.display='none';
					document.getElementById("invalid_edit").style.display = 'none';
					document.getElementById("trial_edit_valid").value=0;
				 }
				 if(response==2)
				 {
				 	//alert(response);
				 	document.getElementById("same_edit").style.display='inline';
					document.getElementById("notexists_edit").style.display='none';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("invalid_edit").style.display = 'none';
					document.getElementById("trial_edit_valid").value=0;
				 }
			  }
		   }
		}
		
		

function trial_form()
{
	if(document.getElementById("name_add").value=="")
	{
		alert("Please enter name");
		document.getElementById("name_add").focus();
		return false;
	}
	if(document.getElementById("phone_add").value=="")
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
	if(document.getElementById("trial_add_valid").value==1)
	{
		alert("This email id already exists");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("trial_add_valid").value==2)
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
	
	if(document.getElementById("country_add").value=="")
	{
		alert("Please enter country");
		document.getElementById("country_add").focus();
		return false;
	}
	if(document.getElementById("city_add").value=="")
	{
		alert("Please enter city name");
		document.getElementById("city_add").focus();
		return false;
	}
	if(document.getElementById("state_add").value=="")
	{
		alert("Please enter state");
		document.getElementById("state_add").focus();
		return false;
	}
	if(document.getElementById("pin_add").value=="")
	{
		alert("Please enter pincode");
		document.getElementById("pin_add").focus();
		return false;
	}
	
}
function trial_edit()
{
	if(document.getElementById("name_edit").value=="")
	{
		alert("Please enter name");
		document.getElementById("name_edit").focus();
		return false;
	}
	if(document.getElementById("phone_edit").value=="")
	{
		alert("Please enter phone no");
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
	if(document.getElementById("email_edit").value=="")
	{
		alert("Please enter email id");
		document.getElementById("email_edit").focus();
		return false;
	}
	if(document.getElementById("trial_edit_valid").value==1)
	{
		alert("This email id already exists");
		document.getElementById("email_edit").focus();
		return false;
	}
	if(document.getElementById("trial_edit_valid").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("email_add").focus();
		return false;
	}
	
	if(document.getElementById("addr_edit").value=="")
	{
		alert("Please enter address");
		document.getElementById("addr_edit").focus();
		return false;
	}
	
	if(document.getElementById("country_edit").value=="")
	{
		alert("Please enter country");
		document.getElementById("country_edit").focus();
		return false;
	}
	if(document.getElementById("city_edit").value=="")
	{
		alert("Please enter city name");
		document.getElementById("city_edit").focus();
		return false;
	}
	if(document.getElementById("state_edit").value=="")
	{
		alert("Please enter state");
		document.getElementById("state_edit").focus();
		return false;
	}
	if(document.getElementById("pin_edit").value=="")
	{
		alert("Please enter pincode");
		document.getElementById("pin_edit").focus();
		return false;
	}
	
}

function getstate(id)
{
	
	var cty='<select name=\"city_add\" id=\"city_add\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select City</option></select>';
	var st='<select name=\"state_add\" id=\"state_add\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select State</option></select>';
	if(id!="")
	{
		
		document.getElementById("city").innerHTML = '';
		document.getElementById("city").innerHTML = cty;
		var act='getstate';
		http.open('get','free_trial_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestate;
		http.send(null);
	}
	else
	{
		document.getElementById("state").innerHTML = '';
		document.getElementById("state").innerHTML = st;
		document.getElementById("city").innerHTML = '';
		document.getElementById("city").innerHTML = cty;
	}
}

function handleResponsestate() {
if(http.readyState == 4 && http.status == 200)
{
	
	var response = http.responseText;
	if(response!="")
	{
		document.getElementById("state").innerHTML = '';
		document.getElementById("state").innerHTML = response;
	}
}
}

function getcity(id)
{
	
	if(id!="")
	{
		var act='getcity';
		http.open('get','free_trial_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsecity;
		http.send(null);
	}
	else
	{
		alert("Please select country");
	}
}

function handleResponsecity() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		if(response!=0)
		{
		document.getElementById("city").innerHTML = '';
		document.getElementById("city").innerHTML = response;
		}
		
	}
}
}

function getstate_edit(id)
{
	var city='<select name=\"city_edit\" id=\"city_edit\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select City</option></select>';
	if(id!="")
	{
		document.getElementById("city1").innerHTML = '';
		document.getElementById("city1").innerHTML = city;
		var act='getstate_edit';
		http.open('get','free_trial_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestateedit;
		http.send(null);
	}
	
}

function handleResponsestateedit() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		
		document.getElementById("state1").innerHTML = '';
		document.getElementById("state1").innerHTML = response;
		
	}
}
}

function getcity_edit(id)
{
	
	if(id!="")
	{
		var act='getcity_edit';
		http.open('get','free_trial_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsecityedit;
		http.send(null);
	}
	else
	{
		alert("Please select country");
	}
}

function handleResponsecityedit() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		
		document.getElementById("city1").innerHTML = '';
		document.getElementById("city1").innerHTML = response;
		
		
	}
}
}
	
	