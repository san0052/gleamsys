
function album_availability()
{
		
	
	var id= document.getElementById('cat_name').value;
	
	if(id!='')
	{
		var pid= document.getElementById('pId').value;
		
		//var secpid= document.getElementById('secpid').value;
	
	/*var url='category_availability.php?act='+pagename+'&str='+chkstr;
	http.open('get',url);
	http.onreadystatechange = handleResponsecatname;
	http.send(null);*/
	//alert(pid+'this is a new'+secpid);
$.ajax({
type: "POST",
url: "album_availability.php",
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
function add_typ_value(){
	$type=document.getElementById('type_check').value;
	if($type=='1'){
		return false;
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
	var url='album_availability.php?pid='+pid+'&id='+id+'&secpid='+secpid;
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
		   window.location.href="album_process.php?act=muldel&id="+ar+"&pageno="+pageno1+"&pId="+pId+"&secpid="+secpid;
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
		    window.location.href="album_process.php?act=mulactive&id="+ar+"&pageno="+pageno1+"&pId="+pId+"&secpid="+secpid;
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
		window.location.href="album_process.php?act=mulinactive&id="+ar+"&pageno="+pageno1+"&pId="+pId+"&secpid="+secpid;
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
