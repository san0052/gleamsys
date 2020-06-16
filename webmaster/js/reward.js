function add_val(){  // add product
	if(document.frmadd.rewardname.value == "")
	{
		alert("Please enter reward");
		document.frmadd.rewardname.focus();
		return false;
	}
	if(document.getElementById('reward_chk').value==1){
		alert("Reward already exists");
		document.frmadd.rewardname.focus();
		return false;
	}
	if(document.frmadd.points.value == "")
	{
		alert("Please enter points");
		document.frmadd.points.focus();
		return false;
	}
	if(isNaN(document.frmadd.points.value))
	{
		alert("Point should be numeric");
		document.frmadd.points.focus();
		return false;
	}
	return true;
}
function edit_val(){  // add product
	if(document.frmedit.rewardname_edit.value == "")
	{
		alert("Please enter reward");
		document.frmedit.rewardname_edit.focus();
		return false;
	}
	if(document.getElementById('reward_chk_edit').value==1){
		alert("Reward already exists");
		document.frmedit.rewardname_edit.focus();
		return false;
	}
	if(document.frmedit.points_edit.value == "")
	{
		alert("Please enter points");
		document.frmedit.points_edit.focus();
		return false;
	}
	if(isNaN(document.frmedit.points_edit.value))
	{
		alert("Point should be numeric");
		document.frmedit.points_edit.focus();
		return false;
	}
	return true;
}
<!-- ****************************** FOR PRODUCT TYPE **************************** -->
//type check
function type_availability(id)
{
	if(id!='')
	{
	var chkstr = id;
	var url='reward_availability.php?str='+chkstr;
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
				document.getElementById('reward_chk').value=1;
			}
			if(response==0)
			{
		   	  	document.getElementById('exsists').style.display = 'none'; 
    			document.getElementById('notexsists').style.display = 'inline';
				document.getElementById('reward_chk').value=2;
			}
     }
}
//type check for edit
function type_availibility_edit(id)
{
	
	if(id!='')
	{
	var chkstr = id;
	if(id==document.getElementById('rewardname_or').value){
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'inline';
	document.getElementById('reward_chk_edit').value=2;
	}
	else{
	var url='reward_availability.php?str='+chkstr;
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
				document.getElementById('reward_chk_edit').value=1;
			}
			if(response==0)
			{
		   	  	document.getElementById('exsists_edit').style.display = 'none'; 
    			document.getElementById('notexsists_edit').style.display = 'inline';
				document.getElementById('same_edit').style.display = 'none';
				document.getElementById('reward_chk_edit').value=2;
			}
     }
}

//type add validation
function add_type_val(){
//alert(document.getElementById("add_title").value);
 if(document.getElementById("lens_type").value==''){
	   alert('Please Enter Type');
	   document.getElementById("lens_type").focus();
	   return false;
	}
else if(document.getElementById("type_check").value==1){
	   alert('This type already exists');
	   document.getElementById("lens_type").focus();
	   return false;
}
else{
	return true;
	}
}
//type edit validation
function edit_type_val(){
//alert(document.getElementById("edit_title").value);
 if(document.getElementById("lens_type_edit").value==''){
	  alert('Please Enter Type');
	   document.getElementById("lens_type_edit").focus();
	   return false;
	}
else if(document.getElementById("type_check_edit").value==1){
	   alert('This type already exists');
	   document.getElementById("lens_type_edit").focus();
	   return false;
}
	else{
	return true;
	}
}


<!-- ****************************** FOR PRODUCT TYPE END**************************** -->

<!-- ****************************** FOR PRODUCT BRAND **************************** -->

//type check
function brand_availability(id)
{
	if(id!='')
	{
	var chkstr = id;
	var url='product_brand_availability.php?type=contactlens&str='+chkstr;
	http.open('get',url);
	http.onreadystatechange = handleResponseProbrand;
	http.send(null);
	}
	else{
	document.getElementById('brand_exsists').style.display = 'none';
	document.getElementById('brand_notexsists').style.display = 'none';
	}
}
function handleResponseProbrand()
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText+'';
		if(response==1)
			{
				document.getElementById('brand_exsists').style.display = 'inline'; 
				document.getElementById('brand_notexsists').style.display = 'none';
				document.getElementById('brand_check').value=1;
			}
			if(response==0)
			{
		   	  	document.getElementById('brand_exsists').style.display = 'none'; 
    			document.getElementById('brand_notexsists').style.display = 'inline';
				document.getElementById('brand_check').value=2;
			}
     }
}
//type check for edit
function brand_availibility_edit(id)
{
	
	if(id!='')
	{
	var chkstr = id;
	if(id==document.getElementById('lens_brand_or').value){
	document.getElementById('brand_exsists_edit').style.display = 'none';
	document.getElementById('brand_notexsists_edit').style.display = 'none';
	document.getElementById('same_brand_edit').style.display = 'inline';
	document.getElementById('brand_check_edit').value=2;
	}
	else{
	var url='product_brand_availability.php?type=contactlens&str='+chkstr;
	http.open('get',url);
	http.onreadystatechange = handleResponseProbrandedit;
	http.send(null);
	}
	}
	else{
	document.getElementById('brand_exsists_edit').style.display = 'none';
	document.getElementById('brand_notexsists_edit').style.display = 'none';
	document.getElementById('same_brand_edit').style.display = 'none';
	}
}
function handleResponseProbrandedit()
{
	if(http.readyState == 4 && http.status == 200)
	{
		
		var response = http.responseText+'';
		if(response==1)
			{
				document.getElementById('brand_exsists_edit').style.display = 'inline'; 
				document.getElementById('brand_notexsists_edit').style.display = 'none';
				document.getElementById('same_brand_edit').style.display = 'none';
				document.getElementById('brand_check_edit').value=1;
			}
			if(response==0)
			{
		   	  	document.getElementById('brand_exsists_edit').style.display = 'none'; 
    			document.getElementById('brand_notexsists_edit').style.display = 'inline';
				document.getElementById('same_brand_edit').style.display = 'none';
				document.getElementById('brand_check_edit').value=2;
			}
     }
}

//type add validation
function add_brand_val(){
//alert(document.getElementById("add_title").value);
 if(document.getElementById("lens_brand").value==''){
	   alert('Please Enter Brand');
	   document.getElementById("lens_brand").focus();
	   return false;
	}
else if(document.getElementById("brand_check").value==1){
	   alert('This brand already exists');
	   document.getElementById("lens_brand").focus();
	   return false;
}
else{
	return true;
	}
}
//type edit validation
function edit_brand_val(){
//alert(document.getElementById("edit_title").value);
 if(document.getElementById("lens_brand_edit").value==''){
	  alert('Please Enter Brand');
	   document.getElementById("lens_brand_edit").focus();
	   return false;
	}
else if(document.getElementById("brand_check_edit").value==1){
	   alert('This type already exists');
	   document.getElementById("lens_brand_edit").focus();
	   return false;
}
	else{
	return true;
	}
}

<!-- ****************************** FOR PRODUCT BRAND END**************************** -->

<!-- ****************************** FOR PRODUCT Image delete**************************** -->
function chck(){
var flag=0;
var m=document.frm.delImg.length+'';
if(m=='undefined')
{
 if(document.frm.delImg.checked==true)
{
flag = 1;
}
}
for(i = 0; i< document.frm.delImg.length; i++)
{
 if(document.frm.delImg[i].checked==true)
{
flag = 1;
}
}
if(flag==0){
alert('Please Select Atleast One Image');
return false;
}
}
<!-- ****************************** FOR PRODUCT Image delete END**************************** -->