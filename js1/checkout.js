function getDeliveryCities(city_id){
				var city=document.getElementById(city_id).value;
				
				var param = "act=get_delivery_city&value="+city;
				console.log("==>"+param);
					$.ajax({

						url: 'confirmation.php',

						type: 'POST',

						data: param,

						dataType: 'text',

						success : function(response){
							var obj=JSON.parse(response);
							if(parseFloat(obj['RemoteAreaCharge'])>0)
							{
								document.getElementById('extraCharge').innerHTML='Rs.'+obj['RemoteAreaCharge']+' extra Delivery charge is applicable for Remote area';
								document.getElementById('extra_charge').value=obj['RemoteAreaCharge'];
							} else {
								document.getElementById('extraCharge').innerHTML='';
								document.getElementById('extra_charge').value=parseFloat(obj['RemoteAreaCharge']);
							}
						}
						});
				}

						

									

							

			/*=========== END OF GETTING MIDNIGHT CITY LIST ===============*/

			function get_old_msg(){

				$('#backendmsg').css('display','block');

				$('#openmsg').css('display','block');

			}

			function closemsg(){

			$('#backendmsg').css('display','none');

			$('#openmsg').css('display','none');		

			}

			function fit_msg(msg){

			$('#hidShippingMsg').text(msg);
			
			$('#backendmsg').css('display','none');

			$('#openmsg').css('display','none');

			}
			function getmassage(val){
				if(val!='')
				{
					//alert('notes_description_process.php?nid='+val+'&act=description');
					$.ajax({
	                     type: "POST",
	                     url: "notes_description_process.php",
	                     data: "nid="+val+"&act=description",
	                     dataType: "html",
						 async:false,
	                     success: function(msg){
	                     	//alert(msg);
	                     	$('#hidShippingMsg').text(msg);
		                 }
				   });
	            }
	            else
	            {
	            	alert('Please Select the Greeting First ');
	            }

			}

			function shipping_type_val(ob){

				var check=$('#'+ob).val();

				$.ajax({

                     type: "POST",

                     url: "notes_description_process.php",

                     data: "name="+check+"&act=shipping_type",

                   success: function(msg){

                 // alert(msg);

                  var arr = msg.split("|||||");

                 // alert('amount'+arr[0]+'value'+arr[1]);

                  		var ch='';

	                  	if(check=='fixed'){

	                  		ch='Fixed Time';

	                  		$('#delivery_time').attr('disabled','');

	                  	}else if(check=='mid_night'){

	                  		ch='Mid-Night';

	                  		$('#delivery_time').val('');

	                  		$('#delivery_time').attr('disabled','disabled');

	                  	}else{

	                  		ch='Normal';

	                  		$('#delivery_time').val('');

	                  		$('#delivery_time').attr('disabled','disabled');

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

			

			

			

			

function chk_quick_shop()

{

	

	var flag=0;

	var regexNum = /\d/;

	var regexLetter = /[a-zA-z]/;	

	var currentTime = new Date();

	var month = currentTime.getMonth() + 1;

	var day = currentTime.getDate();

	var year = currentTime.getFullYear();

	var dts = day + "-" + month + "-" + year;

	var shipdate = new Array();

	var shpdt= $('#hidShippingDate').val();

	//shipdate = shpdt.split("-");alert(shipdate);

	/*if(year>shipdate[2])

	{

		flag=1;

	}

	if(year==shipdate[2])

	{

		if(month>shipdate[1])

		{

			flag=1;

		}

		if(month==shipdate[1])

		{

			if(day>shipdate[0] || day==shipdate[0])

			{

				flag=1;

			}

		}

	}*/

	if(document.frmqckshop.hidShippingEmail.value==""){

	alert('Please insert your email address');

	document.frmqckshop.hidShippingEmail.focus();

	return false;

	}

	

	/*if (echeck(document.frmqckshop.hidShippingEmail.value)==false){

	document.frmqckshop.hidShippingEmail.value="";

	document.frmqckshop.hidShippingEmail.focus();

	return false;

	}*/

	if($('#hidShippingDate').val()==""){

	alert('Please insert your Shipping delivery date');

	$('#hidShippingDate').focus();

	return false;

	}

	

	/*if(shipdate[2]<year){

	alert('Invalid shipping delivery date');

	document.frmqckshop.hidShippingDate.focus();

	return false;

	}*/

	if(document.frmqckshop.hidShippingFirstName.value==""){

	alert('Please insert your Shipping first name');

	document.frmqckshop.hidShippingFirstName.focus();

	return false;

	}

	if(!regexLetter.test(document.frmqckshop.hidShippingFirstName.value)){

	alert('Type alphabet for your Shipping first name');

	document.frmqckshop.hidShippingFirstName.value="";

	document.frmqckshop.hidShippingFirstName.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingLastName.value==""){

	alert('Please insert your Shipping last name');

	document.frmqckshop.hidShippingLastName.focus();

	return false;

	}

	if(!regexLetter.test(document.frmqckshop.hidShippingLastName.value)){

	alert('Type alphabet for your Shipping last name');

	document.frmqckshop.hidShippingLastName.value="";

	document.frmqckshop.hidShippingLastName.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingAddress1.value==""){

	alert('Please insert your shipping address');

	document.frmqckshop.hidShippingAddress1.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingCity.value==""){

	alert('Please insert your Shipping city');

	document.frmqckshop.hidShippingCity.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingPostalCode.value==""){

	alert('Please insert your Shipping Postal Code');

	document.frmqckshop.hidShippingPostalCode.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingState.value==""){

	alert('Please insert your Shipping state');

	document.frmqckshop.hidShippingState.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingCountry.value==""){

	alert('Please select your Shipping country');

	document.frmqckshop.hidShippingCountry.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingPhone.value==""){

	alert('Please insert your Shipping contact number');

	document.frmqckshop.hidShippingPhone.focus();

	return false;

	}

	if(isNaN(document.frmqckshop.hidShippingPhone.value)){

	alert('Contact No Must Be Numeric');

	document.frmqckshop.hidShippingPhone.value="";

	document.frmqckshop.hidShippingPhone.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingMsg.value==""){

	alert('Please insert message on card');

	document.frmqckshop.hidShippingMsg.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingSenderName.value==""){

	alert('Please insert sender name');

	document.frmqckshop.hidShippingSenderName.focus();

	return false;

	}

	if(document.frmqckshop.hidShippingIns.value==""){

	alert('Please insert your Shipping special instruction');

	document.frmqckshop.hidShippingIns.focus();

	return false;

	}

	

	if(document.frmqckshop.hidPaymentFirstName.value==""){

	alert('Please insert your Payment first name');

	document.frmqckshop.hidPaymentFirstName.focus();

	return false;

	}

	if(!regexLetter.test(document.frmqckshop.hidPaymentFirstName.value)){

	alert('Type alphabet for your Payment first name');

	document.frmqckshop.hidPaymentFirstName.value="";

	document.frmqckshop.hidPaymentFirstName.focus();

	return false;

	}

	if(document.frmqckshop.hidPaymentLastName.value==""){

	alert('Please insert your Payment last name');

	document.frmqckshop.hidPaymentLastName.focus();

	return false;

	}

	if(!regexLetter.test(document.frmqckshop.hidPaymentLastName.value)){

	alert('Type alphabet for your Payment last name');

	document.frmqckshop.hidPaymentLastName.value="";

	document.frmqckshop.hidPaymentLastName.focus();

	return false;

	}

	if(document.frmqckshop.hidPaymentAddress1.value==""){

	alert('Please insert your payment address');

	document.frmqckshop.hidPaymentAddress1.focus();

	return false;

	}

	if(document.frmqckshop.hidPaymentCity.value==""){

	alert('Please insert your Payment city');

	document.frmqckshop.hidPaymentCity.focus();

	return false;

	}

	if(document.frmqckshop.hidPaymentPostalCode.value==""){

	alert('Please insert your Payment zip code');

	document.frmqckshop.hidPaymentPostalCode.focus();

	return false;

	}

	if(document.frmqckshop.hidPaymentState.value==""){

	alert('Please insert your Payment state');

	document.frmqckshop.hidPaymentState.focus();

	return false;

	}

	if(document.frmqckshop.hidPaymentCountry.value==""){

	alert('Please select your Payment country');

	document.frmqckshop.hidPaymentCountry.focus();

	return false;

	}

	if(document.frmqckshop.hidPaymentPhone.value==""){

	alert('Please insert your Payment contact number');

	document.frmqckshop.hidPaymentPhone.focus();

	return false;

	}

	if(isNaN(document.frmqckshop.hidPaymentPhone.value)){

	alert('Contact No Must Be Numeric');

	document.frmqckshop.hidPaymentPhone.value="";

	document.frmqckshop.hidPaymentPhone.focus();

	return false;

    }

	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (!filter.test(document.frmqckshop.hidPaymentEmail.value) && document.frmqckshop.hidPaymentEmail.value!='')

	{

	alert("Please enter valid email id");

	document.frmqckshop.hidPaymentEmail.focus();

		return false;

	}

	

	//document.frmqckshop.submit();

	//return true;*/

}

