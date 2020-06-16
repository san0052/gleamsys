function validate_register(){
	var email=$('#email');
	var password=$('#password');
	var repassword=$('#re_password');
	var name=$('#name');
	var contact=$('#contact');
	var address=$('#address');
	var country=$('#country');
	var state=$('#state');
	var city=$('#city');
	var zip=$('#zip');
	var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
 
	
	if(email.val()==''){
		alert('Please Enter Email Address');
		email.focus();
		return false;
	}
	if(!reg.test(email.val())){
		alert('Please Enter Valid Email Address');
		email.focus();
 		return false;
 	 }
	 if(password.val()==''){
		alert('Please Enter password');
		password.focus();
		return false;
	}
	if(repassword.val()==''){
		alert('Please Enter confirm password');
		repassword.focus();
		return false;
	}
	if(repassword.val()!=password.val()){
		alert('confirm password is mis-match');
		repassword.focus();
		return false;
		
	}
	if(name.val()==''){
		alert('Please Enter name');
		name.focus();
		return false;
	}
	if(contact.val()==''){
		alert('Please Enter contact number');
		name.focus();
		return false;
	}
	if(isNaN(contact.val())==true){
		alert('Contact number should contain only number');
		contact.focus();
		return false;
		
	}
	if(address.val()==''){
		alert('Please Enter Address');
		address.focus();
		return false;
	}
	if(country.val()==''){
		alert('Please Enter country');
		country.focus();
		return false;
	}
	if(state.val()==''){
		alert('Please Enter state');
		state.focus();
		return false;
	}
	if(city.val()==''){
		alert('Please Enter city');
		city.focus();
		return false;
	}
	if(zip.val()==''){
		alert('Please Enter zip code');
		zip.focus();
		return false;
	}
	if(isNaN(zip.val())==true){
		alert('zip code should contain only number');
		zip.focus();
		return false;
		
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
function forgot_pass_div(){
	///alert('forgat password');
	//$('#login_div').css('display','none');
	$('#forgat_div').css('display','block');
	
}		

function check_forgat(){
	var email=$('#email_forgat').val();
	$.ajax({
		url:"login_process.php?action=check_email&email="+email,
		success:function(result){
			if(result==0){
				alert('You enter wrong Email Address');
				$('#email_forgat').focus();
				return false;
			}
		}
	});
}
