var ct = 1;
function new_link()
{
	//alert(ct);
	ct++;
	var div1 = document.createElement('div');
	div1.id = ct;

	// link to delete extended form elements
	var delLink = '<div style="text-align:right;margin-right:65px"><a href="javascript:delIt('+ ct +')">Del</a></div>';

	div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;

	document.getElementById('newlink').appendChild(div1);

}
// function to delete the newly added set of elements
function delIt(eleId)
{
	
	//alert(eleId);
	d = document;

	var ele = d.getElementById(eleId);

	var parentEle = d.getElementById('newlink');

	parentEle.removeChild(ele);

}

function addopen()
{
	//alert('addopent')
	if(document.getElementById("addon_prod").style.display=='block')
	{
		document.getElementById("addon_prod").style.display='none';
	}
	else
	{
		document.getElementById("addon_prod").style.display='block';
	}
}



function get_product(val){
	
	if(val==0){
		alert('please select Category');
	}
	else{
		
		window.location.href='addon.php?category='+val;
	}
	
	
}

function check_other_loc(){
		if(document.getElementById("location").value=='other'){
			document.getElementById("other_location").style.display='inline';
		}
		else{
			document.getElementById("other_location").style.display='none';
		}
	}
function product_edit(frmedit)
{
	
	if(document.getElementById("cate_id").value=='')
	{
		alert("Please select category name");
		document.getElementById("cate_id").focus();
		return false;
	}

	if(document.getElementById("prod_pname_add").value=="")
	{
		alert("Please enter product name");
		document.getElementById("prod_pname_add").focus();
		return false;
	}
	if(document.getElementById("prod_price_add").value=="")
	{
		alert("Please enter product price");
		document.getElementById("prod_price_add").focus();
		return false;
	}
	if(isNaN(document.getElementById("prod_price_add").value))
	{
		alert("Please enter numeric value for product price");
		document.getElementById("prod_price_add").focus();
		return false;
	}

	if(document.getElementById("prod_dis").value=="")
	{
		alert("Please select product disclaimer");
		document.getElementById("prod_dis").focus();
		return false;
	}	
	if(document.getElementById("prod_note").value=="")
	{
		alert("Please select product note");
		document.getElementById("prod_note").focus();
		return false;
	}	
	if(document.getElementById("prod_loc").value=="")
	{
		alert("Please select product location");
		document.getElementById("prod_loc").focus();
		return false;
	}





	if(document.getElementById("addon").checked==true)
	{ //alert('arka');
	
		var ele1 = frmedit.elements['prod_pname_addon[]'];
		var ele2 = frmedit.elements['prod_price_addon[]'];
		var ele3 = frmedit.elements['prod_locon[]'];
		//var ele4 = frmedit.elements['prod_codeon[]'];
		var ele5 = frmedit.elements['descriptionon[]'];
		var ele6 = frmedit.elements['image_addon[]'];
		//alert(ele.length);
		//return false;
//alert(ele1.length);
var flag=0;
	for(var i=0; i< (ele1.length-1); i++)
	{
		//alert(i);
		if(ele1[i].value!='' && ele2[i].value!='' &&  (!isNaN(ele2[i].value)) && ele3[i].value!=''  && ele5[i].value!='' && ele6[i].value!=''){
		//alert('ok');
		flag++;
		}
		else if(ele1[i].value=='' && ele2[i].value=='' && ele3[i].value==''  && ele5[i].value=='' && ele6[i].value==''){
		//alert('ok');
		flag++;
		}
		else{
			if(ele1[i].value==''){
			
			alert("Please enter Product Name");
			ele1[i].focus();
			flag--;
			return false;
			}
			if(ele2[i].value==''){
			
			alert("Please enter Product Price");
			ele2[i].focus();
			flag--;
			return false;
			}
			if(ele2[i].value!=''){
				if(isNaN(ele2[i].value)){
			
			alert('Please Enter Numeric Value');
			ele2[i].focus();
			flag--;
			return false;
				}
			}
			if(ele3[i].value==''){
			
			 alert("Please enter Product Location");
			 ele3[i].focus();
			flag--;
			return false;
			}
			/*if(ele4[i].value==''){
			ele4[i].focus();
			alert("Please enter Product Code");
			flag--;
			return false;
			}*/
			if(ele5[i].value==''){
			
			 alert("Please enter Product Description");
			 ele5[i].focus();
			flag--;
			return false;
			}
			if(ele6[i].value==''){
			
			alert("Please enter Product Image");
			ele6[i].focus();
			flag--;
			return false;
			}
		}

	
	}
	var flaglen = ele1.length-1;
if(flag==flaglen){
//alert ('all ok');
return true;
}
if(flag!=flaglen){
//alert ('not all ok');
return false;
}
	return true;
		
		
		
		
		
	}
	
	
}
function pincode_add(frmadd)
{
	if(document.getElementById("post_office_name").value=="")
	{
		alert("Please enter post office name");
		document.getElementById("post_office_name").focus();
		return false;
	}
	if(document.getElementById("pincode").value=="")
	{
		alert("Please enter pincode");
		document.getElementById("pincode").focus();
		return false;
	}
	if(isNaN(document.getElementById("pincode").value))
	{
		alert("Please enter numeric value for pincode");
		document.getElementById("pincode").focus();
		return false;
	}
	if(document.getElementById("pincode").value.length!=6)
	{
		alert("Please enter pincode of 6 digits");
		document.getElementById("pincode").focus();
		return false;
	}



	if(document.getElementById("city").value=="")
	{
		alert("Please enter city");
		document.getElementById("city").focus();
		return false;
	}	
	if(document.getElementById("district").value=="")
	{
		alert("Please enter district");
		document.getElementById("district").focus();
		return false;
	}	
	if(document.getElementById("state").value=="")
	{
		alert("Please enter state");
		document.getElementById("state").focus();
		return false;
	}
	
}

