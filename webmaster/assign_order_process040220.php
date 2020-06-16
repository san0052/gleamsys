<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');

?>
<style>
.button {
    display: block;
	float:right;
	margin-right:850px;
    width: 115px;
    height: 25px;
    background: #800000;
    text-align: center;
    color: white;
	text-decoration:none;
    font-weight: bold;
}</style>
<?php


$act=@$_REQUEST['act']; 
//echo $act;
switch($act){
case 'assign_vendor':
			$select_vendor 	= $_REQUEST['select_vendor'];
			$notes 			= addslashes($_REQUEST['notes']);
			$order_id 		= $_REQUEST['order_id'];
			$vendor_amount 	= $_REQUEST['vendor_amount'];
			$delivery_charges 	= $_REQUEST['delivery_charges'];
			$vendor_type		= $_REQUEST['vendor_type'];
			$vendor_name		= $_REQUEST['vendor_name'];
			$vendor_email	= $_REQUEST['vendor_email'];
			//print_r($_REQUEST['vendor_amount']);
			
			if($vendor_type!='unregister')
			{
				$sql="INSERT INTO" .$cfg['DB_ASSIGN_VENDORS']. "	
					  SET `vendor_id` = '".$select_vendor."',	
					  	  `notes` = '".$notes."',	
						  `delivery_charges` = '".$delivery_charges."',	
						  `order_id` = '".$order_id."',	
						  `status` = 'A'";
				}
			if($vendor_type=='unregister')
			{	
				 $sql="INSERT INTO" .$cfg['DB_ASSIGN_VENDORS']. "	
					  SET `unregister_vendor` = '".$vendor_email."',
					  `unregistered_vendor_name`='".$_REQUEST['vendor_name']."',	
					  	  `notes` = '".$notes."',	
						  `delivery_charges` = '".$delivery_charges."',	
						  `order_id` = '".$order_id."',	
						  `status` = 'A'";
			}
	 		$heart->sql_query($sql);
			$pr_id = "";
			
						   
				$sql_id = "SELECT order_item.od_id, 

								   order_item.pd_id, 

								   order_item.od_qty,
								   
								   pd.pd_price as price,

								   pd.pd_id as product_id


						   FROM ".$cfg['DB_ORDER_ITEM']." order_item 

						   
						   
						    LEFT OUTER JOIN ".$cfg['DB_PRODUCT']." pd
						    
						    ON pd.pd_id = order_item.pd_id

						   

						   WHERE order_item.od_id = '".$order_id."'";		   
						   
						   
						   
						  
			$res_id = $heart->sql_query($sql_id);
			while($row_id = $heart->sql_fetchrow($res_id))
			{
			$pr_id[] = $row_id['product_id'];
			
			}
			
			
			foreach($pr_id as $key=>$val)
	      	{
			 if($val!="")
		      	{				if($select_vendor>0)
				{
				echo $sql1="UPDATE".$cfg['DB_VENDOR_PRODUCT_AVAIL']."
				         	  SET `vendor_id`=".$select_vendor.",
						   	  	   `product_id`='".$pr_id[$key]."',
								   `price`='".$_REQUEST['vendor_amount'][$key]."',
							       `status`='A'
							  WHERE `vendor_id` = '".$select_vendor."'
							  AND `product_id`='".$pr_id[$key]."'";
				$heart->sql_query($sql1);
				}
		    	}		
	    	}
						if($select_vendor>0)
			{
			$sql1="SELECT vendor.id,
						  vendor.vendor_name,
						  vendor.email,
				   		  assign.vendor_id,
						  assign.order_id
				   
				   FROM " .$cfg['DB_VENDOR']. " vendor
				   
				   INNER JOIN ".$cfg['DB_ASSIGN_VENDORS']." assign
				   ON vendor.id = assign.vendor_id
				   
				   WHERE vendor.status = 'A'
				   AND assign.order_id = '".$order_id."'";

	 		$res1 = $heart->sql_query($sql1);
			$row1 = $heart->sql_fetchrow($res1);
			$row1['vendor_name'];			}
			$to_name = ($vendor_type!='unregister')?$row1['vendor_name']:$vendor_name;
			$to_email = ($vendor_type!='unregister')?$row1['email']:$vendor_email;
			
			//$mailMessage=($vendor_type=='unregister')?contactMessageGenerator1($order_id, $select_vendor,$vendor_amount,$delivery_charges):contactMessage($order_id, $select_vendor,$vendor_amount,$delivery_charges);			
			
			$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_id` = '".$order_id."'  ";
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
			
			$delivery_date	=	date('d-m-Y',strtotime($row['od_delivery_date']));
			$delivery_time	=	$row['od_shipping_type'];
			
			
			$msg='Dear &nbsp;'.$row1['vendor_name'].' ,<br/> Order No: &nbsp;'.$order_id.'<br/>Delivery Date: &nbsp;'.$delivery_date.'<br/>Delivery Status: &nbsp;'.$delivery_time.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<a class="button" href="http://rainbowfloristworld.com/orderPrint.php?id='.$heart->encoded($order_id).'">Print Receipt</a> <br/><br/>';
			$msg.='<table width="60%" height="60%" align="left" cellpadding="6" cellspacing="1" class="tborder_new" border="1">';
			$msg.='<tr>';
			$msg.='<td>';
			$msg.= '<strong>Order Details: </strong><ul>';
			
			$qty	=	0 ;
			$price	=	0 ;
						$sql_od = "SELECT * 
									 FROM ".$cfg['DB_ORDER_ITEM']." 
									WHERE `od_id` = '".$order_id."'  ";
						$res_od = $heart->sql_query($sql_od);
						while($row_od =	$heart->sql_fetchrow($res_od))
						{ 
			
		    $msg.= '&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<li>'.pd_name($row_od['pd_id']).'</li>';
					   
					
						 $qty	 = $qty	+ $row_od['od_qty'] ;
						 $price	 = $price  + (pd_price($row_od['pd_id']) * $row_od['od_qty']);
					   }
				
			$msg.= '</ul><strong>Item Quantity:</strong> &nbsp;'.$qty;
			$msg.= '<br/><br/><strong>Order Value:</strong> &nbsp;'.array_sum($_REQUEST['vendor_amount']);
			$msg.='</td>';
			$msg.='<td rowspan="3" width="30%" align="center">';
						$sql_od_img = "SELECT * 
										 FROM ".$cfg['DB_ORDER_ITEM']." 
									    WHERE `od_id` = '".$order_id."' ";
						$res_od_img = $heart->sql_query($sql_od_img);
						while($row_od_img =	$heart->sql_fetchrow($res_od_img)){ 
						
						$sql_pd = "SELECT `pd_description` FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = '".$row_od_img['pd_id']."'";
						$res_pd = $heart->sql_query($sql_pd);
						$row_pd	=	$heart->sql_fetchrow($res_pd);
						
			$msg.='<img src="'.$cfg['base_url_v'].$cfg['PRODUCT_IMAGES'].getproductdetails($row_od_img['pd_id'],'pd_image').'"  width="120" /><br/>
					'.$row_pd['pd_description'];
						}
			$msg.='</td>';
			$msg.='</tr>';	
			$msg.='<tr>';	
			$msg.='<td>';		
			$msg.='<strong>Recipient Name:</strong><br/>';	
			$msg.= $row['od_shipping_first_name'].'&nbsp;'.$row['od_shipping_last_name'];
			$msg.='<br/><br/><strong>Recipient Address:</strong><br/><br/>';	
			$msg.= $row['od_shipping_address1'];
			$msg.='<br/><br/><strong>Message on card:</strong><br/>';
			$msg.=$row['od_shipping_msg'];
			$msg.='</td>';
			$msg.='</tr>';	
			$msg.='<tr>';	
			$msg.='<td>';	
			$msg.='<strong>Additional Instructions (if any):</strong><br/>';
			$msg.=$row['od_shipping_instruction'].'<br/><br/>';
			$msg.='<strong>Delivery Time:</strong><br/>';	
			$msg.=$row_od_img['delivery_time'];
			
			
			send_mail($to_name,$to_email,'RAINBOW FLORIST','orders@rainbowfloristworld.com','New Order From RAINBOW FLORIST',$msg);
			
			$heart->redirect('assign_order.php');

exit();
break;

case 'assign_vendor_edit':
			$select_vendor 	= $_REQUEST['select_vendor'];
			$notes 			= addslashes($_REQUEST['notes']);
			$order_id 		= $_REQUEST['order_id'];
			$delivery_charges=$_REQUEST['delivery_charges'];
			$sql="UPDATE" .$cfg['DB_ASSIGN_VENDORS']. "
				  SET `vendor_id` = '".$select_vendor."',
				  	  `notes` = '".$notes."',
					  `order_id` = '".$order_id."',
					  `status` = 'A' WHERE `order_id` ='".$order_id."'";

	 		$heart->sql_query($sql);
			$mailMessage=contactMessage($order_id, $select_vendor,$delivery_charges);
			send_mail('Rainbow Florist','orders@rainbowfloristworld.com','Rainbow Florist','orders@rainbowfloristworld.com','New Order',$mailMessage);
			$heart->redirect('assign_order.php');
exit();
break;
case 'unassign_order':
			$select_vendor 	= $_REQUEST['vendor_id'];
			$notes 			= addslashes($_REQUEST['notes']);
			$order_id 		= trim($_REQUEST['id']);
			$sql_email="SELECT vendor.id,
						  vendor.vendor_name,
						  vendor.email,
				   		  assign.vendor_id,
						  assign.order_id,
						  assign.delivery_charges
				   FROM " .$cfg['DB_VENDOR']. " vendor
				   INNER JOIN ".$cfg['DB_ASSIGN_VENDORS']." assign
				   ON vendor.id = assign.vendor_id
				   WHERE vendor.status = 'A'
				   AND assign.order_id = '".$order_id."'";
	 		$res_email = $heart->sql_query($sql_email);
			$row_email = $heart->sql_fetchrow($res_email);
			$delivery_charges=$row_email['delivery_charges'];
			$to_name = $row_email['vendor_name'];
			$to_email = $row_email['email'];
			$mailMessage=contactMessage($order_id, $select_vendor,$delivery_charges);
			send_mail($to_name,$to_email,'RAINBOW FLORIST','orders@rainbowfloristworld.com','Cancellation Of Order From RAINBOW FLORIST',$mailMessage);
			$sql="DELETE FROM" .$cfg['DB_ASSIGN_VENDORS']. "
				  WHERE `order_id` ='".$order_id."'";
	 		$heart->sql_query($sql);
			$sql1="UPDATE" .$cfg['DB_ORDER']. "
				  SET `od_acknowledgement` = 'Pending'
				  WHERE `od_id` ='".$order_id."'";
	 		$heart->sql_query($sql1);
			$heart->redirect('assign_order.php');
			
exit();
break;case'del':
			 $sql="UPDATE ".$cfg['DB_ORDER']." 
			 	   SET `status` = 'D' 
				   WHERE `od_id`=".$_REQUEST['id']."";
			 $heart->sql_query($sql);
			 $heart->redirect('assign_order.php?m=3&pageno='.$_REQUEST['pageno']);
break;case 'muldel':
 $sql="DELETE FROM" .$cfg['DB_CATEGORY']."
	WHERE `id`IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);

	  $sql="DELETE FROM" .$cfg['DB_PRODUCT']. "WHERE `category`IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	$heart->redirect('category.php?m=3&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);
break;
case 'Active':
 $sql="UPDATE ".$cfg['DB_CATEGORY']."
	 SET 
	`status` = 'A' WHERE `id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $heart->redirect('category.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);
break;
case 'Inactive':
 $sql="UPDATE ".$cfg['DB_CATEGORY']."	 SET 	`status` = 'I' WHERE `id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	$heart->redirect('category.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);
break;
case 'mulactive':
 $sql="UPDATE ".$cfg['DB_CATEGORY']."
	 SET 
	`status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('category.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);
break;
case'mulinactive':
 $sql="UPDATE ".$cfg['DB_CATEGORY']."
	 SET 
	`status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('category.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);
break;
}
function contactMessage($order_id, $select_vendor,$vendor_amount,$delivery_charges)
{	
	$extracharges=$delivery_charges;
	global $heart, $cfg;
	
	$sql_vendMail="SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_id` = '".$order_id."'  ";
	$res_vendMail=$heart->sql_query($sql_vendMail);
	$row_vendMail=$heart->sql_fetchrow($res_vendMail);
	
	$deliver_date = date('jS F Y',strtotime($row_vendMail['od_delivery_date']));
	$msg = $row_vendMail['od_shipping_msg'];
	$instruction = $row_vendMail['od_shipping_instruction'];
	$address = $row_vendMail['od_shipping_address1'];
	$sender_name = $row_vendMail['od_shipping_sender_name'];
	$phone_no=$row_vendMail['od_shipping_phone'];
	$receiver_name=ucwords($row_vendMail['od_shipping_first_name'].' '.$row_vendMail['od_shipping_last_name']);
	
	/*$sql_od = "SELECT order_item.od_id, 	
					  order_item.pd_id, 	
					  order_item.od_qty,	
					  avail.price,	
					  avail.product_id,	
					  avail.vendor_id	
			   FROM ".$cfg['DB_ORDER_ITEM']." order_item 	
			   INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail	
			   	
			   ON avail.product_id = order_item.pd_id	
			   	
			   WHERE order_item.od_id = '".$order_id."'	
			   AND avail.vendor_id = '".$select_vendor."'";*/
	
	$sql_od = "SELECT order_item.od_id, 

								   order_item.pd_id ,

								   order_item.od_qty,
								   
								   pd.pd_price as price,

								   pd.pd_id as product_id


						   FROM ".$cfg['DB_ORDER_ITEM']." order_item 

						   
						   
						    LEFT OUTER JOIN ".$cfg['DB_PRODUCT']." pd
						    
						    ON pd.pd_id = order_item.pd_id

						   

						   WHERE order_item.od_id = '".$order_id."'";
				   	
	$res_od = $heart->sql_query($sql_od);	
	$maxrow_od = $heart->sql_numrows($res_od);
	$from_name="Rainbow Florist";
	$msgBody1 = "<table width='190px' border='0' cellpadding='0' cellspacing='0' align='center' style='border-top-style:double; border-top-color:#000000;'>
				  <tr>
					<td colspan='4'>
					<img src='".$cfg['base_url']."images/logo.png' width='300' height='124' />		  
					</td>
				  </tr>
				  <tr>
					<td colspan='4'>
					<br>
					<b>You have got a new order: &nbsp;".$row_vendMail['or_pattern']."</b>
					<br><br>			  
					</td>
				  </tr>
				  <tr>
					<td width='33%' valign='top' colspan='3'>
					<br> 
					  <strong>Step 1: Product Details </strong>
					  <br><br>				    
					</td>
				  </tr>
				  <tr>
					<td colspan='4' align='center'>
					<table width='700px' align='center' cellspacing='2' cellpadding='6' border='1' bordercolor='#00000'>
					<tr>
					<td width='11%' align='center'>
					<strong>Product Photo</font></strong>					
					</td>
					<td width='76%'>
					<strong>Details</font></strong>					
					</td>
					<td align='center'>
					<strong>Quantity</font></strong>					
					</td>
					<td width='20%' align='center'>
					<strong>Unit Price</font></strong>					
					</td>
				</tr>";
					
	$msgBody2 = " ";				
				
$images = $cfg['PRODUCT_IMAGES'];$key=0;
while($row_od = $heart->sql_fetchrow($res_od))
	{
		$images1 = getproductdetails($row_od['pd_id'],'pd_image');
	
		$msgBody2 .= "<tr>
						<td>
						<img src='".$cfg['base_url'].$images.$images1."'  width='70' align='top'/>	
						<a href='".$cfg['base_url'].$images.$images1."' target='_blank' style='text-decoration:none;'>Click Here</a>				
						</td>
						<td>
						<b>".productinfo($row_od['pd_id'])."</b><br>
							
						</td>
						<td align = 'center'>
						<b>".$row_od['od_qty']."</b>					
						</td>
						<td align = 'center'>
						<b>".number_format($vendor_amount[$key],2)."</b>					
						</td>
					</tr>";
					
			$key++;		
	}

						/* $sql_od1 = "SELECT order_item.od_id, 
										  order_item.pd_id, 
										  order_item.od_qty,
										  avail.price,
										  avail.product_id,
										  avail.vendor_id
								   FROM ".$cfg['DB_ORDER_ITEM']." order_item 
								   INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail
								   
								   ON avail.product_id = order_item.pd_id
								   
								   WHERE order_item.od_id = '".$row_vendMail['od_id']."'
								   AND avail.vendor_id = '".$select_vendor."'";*/
						$sql_od1 = "SELECT order_item.od_id, 

								   order_item.pd_id ,

								   order_item.od_qty,
								   
								   pd.pd_price as price,

								   pd.pd_id as product_id


						   FROM ".$cfg['DB_ORDER_ITEM']." order_item 

						   
						   
						    LEFT OUTER JOIN ".$cfg['DB_PRODUCT']." pd
						    
						    ON pd.pd_id = order_item.pd_id

						   

						   WHERE order_item.od_id = '".$order_id."'";		   
								   
						$res_od1 = $heart->sql_query($sql_od1);
						$row_od1 =	$heart->sql_fetchrow($res_od1);
 $grand_total = total($row_vendMail['od_id'],$select_vendor);
	

$sql_delivery = "SELECT assign.delivery_charges
				 FROM ".$cfg['DB_ASSIGN_VENDORS']."assign
				 
				 INNER JOIN ".$cfg['DB_ORDER']." orders
				 ON assign.order_id = orders.od_id
				 
				 WHERE assign.vendor_id = '".$_SESSION['vendor_id']."'";
$res_delivery = $heart->sql_query($sql_delivery);
$row_delivery = $heart->sql_fetchrow($res_delivery);
$delivery_charges =($extracharges!='')?$extracharges:$row_delivery['delivery_charges'];

$allGrandTotal = $grand_total + $delivery_charges;
$allGrandTotal =number_format($allGrandTotal,2);$shippingType='Normal';
if($row_vendMail['od_shipping_type']=='mid_night')
{
	$shippingType='Midnight';
}
else if($row_vendMail['od_shipping_type']=='fixed')
{
	$shippingType='Fixed Time';
}		$row_vendMail['od_shipping_cost'];
$msgBody2.= "<tr>

					<td style='border:none;'>					

					</td>

					<td align='center' colspan='2' width='15%'>

					<font color='#FF0000'>

					<b>
					Delivery Type
					".$shippingType."				

					</b>					

					</font>					

					</td>

					<td align='center'>

					<font color='#FF0000'>

					<b>

										

					</b>					

					</font>					

					</td>

					</tr>";
$msgBody3 = "<tr>
					<td style='border:none;'>					
					</td>
					<td align='right' colspan='2' width='15%'>
					<font color='#FF0000'>
					<b>
					Delivery Charges					
					</b>					
					</font>					
					</td>
					<td align='center'>
					<font color='#FF0000'>
					<b>
					".$delivery_charges."					
					</b>					
					</font>					
					</td>
					</tr>
					<tr>
					<td style='border:none;'>					
					</td>
					<td align='center' colspan='2' width='15%'>
					<font color='#FF0000'>
					<b>
					TOTAL Amount					
					</b>					
					</font>					
					</td>
					<td align='center'>
					<font color='#FF0000'>
					<b>
					".$allGrandTotal."					
					</b>					
					</font>					
					</td>
					</tr>
					</table>					
					</td>
					</tr>
					<tr>
					<td valign='top' colspan='3' style='border:none;' style='padding-top:30px;'>
					<br><br> 
					  <strong>Step 2: Shipping Details </strong>					
					<br><br>					
					</td>
					</tr>
					<tr>
					<td colspan='3'>
					<table width='100%' align='center' cellpadding='6' cellspacing='2' border='1' bordercolor='#00000'>
					<tr>
					<td width='22%'>
					<strong>Delivery Date:</strong>					
					</td>
					<td width='78%' style='background-color:#FFFF80;'><font color='#FF0000'><b>".$deliver_date."</b></font></td>
					</tr>
					<tr>
					<td>
					<strong>Message On Card</strong>					
					</td>
					<td>
					".$msg."					
					</td>
					</tr>
					<tr>
					<td>
					<strong>Special Instruction</strong>					
					</td>
					<td>
					".$instruction."					
					</td>
					</tr>
					<tr>
					<td>
					<strong>Delivery Address</strong>					
					</td>
					<td>
					".$receiver_name.
					"<br><br>".$address.
					"<br><br>".getFieldsFromTable($row_vendMail['od_shipping_city'],'city_name',$cfg['DB_CITIES'],'ct_id').
					"<br><br>".$row_vendMail['od_shipping_state'].
					"<br><br>".$row_vendMail['od_shipping_country'].
					"<br><br>".$row_vendMail['od_shipping_postal_code'].
					"<br><br>".$row_vendMail['od_shipping_landmark'].
					"<br><br>".$phone_no."					
					</td>
					</tr>
					<tr>
					<td>
					<strong>Sender's Name</strong>					
					</td>
					<td>
					".$sender_name."					
					</td>
					</tr>
					</table>					
					</td>
				  </tr>
				  
				  <tr>
				  <td colspan='3'>
				  <br>
				  <br><br><br>
				  <strong>Step 3: <u>Acknowledge this order</u></strong>
				  <br><br>				  
				  </td>
				  </tr>
				  <tr>
				  <td colspan='3'>
				  <strong>Please click <a href='".$cfg['base_url']."/webmaster/message.php?act=update_acknowledgement&ord_id=".trim($order_id)."' target='_blank'>here</a> to acknowledge this order.</strong>				 
				   </td>
				  </tr>
				  <tr>
				  <td colspan='3'>
				  <b>Or</b>
				  </td>
				  </tr>
				  <tr>
				  <td colspan='3'>
				  
				  <strong>Please click <a href='".$cfg['base_url']."/webmaster/message.php?act=reject_acknowledgement&ord_id=".trim($order_id)."' target='_blank'>here</a> to reject this order.</strong>				  				  </td>
				  </tr>
				  <tr>
				  <br><br>
					<td colspan='3' style='padding-top:30px; padding-bottom:30px;'><font color='#660000'>
					<b><i>
					-Thanks & Regards
					</i>
					</b>
					</font> </td>
					</tr>
				  <tr>
				    <td colspan='3'><font color='#CC9933' size='+2' style='text-shadow:#000000'>
					<b>
					Rainbow Florist
					</b> 
					</font>
					<br> 
					<font color='#660000'>
					<b><i> 
					9920777678 / 9819155649
					</i>
					</b>
					</font>
					<br>       
					<a href='http://www.rainbowfloristworld.com' target='_blank'>www.rainbowfloristworld.com</a>
					</td>
  				  </tr>
				  <tr>
				    <td colspan='3'><span style='padding-right:10px;'><strong><span style='color:#5A240F;'>Date:</span></strong>&nbsp;".date('jS F Y')." </span></td>
  				  </tr>
			</table>
";
	
	
	return $content = $msgBody1.$msgBody2.$msgBody3;
	
	//echo'<br>'.$content;
}


function contactMessageGenerator1($order_id, $select_vendor,$vendor_amount,$delivery_charges)
{	
	$extracharges=$delivery_charges;
	global $heart, $cfg;
	
	$sql_vendMail="SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_id` = '".$order_id."'  ";
	$res_vendMail=$heart->sql_query($sql_vendMail);
	$row_vendMail=$heart->sql_fetchrow($res_vendMail);
	
	$deliver_date = date('jS F Y',strtotime($row_vendMail['od_delivery_date']));
	$msg = $row_vendMail['od_shipping_msg'];
	$instruction = $row_vendMail['od_shipping_instruction'];
	$address = $row_vendMail['od_shipping_address1'];
	$phone_no=$row_vendMail['od_shipping_phone'];
	$sender_name = $row_vendMail['od_shipping_sender_name'];
	$receiver_name=ucwords($row_vendMail['od_shipping_first_name'].' '.$row_vendMail['od_shipping_last_name']);
	/*SELECT order_item.od_id, 
				  order_item.pd_id, 
				  order_item.od_qty,
				  avail.price,
				  avail.product_id,
				  avail.vendor_id
		   FROM ".$cfg['DB_ORDER_ITEM']." order_item 
		   INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail
		   
		   ON avail.product_id = order_item.pd_id
		   
		   WHERE order_item.od_id = '".$order_id."'
		   AND avail.vendor_id = '".$select_vendor."'*/
	
$sql_od = "SELECT order_item.od_id, 

								   order_item.pd_id, 

								   order_item.od_qty,
								   
								   pd.pd_price as price,

								   pd.pd_id as product_id


						   FROM ".$cfg['DB_ORDER_ITEM']." order_item 

						   
						   
						    LEFT OUTER JOIN ".$cfg['DB_PRODUCT']." pd
						    
						    ON pd.pd_id = order_item.pd_id

						   

						   WHERE order_item.od_id = '".$order_id."'";
$res_od = $heart->sql_query($sql_od);
$maxrow_od = $heart->sql_numrows($res_od);

$total_price = $row_od['pd_price'] * $row_od['od_qty'];
	
	
	$from_name="Rainbow Florist";
	
	
	$msgBody1 = "<table width='590px' border='0' cellpadding='0' cellspacing='0' align='center' style='border-top-style:double; border-top-color:#000000;'>
				   <tr>
					<td colspan='4'>
					<img src='".$cfg['base_url']."images/logo.png' width='300' height='124' />		  
					</td>
				  </tr>
				  <tr>
				  <td colspan='4'>
				  <br>
					 <b>Dear Sir/madam,</b>
				  <br>
				  <br>			  </td>
				  </tr>
				  <tr>
					<td width='33%' valign='top' colspan='3'>
					<b>You have got a new order: &nbsp;".$row_vendMail['or_pattern']."</b>				
					  </td>
					  </tr>
					  <tr>
					  <td colspan='4'>
					  <table width='190px' border='0' cellpadding='0' cellspacing='0' align='center' style='border-top-style:double; border-top-color:#000000;'>
			  
				  <tr>
					<td width='33%' valign='top' colspan='3'>
					<br> 
					  <u><strong>Order Details </strong></u>
					  <br><br>				    </td>
				  </tr>
				  <tr>
					<td colspan='3' align='center'>
					<table width='700px' align='center' cellspacing='2' cellpadding='6' border='1' bordercolor='#00000'>
					<tr>
					<td width='11%' align='center'>
					<strong>Product Photo</font></strong>					</td>
					<td width='76%'>
					<strong>Details</font></strong>					</td>
					<td width='13%' align='center'>
					<strong>Quantity</font></strong>					</td>
					<td width='20%' align='center'>
					<strong>Unit Price</font></strong>					
					</td>
					</tr>";
					
	$msgBody2 = " ";				
				
	
	
$images = $cfg['PRODUCT_IMAGES'];
	

$i=0;
$total=0;	$key=0;
while($row_od = $heart->sql_fetchrow($res_od))
	{$images1 = getproductdetails($row_od['pd_id'],'pd_image');
	$price=($vendor_amount[$i]!='')?$vendor_amount[$i]:$row_od['pd_price'];
	$total+=$price;
		$msgBody2 .= "<tr>
						<td>
						<img src='http://rainbowfloristworld.com/".$images.$images1."'  width='70' align='top'/>	
						<a href='http://rainbowfloristworld.com/".$images.$images1."' target='_blank' style='text-decoration:none;'>Click Here</a>						
						</td>
						<td>
						<b>".productinfo($row_od['pd_id'])."</b><br>
									
						</td>
						<td align = 'center'>
						<b>".$row_od['od_qty']."</b>					
						</td>
						<td align = 'center'>
						<b>".number_format($vendor_amount[$key],2)."</b>					
						</td>
					</tr>";
					
		$i++;
		$key++;			
	}


						$sql_od1 = "SELECT order_item.od_id, 
										  order_item.pd_id, 
										  order_item.od_qty,
										  avail.pd_price,
										  avail.pd_id,
										  SUM(avail.pd_price*order_item.od_qty) as summation
								   FROM ".$cfg['DB_ORDER_ITEM']." order_item 
								   INNER JOIN ".$cfg['DB_PRODUCT']." avail
								   
								   ON avail.pd_id = order_item.pd_id
								   
								   WHERE order_item.od_id = '".$row_vendMail['od_id']."'";
						$res_od1 = $heart->sql_query($sql_od1);
						$row_od1 =	$heart->sql_fetchrow($res_od1);
						
$shippingType='Normal';
if($row_vendMail['od_shipping_type']=='mid_night')
{
	$shippingType='Midnight';
}
else if($row_vendMail['od_shipping_type']=='fixed')
{
	$shippingType='Fixed Time';
}		
$row_vendMail['od_shipping_cost'];
$msgBody2.= "<tr>

					<td style='border:none;'>					

					</td>

					<td align='center' colspan='2' width='15%'>

					<font color='#FF0000'>

					<b>
					Delivery Type
					".$shippingType."				

					</b>					

					</font>					

					</td>

					<td align='center'>

					<font color='#FF0000'>

					<b>

										

					</b>					

					</font>					

					</td>

					</tr>";						
 $grand_total_val = $total;//total($row_vendMail['od_id'], $_SESSION['vendor_id']);
 $grand_total=($grand_total_val+$extracharges);
if($grand_total==''){
$grand_total=number_format($total,2);//$row_od1['summation'];
}	
	
$msgBody3 = "<tr>
					<td style='border:none;'>					
					</td>
					<td align='right' colspan='2' width='15%'>
					<font color='#FF0000'>
					<b>
					Delivery Charges					
					</b>					
					</font>					
					</td>
					<td align='center'>
					<font color='#FF0000'>
					<b>
					".$extracharges."					
					</b>					
					</font>					
					</td>
					</tr>
					<tr>
					<td style='border:none;'>					
					</td>
					<td align='right' colspan='2' width='15%'>
					<font color='#FF0000'>
					<b>
					TOTAL Amount					
					</b>					
					</font>					
					</td>
					<td align='right'>
					<font color='#FF0000'>
					<b>
					".$grand_total."					
					</b>					
					</font>					
					</td>
					</tr>
					</table>					
					</td>
					</tr>
					<tr>
					<td valign='top' colspan='3' style='border:none;' style='padding-top:30px;'>
					<br><br> 
					  <strong><u>Shipping Details </u></strong>					
					<br><br>					
					</td>
					</tr>
					<tr>
					<td colspan='3'>
					<table width='100%' align='center' cellpadding='6' cellspacing='2' border='1' bordercolor='#00000'>
					<tr>
					<td width='22%'>
					<strong>Delivery Date:</strong>					
					</td>
					<td width='78%' style='background-color:#FFFF80;'><font color='#FF0000'><b>".$deliver_date."</b></font></td>
					</tr>
					<tr>
					<td>
					<strong>Message On Card</strong>					
					</td>
					<td>
					".$msg."					
					</td>
					</tr>
					<tr>
					<td>
					<strong>Special Instruction</strong>					
					</td>
					<td>
					".$instruction."					
					</td>
					</tr>
					<tr>
					<td>
					<strong>Delivery Address</strong>					
					</td>
					<td>
					".$receiver_name.
					"<br><br>".$address.
					"<br><br>".getFieldsFromTable($row_vendMail['od_shipping_city'],'city_name',$cfg['DB_CITIES'],'ct_id').
					"<br><br>".$row_vendMail['od_shipping_state'].
					"<br><br>".$row_vendMail['od_shipping_country'].
					"<br><br>".$row_vendMail['od_shipping_postal_code'].
					"<br><br>".$row_vendMail['od_shipping_landmark'].
					"<br><br>".$phone_no."					
					</td>
					</tr>
					<tr>
					<td>
					<strong>Sender's Name</strong>					
					</td>
					<td>
					".$sender_name."					
					</td>
					</tr>
					</table>					
					</td>
				  </tr>
				  </table>
				  </td>
				  </tr>
				 <tr>
				  <td colspan='3'>
				  <br><br>
				  <strong><u>Acknowledge this order</u></strong>
				  <br><br>				  
				  </td>
				  </tr>
				  <tr>
				  <td colspan='3'>
				  <strong>Please click <a href='".$cfg['base_url']."/webmaster/message.php?act=update_acknowledgement&ord_id=".trim($order_id)."' target='_blank'>here</a> to acknowledge this order.</strong>				 
				   </td>
				  </tr>
				  <tr>
				  <td colspan='3'>
				  <b>Or</b>
				  </td>
				  </tr>
				  <tr>
				  <td colspan='3'>
				  
				  <strong>Please click <a href='".$cfg['base_url']."/webmaster/message.php?act=reject_acknowledgement&ord_id=".trim($order_id)."' target='_blank'>here</a> to reject this order.</strong>				  				  </td>
				  </tr>
				  <tr>
				  <br><br>
					<td colspan='3' style='padding-top:30px; padding-bottom:30px;'><font color='#660000'>
<b><i>
-Thanks & Regards
</i>
</b>
</font> </td>
					</tr>
				  <tr>
				    <td colspan='3'><font color='#CC9933' size='+2' style='text-shadow:#000000'>
<b>
Rainbow Florist
</b> 
</font>
<br> 
<font color='#660000'>
<b><i> 
9920777678 / 9819155649
</i>
</b>
</font>
<br>       
<a href='http://www.rainbowfloristworld.com' target='_blank'>www.rainbowfloristworld.com</a></td>
  </tr>
				  <tr>
				    <td colspan='3'><span style='padding-right:10px;'><strong><span style='color:#5A240F;'>Date:</span></strong>&nbsp;".date('jS F Y')." </span></td>
  </tr>
			</table>";

	return $content = $msgBody1.$msgBody2.$msgBody3;
}
?>