<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
//page_header($cfg['ADMIN_TITLE']." - Order Management");
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];
$orderstat =($_REQUEST['status']!="")?$_REQUEST['status']:'';
?>
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="js/order.js"></script>



<script type="text/javascript">
	window.onload = function(){
			new JsDatePick({
				useMode:2,
				target:"start_date",
				dateFormat:"%Y-%m-%d",
				cellColorScheme:"beige",
				limitToToday:false,
				imgPath:"img/"
			});
			new JsDatePick({
				useMode:2,
				target:"end_date",
				dateFormat:"%Y-%m-%d",
				cellColorScheme:"beige",
				limitToToday:false,
				imgPath:"img/"
			});
			new JsDatePick({
				useMode:2,
				target:"dd",
				dateFormat:"%d-%m-%Y",
				cellColorScheme:"beige",
				limitToToday:false,
				imgPath:"img/"
			});
		};
	
</script>
<td vAlign=top align="center" width="99%">
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr height="34">
			
		</tr>
		<tr>
			<td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>
			<td align="left" valign="top" width="99%">      
				<table width="698" align="center" border="0" cellspacing="0" cellpadding="0" style="background:url(images/welcome_head.jpg) ;">
					
					
					<tr>
						<td colspan="2" bgcolor="#FFFFF" align="center">