function validation1(category,pageno)
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
		   var pageno1=pageno;
		   window.location.href="delPincode_process.php?act=del&category="+category+"&id="+ar+"&pageno="+pageno1;
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
		   var pageno1=pageno;
		   window.location.href="delPincode_process.php?act=Active&category="+category+"&id="+ar+"&pageno="+pageno1;
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
		 var pageno1=pageno;
		 window.location.href="delPincode_process.php?act=Inactive&category="+category+"&id="+ar+"&pageno="+pageno1;
			 return true;
	       }
		   else
		   {
		     return false;
		   }
	     }	
	   }
	 }

	 
function validation2(category,pageno)
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
		   var pageno1=pageno;
		   window.location.href="product_process.php?act=del_addon&category="+category+"&id="+ar+"&pageno="+pageno1;
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
		   var pageno1=pageno;
		   window.location.href="product_process.php?act=Active_addon&category="+category+"&id="+ar+"&pageno="+pageno1;
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
		 var pageno1=pageno;
		 window.location.href="product_process.php?act=Inactive_addon&category="+category+"&id="+ar+"&pageno="+pageno1;
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
	//alert("Hello");
	if(document.getElementById("check_all").checked==true)
	{    
	   //alert("Hello");
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
function checkall_add()
{
var ar = new Array();
	n = 0;
	var flag=0;
	//alert("Hello");
	if(document.getElementById("check_all").checked==true)
	{    
	   //alert("Hello");
		var m=document.frmadd.key_id.length+'';
		//alert("hello");
		if(m=='undefined')
		{   
		    //alert("Hello");
			document.frmadd.key_id.checked=true;
		}
		
		for(i = 0; i< document.frmadd.key_id.length; i++)
		{   
		    // alert("Hello");
			document.frmadd.key_id[i].checked=true;
		}
	}
	if(document.getElementById("check_all").checked==false)
	{   
		var m=document.frmadd.key_id.length+'';
		if(m=='undefined')
		{
			document.frmadd.key_id.checked=false;
		}
		
		 for(i = 0; i< document.frmadd.key_id.length; i++)
		{
			document.frmadd.key_id[i].checked=false;
		}
	}
}

var midnightDeliveryObArr = new Array();
var midnightDeliveryObArrCount = 0;

function collectMidnightDeliveryObs(ob){
	midnightDeliveryObArr[midnightDeliveryObArrCount++] = ob;
}

function checkall_MidnightDelivery(ob)
{
	for(var i = 0; i < midnightDeliveryObArr.length; i++){
		if(ob.checked) {		
			midnightDeliveryObArr[i].checked=true;
		} else {
			midnightDeliveryObArr[i].checked=false;
		}
	}
	/*
var ar = new Array();
	n = 0;
	var flag=0;
	//alert("Hello");
	if(document.getElementById("check_all1").checked==true)
	{    
	   //alert("Hello");
		var m=document.frmadd.cate_id.length+'';
		//alert("hello");
		if(m=='undefined')
		{   
		    //alert("Hello");
			document.frmadd.cate_id.checked=true;
		}
		
		for(i = 0; i< document.frmadd.cate_id.length; i++)
		{   
		    // alert("Hello");
			document.frmadd.cate_id[i].checked=true;
		}
	}
	if(document.getElementById("check_all1").checked==false)
	{   
		var m=document.frmadd.cate_id.length+'';
		if(m=='undefined')
		{
			document.frmadd.cate_id.checked=false;
		}
		
		 for(i = 0; i< document.frmadd.cate_id.length; i++)
		{
			document.frmadd.cate_id[i].checked=false;
		}
	}
	*/
}
function checkall_edit()
{
var ar = new Array();
	n = 0;
	var flag=0;
	//alert("Hello");
	if(document.getElementById("check_all").checked==true)
	{    
	   //alert("Hello");
		var m=document.frmedit.key_id.length+'';
		//alert("hello");
		if(m=='undefined')
		{   
		    //alert("Hello");
			document.frmedit.key_id.checked=true;
		}
		
		for(i = 0; i< document.frmedit.key_id.length; i++)
		{   
		    // alert("Hello");
			document.frmedit.key_id[i].checked=true;
		}
	}
	if(document.getElementById("check_all").checked==false)
	{   
		var m=document.frmedit.key_id.length+'';
		if(m=='undefined')
		{
			document.frmedit.key_id.checked=false;
		}
		
		 for(i = 0; i< document.frmedit.key_id.length; i++)
		{
			document.frmedit.key_id[i].checked=false;
		}
	}
}

function show_colors(id){
	if(id!=''){
	var url='category_availability.php?act=pick_color&str='+id;
	http.open('get',url);
	http.onreadystatechange = handleResponsepickcolor;
	http.send(null);
}
else{
document.getElementById('color_show').innerHTML = ''; 
}
}
function handleResponsepickcolor()
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText+'';
		if(response)
			{
				var sp = '<span style=\"width:20px;background-color:#'+response+';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>'
		   	  	document.getElementById('color_show').innerHTML = ''; 
				document.getElementById('color_show').innerHTML = sp; 
    			
			}
     }
}

