<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$frmDate = $_REQUEST['frm'];
$toDate = $_REQUEST['to'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Sales History</title>
<style type="text/css">
<!--
body {
	margin:5px 0;
	background:#FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
}
.style1 {	
	color: #FF2000;
	font-weight: bold;
	font-size: 16px;
}
.style2 {	
	color: #CCCCCC;
	font-size: 12px;
	text-decoration:none;
}
.style2:hover {
	text-decoration:underline;
}
.style3 {
	color:#333333;
	font-size: 16px;
	font-weight: bold;
}
.style4 {
	font-size:12px;
}
.style5 {	
	font-size: 14px;
	color: #DB231B;
	font-weight: bold;
}
.style6 {	
	font-size:13px;
	color:#003399;
	vertical-align:top;
	font-weight:bold;
}
.style7 {font-size: 9px}
.tablebg {background:#EBEBEC;}
.tdbg {
	background:#FFFFFF;
	font-size:13px;
}
.cellpadding {padding:5px;}
-->
</style>
</head>

<body>
<center>
<table width="778" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="26%" align="left" valign="top" bgcolor="#EBEBEC" class="cellpadding"><!--<img src="images/logo.gif" alt="" width="195" height="176" />--></td>
    <td colspan="3" align="left" valign="top" bgcolor="#EBEBEC" style="padding:10px;">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="cellpadding"><span class="style1">Heart2Heart</span><br /> 
	<span class="style4">Online Sales History Report</span><br />
	<span class="style4">From <strong><?=$frmDate?></strong> to <strong><?=$toDate?></strong></span></td>
    <td width="17%">&nbsp;</td>
    <td width="40%" align="right" valign="top" class="style4 cellpadding"><strong>Date :</strong>
        <?=date("Y-m-d")?>
      &nbsp;&nbsp;<strong>Time :</strong>
      <?=date("h:i:s")?>    </td>
  </tr>
  <tr>
    <td colspan="4"><table width="100%" border="0" cellspacing="1" cellpadding="5" class="tablebg">
      <tr>
        <td align="center" class="style6">Sl No</td>
        <td align="center" class="style6">Order ID (#) </td>
        <td align="center" class="style6">Date</td>
        <td align="right" class="style6">Amount (<?=currency_symbol()?>)</td>
        <td align="center" class="style6">Status</td>
      </tr>
		 <? 
		    $sql="SELECT * FROM ".$cfg['DB_ORDER']."WHERE `od_date` between '".$frmDate."' and '".$toDate."' ORDER BY `od_id`";
			 $res=$heart->sql_query($sql);
			 $maxrow=$heart->sql_numrows($res);
			 if($maxrow >0){
			 while($row=$heart->sql_fetchrow($res)){
			 @$i++;
			 $subtotal=subTotal($row['od_id']);
			 $shopConfig['free_shipping_limit'];
			 $shippingCost = ($subtotal>=$shopConfig['free_shipping_limit'])?'0':$shopConfig['shippingCost'];
			 $total += ($subtotal + $shippingCost);
			?>
      <tr>
        <td align="center" class="tdbg"><?=$i+$offset?></td>
        <td align="center" class="tdbg"><?=$row['od_id']?></td>
        <td align="center" class="tdbg"><?=getdataformat($row['od_date']);?></td>
        <td align="right" class="tdbg"><?=($subtotal + $shippingCost)?>.00</td>
        <td align="center" class="tdbg"><?=$row['od_status']?></td>
      </tr>
      <? }?>
	  <tr>
        <td align="center" class="tdbg">&nbsp;</td>
        <td align="center" class="tdbg">&nbsp;</td>
        <td align="right"><span class="style6">Total</span></td>
        <td align="right"><span class="style6"><?=$total?>.00</span></td>
        <td align="center" class="tdbg">&nbsp;</td>
      </tr>
	  <? }?>
    </table></td>
  </tr>
  <tr>
    <td align="left"><a class="style2" href="#" onclick="window.close();">CLOSE</a></td>
    <td colspan="2">&nbsp;</td>
    <td align="right"><a href="#" class="style2" onclick="window.print();">PRINT</a></td>
  </tr>
</table>
</center>
</body>
</html>
