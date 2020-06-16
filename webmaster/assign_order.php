<?php 

	include_once('../includes_webmaster/links.php');
    include_once('../includes_webmaster/admininit.php');

	if($_REQUEST['m']==1) { $msg='Record Added';}

	if($_REQUEST['m']==2) { $msg='Record Updated';}

	page_header($cfg['ADMIN_TITLE']." - Assigned Orders Management");

	$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';

	$show=$_REQUEST['show'];

	$orderstat =($_REQUEST['status']!="")?$_REQUEST['status']:'';

?>

<script language="javascript" src="../vendor_webmaster/scripts/common.js"></script>

<script language="javascript" src="../vendor_webmaster/js/order.js"></script>

<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" media="all" href="../vendor_webmaster/css/calender/jsDatePick_ltr.min.css" />

<style type="text/css">

	.style3 {color: #FFFFFF}

</style>

<script type="text/javascript" src="scripts/calender/jsDatePick.min.1.3.js"></script>

<script type="text/javascript">

	/*=========== START CALENDER ===============*/

	window.onload = function(){

		new JsDatePick({

			useMode:2,

			target:"hidShippingDate",

			dateFormat:"%Y-%m-%d",

			cellColorScheme:"beige",

			limitToToday:false,

			imgPath:"img/"

		});

	};

</script>

<script type="text/javascript">

			/*=========== START CALENDER ===============*/

			window.onload = function(){

				new JsDatePick({

					useMode:2,

					target:"hidShippingDate1",

					dateFormat:"%Y-%m-%d",

					cellColorScheme:"beige",

					limitToToday:false,

					imgPath:"img/"

				});

			};

</script>

<script language="javascript" type="text/javascript">

function printContentSalesList(div_id,print_link)

{

    var DocumentContainer = document.getElementById(div_id,print_link); 

    var html = '<html><head>'+

	           '</head><body style="background:#EFEFEF;">'+

			   '<link rel="stylesheet" type="text/css" href="css/adminstyle.css" />'+

			   DocumentContainer.innerHTML+

			   '</body></html>';

	var WindowObject = window.open("", "PrintWindow",

	"width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");

	WindowObject.document.writeln(html);

	WindowObject.document.close();

	WindowObject.focus();

	WindowObject.print();

	WindowObject.close();

	document.getElementById(print_link).style.display='block';

}



function total_amount(id)

{

var a = document.getElementById("vendor_amount_"+id).value;

a += parseFloat(a);

document.getElementById("total_vendor_amount").value = a;  

}

function vendorAmount(id){

//alert(id);

var vendor_amount = document.getElementById("vendor_amount_"+id);

	if(vendor_amount.value == "")

	{

		alert("Please Provide Vendor Product Amount...!!");

		vendor_amount.focus();

		return false;

	}

}

function find_vender(obj)

{

var location=$('#select_vendor').find('option:selected').attr("data");

$('#vendor_city_name').html("");

$('#vendor_state_name').html("");

if(location!='')

{

	var loc=location.split('@');

	$('#vendor_city_name').html(loc[0]);

	$('#vendor_state_name').html(loc[1]);

}

}

function Change_vendor_type(id)

{

if(id=='register')

{

	$('#vendor_email').val('');

	$('#vendor_name').val('');

	$('#old_vendor').css('display','inline');

	$('#new_vendor').css('display','none');

}

else if(id=='unregister')

{

	$('#new_vendor').css('display','inline');

	$('#old_vendor').css('display','none');

}

}

</script>

<td vAlign="top" align="center" width="99%">

	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">

		<tr height="34">

			<td width="25%" rowspan="2" colspan="3" align="center" valign="top">

				<br />

				<?php include_once("left_bar.php");?>

			</td>

		</tr>

		<tr>

			<td align="center" valign="middle"><img src="../webmaster/images/spacer.gif" width="1" height="550" /></td>

			<td align="left" valign="top" width="99%">      

				<table width="698" align="center" border="0" cellspacing="0" cellpadding="0" style="background:url(../webmaster/images/welcome_head.jpg) center top no-repeat;">

					<tr height="35" >

						<td width="640" align="left" valign="middle">&nbsp;&nbsp;

							<span class="style1">Welcome

								<?=$_SESSION['admin_user_name']?>

							</span>

							<?

							if($_REQUEST['show'] == '' || $_REQUEST['show'] == 'view')

							{

							?>

							<img src="images/printer_icon.png" title="Print" alt="Print" width="19" height="19" border="0" onclick="printContentSalesList('printSalesList',this.id)" style="float:right"/>

							<?

							}

							?>

						</td>

						<td width="56" align="right" valign="middle">

							<a href="../webmaster/login.php?act=<?=md5("logout")?>">

								<img src="../webmaster/images/lock.png" title="Logout" width="24" height="24" border="0" style="vertical-align: middle;" />

							</a>&nbsp;&nbsp;&nbsp;

						</td>

					</tr>
					<tr height="16">
						<td colspan="9" style="background-color:#eee8e8;" valign="middle" align="left">&nbsp;</td>
					</tr>
					

					<tr>

						<td colspan="9" style="background-color:#eee8e8;" align="center">

<? 

							//======================================  SHOW ALL RECORDS ========================================//

							if($_REQUEST['show']==''){		

?>								<div id="printSalesList">

									<table width="98%" height="212" align="center" cellpadding="4" cellspacing="1" class="tborder_new" border="0">

									<thead>

										<tr>

											<td colspan="7" align="left">&nbsp;<span class="style2">Assigned Order Section</span> </td>

											<td colspan="2" align="right">

												<select name="status" class="forminputelement" id="status" onChange="getOrderStatus(this.value)">

													<option value="" <?=($_REQUEST['status']=='' || $_REQUEST['statushidden']=='')?'selected="selected"':''?>>All</option>

													<option value="Unpaid" <?=($_REQUEST['status']=='Unpaid' || $_REQUEST['statushidden']=='Unpaid')?'selected="selected"':''?>>Unpaid</option>

													<option value="Paid" <?=($_REQUEST['status']=='Paid' || $_REQUEST['statushidden']=='Paid')?'selected="selected"':''?>>Paid</option>

													<option value="Shipped" <?=($_REQUEST['status']=='Shipped' || $_REQUEST['statushidden']=='Shipped')?'selected="selected"':''?>>Shipped</option>

													<option value="Completed" <?=($_REQUEST['status']=='Completed'  || $_REQUEST['statushidden']=='Completed')?'selected="selected"':''?>>Completed</option>

													<option value="Cancelled" <?=($_REQUEST['status']=='Cancelled'  || $_REQUEST['statushidden']=='Cancelled')?'selected="selected"':''?>>Cancelled</option>

													<option value="Dispute" <?=($_REQUEST['status']=='Dispute'  || $_REQUEST['statushidden']=='Dispute')?'selected="selected"':''?>>Dispute</option>

													<option value="Return" <?=($_REQUEST['status']=='Return'  || $_REQUEST['statushidden']=='Return')?'selected="selected"':''?>>Return</option>

													<option value="Refund" <?=($_REQUEST['status']=='Refund'  || $_REQUEST['statushidden']=='Refund')?'selected="selected"':''?>>Refund</option>

												</select>                    

											</td>

										</tr>

									</thead>

<?

									$sql	=	"SELECT ord.*,assign.unregister_vendor as unregister_vendor FROM ".$cfg['DB_ORDER']." ord

										 			 LEFT OUTER JOIN(SELECT unregister_vendor,order_id FROM ".$cfg['DB_ASSIGN_VENDORS']."  )assign

										 			 ON assign.order_id=ord.od_id

													 WHERE ord.od_status!= 'D' ORDER BY od_id desc";

									$res	=	$heart->sql_query($sql);

									$maxrow	=	$heart->sql_numrows($res);

									$sql 	= 	$sql. " LIMIT $offset,$limit";

									$res 	= 	$heart->sql_query($sql);

?>

									<tbody>

									  <form name="frmsearch" method="post" action="assign_order.php" id="frmsearch" onSubmit=" return searc();">

											<input type="hidden" name="statushidden" id="statushidden" value="<?=$orderstat?>" />

											<input type="hidden" name="orderdatehidden" id="orderdatehidden" value="" />

											<input type="hidden" name="act" value="searc" />

											<!--<tr>

												<td style="margin:0px; padding:0px;" colspan="9">

												<table width="100%" style="border:none;">

												<tr class="row1">

												<td align="left" class="leftBarText_new" width="15%">

												Order ID:

												</td>                  

												<td width="7%" align="left">

												<input type="text" name="order_id" value="<?=$_REQUEST['order_id']?>" class="forminputelement">

												</td>

												<td align="left" class="leftBarText_new" width="40%">

												Customer Name:

												</td>  

												<td width="18%" align="left" class="leftBarText_new1">

												<input type="text" name="customer_name" value="<?=$_REQUEST['customer_name']?>" class="forminputelement">

												</td>

												<td align="left" class="leftBarText_new" width="40%">

												Delivery Date:

												</td>  

												<td width="18%" align="left" class="leftBarText_new1">

												<input type="text" name="delivery_date"  id="hidShippingDate" value="<?=$_REQUEST['delivery_date']?>" readonly="readonly" class="forminputelement">

												</td>

												<td width="11%" align="center" colspan="2" rowspan="2">

												<input type="submit" value="Search" name="submit1" class="loginbttn">

												</td>

												

												

											</tr>

											<tr class="row1">

											<td align="left" class="leftBarText_new" width="40%">

											Order Date:

											</td>  

											<td width="18%" align="left" class="leftBarText_new1">

											<input type="text" name="order_date"  id="hidShippingDate1" value="<?=$_REQUEST['order_date']?>" readonly="readonly" class="forminputelement">

											</td>

											<td align="left" class="leftBarText_new" width="40%">

											Delivery Status:

											</td>  

											<td width="18%" align="left" class="leftBarText_new1">

											<select name="delivery_status" class="forminputelement">

												<option value="">-- Select Delivery Status --</option>

												<option value="Yes" <? if($_REQUEST['delivery_status']== 'Yes'){?> selected="selected"<? }?>>

												-- Delivered --

												</option>

												<option value="No" <? if($_REQUEST['delivery_status']== 'No'){?> selected="selected"<? }?>>

												-- Not Delivered --

												</option>

												<option value="Attempted" <? if($_REQUEST['delivery_status']== 'Attempted'){?> selected="selected"<? }?>>

												-- Attempted --

												</option>

											</select>

											</td>

											<td align="left" class="leftBarText_new" width="40%">

											Assigned Vendors:

											</td>  

											<td width="18%" align="left" class="leftBarText_new1">

											<select name="assigned_vendors" class="forminputelement">

											<option value="">-- Select Vendor --</option>

											

											<?

												$sql_vend="SELECT vendor.id,

																  vendor.vendor_name,

																  vendor.id as vend,

																  assign.vendor_id,

																  assign.order_id,

																  assign.status

																

																

														   FROM ".$cfg['DB_ASSIGN_VENDORS']." assign 

														   

														   

														   INNER JOIN ".$cfg['DB_VENDOR']." vendor

														   ON vendor.id = assign.vendor_id 

														   

														   GROUP BY assign.vendor_id";

														   

														   

												$res_vend=$heart->sql_query($sql_vend);

												$maxrow_vend=$heart->sql_numrows($res_vend);

												

												if($maxrow_vend > 0){

													while($row_vend=$heart->sql_fetchrow($res_vend)){		

											?>

											

											<option value="<?=$row_vend['vendor_id']?>" <? if($_REQUEST['assigned_vendors']== $row_vend['vendor_id']){?> selected="selected"<? }?>><?=$row_vend['vendor_name']?></option>

											<?

											}}

											?>

											</select>

											</td>

											</tr>

											</table>

											</td>

											</tr>-->

												

											<tr class="headercontent">

												<td width="4%" align="center" class="leftBarText_new1">Sl No</td>                  

												<td width="7%" align="center" class="leftBarText_new1">Order Id</td>

												<td width="22%" align="left" class="leftBarText_new1">Customer Name </td>

												<td width="18%" align="center" class="leftBarText_new1">Delivery Date</td>

												<td width="16%" align="center" class="leftBarText_new1">Order Date </td>

												<td width="11%" align="center" class="leftBarText_new1">Order Acknowledgement</td>																								<td width="11%" align="center" class="leftBarText_new1">Shipping Type</td>

												<td width="11%" align="center" class="leftBarText_new1">Delivery Status</td>

												<td align="center" class="leftBarText_new1" colspan="2">Assign Vendor</td>

											</tr>

<?

												if($maxrow > 0)

												{

													while($row = $heart->sql_fetchrow($res))

														{@$i++;

														 $c_id=$row['cust_id'];		 		 $shippingType='Normal';		 		 if($row['od_shipping_type']=='mid_night')		 {		 	$shippingType='Midnight';		 }		 else if($row['od_shipping_type']=='fixed')		 {		 	$shippingType='Fixed Time';		 }

?>

													<tr class="<?=($i%2==0)?'row1':'row2'?>">

														<td align="center"><?=$i?></td>                           

														<td align="center"><?=$row['or_pattern']?></td>

														<td align="center" class="linkTitle"><?=$row['od_shipping_first_name'].' '.$row['od_shipping_last_name']?></td>

														<td align="center"><?=date('d-m-Y',strtotime($row['od_delivery_date']));?></td>

														<td align="center"><?=date('d-m-Y H:i:s',strtotime($row['od_date']));?></td>																												

														<td align="center">

														<? if($row['od_acknowledgement']=='Pending'){ ?>

														<a class="pending" style="text-decoration:none">

														Pending

														</a>

														<?

														}

														

														elseif($row['od_acknowledgement']=='Rejected')

														{

														?>

														<a class="notDelivered" style="text-decoration:none">

														Rejected

														</a>

														<?

														}

														elseif($row['od_acknowledgement']=='Accepeted')

														{

														?>

														<a class="delivered" style="text-decoration:none">

														Accepted

														</a>

														<?

														}

														?>

														</td>																												<td align="center"><?=$shippingType;?></td>

														<td align="center">

														<? if($row['od_delivery_status']=='Yes'){ ?>

														<a style="text-decoration:none;" class="delivered" id="delivery">

														Delivered

														</a>

														<?

														}

														elseif($row['od_delivery_status']=='Attempted')

														{

														?>

														<a style="text-decoration:none;" class="attempted" id="delivery">

														Attempted

														</a>

														<?

														}

														else

														{

														?>

														<a style="text-decoration:none;"class="notDelivered" id="delivery">

														Not Delivered

														</a>

														<?

														}

														?>

														</td>

														<td align="center" colspan="2">

														<?

														$sql_assgn="SELECT vendor.id,

																		 		vendor.vendor_name,

																				vendor.id as vend,

																				assign.vendor_id,

																				assign.order_id,

																				assign.status

																		 FROM ".$cfg['DB_ASSIGN_VENDORS']." assign 

																		 INNER JOIN ".$cfg['DB_VENDOR']." vendor

																		 ON vendor.id = assign.vendor_id

																		 WHERE assign.order_id = '".$row['od_id']."'";

														$res_assgn=$heart->sql_query($sql_assgn);

														$row_assgn=$heart->sql_fetchrow($res_assgn);

														?>

														<? if($row_assgn['vendor_id']=='' &&  $row['unregister_vendor']=='' ){?>

														<img src="images/assign.png" title="Assign Order" width="16" height="16" border="0" onClick="window.location.href='assign_order.php?show=assign_order&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>'" style="cursor:pointer;"/>

														<?

														}

														elseif($row['od_delivery_status']=='Yes'){ ?>

														<b>

														<a href="assign_order.php?show=view&amp;id=<?=$row['od_id']?>&vendor_id=<?=$row_assgn['id']?>&amp;c_id=<?=$row['cust_id']?>" style="text-decoration:none;" class="msg" title="View Details">

														<?=($row_assgn['vendor_name']!='')?$row_assgn['vendor_name']:$row['unregister_vendor'];?>

														</a>

														</b>

														<?

														}

														else

														{

														?>

														<b>

														<a href="assign_order.php?show=view&amp;id=<?=$row['od_id']?>&vendor_id=<?=$row_assgn['id']?>&amp;c_id=<?=$row['cust_id']?>" style="text-decoration:none;" class="msg" title="View Details">

														<?=($row_assgn['vendor_name']!='')?$row_assgn['vendor_name']:$row['unregister_vendor'];?>

														</a>

														</b>

														 

														<a href="assign_order_process.php?act=unassign_order&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>&vendor_id=<?=$row_assgn['vendor_id']?>" style="text-decoration:none;" onClick="return confirm('Do You really want to cancel the order to assign this vendor?');"><img src="images/cancel.png" height="16" width="16" title="Cancel Order" alt="Cancel Order"></a>

														<?

														}

														?>

														

														<?php /*?><?

														}

														}

														?><?php */?>

														</td>

													</tr>

<? 

											}

											}

											}

?>

											<tr >

												<td  align="left" class="redbuttonelements">

<? 

													if($_REQUEST['main']!=''){

?>

														<a style="color:#ccc;" href="../vendor_webmaster/product.php?category=<?=$_REQUEST['category']?>&amp;pageno=<?=$_REQUEST['page']?>" class="back">&lt;&lt;back</a>

<? 

													} 

?>

													&nbsp;

												</td>

												<td  align="right" class="redbuttonelements" >

													<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>												</td>

											</tr>

									  </form>

									

<? 

							//======================================  Assign  An Order ========================================//

		

							if($show=='assign_order')

							{ 

								$orderId	=	$_REQUEST['id'];	

								$c_Id 		= 	$_REQUEST['c_id'];

								$sql		=	"SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_id` = '".$orderId."'  ";

								$res		=	$heart->sql_query($sql);

								$row		=	$heart->sql_fetchrow($res);

								if($_REQUEST['eid']!='')

								{

									$email = $_REQUEST['eid'];

								}

								if($_REQUEST['eid']=='')

								{

									$email = $row['od_shipping_email'];

								}

?>
								<td style="background:#eee8e8" colspan="9" align="center">
								<form action="assign_order_process.php" method="post" name="frm1" id="frm1">

								<input type="hidden" name="act" value="assign_vendor">

								<input type="hidden" name="order_id" value="<?=$row['od_id']?>">

								<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Order Details Section </td>

										</tr>

									</thead>

									<tbody>

										<tr class="row1">

											<td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>

										</tr>

										<tr class="row2">

											<td align="left" class="leftBarText_new">Order From </td>

											<td colspan="2" align="left"><?=ucwords(getSiteName($row['siteId']))?></td>

										</tr>

										<tr class="row1">

											<td width="23%" align="left" class="leftBarText_new">Order Number</td>

											<td width="77%" colspan="2" align="left">

												<?=$row['or_pattern']?>&nbsp;&nbsp;( #<?=$row['od_id']?>)											</td>

										</tr>

										<tr class="row2">

											<td align="left" class="leftBarText_new">Order Date & Time</td>

											<td colspan="2" align="left"><?=date('d-m-Y H:i:s',strtotime($row['od_date']));?></td>

										</tr>

										<tr class="row1">

											<td align="left" valign="top" class="leftBarText_new">Last Update </td>

											<td colspan="2" align="left" valign="top">
										 <? if($row['od_last_update']!='')
											{
												echo date('d-m-Y H:i:s',strtotime($row['od_last_update']));
											}
											else
											{
												echo "----";
											}?></td>

										</tr>

										

											<tr class="row2">

												<td class="leftBarText_new" align="left">Status</td>

												<td colspan="2" align="left" <? if($row['od_status']=='Unpaid'){?> class="pending" <? }?>>

													<?=$status = $row['od_status'];?>												

												</td>

											</tr>																						<tr class="row2">												<td class="leftBarText_new" align="left">Shipping Type</td>												<td colspan="2" align="left" >													<?php													$shippingType='Normal';																											if($row['od_shipping_type']=='mid_night')														{															$shippingType='Midnight';														}														else if($row['od_shipping_type']=='fixed')														{															$shippingType='fixed time';														}																										?>													<?=$shippingType;?>																								</td>											</tr>

											<tr class="row1">

												<td class="leftBarText_new" align="left">Delivary Status</td> 

												<td colspan="2" align="left" <? if($row['od_delivery_status']=='No'){?> class="notDelivered" <? } elseif($row['od_delivery_status']=='Attempted') {?> class="leftBarText" <? } else {?> class="delivered" <? }?>>

												 <?=$row['od_delivery_status']?>												

												</td>

											</tr>

											<? if($row['od_delivery_status']=='Yes'){ ?>

											<a style="text-decoration:none;" class="delivered" id="delivery">

											Delivered

											</a>

											<?

											}

											elseif($row['od_delivery_status']=='Attempted')

											{

											?>

											<tr class="row2">

											<td class="leftBarText_new" align="left">Reason</td>

											<td colspan="2" align="left">&nbsp;</td>

											</tr>

											<?

											}

											else

											{

											?>

											<tr class="row2">

											<td class="leftBarText_new" align="left">Reason</td>

											<td colspan="2" align="left">
											<?
											if($row['od_delivery_faild_reason']!='')
											{
												echo $row['od_delivery_faild_reason'];
											}
											else
											{
												echo "----";
											}
											?></td>

											</tr>

											<?

											}

											?>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="4" align="left" class="style2">&nbsp;Order Item </td>

										</tr>

									</thead>

									<tbody>

										<tr class="row1">

											<td align="left" class="leftBarText_new">Item</td>

											<td align="left" class="leftBarText_new">Image</td>

											<td align="right" class="leftBarText_new">Unit Price(Rs.)</td>

											<td align="right" class="leftBarText_new">Total(Rs.)</td>

											<td align="center" class="leftBarText_new">Vendor Amount(Rs.)</td>

										</tr>

<?

										$sql_od 	= "SELECT * FROM ".$cfg['DB_ORDER_ITEM']." WHERE `od_id` = '".$row['od_id']."'  ";

										$res_od 	= $heart->sql_query($sql_od);

										$maxrow_od  = $heart->sql_numrows($res_od);
										//die();
										if($maxrow_od > 0)

										{

										while($row_od =	$heart->sql_fetchrow($res_od))

										{

										@$i++;

?>

										<tr class="row2">

											<td width="60%" align="left" class="leftBarText_new">

												<?=$row_od['od_qty'].' X '.pd_name($row_od['pd_id'])?>&nbsp;(Product Code: <?=getproductdetails($row_od['pd_id'],'pd_code')?>)

											</td>

											<td width="10%" align="left">

												<img src="../<?=$cfg['PRODUCT_IMAGES']?><?=getproductdetails($row_od['pd_id'],'pd_image')?>"  width="70" align="top"/>                   

											</td>

											<td align="right"><?=currency_symbol().pd_price($row_od['pd_id'])?></td>

											<td align="right"><?=currency_symbol().pd_price($row_od['pd_id']) * $row_od['od_qty']?></td>

											<td align="center">

												<input type="hidden" name="prod_id" value="<?=$row_od['pd_id']?>">

												<input type="hidden" name="order_id" value="<?=$row_od['od_id']?>">

												<input type="text" class="forminputelement" style="text-align:right;" size="5" name="vendor_amount[<?=$row_od['pd_id']?>]" id="vendor_amount_<?=$i;?>" value="<?=pd_price($row_od['pd_id']) * $row_od['od_qty'];?>"/>

											</td>

										</tr>

<? 

										}

										}

?>

										<tr class="row2">

											<td colspan="3" align="right" class="leftBarText_new">Sub-total</td>

											<td align="right"><?=currency_symbol().subTotal($row['od_id'])?></td>

											<td align="right">

											</td>

										</tr>

										<tr class="row2">

											<td colspan="3" align="right" valign="top" class="leftBarText_new">Delivery Charges</td>

<? 

											$subtotal=subTotal($row['od_id']);

											$shopConfig['free_shipping_limit'];

											$shippingCost = ($subtotal>=$shopConfig['free_shipping_limit'])?'0':$shopConfig['shippingCost']; ?>

											<td align="right" valign="top">

												<?=($shippingCost==0)?'- FREE -':displayFrontAmount($shopConfig['shippingCost'])?>

											</td>

											<td align="center" valign="top">

												<input type="text" name="delivery_charges" id="delivery_charge" size="5" class="forminputelement" style="text-align:right;">

											</td>

										</tr>

										<tr class="row2">

											<td colspan="3" align="right" class="leftBarText_new">Total</td>

											<td align="right"><?=currency_symbol().  ($subtotal + $shippingCost)?></td>

											<td align="right"></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Customer Information </td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td width="29%" align="left" class="row1">

												<span class="leftBarText_new">Email Address </span>

											</td>

											<td width="71%" colspan="2" align="left" class="row2"><?=$email?></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Shipping Information </td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Delivery Date</span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['od_delivery_date']?></td>

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

											</td><?

											 $sql_od1 = "SELECT location.city_name,

															  location.ct_id,

															  orders.od_shipping_city,

															  orders.od_id 

													   	FROM ".$cfg['DB_ORDER']." orders 

													  	INNER JOIN ".$cfg['DB_CITIES']." location

													  	ON location.ct_id = orders.od_shipping_city

													   	WHERE orders.od_id = '".$row['od_id']."'";

											$res_od1 = $heart->sql_query($sql_od1);

											$row_od1 = $heart->sql_fetchrow($res_od1);

											?>

											<td colspan="2" align="left" valign="top" class="row2">

												<?php /*?><?=$row['od_shipping_city']?><?php */?>

												<?=$row_od1['city_name']?>

											</td>

										</tr>

										<tr>

											<td align="left" class="row1">

												<span class="leftBarText_new">State</span>

											</td>

											<td colspan="2" align="left" class="row2">

												<?=$row['od_shipping_state']?>

											</td>

										</tr>

										<tr>

											<td align="left" valign="top" class="row1">

												<span class="leftBarText_new">Country</span> 

											</td><?

											?>

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

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Delivery Time </span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['delivery_time']?></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Assign Orders </td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td width="29%" align="left" class="row1">

												<span class="leftBarText_new">Select Vendor </span>

											</td>

											<td width="71%" colspan="2" align="left" class="row2">

											<?

											 $sql_vendor = "SELECT vendor.vendor_name,vendor.city as vendor_city, 

																	   vendor.id, vendor.state as vendor_state, 

																	   vendor.status, loc.name as citys,

																	   orders.od_shipping_city,

																	   orders.od_id

																FROM  ".$cfg['DB_VENDOR']." vendor

																INNER JOIN  ".$cfg['DB_ORDER']." orders 

																ON 1

														LEFT OUTER JOIN (SELECT name,id FROM".$cfg['DB_LOCATION'].") as loc

																ON loc.id=vendor.city	

															WHERE vendor.status = 'A'  

														 AND orders.od_id = '".$_REQUEST['id']."'

														 ORDER BY vendor.id DESC";

														   

											$res_vendor = $heart->sql_query($sql_vendor);

											$maxrow_vendor = $heart->sql_numrows($res_vendor);

											?>

											<div id="old_vendor" style="display:inline">

											<select name="select_vendor" id="select_vendor" onchange="find_vender(this.id);" class="forminputelement">

											<option value=" " data=''>--Select Vendor--</option>

											<?

											if($maxrow_vendor > 0)

													{

														while($row_vendor = $heart->sql_fetchrow($res_vendor))

															{

															$location=$row_vendor['citys'].'@'.$row_vendor['vendor_state'];	

											?>

											<option value="<?=$row_vendor['id']?>" data="<?=$location?>"><?=$row_vendor['vendor_name']?></option>

											<?

															}

													}

											?>

											</select>

											</div>

											<div id="new_vendor" style="display:none">Name:<input type="text" name="vendor_name" id="vendor_name" value="" />

											&nbsp;Email:<input type="text" name="vendor_email" id="vendor_email" value="" />

											</div>

											<span id="vendor_city_name"></span><span id="vendor_state_name" style="padding-left:20px;"></span>

											</td>

										</tr>

										<tr>

											<td align="left" class="row1" valign="top">

												<span class="leftBarText_new">Vender Type</span>

											</td>

											<td colspan="2" align="left" class="row2">

											Register<input type="radio" name="vendor_type" id="register" value="register" onclick="Change_vendor_type(this.id);" checked="checked" />

											Unregister<input type="radio" name="vendor_type" id="unregister" value="unregister" onclick="Change_vendor_type(this.id);" />

											</td>

										</tr>

										<tr>

											<td align="left" class="row1" valign="top">

												<span class="leftBarText_new">Notes</span>

											</td>

											<td colspan="2" align="left" class="row2">

											<textarea name="notes"></textarea>

											</td>

										</tr>

										<tr>

											<td colspan="3" align="center" >

												<a class="brownbttn" href="../webmaster/assign_order.php">

													&lt;&lt;&nbsp;Back

												</a>

											&nbsp;

												<input type="submit" name="save" value="Assigned" class="loginbttn">

											</td>

										</tr>

									</tbody>

								</table>

								</form>
							</td>
							</tbody>

								</table>

								</div>
<? 

							}

							

							if($show=='edit')

							{ 

								$orderId 	= $_REQUEST['id'];	

								$c_Id 		= $_REQUEST['c_id'];

								$sql		= "SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_id` = '".$orderId."'  ";

								$res		= $heart->sql_query($sql);

								$row		= $heart->sql_fetchrow($res);

								if($_REQUEST['eid']!='')

								{

									$email = $_REQUEST['eid'];

								}

								if($_REQUEST['eid']=='')

								{

									$email = $row['od_shipping_email'];

								}

?>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Order Details Section </td>

										</tr>

									</thead>

									<tbody>

										<tr class="row1">

											<td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>

										</tr>

										<tr class="row2">

											<td align="left" class="leftBarText_new">Order From </td>

											<td colspan="2" align="left"><?=ucwords(getSiteName($row['siteId']))?></td>

										</tr>

										<tr class="row1">

											<td width="23%" align="left" class="leftBarText_new">Order Number</td>

											<td width="77%" colspan="2" align="left">

												<?=$row['or_pattern']?>&nbsp;&nbsp;( #<?=$row['od_id']?>)											

											</td>

										</tr>

										<tr class="row2">

											<td align="left" class="leftBarText_new">Order Date & Time</td>

											<td colspan="2" align="left"><?=date('d-m-Y H:i:s',strtotime($row['od_date']));?></td>

										</tr>

										<tr class="row1">

											<td align="left" valign="top" class="leftBarText_new">Last Update </td>

											<td colspan="2" align="left" valign="top"><?=date('d-m-Y H:i:s',strtotime($row['od_last_update']));?></td>

										</tr>

											<tr class="row2">

												<td class="leftBarText_new" align="left">Status</td>

												<td colspan="2" align="left" <? if($row['od_status']=='Unpaid'){?> class="pending" <? }?>>

													<?=$status = $row['od_status'];?>												

												</td>

											</tr>

											<tr class="row1">

												<td class="leftBarText_new" align="left">Delivary Status</td> 

												<td colspan="2" align="left" <? if($row['od_delivery_status']=='No'){?> class="notDelivered" <? } elseif($row['od_delivery_status']=='Attempted') {?> class="leftBarText" <? } else {?> class="delivered" <? }?>>

												 <?=$row['od_delivery_status']?>												

												</td>

											</tr>

											<? if($row['od_delivery_status']=='Yes')

												{ 

											?>

												<a style="text-decoration:none;" class="delivered" id="delivery">Delivered</a>

											<?

												}

												elseif($row['od_delivery_status']=='Attempted')

												{

											?>

													<tr class="row2">

													<td class="leftBarText_new" align="left">Reason</td>

													<td colspan="2" align="left"><?=$row['od_delivery_faild_reason']?></td>

													</tr>

											<?

												}

												else

												{

											?>

													<tr class="row2">

													<td class="leftBarText_new" align="left">Reason</td>

													<td colspan="2" align="left"><?=$row['od_delivery_faild_reason']?></td>

													</tr>

											<?

												}

											?>

										</form>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="4" align="left" class="style2">&nbsp;Order Item </td>

										</tr>

									</thead>

									<tbody>

										<tr class="row1">

											<td align="left" class="leftBarText_new">Item</td>

											<td align="left" class="leftBarText_new">Image</td>

											<td width="17%" align="right" class="leftBarText_new">Unit Price(Rs.)</td>

											<td width="18%" align="right" class="leftBarText_new">Total(Rs.)</td>

										</tr>

<?

										$sql_od = "SELECT * FROM ".$cfg['DB_ORDER_ITEM']." WHERE `od_id` = '".$row['od_id']."'  ";

										$res_od = $heart->sql_query($sql_od);

										while($row_od =	$heart->sql_fetchrow($res_od)){

?>

											<tr class="row2">

												<td width="60%" align="left" class="leftBarText_new">

													<?=$row_od['od_qty'].' X '.pd_name($row_od['pd_id'])?>&nbsp;(Product Code: <?=getproductdetails($row_od['pd_id'],'pd_code')?>)

												</td>

												<td width="10%" align="left">

													<img src="../<?=$cfg['PRODUCT_IMAGES']?><?=getproductdetails($row_od['pd_id'],'pd_image')?>"  width="70" align="top"/>                   

												</td>

												<td align="right"><?=currency_symbol().pd_price($row_od['pd_id'])?></td>

												<td align="right"><?=currency_symbol().pd_price($row_od['pd_id']) * $row_od['od_qty']?></td>

											</tr>

<? 

										}

?>

										<tr class="row2">

											<td colspan="3" align="right" class="leftBarText_new">Sub-total</td>

											<td align="right"><?=currency_symbol().subTotal($row['od_id'])?></td>

										</tr>

										<tr class="row2">

											<td colspan="3" align="right" valign="top" class="leftBarText_new">Shipping</td>

<? 

											$subtotal=subTotal($row['od_id']);

											$shopConfig['free_shipping_limit'];

											$shippingCost = ($subtotal>=$shopConfig['free_shipping_limit'])?'0':$shopConfig['shippingCost']; ?>

											<td align="right" valign="top">

												<?=($shippingCost==0)?'- FREE -':displayFrontAmount($shopConfig['shippingCost'])?>

											</td>

										</tr>

										<tr class="row2">

											<td colspan="3" align="right" class="leftBarText_new">Total</td>

											<td align="right"><?=currency_symbol().  ($subtotal + $shippingCost)?></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Customer Information </td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td width="29%" align="left" class="row1">

												<span class="leftBarText_new">Email Address </span>

											</td>

											<td width="71%" colspan="2" align="left" class="row2"><?=$email?></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Shipping Information </td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Delivery Date</span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['od_delivery_date']?></td>

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

											</td><?

											$sql_od1 = "SELECT location.name,

															  location.id,

															  orders.od_shipping_city,

															  orders.od_id 

													   FROM ".$cfg['DB_ORDER']." orders 

													   INNER JOIN ".$cfg['DB_LOCATION']." location

													   ON location.id = orders.od_shipping_city

													   WHERE orders.od_id = '".$row['od_id']."'";

											$res_od1 = $heart->sql_query($sql_od1);

											$row_od1 = $heart->sql_fetchrow($res_od1);

											?>

											<td colspan="2" align="left" valign="top" class="row2">

												<?php /*?><?=$row['od_shipping_city']?><?php */?>

												<?=$row_od1['name']?>

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

											</td><?

											$sql_od2 = "SELECT country.country_name,

															   country.country_id,

															   orders.od_shipping_country,

															   orders.od_id 

													   FROM ".$cfg['DB_ORDER']." orders 

													   INNER JOIN ".$cfg['DB_COUNTRY_MASTER']." country

													   ON country.country_id = orders.od_shipping_country

													   WHERE orders.od_id = '".$row['od_id']."'";

											$res_od2 = $heart->sql_query($sql_od2);

											$row_od2 = $heart->sql_fetchrow($res_od2);

											?>

											<td colspan="2" align="left" valign="top" class="row2">

												<?=$row_od2['country_name']?>

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

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Assign Orders </td>

										</tr>

									</thead>

									<tbody>

									<form action="assign_order_process.php" method="post" name="frm1" id="frm1">

									<input type="hidden" name="act" value="assign_vendor_edit">

									<input type="hidden" name="order_id" value="<?=$row['od_id']?>">

										<tr>

											<td width="29%" align="left" class="row1">

												<span class="leftBarText_new">Select Vendor </span>

											</td>

											<td width="71%" colspan="2" align="left" class="row2">

											<?

											$sql_vendor = "SELECT vendor.vendor_name, 

																	   vendor.id, 

																	   vendor.state, 

																	   vendor.status,

																	   assign.order_id,

																	   assign.notes,

																	   orders.od_shipping_city,

																	   orders.od_id

																FROM  ".$cfg['DB_VENDOR']." vendor

																INNER JOIN  ".$cfg['DB_ORDER']." orders 

																ON vendor.city = orders.od_shipping_city

																INNER JOIN  ".$cfg['DB_ASSIGN_VENDORS']." assign 

																ON orders.od_id = assign.order_id

															WHERE vendor.status = 'A'

														 AND orders.od_id = '".$_REQUEST['id']."'

														 ORDER BY vendor.id DESC";

											$res_vendor = $heart->sql_query($sql_vendor);

											$maxrow_vendor = $heart->sql_numrows($res_vendor);

											?>

											<select name="select_vendor">

											<option value="">--Select Vendor--</option>

											<?

											if($maxrow_vendor > 0)

											{

												while($row_vendor = $heart->sql_fetchrow($res_vendor))

													{	

											?>

														<option value="<?=$row_vendor['id']?>"  <? if($row_vendor['order_id'] == $row['od_id']) {?> selected="selected" <? }?>><?=$row_vendor['vendor_name']?></option>

											<?

													}

											}

											?>

											</select>

											</td>

										</tr>

										<tr>

											<td align="left" class="row1" valign="top">

												<span class="leftBarText_new">Notes</span>

											</td>

											<?

											$sql_assgn = "SELECT vendor.vendor_name, 

																	   vendor.id, 

																	   vendor.state, 

																	   vendor.status,

																	   assign.order_id,

																	   assign.notes,

																	   orders.od_shipping_city,

																	   orders.od_id

																FROM  ".$cfg['DB_VENDOR']." vendor

																INNER JOIN  ".$cfg['DB_ORDER']." orders 

																ON vendor.city = orders.od_shipping_city

																INNER JOIN  ".$cfg['DB_ASSIGN_VENDORS']." assign 

																ON orders.od_id = assign.order_id

															WHERE vendor.status = 'A'  

														 AND orders.od_id = '".$_REQUEST['id']."'

														 ORDER BY vendor.id DESC";

											$res_assgn = $heart->sql_query($sql_assgn);

											$row_assgn = $heart->sql_fetchrow($res_assgn);

											?>

											<td colspan="2" align="left" class="row2">

											<textarea name="notes"><?=$row_assgn['notes']?></textarea>

											</td>

										</tr>

										<tr>

											<td colspan="3" align="center" >

												<a href="../webmaster/assign_order.php" style="color:#FFFFFF; font-weight:bold; text-decoration:none;">

													&lt;&lt;&nbsp;Back

												</a>

											&nbsp;

												<input type="submit" name="save" value="Assigned" class="loginbttn">

											</td>

										</tr>

										</form>

									</tbody>

								</table>

<? 

							}

							

							//======================================  VIEW RECORD ========================================//

							

							if($show=='view')

							{

								$orderId	=	$_REQUEST['id'];	

								$c_Id 		= 	$_REQUEST['c_id'];

								$sql		=	"SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_id` = '".$orderId."'  ";

								$res		=	$heart->sql_query($sql);

								$row		=	$heart->sql_fetchrow($res);

								if($_REQUEST['eid']!='')

								{

									$email = $_REQUEST['eid'];

								}

								if($_REQUEST['eid']=='')

								{

									$email = $row['od_shipping_email'];

								}

								

?>								<div id="printSalesList1">

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Order Details Section </td>

							            </tr>

									</thead>

									<tbody>

										<tr class="row1">

											<td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>

										</tr>

										<tr class="row2">

											<td align="left" class="leftBarText_new">Order From </td>

											<td colspan="2" align="left"><?=ucwords(getSiteName($row['siteId']))?></td>

										</tr>

										<tr class="row1">

											<td width="23%" align="left" class="leftBarText_new">Order Number</td>

											<td width="77%" colspan="2" align="left">

												<?=$row['or_pattern']?>&nbsp;&nbsp;( #<?=$row['od_id']?>)											</td>

										</tr>

										<tr class="row2">

											<td align="left" class="leftBarText_new">Order Date & Time</td>

											<td colspan="2" align="left"><?=date('d-m-Y H:i:s',strtotime($row['od_date']));?></td>

										</tr>

										<tr class="row1">

											<td align="left" valign="top" class="leftBarText_new">Last Update </td>

											<td colspan="2" align="left" valign="top"><?
											if($row['od_last_update']!='')
											{
												 echo date('d-m-Y H:i:s',strtotime($row['od_last_update']));
											}
											else
											{
												echo "----";
											}
											
											 ?></td>

										</tr>

										<tr class="row1">

												<td class="leftBarText_new" align="left">Delivary Status</td> 

												<td colspan="2" align="left" <? if($row['od_delivery_status']=='No'){?> class="notDelivered" <? } elseif($row['od_delivery_status']=='Attempted') {?> class="leftBarText" <? } else {?> class="delivered" <? }?>>

												 <?=$row['od_delivery_status']?>												

												</td>

										</tr>

										<? if($row['od_delivery_status']=='Yes')

										{ 

										?>

											<a style="text-decoration:none;" class="delivered" id="delivery">Delivered</a>

										<?

										}

										elseif($row['od_delivery_status']=='Attempted')

										{

										?>

										<tr class="row2">

										<td class="leftBarText_new" align="left">Reason</td>

										<td colspan="2" align="left"><?=$row['od_delivery_faild_reason']?></td>

										</tr>

										<?

										}

										else

										{

										?>

										<tr class="row2">

										<td class="leftBarText_new" align="left">Reason</td>

										<td colspan="2" align="left"><?=$row['od_delivery_faild_reason']?></td>

										</tr>

										<?

										}

										?>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="4" align="left" class="style2">&nbsp;Order Item </td>

										</tr>

									</thead>

									<tbody>

										<tr class="row1">

											<td align="left" class="leftBarText_new">Item</td>

											<td align="left" class="leftBarText_new">Image</td>

											<td width="17%" align="right" class="leftBarText_new">Unit Price(Rs.)</td>

											<td width="18%" align="right" class="leftBarText_new">Total(Rs.)</td>

										</tr>

<?

										$sql_od = "SELECT order_item.od_id, 

														  order_item.pd_id, 

														  order_item.od_qty,

														  avail.price,

														  avail.product_id,

														  avail.vendor_id

												   FROM ".$cfg['DB_ORDER_ITEM']." order_item 

												   INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail

												   ON avail.product_id = order_item.pd_id

												   WHERE order_item.od_id = '".$_REQUEST['id']."'

												   AND avail.vendor_id = '".$_REQUEST['vendor_id']."'";

										$res_od = $heart->sql_query($sql_od);

										while($row_od =	$heart->sql_fetchrow($res_od)){

?>

											<tr class="row2">

												<td width="60%" align="left" class="leftBarText_new">

													<?=$row_od['od_qty'].' X '.pd_name($row_od['pd_id'])?>&nbsp;(Product Code: <?=getproductdetails($row_od['pd_id'],'pd_code')?>)												

												</td>

												<td width="10%" align="left">

													<img src="../<?=$cfg['PRODUCT_IMAGES']?><?=getproductdetails($row_od['pd_id'],'pd_image')?>"  width="70" align="top"/>                   

												</td>

												<td align="right"><?=currency_symbol().$row_od['price']?></td>

												<td align="right"><?=currency_symbol()." ".$row_od['price'] * $row_od['od_qty']?></td>

											</tr>

<? 

										}

										$grand_total = total($row['od_id'], $_REQUEST['vendor_id']);

?>

											<tr class="row2">

											<td colspan="3" align="right" class="leftBarText_new">Delivery Charges</td>

											<?

												$sql_delivery = "SELECT assign.delivery_charges

																 FROM ".$cfg['DB_ASSIGN_VENDORS']."assign

																 INNER JOIN ".$cfg['DB_ORDER']." orders

																 ON assign.order_id = orders.od_id

																 WHERE assign.vendor_id = '".$_REQUEST['vendor_id']."'
																 ORDER BY `id` DESC";

												$res_delivery = $heart->sql_query($sql_delivery);

												$row_delivery = $heart->sql_fetchrow($res_delivery);
												//$row_delivery = mysql_fetch_row($res_delivery);
												//print_r($row_delivery);

											?>

											<td align="right" valign="top">
											<?
											// while($row_delivery =	$heart->sql_fetchrow($res_delivery)){
											// 	echo $row_delivery['delivery_charges'];
											// }
											?>	
											<?=$row_delivery['delivery_charges']?>

											</td>

										</tr>

										<tr class="row2">

											<td colspan="3" align="right" class="leftBarText_new">Total</td>

											<? $delivery_charges = $row_delivery['delivery_charges'];?>

											<td align="right"><?=currency_symbol()." ".($grand_total + $delivery_charges)?></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Customer Information </td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td width="29%" align="left" class="row1">

												<span class="leftBarText_new">Email Address </span>

											</td>

											<td width="71%" colspan="2" align="left" class="row2"><?=$email?></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Shipping Information </td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Delivery Date</span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['od_delivery_date']?></td>

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

											<?

											$sql_od1 = "SELECT location.name,

															  location.id,

															  orders.od_shipping_city,

															  orders.od_id 

													   FROM ".$cfg['DB_ORDER']." orders 

													   INNER JOIN ".$cfg['DB_LOCATION']." location

													   ON location.id = orders.od_shipping_city

													   WHERE orders.od_id = '".$row['od_id']."'";

											$res_od1 = $heart->sql_query($sql_od1);

											$row_od1 = $heart->sql_fetchrow($res_od1);

											?>

											<td colspan="2" align="left" valign="top" class="row2">

												<?php /*?><?=$row['od_shipping_city']?><?php */?>

												<?=$row['od_payment_city']?>

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

										<?

											$sql_od2 = "SELECT country.country_name,

															   country.country_id,

															   orders.od_shipping_country,

															   orders.od_id 

													   FROM ".$cfg['DB_ORDER']." orders 

													   INNER JOIN ".$cfg['DB_COUNTRY_MASTER']." country

													   ON country.country_id = orders.od_shipping_country

													   WHERE orders.od_id = '".$row['od_id']."'";

											$res_od2 = $heart->sql_query($sql_od2);

											$row_od2 = $heart->sql_fetchrow($res_od2);

											?>

											<td align="left" valign="top" class="row1">

												<span class="leftBarText_new">Country</span> 

											</td>

											<td colspan="2" align="left" valign="top" class="row2">

												<?=$row['od_shipping_country']?>

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

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Delivery Time </span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['delivery_time']?></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								</div>

								

								

								

								

								<div id="printSalesList" style="display:none;">

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="1">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Order Details Section </td>

							            </tr>

									</thead>

									<tbody>

										<tr class="row1">

											<td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>

										</tr>

										<tr class="row2">

											<td align="left" class="leftBarText_new">Order From </td>

											<td colspan="2" align="left"><?=ucwords(getSiteName($row['siteId']))?></td>

										</tr>

										<tr class="row1">

											<td width="23%" align="left" class="leftBarText_new">Order Number</td>

											<td width="77%" colspan="2" align="left">

												<?=$row['or_pattern']?>&nbsp;&nbsp;( #<?=$row['od_id']?>)											</td>

										</tr>

										<tr class="row2">

											<td align="left" class="leftBarText_new">Order Date & Time</td>

											<td colspan="2" align="left"><?=date('d-m-Y H:i:s',strtotime($row['od_date']));?></td>

										</tr>

										<tr class="row1">

											<td align="left" valign="top" class="leftBarText_new">Last Update </td>

											<td colspan="2" align="left" valign="top"><?=date('d-m-Y H:i:s',strtotime($row['od_last_update']));?></td>

										</tr>

										<tr class="row1">

												<td class="leftBarText_new" align="left">Delivary Status</td> 

												<td colspan="2" align="left" <? if($row['od_delivery_status']=='No'){?> class="notDelivered" <? } elseif($row['od_delivery_status']=='Attempted') {?> class="leftBarText" <? } else {?> class="delivered" <? }?>>

												 <?=$row['od_delivery_status']?>												

												</td>

										</tr>

										<? if($row['od_delivery_status']=='Yes')

										{ 

										?>

											<a style="text-decoration:none;" class="delivered" id="delivery">Delivered</a>

										<?

										}

										elseif($row['od_delivery_status']=='Attempted')

										{

										?>

											<tr class="row2">

											<td class="leftBarText_new" align="left">Reason</td>

											<td colspan="2" align="left"><?=$row['od_delivery_faild_reason']?></td>

											</tr>

										<?

										}

										else

										{

										?>

											<tr class="row2">

											<td class="leftBarText_new" align="left">Reason</td>

											<td colspan="2" align="left"><?=$row['od_delivery_faild_reason']?></td>

											</tr>

										<?

										}

										?>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="1">

									<thead>

										<tr>

											<td colspan="4" align="left" class="style2">&nbsp;Order Item </td>

										</tr>

									</thead>

									<tbody>

										<tr class="row1">

											<td align="left" class="leftBarText_new">Item</td>

											<td align="left" class="leftBarText_new">Image</td>

										</tr>

<?

										$sql_od = "SELECT order_item.od_id, 

														  order_item.pd_id, 

														  order_item.od_qty,

														  avail.price,

														  avail.product_id,

														  avail.vendor_id

												   FROM ".$cfg['DB_ORDER_ITEM']." order_item 

												   INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail

												   ON avail.product_id = order_item.pd_id

												   WHERE order_item.od_id = '".$_REQUEST['id']."'

												   AND avail.vendor_id = '".$_REQUEST['vendor_id']."'";

										$res_od = $heart->sql_query($sql_od);

										while($row_od =	$heart->sql_fetchrow($res_od))

										{

?>

											<tr class="row2">

												<td width="60%" align="left" class="leftBarText_new">

													<?=$row_od['od_qty'].' X '.pd_name($row_od['pd_id'])?>&nbsp;(Product Code: <?=getproductdetails($row_od['pd_id'],'pd_code')?>)												

												</td>

												<td width="10%" align="left">

													<img src="../<?=$cfg['PRODUCT_IMAGES']?><?=getproductdetails($row_od['pd_id'],'pd_image')?>"  width="150" height="150" align="top"/>                   

												</td>

											</tr>

<? 

										}

										$grand_total = total($row['od_id'], $_REQUEST['vendor_id']);

?>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="1">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Customer Information </td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td width="29%" align="left" class="row1">

												<span class="leftBarText_new">Email Address </span>

											</td>

											<td width="71%" colspan="2" align="left" class="row2"><?=$email?></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								<br/>

								<table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="1">

									<thead>

										<tr>

											<td colspan="3" align="left" class="style2">&nbsp;Shipping Information </td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Delivery Date</span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['od_delivery_date']?></td>

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

												<span class="leftBarText_new">Landmark </span>

											</td>

											<td colspan="2" align="left" valign="top" class="row2"><?=$row['od_shipping_landmark']?></td>

										</tr>

										<tr>

											<td align="left" valign="top" class="row1">

												<span class="leftBarText_new">City</span> 

											</td>

											<td colspan="2" align="left" valign="top" class="row2">

												<?=$row['od_payment_city']?>

											</td>

										</tr>

										<tr>

											<td align="left" class="row1">

												<span class="leftBarText_new">State</span>

											</td>

											<td colspan="2" align="left" class="row2">

												<?=$row['od_shipping_state']?>

											</td>

										</tr>

										<tr>

										<?

											$sql_od2 = "SELECT country.country_name,

															   country.country_id,

															   orders.od_shipping_country,

															   orders.od_id 

													   FROM ".$cfg['DB_ORDER']." orders 

													   INNER JOIN ".$cfg['DB_COUNTRY_MASTER']." country

													   ON country.country_id = orders.od_shipping_country

													   WHERE orders.od_id = '".$row['od_id']."'"; 

											$res_od2 = $heart->sql_query($sql_od2);

											$row_od2 = $heart->sql_fetchrow($res_od2);

										?>

											<td align="left" valign="top" class="row1">

												<span class="leftBarText_new">Country</span> 

											</td>

											<td colspan="2" align="left" valign="top" class="row2">

												<?=$row['od_shipping_country']?>

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

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Order Type</span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['od_type']?></td>

										</tr>

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Order Acknowledgement</span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['od_acknowledgement']?></td>

										</tr>

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Order Payment Mode</span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['od_payment_mode']?></td>

										</tr>

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Order Shipping Type</span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['od_shipping_type']?></td>

										</tr>

										<tr>

											<td class="row1" align="left">

												<span class="leftBarText_new">Delivery Time </span> 

											</td>

											<td colspan="2" align="left" class="row2"><?=$row['delivery_time']?></td>

										</tr>

										<tr>

											<td colspan="3" align="center" >&nbsp;</td>

										</tr>

									</tbody>

								</table>

								</div>

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