function getsec_category(id)
{
	
	//alert(id);
	var st='<select name=\"secpid\" id=\"secpid\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Second Parent</option></select>';
	if(id!= 0)
	{
		
		/*document.getElementById("cust_city").innerHTML = '';
		document.getElementById("cust_city").innerHTML = cty;*/
		var act='getsec_category';
		//alert('product_process.php?act='+act+'&id='+id);
		http.open('get','product_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestatecust;
		http.send(null);
	}
	else
	{
		document.getElementById("sec_parent").innerHTML = '';
		document.getElementById("sec_parent").innerHTML = st;
		document.getElementById("cust_city").innerHTML = '';
		document.getElementById("cust_city").innerHTML = cty;
	}
}
function handleResponsestatecust() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	//alert(response);
	if(response!="")
	{
		
		document.getElementById("sec_parent").innerHTML = '';
		document.getElementById("sec_parent").innerHTML = response;
	}
}
}
function getsec_category5(id)
{
	
	//alert(id);
	var st='<select name=\"secpid\" id=\"secpid\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Second Parent</option></select>';
	if(id!= 0)
	{
		
		/*document.getElementById("cust_city").innerHTML = '';
		document.getElementById("cust_city").innerHTML = cty;*/
		var act='getsec_category5';
		//alert('product_process.php?act='+act+'&id='+id);
		http.open('get','product_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestatecust;
		http.send(null);
	}
	else
	{
		document.getElementById("sec_parent").innerHTML = '';
		document.getElementById("sec_parent").innerHTML = st;
		document.getElementById("cust_city").innerHTML = '';
		document.getElementById("cust_city").innerHTML = cty;
	}
}
function handleResponsestatecust() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	//alert(response);
	if(response!="")
	{
		
		document.getElementById("sec_parent").innerHTML = '';
		document.getElementById("sec_parent").innerHTML = response;
	}
}
}