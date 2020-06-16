<?
include_once('../includes_webmaster/links.php');

$act=@$_REQUEST['act']; 

//echo $act;



switch($act){

case 'reject_reason':
		
		$ord_id = $_REQUEST['ord_id'];
		$reason = $_REQUEST['reason_reject'];

		$sql1="UPDATE" .$cfg['DB_ORDER']. "
			  SET `od_acknowledgement` = 'Rejected',
			  	  `od_reject_reason` = '".$reason."'
			  WHERE `od_id` ='".$ord_id."'";
	
		$heart->sql_query($sql1);
		
		
		$sql1="SELECT vendor.id,
						  vendor.vendor_name,
						  vendor.email,
				   		  assign.vendor_id,
						  assign.order_id
				   
				   FROM " .$cfg['DB_VENDOR']. " vendor
				   
				   INNER JOIN ".$cfg['DB_ASSIGN_VENDORS']." assign
				   ON vendor.id = assign.vendor_id
				   
				   WHERE vendor.status = 'A'
				   AND assign.order_id = '".$ord_id."'";

	 		$res1 = $heart->sql_query($sql1);
			$row1 = $heart->sql_fetchrow($res1);
			
			$select_vendor = $row1['vendor_id'];
			
			$from_name = $row1['vendor_name'];
			$from_email = $row1['email'];
			
			$mailMessage=contactMessageGenerator1($ord_id, $select_vendor);
			send_mail('RAINBOW FLORIST','rangan.c@encoders.co.in',$from_name,$from_email,'Rejection Of Order From'.$from_name,$mailMessage);
		
}
?>
<table align="center" bordercolor="#006699" cellpadding="6" cellspacing="1" style="border:thin #006699 solid; margin-top:77px;">
<tr>
<td>
<font color="#006699">
<strong>
We are very Sorry to hear that, you are not satisfied with our proposal.
</strong>
</font>
<br>
<br>
</td>
</tr>
<tr>
<td align="right">
<font color="#660000">
<b><i>
-Thanks & Regards
</i>
</b>
</font>     
<br><br>
</td>
</tr>
<tr>
<td align="right">
<font color="#CC9933" size="+2" style="text-shadow:#000000">
<b>
Rainbow Florist
</b> 
</font>
<br> 
<font color="#660000">
<b><i> 
9920777678 / 9819155649
</i>
</b>
</font>
<br>       
<a href="http://www.rainbowfloristworld.com" target="_blank">www.rainbowfloristworld.com</a>
</td>
</tr>
</table>

