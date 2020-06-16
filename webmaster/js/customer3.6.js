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
					http.open('get','customer_process.php?act='+act+'&email='+email);
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
					http.open('get','customer_process.php?act='+act+'&email='+email+'&id='+id);
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
function add_cust_val()
{
	
	if(document.getElementById("cust_email_add").value=="")
	{
		alert("Please enter email id");
		document.getElementById("cust_email_add").focus();
		return false;
	}
	if(document.getElementById("cust_add_valid").value==1)
	{
		alert("This email id already exists");
		document.getElementById("cust_email_add").focus();
		return false;
	}
	if(document.getElementById("cust_add_valid").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("cust_email_add").focus();
		return false;
	}
	
	if(document.getElementById("cust_pass_add").value=="")
	{
		alert("Please enter password");
		document.getElementById("cust_pass_add").focus();
		return false;
	}
	if(document.getElementById("cust_confpass_add").value=="")
	{
		alert("Please confirm your password");
		document.getElementById("cust_confpass_add").focus();
		return false;
	}
	if(document.getElementById("cust_pass_add").value!="" && document.getElementById("cust_confpass_add").value!="")
	{
		if(document.getElementById("cust_pass_add").value!=document.getElementById("cust_confpass_add").value)
		{
		alert("Password should be same");
		document.getElementById("cust_confpass_add").focus();
		return false;
		}
	}
	if(document.getElementById("cust_fname_add").value=="")
	{
		alert("Please enter customer first name");
		document.getElementById("cust_fname_add").focus();
		return false;
	}
	if(document.getElementById("cust_lname_add").value=="")
	{
		alert("Please enter customer last name");
		document.getElementById("cust_lname_add").focus();
		return false;
	}
	if(document.getElementById("cust_addr_add").value=="")
	{
		alert("Please enter address");
		document.getElementById("cust_addr_add").focus();
		return false;
	}
	if(document.getElementById("cust_phone_add").value=="")
	{
		alert("Please enter phone no");
		document.getElementById("cust_phone_add").focus();
		return false;
	}
	if(document.getElementById("cust_phone_add").value!="")
	{
		if(isNaN(document.getElementById("cust_phone_add").value))
		{
			alert("Phone number should be numeric");
			document.getElementById("cust_phone_add").focus();
			return false;
		}
	}
	if(document.getElementById("cust_country_add").value=="")
	{
		alert("Please enter country");
		document.getElementById("cust_country_add").focus();
		return false;
	}
	if(document.getElementById("cust_city_add").value=="")
	{
		alert("Please enter city name");
		document.getElementById("cust_city_add").focus();
		return false;
	}
	if(document.getElementById("cust_state_add").value=="")
	{
		alert("Please enter state");
		document.getElementById("cust_state_add").focus();
		return false;
	}
	if(document.getElementById("cust_pin_add").value=="")
	{
		alert("Please enter pincode");
		document.getElementById("cust_pin_add").focus();
		return false;
	}
	// Billing validation
	if(document.getElementById("bill_fname_add").value=="")
	{
		alert("Please enter billing name");
		document.getElementById("bill_fname_add").focus();
		return false;
	}
	if(document.getElementById("bill_lname_add").value=="")
	{
		alert("Please enter billing name");
		document.getElementById("bill_lname_add").focus();
		return false;
	}
	if(document.getElementById("bill_addr_add").value=="")
	{
		alert("Please enter address");
		document.getElementById("bill_addr_add").focus();
		return false;
	}
	if(document.getElementById("bill_phone_add").value=="")
	{
		alert("Please enter phone no");
		document.getElementById("bill_phone_add").focus();
		return false;
	}
	if(document.getElementById("bill_phone_add").value!="")
	{
		if(isNaN(document.getElementById("bill_phone_add").value))
		{
			alert("Phone number should be numeric");
			document.getElementById("bill_phone_add").focus();
			return false;
		}
	}
	if(document.getElementById("bill_country_add").value=="")
	{
		alert("Please enter country");
		document.getElementById("bill_country_add").focus();
		return false;
	}
	if(document.getElementById("shipp_city_add").value=="")
	{
		alert("Please enter city name");
		document.getElementById("bill_city_add").focus();
		return false;
	}
	if(document.getElementById("bill_state_add").value=="")
	{
		alert("Please enter state");
		document.getElementById("bill_state_add").focus();
		return false;
	}
	if(document.getElementById("bill_pin_add").value=="")
	{
		alert("Please enter pincode");
		document.getElementById("bill_pin_add").focus();
		return false;
	}
	
	//shipping validation
	
	if(document.getElementById("shipp_fname_add").value=="")
	{
		alert("Please enter shipping name");
		document.getElementById("shipp_fname_add").focus();
		return false;
	}
	if(document.getElementById("shipp_lname_add").value=="")
	{
		alert("Please enter shipping name");
		document.getElementById("shipp_lname_add").focus();
		return false;
	}
	if(document.getElementById("shipp_addr_add").value=="")
	{
		alert("Please enter address");
		document.getElementById("shipp_addr_add").focus();
		return false;
	}
	if(document.getElementById("shipp_phone_add").value=="")
	{
		alert("Please enter phone no");
		document.getElementById("shipp_phone_add").focus();
		return false;
	}
	if(document.getElementById("shipp_phone_add").value!="")
	{
		if(isNaN(document.getElementById("shipp_phone_add").value))
		{
			alert("Phone number should be numeric");
			document.getElementById("shipp_phone_add").focus();
			return false;
		}
	}
	if(document.getElementById("shipp_country_add").value=="")
	{
		alert("Please enter country");
		document.getElementById("shipp_country_add").focus();
		return false;
	}
	if(document.getElementById("shipp_city_add").value=="")
	{
		alert("Please enter city name");
		document.getElementById("shipp_city_add").focus();
		return false;
	}
	if(document.getElementById("shipp_state_add").value=="")
	{
		alert("Please enter state");
		document.getElementById("shipp_state_add").focus();
		return false;
	}
	if(document.getElementById("shipp_pin_add").value=="")
	{
		alert("Please enter pincode");
		document.getElementById("shipp_pin_add").focus();
		return false;
	}
	
}
function fill_state()
{
	//alert(document.getElementById("bill_state_add").value);
	document.getElementById("shipp_state_add").value=document.getElementById("bill_state_add").value;
}
function fill_city()
{
	document.getElementById("shipp_city_add").value=document.getElementById("bill_city_add").value;
}

