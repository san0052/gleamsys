function chkAddProduct(){  // add product
	if(document.frmadd.prod_name.value == "")
	{
		alert("Please enter product name");
		document.frmadd.prod_name.focus();
		return false;
	}
	if(document.frmadd.prod_price.value == "")
	{
		alert("Please enter your product price");
		document.frmadd.prod_price.focus();
		return false;
	}
	if(isNaN(document.frmadd.prod_price.value))
	{
		alert("Price should be numeric");
		document.frmadd.prod_price.focus();
		return false;
	}
	if(isNaN(document.frmadd.prod_discount.value) && document.frmadd.prod_discount.value!='')
	{
		alert("Discount should be numeric");
		document.frmadd.prod_discount.focus();
		return false;
	}
	if(document.frmadd.prod_qty.value == "")
	{
		alert("Please enter product quantity");
		document.frmadd.prod_qty.focus();
		return false;
	}
	if(isNaN(document.frmadd.prod_qty.value))
	{
		alert("Quantity should be numeric");
		document.frmadd.prod_qty.focus();
		return false;
	}
	if(document.frmadd.prod_category.value == "")
	{
		alert("Please enter product category");
		document.frmadd.prod_category.focus();
		return false;
	}
	if(document.frmadd.prod_water_content.value == "")
	{
		alert("Please enter product water content");
		document.frmadd.prod_water_content.focus();
		return false;
	}
	if(document.frmadd.prod_uv_block.value == "")
	{
		alert("Please enter product UV Blocking");
		document.frmadd.prod_uv_block.focus();
		return false;
	}
	if(document.frmadd.prod_packaging.value == "")
	{
		alert("Please enter product packaging details");
		document.frmadd.prod_packaging.focus();
		return false;
	}
	if(document.frmadd.prod_diameter.value == "")
	{
		alert("Please enter product diameter");
		document.frmadd.prod_diameter.focus();
		return false;
	}
	if(document.frmadd.prod_base_curve.value == "")
	{
		alert("Please enter product base curve");
		document.frmadd.prod_base_curve.focus();
		return false;
	}
	if(document.frmadd.prod_lens_material.value == "")
	{
		alert("Please enter lens material");
		document.frmadd.prod_lens_material.focus();
		return false;
	}
	return true;
}
function chkEditProduct(){  //edit product
	if(document.frmedit.prod_name_edit.value == "")
	{
		alert("Please enter product name");
		document.frmedit.prod_name_edit.focus();
		return false;
	}
	if(document.frmedit.prod_price_edit.value == "")
	{
		alert("Please enter your product price");
		document.frmedit.prod_price_edit.focus();
		return false;
	}
	if(isNaN(document.frmedit.prod_price_edit.value))
	{
		alert("Price should be numeric");
		document.frmedit.prod_price_edit.focus();
		return false;
	}
	if(isNaN(document.frmedit.prod_discount_edit.value) && document.frmedit.prod_discount_edit.value!='')
	{
		alert("Discount should be numeric");
		document.frmedit.prod_discount_edit.focus();
		return false;
	}
	if(document.frmedit.prod_qty_edit.value == "")
	{
		alert("Please enter product quantity");
		document.frmedit.prod_qty_edit.focus();
		return false;
	}
	if(isNaN(document.frmedit.prod_qty_edit.value))
	{
		alert("Quantity should be numeric");
		document.frmedit.prod_qty_edit.focus();
		return false;
	}
	if(document.frmedit.prod_category_edit.value == "")
	{
		alert("Please enter product category");
		document.frmedit.prod_category_edit.focus();
		return false;
	}
	if(document.frmedit.prod_water_content_edit.value == "")
	{
		alert("Please enter product water content");
		document.frmedit.prod_water_content_edit.focus();
		return false;
	}
	if(document.frmedit.prod_uv_block_edit.value == "")
	{
		alert("Please enter product UV Blocking");
		document.frmedit.prod_uv_block_edit.focus();
		return false;
	}
	if(document.frmedit.prod_packaging_edit.value == "")
	{
		alert("Please enter product packaging details");
		document.frmedit.prod_packaging_edit.focus();
		return false;
	}
	if(document.frmedit.prod_diameter_edit.value == "")
	{
		alert("Please enter product diameter");
		document.frmedit.prod_diameter_edit.focus();
		return false;
	}
	if(document.frmedit.prod_base_curve_edit.value == "")
	{
		alert("Please enter product base curve");
		document.frmedit.prod_base_curve_edit.focus();
		return false;
	}
	if(document.frmedit.prod_lens_material_edit.value == "")
	{
		alert("Please enter lens material");
		document.frmedit.prod_lens_material_edit.focus();
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
	var url='product_type_availability.php?str='+chkstr;
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
	if(id==document.getElementById('lens_type_or').value){
	document.getElementById('exsists_edit').style.display = 'none';
	document.getElementById('notexsists_edit').style.display = 'none';
	document.getElementById('same_edit').style.display = 'inline';
	document.getElementById('type_check_edit').value=2;
	}
	else{
	var url='product_type_availability.php?str='+chkstr;
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