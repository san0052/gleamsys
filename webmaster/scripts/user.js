function val1()
{
	if(document.getElementById("fname1").value=="")
	{
		alert("Please enter first name");
		document.getElementById("fname1").focus();
		return false;
	}
	if(document.getElementById("lname1").value=="")
	{
		alert("Please enter last name");
		document.getElementById("lname1").focus();
		return false;
	}
	if(document.getElementById("email_add").value=="")
	{
		alert("Please enter email id");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("valid_add").value==1)
	{
		alert("This email id already exists");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("valid_add").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("city1").value=="")
	{
		alert("Please enter city");
		document.getElementById("city1").focus();
		return false;
	}	
	if(document.getElementById("state1").value=="")
	{
		alert("Please enter state");
		document.getElementById("state1").focus();
		return false;
	}
	if(document.getElementById("address1").value=="")
	{
		alert("Please enter address");
		document.getElementById("address1").focus();
		return false;
	}
	if(document.getElementById("zip1").value=="")
	{
		alert("Please enter  value for zip code");
		document.getElementById("zip1").focus();
		return false;
	}
	if(document.getElementById("zip1").value!="" && isNaN(document.getElementById("zip1").value))
	{
		alert("Please enter numeric value for zip code");
		document.getElementById("zip1").focus();
		return false;
	}
if(document.getElementById("mobile1").value=="" )
	{
		alert("Please enter value for mobile number");
		document.getElementById("mobile1").focus();
		return false;
	}
	if(document.getElementById("mobile1").value!="" && isNaN(document.getElementById("mobile1").value))
	{
		alert("Please enter numeric value for mobile number");
		document.getElementById("mobile1").focus();
		return false;
	}
	if(document.getElementById("phone").value!="" && isNaN(document.getElementById("phone").value))
	{
		alert("Please enter numeric value for phone");
		document.getElementById("phone").focus();
		return false;
	}

}
function check_emailadd(email)
{

	if(email!="")
	{
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		//alert(filter.test(email));
		if (!filter.test(email))
		{
			document.getElementById("invalid_add").style.display = 'inline';
			document.getElementById("exists_add").style.display='none';
			document.getElementById("notexists_add").style.display='none';
			document.getElementById("valid_add").value=2;
		}
		else
		{
			var act='addexist';
			//alert('user_process.php?act='+act+'&email='+email);
			http.open('get','user_process.php?act='+act+'&email='+email);
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
			document.getElementById("valid_add").value=1;
		}
		 if(response==0)
		 {
			//alert(response);
			document.getElementById("notexists_add").style.display='inline';
			document.getElementById("exists_add").style.display='none';
			document.getElementById("invalid_add").style.display = 'none';
			document.getElementById("valid_add").value=0;
		}
	}
	}
}

function check_emailedit(email)
{

	if(email!="")
	{
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		//alert(filter.test(email));
		if (!filter.test(email))
		{
			document.getElementById("invalid_add").style.display = 'inline';
			document.getElementById("exists_add").style.display='none';
			document.getElementById("notexists_add").style.display='none';
			document.getElementById("same_edit").style.display = 'none';
			document.getElementById("valid_add").value=2;
		}
		else
		{
			if(document.getElementById("emailors").value==email){
				document.getElementById("exists_add").style.display='none';
				document.getElementById("notexists_add").style.display='none';
				document.getElementById("invalid_add").style.display = 'none';
				document.getElementById("same_edit").style.display = 'inline';
				document.getElementById("valid_add").value=0;
			}
			else{
			var act='addexist';
			//alert('user_process.php?act='+act+'&email='+email);
			http.open('get','user_process.php?act='+act+'&email='+email);
			http.onreadystatechange = handleResponseEmailedit;
			http.send(null);
			}
		}
	}
	else
	{
		document.getElementById("exists_add").style.display='none';
		document.getElementById("notexists_add").style.display='none';
		document.getElementById("invalid_add").style.display = 'none';
		document.getElementById("same_edit").style.display = 'none';
	}
}
function handleResponseEmailedit() {
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
			document.getElementById("same_edit").style.display = 'none';
			document.getElementById("valid_add").value=1;
		}
		 if(response==0)
		 {
			//alert(response);
			document.getElementById("notexists_add").style.display='inline';
			document.getElementById("exists_add").style.display='none';
			document.getElementById("invalid_add").style.display = 'none';
			document.getElementById("same_edit").style.display = 'none';
			document.getElementById("valid_add").value=0;
		}
	}
	}
}