function fill_same()
	{
		if(document.getElementById("shipp_details").checked==true)
		{
			document.getElementById("shipp_fname_add").value=document.getElementById("bill_fname_add").value;
			document.getElementById("shipp_lname_add").value=document.getElementById("bill_lname_add").value;
			document.getElementById("shipp_addr_add").value=document.getElementById("bill_addr_add").value;
			document.getElementById("shipp_phone_add").value=document.getElementById("bill_phone_add").value;
			document.getElementById("shipp_country_add").value=document.getElementById("bill_country_add").value;
			getstate_shipp(document.getElementById("shipp_country_add").value);	
			setTimeout("fill_state()",400);
			
			getcity_shipp(document.getElementById("bill_state_add").value);
			setTimeout("fill_city()",400);
			
			//document.getElementById("shipp_state_add").value=document.getElementById("bill_state_add").value;
			//document.getElementById("shipp_city_add").value=document.getElementById("bill_city_add").value;
			document.getElementById("shipp_pin_add").value=document.getElementById("bill_pin_add").value;
		}
		else
		{
			document.getElementById("shipp_fname_add").value="";
			document.getElementById("shipp_lname_add").value="";
			document.getElementById("shipp_addr_add").value="";
			document.getElementById("shipp_phone_add").value="";
			document.getElementById("shipp_country_add").value="";
			document.getElementById("shipp_city_add").value="";
			document.getElementById("shipp_state_add").value="";
			document.getElementById("shipp_pin_add").value="";
		}
	}
	function fill_state1()
	{
		//alert(document.getElementById("bill_state_add").value);
		document.getElementById("shipp_state_edit").value=document.getElementById("bill_state_edit").value;
	}
	function fill_city1()
	{
		//alert(document.getElementById("bill_city_edit").value);
		document.getElementById("shipp_city_edit").value=document.getElementById("bill_city_edit").value;
	}
	function fill_sameedit()
	{
		if(document.getElementById("shipp_edit_details").checked==true)
		{
			
			document.getElementById("shipp_fname_edit").value=document.getElementById("bill_fname_edit").value;
			document.getElementById("shipp_lname_edit").value=document.getElementById("bill_lname_edit").value;
			document.getElementById("shipp_addr_edit").value=document.getElementById("bill_addr_edit").value;
			document.getElementById("shipp_phone_edit").value=document.getElementById("bill_phone_edit").value;
			document.getElementById("shipp_country_edit").value=document.getElementById("bill_country_edit").value;
			getstate_edit3(document.getElementById("shipp_country_edit").value);	
			setTimeout("fill_state1()",400);
			
			getcity_edit3(document.getElementById("bill_state_edit").value);
			setTimeout("fill_city1()",400);
			//document.getElementById("shipp_city_edit").value=document.getElementById("bill_city_edit").value;
			//document.getElementById("shipp_state_edit").value=document.getElementById("bill_state_edit").value;
			document.getElementById("shipp_pin_edit").value=document.getElementById("bill_pin_edit").value;
		}
		else
		{
			document.getElementById("shipp_fname_edit").value="";
			document.getElementById("shipp_lname_edit").value="";
			document.getElementById("shipp_addr_edit").value="";
			document.getElementById("shipp_phone_edit").value="";
			document.getElementById("shipp_country_edit").value="";
			document.getElementById("shipp_city_edit").value="";
			document.getElementById("shipp_state_edit").value="";
			document.getElementById("shipp_pin_edit").value="";
		}
	}
	
	function checkpass(pass)
	{
		if(document.getElementById("cust_confpass_add").value!=document.getElementById("cust_pass_add").value)
		{
			document.getElementById("pass_notsame_add").style.display='inline';
			document.getElementById("pass_same_add").style.display='none';
		}
		if(document.getElementById("cust_confpass_add").value==document.getElementById("cust_pass_add").value)
		{
			document.getElementById("pass_notsame_add").style.display='none';
			document.getElementById("pass_same_add").style.display='inline';
		}
		if(document.getElementById("cust_confpass_add").value=="" || document.getElementById("cust_pass_add").value=="")
		{
			document.getElementById("pass_notsame_add").style.display='none';
			document.getElementById("pass_same_add").style.display='none';
		}
	}
	
	function getstate_cust(id)
{
	
	var cty='<select name=\"cust_city_add\" id=\"cust_city_add\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select City</option></select>';
	var st='<select name=\"cust_state_add\" id=\"cust_state_add\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select State</option></select>';
	if(id!="")
	{
		
		document.getElementById("cust_city").innerHTML = '';
		document.getElementById("cust_city").innerHTML = cty;
		var act='cust_getstate';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestatecust;
		http.send(null);
	}
	else
	{
		document.getElementById("cust_state").innerHTML = '';
		document.getElementById("cust_state").innerHTML = st;
		document.getElementById("cust_city").innerHTML = '';
		document.getElementById("cust_city").innerHTML = cty;
	}
}
function handleResponsestatecust() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		
		document.getElementById("cust_state").innerHTML = '';
		document.getElementById("cust_state").innerHTML = response;
	}
}
}
function getcity_cust(id)
{
	
	if(id!="")
	{
		var act='getcity_cust';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsecitycust;
		http.send(null);
	}
	else
	{
		alert("Please select country");
	}
}

