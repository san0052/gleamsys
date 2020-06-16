	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dd",
			dateFormat:"%Y-%m-%d"			
		});		
	};
	
	function modifyOrderStatus(orderId,cId){
		
		statusList1  = window.document.frmOrder.status;
		
		status1      = statusList1.options[statusList1.selectedIndex].value;
		
		
		
		//statusList2  = window.document.frmOrder.status2;
		
		//alert(statusList2);
		
		//status2      = statusList2.options[statusList2.selectedIndex].value;
		status2      = document.getElementById('status2').value;
		//alert(status2);
		status3      = document.getElementById('status3').value;
		//alert(status3);
		
		delivered_by = window.document.frmOrder.del_by;
		del_by       = delivered_by.value;
		feedback     = window.document.frmOrder.fed_by;
		fed_by       = feedback.value;
		// received     = window.document.frmOrder.rec_by;
		recd_by       = document.getElementById('rec_by');
		rec_by 		  = recd_by.value;  
		received_through     = document.getElementById('receive_through');
		receive_through      = receive_through.value;
		deltime    	 = document.getElementById('delivery_time');
		del_time     = deltime.value;
		window.location.href = 'order_process.php?act=modify&oid=' + orderId + '&status=' + status1 + '&status2=' + status2 +'&status3=' + status3 + '&del_by=' + del_by + '&fed_by=' + fed_by +'&rec_by=' + rec_by + '&c_id='+cId + '&del_time=' +del_time+'&receive_through='+receive_through;
	}
	
	function searc(){ 
		/*if(document.getElementById("dd").value=='' && document.getElementById("o_id").value=='' && document.getElementById("month").value=='' && document.getElementById("remarks").value==''){
			alert('Please enter  at least one field');
			return false;
		}*/
		if(document.getElementById("dd").value!=''){
			document.getElementById("orderdatehidden").value=document.getElementById("dd").value;
		}
		if(document.getElementById("start_date").value!=''){
			document.getElementById("stdate").value=document.getElementById("start_date").value;
		}
		if(document.getElementById("end_date").value!=''){
			document.getElementById("endate").value=document.getElementById("end_date").value;
		}
		return true;
		//return false;
		
	}
	
	function  getOrderStatus(status){
		document.getElementById("statushidden").value=status;
		window.location.href='order.php?status='+status;
	}
	
	function delivered_by_form_view(id){
		if(document.getElementById(id).value=="Yes"){
			// document.getElementById("feedback_place_holder").style.display='none';
			document.getElementById("delivered_by_place_holder").style.display='inline';
		}
		if(document.getElementById(id).value=="No"){
			document.getElementById("delivered_by_place_holder").style.display='none';
			// document.getElementById("feedback_place_holder").style.display='inline';
		}
		if(document.getElementById(id).value=="Attempted"){
			document.getElementById("delivered_by_place_holder").style.display='none';
			// document.getElementById("feedback_place_holder").style.display='inline';
		}
	}
	
	function validation(pageno,pId,secpid){ 
		var n=0;
		var flag=0;
		var flag=0;
		var ar=new Array();
		var n=0;
		
		if(document.frmsearch.dropdown1.value==''){
		
			alert('Please choose one action');
			return false;
		}
		
		if(document.frmsearch.dropdown1.value=='delete'){
		
			var m=document.frmsearch.checkvalue.length+'';
			
			if(m=='undefined'){
				if(document.frmsearch.checkvalue.checked==true){
					flag++;
					var id= document.frmsearch.checkvalue.value;
					ar[0] = id;
				}
			}
			
			if(m>1){
				for(i = 0; i< document.frmsearch.checkvalue.length; i++){
					if(document.frmsearch.checkvalue[i].checked==true){
						var id= document.frmsearch.checkvalue[i].value;
						ar[n++] = id;	
						flag ++;
					}
				}
			}
			
			if(flag == 0){
				alert('No record selected');
				return false;
			}
			
			if(flag > 0){
				if(confirm('Do you want to delete these records')==true){   
					var pageno1=pageno;
					window.location.href="order_process.php?act=muldel&id="+ar+"&pageno="+pageno1+"&pId="+pId+"&secpid="+secpid;
					return true;
				}
				else{
					return false;
				}
			}	
		}
	}

	function checkall(){
	
		if(document.getElementById("check_all").checked==true){
		
			var m=document.frmsearch.checkvalue.length+'';
			if(m=='undefined'){
				document.frmsearch.checkvalue.checked=true;
			}
		
			for(i = 0; i< document.frmsearch.checkvalue.length; i++){
		
				document.frmsearch.checkvalue[i].checked=true;
			}
		}
		
		if(document.getElementById("check_all").checked==false){
	
			var m=document.frmsearch.checkvalue.length+'';
			if(m=='undefined'){
				document.frmsearch.checkvalue.checked=false;
			}
			
			for(i = 0; i< document.frmsearch.checkvalue.length; i++){
			
				document.frmsearch.checkvalue[i].checked=false;
			}
		}
		
	}