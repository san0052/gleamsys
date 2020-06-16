<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Vendor Management");

$show=$_REQUEST['show'];
?>


<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />



<script language="javascript" src="scripts/boxover.js"></script>
<script language="javascript" src="js/customer.js"></script>

<script language="javascript" src="js/ajax1.js"></script>
<script language="javascript" src="js/common.js"></script>
<script language="javascript" src="js/phone.js"></script>

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
</script>


<script type="text/javascript"> 
function validate()
{
var month = document.getElementById("select_month").value;
var year = document.getElementById("select_year").value;

	if(month == ""){
	alert("Please Select a Month...!!")
	document.getElementById("select_month").focus();
	return false;
	}
	
	if(year == ""){
	alert("Please Select a Year...!!")
	document.getElementById("select_year").focus();
	return false;
	}
}


function validation_delete(pageno)
{  
    
	 var flag=0;
          var ar=new Array();
		  var n=0;
	if(document.frm1.dropdown1.value=='')
	{
		alert('Please choose one action');
		return false;
	}
	if(document.frm1.dropdown1.value=='delete')
		 {
		   var m=document.frm1.checkvalue.length+'';
		 
		    if(m=='undefined')
		   {
		    
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				var id= document.frm1.checkvalue.value;
			   	ar[0] = id;
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				var id= document.frm1.checkvalue[i].value;
				ar[n++] = id;	
				flag ++;
			  }
		   }
		   }
		   
		 if(flag == 0)
		  {
		   alert('No record selected');
		   return false;
		  }
		if(flag > 0)
		 {
		 if(confirm('Do you want to delete these records')==true)
		   {   
		 
		   window.location.href="customer_process.php?&act=muldel&id="+ar+"&pageno="+pageno;
			 return true;
	       }
		   else
		   {
		     return false;
		   }
	 	
		}	
	 }
		 if(document.frm1.dropdown1.value=='Active')
		  {
		   var m=document.frm1.checkvalue.length+'';
		 
		     if(m=='undefined')
		   {
		    alert(document.frm1.checkvalue.checked);
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				var id= document.frm1.checkvalue.value;
			   	ar[0] = id;
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				var id= document.frm1.checkvalue[i].value;
				ar[n++] = id;	
				flag ++;
			  }
		   }
		   }
		   
		 if(flag == 0)
		  {
		   alert('No record selected');
		   return false;
		  }
		if(flag > 0)
		 {
		 if(confirm('Do you want to activate these records')==true)
		   {   
		 
		   window.location.href="customer_process.php?&act=mulactive&id="+ar+"&pageno="+pageno;
			 return true;
	       }
		   else
		   {
		     return false;
		   }
	 	
		}	
			
		    //window.location.href="banner_process.php?act=del&id="+ar;
			
         }
		  if(document.frm1.dropdown1.value=='Inactive')
		  {
		   var m=document.frm1.checkvalue.length+'';
		 
		     if(m=='undefined')
		   {
		    alert(document.frm1.checkvalue.checked);
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				var id= document.frm1.checkvalue.value;
			   	ar[0] = id;
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				var id= document.frm1.checkvalue[i].value;
				ar[n++] = id;	
				flag ++;
			  }
		   }
		   }
		   
		 if(flag == 0)
		  {
		   alert('No record selected');
		   return false;
		  }
		if(flag > 0)
		 {
		 if(confirm('Do you want to inactivate these records')==true)
		   {   
		 
		 window.location.href="customer_process.php?&act=mulinactive&id="+ar+"&pageno="+pageno;
			 return true;
	       }
		   else
		   {
		     return false;

		   }
	     }	
	   }
	 }
	 
 function checkall()
{
var ar = new Array();
	n = 0;
	var flag=0;
	
	if(document.getElementById("check_all").checked==true)
	{
		var m=document.frm1.checkvalue.length+'';
		if(m=='undefined')
		{
			document.frm1.checkvalue.checked=true;
		}
		
		 for(i = 0; i< document.frm1.checkvalue.length; i++)
		{
			document.frm1.checkvalue[i].checked=true;
		}
	}
	if(document.getElementById("check_all").checked==false)
	{
		var m=document.frm1.checkvalue.length+'';
		if(m=='undefined')
		{
			document.frm1.checkvalue.checked=false;
		}
		
		 for(i = 0; i< document.frm1.checkvalue.length; i++)
		{
			document.frm1.checkvalue[i].checked=false;
		}
	}
}