function val()
{
	
	if(document.getElementById("fname").value=="")
	{
		alert("Please enter first name");
		document.getElementById("fname").focus();
		return false;
	}
	if(document.getElementById("lname").value=="")
	{
		alert("Please enter last name");
		document.getElementById("lname").focus();
		return false;
	}
	if(document.getElementById("email_add").value=="")
	{
		alert("Please enter email id");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("valid_add").value==1)
	{
		alert("This email id already exists");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("valid_add").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("password").value=="")
	{
		alert("Please enter password");
		document.getElementById("password").focus();
		return false;
	}
	if(document.getElementById("cpassword").value=="")
	{
		alert("Please enter confirm password");
		document.getElementById("cpassword").focus();
		return false;
	}
	if(document.getElementById("password").value!=document.getElementById("cpassword").value)
	{
		alert("Confirm password does not match");
		document.getElementById("cpassword").focus();
		return false;
	}
	if(document.getElementById("city").value=="")
	{
		alert("Please enter city");
		document.getElementById("city").focus();
		return false;
	}	
	if(document.getElementById("state").value=="")
	{
		alert("Please enter state");
		document.getElementById("state").focus();
		return false;
	}
	if(document.getElementById("address").value=="")
	{
		alert("Please enter address");
		document.getElementById("address").focus();
		return false;
	}
	if(document.getElementById("zip").value=="")
	{
		alert("Please enter  value for zip code");
		document.getElementById("zip").focus();
		return false;
	}
	if(document.getElementById("zip").value!="" && isNaN(document.getElementById("zip").value))
	{
		alert("Please enter numeric value for zip code");
		document.getElementById("zip").focus();
		return false;
	}
if(document.getElementById("mobile").value=="" )
	{
		alert("Please enter value for mobile number");
		document.getElementById("mobile").focus();
		return false;
	}
	if(document.getElementById("mobile").value!="" && isNaN(document.getElementById("mobile").value))
	{
		alert("Please enter numeric value for mobile number");
		document.getElementById("mobile").focus();
		return false;
	}
	/*if(document.getElementById("phone").value!="" && isNaN(document.getElementById("phone").value))
	{
		alert("Please enter numeric value for phone");
		document.getElementById("phone").focus();
		return false;
	}*/
}


function val_numbers()
{
	if(document.getElementById("name_add").value=="")
	{
		alert("Please enter name");
		document.getElementById("name_add").focus();
		return false;
	}
	if(document.getElementById("email_add").value=="")
	{
		alert("Please enter number");
		document.getElementById("email_add").focus();
		return false;
	}
	if(isNaN(document.getElementById("email_add").value))
	{
		alert("Number should be numeric");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("valid_add").value==1)
	{
		alert("This number already exists");
		document.getElementById("email_add").focus();
		return false;
	}
	
}
 function checkall()
{
var ar = new Array();
	n = 0;
	var flag=0;
	
	if(document.getElementById("check_all").checked==true)
	{
		var m=document.frm1.checkvalue.length+'';
		if(m=='undefined')
		{
			document.frm1.checkvalue.checked=true;
		}
		
		 for(i = 0; i< document.frm1.checkvalue.length; i++)
		{
			document.frm1.checkvalue[i].checked=true;
		}
	}
	if(document.getElementById("check_all").checked==false)
	{
		var m=document.frm1.checkvalue.length+'';
		if(m=='undefined')
		{
			document.frm1.checkvalue.checked=false;
		}
		
		 for(i = 0; i< document.frm1.checkvalue.length; i++)
		{
			document.frm1.checkvalue[i].checked=false;
		}
	}
}