function handleResponsecitycust() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		if(response!=0)
		{
		document.getElementById("cust_city").innerHTML = '';
		document.getElementById("cust_city").innerHTML = response;
		}
		
	}
}
}

function getstate_bill(id)
{
	
	var cty='<select name=\"bill_city_add\" id=\"bill_city_add\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select City</option></select>';
	var st='<select name=\"bill_state_add\" id=\"bill_state_add\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select State</option></select>';
	if(id!="")
	{
		
		document.getElementById("bill_city").innerHTML = '';
		document.getElementById("bill_city").innerHTML = cty;
		var act='bill_getstate';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestatebill;
		http.send(null);
	}
	else
	{
		document.getElementById("bill_state").innerHTML = '';
		document.getElementById("bill_state").innerHTML = st;
		document.getElementById("bill_city").innerHTML = '';
		document.getElementById("bill_city").innerHTML = cty;
	}
}
function handleResponsestatebill() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		
		document.getElementById("bill_state").innerHTML = '';
		document.getElementById("bill_state").innerHTML = response;
	}
}
}
function getcity_bill(id)
{
	
	if(id!="")
	{
		var act='getcity_bill';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsecitybill;
		http.send(null);
	}
	else
	{
		alert("Please select country");
	}
}

function handleResponsecitybill() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		if(response!=0)
		{
		document.getElementById("bill_city").innerHTML = '';
		document.getElementById("bill_city").innerHTML = response;
		}
		
	}
}
}

