<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
page_header($cfg['ADMIN_TITLE']." - Order Management");
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];
$orderstat =($_REQUEST['status']!="")?$_REQUEST['status']:'';
?>
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="js/order.js"></script>

<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="<?=$cfg['base_url']?>calender/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="<?=$cfg['base_url']?>calender/jsDatePick.min.1.3.js"></script>
<style type="text/css">
	.style3 {color: #FFFFFF}
</style>
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
			<td width="25%" rowspan="2" colspan="3" align="center" valign="top">
				<br /><br />
				<?php include_once("left_bar.php");?>
			</td>
		</tr>
		<tr>
			<td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>
			<td align="left" valign="top" width="99%">      
				<table style="background:url(images/welcome_head.jpg) center top no-repeat;" width="698" cellspacing="0" cellpadding="0" border="0" align="center">
					<tr height="35" >
						<td align="left" valign="middle">&nbsp;&nbsp;
							<span class="style1">Welcome
								<?=$_SESSION['admin_user_name']?>
							</span>
						</td>
						<td align="right" valign="middle">
							<a href="login.php?act=<?=md5("logout")?>">
								<img src="images/lock.png" title="Logout" width="24" height="24" border="0" style="vertical-align: middle;" />
							</a>&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
					<tr height="16">
						<td colspan="2" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" style="background-color:#eee8e8;" align="center">
						
<? 
							//======================================  SHOW ALL RECORDS ========================================//
							if($_REQUEST['show']==''){
								if(isset($_REQUEST['searchorder'])){
									
									$dd=($_REQUEST['orderdatehidden']!='')?date('Y-m-d',strtotime($_REQUEST['orderdatehidden'])):'';
									$start_date=$_REQUEST['stdate'];
									$end_date=$_REQUEST['endate'];
									
									$month=$_REQUEST['month'];
									$o_id=$_REQUEST['o_id'];
									$remarks=$_REQUEST['remarks'];
									$qry1='';
									$qry2='';
									$qry3='';
									$qry4='';
									$qry5='';
									if($start_date!='' && $end_date=='')
									{
										$qry5="AND DATE(`od_date`)>='".$start_date."'";
									}
									if($start_date=='' && $end_date!='')
									{
										$qry5="AND DATE(`od_date`)<='".$end_date."'";
									}
									if($start_date!='' && $end_date!='')
									{
										$qry5="AND DATE(`od_date`)BETWEEN '".$start_date."' AND '".$end_date."'";
									}
									
									if($dd!=''){
										$qry1="AND `od_delivery_date`='".$dd."'";
									}
									if($month!=''){
										$qry2="AND `od_date`LIKE '%-".$month."-%'";
									}
									if($o_id!=''){
										$qry3="AND `or_pattern`='".$o_id."'";
									}
									/*if($remarks!=''){
										$qry4="AND `od_shipping_remarks`LIKE '".$remarks."'";
									}*/
									if($_REQUEST['statushidden']==''){
										$odstat ="(`od_status`='Unpaid' OR `od_status`='Paid' OR `od_status`='Shipped' OR `od_status`='Completed' OR `od_status`='Cancelled' OR `od_status`='Dispute' OR `od_status`='Return' OR `od_status`='Refund')";
										$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE  $odstat $qry1 $qry2 $qry3 $qry4 $qry5 ORDER BY `od_id`";
									}
									else{
										$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status`='".$_REQUEST['statushidden']."' $qry1 $qry2 $qry3 $qry4 $qry5 ORDER BY `od_id`";
									}
								}
								else{  
									if($_REQUEST['status']!=''){
										$where.="  AND `od_status`='".$_REQUEST['status']."' ";
									}
									if($_REQUEST['date']!=''){
										$where.="  AND `od_date`='".$_REQUEST['date']."' ";
									}
									$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status`!= 'D' ORDER BY `od_id` desc";
								}
								
								//echo'<br>'.$sql;
								$res=$heart->sql_query($sql);
								$maxrow=$heart->sql_numrows($res);
								$sql = $sql. " LIMIT $offset,$limit";
								$res = $heart->sql_query($sql);
?>
								<div style="width:680px; height:500px; margin:0 auto;">
								<table width="95%" height="" align="center" cellpadding="4" cellspacing="1" class="tborder_new" style="overflow-x:auto; width:100%; height:100%; max-width:100%; display:block; white-space:nowrap;">
									<thead>
										<tr>
											<td colspan="6" align="left">&nbsp;<span class="style2">Order Section</span> </td>
											<td colspan="5" align="right">
												<select name="status" class="forminputelement" id="status" onchange="getOrderStatus(this.value)">
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
									<tbody>
										<tr class="row2">
											<td colspan="13" align="right" class="redbuttonelements"><?=@$msg?></td>
										</tr>
										<form name="frmsearch" method="post" action="order.php" id="frmsearch" onsubmit=" return searc();">
											<input type="hidden" name="statushidden" id="statushidden" value="<?=$orderstat?>" />
											<input type="hidden" name="orderdatehidden" id="orderdatehidden" value="" />
											<input type="hidden" name="stdate" id="stdate" value="" />
											<input type="hidden" name="endate" id="endate" value="" />
											<input type="hidden" name="act" value="searc" />
											<tr class="row1">
												<td colspan="3" align="center">
													<span class="leftBarText_new" >Order Id</span><br />
													<input type="text" name="o_id" value="<?=$o_id ?>" class="forminputelement" id="o_id" >
												</td>
												<td colspan="3" align="center">
													<span class="leftBarText_new" >Delivery Date</span><br />
													<input name="dd" type="text" class="forminputelement" id="dd" readonly="readonly" value="<?=$_REQUEST['orderdatehidden']?>" />
												</td>
												<td colspan="2" align="center">
													<span class="leftBarText_new" >From Date</span><br />
													<input type="text" name="start_date"  class="forminputelement" id="start_date" value="<?=$start_date;?>" >
												</td>
												<td colspan="2" align="center">
													<span class="leftBarText_new" >To Date</span><br />
													<input type="text" name="end_date"  class="forminputelement" id="end_date" value="<?=$end_date;?>" >
												</td>
												<!--<td colspan="3" align="center">-->
													<!--<span class="leftBarText_new" ><!--Remarks--></span><br />
													<!--<input type="hidden" name="remarks" value="<?//=$remarks ?>" class="forminputelement" id="remarks">-->
												<!--</td>-->
												<td colspan="2" align="center">
													<input  name="searchorder" type="submit" value="search" class="btnModify"  >
												</td>
											</tr>
										
											<tr class="headercontent">
												<td width="1%" align="center" class="leftBarText_new1">
													<input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/>
												</td>
												<td width="1%" align="center" class="leftBarText_new1">Sl No</td>                  
												<td width="5%" align="center" class="leftBarText_new1">Order Id</td>
												<td width="33%" align="center" class="leftBarText_new1">Customer Name </td>
												<td width="9%" align="center" class="leftBarText_new1">Amount</td>
												
												<td width="9%" align="center" class="leftBarText_new1">Shipping type</td>
												<td width="20%" align="center" class="leftBarText_new1">Delivery Date</td>
												<td width="4%" align="center" class="leftBarText_new1">Order Date &amp; Time </td>
												<td width="6%" align="center" class="leftBarText_new1">Payment Status</td>
												<td width="3%" align="center" class="leftBarText_new1">Pay Through</td>
												<td width="5%" align="center" class="leftBarText_new1">Delivery Status</td>
												<td width="10%" align="center" class="leftBarText_new1">Action</td>
											</tr>
<? 
											if($maxrow >0){
												while($row=$heart->sql_fetchrow($res)){
													@$i++;
													$c_id=$row['cust_id'];
?>
													<tr class="<?=($i%2==0)?'row1':'row2'?>">
														<td align="center" valign="top">
															<input  name="checkvalue" id="checkvalue"  value="<?=$row['od_id']?>" type="checkbox" />
														</td>
														<td align="center"><?=$i?></td>                  
														<td align="center"><?=$row['or_pattern']?> </td>
														<td align="center" class="linkTitle"><?=$row['od_payment_first_name'].' '.$row['od_payment_last_name']?></td>
														<td align="center"><?=$row['od_amount']?></td>
														
														<td align="center"><?=$row['od_shipping_type']?></td>
														<td align="center"><?=date('d-m-Y ',strtotime($row['od_delivery_date']));?></td>
														<td align="center"><?=$row['od_date'] // date('d-m-Y ',strtotime($row['od_date']));?></td>
														<td align="center"><?=$row['od_status']?></td>
														<td align="center"><?=$row['received_option']?></td>
														<td align="center">
															<? if($row['od_delivery_status']=='Yes'){ echo 'Delivered';} elseif($row['od_delivery_status']=='Attempted'){ echo 'Attempted';}else{ echo 'Not Delivered';}?>
														</td>
														<td align="center">
															<?
															if($row['od_status']!='Cancelled')
															{
															?>
																<a href="order_process.php?act=view&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>">
																	<img src="images/view.gif" title="View" width="16" height="16" border="0" />
																</a>
															<?
															}
															?>
															
															<a href="order_process.php?act=delorder&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>&status=<?=$_REQUEST['status']?>&date=<?=$_REQUEST['date']?>">
																<img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" />
															</a>				  
														</td>
													</tr>
<? 
												}
											}
										
											else {
?>
												<tr class="row2">
													<td colspan="10" align="center" class="msg">No Record.</td>
												</tr>
<? 
											}
?>
											<tr >
												<td colspan="7" align="left" class="redbuttonelements">
<? 
													if($_REQUEST['main']!=''){
?>
														<a style="color:#FFFFFF;" href="product.php?category=<?=$_REQUEST['category']?>&pageno=<?=$_REQUEST['page']?>" class="back">&lt;&lt;back</a>
<? 
													} 
?>
													&nbsp;
<?  
													if($maxrow >0){ 
?>
														<select name="dropdown1" class="forminputelement">
															<option value="">Choose an action... </option>
															<option value="delete">Delete</option>
														</select>
														<input value="Apply to selected"  name="submit" type="button" onclick="return validation('<?=$category?>','<?=$pageno?>');" class="loginbttn"/>
<? 
													} 
?>
												</td>
												<td colspan="3" align="right" class="redbuttonelements" >
													<?php /*?><a href="order.php?show=add" style="color:#FFFFFF;">Add New Order</a><?php */?>											
												</td>
											</tr>
										</form>

									</tbody>
								</table>
								</div>
								<div style="width:95%; text-align:right;">
									<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
								</div>
<? 
							}
							
							//======================================  ADD A RECORD ========================================//
		
							if($show=='add'){ 
?>
								<form name="frmadd" method="post" action="customer_process.php" id="frmadd" onsubmit="return add_cust_val()">
									<p>
										<input type="hidden" name="act" value="insert" />
										<input type="hidden" name="cust_add_valid" value=""  id="cust_add_valid"/>
									</p>
									<table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
										<thead> 
											<tr> 
												<td colspan="5" align="left" class="style2">&nbsp;Add Billing Details </td> 
											</tr> 
										</thead> 
										<tbody> 
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Salutation</span><span class="style3">*</span> 
												</td> 
												<td width="70%" colspan="4" align="left">
													<select class="forminputelement" name="bill_salutation_add" id="bill_salutation_add">
														<option>Mr</option>
														<option>Ms</option>
														<option>Mrs</option>
														<option>Dr</option>
													</select>
												</td>
											</tr> 
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">First Name</span><span class="style3">*</span> 
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="bill_fname_add" type="text" class="forminputelement" id="bill_fname_add" />
												</td>
											</tr> 
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Last Name</span><span class="style3">*</span> 
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="bill_lname_add" type="text" class="forminputelement" id="bill_lname_add" />
												</td>
											</tr> 
											<tr class="row2"> 
											<td width="30%" align="left" class="leftBarText">
												<span class="leftBarText_new">Address</span> <span class="style3">*</span>
											</td> 
											<td width="70%" colspan="4" align="left">
												<input name="bill_addr_add" type="text" class="forminputelement" id="bill_addr_add" />
											</td>
											</tr>
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Phone No</span> <span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="bill_phone_add" type="text" class="forminputelement" id="bill_phone_add" onkeyup="check_phone(this.id);"/>
													<span style="display:none;" id="bill_phone_add1">
														<img src="images/cross_circle.png" width="16" align="absmiddle" />&nbsp;Phone number should be numeric
													</span>
												</td>
											</tr>
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Country</span> <span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<select name="bill_country_add" id="bill_country_add" class="forminputelement" >
														<option value="">Select Country</option>
<?
														$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']."";
														$res_cname=$heart->sql_query($sql_cname);
														while($row_cname=$heart->sql_fetchrow($res_cname)){
?>
															<option value="<?=$row_cname['country_name']?>" ><?=$row_cname['country_name']?></option>	
<? 
														} 
?>						
													</select>
												</td>
											</tr>
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">State</span> <span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<div id="bill_state">
														<input type="text" name="bill_state_add" id="bill_state_add" class="forminputelement" >
													</div>
												</td>
											</tr>
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">City</span> <span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<div id="bill_city">
														<input type="text" name="bill_city_add" id="bill_city_add" class="forminputelement" >					
													</div>
												</td>
											</tr>
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Pincode</span> <span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="bill_pin_add" type="text" class="forminputelement" id="bill_pin_add" />
												</td>
											</tr>
										</tbody> 
									</table> 
									<br/>
									<table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
										<thead> 
											<tr> 
												<td colspan="2" align="left" class="style2">&nbsp;Add Shipping Details </td> 
												<td colspan="3" align="right" class="style2">
													&nbsp;<input name="shipp_details" id="shipp_details" type="checkbox" value="yes" onclick="fill_same();" />Same as billing details
												</td> 
											</tr> 
										</thead> 
										<tbody> 
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Salutation</span><span class="style3">*</span> </td> 
												<td width="70%" colspan="4" align="left">
													<select class="forminputelement" name="shipp_salutation_add" id="shipp_salutation_add">
														<option>Mr</option>
														<option>Ms</option>
														<option>Mrs</option>
														<option>Dr</option>
													</select>
												</td>
											</tr> 
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">First Name</span><span class="style3">*</span> </td> 
												<td width="70%" colspan="4" align="left">
													<input name="shipp_fname_add" type="text" class="forminputelement" id="shipp_fname_add" />
												</td>
											</tr> 
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Last Name</span><span class="style3">*</span> </td> 
												<td width="70%" colspan="4" align="left"><input name="shipp_lname_add" type="text" class="forminputelement" id="shipp_lname_add" /></td>
											</tr> 
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Address</span> <span class="style3">*</span></td> 
												<td width="70%" colspan="4" align="left">
													<input name="shipp_addr_add" type="text" class="forminputelement" id="shipp_addr_add" />
												</td>
											</tr>
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Phone No</span> 
													<span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="shipp_phone_add" type="text" class="forminputelement" id="shipp_phone_add" onkeyup="check_phone(this.id);"/>
													<span style="display:none;" id="shipp_phone_add1">
													<img src="images/cross_circle.png" width="16" align="absmiddle" />&nbsp;Phone number should be numeric</span>
												</td>
											</tr>
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Country</span> 
													<span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<select name="shipp_country_add" id="shipp_country_add" class="forminputelement" >
														<option value="">Select Country</option>
<?
														$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']."";
														$res_cname=$heart->sql_query($sql_cname);
															while($row_cname=$heart->sql_fetchrow($res_cname)){
?>
																<option value="<?=$row_cname['country_name']?>" ><?=$row_cname['country_name']?></option>	
<? 
															} 
?>						
													</select>
												</td>
											</tr>
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">State</span> 
													<span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<div id="shipp_state">
														<input type="text" name="shipp_state_add" id="shipp_state_add" class="forminputelement" >
													</div>
												</td>
											</tr>
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">City</span> 
													<span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<div id="shipp_city">
														<input type="text" name="shipp_city_add" id="shipp_city_add" class="forminputelement" >					
													</div>
												</td>
											</tr>
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Pincode</span> 
													<span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="shipp_pin_add" type="text" class="forminputelement" id="shipp_pin_add" />
												</td>
											</tr>
											<tr> 
												<td align="right">
													<a href="customer.php" class="back">&lt;&lt;back</a>
												</td> 
												<td colspan="4" align="left">
													<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">&nbsp;
												</td> 
											</tr> 
										</tbody> 
									</table> 
									<br/>
									<table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
										<thead> 
											<tr> 
												<td colspan="5" align="left" class="style2">&nbsp;Add Order Details </td> 
											</tr> 
										</thead> 
										<tbody> 
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Salutation</span><span class="style3">*</span> 
												</td> 
												<td width="70%" colspan="4" align="left">
													<select class="forminputelement" name="bill_salutation_add" id="bill_salutation_add">
														<option>Mr</option>
														<option>Ms</option>
														<option>Mrs</option>
														<option>Dr</option>
													</select>
												</td>
											</tr> 
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">First Name</span><span class="style3">*</span> 
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="bill_fname_add" type="text" class="forminputelement" id="bill_fname_add" />
												</td>
											</tr> 
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Last Name</span><span class="style3">*</span> 
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="bill_lname_add" type="text" class="forminputelement" id="bill_lname_add" />
												</td>
											</tr> 
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Address</span> <span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="bill_addr_add" type="text" class="forminputelement" id="bill_addr_add" />
												</td>
											</tr>
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Phone No</span> <span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="bill_phone_add" type="text" class="forminputelement" id="bill_phone_add" onkeyup="check_phone(this.id);"/>
													<span style="display:none;" id="bill_phone_add1">
														<img src="images/cross_circle.png" width="16" align="absmiddle" />&nbsp;Phone number should be numeric
													</span>
												</td>
											</tr>
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Country</span> <span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<select name="bill_country_add" id="bill_country_add" class="forminputelement" >
														<option value="">Select Country</option>
<?
														$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']."";
														$res_cname=$heart->sql_query($sql_cname);
														while($row_cname=$heart->sql_fetchrow($res_cname)){
?>
															<option value="<?=$row_cname['country_name']?>" ><?=$row_cname['country_name']?></option>	
<? 
														}
?>						
													</select>
												</td>
											</tr>
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">State</span><span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<div id="bill_state">
														<input type="text" name="bill_state_add" id="bill_state_add" class="forminputelement" >
													</div>
												</td>
											</tr>
											<tr class="row2"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">City</span><span class="style3">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<div id="bill_city">
														<input type="text" name="bill_city_add" id="bill_city_add" class="forminputelement" >					
													</div>
												</td>
											</tr>
											<tr class="row1"> 
												<td width="30%" align="left" class="leftBarText">
													<span class="leftBarText_new">Pincode</span> <span class="redstar">*</span>
												</td> 
												<td width="70%" colspan="4" align="left">
													<input name="bill_pin_add" type="text" class="forminputelement" id="bill_pin_add" />
												</td>
											</tr>
										</tbody> 
									</table> 
								</form>
<? 
							}
							
							//======================================  VIEW RECORD ========================================//
							
							if($show=='view'){
								$orderId = $_REQUEST['id'];	
								$c_Id = $_REQUEST['c_id'];
								$sql="SELECT * 
										FROM ".$cfg['DB_ORDER']." 
									   WHERE  `od_id` = '".$orderId."'  ";
								$res=$heart->sql_query($sql);
								$row=$heart->sql_fetchrow($res);
								if($_REQUEST['eid']!=''){
									$email = $_REQUEST['eid'];
								}
								if($_REQUEST['eid']==''){
									$email = $row['od_shipping_email'];
								}
?>
								<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
									<thead>
										<tr>
											<td colspan="2" align="left" class="style2">&nbsp;Order Details Section </td>
											<td align="right" class="style2">&nbsp;<a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="orderPrint.php?show=view&id=<?=$orderId?>">Print</a></td>
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
											<td align="left" class="leftBarText_new">Order Date and Time</td>
											<td colspan="2" align="left"><?=$row['od_date']//date('d-m-Y',strtotime($row['od_date']));?>
												<input name="delivery_time" id="delivery_time" type="hidden" value="<?=$row['od_delivery_date'];?>" />
											</td>
										</tr>
										<tr class="row1">
											<td align="left" valign="top" class="leftBarText_new">Last Update </td>
											<td colspan="2" align="left" valign="top"><?=($row['od_last_update'])!=''?date('d-m-Y ',strtotime($row['od_last_update'])):'Not Yet Updated'?></td>
										</tr>
										<form action="" method="post" name="frmOrder" id="frmOrder">
											<tr class="row2">
												<td class="leftBarText_new" align="left">Status</td>
												<td colspan="2" align="left">
													<? $status = $row['od_status'];?>
													<select name="status" class="forminputelement" id="status">
														<option value="Unpaid" <?=($status=='Unpaid')?'selected="selected"':''?>>Unpaid</option>
														<option value="Paid" <?=($status=='Paid')?'selected="selected"':''?>>Paid</option>
														<option value="Shipped" <?=($status=='Shipped')?'selected="selected"':''?>>Shipped</option>
														<option value="Completed" <?=($status=='Completed')?'selected="selected"':''?>>Completed</option>
														<option value="Cancelled" <?=($status=='Cancelled')?'selected="selected"':''?>>Cancelled</option>
														<option value="Dispute" <?=($status=='Dispute')?'selected="selected"':''?>>Dispute</option>
														<option value="Return" <?=($status=='Return')?'selected="selected"':''?>>Return</option>
														<option value="Refund" <?=($status=='Refund')?'selected="selected"':''?>>Refund</option>
													</select>                      
												</td>
											</tr>
											<tr class="row1">
												<td class="leftBarText_new" align="left">Delivery Status</td> 
												<td colspan="2" align="left">
													<? $status = $row['od_shipping_type'];?>
													<select name="status3" class="forminputelement" id="status3" onchange="delivered_by_form_view(this.id)">
														<option value="normal" <?=($status=='normal')?'selected="selected"':''?>>Normal</option>
														<option value="mid_night" <?=($status=='mid_night')?'selected="selected"':''?>>Midnight</option>
														<option value="fixed" <?=($status=='fixed')?'selected="selected"':''?>>Fixed time</option>
													</select>				    
												</td>
											</tr>	
											<tr class="row2">

												<td class="leftBarText_new" align="left">Shipping Status</td> 

												<td colspan="2" align="left">	
												
												<? $status = $row['od_delivery_status'];?>

													<select name="status2" class="forminputelement" id="status2" onchange="delivered_by_form_view(this.id)">

														<option value="No" <?=($status=='No')?'selected="selected"':''?>>Not Delivered</option>

														<option value="Yes" <?=($status=='Yes')?'selected="selected"':''?>>Delivered</option>

														<option value="Attempted" <?=($status=='Attempted')?'selected="selected"':''?>>Attempted</option>

													</select>				    

												</td>
											</tr>
											<tr class="row2">
												<td colspan="3" style="padding:0px; margin:0px;">
													<div id="delivered_by_place_holder" style="display:none;">
														<table width="100%" border="0"  cellpadding="6" cellspacing="1">
															<tr>
																<td width="23%" class="leftBarText_new" align="left">Delivered By</td>
																<td colspan="2" align="left">
																	<input type="text" class="forminputelement" name="del_by" id="del_by" value="<?=$row['od_delivered_by']?>">
																</td>
															</tr>
														</table>
													</div>
													<div id="feedback_place_holder" style="display:none;">
														<table width="100%" border="0" cellpadding="6" cellspacing="1">
															<tr>
																<td width="23%" class="leftBarText_new" align="left">Feedback</td>
																<td colspan="2" align="left">
																	<input type="text" class="forminputelement"  name="fed_by" id="fed_by" value="<?=$row['od_feedback']?>">
																</td>
															</tr>
														</table>
													</div>
												</td> 
											</tr>
											<tr class="row2">
												<td class="leftBarText_new" align="left">Received By</td>
												<td colspan="2" align="left">
													<input type="text" class="forminputelement" name="rec_by" id="rec_by" value="<?=$row['od_received_by']?>">
												</td>
											</tr>
											<tr class="row2">
												<td class="leftBarText_new" align="left">Amount Received Through</td>
												<td colspan="2" align="left">
													<?php if($row['received_option']==''){?>
													<select id="receive_through" name="receive_through" class="forminputelement">
														<option value="">--select option--</option>
														<option value="cash">Cash</option>
														<option value="paypal">Paypal</option>
														<option value="ebs">EBS</option>																												<option value="payumoney">PayUmoney</option>
														<option value="bank deposit">Bank Deposit</option>
														<option value="shop received">Shop Received</option>
														<option value="paytm">Paytm</option>
														<option value="mobikwik">Mobikwik</option>
														<option value="ft cash">FT Cash</option>
														<option value="Google Pay">Google Pay</option>
														<option value="Phone Pay">Phone Pay</option>
													</select>
													<?php }else{?>
													<input type="hidden" name="receive_through" id="receive_through" value="<?=$row['received_option'];?>" />	
													<?=$row['received_option'];?>
												<?php } ?>
												</td>
											</tr>
											<tr class="row2">
												<td colspan="3" align="center" > 
													<input type="hidden" value="<?=$c_Id?>" />
													<input class="brownbttn" name="btnModify" type="button" id="btnModify" value="Modify Status" class="btnModify" onClick="modifyOrderStatus(<?=$orderId?>,<?=$c_Id?>);">					
												</td>
											</tr>
										</form>
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
											<td align="left" class="leftBarText_new">SL.</td>
											<td align="left" class="leftBarText_new">Item</td>
											<td align="left" class="leftBarText_new">Image</td>
											<td width="17%" align="right" class="leftBarText_new">Unit Price(Rs.)</td>
											<td width="18%" align="right" class="leftBarText_new">Total(Rs.)</td>
										</tr>
<?
										$sql_od = "SELECT * FROM ".$cfg['DB_ORDER_ITEM']." WHERE `od_id` = '".$row['od_id']."'  ";
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
												<td align="right"><?=₹.pd_price($row_od['pd_id'])?></td>
												<td align="right"><?=₹.pd_price($row_od['pd_id']) * $row_od['od_qty']?></td>
											</tr>
<? 
										$count++;
										}
?>
										<tr class="row2">
											<td colspan="4" align="right" class="leftBarText_new">Sub-total</td>
											<td align="right"><?=₹.subTotal($row['od_id'])?></td>
										</tr>
										<tr class="row2">
											<td colspan="4" align="right" valign="top" class="leftBarText_new">Shipping</td>
<? 
											$subtotal=subTotal($row['od_id']);
											$shopConfig['free_shipping_limit'];
											//$shippingCost = ($subtotal>=$shopConfig['free_shipping_limit'])?'0':$shopConfig['shippingCost']; 
											$shippingCost = ($row['od_shipping_cost']=='0')?'0':$row['od_shipping_cost'];?>
											
											<td align="right" valign="top">
												<?=($shippingCost==0)?'- FREE -':₹.displayFrontAmount($shippingCost);?>
											</td>
										</tr>
										<tr class="row2">
											<td colspan="4" align="right" class="leftBarText_new">Total</td>
											<td align="right"><?=₹.($subtotal + $shippingCost)?></td>
										</tr>
										<tr>
											<td colspan="4" align="center" >&nbsp;</td>
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
									<?
										$sqlDeliveryDate="SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_id` = '".$orderId."'";
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
										<tr>
											<td colspan="3" align="center" >&nbsp;</td>
										</tr>
									</tbody>
								</table>
								<br/>
								<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
									<thead>
										<tr>
											<td colspan="3" align="left" class="style2">&nbsp;Billing Information </td>
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
										<tr>
											<td colspan="3" align="center" >
												<a href="order.php" style="color:#FFFFFF; font-weight:bold; text-decoration:none;">
													&lt;&lt;&nbsp;Back
												</a>
											</td>
										</tr>
									</tbody>
								</table>
<? 
							}
?>
						</td>
						</div>
					</tr>
					<tr height="16">
						<td colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="right"></td>
		</tr>
	</table>