function check_add()
{
	
	var flag=0;
	var m=document.frm1.checkvalue.length+'';
		 
		    if(m=='undefined')
		   {
		    
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				
				flag ++;
			  }
		   }
		   if(flag==0)
		   {
		   		alert("Please choose any email address");
		   }
		   }
}







function validation_delete(pageno,status)
{ 
  var n=0;
  var flag=0;
  var flag=0;
          var ar=new Array();
		  var n=0;
	if(document.frm1.dropdown1.value=='')
	{
		alert('Please choose one action');
		return false;
	}
	if(document.frm1.dropdown1.value=='delete')
		 {
		   var m=document.frm1.checkvalue.length+'';
		 
		     if(m=='undefined')
		   {
		
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				var id= document.frm1.checkvalue.value;
			   	ar[0] = id;
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				var id= document.frm1.checkvalue[i].value;
				ar[n++] = id;	
				flag ++;
			  }
		   }
		   }
		   
		 if(flag == 0)
		  {
		   alert('No record selected');
		   return false;
		  }
		if(flag > 0)
		 {
		 if(confirm('Do you want to delete these records')==true)
		   {   
		   window.location.href="user_process.php?act=del&id="+ar+"&pageno="+pageno+"&status="+status;
			 return true;
	       }
		   else
		   {
		     return false;
		   }
	 	
		}	
	 }
		 if(document.frm1.dropdown1.value=='Active')
		  {
		   var m=document.frm1.checkvalue.length+'';
		 
		     if(m=='undefined')
		   {
		    
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				var id= document.frm1.checkvalue.value;
			   	ar[0] = id;
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				var id= document.frm1.checkvalue[i].value;
				ar[n++] = id;	
				flag ++;
			  }
		   }
		   }
		   
		 if(flag == 0)
		  {
		   alert('No record selected');
		   return false;
		  }
		if(flag > 0)
		 {
		 if(confirm('Do you want to activate these records')==true)
		   {   
		  window.location.href="user_process.php?act=Active&id="+ar+"&pageno="+pageno+"&status="+status;
			 return true;
	       }
		   else
		   {
		     return false;
		   }
	 	
		}	
	}
		  if(document.frm1.dropdown1.value=='Inactive')
		  {
		   var m=document.frm1.checkvalue.length+'';
		 
		     if(m=='undefined')
		   {
		   
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				var id= document.frm1.checkvalue.value;
			   	ar[0] = id;
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				var id= document.frm1.checkvalue[i].value;
				ar[n++] = id;	
				flag ++;
			  }
		   }
		   }
		   
		 if(flag == 0)
		  {
		   alert('No record selected');
		   return false;
		  }
		if(flag > 0)
		 {
		 if(confirm('Do you want to inactivate these records')==true)
		   {   
		window.location.href="user_process.php?act=Inactive&id="+ar+"&pageno="+pageno+"&status="+status;
			 return true;
	       }
		   else
		   {
		     return false;
		   }
	     }	
	   }
	 }
	 

	 
 function checkall()
{
var ar = new Array();
	n = 0;
	var flag=0;
	
	if(document.getElementById("check_all").checked==true)
	{
		var m=document.frm1.checkvalue.length+'';
		if(m=='undefined')
		{
			document.frm1.checkvalue.checked=true;
		}
		
		 for(i = 0; i< document.frm1.checkvalue.length; i++)
		{
			document.frm1.checkvalue[i].checked=true;
		}
	}
	if(document.getElementById("check_all").checked==false)
	{
		var m=document.frm1.checkvalue.length+'';
		if(m=='undefined')
		{
			document.frm1.checkvalue.checked=false;
		}
		
		 for(i = 0; i< document.frm1.checkvalue.length; i++)
		{
			document.frm1.checkvalue[i].checked=false;
		}
	}
}





