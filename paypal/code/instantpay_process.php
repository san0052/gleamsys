	<?php
	include_once('includes1/session.php');
	include_once("includes/frontend.init.php"); 
	include_once('includes/function.php');
	$_SESSION['site']='2';
	$sid=session_id();
	$action=@$_REQUEST['action'];

	switch ($action){
		case 'checkout' :	
			//$cartContent = getCartContent();
			//$numItem = count($cartContent);

			//$autoregister= autoRegister();
			//$orderId     = saveOrder();
			//echo '<br/>'.$orderAmount = getOrderAmount($orderId);
			$orderId =$_REQUEST['orderId'];
			$orderUserDetails = getOrderUserDetails($orderId);
			$numUser = count($orderUserDetails);
			
			//for ($j = 0; $j < $numUser; $j++) {
			//	extract($orderUserDetails[$j]);
				$user_name 					= 	$_REQUEST['order_shipping_sender_name'];
				$user_payment_first_name 	= 	$_REQUEST['hidPaymentFirstName'];
				$user_payment_last_name 	= 	$_REQUEST['hidPaymentLastName'];
				$user_payment_address1 		= 	$_REQUEST['hidPaymentAddress1'];
				$user_payment_address2 		= 	$_REQUEST['hidPaymentAddress1'];
				$country_payment_id 		= 	$_REQUEST['hidPaymentCountry'];
				$user_payment_state 		= 	$_REQUEST['hidPaymentState'];
				$user_payment_city 			= 	$_REQUEST['hidPaymentCity'];
				$user_payment_postal_code 	= 	$_REQUEST['hidPaymentPostalCode'];
				$user_payment_phone 		= 	$_REQUEST['hidPaymentPhone'];
		//	}
			$_SESSION['orderId'] = $orderId;
			$itemDetail = array();
			
			for ($i = 0; $i < $numItem; $i++){
				extract($cartContent[$i]);
				$itemDetail[$i] = '('.$ct_qty.' X '.displayFrontAmount($pd_price).') '.$pd_name;
			}
			
			$itemDetail = implode(",",$itemDetail);
			
			/*==================================================================================================================*/
			
			$hidShippingEmail	  = $_REQUEST['hidShippingEmail'];		
			$hidShippingDate = ucwords($_REQUEST['hidShippingDate']);				
			$hidShippingFirstName = ucwords($_REQUEST['hidShippingFirstName']);
			$hidShippingLastName  = ucwords($_REQUEST['hidShippingLastName']);
			$hidShippingAddress1  = $_REQUEST['hidShippingAddress1'];
			$hidShippingLandMark	  = $_REQUEST['hidShippingLandMark'];
			$hidShippingCountry   = $_REQUEST['hidShippingCountryId'];
			$hidShippingState  	  = $_REQUEST['hidShippingState'];
			$hidShippingCity      = ucwords($_REQUEST['hidShippingCity']);
			$hidShippingPostalCode= $_REQUEST['hidShippingPostalCode'];
			$hidShippingPhone	  = $_REQUEST['hidShippingPhone'];
			$hidShippingMsg  = $_REQUEST['hidShippingMsg'];
			$hidShippingSenderName  = $_REQUEST['hidShippingSenderName'];
			$hidShippingIns= $_REQUEST['hidShippingIns'];
			
			$hidPaymentFirstName  = ucwords($_REQUEST['hidPaymentFirstName']);
			$hidPaymentLastName   = ucwords($_REQUEST['hidPaymentLastName']);
			$hidPaymentAddress1	  = $_REQUEST['hidPaymentAddress1'];
			$hidPaymentLandMark	  = $_REQUEST['hidPaymentLandMark'];
			$hidPaymentCountry	  = $_REQUEST['hidPaymentCountry'];
			$hidPaymentState	  = $_REQUEST['hidPaymentState'];
			$hidPaymentCity       = ucwords($_REQUEST['hidPaymentCity']);
			$hidPaymentPostalCode = $_REQUEST['hidPaymentPostalCode'];
			$hidPaymentPhone	  = $_REQUEST['hidPaymentPhone'];
			$hidPaymentEmail	  = $_REQUEST['hidPaymentEmail'];
			$countryShippings 	  = strtolower(ucfirst($_REQUEST['hidShippingCountry']));
			$countryBillings 	  = strtolower(ucfirst($_REQUEST['hidPaymentCountry']));
			
			$orderAmount		  = $_REQUEST['grndAmount'];

			$Amount = $orderAmount;                      	 //your script should substitute the amount in the quotes provided here
			$Order_Id = $orderId;							 //your script should substitute the order description in the quotes provided here

			$billing_cust_name=$hidPaymentFirstName.' '.$hidPaymentLastName;
			$billing_cust_address=$hidPaymentAddress1;
			$billing_cust_landmark=$hidPaymentLandMark;
			$billing_cust_state=$hidPaymentState;
			$billing_cust_country=countryName($hidPaymentCountry);
			$billing_cust_tel=$hidPaymentPhone;
			$billing_cust_email=$hidShippingEmail;
			$delivery_cust_name=$hidShippingFirstName.' '.$hidShippingLastName;
			$delivery_cust_address=$hidShippingAddress1;
			$delivery_cust_state = $hidShippingState;
			$delivery_cust_country = countryName($hidShippingCountry);
			$delivery_cust_tel=$hidShippingPhone;
			$delivery_cust_notes=$hidShippingIns;
			$Merchant_Param="" ;
			$billing_city = $hidPaymentCity ;
			$billing_zip = $hidPaymentPostalCode;
			$delivery_city = $hidShippingCity;
			$delivery_zip = $hidShippingPostalCode;
			
			$delivery_cust_notes=($_REQUEST['order_msg']!='')?$_REQUEST['order_msg']:'with love and care please delivery flowers';
			
	/*		Organizer_checkout($mycms,$cfg,$cfg['CCAVENUE_WORKING_KEY'],$cfg['CCAVENUE_MERCHANT_ID'],$Amount,$Order_Id,$Checksum,$Redirect_Url);
	*/		
			if($_REQUEST['payment_by']=='EBS'){
				
			$Redirect_Url = $cfg['base_url_v']."response.php?DR={DR}";//your redirect URL where your customer will be redirected after authorisation from CCAvenue
			//$Checksum = getchecksum($Merchant_Id,$Amount,$Order_Id ,$Redirect_Url,$WorkingKey);
		    $Merchant_Id = $cfg['EBS_MERCHANT_ID']; 	 //This id(also User Id)  available at "Generate Working Key" of "Settings & Options" 
			$WorkingKey = $cfg['EBS_WORKING_KEY'];		//put in the 32 bit alphanumeric key in the quotes provided here.Please note that get this key ,login to your CCAvenue merchant account and visit the "Generate Working Key" section at the "Settings & Options" page. 
			$PaymentMode = $cfg['EBS_PAYMENT_MODE'];	
				
			$sql_ebs="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_id`='".$Order_Id."'";
			$res_ebs=$heart->sql_query($sql_ebs);	
			$row_ebs=$heart->sql_fetchrow($res_ebs);
			//insert into payment request table//
			$sql_in="INSERT INTO".$cfg['DB_PAYMENT_REQUEST']."
					    SET
					     `getway`='EBS',
					     `Merchant_Id`='".addslashes($Merchant_Id)."',
					     `Amount`='".addslashes($Amount)."',
					     `OrderId`='".addslashes($row_ebs['onlinepaymentcode'])."',
					     `Redirect_Url`='".addslashes($Redirect_Url)."',
					     `checksum`='".$Checksum."',
					     `billing_cust_name`='".addslashes($billing_cust_name)."',
					     `billing_cust_address`='".addslashes($billing_cust_address)."',
					     `billing_cust_landmark`='".addslashes($billing_cust_landmark)."',
					     `billing_cust_country`='".addslashes($countryBillings)."',
					     `billing_cust_state`='".addslashes($billing_cust_state)."',
					     `billing_zip`='".addslashes($billing_zip)."',
					     `billing_cust_tel`='".addslashes($billing_cust_tel)."',
					     `billing_cust_email`='".addslashes($billing_cust_email)."',
					     `delivery_cust_name`='".addslashes($delivery_cust_name)."',
					     `delivery_cust_address`='".addslashes($delivery_cust_address)."',
					     `delivery_cust_country`='".addslashes($countryShippings)."',
					     `delivery_cust_state`='".addslashes($delivery_cust_state)."',
					     `delivery_cust_tel`='".addslashes($delivery_cust_tel)."',
					     `delivery_cust_notes`='".addslashes($delivery_cust_notes)."',
					     `Merchant_Param`='".addslashes($Merchant_Param)."',
					     `billing_cust_city`='".addslashes($billing_city)."',
					     `delivery_cust_city`='".addslashes(getFieldsFromTable($delivery_city,'city_name',$cfg['DB_CITIES'],'ct_id'))."',
					     `delivery_zip_code`='".addslashes($delivery_zip)."'";
				$heart->sql_query($sql_in);
				//end of payment request table//	
			
			include_once('secure.php');
	?>		

	<?
			}
			
			if($_REQUEST['payment_by']=='CCAvenue'){
				$sql_sel="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_id`='".$Order_Id."'";
				$res_sel=$heart->sql_query($sql_sel);	
				$row_sel=$heart->sql_fetchrow($res_sel);
			
			$Redirect_Url = $cfg['base_url_v']."checkout_process.php?action=payment";//your redirect URL where your customer will be redirected after authorisation from CCAvenue
		    $Merchant_Id = $cfg['CCAVENUE_MERCHANT_ID']; 	 //This id(also User Id)  available at "Generate Working Key" of "Settings & Options" 
			$WorkingKey = $cfg['CCAVENUE_WORKING_KEY'];		//put in the 32 bit alphanumeric key in the quotes provided here.Please note that get this key ,login to your CCAvenue merchant account and visit the "Generate Working Key" section at the "Settings & Options" page. 
			$Checksum = getchecksum($Merchant_Id,$Amount,$row_sel['onlinepaymentcode'] ,$Redirect_Url,$WorkingKey);
			
			$sql_in="INSERT INTO".$cfg['DB_PAYMENT_REQUEST']."
					    SET
					     `getway`='CCAvenue',
					     `Merchant_Id`='".$Merchant_Id."',
					     `Amount`='".addslashes($Amount)."',
					     `OrderId`='".$row_sel['onlinepaymentcode']."',
					     `Redirect_Url`='".$Redirect_Url."',
					     `checksum`='".$Checksum."',
					     `billing_cust_name`='".addslashes($billing_cust_name)."',
					     `billing_cust_address`='".addslashes($billing_cust_address)."',
					     `billing_cust_landmark`='".addslashes($billing_cust_landmark)."',
					     `billing_cust_country`='".addslashes($countryBillings)."',
					     `billing_cust_state`='".addslashes($billing_cust_state)."',
					     `billing_zip`='".addslashes($billing_zip)."',
					     `billing_cust_tel`='".addslashes($billing_cust_tel)."',
					     `billing_cust_email`='".addslashes($billing_cust_email)."',
					     `delivery_cust_name`='".addslashes($delivery_cust_name)."',
					     `delivery_cust_address`='".addslashes($delivery_cust_address)."',
					     `delivery_cust_country`='".addslashes($countryShippings)."',
					     `delivery_cust_state`='".addslashes($delivery_cust_state)."',
					     `delivery_cust_tel`='".addslashes($delivery_cust_tel)."',
					     `delivery_cust_notes`='".addslashes($delivery_cust_notes)."',
					     `Merchant_Param`='".addslashes($Merchant_Param)."',
					     `billing_cust_city`='".addslashes($billing_city)."',
					     `delivery_cust_city`='".addslashes(getFieldsFromTable($delivery_city,'city_name',$cfg['DB_CITIES'],'ct_id'))."',
					     `delivery_zip_code`='".addslashes($delivery_zip)."'";
				$heart->sql_query($sql_in);
	?>		
				<form method="post" action="<?=$cfg['CCAVENUE_URL']?>" name="ccavenueform" id="ccavenueform">
					<input type="hidden" name="Merchant_Id" value="<?php echo $Merchant_Id; ?>">
					<input type="hidden" name="Amount" value="<?php echo $Amount; ?>">
					<input type="hidden" name="Currency" value="USD">
					<input type="hidden" name="Order_Id" value="<?php echo $row_sel['onlinepaymentcode'];?>">
					<input type="hidden" name="TxnType" value="A">
	            	<input type="hidden" name="actionID" value="TXN">
					<input type="hidden" name="Redirect_Url" value="<?php echo $Redirect_Url; ?>">
					<input type="hidden" name="Checksum" value="<?php echo $Checksum; ?>">
					<input type="hidden" name="billing_cust_name" value="<?php echo $billing_cust_name; ?>">
					<input type="hidden" name="billing_cust_address" value="<?php echo $billing_cust_address; ?>">
					<input type="hidden" name="billing_cust_landmark" value="<?php echo $billing_cust_landmark; ?>">
					<input type="hidden" name="billing_cust_country" value="<?php echo $countryBillings; ?>">
					<input type="hidden" name="billing_cust_state" value="<?php echo $billing_cust_state; ?>">
					<input type="hidden" name="billing_zip" value="<?php echo $billing_zip; ?>">
					<input type="hidden" name="billing_cust_tel" value="<?php echo $billing_cust_tel; ?>">
					<input type="hidden" name="billing_cust_email" value="<?php echo $billing_cust_email; ?>">
					<input type="hidden" name="delivery_cust_name" value="<?php echo $delivery_cust_name; ?>">
					<input type="hidden" name="delivery_cust_address" value="<?php echo $delivery_cust_address; ?>">
					<input type="hidden" name="delivery_cust_country" value="<?php echo $countryShippings; ?>">
					<input type="hidden" name="delivery_cust_state" value="<?php echo $delivery_cust_state; ?>">
					<input type="hidden" name="delivery_cust_tel" value="<?php echo $delivery_cust_tel; ?>">
					<input type="hidden" name="delivery_cust_notes" value="<?php echo $delivery_cust_notes; ?>">
					<input type="hidden" name="Merchant_Param" value="<?php echo $Merchant_Param; ?>">
					<input type="hidden" name="billing_cust_city" value="<?php echo $billing_city; ?>">
					<input type="hidden" name="delivery_cust_city" value="<?php echo getFieldsFromTable($delivery_city,'city_name',$cfg['DB_CITIES'],'ct_id');?>">
					<input type="hidden" name="delivery_zip_code" value="<?php echo $delivery_zip; ?>">
				</form>
				<center>Processing.........</center>
				<script>
					document.ccavenueform.submit();
				</script>
	<?
			}/* paypal entry*/		 if($_REQUEST['payment_by']=='paypal')
									{

										$sql_sel="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_id`='".$Order_Id."'";			
										$res_sel=$mycms->sql_select($sql_sel);				
										$row_sel=$res_sel[0];					
										$sql_in="INSERT INTO".$cfg['DB_PAYMENT_REQUEST']." SET				     
										`getway`='Paypal',				     
										`Merchant_Id`='".$Merchant_Id."',				     
										`Amount`='".$Amount."',				    
										 `OrderId`='".$row_sel['onlinepaymentcode']."',				    
										  `Redirect_Url`='".$Redirect_Url."',				     
										  `checksum`='".$Checksum."',				    
										   `billing_cust_name`='".$billing_cust_name."',				    
										    `billing_cust_address`='".$billing_cust_address."',				     
										    `billing_cust_landmark`='".$billing_cust_landmark."',				     
										    `billing_cust_country`='".$countryBillings."',				     
										    `billing_cust_state`='".$billing_cust_state."',				     
										    `billing_zip`='".$billing_zip."',				     
										    `billing_cust_tel`='".$billing_cust_tel."',				     
										    `billing_cust_email`='".$billing_cust_email."',				     
										    `delivery_cust_name`='".$delivery_cust_name."',				    
										     `delivery_cust_address`='".$delivery_cust_address."',				     
										     `delivery_cust_country`='".$countryShippings."',				     
										     `delivery_cust_state`='".$delivery_cust_state."',				     
										     `delivery_cust_tel`='".$delivery_cust_tel."',				     
										     `delivery_cust_notes`='".$delivery_cust_notes."',				     
										     `Merchant_Param`='".$Merchant_Param."',				     
										     `billing_cust_city`='".$billing_city."',				     
										     `delivery_cust_city`='".getFieldsFromTable($delivery_city,'city_name',$cfg['DB_CITIES'],'ct_id')."',				     
										     `delivery_zip_code`='".$delivery_zip."'";			
										     $mycms->sql_insert($sql_in);?>						
										     <form action="paypal.php" method="post" name="paypalform" id="paypalform"> 
										     	<?php // remove sandbox=1 for live transactions ?>				    
										     	<input type="hidden" name="action" value="process" />				    
										     	<input type="hidden" name="cmd" value="_cart" /> <?php // use _cart for cart checkout ?>				    
										     	<input type="hidden" name="currency_code" value="USD" />				    
										     	<input type="hidden" name="invoice" value="<?php echo $Order_Id; ?>" />				    
										     	<table>				   
										     	 <tr>				        <!--<td><label>Product ID</label></td>-->				       
										     	  	<td><input type="hidden" name="product_id" value="<?php echo $row_sel['onlinepaymentcode']; ?>" /></td>				    
										     	 </tr>				    
										     	 <tr>				        <!--<td><label>ProductName</label></td>-->				        
										     	  	<td><input type="hidden" name="product_name" value="<?=$product_nm;?>" /></td>				    
										     	 </tr>				    
										     	 <tr>				        <!--<td><label>Product Quantity</label></td>-->				        
										     	  		<td><input type="hidden" name="product_quantity" value="<?php echo $product_qty; ?>" /></td>				    
										     	 </tr>				    
										     	 <tr>				        <!--<td><label>Product Amount</label></td>-->				        
										     	  	<td>
										     	  		<input type="hidden" name="product_amount" value="<?=number_format(getPaypalAmount($Amount), 2, '.', ''); ?>" /></td>				    
										     	 </tr>				    
										     	 <tr>				        <!--<td><label>Payer First Name</label></td>-->				        
										     	  	<td><input type="hidden" name="payer_fname" value="<?=$billing_cust_name;?>" /></td>				    
										     	 </tr>				    
										     	 <tr>				        <!--<td><label>Payer Last Name</label></td>-->				        
										     	  	<td><input type="hidden" name="payer_lname" value="" /></td>				    
										     	 </tr>				    
										     	 <tr>				        <!--<td><label>Payer Address</label></td>-->				        
										     	  	<td><input type="hidden" name="payer_address" value="<?=$billing_cust_address;?>" /></td>				    
										     	 </tr>				    
											     <tr>				        <!--<td><label>Payer City</label></td>-->				        
											     	 <td><input type="hidden" name="payer_city" value="<?=$billing_city;?>" /></td>				    
											     </tr>				    
											     <tr>				        <!--<td><label>Payer State</label></td>-->				        
											     	  <td><input type="hidden" name="payer_state" value="<?=$billing_cust_state;?>" /></td>				    
											     </tr>    				    
											     <tr>				        <!--<td><label>Payer Zip</label></td>-->				       
											     	 <td><input type="hidden" name="payer_zip" value="<?=$billing_zip;?>" /></td>				    
											    </tr>				    
											     <tr>				        <!--<td><label>Payer Country</label></td>-->				        
											     	  <td><input type="hidden" name="payer_country" value="<?=$countryBillings;?>" /></td>				    
											     </tr> 				    
											     <tr>				        <!--<td><label>Payer Email</label></td>-->				        
											     	  <td><input type="hidden" name="payer_email" value="<?=$billing_cust_email;?>" /></td>				   
											     </tr>				    
											     <tr>				        
											     	 <td colspan="2" align="center"><!--<input type="submit" name="submit" value="Submit" />--></td>				    
											    </tr>				    
							     	  	 	 	</table>				
							     	  	 	 	</form>			
							     	  	 	 	<center>Processing.........</center>			
							     	  	 	 	<script>				
							     	  	 	 		document.getElementById("paypalform").submit();				//document.paypalform.submit();			
							     	  	 	 		</script><?		
							     	  	 	 	}
			// Send a notification to admin
			
			$subject = "[New Order] #".$Order_Id;
			$emailadmins   = $cfg['ADMIN_ORDER_EMAIL'];
			$messageadmin = "You have a new order.<br /><br />
			To check the order detail follow the steps below:<br />
			1) Go to to your administration panel.<br />
			2) Login with your Username & Password.<br />
			3) Then click on the below link:<br />".$cfg['base_url']."webmaster/order.php?show=view&login_id=2&id=".$orderId."&eid=".$_SESSION['user_email']."<br /><br />
			<b>NOTE:</b> The payment for this order is under processing now.<br /><br />
			Thanking You<br />
			".$cfg['STUFF_NAME'];
			send_mail($cfg['ADMIN_NAME'], $cfg['ADMIN_EMAIL'], $cfg['ORDERS_NAME'], $emailadmins, $subject, $messageadmin, $bcc='');
			send_mail($cfg['ADMIN_NAME'], $emailadmins, $cfg['ORDERS_NAME'], $emailadmins, $subject, $messageadmin, $bcc='');
			exit();
			break;
	case 'payment' :
			$payment_gateway = @$_REQUEST['payment'];

			$WorkingKey = $cfg['CCAVENUE_WORKING_KEY']; //put in the 32 bit working key in the quotes provided here
			$Merchant_Id= $_REQUEST['Merchant_Id'];
			$Amount= $_REQUEST['Amount'];
			$Order_Id= $_REQUEST['Order_Id'];
			$Merchant_Param= $_REQUEST['Merchant_Param'];
			$Checksum= $_REQUEST['Checksum'];
			$AuthDesc=$_REQUEST['AuthDesc'];
			
			$orderId = $Order_Id;
			
			$sql="INSERT INTO".$cfg['DB_PAYMENT_RESPONSE']."
					 SET 
					 `workingkey`='".$WorkingKey."',
					 `Merchant_Id`='".$Merchant_Id."',
					 `Amount`='".$Amount."',
					 `OrderId`='".$Order_Id."',
					 `Merchant_param`='".$Merchant_Param."',
					 `checksum`='".$Checksum."',
					 `AuthDesc`='".$AuthDesc."',
					 `payment_gateway`='".$payment_gateway."'";
			$heart->sql_select($sql);		 
			
			
			
			$Checksum = verifychecksum($Merchant_Id, $Order_Id , $Amount,$AuthDesc,$Checksum,$WorkingKey);
			
			//Organizer_payment($mycms,$cfg,$WorkingKey,$Merchant_Id,$Amount,$Order_Id,$Merchant_Param,$Checksum,$AuthDesc,$Redirect_Url);

			
			if($Checksum=="true" && $AuthDesc=="Y"){
				//$orderId = $_SESSION['orderId'];
				$orderId = $Order_Id;
				$sql = "UPDATE ".$cfg['DB_ORDER']."
							SET od_status = 'Paid', od_last_update = NOW()
						WHERE `onlinepaymentcode` = '".$orderId."'";
				$result = $heart->sql_select($sql);
				
				$to_name = getallordersdetails($orderId,'od_payment_first_name').' '.getallordersdetails($orderId,'od_payment_last_name');
				$form_name = $cfg['STUFF_NAME'];
				$form_email = $cfg['ADMIN_ORDER_EMAIL'];
				$to_email = getallordersdetails($orderId,'od_shipping_email');
				$subjects =$cfg['ORDERS_CONF'];
				$message = "Hello <br>".$to_name.", <br><br>Your order has been successfully placed. 
								Your <strong>Order Number</strong> is : <strong>".getallordersdetails($orderId,'or_pattern')."</strong><br><br> 
								After login you can serch your order by entering the above mentioned number in <strong>Track Your Order</strong> field from<br> 
								".$cfg['base_url']."<br> or you can view your all order details (After Login) from the following link - <br>
								".$cfg['base_url']."order_details.php<br><br>Thank you for shopping with us. <br> ".$cfg['STUFF_NAME'].".";
								
				send_mail($to_name, $to_email, $form_name, $form_email, $subjects, $message, $bcc='');
				
				$subject = "Payment is successfully made for ORDER [#".$orderId."]";
				$emailadmins   = $cfg['ADMIN_ORDER_EMAIL'];
				$messageadmin = "Hello,<br />
									".$cfg['ADMIN_NAME'].",<br /><br />
									The payment has been made successfully for the order <b>#".$orderId."</b>.<br /><br />
									To check the order detail follow the steps below:<br />
									1) Go to to your administration panel.<br />
									2) Login with tour Username & Password.<br />
									3) Then click on the below link <br />
									".$cfg['base_url']."webmaster/order.php?show=view&login_id=2&id=".$orderId."<br /><br />
									Thanking You<br />
								".$cfg['STUFF_NAME'];
				
				send_mail($cfg['ADMIN_NAME'], $cfg['ADMIN_EMAIL'], $cfg['ORDERS_NAME'], $emailadmins, $subject, $messageadmin, $bcc='');
				send_mail($cfg['ADMIN_NAME'], $emailadmins, $cfg['ORDERS_NAME'], $emailadmins, $subject, $messageadmin, $bcc='');
				
				unset($_SESSION['orderId']);
				$heart->redirect('thankyou.php');
			}
			else if ($Checksum=="true" && $AuthDesc=="B"){
				//$orderId = $_SESSION['orderId'];
				$orderId = $Order_Id;
				$sql = "UPDATE ".$cfg['DB_ORDER']."
							SET od_status = 'Paid', od_last_update = NOW()
						WHERE od_id = '".$orderId."'";
				$result = $heart->sql_select($sql);
				
				$to_name = getallordersdetails($orderId,'od_payment_first_name').' '.getallordersdetails($orderId,'od_payment_last_name');
				$form_name = $cfg['STUFF_NAME'];
				$form_email = $cfg['ADMIN_ORDER_EMAIL'];
				$to_email = getallordersdetails($orderId,'od_shipping_email');
				$subjects =$cfg['ORDERS_CONF'];
				$message = "Hello ".$to_name.", <br>Your order has been successfully placed. Your order no is : ".$orderId.".
								<br> Thank you for shopping with us. <br> ".$cfg['STUFF_NAME'].".";
								
				send_mail($to_name, $to_email, $form_name, $form_email, $subjects, $message, $bcc='');
				
				$subject = "Payment is successfully made for ORDER [#".$orderId."]";
				$emailadmins   = $cfg['ADMIN_ORDER_EMAIL'];
				$messageadmin = "Hello,<br />
									".$cfg['ADMIN_NAME'].",<br /><br />
									The payment has been made successfully for the order <b>#".$orderId."</b>.<br /><br />
									To check the order detail follow the steps below:<br />
									1) Go to to your administration panel.<br />
									2) Login with tour Username & Password.<br />
									3) Then click on the below link <br />
									".$cfg['base_url']."webmaster/order.php?show=view&login_id=2&id=".$orderId."<br /><br />
									Thanking You<br />
								".$cfg['STUFF_NAME'];
				
				send_mail($cfg['ADMIN_NAME'], $cfg['ADMIN_EMAIL'], $cfg['ORDERS_NAME'], $emailadmins, $subject, $messageadmin, $bcc='');
				send_mail($cfg['ADMIN_NAME'], $emailadmins, $cfg['ORDERS_NAME'], $emailadmins, $subject, $messageadmin, $bcc='');
				
				unset($_SESSION['orderId']);
				$heart->redirect('thankyou.php');
			}
			else if($Checksum=="true" && $AuthDesc=="N"){
				//session_unregister('orderId');
				unset($_SESSION['orderId']);
				header('Location: thankyou.php');
			}
			else{
				//session_unregister('orderId');
				unset($_SESSION['orderId']);
				header('Location: index.php');
			}
			exit;
			break;	

	}

	/*
	function Organizer_checkout($mycms,$cfg,$WorkingKey,$Merchant_Id,$Amount,$Order_Id,$Checksum,$Redirect_Url){}
	function Organizer_payment($mycms,$cfg,$WorkingKey,$Merchant_Id,$Amount,$Order_Id,$Merchant_Param,$Checksum,$AuthDesc,$Redirect_Url){}
	*/

	?>
