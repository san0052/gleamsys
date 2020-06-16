function city_availability_add()
{
	var s_id = document.getElementById('state_add').value;
	var id = document.getElementById('category').value;
	var act='checkcity';
	if(id!='' && s_id!='')
	{
	    var url='city_process.php?act='+act+'&str='+id+'&city='+s_id; 
	    http.open('get',url);
	    http.onreadystatechange = handleResponsecitynameadd1;
	    http.send(null);
	}
	else
	{
	    document.getElementById('exsists').style.display = 'none';
	    document.getElementById('notexsists').style.display = 'none';
	}
}


function handleResponsecitynameadd1()
{
	if(http.readyState == 4 && http.status == 200)
	{
		
		var response = http.responseText+'';
		//alert(1);
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