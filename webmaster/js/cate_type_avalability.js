function typ_availability(id)
{
	
	if(id!='')
	{
	var chkstr = id;
	var url='cate_type_av.php?act=type&str='+chkstr;
	
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


//type add validation
function add_typ_val(){
//alert(document.getElementById("add_title").value);
 if(document.getElementById("cat_name").value==''){
	   alert('Please Enter Category');
	   document.getElementById("cat_name").focus();
	   return false;
	}
else if(document.getElementById("type_check").value==1){
	   alert('This type already exists');
	   document.getElementById("cat_name").focus();
	   return false;
}
else{
	return true;
	}
}
//type edit validation
