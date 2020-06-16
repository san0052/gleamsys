function check_emailadd(email)	{
			
			if(email!="")
			{
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!filter.test(email))
				{
						document.getElementById("invalid_add").style.display = 'inline';
						document.getElementById("exists_add").style.display='none';
						document.getElementById("notexists_add").style.display='none';
						document.getElementById("add_valid").value=2;
				}
				else
				{
					var act='check_emailadd';
					http.open('get','hotel_process.php?act='+act+'&email='+email);
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
					document.getElementById("add_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
					document.getElementById("notexists_add").style.display='inline';
				 	document.getElementById("exists_add").style.display='none';
					document.getElementById("invalid_add").style.display = 'none';
					document.getElementById("add_valid").value=0;
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
						document.getElementById("edit_valid").value=2;
				}
				else
				{
					var act='check_emailedit';
					http.open('get','hotel_process.php?act='+act+'&email='+email+'&id='+id);
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
					document.getElementById("edit_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
				 	
					document.getElementById("notexists_edit").style.display='inline';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("same_edit").style.display='none';
					document.getElementById("invalid_edit").style.display = 'none';
					document.getElementById("edit_valid").value=0;
				 }
				 if(response==2)
				 {
				 	//alert(response);
				 	document.getElementById("same_edit").style.display='inline';
					document.getElementById("notexists_edit").style.display='none';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("invalid_edit").style.display = 'none';
					document.getElementById("edit_valid").value=0;
				 }
			  }
		   }
		}
		
		

function add_val()
{
	
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
	if(document.getElementById("pass_add").value=="")
	{
		alert("Please enter password");
		document.getElementById("pass_add").focus();
		return false;
	}
	if(document.getElementById("confpass_add").value=="")
	{
		alert("Please confirm your password");
		document.getElementById("confpass_add").focus();
		return false;
	}
	
	if(document.getElementById("pass_add").value!="" && document.getElementById("confpass_add").value!="")
	{
		if(document.getElementById("pass_add").value != document.getElementById("confpass_add").value!="")
		{
			alert("Password should be same");
			document.getElementById("confpass_add").focus();
			return false;
		}
	}
	
	
	
	if(document.getElementById("name_add").value=="")
	{
		alert("Please enter hotel's name");
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
	if(document.getElementById("pin_add").value!="")
	{
		if(isNaN(document.getElementById("pin_add").value))
		{
			alert("Pin code should be numeric");
			document.getElementById("pin_add").focus();
			return false;
		}
	}
	if(document.getElementById("website_add").value=="")
	{
		alert("Please enter website");
		document.getElementById("website_add").focus();
		return false;
	}
	if(document.getElementById("website_add").value!="")
	{
		 var str=document.getElementById("website_add").value;
		  var htt="http://";
		   var dot=".";
		   var lstr=str.length;
		   var ldot=str.indexOf(dot);
		   if (str.indexOf(htt)==-1){
		 alert("Invalid Website");
		 document.getElementById("website_add").focus();
		 return false;
		   }
			if (str.indexOf(htt)!=0){
		 alert("Invalid Website");
		 document.getElementById("website_add").focus();
		 return false;
		   }
			if (str.lastIndexOf(htt)!=0){
		 alert("Invalid Website");
		 document.getElementById("website_add").focus();
		 return false;
		   }
		   if (str.indexOf(" ")!=-1){
		  alert("Invalid Website");
		   document.getElementById("website_add").focus();
		  return false;
		}
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		 alert("Invalid Website");
		   document.getElementById("website_add").focus();
		  return false;
		   }
	}
	if(document.getElementById("maxpeople_add").value=="")
	{
		alert("Please enter Maximum no of people");
		document.getElementById("maxpeople_add").focus();
		return false;
	}
	
	if((document.getElementById("ten").checked==false) && (document.getElementById("eleven").checked==false) && (document.getElementById("meal").checked==false) && (document.getElementById("discount").checked==false))
	{
		alert("Please select offer");
		
		return false;
	}
	if(document.getElementById("price_add").value=="")
	{
		alert("Please enter price");
		document.getElementById("price_add").focus();
		return false;
	}
}
function val_edit()
{
	
	if(document.getElementById("email_edit").value=="")
	{
		alert("Please enter email id");
		document.getElementById("email_edit").focus();
		return false;
	}
	if(document.getElementById("edit_valid").value==1)
	{
		alert("This email id already exists");
		document.getElementById("email_edit").focus();
		return false;
	}
	if(document.getElementById("edit_valid").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("email_edit").focus();
		return false;
	}
	if(document.getElementById("pass_edit").value=="")
	{
		alert("Please enter password");
		document.getElementById("pass_edit").focus();
		return false;
	}
	if(document.getElementById("confpass_edit").value=="")
	{
		alert("Please confirm your password");
		document.getElementById("confpass_edit").focus();
		return false;
	}
	
	if(document.getElementById("pass_edit").value!="" && document.getElementById("confpass_edit").value!="")
	{
		if(document.getElementById("pass_edit").value != document.getElementById("confpass_edit").value!="")
		{
			alert("Password should be same");
			document.getElementById("confpass_edit").focus();
			return false;
		}
	}
	if(document.getElementById("name_edit").value=="")
	{
		alert("Please enter hotel's name");
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
	
	if(document.getElementById("state_edit").value=="")
	{
		alert("Please enter state");
		document.getElementById("state_edit").focus();
		return false;
	}
	if(document.getElementById("city_edit").value=="")
	{
		alert("Please enter city name");
		document.getElementById("city_edit").focus();
		return false;
	}
	if(document.getElementById("pin_edit").value=="")
	{
		alert("Please enter pincode");
		document.getElementById("pin_edit").focus();
		return false;
	}
	if(document.getElementById("pin_edit").value!="")
	{
		if(isNaN(document.getElementById("pin_edit").value))
		{
			alert("Pin Code should be numeric");
			document.getElementById("pin_edit").focus();
			return false;
		}
	}
	if(document.getElementById("website_edit").value=="")
	{
		alert("Please enter website");
		document.getElementById("website_edit").focus();
		return false;
	}
	if(document.getElementById("website_edit").value!="")
	{
		 var str=document.getElementById("website_edit").value;
		  var htt="http://";
		   var dot=".";
		   var lstr=str.length;
		   var ldot=str.indexOf(dot);
		   if (str.indexOf(htt)==-1){
		 alert("Invalid Website");
		 document.getElementById("website_edit").focus();
		 return false;
		   }
			if (str.indexOf(htt)!=0){
		 alert("Invalid Website");
		 document.getElementById("website_edit").focus();
		 return false;
		   }
			if (str.lastIndexOf(htt)!=0){
		 alert("Invalid Website");
		 document.getElementById("website_edit").focus();
		 return false;
		   }
		   if (str.indexOf(" ")!=-1){
		  alert("Invalid Website");
		   document.getElementById("website_edit").focus();
		  return false;
		}
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		 alert("Invalid Website");
		   document.getElementById("website_edit").focus();
		  return false;
		   }
	}
	if(document.getElementById("maxpeople_edit").value=="")
	{
		alert("Please enter Maximum no of people");
		document.getElementById("maxpeople_edit").focus();
		return false;
	}
	
	if(document.getElementById("ten").checked==false && document.getElementById("eleven").checked==false && document.getElementById("meal_edit").checked==false && document.getElementById("discount_edit").checked==false)
	{
		alert("Please select offer");
		
		return false;
	}
	if(document.getElementById("price_edit").value=="")
	{
		alert("Please enter price");
		document.getElementById("price_edit").focus();
		return false;
	}
}

