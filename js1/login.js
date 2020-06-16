//for register
function add_cust_val()
{
	alert("Hi");
	if(document.getElementById("cust_email_add").value=="")
	{
		alert("Please enter email address");
		document.getElementById("cust_email_add").focus();
		return false;
	}
	if(document.getElementById("cust_add_valid").value==1)
	{
		alert("This email address already exists");
		document.getElementById("cust_email_add").focus();
		return false;
	}
	if(document.getElementById("cust_add_valid").value==2)
	{
		alert("This email address is invalid");
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
	if(document.getElementById("cust_name_add").value==""){
			alert('Please insert your Name');
			document.getElementById("cust_name_add").focus();
			return false;
	}
	if(document.getElementById("phone").value==""){
			alert('Please insert your contact number');
			document.getElementById("phone").focus();
			return false;
	}
		if(isNaN(document.getElementById("phone").value)){
			alert('Contact No Must Be Numeric');
			document.getElementById("phone").value="";
			document.getElementById("phone").focus();
			return false;
	}
	if(document.getElementById("shippingAddress1").value==""){
			alert('Please insert your shipping address');
			document.getElementById("shippingAddress1").focus();
			return false;
	}
		if(document.getElementById("countryId").value==0){
			alert('Please Select your country');
			document.getElementById("countryId").focus();
			return false;
	}
		if(document.getElementById("state").value==""){
			alert('Please insert your state');
			document.getElementById("state").focus();
			return false;
	}
		if(document.getElementById("city").value==""){
			alert('Please Select your city');
			document.getElementById("city").focus();
			return false;
	}
		if(document.getElementById("zip").value==""){
			alert('Please insert your zip code');
			document.getElementById("zip").focus();
			return false;
	}
		
	document.reg.submit();
	return true;
	
	
}

function login_cust_val()
{
	//alert('1111');
	if(document.getElementById("cust_email").value=="")
	{
		alert("Please enter email address");
		document.getElementById("cust_email").focus();
		return false;
	}
	
	
	if(document.getElementById("cust_pass").value=="")
	{
		alert("Please enter password");
		document.getElementById("cust_pass").focus();
		return false;
	}	
}

function pass_cust_val()
{
	if(document.getElementById("pass_recovery_mail").value=="")
	{
		alert("Please enter email address");
		document.getElementById("pass_recovery_mail").focus();
		return false;
	}
	if(document.getElementById("pass_recovery_mail").value!=""){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(document.getElementById("pass_recovery_mail").value))
	{
		alert("Please enter valid email address");
		document.getElementById("pass_recovery_mail").focus();
		return false;
	}
	else{
	$.ajax({
	type: "POST",
	url: "login_process.php",
	data: "action=recovery&email="+document.getElementById("pass_recovery_mail").value

}).done(function( msg ) {
document.getElementById("recovery_msg").innerHTML='';
document.getElementById("recovery_msg").innerHTML=msg;
});
	document.getElementById("pass_recovery_mail").value='';
	setTimeout("close_recovery_msgs()",8000);
	}
	}
}
	
function close_recovery_msgs()
{
	document.getElementById("recovery_msg").innerHTML='';
	document.getElementById("pass_recovery_mail").value='';
	//document.getElementById('recovery_divs').style.display='none';
}
function forgot_pass_div()
{
	document.getElementById("recovery_msg").innerHTML='';
	document.getElementById("pass_recovery_mail").value='';
	document.getElementById('recovery_divs').style.display='block';
}
function close_forgot_pass_div()
{
	document.getElementById('recovery_divs').style.display='none';
}
function checkpass1(pass)
	{ 
	//alert(pass);
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
	
function check_emailadd1(email)	{
			//alert('111');
			if(email!="")
			{
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!filter.test(email))
				{
					//alert('kkkk');
						document.getElementById("invalid_add").style.display = 'inline';
						document.getElementById("exists_add").style.display='none';
						document.getElementById("notexists_add").style.display='none';
						document.getElementById("cust_add_valid").value=2;
				}
				else
				{
					//alert('llllll');
					var act='check_emailadd';
					//alert('8888');
					http.open('get','login_process.php?action='+act+'&email='+email);
					//alert('ppppp');
					http.onreadystatechange = handleResponseEmailAdd;
					//alert('7777');
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
			  //alert('response');
			  if(response!="")
			  {
				   //alert(response);
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
