<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}

page_header($cfg['ADMIN_TITLE']." - Sales History Management");

$show=$_REQUEST['show'];
 $month=$_REQUEST['month'];
 $year=$_REQUEST['year'];

?>


<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/epoch_styles.css" />

<script language="javascript" src="scripts/common.js"></script>

<script type="text/javascript" src="scripts/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">
/*You can also place this code in a separate file and link to it like epoch_classes.js*/
var dp_cal_frm;   
var dp_cal_to;    
window.onload = function () {
	dp_cal_frm  = new Epoch('epoch_popup','popup',document.getElementById('frmdate'),false);
	dp_cal_to  = new Epoch('epoch_popup','popup',document.getElementById('todate'),false);
};

function check()
{
	if(document.getElementById("month").value=='' && document.getElementById("year").value=='' )
	{
	   alert('Please enter at least one field');

	   return false;
	}
}	
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
     
	 <table width="698" align="center" border="0"cellspacing="0" cellpadding="0" bgcolor="#0F0F0F" style="background:url(images/welcome_head.jpg) center top no-repeat;">
	  <tr height="35" >
	  <td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome 
  <?=$_SESSION['admin_user_name']?>
</span></td>
	  <td align="right" valign="middle" class="style5"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" /></a>&nbsp;&nbsp;</td>
	  </tr>
	  <tr height="16">
	  <td colspan="2" align="left" valign="middle" bgcolor="#CFCFCF">&nbsp;</td>
	  </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#CFCFCF">
		  <!--  Default View Start  -->
		  <form method="post" name="frmsale" id="frmsale" action="sales.php" ><!--onsubmit="return chk_date();">-->
		  <input type="hidden" name="show" value="detail" />
		  <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;Sales History </td>
            </tr>
          </thead>
          <tbody>
            
            <tr class="row1">
              <td colspan="3" align="left" class="leftBarText_new">I need the sales report, </td>
            </tr>
            <tr class="row2">
              <td width="45%" align="left" valign="top" class="leftBarText_new">From : 
					<input name="frmdate" type="text" class="forminputelement" id="frmdate" value="<?=($_REQUEST['frmdate']!="")?$_REQUEST['frmdate']:''?>" />
					<input value="pick" class="btnModify" onclick="dp_cal_frm.toggle();" type="button">
				</td>
              <td width="41%" align="left" valign="top" class="leftBarText_new">To : 
					<input name="todate" type="text" class="forminputelement" id="todate" value="<?=($_REQUEST['todate']!="")?$_REQUEST['todate']:''?>" />
					<input value="pick" class="btnModify" onclick="dp_cal_to.toggle();" type="button">
				</td>
              <td width="14%" align="center" valign="bottom">
			  <input name="button1" type="submit" class="btnModify" value="Go"  onclick="return chk_date();"/></td>
            </tr>
			
			<tr class="row1">
              <td colspan="3" align="left" class="leftBarText_new">I need the sales report on the basis of month and year, </td>
            </tr>
            <tr class="row2">
              <td width="45%" align="left" valign="top" class="leftBarText_new">Month : 
			  
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
				</select>				
					
				</td>
				
              <td width="41%" align="left" valign="top" class="leftBarText_new">Year :  
			   <select name="year" class="forminputelement" id="year" >
			    <option value="">Select Year</option>
			  	<? for($i = 1990; $i <=2020; $i++){?>
			  	<option value="<?=$i?>" <?=($year==$i )?'selected="selected"':''?>><?=$i?></option>
				<? }?>
				</select>
				</td>
              <td width="14%" align="center" valign="bottom">
			  <input name="button2" type="submit" class="btnModify" value="Go"  onclick="return check();"/></td>
            </tr>
			
			<tr>
              <td class="leftBarText_new" align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
          </tbody>
        </table>
		</form>
		  <!--  Default View End  -->
		  <p></p>
		  <p></p>
	  <? //show all record
	   if($_REQUEST['show']=='detail')
	   {
		   $fDate = explode("/",$_REQUEST['frmdate']);
		   $frmDate = $fDate['2'].'-'.$fDate['0'].'-'.$fDate['1'];
		 
		 
		$month=$_REQUEST['month'];
		$year=$_REQUEST['year'];
		$qry1='';
     	$qry2='';
		$qry3='';
		 
	    if($month!='' && $year=='')
		{
			$qry1=" AND `od_date`LIKE '%-".$month."-%'";
		}
		   
		if($year!='' && $month=='')
		{
			$qry2=" AND `od_date`LIKE '".$year."-%-%'";
		}
		if($year!='' && $month!='')
		{
			$qry3=" AND `od_date`LIKE '%-".$month."-%' AND `od_date`LIKE '".$year."%-%'";
		}   
		   
		   
		   
		   
		   
		   if($_REQUEST['todate']==""){
	   		$toDate = date("Y-m-d");
	   }else{
		   $tDate = explode("/",$_REQUEST['todate']);
		   $toDate = $tDate['2'].'-'.$tDate['0'].'-'.$tDate['1'];
		   
	   }
	   ?>
	    <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="5" align="left">&nbsp;<span class="style2">Sales History List </span> </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="5" align="right" class="leftBarText_new1">&nbsp;</td>
            </tr>
            <tr class="headercontent">
              <td width="15%" align="center" class="leftBarText_new1">Sl No </td>
              <td width="16%" align="left" class="leftBarText_new1">Order ID   </td>
              <td width="31%" align="center" class="leftBarText_new1">Date</td>
              <td width="19%" align="right" class="leftBarText_new1">Amount (<?=currency_symbol()?>)</td>
              <td width="19%" align="center" class="leftBarText_new1">Status</td>
              </tr>
		  <?
		   if(isset($_REQUEST['button2']))	   
		   
		   {
			  $sql="SELECT * FROM ".$cfg['DB_ORDER']."WHERE `od_status`='Completed' $qry1 $qry2 $qry3 ORDER BY `od_id`";
			}		  
		  if(isset($_REQUEST['button1']))
		  {		
			  $sql="SELECT * FROM ".$cfg['DB_ORDER']."WHERE `od_status`='Completed' AND `od_date` between '".$frmDate."' and '".$toDate."' ORDER BY `od_id`";
		  }
			 $res=$heart->sql_query($sql);
			 $maxrow=$heart->sql_numrows($res);
			 if($maxrow >0){
			 while($row=$heart->sql_fetchrow($res)){
			 @$i++;
			 echo $subtotal=subTotal($row['od_id']);
			// echo $shopConfig['free_shipping_limit'];
			 $shippingCost = ($subtotal>=$shopConfig['free_shipping_limit'])?'0':$shopConfig['shippingCost'];
			 $total += ($subtotal + $shippingCost);
			?>
            <tr class="<?=($i%2==0)?'row1':'row2'?>">
              <td align="center"><?=$i+$offset?></td>
              <td align="left" class="linkTitle"><a href="order.php?show=view&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>" target="new"># <?=$row['od_id']?></a></td>
              <td align="center"><?=getdataformat($row['od_date']);?></td>
              <td align="right"><?=($subtotal + $shippingCost)?>.00</td>
              <td align="center"><?=$row['od_status']?></td>
              </tr>
			<? }?>
			<tr>
              <td width="15%" align="center" class="leftBarText_new1"><a href="view_sales.php?frm=<?=$frmDate?>&to=<?=$toDate?>" target="_blank">Print Preview</a> </td>
              <td width="16%" align="left" class="leftBarText_new1">&nbsp;</td>
              <td width="31%" align="right" class="commontxtnew">Total</td>
              <td width="19%" align="right" class="commontxtnew"><?=$total?>.00</td>
              <td width="19%" align="center" class="leftBarText_new1">&nbsp;</td>
             </tr>
			<? }else{?>
            <tr class="row2">
              <td colspan="5" align="center" class="msg">No Record.</td>
            </tr>  
			<? }?>
						 
			<tr>
			  <td colspan="5" align="right" class="media1">&nbsp;</td>
		    </tr>
          </tbody>
        </table>
		<? }?>
	  

          </td>
        </tr>
		<tr height="16">
		<td colspan="2" background="images/foot_bg.jpg">&nbsp;</td>
		</tr>
      </table> 
      </td>   
	  
    </tr>
	<tr><td colspan="3" align="right"></td></tr>
  </table>
