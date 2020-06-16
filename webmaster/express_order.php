<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}

page_header($cfg['ADMIN_TITLE']." - Order Management");
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];
$orderstat =($_REQUEST['status']!="")?$_REQUEST['status']:'0';


$str=getCategoryID(40);

//echo $sql_p="SELECT * FROM ".$cfg['DB_ORDER_ITEM']."  WHERE`pd_id` IN (".$str.")";	   
//$res_p=$heart->sql_query($sql_p);
//echo $maxrow_p=$heart->sql_numrows($res_p);	   
if($str!='')
{
	$od=getOrderID($str);
}
//die();


?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function modifyOrderStatus(orderId,cId)
{
	statusList = window.document.frmOrder.status;
	status     = statusList.options[statusList.selectedIndex].value;
	window.location.href = 'order_process.php?act=modify&oid=' + orderId + '&status=' + status + '&c_id='+cId;
}
</script>
<script language="javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/calender/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="scripts/calender/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">

	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dd",
			dateFormat:"%Y-%m-%d"			
		});		
	};
</script>
<script type="text/javascript">
 function searc()
 { 
 	if(document.getElementById("dd").value=='' && document.getElementById("o_id").value=='' && document.getElementById("month").value=='' && document.getElementById("remarks").value=='')
	{
	   alert('Please enter at least one field');
//	   document.getElementById("dd").focus();
	   return false;
	}
	if(document.getElementById("dd").value!=''){
	document.getElementById("orderdatehidden").value=document.getElementById("dd").value;
	}
	//alert(document.getElementById("orderdatehidden").value);
	return true;
 }
function  getOrderStatus(status)
{
document.getElementById("statushidden").value=status;
window.location.href='order.php?status='+status;
}
 </script>