function getstate_shipp(id)
{
	
	var cty='<select name=\"shipp_city_add\" id=\"shipp_city_add\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select City</option></select>';
	var st='<select name=\"shipp_state_add\" id=\"shipp_state_add\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select State</option></select>';
	if(id!="")
	{
		
		document.getElementById("shipp_city").innerHTML = '';
		document.getElementById("shipp_city").innerHTML = cty;
		var act='shipp_getstate';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestateshipp;
		http.send(null);
	}
	else
	{
		document.getElementById("shipp_state").innerHTML = '';
		document.getElementById("shipp_state").innerHTML = st;
		document.getElementById("shipp_city").innerHTML = '';
		document.getElementById("shipp_city").innerHTML = cty;
	}
}
function handleResponsestateshipp() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		
		document.getElementById("shipp_state").innerHTML = '';
		document.getElementById("shipp_state").innerHTML = response;
	}
}
}
function getcity_shipp(id)
{
	
	if(id!="")
	{
		var act='getcity_shipp';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsecityshipp;
		http.send(null);
	}
	else
	{
		alert("Please select country");
	}
}

function handleResponsecityshipp() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		if(response!=0)
		{
		document.getElementById("shipp_city").innerHTML = '';
		document.getElementById("shipp_city").innerHTML = response;
		}
		
	}
}
}


//Country state and city
function getstate_edit1(id)
{
	//alert("12345");
	var city='<select name=\"cust_city_edit\" id=\"cust_city_edit\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select City</option></select>';
	if(id!="")
	{
		document.getElementById("cust_city1").innerHTML = '';
		document.getElementById("cust_city1").innerHTML = city;
		var act='getstate_edit1';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestateedit1;
		http.send(null);
	}
	
}

function handleResponsestateedit1() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		
		document.getElementById("cust_state1").innerHTML = '';
		document.getElementById("cust_state1").innerHTML = response;
		
	}
}
}

function getcity_edit1(id)
{
	
	if(id!="")
	{
		var act='getcity_edit1';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsecityedit1;
		http.send(null);
	}
	else
	{
		alert("Please select country");
	}
}

function handleResponsecityedit1() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{		
		document.getElementById("cust_city1").innerHTML = '';
		document.getElementById("cust_city1").innerHTML = response;		
		
	}
}
}

function getstate_edit2(id)
{
	//alert("12345");
	var city='<select name=\"bill_city_edit\" id=\"bill_city_edit\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select City</option></select>';
	if(id!="")
	{
		document.getElementById("bill_city2").innerHTML = '';
		document.getElementById("bill_city2").innerHTML = city;
		var act='getstate_edit2';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestateedit2;
		http.send(null);
	}
	
}

function handleResponsestateedit2() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		
		document.getElementById("bill_state2").innerHTML = '';
		document.getElementById("bill_state2").innerHTML = response;
		
	}
}
}

function getcity_edit2(id)
{
	
	if(id!="")
	{
		var act='getcity_edit2';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsecityedit2;
		http.send(null);
	}
	else
	{
		alert("Please select country");
	}
}

function handleResponsecityedit2() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{		
		document.getElementById("bill_city2").innerHTML = '';
		document.getElementById("bill_city2").innerHTML = response;		
		
	}
}
}

function getstate_edit3(id)
{
	//alert("12345");
	var city='<select name=\"shipp_city_edit\" id=\"shipp_city_edit\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select City</option></select>';
	if(id!="")
	{
		document.getElementById("shipp_city2").innerHTML = '';
		document.getElementById("shipp_city2").innerHTML = city;
		var act='getstate_edit3';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestateedit3;
		http.send(null);
	}
	
}

function handleResponsestateedit3() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{
		
		document.getElementById("shipp_state2").innerHTML = '';
		document.getElementById("shipp_state2").innerHTML = response;
		
	}
}
}

function getcity_edit3(id)
{
	//alert("12345");
	if(id!="")
	{
		var act='getcity_edit3';
		http.open('get','customer_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsecityedit3;
		http.send(null);
	}
	else
	{
		alert("Please select country");
	}
}

function handleResponsecityedit3() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	if(response!="")
	{		
		document.getElementById("shipp_city2").innerHTML = '';
		document.getElementById("shipp_city2").innerHTML = response;		
		
	}
}
}
		