</script>
<script>
/*function check_phone(id)
{
	if(isNaN(document.getElementById(id).value))
	{
		document.getElementById(id+"1").style.display='inline';
		//alert("Phone number should be numeric");
		document.getElementById(id).focus();
		
	}
	else
	{
		document.getElementById(id+"1").style.display='none';
	}
}*/
</script>


<td vAlign=top align="center" width="99%"><!-- Start Body Here -->
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
  
    <tr height="34">
      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br /><br />
      <?php include_once("left_bar.php");?></td>
    </tr>
    <tr>
      <td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>
      <td align="left" valign="top" width="99%">      
	  <table width="698" align="center" border="0" cellspacing="0" cellpadding="0" style="background:url(images/welcome_head.jpg) center top no-repeat;">
	  <tr height="35" >
      <td width="650" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
              <?=$_SESSION['admin_user_name']?>
              </span>
			  <?
				if($_REQUEST['show'] == 'view')
				{
				?>
				<img src="images/printer_icon.png" title="Print" alt="Print" width="19" height="19" border="0" onclick="printContentSalesList('printDetails',this.id)" style="float:right"/>
				<?
				}
				?>			</td>
            <td width="48" align="right" valign="middle" class="style5">&nbsp;&nbsp;&nbsp;
			<a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" /></a>&nbsp;&nbsp;			</td>
	  <?php /*?><!--<td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome 
  <?=$_SESSION['admin_user_name']?></span></td>
	  <td  width="56"align="right" valign="middle"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>--><?php */?>
	  </tr>
	  <tr height="16">
	  <td colspan="8" align="left" valign="middle" bgcolor="#CFCFCF">&nbsp;</td>
	  </tr>
        <tr>
          <td colspan="8" bgcolor="#CFCFCF" align="center">
	  <? //show all record
	   if($_REQUEST['show']==''){
	   
	   
	   
	   ?>


<form name="frm1" id="frm1" method="post" action="balance.php">
  <input type="hidden" name="pageno" value="<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" />
  <table width="99%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
    <thead>
      <tr>
        <td colspan="7" align="left" class="style2">Business Balance Sheet</td>
      </tr>
      <tr>
        <td colspan="7" class="row1">
          <table width="100%">
            <tr>
              <td width="85%">
                Select Vendor:
                <select name="select_vendor" id="select_vendor">
				<option value="">--Select Vendor--</option>
				<?
				$sql_total="SELECT * FROM ".$cfg['DB_VENDOR']." WHERE `status` = 'A'";
				  
	 			 $res_total = $heart->sql_query($sql_total);
				 $maxrow_total = $heart->sql_numrows($res_total);
					if($maxrow_total > 0)
					{
						while($row_total = $heart->sql_fetchrow($res_total))
							{
			?>
				<option value="<?=$row_total['id']?>"<? if($_REQUEST['select_vendor']==$row_total['id']){?> selected="selected"<? }?>><?=$row_total['vendor_name']?></option>
			<?
							}
					}
			?>
				</select>				</td>
				
				<td width="15%" align="right"><input type="submit" name="submit1" value="Search" class="loginbttn"></td>
            </tr>
          </table>		  </td>
      </tr>
    </thead>
    <tbody>
      <tr class="headercontent">
        
        
        <td width="83%" align="left" class="leftBarText_new1">Vendor List </td>
        <td width="17%"align="center" class="leftBarText_new1" >Action</td>
      </tr>
	  <?
	  
	  $select_vendor = $_REQUEST['select_vendor'];
	  @$con = "";
	  if($select_vendor!="")
	  {
		  $con.=" AND assign.vendor_id = '".$select_vendor."'";
	  }
	  
			$sql_list="SELECT DISTINCT(vendor.vendor_name),
							  vendor.email,
							  vendor.id,
							  vendor.status,
							  assign.vendor_id
							  
							   
					   FROM ".$cfg['DB_VENDOR']." vendor
					   
					   INNER JOIN ".$cfg['DB_ASSIGN_VENDORS']." assign
					   ON vendor.id = assign.vendor_id
					   
					   WHERE vendor.status = 'A'".$con."";
			$res_list = $heart->sql_query($sql_list);
			$maxrow_list = $heart->sql_numrows($res_list);
			   
			if($maxrow_list > 0){
				while($row_list = $heart->sql_fetchrow($res_list)){
	  ?>
			  <tr class="row2">
				<td align="left">						
				<?=$row_list['vendor_name']?>				</td>
				<td align="center">
				<a href="balance.php?show=view&vendor_id=<?=$row_list['id']?>&vendor_name=<?=$row_list['vendor_name']?>&vendor_email=<?=$row_list['email']?>">	     
				<img src="images/view.gif" title="View Details">				</a>				</td>
			  </tr>
			   <?
			   }}
			   else
			   {
			   ?>
			   <tr class="row2">
			   <td colspan="2" class="msg" align="center">
			   No Records Found			   </td>
			   </tr>
	   <?
	   }
	   ?>
  </table>
</form>


		
		
<? 
}