<?
function contactMessageGenerator1($order_id, $select_vendor)
{	
	
	global $heart, $cfg;
	
	$sql_vendMail="SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_id` = '".$order_id."'  ";
	$res_vendMail=$heart->sql_query($sql_vendMail);
	$row_vendMail=$heart->sql_fetchrow($res_vendMail);
	
	$deliver_date = $row_vendMail['od_delivery_date'];
	$msg = $row_vendMail['od_shipping_msg'];
	$instruction = $row_vendMail['od_shipping_instruction'];
	$address = $row_vendMail['od_shipping_address1'];
	$sender_name = $row_vendMail['od_shipping_sender_name'];
	
	
$sql_od = "SELECT order_item.od_id, 
				  order_item.pd_id, 
				  order_item.od_qty,
				  avail.price,
				  avail.product_id,
				  avail.vendor_id
		   FROM ".$cfg['DB_ORDER_ITEM']." order_item 
		   INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail
		   
		   ON avail.product_id = order_item.pd_id
		   
		   WHERE order_item.od_id = '".$order_id."'
		   AND avail.vendor_id = '".$select_vendor."'";
$res_od = $heart->sql_query($sql_od);
$maxrow_od = $heart->sql_numrows($res_od);

$total_price = $row_od['price'] * $row_od['od_qty'];
	
	
	$from_name="Rainbow Florist";
	
	
	$msgBody1 = "<table width='590px' border='0' cellpadding='0' cellspacing='0' align='center' style='border-top-style:double; border-top-color:#000000;'>
			  <tr>
			  <td colspan='3'>
			  <br>
			  <b>Dear Sir/madam,</b>
			  <br>
			  <br>			  </td>
			  </tr>
				  <tr>
					<td width='33%' valign='top' colspan='3'>
					 This is in regards of Rejection of Orders placed by You with the order No <b>".$row_vendMail['or_pattern']."</b>					
					  <br><br><b><u>Below is/are the reason(s)</u>:</b><br>
					  ".$row_vendMail['od_reject_reason']."
					  </td>
					  </tr>
					  <tr>
					  <td colspan='3'>
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
	

	
while($row_od = $heart->sql_fetchrow($res_od))
	{$images1 = getproductdetails($row_od['pd_id'],'pd_image');
		$msgBody2 .= "<tr>
						<td>
						<img src='../".$images.$images1."'  width='70' align='top'/>	
						<a href='../".$images.$images1."' target='_blank' style='text-decoration:none;'>Click Here</a>						
						</td>
						<td>
						<font color='#FF0000'>".getproductdetails($row_od['pd_id'],'pd_description')."</font>					
						</td>
						<td align = 'center'>
						<b>".$row_od['od_qty']."</b>					
						</td>
						<td align = 'center'>
						<b>".$row_od['price']."</b>					
						</td>
					</tr>";
					
					
	}


						$sql_od1 = "SELECT order_item.od_id, 
										  order_item.pd_id, 
										  order_item.od_qty,
										  avail.price,
										  avail.product_id,
										  avail.vendor_id
								   FROM ".$cfg['DB_ORDER_ITEM']." order_item 
								   INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail
								   
								   ON avail.product_id = order_item.pd_id
								   
								   WHERE order_item.od_id = '".$row_vendMail['od_id']."'
								   AND avail.vendor_id = '".$select_vendor."'";
						$res_od1 = $heart->sql_query($sql_od1);
						$row_od1 =	$heart->sql_fetchrow($res_od1);
$grand_total = total($row_vendMail['od_id'], $select_vendor);

$sql_delivery = "SELECT assign.delivery_charges
				 FROM ".$cfg['DB_ASSIGN_VENDORS']."assign
				 
				 INNER JOIN ".$cfg['DB_ORDER']." orders
				 ON assign.order_id = orders.od_id
				 
				 WHERE assign.vendor_id = '".$select_vendor."'";
$res_delivery = $heart->sql_query($sql_delivery);
$row_delivery = $heart->sql_fetchrow($res_delivery);
$delivery_charges = $row_delivery['delivery_charges'];

$allGrandTotal = $grand_total + $delivery_charges;
	
$sql2="SELECT vendor.id,
						  vendor.vendor_name,
						  vendor.email,
				   		  assign.vendor_id,
						  assign.order_id
				   
				   FROM " .$cfg['DB_VENDOR']. " vendor
				   
				   INNER JOIN ".$cfg['DB_ASSIGN_VENDORS']." assign
				   ON vendor.id = assign.vendor_id
				   
				   WHERE vendor.status = 'A'
				   AND assign.order_id = '".$order_id."'";

$res2 = $heart->sql_query($sql2);
$row2 = $heart->sql_fetchrow($res2);

	
$msgBody3 = "<tr>
					<td align='right' colspan='3' width='15%'>
					<b>
					Delivery Charge					
					</b>					
					</td>
					<td align='right'>
					<b>
					".$delivery_charges."					
					</b>					
					</td>
					</tr>
					<tr>
					<td align='right' colspan='3' width='15%'>
					<font color='#FF0000'>
					<b>
					TOTAL Amount					
					</b>					
					</font>					
					</td>
					<td align='right'>
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
					".$address."					
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
					  <p>
					
					</p>
					<p>&nbsp;</p>
					<p>
					
					</p>
					</td>
				  </tr>
				  <tr>
				  <br><br>
					<td colspan='3' style='padding-top:30px; padding-bottom:30px;'><font color='#000000'>
<b><i>
-Thanks & Regards
</i>
</b>
</font> </td>
					</tr>
				  <tr>
				    <td colspan='3'><font color='#990033' size='+2' style='text-shadow:#000000'>
<b>
".$row2['vendor_name']."
</b> 
</font>
<br> 
<font color='#990066'>
<i> 
".$row2['email']."
</i>

</font>
<br><br>
</td>
  </tr>
				  <tr>
				    <td colspan='3'><span style='padding-right:10px;'><strong><span style='color:#5A240F;'>Date:</span></strong>&nbsp;<b>".date('d-m-Y')."</b> </span></td>
  </tr>
			</table>";

	
	
	return $content = $msgBody1.$msgBody2.$msgBody3;
	
}
?>