function view_edit_reff(){
document.getElementById("edit_reff").style.display='inline';
document.getElementById("view_reff").style.display='none';
}
function view_or_reff(){
document.getElementById("edit_reff").style.display='none';
document.getElementById("view_reff").style.display='inline';
}
function edit_reff_process(id,cash){
if(document.getElementById("reff_cash").value=='' ){
	document.getElementById("reff_cash").value=cash;
	alert('Please enter credit');
	document.getElementById("reff_cash").focus();
}
else if(isNaN(document.getElementById("reff_cash").value) ){
	document.getElementById("reff_cash").value=cash;
	alert('Credit should be numeric');
	document.getElementById("reff_cash").focus();
}

else {
	var csh = 0;
	//alert(parseInt(cash));
	//alert(parseInt(document.getElementById("reff_cash").value));
	if(parseInt(cash) > parseInt(document.getElementById("reff_cash").value)) { csh = parseInt(cash) - parseInt(document.getElementById("reff_cash").value);
	var totcash = parseInt(document.getElementById("tot_cash_hid").value) - csh;  }
	if(parseInt(cash) < parseInt(document.getElementById("reff_cash").value)) { csh =parseInt(document.getElementById("reff_cash").value) -  parseInt(cash);
	var totcash = parseInt(document.getElementById("tot_cash_hid").value) + csh;  }					 
	var cashused = parseInt(document.getElementById("used_cash_hid").value);
	//alert(totcash);
	 if(totcash < cashused ){
	document.getElementById("reff_cash").value=cash;
	alert('Total credit should be greater than used credit');
	document.getElementById("reff_cash").focus();
	}
else{
var newqty = document.getElementById("reff_cash").value;
//alert(newqty);
//alert('user_process.php?act=edit_reff&id='+id+'&cash='+newqty);
http.open('get','user_process.php?act=edit_reff&id='+id+'&cash='+newqty);
http.onreadystatechange = handleResponseedit;
http.send(null);
}
}

}
function handleResponseedit() {
 if(http.readyState == 4 && http.status == 200){
  var response = http.responseText;
  var b = response;
         var temp = new Array();
		 temp = b.split('**');
      if(response!="")
	  {
		  //alert(response);
		  document.getElementById("reff_cash_hid").value= temp[0];
		  document.getElementById("tot_cash_hid").value= temp[1];
		  document.getElementById("view_reff").innerHTML = '';
		 document.getElementById("view_reff").innerHTML = temp[0]+'&nbsp;<a onclick="view_edit_reff();" style="cursor:pointer;">[Edit]</a>';
		 document.getElementById("view_reff").style.display='inline';
		document.getElementById("edit_reff").style.display='none';
		 document.getElementById("tot_earned_cash").innerHTML = '';
		  document.getElementById("tot_earned_cash").innerHTML = temp[1];
		   document.getElementById("av_cash").innerHTML = '';
		    document.getElementById("av_cash").innerHTML = temp[2];
      }
   }
}



function view_edit_tot(){
document.getElementById("edit_tot").style.display='inline';
document.getElementById("tot_earned_cash").style.display='none';
}
function view_or_tot(){
document.getElementById("edit_tot").style.display='none';
document.getElementById("tot_earned_cash").style.display='inline';
}


