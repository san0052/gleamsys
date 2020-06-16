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

alert(id);

var vendor_amount = document.getElementById("vendor_amount_"+id);

	if(vendor_amount.value == ""){
	alert("Please Provide Vendor Product Amount...!!");
	vendor_amount.focus();
	return false;
	}

}

 function openPopup1(id)
  {
  	$("#fade_form1").fadeIn("slow");
  	$("#pop_form1").slideDown("slow");
	document.getElementById("oid").value= id;
  }
  function closePopup1()
  {	$("#fade_form1").fadeOut("slow");
  	$("#pop_form1").slideUp("slow");
  }

function openPopup2(id)
  {
  	$("#fade_form2").fadeIn("slow");
  	$("#pop_form2").slideDown("slow");
	document.getElementById("oID").value= id;
  }
  function closePopup2()
  {	$("#fade_form2").fadeOut("slow");
  	$("#pop_form2").slideUp("slow");
  }
  function deliveredForm(id)
  { 
  	if(id=="deliveredForm")
  	{
  		$("#deliveredForm").fadeOut('slow');
  		document.getElementById("attemptedForm").style.display="none";
  		document.getElementById("notDeliveredForm").style.display="none";
  	}
  	else if(id=="attemptedForm")
  	{
  		document.getElementById("deliveredForm").style.display="none";
  		document.getElementById("notDeliveredForm").style.display="none";
  		$("#attemptedForm").slideDown('slow');
  		
  	}
  	else if(id=="notDeliveredForm")
  	{
  		document.getElementById("deliveredForm").style.display="none";
  		$("#notDeliveredForm").slideDown('slow');
  		document.getElementById("attemptedForm").style.display="none";
  	}
  	else
  	{
  		document.getElementById("attemptedForm").style.display="none";
  		document.getElementById("deliveredForm").style.display="none";
  		document.getElementById("notDeliveredForm").style.display="none";
  	}
  }


