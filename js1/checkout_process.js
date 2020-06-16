//*********************************Get State Details*****************************//

function get_biiling_state(ob){

	var countryid=$('#'+ob).find('option:selected').attr("cnt");

	$.ajax({

                type: "POST",

         		url: "getstateandcity.process.php",

         		data: "countryid="+countryid+"&act=Get_state",

      		 success: function(msg){

      		 	$('#bill_state').html(msg);

      		 }

     }); 		 

}



//******************************Get City Details******************************//



function get_billing_city(ob){

	var stateid=$('#'+ob).find('option:selected').attr("cnt");
		//alert(stateid);
	$.ajax({

                type: "POST",

         		url: "getstateandcity.process.php",

         		data: "stateid="+stateid+"&act=Get_city",

      		 success: function(msg){
				//alert(msg);
      		 	$('#bill_city').html(msg);

      		 }

     }); 		 

}