<? 
							
							
							
							//======================================  VIEW RECORD ========================================//
							
							if($show=='view'){
								
								$orderId = $_REQUEST['id'];
								$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_id` = '".$orderId."'  ";
								$res=$heart->sql_query($sql);
								$row=$heart->sql_fetchrow($res);
								if($_REQUEST['eid']!=''){
									$email = $_REQUEST['eid'];
								}
								if($_REQUEST['eid']==''){
									$email = $row['od_shipping_email'];
								}
?>
								
								<p >&nbsp;<strong style="font-size:20px">Order Details Section</strong> </p>
								
								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="1">
									<thead>
										<tr>
											<td colspan="2" align="left" >Order Number : <?=$row['or_pattern']?>&nbsp;&nbsp;( #<?=$row['od_id']?>) 
														&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp
														&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp
														&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp
														&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp
														&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp
											   Order Date : <?=date('d-m-Y',strtotime($row['od_date']))?>
											</td>
											
											
										</tr>
									</thead>
									<tbody>
										
										<tr class="row2">
											<td align="left" width="23%" class="leftBarText_new">Order From </td>
											<td colspan="2" align="left"><?=ucwords(getSiteName($row['siteId']))?></td>
										</tr>
										
										
										<tr class="row1">
											<td align="left" valign="top" class="leftBarText_new">Last Update </td>
											<td colspan="2" align="left" valign="top"><?=($row['od_last_update'])!=''?date('d-m-Y ',strtotime($row['od_last_update'])):'Not Yet Updated'?></td>
										</tr>
										<form action="" method="post" name="frmOrder" id="frmOrder">
											<tr class="row2">
												<td class="leftBarText_new" align="left">Status</td>
												<td colspan="2" align="left">
													<?= $row['od_status'];?>
													                
												</td>
											</tr>
											<tr class="row1">
												<td class="leftBarText_new" align="left">Delivery Status</td> 
												<td colspan="2" align="left">
													<?= $row['od_shipping_type'];?>
																    
												</td>
											</tr>	
											<tr class="row2">

												<td class="leftBarText_new" align="left">Shipping Status</td> 

												<td colspan="2" align="left">	
												
												<?= $row['od_delivery_status'];?>

																    

												</td>
											</tr>
										
											<tr class="row2">
												<td class="leftBarText_new" align="left">Received By</td>
												<td colspan="2" align="left">
													<?=$row['od_received_by']?>
												</td>
											</tr>
											<tr class="row2">
												<td class="leftBarText_new" align="left">Amount Received Through</td>
												<td colspan="2" align="left">
													<?=$row['received_option'];?>
												
												</td>
											</tr>
											
											</tr>
										</form>
										
									</tbody>
								</table>
								<br/>
								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="1">
									<thead>
										<tr>
											<td colspan="5" align="center" class="style2">&nbsp;<strong>Order Item</strong> </td>
										</tr>
									</thead>
									<tbody>
										<tr class="row1">
											<td align="left" class="leftBarText_new">SL.</td>
											<td align="left" class="leftBarText_new">Item</td>
											<td align="left" class="leftBarText_new">Image</td>
											<td width="17%" align="right" class="leftBarText_new">Unit Price(Rs.)</td>
											<td width="18%" align="right" class="leftBarText_new">Total(Rs.)</td>
										</tr>
<?
										$sql_od = "SELECT * 
													 FROM ".$cfg['DB_ORDER_ITEM']." 
													WHERE `od_id` = '".$row['od_id']."'  ";
										$res_od = $heart->sql_query($sql_od);
										$count=1;
										while($row_od =	$heart->sql_fetchrow($res_od))										{
?>
											<tr class="row2">
												<td width="10%" align="left" class="leftBarText_new">
													<?=$count;?>
												</td>
												<td width="60%" align="left" class="leftBarText_new">
													<?=$row_od['od_qty'].' X '.pd_name($row_od['pd_id'])?>&nbsp;(Product Code: <?=getproductdetails($row_od['pd_id'],'pd_code')?>)
												</td>
												<td width="10%" align="left">
													<img src="../<?=$cfg['PRODUCT_IMAGES']?><?=getproductdetails($row_od['pd_id'],'pd_image')?>"  width="70" align="top"/>                   
												</td>
												<td align="right"><?=pd_price($row_od['pd_id'])?></td>
												<td align="right"><?=pd_price($row_od['pd_id']) * $row_od['od_qty']?></td>
											</tr>
<? 
										$count++;
										}
?>
										<tr class="row2">
											<td colspan="4" align="right" class="leftBarText_new">Sub-total</td>
											<td align="right"><?=subTotal($row['od_id'])?></td>
										</tr>
										<tr class="row2">
											<td colspan="4" align="right" valign="top" class="leftBarText_new">Shipping</td>
<? 
											$subtotal=subTotal($row['od_id']);
											$shopConfig['free_shipping_limit'];
											//$shippingCost = ($subtotal>=$shopConfig['free_shipping_limit'])?'0':$shopConfig['shippingCost']; 
											$shippingCost = ($row['od_shipping_cost']=='0')?'0':$row['od_shipping_cost'];?>
											
											<td align="right" valign="top">
												<?=($shippingCost==0)?'- FREE -':displayFrontAmount($shippingCost);?>
											</td>
										</tr>
										<tr class="row2">
											<td colspan="4" align="right" class="leftBarText_new">Total</td>
											<td align="right"><?=($subtotal + $shippingCost)?></td>
										</tr>
										
									</tbody>
								</table>
								<br/>
								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="1">
									<thead>
										<tr>
											<td colspan="3" align="center" class="style2">&nbsp;<strong>Customer Information</strong> </td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td width="29%" align="left" class="row1">
												<span class="leftBarText_new">Email Address </span>
											</td>
											<td width="71%" colspan="2" align="left" class="row2"><?=$email?></td>
										</tr>
										
									</tbody>
								</table>
								<br/>
								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="1">
									<thead>
										<tr>
											<td colspan="3" align="center" class="style2">&nbsp;<strong>Shipping Information</strong> </td>
										</tr>
									</thead>
									<tbody>
									<?
										$sqlDeliveryDate="SELECT * 
															FROM ".$cfg['DB_ORDER']." 
														   WHERE  `od_id` = '".$orderId."'";
										$resDeliveryDate=$heart->sql_query($sqlDeliveryDate);
										$rowDeliveryDate=$heart->sql_fetchrow($resDeliveryDate);
									?>
										<tr>
											<td class="row1" align="left">
												<span class="leftBarText_new">Delivery Date</span> 
											</td>
											<td colspan="2" align="left" class="row2"><?=date('d-m-Y',strtotime($rowDeliveryDate['od_delivery_date']));?></td>
										</tr>
										<tr>
											<td width="29%" align="left" class="row1">
												<span class="leftBarText_new">First Name </span>
											</td>
											<td width="71%" colspan="2" align="left" class="row2"><?=$row['od_shipping_first_name']?></td>
										</tr>
										<tr>
											<td align="left" class="row1">
												<span class="leftBarText_new">Last Name</span>
											</td>
											<td colspan="2" align="left" class="row2"><?=$row['od_shipping_last_name']?></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="row1">
												<span class="leftBarText_new">Address </span>
											</td>
											<td colspan="2" align="left" valign="top" class="row2"><?=$row['od_shipping_address1']?></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="row1">
												<span class="leftBarText_new">City</span> 
											</td>
											<td colspan="2" align="left" valign="top" class="row2">
												<?php /*?><?=$row['od_shipping_city']?><?php */?>
												<?=getFieldsFromTable($row['od_shipping_city'],'city_name',$cfg['DB_CITIES'],'ct_id')?>
											</td>
										</tr>
										<tr>
											<td align="left" class="row1">
												<span class="leftBarText_new">State</span>
											</td>
											<td colspan="2" align="left" class="row2">
												<?=$row['od_shipping_state']?>
												<?php /*?><?=getFieldsFromTable($row['od_shipping_state'],'state_name',$cfg['DB_STATE'],'st_id')?><?php */?>
											</td>
										</tr>
										<tr>
											<td align="left" valign="top" class="row1">
												<span class="leftBarText_new">Country</span> 
											</td>
											<td colspan="2" align="left" valign="top" class="row2">
												<?=$row['od_shipping_country']?>
												<?php /*?><?=getFieldsFromTable($row['od_shipping_country'],'country_name',$cfg['DB_COUNTRY_MASTER'],'country_id')?><?php */?>
											</td>
										</tr>
										<tr>
											<td class="row1" align="left">
												<span class="leftBarText_new">Pincode</span> 
											</td>
											<td colspan="2" align="left" class="row2"><?=$row['od_shipping_postal_code']?></td>
										</tr>
										<tr>
											<td width="29%" align="left" class="row1">
												<span class="leftBarText_new">Mobile Number </span>
											</td>
											<td width="71%" colspan="2" align="left" class="row2">
												<?=($row['od_shipping_mobile']!='')?$row['od_shipping_mobile']:'No Mobile No.'?>
											</td>
										</tr>
										<tr>
											<td width="29%" align="left" class="row1">
												<span class="leftBarText_new">Phone Number </span>
											</td>
											<td width="71%" colspan="2" align="left" class="row2"><?=$row['od_shipping_phone']?></td>
										</tr>
										<tr>
											<td class="row1" align="left">
												<span class="leftBarText_new">Message On Card</span> 
											</td>
											<td colspan="2" align="left" class="row2"><?=$row['od_shipping_msg']?></td>
										</tr>
										<tr>
											<td class="row1" align="left">
												<span class="leftBarText_new">Sender's Name</span> 
											</td>
											<td colspan="2" align="left" class="row2"><?=$row['od_shipping_sender_name']?></td>
										</tr>
										<tr>
											<td class="row1" align="left">
												<span class="leftBarText_new">Special Instruction</span> 
											</td>
											<td colspan="2" align="left" class="row2"><?=$row['od_shipping_instruction']?></td>
										</tr>
										
									</tbody>
								</table>
								<br/>
								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="1">
									<thead>
										<tr>
											<td colspan="3" align="center" class="style2">&nbsp;<strong>Billing Information</strong> </td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td width="29%" align="left" class="row1">
												<span class="leftBarText_new">First Name </span>
											</td>
											<td width="71%" colspan="2" align="left" class="row2"><?=$row['od_payment_first_name']?></td>
										</tr>
										<tr>
											<td align="left" class="row1">
												<span class="leftBarText_new">Last Name</span>
											</td>
											<td colspan="2" align="left" class="row2"><?=$row['od_payment_last_name']?></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="row1">
												<span class="leftBarText_new">Address </span>
											</td>
											<td colspan="2" align="left" valign="top" class="row2"><?=$row['od_payment_address1']?></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="row1">
												<span class="leftBarText_new">City</span> 
											</td>
											<td colspan="2" align="left" valign="top" class="row2">
												<?=$row['od_payment_city']?>
												<?php /*?><?=getFieldsFromTable($row['od_payment_city'],'city_name',$cfg['DB_CITIES'],'ct_id')?><?php */?>
											</td>
										</tr>
										<tr>
											<td align="left" class="row1">
												<span class="leftBarText_new">State</span>
											</td>
											<td colspan="2" align="left" class="row2">
												<?=$row['od_payment_state']?>
												<?php /*?><?=getFieldsFromTable($row['od_payment_state'],'state_name',$cfg['DB_STATE'],'st_id')?><?php */?>
											</td>
										</tr>
										<tr>
											<td align="left" valign="top" class="row1">
												<span class="leftBarText_new">Country</span> 
											</td>
											<td colspan="2" align="left" valign="top" class="row2">
												<?=$row['od_payment_country']?>
												<?php /*?><?=getFieldsFromTable($row['od_shipping_country'],'country_name',$cfg['DB_COUNTRY_MASTER'],'country_id')?><?php */?>
											</td>
										</tr>
										<tr>
											<td width="29%" align="left" class="row1">
												<span class="leftBarText_new">Mobile Number </span>
											</td>
											<td width="71%" colspan="2" align="left" class="row2">
												<?=($row['od_payment_mobile']!='')?$row['od_payment_mobile']:'No Mobile No.'?>
											</td>
										</tr>
										<tr>
											<td width="29%" align="left" class="row1">
												<span class="leftBarText_new">Phone Number </span>
											</td>
											<td width="71%" colspan="2" align="left" class="row2"><?=$row['od_payment_phone']?></td>
										</tr>
										<tr>
											<td class="row1" align="left">
												<span class="leftBarText_new">Pincode</span> 
											</td>
											<td colspan="2" align="left" class="row2"><?=$row['od_payment_postal_code']?></td>
										</tr>
										<tr>
											<td class="row1" align="left">
												<span class="leftBarText_new">Email</span> 
											</td>
											<td colspan="2" align="left" class="row2"><?=$row['od_payment_email']?></td>
										</tr>
										
									</tbody>
								</table>
<? 
							}
?>
						</td>
					</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="right"></td>
		</tr>
	</table>