</script>
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
<td vAlign="top" align="center" width="99%">
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr height="34">
			<td width="25%" rowspan="2" colspan="3" align="center" valign="top">
				<br />
				<?php include_once("left_bar.php");?>
			</td>
		</tr>
		<tr>
			<td align="center" valign="middle"><img src="../vendor_webmaster/images/spacer.gif" width="1" height="550" /></td>
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
							<img src="images/printer_icon.png" title="Print" alt="Print" width="19" height="19" border="0" onClick="printContentSalesList('printSalesList',this.id)" style="float:right"/>
							<?
							}
							?>
						</td>
						<td width="56" align="right" valign="middle">
							<a href="../vendor_webmaster/login.php?act=<?=md5("logout")?>">
								<img src="../webmaster/images/lock.png" title="Logout" width="24" height="24" border="0" style="vertical-align: middle;" />
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
                	?>
			  <div id="printSalesList">
			  <form action="vendor_order.php" method="post">
              <table width="98%" height="212" align="center" cellpadding="4" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="5" align="left">&nbsp;<span class="style2">Orders From Vendors </span> </td>
                    <td colspan="2" align="right"><select name="status" class="forminputelement" id="status" onChange="getOrderStatus(this.value)">
                        <option value="" <?=($_REQUEST['status']=='' || $_REQUEST['statushidden']=='')?'selected="selected"':''?>>All</option>
                        <option value="Unpaid" <?=($_REQUEST['status']=='Unpaid' || $_REQUEST['statushidden']=='Unpaid')?'selected="selected"':''?>>Unpaid</option>
                        <option value="Paid" <?=($_REQUEST['status']=='Paid' || $_REQUEST['statushidden']=='Paid')?'selected="selected"':''?>>Paid</option>
                        <option value="Shipped" <?=($_REQUEST['status']=='Shipped' || $_REQUEST['statushidden']=='Shipped')?'selected="selected"':''?>>Shipped</option>
                        <option value="Completed" <?=($_REQUEST['status']=='Completed'  || $_REQUEST['statushidden']=='Completed')?'selected="selected"':''?>>Completed</option>
                        <option value="Cancelled" <?=($_REQUEST['status']=='Cancelled'  || $_REQUEST['statushidden']=='Cancelled')?'selected="selected"':''?>>Cancelled</option>
                        <option value="Dispute" <?=($_REQUEST['status']=='Dispute'  || $_REQUEST['statushidden']=='Dispute')?'selected="selected"':''?>>Dispute</option>
                        <option value="Return" <?=($_REQUEST['status']=='Return'  || $_REQUEST['statushidden']=='Return')?'selected="selected"':''?>>Return</option>
                        <option value="Refund" <?=($_REQUEST['status']=='Refund'  || $_REQUEST['statushidden']=='Refund')?'selected="selected"':''?>>Refund</option>
                      </select>                    </td>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr class="row1">
                    <td colspan="7" align="left" style="margin:0px;padding:0px;"><table width="100%" class="tborder_new" cellpadding="6" cellspacing="1">
                        <tr class="row2">
                          <td><span class="leftBarText_new" >Order Id</span>
						  <input type="text" name="o_id" class="forminputelement" id="o_id"  value="<?=$_REQUEST['o_id']?>"/>						  
						  </td>
						  <td><span class="leftBarText_new" >Select Vendor</span>
						 <select name="select_vendor" class="forminputelement">
						 <option value="">-- Select vendor --</option>
						 <?
						 $sql_v = "SELECT DISTINCT(`vendor_name`), `vendor_id` FROM ".$cfg['DB_VENDOR_ORDER']."";
						 $res_v = $heart->sql_query($sql_v);
						 $maxrow_v = $heart->sql_numrows($res_v);
						 
						 if($maxrow_v > 0){
						 	while($row_v = $heart->sql_fetchrow($res_v)){
						 ?>
						 <option value="<?=$row_v['vendor_id']?>" <? if($_REQUEST['select_vendor'] == $row_v['vendor_id']) {?> selected="selected"<? }?>><?=$row_v['vendor_name']?></option>
						 <?
						 }}
						 ?>
						 </select>						  
						  </td>
                          <td colspan="4" align="left"><span class="leftBarText_new" >Delivery Date</span>
						  <input name="dd" type="text" class="forminputelement" id="hidShippingDate" readonly="readonly" value="<?=$_REQUEST['dd']?>" />						  </td>
                          <td colspan="2" align="center">
						  <input  name="searchorder" type="submit" value="search" class="btnModify" />						  </td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr class="headercontent">
                    <td width="5%" align="center" class="leftBarText_new1">Sl No</td>
                    <td width="10%" align="center" class="leftBarText_new1">Order Id</td>
                    <td width="18%" align="center" class="leftBarText_new1">Vendor Name </td>
                    <td width="14%" align="center" class="leftBarText_new1">Amount</td>
                    <td width="13%" align="center" class="leftBarText_new1">Delivery Date</td>
                    <td width="15%" align="center" class="leftBarText_new1">Delivery Status</td>
                    <td width="12%" align="center" class="leftBarText_new1">Action</td>
                  </tr>
				  <?	
				  

	$order_id 		 = trim($_REQUEST['o_id']);
	$select_vendor 	 = $_REQUEST['select_vendor'];
	$delivery_date  = $_REQUEST['dd'];
	
	$whereClause = "";
	if($order_id != '' || $delivery_date != '' || $select_vendor != '')
		{
			if($order_id!='')
			{
				$whereClause = $whereClause."AND `or_pattern` LIKE '".$order_id."%'";
			}
			
			if($select_vendor!='')
			{
				$whereClause = $whereClause."AND `vendor_id` = '".$select_vendor."'";
			}
			
			if($delivery_date!='')
			{
				$whereClause = $whereClause."AND `delivery_date` LIKE '".$delivery_date."%'";
			}
			
		}
	else
		{
			$whereClause;
		}
				  
				  
				  								
					 $sql="SELECT * FROM ".$cfg['DB_VENDOR_ORDER']." WHERE `status` = 'A' ".$whereClause."  ORDER BY od_id DESC";
					 $res=$heart->sql_query($sql);
					 $maxrow=$heart->sql_numrows($res);
					 $sql = $sql. " LIMIT $offset,$limit";
					 $res = $heart->sql_query($sql);
					 ?>
                  <?
					if($maxrow > 0)
					{
						while($row = $heart->sql_fetchrow($res))
							{@$i++;
		?>
                  <tr class="row1">
                    <td align="center"><?=$i;?></td>
                    <td align="center"><?=$row['or_pattern'];?></td>
                    <td align="center" class="linkTitle"><?=$row['vendor_name']?></td>
					<?
					$grand_total = total_a($row['od_id']);
					?>	
					<? $delivery_charges = $row['delivery_charge'];?>
		            <td align="center">
					  
                        <b>&#8377;</b>&nbsp;<?=($grand_total + $delivery_charges)?>				    
					</td>
                    <td align="center"><?=date('d-M-Y',strtotime($row['delivery_date']));?></td>
                    <td align="center"><? if($row['od_delivery_status']=='Yes'){ ?>
                        <a style="text-decoration:none;" class="delivered" id="delivery"> Delivered </a>
                        <?
						}
						elseif($row['delivery_status']=='Attempted')
						{
						?>
                        <a style="text-decoration:none; cursor:pointer;" class="attempted" id="delivery" onClick="openPopup1(<?=$row['od_id']?>);"> Attempted
                          <?
						}
						else
						{
						?>
                        <a style="text-decoration:none; cursor:pointer;"class="notDelivered" id="delivery" onClick="openPopup1(<?=$row['od_id']?>);"> Not Delivered </a>
                        <?
						}
						?>
                      </a> </td>
                    <td align="center"><a href="vendor_order.php?show=view&id=<?=$row['od_id']?>&vendor_id=<?=$row['vendor_id']?>"> 
					<img src="images/view.gif" title="View" width="16" height="16" border="0" /> </a> </td>
                  </tr>
				  
                  <?
					}
					}
					else
					{
					?>
					<tr class="row2">
					<td colspan="7" class="msg" align="center">
					No Record Found					</td>
					</tr>
					<?
					}
					?>
                </tbody>
              </table>
			  </style>
              <div id="fade_form2" class="black_overlay"></div>
                        <div id="pop_form2" class="popupfrmCustomer2">
                          <table width="100%" border="0" class="popupTableEmp1">
                            <tr>
                              <td align="right">
                                <img src="images/close.png" width="25" height="25" 
                                  style="margin-right:-22px; margin-top:-22px; cursor:pointer;" onclick="closePopup2()" />                              </td>
                            </tr>
                            <tr>
                              <td valign="top">
                                <table align="center" width="100%" style="margin-bottom:10px;" cellpadding="6" cellspacing="1" border="0">
                                  <tr>
                                    <td class="headercontent" align="left"><font color="#FFFFFF" size="+1" style="text-shadow:#FFFFFF;">Update Payment Status</font></td>
                                  </tr>
                                </table>
                                <div style="overflow:auto;">
								<form name="frm1" method="post" action="order_process.php" id="frmsearch" onsubmit=" return searc();">
								<input type="hidden" name="act" value="update_payment">
								<input type="hidden" name="id" id="oID">
                                  <table align="center" cellpadding="3" cellspacing="1" width="100%">
                                    <tr>
                                      <td class="leftBarText" colspan="3">
                                        <u>Select Payment Status</u>:-                                      </td>
                                    </tr>
									
                                    <tr>
									
                                      <td class="leftBarText">
                                        <input type="radio" name="shipped" id="shipped" value="Shipped" checked="checked"><span class="delivered">Shipped</span>																<br>
                                        <input type="radio" name="shipped" id="unpaid"  value="Unpaid" onclick=""><span class="pending">UnPaid</span>                                      </td>
                                    </tr>
                                    <!--<tr>
                                      <td colspan="2" style="margin:0px; padding:0px;">
                                      <!--<div style="display:none;" id="deliveredForm">
                                      </div>-->
                                    <!--<div style="display:none;" id="attemptedForm">
                                      <table width="100%" cellpadding="6" cellspacing="1">
                                      <tr>
                                      <td>
                                      Reason:																</td>
                                      <td colspan="2">
                                      <textarea name="reason" id="reason" class="forminputelement"></textarea>																</td>
                                      </tr>
                                      </table>
                                      </div>
                                      <div style="display:none;" id="notDeliveredForm">
                                      <table width="100%" cellpadding="6" cellspacing="1">
                                      <tr>
                                      <td>
                                      Reason:																</td>
                                      <td colspan="2">
                                      <textarea name="reason" id="reason" class="forminputelement"></textarea>																</td>
                                      </tr>
                                      </table>
                                      </div>	-->																	
                                    <!--</td>
                                      </tr>
                                      <tr>-->
                                    <td align="right" colspan="3">
                                      <br><br><br>
                                      <input type="submit" id="update" name="update" value="Update" class="loginbttn" onclick="confirm('Do you really want to Update Payment status?');closePopup2(); ">                                    </td>
                                    </tr>
                                  </table>
								  </form>
                                </div>							  </td>
                            </tr>
							
                          </table>
                        </div>  
						
						<div id="fade_form1" class="black_overlay"></div>
                        <div id="pop_form1" class="popupfrmCustomer2">
                          <table width="100%" border="0" class="popupTableEmp1">
                            <tr>
                              <td align="right">
                                <img src="images/close.png" width="25" height="25" 
                                  style="margin-right:-22px; margin-top:-22px; cursor:pointer;" onclick="closePopup1()" />                              </td>
                            </tr>
                            <tr>
                              <td valign="top">
                                <table align="center" width="100%" style="margin-bottom:10px;" cellpadding="6" cellspacing="1" border="0">
                                  <tr>
                                    <td class="headercontent" align="left"><font color="#FFFFFF" size="+1" style="text-shadow:#FFFFFF;">Update Delivery Status</font></td>
                                  </tr>
                                </table>
                                <div style="overflow:auto;">
								<form name="frm1" method="post" action="vendor_order_process.php" id="frmsearch" onsubmit=" return searc();">
								<input type="hidden" name="act" value="update_delivered_status">
								<input type="hidden" name="id" id="oid">
                                  <table align="center" cellpadding="3" cellspacing="1" width="100%">
                                    <tr>
                                      <td class="leftBarText" colspan="3">
                                        <u>Select Delivery Status</u>:-                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="leftBarText">
                                        <input type="radio" name="delivered" id="delivered" value="Yes" onclick="deliveredForm('deliveredForm');"><span class="delivered">Delivered</span>                                      </td>
                                      <td class="leftBarText">
                                        <input type="radio" name="delivered" id="attempted" value="Attempted" onclick="deliveredForm('notDeliveredForm');">Attempted                                      </td>
                                      <td class="leftBarText">
                                        <input type="radio" name="delivered" id="notdelivered" align="absmiddle" value="No" onclick="deliveredForm('notDeliveredForm');"><span class="notDelivered">Not Delivered</span>                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" style="margin:0px; padding:0px;">
                                        <div style="display:none;" id="deliveredForm">                                        </div>
                                        <!--<div style="display:none;" id="attemptedForm">
										<br>
                                          <table>
                                            <tr>
                                              <td valign="top">
                                                Reason:                                              </td>
                                              <td colspan="2">
                                                <textarea name="reason" id="reason" class="forminputelement" style="height:85px; width:171px;" ></textarea>                                              </td>
                                            </tr>
                                          </table>
                                        </div>-->
                                        <div style="display:none;" id="notDeliveredForm">
										<br>
                                          <table>
                                            <tr>
                                              <td valign="top">
                                                Reason:                                              </td>
                                              <td colspan="2">
                                                <textarea name="reason" id="reason" class="forminputelement" style="height:85px; width:171px;"></textarea>                                              </td>
                                            </tr>
                                          </table>
                                        </div>                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="right" colspan="3">
                                        <br>
                                        <input type="submit" id="change" name="update" value="Update" class="loginbttn" onclick="closePopup1();">                                      </td>
                                    </tr>
                                  </table>
								</form>
                                </div>							  </td>
                            </tr>
                          </table>
                        </div>
                          
						
						
                       
              <div style="width:95%; text-align:right;">
                <?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
              </div>
              <? 
                }
                
                //======================================  VIEW THE ORDER ========================================//
                
                if($show=='view'){ 
               
             					$orderId = $_REQUEST['id'];	
								$sql="SELECT * FROM ".$cfg['DB_VENDOR_ORDER']." WHERE  `od_id` = '".$orderId."' AND `vendor_id` = '".$_REQUEST['vendor_id']."' ";
								$res=$heart->sql_query($sql);
								$row=$heart->sql_fetchrow($res);
								
								
?>								<div id="printSalesList">
								<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
									<thead>
										<tr>
											<td colspan="3" align="left" class="style2">View Order Details</td>
										</tr>
									</thead>
									<tbody>
										<tr class="row1">
											<td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
										</tr>
										<tr class="row2">
											<td align="left" class="leftBarText_new">Order From </td>
											<td colspan="2" align="left">
											<?=$row['vendor_name']?>
											</td>
										</tr>
										<tr class="row1">
											<td width="23%" align="left" class="leftBarText_new">Order Number</td>
											<td width="77%" colspan="2" align="left">
											<?=$row['or_pattern']?>
											</td>
										</tr>
										
											<tr class="row1">
												<td class="leftBarText_new" align="left">
												Delivary Status												</td> 
												<td colspan="2" align="left">
												<? if($row['delivery_status']=='Yes'){ ?>
												<a style="text-decoration:none;" class="delivered" id="delivery">
												Delivered
												</a>
												<?
												}
												elseif($row['delivery_status']=='Attempted')
												{
												?>
												<a style="text-decoration:none;" class="attempted" id="delivery">
												Attempted
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
											</tr>
											<? if($row['delivery_status']=='Yes'){ ?>
								  <a style="text-decoration:none;" class="delivered" id="delivery">
														Delivered								  </a>
														<?
														}
														elseif($row['delivery_status']=='Attempted')
														{
														?>
														<tr class="row2">
														<td class="leftBarText_new" align="left">Reason</td>
														<td colspan="2" align="left"><?=$row['delivery_faild_reason']?></td>
														</tr>
														<?
														}
														else
														{
														?>
														<tr class="row2">
														<td class="leftBarText_new" align="left">Reason</td>
														<td colspan="2" align="left"><?=$row['delivery_faild_reason']?></td>
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
											<td align="left" class="leftBarText_new">Quantity</td>
											<td width="17%" align="right" class="leftBarText_new">Unit Price(<b>&#8377;</b>)</td>
											<td width="18%" align="right" class="leftBarText_new">Total(<b>&#8377;</b>)</td>
										</tr>
									<?
									$sql_item = "SELECT product.pd_name,
														product.pd_description,
														vendor_product.od_qty,
														vendor_product.price 
												 FROM ".$cfg['DB_VENDOR_ORDER_PRODUCT']." vendor_product 
												 INNER JOIN ".$cfg['DB_PRODUCT']." product
												 ON vendor_product.pd_id = product.pd_id
												 
												 WHERE vendor_product.od_id = '".$orderId."'";
									$res_item = $heart->sql_query($sql_item);
									$maxrow_item = $heart->sql_numrows($res_item);
									if($maxrow_item > 0){
										while($row_item = $heart->sql_fetchrow($res_item)){
									?>	
									<tr class="row2">
									<td width="60%" align="left" class="leftBarText_new">
									<font color="#FF3366"><?=$row_item['pd_name']?></font><font size="-6"><?=$row_item['pd_description']?></font>                  
									</td>
									<td width="10%" align="center"><?=$row_item['od_qty']?></td>
									<td align="right"><b>&#8377;</b>&nbsp;<?=$row_item['price']?></td>
									<td align="right"><b>&#8377;</b>&nbsp;<?=$row_item['od_qty']*$row_item['price']?></td>
								 </tr>
<? 									}}

									$grand_total = total_a($row['od_id']);
?>
										<tr class="row2">
											<td colspan="3" align="right" valign="top" class="leftBarText_new">Delivery Charges</td>
											<td align="right" valign="top">
											<b>&#8377;</b>&nbsp;<?=$row['delivery_charge']?>	
											</td>
										</tr>
										<tr class="row2">
											<td colspan="3" align="right" class="leftBarText_new">Total</td>
											<? $delivery_charges = $row['delivery_charge'];?>
											<td align="right"><b>&#8377;</b>&nbsp;<?=($grand_total + $delivery_charges)?></td>
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
												<span class="leftBarText_new">Email Address </span>											</td>
											<td width="71%" colspan="2" align="left" class="row2"><?=$row['email']?></td>
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
												<span class="leftBarText_new">Delivery Date</span>											</td>
											<td colspan="2" align="left" class="row2"><?=date('d-M-Y',strtotime($row['delivery_date']))?></td>
										</tr>
										<tr>
											<td width="29%" align="left" class="row1">
												<span class="leftBarText_new">First Name </span>											</td>
											<td width="71%" colspan="2" align="left" class="row2"><?=$row['first_name']?></td>
										</tr>
										<tr>
											<td align="left" class="row1">
												<span class="leftBarText_new">Last Name</span>											</td>
											<td colspan="2" align="left" class="row2"><?=$row['last_name']?></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="row1">
												<span class="leftBarText_new">Address </span>											</td>
											<td colspan="2" align="left" valign="top" class="row2"><?=$row['address']?></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="row1">
												<span class="leftBarText_new">City</span>											</td>
												<?
											$sql_od1 = "SELECT location.name,
															  location.id,
															  orders.city,
															  orders.country,
															  orders.od_id 
															  
													   FROM ".$cfg['DB_VENDOR_ORDER']." orders 
													   INNER JOIN ".$cfg['DB_LOCATION']." location
													   
													   ON location.id = orders.city
													   
													   WHERE orders.od_id = '".$row['od_id']."'";
													   
													   
											$res_od1 = $heart->sql_query($sql_od1);
											$row_od1 = $heart->sql_fetchrow($res_od1);
											?>
											<td colspan="2" align="left" valign="top" class="row2">
												
												<?=$row_od1['name']?>											
											</td>
										</tr>
										<tr>
											<td align="left" class="row1">
												<span class="leftBarText_new">State</span>											</td>
											<td colspan="2" align="left" class="row2">
												<?=$row['state']?>
												<?php /*?><?=getFieldsFromTable($row['od_shipping_state'],'state_name',$cfg['DB_STATE'],'st_id')?><?php */?>											</td>
										</tr>
										<tr>
											<td align="left" valign="top" class="row1">
												<span class="leftBarText_new">Country</span>											</td><?
											$sql_od2 = "SELECT country.country_name,
															   country.country_id,
															   orders.country,
															   orders.od_id 
															  
													   FROM ".$cfg['DB_VENDOR_ORDER']." orders 
													   INNER JOIN ".$cfg['DB_COUNTRY_MASTER']." country
													   
													   ON country.country_id = orders.country
													   
													   WHERE orders.od_id = '".$row['od_id']."'";
													   
													   
											$res_od2 = $heart->sql_query($sql_od2);
											$row_od2 = $heart->sql_fetchrow($res_od2);
											?>
											<td colspan="2" align="left" valign="top" class="row2">
												<?=$row_od2['country_name']?>
											</td>
										</tr>
										<tr>
											<td class="row1" align="left">
												<span class="leftBarText_new">Pincode</span>											
										  </td>
											<td colspan="2" align="left" class="row2"><?=$row['pin_code']?></td>
										</tr>
										<tr>
											<td width="29%" align="left" class="row1">
												<span class="leftBarText_new">Mobile Number </span>											
										  </td>
											<td width="71%" colspan="2" align="left" class="row2">
											<?=($row['mobile']!='')?$row['mobile']:'No Mobile No.'?>											
											</td>
										</tr>
										<tr>
											<td width="29%" align="left" class="row1">
											<span class="leftBarText_new">Phone Number </span>											
											</td>
											<td width="71%" colspan="2" align="left" class="row2">
											<?=($row['phone']!='')?$row['phone']:'No Phone No.'?>
											</td>
										</tr>
										<tr>
											<td class="row1" align="left">
											<span class="leftBarText_new">Message On Card</span>											
											</td>
											<td colspan="2" align="left" class="row2">
											<?=$row['message']?>
											</td>
										</tr>
										<tr>
											<td class="row1" align="left">
											<span class="leftBarText_new">Sender's Name</span>											
											</td>
											<td colspan="2" align="left" class="row2">
											<?=$row['senders_name']?>
											</td>
										</tr>
										<tr>
											<td class="row1" align="left">
											<span class="leftBarText_new">Special Instruction</span>											
											</td>
											<td colspan="2" align="left" class="row2">
											<?=$row['speacial_instruction']?>
											</td>
										</tr>
										<tr>
											<td colspan="3" align="center" style="padding: 20px 0;">
												<a class="brownbttn" href="vendor_order.php">
													&lt;&lt;&nbsp;Back												
												</a>											
											</td>
										</tr>
									</tbody>
								</table>
								<tr height="16">
            <td colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
          </tr>
								</div>
								
              <? 
                
				}
                
              ?>            
			  
			 
                
                        
		    
		    </table>
							  </td>
							  </tr>
							  <tr>
							  <td colspan="3" align="right"></td>
							  </tr>
							  </table>
					  
	  