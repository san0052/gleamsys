<!-- ****************************** FOR key category**************************** -->
function getsec_category(id)
{
	//alert('55');
	//alert(id);
	//alert(document.getElementById('pId').value);
	/*if(document.getElementById('pId').value!='0')	
	{
		//alert('111');
		document.getElementById('show_in_menu').style.display = 'none'; 
	}
	if(document.getElementById('pId').value==0)	
	{
		document.getElementById('show_in_menu').style.display = 'block'; 
	}*/
	
	var st='<select name=\"secpid\" id=\"secpid\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Second Parent</option></select>';
	if(id!= 0)
	{
		
		/*document.getElementById("cust_city").innerHTML = '';
		document.getElementById("cust_city").innerHTML = cty;*/
		var act='getsec_category';
		//alert('category_process.php?act='+act+'&id='+id);
		http.open('get','category_process_key.php?act='+act+'&id='+id);
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

function getsec_category1(id)
{
	//alert("12345");
	var st='<select name=\"secpid1\" id=\"secpid1\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Second parent</option></select>';
	if(id!= 0)
	{
		/*document.getElementById("cust_city1").innerHTML = '';
		document.getElementById("cust_city1").innerHTML = city;*/
		var act='getsec_category1';
		http.open('get','category_process_key.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestateedit1;
		http.send(null);
	}
	else
	{
		document.getElementById("sec_parent1").innerHTML = '';
		document.getElementById("sec_parent1").innerHTML = st;
		document.getElementById("cust_city").innerHTML = '';
		document.getElementById("cust_city").innerHTML = cty;
	}
	
}

function handleResponsestateedit1() {
if(http.readyState == 4 && http.status == 200)
{
	var response = http.responseText;
	
	if(response!="")
	{
		
		document.getElementById("sec_parent1").innerHTML = '';
		document.getElementById("sec_parent1").innerHTML = response;
		
	}
}
}


function category_availability()
{
		
	
	var id= document.getElementById('cat_name').value;
	if(id!='')
	{
		var pid= document.getElementById('pId').value;
		var secpid= document.getElementById('secpid').value;
	
	/*var url='category_availability.php?act='+pagename+'&str='+chkstr;
	http.open('get',url);
	http.onreadystatechange = handleResponsecatname;
	http.send(null);*/
	
$.ajax({
type: "POST",
url: "category_availability_key.php",
data: 'pid='+pid+'&id='+id+'&secpid='+secpid,
async:true,
success: function(msg){
	
	if(msg==1)
			{
				document.getElementById('exsists').style.display = 'inline'; 
				document.getElementById('notexsists').style.display = 'none';
				document.getElementById('type_check').value=1;
			}
			if(msg==0)
			{
		   	  	document.getElementById('exsists').style.display = 'none'; 
    			document.getElementById('notexsists').style.display = 'inline';
				document.getElementById('type_check').value=2;
			}
}
});
	}
	else{
	document.getElementById('exsists').style.display = 'none';
	document.getElementById('notexsists').style.display = 'none';
	}
}


function category_availability_edit(prid,secprid)
{
	var id= document.getElementById('category_edit').value;
	if(id!='')
	{
		if(prid==0 && secprid==0){
		var pid= 0;
		var secpid=0;
		}
		if(prid!=0 && secprid==0){
		var pid= document.frmedit.pId.value;
		var secpid=0;
		}
		if(prid!=0 && secprid!=0){
		var pid= document.frmedit.pId.value;
		var secpid= document.frmedit.secpid1.value;
		}
		//alert(secpid);
	
	var chkstr = id;
	if(id==document.getElementById('category_or').value){
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'inline';
	document.getElementById('type_check_edit').value=2;
	}
	else{
	var url='category_availability_key.php?pid='+pid+'&id='+id+'&secpid='+secpid;
	http.open('get',url);
	http.onreadystatechange = handleResponsecatnameedit;
	http.send(null);
	}
	}
	else{
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'none';
	}
}
function handleResponsecatnameedit()
{
	if(http.readyState == 4 && http.status == 200)
	{
		
		var response = http.responseText+'';
		if(response==1)
			{
				document.getElementById('exsists_edit').style.display = 'inline'; 
				document.getElementById('notexsists_edit').style.display = 'none';
				document.getElementById('same_edit').style.display = 'none';
				document.getElementById('type_check_edit').value=1;
			}
			if(response==0)
			{
		   	  	document.getElementById('exsists_edit').style.display = 'none'; 
    			document.getElementById('notexsists_edit').style.display = 'inline';
				document.getElementById('same_edit').style.display = 'none';
				document.getElementById('type_check_edit').value=2;
			}
     }
}
/*function category_availability_edit()
{
	var id= document.getElementById('category_edit').value;
	if(id!='')
	{
		//var pid= document.frmedit.pId.value;
		//var secpid= document.frmedit.secpid1.value;
	
	var chkstr = id;
	if(id==document.getElementById('category_or').value){
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'inline';
	document.getElementById('type_check_edit').value=2;
	}
	else{
	var url='category_availability.php?id='+id+'&secpid=arka';
	http.open('get',url);
	http.onreadystatechange = handleResponsecatnameedit1;
	http.send(null);
	}
	}
	else{
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'none';
	}
}
function handleResponsecatnameedit1()
{
	if(http.readyState == 4 && http.status == 200)
	{
		
		var response = http.responseText+'';
		//alert(response);
		if(response==1)
			{
				document.getElementById('exsists_edit').style.display = 'inline'; 
				document.getElementById('notexsists_edit').style.display = 'none';
				document.getElementById('same_edit').style.display = 'none';
				document.getElementById('type_check_edit').value=1;
			}
			if(response==0)
			{
		   	  	document.getElementById('exsists_edit').style.display = 'none'; 
    			document.getElementById('notexsists_edit').style.display = 'inline';
				document.getElementById('same_edit').style.display = 'none';
				document.getElementById('type_check_edit').value=2;
			}
     }
}*/// J// JavaScript Document
function add_typ_value(){
//alert(document.getElementById("add_title").value);
 if(document.getElementById("cat_name").value==''){
	   alert('Please Enter Category');
	   document.getElementById("cat_name").focus();
	   return false;
	}
else if(document.getElementById("type_check").value==1){
	   alert('This category already exists');
	   document.getElementById("cat_name").focus();
	   return false;
}
else{
	return true;
	}
}
//type edit validation
function edit_typ_value(){
//alert(document.getElementById("edit_title").value);
 if(document.getElementById("category_edit").value!='' && document.getElementById("type_check_edit").value==1){
	   alert('This category already exists');
	   document.getElementById("category_edit").focus();
	   return false;
}
	else{
	return true;
	}
}
<!-- ******************************END category**************************** -->


	var ar = new Array();
	n = 0;
	var flag=0;
function validation_delete(pageno,pId,secpid)
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
		   window.location.href="category_process_key.php?act=muldel&id="+ar+"&pageno="+pageno1+"&pId="+pId+"&secpid="+secpid;
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
		    window.location.href="category_process_key.php?act=mulactive&id="+ar+"&pageno="+pageno1+"&pId="+pId+"&secpid="+secpid;
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
		window.location.href="category_process_key.php?act=mulinactive&id="+ar+"&pageno="+pageno1+"&pId="+pId+"&secpid="+secpid;
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



function mass()
{
	
	if(document.getElementById("file").value=='')
	{
		alert('Please Click the browse button to select file and then click the save button');
		document.getElementById("file").focus();
		return false;
	}
}

function mark()
{
	
	if(document.getElementById("w_image").value=='')
	{
		alert('Please Click the browse button to select file and then click the save button');
		document.getElementById("w_image").focus();
		return false;
	}
}