function checkwebsite_add(link)
{
	if(link!="")
	{
	 var str=link;
	  var htt="http://";
	   var dot=".";
	   var lstr=str.length;
	   var ldot=str.indexOf(dot);
	   var a=0;
	   if (str.indexOf(htt)==-1){
	 document.getElementById("invalidlink_add").style.display='inline';
	 document.getElementById("validlink_add").style.display='none';
	 a=1;
	
	   }
		if (str.indexOf(htt)!=0){
			 a=1;
	document.getElementById("invalidlink_add").style.display='inline';
	 document.getElementById("validlink_add").style.display='none';
	   }
		if (str.lastIndexOf(htt)!=0){
			 a=1;
	 document.getElementById("invalidlink_add").style.display='inline';
	  document.getElementById("validlink_add").style.display='none';
	   }
	   if (str.indexOf(" ")!=-1){
		    a=1;
	 document.getElementById("invalidlink_add").style.display='inline';
	  document.getElementById("validlink_add").style.display='none';
	}
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		 a=1;
	 document.getElementById("invalidlink_add").style.display='inline';
	  document.getElementById("validlink_add").style.display='none';
	   }
	   if(a==0)
	   {
		   document.getElementById("invalidlink_add").style.display='none';
	  	document.getElementById("validlink_add").style.display='inline';
	   }
	}
	else
	{
		 document.getElementById("invalidlink_add").style.display='none';
	  	document.getElementById("validlink_add").style.display='none';
	}

}
function checkwebsite_edit(link)
{
	if(link!="")	
	{
		
	 var str=link;
	  var htt="http://";
	   var dot=".";
	   var lstr=str.length;
	   var ldot=str.indexOf(dot);
	   var a=0;
	   if (str.indexOf(htt)==-1){
	 document.getElementById("invalidlink_edit").style.display='inline';
	 document.getElementById("validlink_edit").style.display='none';
	 a=1;
	
	   }
		if (str.indexOf(htt)!=0){
			 a=1;
	document.getElementById("invalidlink_edit").style.display='inline';
	 document.getElementById("validlink_edit").style.display='none';
	   }
		if (str.lastIndexOf(htt)!=0){
			 a=1;
	 document.getElementById("invalidlink_edit").style.display='inline';
	  document.getElementById("validlink_edit").style.display='none';
	   }
	   if (str.indexOf(" ")!=-1){
		    a=1;
	 document.getElementById("invalidlink_edit").style.display='inline';
	  document.getElementById("validlink_edit").style.display='none';
	}
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		 a=1;
	 document.getElementById("invalidlink_edit").style.display='inline';
	  document.getElementById("validlink_edit").style.display='none';
	   }
	   if(a==0)
	   {
		   document.getElementById("invalidlink_edit").style.display='none';
	  	document.getElementById("validlink_edit").style.display='inline';
	   }
	}
	else
	{
		 document.getElementById("invalidlink_edit").style.display='none';
	  	document.getElementById("validlink_edit").style.display='none';
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
		http.open('get','hotel_process.php?act='+act+'&id='+id);
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
		http.open('get','hotel_process.php?act='+act+'&id='+id);
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
		http.open('get','hotel_process.php?act='+act+'&id='+id);
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
		http.open('get','hotel_process.php?act='+act+'&id='+id);
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
		