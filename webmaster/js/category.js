function check_cnameadd(cname)	{
			
			if(cname!="")
			{
				
				//alert(id);
				var act='check_cnameadd';
				http.open('get','category_process.php?act='+act+'&cname='+cname);
				http.onreadystatechange = handleResponseCnameAdd;
				http.send(null);
			}
			else
			{
				document.getElementById("exists_add").style.display='none';
				document.getElementById("notexists_add").style.display='none';
			}
		}
		function handleResponseCnameAdd() {
		   if(http.readyState == 4 && http.status == 200){
			  var response = http.responseText;
			  if(response!="")
			  {
				 if(response==1)
				 {
				 	//alert(response);
					document.getElementById("exists_add").style.display='inline';
					document.getElementById("notexists_add").style.display='none';
					document.getElementById("cname_add_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
					document.getElementById("notexists_add").style.display='inline';
				 	document.getElementById("exists_add").style.display='none';
					document.getElementById("cname_add_valid").value=0;
				 }
			  }
		   }
		}
		
	  function check_cnameedit(cname,id)	{
			
			if(cname!="")
			{
				//alert(id);
				var act='check_cnameedit';
				http.open('get','category_process.php?act='+act+'&cname='+cname+'&id='+id);
				http.onreadystatechange = handleResponseCnameEdit;
				http.send(null);
			}
			else
			{
				document.getElementById("notexists_edit").style.display='none';
				document.getElementById("exists_edit").style.display='none';
				document.getElementById("same_edit").style.display='none';
			}
		}
		function handleResponseCnameEdit() {
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
					document.getElementById("cname_edit_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
				 	
					document.getElementById("notexists_edit").style.display='inline';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("same_edit").style.display='none';
					document.getElementById("cname_edit_valid").value=0;
				 }
				 if(response==2)
				 {
				 	//alert(response);
				 	document.getElementById("same_edit").style.display='inline';
					document.getElementById("notexists_edit").style.display='none';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("cname_edit_valid").value=0;
				 }
			  }
		   }
		}
		
		
function category_edit()
{
	if(document.getElementById("cname_edit").value=="")
	{
		alert("Please enter category name");
		document.getElementById("cname_edit").focus();
		return false;
	}
	if(document.getElementById("cname_edit_valid").value==1)
	{
		alert("This category name already exists");
		document.getElementById("cname_edit").focus();
		return false;
	}
}
function category_add()
{
	if(document.getElementById("cname_add").value=="")
	{
		alert("Please enter category name");
		document.getElementById("cname_add").focus();
		return false;
	}
	if(document.getElementById("cname_add_valid").value==1)
	{
		alert("This category name already exists");
		document.getElementById("cname_add").focus();
		return false;
	}
}