<style type="text/css">
<!--
.style3 {color: #FFFFFF}
-->
</style>
<td vAlign=top align="center" width="99%"><!-- Start Body Here -->
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr height="34">
      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br />
        <br />
        <?php include_once("left_bar.php");?></td>
    </tr>
    <tr>
      <td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>
      <td align="left" valign="top" width="99%">     
      <table width="698" align="center" border="0" cellspacing="0" cellpadding="0" style="background:url(images/welcome_head.jpg) center top no-repeat;">
          <tr height="35">
            <td width="640" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
              <?=$_SESSION['admin_user_name']?>
              </span></td>
            <td width="56" align="right" valign="middle"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr height="16">
            <td colspan="2" align="left" valign="middle" bgcolor="#CFCFCF">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#CFCFCF" align="center"><? //show all record
	   if($_REQUEST['show']==''){
   
	   
	   
	   if(isset($_REQUEST['searchorder'])){
	 	$dd=$_REQUEST['orderdatehidden'];
		$month=$_REQUEST['month'];
		$o_id=$_REQUEST['o_id'];
		$remarks=$_REQUEST['remarks'];
		$qry1='';
		$qry2='';
		$qry3='';
		$qry4='';
		$od='';
		if($dd!='')
		{
			$qry1="AND `od_date`='".$dd."'";
		}
			if($month!='')
		{
			$qry2="AND `od_date`LIKE '%-".$month."-%'";
		}
			if($o_id!='')
		{
			$qry3="AND `od_id`='".$o_id."'";
		}
			if($remarks!='')
		{
			$qry4="AND `od_shipping_remarks`LIKE '".$remarks."'";
		}
		if($od!='')
		{
			$od="AND `od_id` = '".$od."' ";
		}
  
  		if($_REQUEST['statushidden']=='0'){
		$odstat ="(`od_status`='New' OR `od_status`='Paid' OR `od_status`='Shipped' OR `od_status`='Completed' OR `od_status`='Cancelled' OR `od_status`='Dispute' OR `od_status`='Return' OR `od_status`='Refund')";
		$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE  $odstat $od $qry1 $qry2 $qry3 $qry4 ORDER BY `od_id`";
		}
		else{
		$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_status`='".$_REQUEST['statushidden']."' $od $qry1 $qry2 $qry3 $qry4 ORDER BY `od_id`";
		}

	   
	   }
	   
	   
	   else
	   {
	   $status=($_REQUEST['status']=="")?'0':$_REQUEST['status'];
	   if($od!='' && $status=='0'){	 
	   
	  echo $sql="SELECT * FROM ".$cfg['DB_ORDER']."  WHERE `od_id` IN (".$od.") ORDER BY `od_id`";
	   }
	 
	   else{
$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status`='".$status."' AND `od_id`='".$row_p['od_id']."' ORDER BY `od_id`";
	   }
	   }
		  
			 $res=$heart->sql_query($sql);
			 $maxrow=$heart->sql_numrows($res);
			 $sql = $sql. " LIMIT $offset,$limit";
			 $res = $heart->sql_query($sql);
	   ?>
              <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr class="thead">
                    <td colspan="3" align="left">&nbsp;<span class="style2">Express Order Section</span> </td>
                    <td colspan="3" align="right"><select name="status" class="forminputelement" id="status" onchange="getOrderStatus(this.value)">
                        <option value="0" <?=($status==0)?'selected="selected"':''?>>All</option>
                        <option value="New" <?=($status=='New' || $_REQUEST['statushidden']=='New')?'selected="selected"':''?>>New</option>
                        <option value="Paid" <?=($status=='Paid' || $_REQUEST['statushidden']=='Paid')?'selected="selected"':''?>>Paid</option>
                        <option value="Shipped" <?=($status=='Shipped' || $_REQUEST['statushidden']=='Shipped')?'selected="selected"':''?>>Shipped</option>
                        <option value="Completed" <?=($status=='Completed'  || $_REQUEST['statushidden']=='Completed')?'selected="selected"':''?>>Completed</option>
                        <option value="Cancelled" <?=($status=='Cancelled'  || $_REQUEST['statushidden']=='Cancelled')?'selected="selected"':''?>>Cancelled</option>
                        <option value="Dispute" <?=($status=='Dispute'  || $_REQUEST['statushidden']=='Dispute')?'selected="selected"':''?>>Dispute</option>
                        <option value="Return" <?=($status=='Return'  || $_REQUEST['statushidden']=='Return')?'selected="selected"':''?>>Return</option>
                        <option value="Refund" <?=($status=='Refund'  || $_REQUEST['statushidden']=='Refund')?'selected="selected"':''?>>Refund</option>
                      </select>
                    </td>
                  </tr>
                </thead>
                <tbody>
                  <tr class="row2">
                    <td colspan="6" align="right" class="redbuttonelements"><?=@$msg?></td>
                  </tr>
                <form name="frmsearch" method="post" action="order.php" id="frmsearch" onsubmit=" return searc();">
                  <input type="hidden" name="statushidden" id="statushidden" value="<?=$orderstat?>" />
                  <input type="hidden" name="orderdatehidden" id="orderdatehidden" value="" />
                  <input type="hidden" name="act" value="searc" />
                  <tr class="row1">
                    <td colspan="0"><span class="leftBarText_new" >Delivery Date</span><br />
                      <input name="dd" type="text" class="forminputelement" id="dd" readonly="readonly" value="<?=$dd?>"/></td>
                    <td><span class="leftBarText_new" >Month</span><br />
                      <select name="month" class="forminputelement" id="month" >
                        <option value="">Select Month</option>
                        <option value="01" <?=($month=='01' )?'selected="selected"':''?>>January</option>
                        <option value="02" <?=($month=='02' )?'selected="selected"':''?>>February</option>
                        <option value="03" <?=($month=='03' )?'selected="selected"':''?>>March</option>
                        <option value="04" <?=($month=='04' )?'selected="selected"':''?>>April</option>
                        <option value="05" <?=($month=='05' )?'selected="selected"':''?>>May</option>
                        <option value="06" <?=($month=='06' )?'selected="selected"':''?>>June</option>
                        <option value="07" <?=($month=='07' )?'selected="selected"':''?>>July</option>
                        <option value="08" <?=($month=='08' )?'selected="selected"':''?>>August</option>
                        <option value="09" <?=($month=='09' )?'selected="selected"':''?>>September</option>
                        <option value="10" <?=($month=='10' )?'selected="selected"':''?>>October</option>
                        <option value="11" <?=($month=='11' )?'selected="selected"':''?>>November</option>
                        <option value="12" <?=($month=='12' )?'selected="selected"':''?>>December</option>
                      </select></td>
                    <td><span class="leftBarText_new" >Order Id</span><br />
                      <input type="text" name="o_id" value="<?=$o_id ?>" class="forminputelement" id="o_id"></td>
                    <td><span class="leftBarText_new" >Remarks</span><br />
                      <input type="text" name="remarks" value="<?=$remarks ?>" class="forminputelement" id="remarks"></td>
                    <td colspan="6" align="right"><input  name="searchorder" type="submit" value="search" class="btnModify"  ></td>
                  </tr>
                </form>
                <tr class="headercontent">
                  <td width="12%" align="center" class="leftBarText_new1">Order Number </td>
                  <td width="29%" align="left" class="leftBarText_new1">Customer Name </td>
                  <td width="13%" align="right" class="leftBarText_new1">Amount</td>
                  <td width="23%" align="center" class="leftBarText_new1">Order Date </td>
                  <td width="11%" align="center" class="leftBarText_new1">Status</td>
                  <td width="12%" align="center" class="leftBarText_new1">Action</td>
                </tr>
                <? 
		   if($maxrow >0){
			 while($row=$heart->sql_fetchrow($res)){
			 @$i++;
			?>
                <tr class="<?=($i%2==0)?'row1':'row2'?>">
                  <td align="center"><?=$row['or_pattern']?>
                    <br />
                    ( #
                    <?=$row['od_id']?>
                    )</td>
                  <td align="left" class="linkTitle"><?=$row['od_shipping_first_name'].' '.$row['od_shipping_last_name']?></td>
                  <td align="right"><?=displayAmount($row['od_id'])?></td>
                  <td align="center"><?=getdataformat($row['od_date']);?></td>
                  <td align="center"><?=$row['od_status']?>
                    </a></td>
                  <td align="center"><a href="order_process.php?act=view&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a></td>
                </tr>
                <? }
			}
			  else {?>
                <tr class="row2">
                  <td colspan="6" align="center" class="msg">No Record.</td>
                </tr>
                <? }?>
                <tr>
                  <td colspan="6" align="center">&nbsp;</td>
                </tr>
                </tbody>
                
              </table>
              <div style="width:90%; text-align:right;">
                <?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
              </div>
              <? }?>
              <? // show insert window
		if($show=='add'){} 
	  // show edit window
	  if($show=='edit'){} 
	  
	  if($show=='view'){
	  $orderId = $_REQUEST['id'];
	  $c_Id = $_REQUEST['c_id'];
	  
	  
		$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `od_id` =".$_REQUEST['id']."";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		
		$sql1="SELECT * FROM ".$cfg['DB_CUSTOMER']." WHERE  `id` =".$_REQUEST['c_id']."";
		$res1=$heart->sql_query($sql1);
		$row1=$heart->sql_fetchrow($res1);
	  
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
                    <td width="23%" align="left" class="leftBarText_new"><span class="leftBarText_new">Order Number </span></td>
                    <td width="77%" colspan="2" align="left"><?=$row['od_id']?></td>
                  </tr>
                  <tr class="row1">
                    <td align="left" class="leftBarText_new">Order Date </td>
                    <td align="left"><?=getdataformat($row['od_date']);?></td>
                  </tr>
                  <tr class="row2">
                    <td align="left" valign="top" class="leftBarText_new">Last Update </td>
                    <td colspan="2" align="left" valign="top"><?=$row['od_last_update']?></td>
                  </tr>
                  <tr class="row1">
                    <td class="leftBarText_new" align="left">Status</td>
                    <td colspan="2" align="left"><? $status = $row['od_status'];?>
                      <form action="" method="get" name="frmOrder" id="frmOrder">
                        <select name="status" class="forminputelement" id="status">
                          <option value="New" <?=($status=='New')?'selected="selected"':''?>>New</option>
                          <option value="Paid" <?=($status=='Paid')?'selected="selected"':''?>>Paid</option>
                          <option value="Shipped" <?=($status=='Shipped')?'selected="selected"':''?>>Shipped</option>
                          <option value="Completed" <?=($status=='Completed')?'selected="selected"':''?>>Completed</option>
                          <option value="Cancelled" <?=($status=='Cancelled')?'selected="selected"':''?>>Cancelled</option>
                          <option value="Dispute" <?=($status=='Dispute')?'selected="selected"':''?>>Dispute</option>
                          <option value="Return" <?=($status=='Return')?'selected="selected"':''?>>Return</option>
                          <option value="Refund" <?=($status=='Refund')?'selected="selected"':''?>>Refund</option>
                        </select>
                        <input name="btnModify" type="button" id="btnModify" value="Modify Status" class="btnModify" onClick="modifyOrderStatus(<?=$orderId?>,<?=$c_Id?>);">
                      </form></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" >&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <p>&nbsp;</p>
              <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="3" align="left" class="style2">&nbsp;Order Item </td>
                  </tr>
                </thead>
                <tbody>
                  <tr class="row1">
                    <td align="left" class="leftBarText_new">Item</td>
                    <td width="17%" align="right" class="leftBarText_new">Unit Price </td>
                    <td width="18%" align="right" class="leftBarText_new">Total</td>
                  </tr>
                  <?
			$sql_od = "SELECT * FROM ".$cfg['DB_ORDER_ITEM']." WHERE `od_id` = '".$row['od_id']."'";
			$res_od = $heart->sql_query($sql_od);
			while($row_od =	$heart->sql_fetchrow($res_od)){
			?>
                  <tr class="row2">
                    <td width="65%" align="left"><?=$row_od['od_qty'].' X '.pd_name($row_od['pd_id'])?></td>
                    <td align="right"><?=currency_symbol().pd_price($row_od['pd_id'])?></td>
                    <td align="right"><?=currency_symbol().pd_price($row_od['pd_id']) * $row_od['od_qty']?></td>
                  </tr>
                  <? }?>
                  <tr class="row2">
                    <td colspan="2" align="right" class="leftBarText_new">Sub-total</td>
                    <td align="right"><?=currency_symbol().subTotal($row['od_id'])?></td>
                  </tr>
                  <tr class="row2">
                    <td colspan="2" align="right" valign="top" class="leftBarText_new">Shipping</td>
                    <? $subtotal=subTotal($row['od_id']);
			  $shopConfig['free_shipping_limit'];
			  $shippingCost = ($subtotal>=$shopConfig['free_shipping_limit'])?'0':$shopConfig['shippingCost']; ?>
                    <td align="right" valign="top"><?=($shippingCost==0)?'- FREE -':displayFrontAmount($shopConfig['shippingCost'])?></td>
                  </tr>
                  <tr class="row2">
                    <td colspan="2" align="right" class="leftBarText_new">Total</td>
                    <td align="right"><?=currency_symbol().($subtotal + $shippingCost)?></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" >&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <p>&nbsp;</p>
              <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="3" align="left" class="style2">&nbsp;Customer Information </td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td width="29%" align="left" class="row1"><span class="leftBarText_new">Email Address </span></td>
                    <td width="71%" colspan="2" align="left" class="row2"><?=$row1['email']?></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" >&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <p>&nbsp;</p>
              <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="3" align="left" class="style2">&nbsp;Shipping Information </td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td width="29%" align="left" class="row1"><span class="leftBarText_new">First Name </span></td>
                    <td width="71%" colspan="2" align="left" class="row2"><?=$row['od_shipping_first_name']?></td>
                  </tr>
                  <tr>
                    <td align="left" class="row1"><span class="leftBarText_new">Last Name</span></td>
                    <td align="left" class="row2"><?=$row['od_shipping_last_name']?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="row1"><span class="leftBarText_new">Address </span></td>
                    <td colspan="2" align="left" valign="top" class="row2"><?=$row['od_shipping_address1']?></td>
                  </tr>
                  <!--<tr>
              <td class="row1" align="left"><span class="leftBarText_new">Address 2</span> </td>
              <td colspan="2" align="left" class="row2"><?=$row['od_shipping_address2']?></td>
            </tr>-->
                  <tr>
                    <td width="29%" align="left" class="row1"><span class="leftBarText_new">Phone Number </span></td>
                    <td width="71%" colspan="2" align="left" class="row2"><?=$row['od_shipping_phone']?></td>
                  </tr>
                  <tr>
                    <td align="left" class="row1"><span class="leftBarText_new">Province / State</span></td>
                    <td align="left" class="row2"><?=$row['od_shipping_city']?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="row1"><span class="leftBarText_new">City</span> </td>
                    <td colspan="2" align="left" valign="top" class="row2"><?=$row['od_shipping_state']?></td>
                  </tr>
                  <tr>
                    <td class="row1" align="left"><span class="leftBarText_new">Postal Code</span> </td>
                    <td colspan="2" align="left" class="row2"><?=$row['od_shipping_postal_code']?></td>
                  </tr>
                  <tr>
                    <td class="row1" align="left"><span class="leftBarText_new">Sender's Name</span> </td>
                    <td colspan="2" align="left" class="row2"><?=$row['od_shipping_sender_name 	']?></td>
                  </tr>
                  <tr>
                    <td class="row1" align="left"><span class="leftBarText_new">Delivery Date</span> </td>
                    <td colspan="2" align="left" class="row2"><?=$row['od_delivery_date']?></td>
                  </tr>
                  <tr>
                    <td class="row1" align="left"><span class="leftBarText_new">Delivery Notes</span> </td>
                    <td colspan="2" align="left" class="row2"><?=$row['od_shipping_deli_notes']?></td>
                  </tr>
                  <tr>
                    <td class="row1" align="left"><span class="leftBarText_new">Remarks</span> </td>
                    <td colspan="2" align="left" class="row2"><?=$row['od_shipping_remarks']?></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" >&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <p>&nbsp;</p>
              <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="3" align="left" class="style2">&nbsp;Billing Information </td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td width="29%" align="left" class="row1"><span class="leftBarText_new">First Name </span></td>
                    <td width="71%" colspan="2" align="left" class="row2"><?=$row['od_payment_first_name']?></td>
                  </tr>
                  <tr>
                    <td align="left" class="row1"><span class="leftBarText_new">Last Name</span></td>
                    <td align="left" class="row2"><?=$row['od_payment_last_name']?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="row1"><span class="leftBarText_new">Address </span></td>
                    <td colspan="2" align="left" valign="top" class="row2"><?=$row['od_payment_address1']?></td>
                  </tr>
                  <!--<tr>
              <td class="row1" align="left"><span class="leftBarText_new">Address 2</span> </td>
              <td colspan="2" align="left" class="row2"><?=$row['od_payment_address2']?></td>
            </tr>-->
                  <tr>
                    <td width="29%" align="left" class="row1"><span class="leftBarText_new">Phone Number </span></td>
                    <td width="71%" colspan="2" align="left" class="row2"><?=$row['od_payment_phone']?></td>
                  </tr>
                  <tr>
                    <td align="left" class="row1"><span class="leftBarText_new">Province / State</span></td>
                    <td align="left" class="row2"><?=$row['od_payment_city']?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="row1"><span class="leftBarText_new">City</span> </td>
                    <td colspan="2" align="left" valign="top" class="row2"><?=$row['od_payment_state']?></td>
                  </tr>
                  <tr>
                    <td class="row1" align="left"><span class="leftBarText_new">Postal Code</span> </td>
                    <td colspan="2" align="left" class="row2"><?=$row['od_payment_postal_code']?></td>
                  </tr>
                  <tr>
                    <td class="row1" align="left"><span class="leftBarText_new">Email</span> </td>
                    <td colspan="2" align="left" class="row2"><?=$row['od_payment_email']?></td>
                  </tr>
                  <tr>
                  <tr>
                    <td colspan="3" align="center" ><a href="order.php">&lt;&lt;back</a></td>
                  </tr>
                </tbody>
              </table>
              <? }?>
            </td>
          </tr>
          <tr height="16">
            <td colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="right"></td>
    </tr>
  </table>
