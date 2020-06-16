
<!-- ****************************** FOR ADMIN TYPE **************************** -->
//type check
function type_availability(id)
{
	
	if(id!='')
	{
	var chkstr = id;
	var url='admin_type_availability.php?act=type&str='+chkstr;
	http.open('get',url);
	http.onreadystatechange = handleResponseProtype;
	http.send(null);
	}
	else{
	document.getElementById('exsists').style.display = 'none';
	document.getElementById('notexsists').style.display = 'none';
	}
}
function handleResponseProtype()
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText+'';
		if(response==1)
			{
				document.getElementById('exsists').style.display = 'inline'; 
				document.getElementById('notexsists').style.display = 'none';
				document.getElementById('type_check').value=1;
			}
			if(response==0)
			{
		   	  	document.getElementById('exsists').style.display = 'none'; 
    			document.getElementById('notexsists').style.display = 'inline';
				document.getElementById('type_check').value=2;
			}
     }
}
//type check for edit
function type_availibility_edit(id)
{
	
	if(id!='')
	{
	var chkstr = id;
	if(id==document.getElementById('admin_type_or').value){
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'inline';
	document.getElementById('type_check_edit').value=2;
	}
	else{
	var url='admin_type_availability.php?act=type&str='+chkstr;
	http.open('get',url);
	http.onreadystatechange = handleResponseProtypeedit;
	http.send(null);
	}
	}
	else{
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'none';
	}
}
function handleResponseProtypeedit()
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

//type add validation
function add_type_val(){
//alert(document.getElementById("add_title").value);
 if(document.getElementById("admin_type").value==''){
	   alert('Please Enter Admin Type');
	   document.getElementById("admin_type").focus();
	   return false;
	}
else if(document.getElementById("type_check").value==1){
	   alert('This type already exists');
	   document.getElementById("admin_type").focus();
	   return false;
}
else{
	return true;
	}
}
//type edit validation
function edit_type_val(){
//alert(document.getElementById("edit_title").value);
 if(document.getElementById("admin_type_edit").value!='' && document.getElementById("type_check_edit").value==1){
	   alert('This type already exists');
	   document.getElementById("admin_type_edit").focus();
	   return false;
}
	else{
	return true;
	}
}


<!-- ****************************** FOR ADMIN TYPE END**************************** -->

<!-- ****************************** FOR ADMIN USER **************************** -->
//type check
function user_availability(id)
{
	
	if(id!='')
	{
	var chkstr = id;
	var url='admin_type_availability.php?act=user&str='+chkstr;
	http.open('get',url);
	http.onreadystatechange = handleResponseUser;
	http.send(null);
	}
	else{
	document.getElementById('exsists').style.display = 'none';
	document.getElementById('notexsists').style.display = 'none';
	}
}
function handleResponseUser()
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText+'';
		if(response==1)
			{
				document.getElementById('exsists').style.display = 'inline'; 
				document.getElementById('notexsists').style.display = 'none';
				document.getElementById('type_check').value=1;
			}
			if(response==0)
			{
		   	  	document.getElementById('exsists').style.display = 'none'; 
    			document.getElementById('notexsists').style.display = 'inline';
				document.getElementById('type_check').value=2;
			}
     }
}
//type check for edit
function user_availability_edit(id)
{
	
	if(id!='')
	{
	var chkstr = id;
	if(id==document.getElementById('admin_user_or').value){
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'inline';
	document.getElementById('type_check_edit').value=2;
	}
	else{
	var url='admin_type_availability.php?act=user&str='+chkstr;
	http.open('get',url);
	http.onreadystatechange = handleResponseUserEdit;
	http.send(null);
	}
	}
	else{
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'none';
	}
}
function handleResponseUserEdit()
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

//type add validation
function add_user_val(){
//alert(document.getElementById("add_title").value);
 if(document.getElementById("admin_user_name").value==''){
	   alert('Please Enter User Name');
	   document.getElementById("admin_user_name").focus();
	   return false;
	}
	else if(document.getElementById("type_check").value==1){
	   alert('This user name already exists');
	   document.getElementById("admin_user_name").focus();
	   return false;
}
else if(document.getElementById("admin_pass").value==''){
	   alert('Please Enter Password');
	   document.getElementById("admin_pass").focus();
	   return false;
	}
	else if(document.getElementById("user_type").value==''){
	   alert('Please select admin type');
	   document.getElementById("user_type").focus();
	   return false;
	}
else{
	return true;
	}
}
//type edit validation
function add_user_val_edit(){
//alert(document.getElementById("add_title").value);
 if(document.getElementById("admin_user_name_edit").value!='' && document.getElementById("type_check_edit").value==1){
	   alert('This user name already exists');
	   document.getElementById("admin_user_name_edit").focus();
	   return false;
}
else if(document.getElementById("admin_pass_edit").value==''){
	   alert('Please Enter Password');
	   document.getElementById("admin_pass_edit").focus();
	   return false;
	}
	else if(document.getElementById("user_type_edit").value==''){
	   alert('Please select admin type');
	   document.getElementById("user_type_edit").focus();
	   return false;
	}
else{
	return true;
	}
}

<!-- ****************************** FOR ADMIN USER END**************************** -->


<!-- ****************************** FOR category**************************** -->
function category_availability(id,pagename)
{
	alert(pagename);
	if(id!='')
	{
	var chkstr = id;
	var url='category_availability.php?act='+pagename+'&str='+chkstr;
	http.open('get',url);
	http.onreadystatechange = handleResponsecatname;
	http.send(null);
	}
	else{
	document.getElementById('exsists').style.display = 'none';
	document.getElementById('notexsists').style.display = 'none';
	}
}
function handleResponsecatname()
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText+'';
		if(response==1)
			{
				document.getElementById('exsists').style.display = 'inline'; 
				document.getElementById('notexsists').style.display = 'none';
				document.getElementById('type_check').value=1;
			}
			if(response==0)
			{
		   	  	document.getElementById('exsists').style.display = 'none'; 
    			document.getElementById('notexsists').style.display = 'inline';
				document.getElementById('type_check').value=2;
			}
     }
}
//type check for edit
function category_availability_edit(id,pagename)
{
	
	if(id!='')
	{
	var chkstr = id;
	if(id==document.getElementById('category_or').value){
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'inline';
	document.getElementById('type_check_edit').value=2;
	}
	else{
	var url='category_availability.php?act=type&str='+chkstr;
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
//type add validation
function add_cat_val(){
//alert(document.getElementById("add_title").value);
 if(document.getElementById("category").value==''){
	   alert('Please Enter Category');
	   document.getElementById("category").focus();
	   return false;
	}
else if(document.getElementById("type_check").value==1){
	   alert('This category already exists');
	   document.getElementById("category").focus();
	   return false;
}
else{
	return true;
	}
}
//type edit validation
function edit_cat_val(){
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

