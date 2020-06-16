/*=============SHIPPING TYPE CHECKING===================*/
function shipping_type_val(ob){
				var check=$('#'+ob).val();
				get_time(check);
				$.ajax({
                     type: "POST",
                     url: "notes_description_process.php",
                     data: "name="+check+"&act=shipping_type",
                   success: function(msg){
					   //alert(msg);
                  var arr = msg.split("|||||");
                 // alert('amount'+arr[0]+'value'+arr[1]);
                  	var ch='';
	                  	if(check=='fixed'){
	                  		ch='Fixed Time';
	                  		//$('#delivery_time').removeAttr('disabled');
	                  	}else if(check=='mid_night'){
	                  		ch='Mid-Night';
	                  		//$('#delivery_time').val('');
	                  		//$('#delivery_time').attr('disabled','disabled');
	                  	}else{
	                  		ch='Normal';
	                  		//$('#delivery_time').val('');
	                  		//$('#delivery_time').attr('disabled','disabled');
	                  	}
	                  if(arr[0]>0){
	                  	$('#shipping_type_dis').html("As you select "+ch+" Delivery. You Have To Pay Extra "+arr[0]);
	                  	$('#shipping_type_charge').val(arr[0]);
	                  	$('#shipping_type_dis').css('display','block');
	                  }else{
	                 // 	Var str='You Have To Pay Extra '+arr[0]+' For Shipping Type'+check;
	                 	$('#shipping_type_dis').html("");
	                  	$('#shipping_type_charge').val(0);
	                  	$('#shipping_type_dis').css('display','none');
	                  }
				  // $('#hidShippingMsg').val(msg);
                   }
				   });
			}
			
	function get_time(type){
		$.ajax({
                     type: "POST",
                     url: "confirmation.php",
                     data: "type="+type+"&act=get_delivery_time",
                   success: function(msg){
					   $('#delivery_time_placeholder').html(msg);
				   }
				   
			   });
		
	}		


/*=============END SHIPPING TYPE CHECKING===============*/
function valide_details(){
	var delivary_date=$('#delivar_date').val();
	var city =$('#city').val();
	var shipping_type=$('#shipping_type').val();
	if(city==''){
		alert('select city ');
		$('#city').focus();
		return false;
	}
	if(shipping_type==''){
		alert('select shipping type ');
		$('#shipping_type').focus();
		return false;
	}
	if(delivary_date==''){
		alert('select delivary date');
		$('#delivar_date').focus();
		return false;
	}
	if(shipping_type=='fixed'){
		delivery_time=$('#delivery_time').val();
		if(delivery_time==''){
			alert('Select Preferred Time');
			$('#delivery_time').focus();
			return false;
		}
	}
}
/*==================================== Get Delivery Charges ================================*/
function getDeliveryCities(city_id){
				var city=document.getElementById(city_id).value;
				var param = "act=get_delivery_city&value="+city;
				if(city!=""){	
					$.ajax({
						url: 'confirmation.php',
						type: 'POST',
						data: param,
						dataType: 'text',
						success : function(response){
							var arr = response.split("|||||");
							if(arr[0]==1){
								if(arr[1]!=''){
									$("#extra_charge").html("Rs. "+arr[1]+" Extra Delivery charge applicable.");
									$("#charge").val(arr[1]);									
								}
								else{
									$("#extra_charge").html("");
									$("#charge").val(0);
								}
							}
							if(arr[0]==0){
								$("#extra_charge").html("");
							}
						}		
					});
				}
				else{
					$("#extra_charge").html("");
				}
			}