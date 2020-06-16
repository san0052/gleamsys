<?
	include_once('../includes_webmaster/links.php');
    include_once('../includes_webmaster/admininit.php');
	$act=@$_REQUEST['act']; 
	switch($act){
	
		//=========================== ############### SHOW ADD WINDOW  #################  ============================//
		case'add':
		
			$heart->redirect('order.php?show=add');	
			break;	
				
		//=========================== ############### SHOW EDIT WINDOW  #################  ============================//
		case'edit':
		
			$heart->redirect('order.php?show=edit&id='.$_REQUEST['id']);
			exit();
			break;
		
		//=========================== ############### VIEW ORDER  #################  ============================//
		case'view':
		
			$_REQUEST['c_id'];
			$heart->redirect('order.php?show=view&id='.$_REQUEST['id'].'&c_id='.$_REQUEST['c_id']);
			exit();
			break;
		//=========================== ############### UPDATE ORDER  #################  ============================//
		case'update':
		
			$categoryName=$_REQUEST['categoryName'];
			$pId=$_REQUEST['pId'];
			$description=addslashes($_REQUEST['description_edit']);
			
			$sql="UPDATE ".$cfg['DB_CATEGORY']." SET 
					`cat_name` = '".$categoryName."',
					`cat_parent_id` = '".$pId."',
					`cat_description` = '".$description."'
					WHERE `cat_id` = '".$_REQUEST['id']."' ";
			$heart->sql_query($sql);
			$heart->redirect('order.php?show=view&m=2&id='.$_REQUEST['id']);
			break;
			
		//=========================== ############### DELETE  MULTIPLE ORDER  #################  ============================//
	
		case'muldel':
		
			$sql="UPDATE ".$cfg['DB_ORDER']." SET 
					`od_status` ='D' 
					WHERE `od_id` IN(".$_REQUEST['id'].")";
			
			$heart->sql_query($sql);
			$heart->redirect('order.php?pId='.$_REQUEST['pId']);
			break;
			case'delorder':
				$sql="UPDATE ".$cfg['DB_ORDER']." SET 
						`od_status` ='D' 
						WHERE `od_id` =".$_REQUEST['id']."";
				
				$heart->sql_query($sql);
				$heart->redirect('order.php?pId='.$_REQUEST['pId']);
			break;	
		case'modify':
			$delivery_message = "Thank you for placing your order  with us.";
			$del_time = ($_REQUEST['del_time']!='')?$_REQUEST['del_time']:date('Y-m-d h:i:s');
			$splitTimeStamp = explode(" ",$del_time);
			$date = $splitTimeStamp[0];
			$newDate = date("m-d",strtotime($date));
			$orderstat =($_REQUEST['status']!="")?$_REQUEST['status']:'';
			$c_id = $_REQUEST['c_id'];
			$customer_name = getFieldsFromTable($c_id,'fname',$cfg['DB_CUSTOMER_DETAILS'],'cust_id');
			$orderId = (int)$_REQUEST['oid'];
			$status1  = $_REQUEST['status'];	
			$status2  = $_REQUEST['status2'];
			$status3  = $_REQUEST['status3'];
			$rec_by   = $_REQUEST['rec_by'];
			$receive_through=($_REQUEST['receive_through']!='')?$_REQUEST['receive_through']:'';
			
				switch($status2){
					case 'Yes':
						$del_status = 'Delivered';
						$delivered_by  = $_REQUEST['del_by'];			
						$rec_by  = $_REQUEST['rec_by'];
						$del_time = $del_time;
						$delivery_message = "Your Product has been delivered successfully!!! ";
						$feedback  = $_REQUEST['fed_by'];
						$delivery_details = StatusOfDelivery('Yes',$del_time,$delivered_by,$rec_by,$feedback,$delivery_message);
						break;
					case 'Attempted':
						$del_status = 'Attempted';
						$delivery_message = "We had tried to contact You!!! ";
						$feedback  = $_REQUEST['fed_by'];
						$delivery_details = StatusOfDelivery('Attempted',$del_time,$delivered_by,$received_by,$feedback,$delivery_message);
						break;
					case 'No':
						$del_status = 'Not Delivered';
						$delivery_message = "Your Order Cannot Be Delivered!!! ";
						$feedback  = $_REQUEST['fed_by'];
						$delivery_details = StatusOfDelivery('No',$del_time,$delivered_by,$received_by,$feedback,$delivery_message);
						break;
					case 'OutForDelivery':
						$del_status = 'OutForDelivery';
						$delivery_message = "Your Order Is Out For Delivery ";
						$feedback  = $_REQUEST['fed_by'];
						$delivery_details = StatusOfDelivery('OutForDelivery',$del_time,$delivered_by,$received_by,$feedback,$delivery_message);
						break;
					case 'OrderProcessing':
						$del_status = 'OrderProcessing';
						$delivery_message = "We Have Received Your Payment And Your Order Is Under Processing ";
						$feedback  = $_REQUEST['fed_by'];
						$delivery_details = StatusOfDelivery('OrderProcessing',$del_time,$delivered_by,$received_by,$feedback,$delivery_message);
						break;
					case 'shipped':
						$del_status = 'shipped';
						$delivery_message = "Your order has been shipped ";
						$feedback  = $_REQUEST['fed_by'];
						$delivery_details = StatusOfDelivery('shipped',$del_time,$delivered_by,$received_by,$feedback,$delivery_message);
						break;
					default:
						$delivery_message = "";
				}
				
				switch($status1){
					case 'Paid':
						$delivery_message = "We Have Received Your Payment!!! ";
						break;
					case 'Cancelled':
						$delivery_message = "Your order has been cancelled ";
						break;
					case 'Refund':
						$delivery_message = "Your order Couldnot Be Delivered Paid Amount Will Be Refunded ";
						break;
					default:			
						$delivery_message = "";
						break;
				}
			if (!isset($_REQUEST['oid']) || (int)$_REQUEST['oid'] <= 0 || !isset($_REQUEST['status']) || $_REQUEST['status'] == ''){
				header('Location:order.php?show=view&id='.$_REQUEST['oid']);
			}
		$curdate=date('Y-m-d');	
			//echo'<br>'.modifyOrder($orderId,$status1,$status2,$delivered_by,$feedback,$received_by,$del_time,$receive_through);
		$sql = " UPDATE ".$cfg['DB_ORDER']."
					SET `od_status` = '".$status1."', 
						`od_delivery_status` = '".$status2."',
						`od_shipping_type`	= '".$status3."',
						`od_delivery_date` ='".$del_time."',
						`od_delivered_by` = '".$delivered_by."',
						`od_feedback` = '".$feedback."',
						`od_received_by` = '".$rec_by."',
						`received_option`='".$receive_through."',
						`od_last_update` = '".$curdate."'
				  WHERE `od_id` = '".$orderId."'";
		    $result = $heart->sql_query($sql);
		
			//===================================== SEND MAIL TO CUSTOMER =========================================//
			if($status2 == 'shipped')
			{
				$subject1 = 'Rainbow Florist Order Shipped';
			}elseif($status2 == 'OrderProcessing')
			{
				$subject1 = 'Rainbow Florist Order Under Process';
			}else
			{
				$subject1 = 'Rainbow Florist Order Out For Delivery';
			}
			if($status2 == 'shipped' || $status2 == 'OrderProcessing' || $status2 == 'OutForDelivery')
			{

					$name    =  getFieldsFromTable($c_id,'fname',$cfg['DB_CUSTOMER_DETAILS'],'cust_id');
					$to_name = getFieldsFromTable($c_id,'fname',$cfg['DB_CUSTOMER_DETAILS'],'cust_id')."&nbsp;".getFieldsFromTable($c_id,'lname',$cfg['DB_CUSTOMER_DETAILS'],'cust_id');
					$from_name = $cfg['STUFF_NAME'];
					$from_email = $cfg['ADMIN_ORDER_EMAIL'];
					$to_email  = getFieldsFromTable($c_id,'email',$cfg['DB_CUSTOMER'],'id');
					$subject = $subject1;
		            $stringbuilder=		    
		 			"<table width='580' cellspacing='10' cellpadding='10' border='0' align='center' style='border:solid 1px #aed9fb'>
					  <tbody>
							<tr>
								<td width='159' height='65' style='padding:12px 0px'>
									<a target='_blank' href='".$cfg['base_url']."'>
										<img src='".$cfg['base_url'].$cfg['IMAGES'].'logo.png'."' width='147' height='65' border='0'/>
										
									</a>							
								</td>
								<td width='421'>
									<p style='color:#7e8f9f;font-size:20px;font-family:Verdana,Helvetica,sans-serif;margin:5px 100px 0 0px;text-align:right'>Call us on :</p>
									<p style='color:#135a9c;font-size:22px;font-weight:bold;font-family:Verdana,Helvetica,sans-serif;margin:0px 0 10px 0;text-align:right'>
									+91-8080909029<br/>
									+91-7666609786    							
									</p>						
							   </td>
							</tr>
							<tr>
							   <td style='border-top:dashed 1px #000' colspan='2'>
								  <table width='100%' cellspacing='0' cellpadding='0' border='0' style='margin:8px 0 0px 0'>
									<tbody>
									  <tr> 
										 <td valign='top' width='76%'>
											<p style='margin:10px 0 5px 0;font-size:26px;font-weight:bold;color:#313c46;font-family:Verdana,Helvetica,sans-serif'>
												Dear ".$name.",    								   
											</p>
											<p style='margin:0px 0 0 0;font-size:20px;font-weight:bold;color:#ef7818;font-family:Verdana,Helvetica,sans-serif'>
												$delivery_details	     								   
											</p>										 
										 </td>
										 <td width='24%'><img src='".$cfg['base_url'].$cfg['PRODUCT_IMAGES'].'14_14.jpg'."' width='140' height='120' ></td>
									  </tr>
									</tbody>
								  </table>							
							   </td>
						   </tr>
							<tr>
							 <td colspan='2'>
								
								
								<p style='margin:8px 0px 12px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px'>
								  Moving on here are the details of your order:    						
								</p>
								<div style='margin:15px auto;width:540px'>
								 <table width='540' cellspacing='0' cellpadding='0' border='1' align='center' style='border:solid 1px #b8b2db'>
									<tbody>
										<tr>
											<td valign='top' width='73' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
												Order ID    							  
											</td>
											<td colspan='2' valign='top' width='73' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
												Product Name    							  
											</td>
											<td valign='top' width='73' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
												Quantity								  
											</td>
											<td valign='top' width='95' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
												Total   							  
											</td>
										</tr>
										";
				
							@$myvar="";
							
							$sql_od1 = "SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_id` = '".$orderId."'";
							$res_od1 = $heart->sql_query($sql_od1);
							$row_od1 =	$heart->sql_fetchrow($res_od1);
								
							$sql_od = "SELECT * FROM ".$cfg['DB_ORDER_ITEM']." WHERE `od_id` = '".$orderId."'";
							$res_od = $heart->sql_query($sql_od);
							while($row_od =	$heart->sql_fetchrow($res_od)){
						   
						$myvar.="<tr>
									<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
									".getallordersdetails($row_od['od_id'],'or_pattern')."							
									</td>
									<td colspan='2' style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>			
									 <img src='".$cfg['base_url'].$cfg['PRODUCT_IMAGES'].getproductdetails($row_od[pd_id],'pd_image')."' width='70' align='center'/><br/>	
									 ".pd_name($row_od['pd_id'])."		
									</td>
									<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
									".$row_od['od_qty']."							
									</td>
									<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
									 <img src='".$cfg['base_url'].$cfg['IMAGES'].'rs_b.png'."' width='10' height='10' />".pd_price($row_od['pd_id']) * $row_od['od_qty']."						
									</td>
								</tr>
								";
							
							  }
						$myvar.="<tr>
									<td colspan='4' valign='top' width='95' align='right' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
										Gross Total &nbsp;   							  
									</td>
									<td colspan='2' style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='right'>
									<img src='".$cfg['base_url'].$cfg['IMAGES'].'rs_b.png'."' width='10' height='10' />".($row_od1['od_amount']-$row_od1['od_shipping_cost'])."						
									</td>
								</tr>
								<tr>
									<td colspan='4' valign='top' width='95' align='right' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
										Shipping Charges  &nbsp;    							  
									</td>
									
									<td colspan='2' style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='right'>
									<img src='".$cfg['base_url'].$cfg['IMAGES'].'rs_b.png'."' width='10' height='10' />".($row_od1['od_shipping_cost'])."						
									</td>
								</tr>
								<tr>		
									<td colspan='4' valign='top' width='95' align='right' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
										Final Amount &nbsp;   							  
									</td>
									<td colspan='2' style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='right'>
									<img src='".$cfg['base_url'].$cfg['IMAGES'].'rs_b.png'."' width='10' height='10' />".($row_od1['od_amount'])."						
									</td>
								</tr>";	  
									  $footer="</tbody>
												 </table>
												</div>
												
												<p style='margin:8px 0px 14px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px'>
												 <strong>NOTE:</strong>
												  <ol style='margin:8px 0px 14px -20px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:20px'>
													<li>   
													  Keep your order number handy for any future communication with us regarding this order. In case you have ordered for more than one products, the delivery might happen separately for each product.							    
													</li>
													<li>	
													   Your Shipping and Billing information have been upadated. Please do login to minimize your entries on your next visting.Thank you for shopping with us.    			</li>
												 </ol>
											   </p>						 
											  </td>
											</tr>
											
											<tr>
											 <td align='center' colspan='2'>
											  <p style='margin:0px 0px 4px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:24px;font-weight:bold;color:#26baf1'>
												Happy <span style='color:#94d01f'> Shopping!! </span>						  
											  </p>
											  <p style='margin:5px 0px 15px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#666666'>".$cfg['ADMIN_NAME']."</p>
											 						 						  
											 </td>
										   </tr>
									   </tbody>
									</table>";

			}else 
			{
					if($status2 == 'Attempted')
					{
						$subject1 = 'Rainbow Florist Product Attempted';
					}elseif($status2 == 'Yes')
					{
						$subject1 = 'Rainbow Florist Product Delivered';
					}else
					{
						$subject1 = 'Rainbow Florist Product Not Delivered';
					}
					$name    =  getFieldsFromTable($c_id,'fname',$cfg['DB_CUSTOMER_DETAILS'],'cust_id');
					$to_name = getFieldsFromTable($c_id,'fname',$cfg['DB_CUSTOMER_DETAILS'],'cust_id')."&nbsp;".getFieldsFromTable($c_id,'lname',$cfg['DB_CUSTOMER_DETAILS'],'cust_id');
					$from_name = $cfg['STUFF_NAME'];
					$from_email = $cfg['ADMIN_ORDER_EMAIL'];
					$to_email  = getFieldsFromTable($c_id,'email',$cfg['DB_CUSTOMER'],'id');
					$subject = $subject1;
				
		            $stringbuilder=		    
		 			"<table width='580' cellspacing='10' cellpadding='10' border='0' align='center' style='border:solid 1px #aed9fb'>
					  <tbody>
							<tr>
								<td width='159' height='65' style='padding:12px 0px'>
									<a target='_blank' href='".$cfg['base_url']."'>
										<img src='".$cfg['base_url'].$cfg['IMAGES'].'logo.png'."' width='147' height='65' border='0'/>
										
									</a>							
								</td>
								<td width='421'>
									<p style='color:#7e8f9f;font-size:20px;font-family:Verdana,Helvetica,sans-serif;margin:5px 100px 0 0px;text-align:right'>Call us on :</p>
									<p style='color:#135a9c;font-size:22px;font-weight:bold;font-family:Verdana,Helvetica,sans-serif;margin:0px 0 10px 0;text-align:right'>
									+91-8080909029<br/>
									+91-7666609786    							
									</p>						
							   </td>
							</tr>
							<tr>
							   <td style='border-top:dashed 1px #000' colspan='2'>
								  <table width='100%' cellspacing='0' cellpadding='0' border='0' style='margin:8px 0 0px 0'>
									<tbody>
									  <tr> 
										 <td valign='top' width='76%'>
											<p style='margin:10px 0 5px 0;font-size:26px;font-weight:bold;color:#313c46;font-family:Verdana,Helvetica,sans-serif'>
												Dear ".$name.",    								   
											</p>
											<p style='margin:0px 0 0 0;font-size:20px;font-weight:bold;color:#ef7818;font-family:Verdana,Helvetica,sans-serif'>
												$delivery_message	     								   
											</p>									 
										 </td>
										 <td width='24%'><img src='".$cfg['base_url'].$cfg['PRODUCT_IMAGES'].'14_14.jpg'."' width='140' height='120' ></td>
									  </tr>
									</tbody>
								  </table>							
							   </td>
						   </tr>
							<tr>
							 <td colspan='2'>
								$delivery_details
								
								<p style='margin:8px 0px 12px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px'>
								  Moving on here are the details of your order:    						
								</p>
								<div style='margin:15px auto;width:540px'>
								 <table width='540' cellspacing='0' cellpadding='0' border='1' align='center' style='border:solid 1px #b8b2db'>
									<tbody>
										<tr>
											<td valign='top' width='73' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
												Order ID    							  
											</td>
											<td colspan='2' valign='top' width='73' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
												Product Name    							  
											</td>
											<td valign='top' width='73' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
												Quantity								  
											</td>
											<td valign='top' width='95' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
												Total   							  
											</td>
										</tr>
										";
			

					

					@$myvar="";
					
					$sql_od1 = "SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_id` = '".$orderId."'";
					$res_od1 = $heart->sql_query($sql_od1);
					$row_od1 =	$heart->sql_fetchrow($res_od1);
						
					$sql_od = "SELECT * FROM ".$cfg['DB_ORDER_ITEM']." WHERE `od_id` = '".$orderId."'";
					$res_od = $heart->sql_query($sql_od);
					while($row_od =	$heart->sql_fetchrow($res_od)){
						   
						$myvar.="<tr>
									<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
									".getallordersdetails($row_od['od_id'],'or_pattern')."							
									</td>
									<td colspan='2' style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>			
									 <img src='".$cfg['base_url'].$cfg['PRODUCT_IMAGES'].getproductdetails($row_od[pd_id],'pd_image')."' width='70' align='center'/><br/>	
									 ".pd_name($row_od['pd_id'])."		
									</td>
									<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
									".$row_od['od_qty']."							
									</td>
									<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
									 <img src='".$cfg['base_url'].$cfg['IMAGES'].'rs_b.png'."' width='10' height='10' />".pd_price($row_od['pd_id']) * $row_od['od_qty']."						
									</td>
								</tr>
								";
							
							  }
						$myvar.="<tr>
									<td colspan='4' valign='top' width='95' align='right' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
										Gross Total &nbsp;   							  
									</td>
									<td colspan='2' style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='right'>
									<img src='".$cfg['base_url'].$cfg['IMAGES'].'rs_b.png'."' width='10' height='10' />".($row_od1['od_amount']-$row_od1['od_shipping_cost'])."						
									</td>
								</tr>
								<tr>
									<td colspan='4' valign='top' width='95' align='right' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
										Shipping Charges  &nbsp;    							  
									</td>
									
									<td colspan='2' style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='right'>
									<img src='".$cfg['base_url'].$cfg['IMAGES'].'rs_b.png'."' width='10' height='10' />".($row_od1['od_shipping_cost'])."						
									</td>
								</tr>
								<tr>		
									<td colspan='4' valign='top' width='95' align='right' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
										Final Amount &nbsp;   							  
									</td>
									<td colspan='2' style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='right'>
									<img src='".$cfg['base_url'].$cfg['IMAGES'].'rs_b.png'."' width='10' height='10' />".($row_od1['od_amount'])."						
									</td>
								</tr>";	  
									  $footer="</tbody>
												 </table>
												</div>
												
												<p style='margin:8px 0px 14px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px'>
												 <strong>NOTE:</strong>
												  <ol style='margin:8px 0px 14px -20px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:20px'>
													<li>   
													  Keep your order number handy for any future communication with us regarding this order. In case you have ordered for more than one products, the delivery might happen separately for each product.							    
													</li>
													<li>	
													   Your Shipping and Billing information have been upadated. Please do login to minimize your entries on your next visting.Thank you for shopping with us.    			</li>
												 </ol>
											   </p>						 
											  </td>
											</tr>
											
											<tr>
											 <td align='center' colspan='2'>
											  <p style='margin:0px 0px 4px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:24px;font-weight:bold;color:#26baf1'>
												Happy <span style='color:#94d01f'> Shopping!! </span>						  
											  </p>
											  <p style='margin:5px 0px 15px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#666666'>".$cfg['ADMIN_NAME']."</p>
								 						  
											 </td>
										   </tr>
									   </tbody>
									</table>";
			}
							
   			$message=$stringbuilder.$myvar.$footer;
		
			send_mail($to_name, $to_email, $from_name, $from_email, $subject, $message, $bcc='');
			$heart->redirect('order.php?show=view&id='.$orderId.'&c_id='.$c_id);
			break;
	
		case 'searc': 
		
			$dd=$_REQUEST['dd'];
			$month=$_REQUEST['month'];
			$o_id=$_REQUEST['o_id'];
			$remarks=$_REQUEST['remarks'];
			$heart->redirect('order.php?m=1234&dd='.$_REQUEST['dd'].'&month='.$_REQUEST['month'].'&o_id='.$_REQUEST['o_id'].'&remarks='.$_REQUEST['remarks']);
			break;
	}
	
