function add_typ_value(){
	 if(document.getElementById("maxprice").value=='' && document.getElementById("minprice").value==''){
	   alert('Please Enter Maximum or Minimum Price Range');
	   document.getElementById("minprice").focus();
	   return false;
	}
	 if(document.getElementById("minprice").value!='' && isNaN(document.getElementById("minprice").value)){
	   alert('Minimum price should be numeric');
	   document.getElementById("minprice").focus();
	   return false;
	}
	 if(document.getElementById("maxprice").value!='' && isNaN(document.getElementById("maxprice").value)){
	   alert('Maxprice price should be numeric');
	   document.getElementById("maxprice").focus();
	   return false;
	}
	 if(document.getElementById("maxprice").value!='' && document.getElementById("minprice").value!='' && parseInt(document.getElementById("minprice").value)>parseInt(document.getElementById("maxprice").value)){
	   alert('Minimum price range should be less than maximum price range');
	   document.getElementById("minprice").focus();
	   return false;
	}
	return true;
}

function edit_typ_value(){
	 if(document.getElementById("maxprice").value=='' && document.getElementById("minprice").value==''){
	   alert('Please Enter Maximum or Minimum Price Range');
	   document.getElementById("minprice").focus();
	   return false;
	}
	 if(document.getElementById("minprice").value!='' && isNaN(document.getElementById("minprice").value)){
	   alert('Minimum price should be numeric');
	   document.getElementById("minprice").focus();
	   return false;
	}
	 if(document.getElementById("maxprice").value!='' && isNaN(document.getElementById("maxprice").value)){
	   alert('Maxprice price should be numeric');
	   document.getElementById("maxprice").focus();
	   return false;
	}
	 if(document.getElementById("maxprice").value!='' && document.getElementById("minprice").value!='' && parseInt(document.getElementById("minprice").value)>parseInt(document.getElementById("maxprice").value)){
	   alert('Minimum price range should be less than maximum price range');
	   document.getElementById("minprice").focus();
	   return false;
	}
	return true;
}




var ar = new Array();
	n = 0;
	var flag=0;
function validation_delete(pageno)
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
		   window.location.href="price-range-process.php?act=muldel&id="+ar+"&pageno="+pageno1;
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
		    window.location.href="price-range-process.php?act=mulactive&id="+ar+"&pageno="+pageno1;
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
		window.location.href="price-range-process.php?act=mulinactive&id="+ar+"&pageno="+pageno1;
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