function edit_tot_process(id,cash){
if(document.getElementById("tots_cash").value=='' ){
	document.getElementById("tots_cash").value=cash;
	alert('Please enter credit');
	document.getElementById("tots_cash").focus();
}
else if(isNaN(document.getElementById("tots_cash").value) ){
	document.getElementById("tots_cash").value=cash;
	alert('Credit should be numeric');
	document.getElementById("tots_cash").focus();
}

else {
	 
	var cashused = parseInt(document.getElementById("used_cash_hid").value);
	var cashref = parseInt(document.getElementById("reff_cash_hid").value);
	var totcash = parseInt(document.getElementById("tots_cash").value);
	//alert(totcash);
	 if(totcash < cashused ){
	document.getElementById("tots_cash").value=cash;
	alert('Total credit should be greater than used credit');
	document.getElementById("tots_cash").focus();
	}
	else if(totcash < cashref ){
	document.getElementById("tots_cash").value=cash;
	alert('Total credit should be greater than reference credit');
	document.getElementById("tots_cash").focus();
	}
else{
var newqty = document.getElementById("tots_cash").value;
//alert(newqty);
//alert('user_process.php?act=edit_reff&id='+id+'&cash='+newqty);
http.open('get','user_process.php?act=edit_tot&id='+id+'&cash='+newqty);
http.onreadystatechange = handleResponseedittot;
http.send(null);
}
}

}
function handleResponseedittot() {
 if(http.readyState == 4 && http.status == 200){
  var response = http.responseText;
  var b = response;
         var temp = new Array();
		 temp = b.split('**');
      if(response!="")
	  {
		  //alert(response);
		  document.getElementById("tot_cash_hid").value= temp[0];
		  document.getElementById("tot_earned_cash").innerHTML = '';
		 document.getElementById("tot_earned_cash").innerHTML = temp[0]+'&nbsp;<a onclick="view_edit_tot();" style="cursor:pointer;">[Edit]</a>';
		 document.getElementById("tot_earned_cash").style.display='inline';
		document.getElementById("edit_tot").style.display='none';
		   document.getElementById("av_cash").innerHTML = '';
		    document.getElementById("av_cash").innerHTML = temp[1];
      }
   }
}




function view_edit_used(){
document.getElementById("edit_us").style.display='inline';
document.getElementById("us_cash").style.display='none';
}
function view_or_usd(){
document.getElementById("edit_us").style.display='none';
document.getElementById("us_cash").style.display='inline';
}


function edit_usd_process(id,cash){
if(document.getElementById("usd_cash").value=='' ){
	document.getElementById("usd_cash").value=cash;
	alert('Please enter credit');
	document.getElementById("usd_cash").focus();
}
else if(isNaN(document.getElementById("usd_cash").value) ){
	document.getElementById("usd_cash").value=cash;
	alert('Credit should be numeric');
	document.getElementById("usd_cash").focus();
}

else {
	 
	var cashused = parseInt(document.getElementById("usd_cash").value);
	var totcash = parseInt(document.getElementById("tot_cash_hid").value);
	//alert(totcash);
	 if(totcash < cashused ){
	document.getElementById("usd_cash").value=cash;
	alert('Total credit should be greater than used credit');
	document.getElementById("usd_cash").focus();
	}
	
else{
var newqty = document.getElementById("tots_cash").value;
//alert(newqty);
//alert('user_process.php?act=edit_use&id='+id+'&cash='+newqty);
http.open('get','user_process.php?act=edit_use&id='+id+'&cash='+newqty);
http.onreadystatechange = handleResponseeditused;
http.send(null);
}
}

}
function handleResponseeditused() {
 if(http.readyState == 4 && http.status == 200){
  var response = http.responseText;
  var b = response;
         var temp = new Array();
		 temp = b.split('**');
      if(response!="")
	  {
		  alert(response);
		  document.getElementById("used_cash_hid").value= temp[0];
		  document.getElementById("us_cash").innerHTML = '';
		 document.getElementById("us_cash").innerHTML = temp[0]+'&nbsp;<a onclick="view_edit_used();" style="cursor:pointer;">[Edit]</a>';
		 document.getElementById("us_cash").style.display='inline';
		document.getElementById("edit_us").style.display='none';
		   document.getElementById("av_cash").innerHTML = '';
		    document.getElementById("av_cash").innerHTML = temp[1];
      }
   }
}