function StatusOfDelivery($del_status,$del_time,$delivered_by,$received_by,$feedback,$delivery_message){

	switch($del_status){
		case 'No' :
			$var = "<p style='margin:0px 0px 12px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px;'>
						<font style='font-weight:bold;'>$delivery_message</font> <br/><br/>
						<font style='font-weight:bold;'>1. Feedback : </font>$feedback<br/><br/>
					</p>";
			break;
		case 'Yes' :
			$var = "<p style='margin:0px 0px 12px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px;'>
						<font style='font-weight:bold;'>$delivery_message</font> <br/><br/>
						<font style='font-weight:bold; border-bottom:solid 1px; thin; padding-bottom: 2px; padding-right:20px;'></font><br/></br> 
						<font style='font-weight:bold;'>Feedback : </font>$feedback<br/><br/>
						<font style='font-weight:bold;'>Received By :  </font>$received_by<br/><br/>				
						<font style='font-weight:bold;'>Delivery Time :  </font>".date('d-m-Y H:i:s',strtotime($del_time))."
					</p>";
			break;
		case 'Attempted' :	
			$var = "<p style='margin:0px 0px 12px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px;'>
						<font style='font-weight:bold;'>$delivery_message</font> <br/><br/>
						<font style='font-weight:bold; border-bottom:solid 1px; thin; padding-bottom: 2px; padding-right:20px;'></font><br/></br> 
						<font style='font-weight:bold;'> Feedback : </font>$feedback<br/><br/>
					</p>";
			break;
		case 'OutForDelivery' :	
			$var = "<p style='margin:0px 0 0 0;font-size:20px;font-weight:bold;color:#ef7818;font-family:Verdana,Helvetica,sans-serif'>
												$delivery_message	     								   
					</p>";
			break;
		case 'OrderProcessing' :	
			$var = "<p style='margin:0px 0 0 0;font-size:20px;font-weight:bold;color:#ef7818;font-family:Verdana,Helvetica,sans-serif'>
												$delivery_message	     								   
					</p>";
			break;
		case 'shipped' :	
			$var = "<p style='margin:0px 0 0 0;font-size:20px;font-weight:bold;color:#ef7818;font-family:Verdana,Helvetica,sans-serif'>
												$delivery_message	     								   
					</p>";
			break;
		default :
			$var = "";
			break;
	}
	return $var;
}
?>