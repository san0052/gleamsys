function check_pnameadd(pname)	{
			var cate_id=document.getElementById("cate_id").value;
			if(pname!="")
			{
				
				//alert(id);
				var act='check_pnameadd';
				http.open('get','product_process.php?act='+act+'&pname='+pname+'&cate_id='+cate_id);
				http.onreadystatechange = handleResponsePnameAdd;
				http.send(null);
			}
			else
			{
				document.getElementById("exists_add").style.display='none';
				document.getElementById("notexists_add").style.display='none';
			}
		}
		function handleResponsePnameAdd() {
		   if(http.readyState == 4 && http.status == 200){
			  var response = http.responseText;
			  if(response!="")
			  {
				 if(response==1)
				 {
				 	
					document.getElementById("exists_add").style.display='inline';
					document.getElementById("notexists_add").style.display='none';
					document.getElementById("prod_add_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
					document.getElementById("notexists_add").style.display='inline';
				 	document.getElementById("exists_add").style.display='none';
					document.getElementById("prod_add_valid").value=0;
				 }
			  }
		   }
		}
		
	  function check_pnameedit(pname,id)	{
			//alert(pname);
			if(pname!="")
			{
				var cate_id=document.getElementById("cate_id_edit").value;
				var act='check_pnameedit';
				http.open('get','product_process.php?act='+act+'&pname='+pname+'&cate_id='+cate_id+'&id='+id);
				http.onreadystatechange = handleResponsePnameEdit;
				http.send(null);
			}
			else
			{
				document.getElementById("notexists_edit").style.display='none';
				document.getElementById("exists_edit").style.display='none';
				document.getElementById("same_edit").style.display='none';
			}
		}
		function handleResponsePnameEdit() {
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
					document.getElementById("prod_edit_valid").value=1;
				 }
				 if(response==0)
				 {
				 	//alert(response);
				 	
					document.getElementById("notexists_edit").style.display='inline';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("same_edit").style.display='none';
					document.getElementById("prod_edit_valid").value=0;
				 }
				 if(response==2)
				 {
				 	//alert(response);
				 	document.getElementById("same_edit").style.display='inline';
					document.getElementById("notexists_edit").style.display='none';
					document.getElementById("exists_edit").style.display='none';
					document.getElementById("prod_edit_valid").value=0;
				 }
			  }
		   }
		}
		
		
function product_edit()
{
	if(document.getElementById("cate_id_edit").value==0)
	{
		alert("Please select category name");
		document.getElementById("cate_id_edit").focus();
		return false;
	}
	if(document.getElementById("prod_pname_edit").value=="")
	{
		alert("Please enter product name");
		document.getElementById("prod_pname_edit").focus();
		return false;
	}
	if(document.getElementById("prod_edit_valid").value==1)
	{
		alert("This product name already exists");
		document.getElementById("prod_pname_edit").focus();
		return false;
	}
	
	if(document.getElementById("prod_price_edit").value=="")
	{
		alert("Please enter product price");
		document.getElementById("prod_price_edit").focus();
		return false;
	}
}
function product_add()
{
	if(document.getElementById("cate_id").value==0)
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
	if(document.getElementById("prod_add_valid").value==1)
	{
		alert("This product name already exists");
		document.getElementById("prod_pname_add").focus();
		return false;
	}
	if(document.getElementById("image_add").value=="")
	{
		alert("Please choose product image");
		document.getElementById("image_add").focus();
		return false;
	}
	if(document.getElementById("prod_price_add").value=="")
	{
		alert("Please enter product price");
		document.getElementById("prod_price_add").focus();
		return false;
	}
	
}
function product_edit1()
{

	if(document.getElementById("prod_pname_edit").value=="")
	{
		alert("Please enter product name");
		document.getElementById("prod_pname_edit").focus();
		return false;
	}
	if(document.getElementById("prod_edit_valid").value==1)
	{
		alert("This product name already exists");
		document.getElementById("prod_pname_edit").focus();
		return false;
	}
	
	if(document.getElementById("prod_price_edit").value=="")
	{
		alert("Please enter product price");
		document.getElementById("prod_price_edit").focus();
		return false;
	}
}
function product_add1()
{
	
	if(document.getElementById("prod_pname_add").value=="")
	{
		alert("Please enter product name");
		document.getElementById("prod_pname_add").focus();
		return false;
	}
	if(document.getElementById("prod_add_valid").value==1)
	{
		alert("This product name already exists");
		document.getElementById("prod_pname_add").focus();
		return false;
	}
	if(document.getElementById("image_add").value=="")
	{
		alert("Please choose product image");
		document.getElementById("image_add").focus();
		return false;
	}
	if(document.getElementById("prod_price_add").value=="")
	{
		alert("Please enter product price");
		document.getElementById("prod_price_add").focus();
		return false;
	}
	
}
function check_pname()
{
	document.getElementById("prod_pname_add").focus();
}
function pname_edit()
{
	document.getElementById("prod_pname_edit").focus();	
}