if($_REQUEST['show']=='view'){
?>


<form action="balance.php?show=view&vendor_id=<?=$_REQUEST['vendor_id']?>" method="post" onsubmit="return validate();">
<input type="hidden" name="vendor_id" value="<?=$_REQUEST['vendor_id']?>">
<input type="hidden" name="vendor_name" value="<?=$_REQUEST['vendor_name']?>">
<input type="hidden" name="vendor_email" value="<?=$_REQUEST['vendor_email']?>">
  <input type="hidden" name="pageno" value="<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" />
  <div id="printDetails">
  <table width="99%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
    <thead>
      <tr>
        <td colspan="6" align="left" class="style2">View Details</td>
      </tr>
	  <tr class="row1">
	  <td colspan="6" style="margin:0px; padding:0px;">
	  <table width="100%" class="tborder_new" style="border:none;">
	  <tr class="row2">
	  <td width="16%">
		Select Month:		</td>
		
		<td width="21%">
		<select name="select_month" id="select_month">
          <option value="">-- Select Month --</option>
<? 
/*echo $sql1="SELECT orders.or_pattern,
		  		  orders.od_id,
				  orders.od_shipping_first_name,
				  orders.od_acknowledgement,
				  orders.od_shipping_last_name,
				  orders.od_delivery_date,
				  orders.od_delivery_status,
				  assign.order_id
				  
		   FROM ".$cfg['DB_ORDER']." orders 
		   
		   INNER JOIN ".$cfg['DB_ASSIGN_VENDORS']." assign
		   ON orders.od_id = assign.order_id
		   
		   WHERE assign.vendor_id = '".$_REQUEST['vendor_id']."'
		   AND orders.od_acknowledgement = 'Accepeted'
		   ORDER BY `od_id` desc";

$res1=$heart->sql_query($sql1);
$maxrow1=$heart->sql_numrows($res1);

	$row1 = $heart->sql_fetchrow($res1);*/
		
?>
          <option value="01"<? if($_REQUEST['select_month'] == '01') {?> selected="selected" <? }?>>-- January --</option>
		  <option value="02"<? if($_REQUEST['select_month'] == '02') {?> selected="selected" <? }?>>-- February --</option>
          <option value="03"<? if($_REQUEST['select_month'] == '03') {?> selected="selected" <? }?>>-- March --</option>
          <option value="04"<? if($_REQUEST['select_month'] == '04') {?> selected="selected" <? }?>>-- April --</option>
          <option value="05"<? if($_REQUEST['select_month'] == '05') {?> selected="selected" <? }?>>-- May --</option>
          <option value="06"<? if($_REQUEST['select_month'] == '06') {?> selected="selected" <? }?>>-- June --</option>
          <option value="07"<? if($_REQUEST['select_month'] == '07') {?> selected="selected" <? }?>>-- July --</option>
          <option value="08"<? if($_REQUEST['select_month'] == '08') {?> selected="selected" <? }?>>-- August --</option>
          <option value="09"<? if($_REQUEST['select_month'] == '09') {?> selected="selected" <? }?>>-- September --</option>
          <option value="10"<? if($_REQUEST['select_month'] == '10') {?> selected="selected" <? }?>>-- October --</option>
          <option value="11"<? if($_REQUEST['select_month'] == '11') {?> selected="selected" <? }?>>-- November --</option>
          <option value="12"<? if($_REQUEST['select_month'] == '12') {?> selected="selected" <? }?>>-- December --</option>
        </select>
		</td>
		<td width="14%">Select Year:</td>
		<? $start_year = date('Y', strtotime(date()."-30 year"));
			$end_year = date('Y');
		?>
		<td colspan="2">
		<select name="select_year" id="select_year">
		<option value="">-- Select Year --</option>
		<? for($i=$start_year;$i<=$end_year;$i++)
			{ 
	  ?>
		<option value="<?=$i?>"<? if($_REQUEST['select_year'] == $i) {?> selected="selected" <? }?>>-- <?=$i?> --</option>
		<?
		}
		?>
	  </select>
	  </td>
	  <td width="28%" align="right">
		<?
		if($_REQUEST['select_month']!='' || $_REQUEST['select_year']!='')
			{
		?>
		<input type="button" class="msg" onclick="location.href='balance.php?show=view&vendor_id=<?=$_REQUEST['vendor_id']?>&vendor_name=<?=$_REQUEST['vendor_name']?>&vendor_email=<?=$_REQUEST['vendor_email']?>'" value="Clear search" style="cursor:pointer;"/>&nbsp;			  
		<?
			}
		?>
	  <input type="submit" name="submit1" value="Search" class="loginbttn">		  
	  </td>
	  </tr>
	  </table>
	  </td>
	  </tr>
      <tr>
        <td colspan="6" class="row1"><table width="100%">
            <tr>
              <td width="13%" class="leftBarText_new"> Vendor Name: </td>
              <td width="31%"><?=$_REQUEST['vendor_name']?></td>
              <td width="14%" class="leftBarText_new"> Vendor Email ID: </td>
              <td width="42%"><?=$_REQUEST['vendor_email']?></td>
            </tr>
        </table></td>
      </tr>
    </thead>
    <tbody>
      <tr class="headercontent">
        <td width="7%" align="center" class="leftBarText_new1">Order Id </td>
        <td width="17%" align="left" class="leftBarText_new1">Customer Name</td>
        <td width="37%" align="left" class="leftBarText_new1">Product(s) / Quantity</td>
        <td width="13%" align="center" class="leftBarText_new1">Delivery Date </td>
        <td width="14%" align="center" class="leftBarText_new1">Delivery Status </td>
        <td width="12%"align="center" class="leftBarText_new1" >Amount</td>
      </tr>
<?
	  $select_month = $_REQUEST['select_month'];
	  $select_year = $_REQUEST['select_year'];

	  @$con = "";
	  if($select_month!="" || $select_year!="")
	  {	
	  	
		  $con.=" AND orders.od_delivery_date LIKE '".$select_year."-".$select_month."-%'";
		
		
	  }
	  
	   
$sql="SELECT orders.or_pattern,
			 orders.od_id,
			 orders.od_shipping_first_name,
			 orders.od_acknowledgement,
			 orders.od_shipping_last_name,
			 orders.od_delivery_date,
			 orders.od_delivery_status,
			 assign.order_id
				  
		   FROM ".$cfg['DB_ORDER']." orders 
		   
		   INNER JOIN ".$cfg['DB_ASSIGN_VENDORS']." assign
		   ON orders.od_id = assign.order_id
		   
		   WHERE assign.vendor_id = '".$_REQUEST['vendor_id']."'
		   AND orders.od_acknowledgement = 'Accepeted'".$con."
		   ORDER BY `od_id` desc";
$res=$heart->sql_query($sql);
$maxrow=$heart->sql_numrows($res);
$sql = $sql. " LIMIT $offset,$limit";
$res = $heart->sql_query($sql);	   
$totalAmount = 0;
if($maxrow > 0)
{
	while($row = $heart->sql_fetchrow($res))
		{@$i++;
		 $c_id=$row['cust_id'];
		 
		 
?>
      <tr class="row2">
        <td align="left" valign="top"><?=$row['or_pattern']?></td>
        <td align="left" valign="top"><?=$row['od_shipping_first_name']?><?=$row['od_shipping_last_name']?></td>
		<td align="left" valign="top">
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
					   
					    WHERE order_item.od_id = '".$row['od_id']."'
					    AND avail.vendor_id = '".$_REQUEST['vendor_id']."'";
			$res_od = $heart->sql_query($sql_od);
		$maxrow_od = $heart->sql_numrows($res_od);
		if($maxrow_od > 0){
		while($row_od =	$heart->sql_fetchrow($res_od)){
		@$i++;
?>
        
		
		<li><?=pd_name($row_od['pd_id']).' X '.$row_od['od_qty']?> = <b>&#8377;</b>&nbsp;<?=$row_od['price'] * $row_od['od_qty']?></li>
		
        
<?
}}
?>		</td>
        <td align="center" valign="top"><?=date('d/m/Y',strtotime($row['od_delivery_date']))?></td>
        <td align="center" valign="top">
		<? 
		if($row['od_delivery_status'] == 'No'){
		?>
		<a class="notDelivered" style="text-decoration:none">Not Delivered</a>
		<?
		}
		elseif($row['od_delivery_status'] == 'Yes'){
		?>
		<a class="delivered" style="text-decoration:none">Delivered</a>
		<?
		}
		elseif($row['od_delivery_status'] == 'Attempted'){
		?>
		<a class="leftBarText_new" style="text-decoration:none">Attempted</a>
		<?
		}
		$grand_total = total($row['od_id'], $_REQUEST['vendor_id']);
		$subtotal=subTotal($row['od_id']);
		$shopConfig['free_shipping_limit'];
		$shippingCost = ($subtotal>=$shopConfig['free_shipping_limit'])?'0':$shopConfig['shippingCost'];
		?>		</td>
        <td align="right" valign="top">
		<b>&#8377;</b>&nbsp;<?=($grand_total + $shippingCost)?>
		<?
		    $totalAmount = $totalAmount + ($grand_total + $shippingCost);
		?>        </td>
      </tr>
<?
}}
else
{
?>
<tr class="row2">
<td colspan="6" align="center" class="msg">
No Records Found
</td>
</tr>
<?
}
?>
      <tr class="row1">
        <td align="right" colspan="5" class="leftBarText_new">TOTAL</td>
        <td align="right" class="footerTable"><b>&#8377;</b>&nbsp;<?=$totalAmount?></td>
      </tr>
      <tr class="row2">
        <td align="center" colspan="6"><a href="<?=$_SERVER['PHP_SELF']?>" style="text-decoration:none;">&lt;&lt;Back</a> </td>
      </tr>
      <?php /*?> <?
	   						}
	   				}
					
	   else
	   {
	   ?><?php */?>
      <?php /*?><tr class="row2">
	   <td colspan="3" class="msg" align="center">
	   No Records Found	   </td>
	   </tr>
	   <?
	   }
	   ?><?php */?>
    </tbody>
  </table>
  </div>
</form>


		
		
<? 
}
?>	    </td>
        </tr>
		<tr height="16">
		<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;" align="center">		</td>
		</tr>
      </table> 
      </td>   
	  
    </tr>
	<tr><td colspan="3" align="right"></td></tr>
  </table>
