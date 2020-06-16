<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes_webmaster/function.php');

if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==4) { $msg='Order Updated';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Product Management");
$category=($_REQUEST['category']!="")?$_REQUEST['category']:'';
$pageno =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/product.js"></script>
<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>

<script language="javascript" type="text/javascript">

</script>
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/ddaccordion.js"></script>
<style type="text/css">
<!--
.style3 {
	color: #FFFFFF
}
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
          <tr height="35" >
          <td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
              <?=$_SESSION['admin_user_name']?>
              </span>               
             </td>
            <td align="right" valign="middle" class="style5">
			<?
			 	$sql="SELECT * FROM ".$cfg['DB_SITE']."";
				$res=$heart->sql_query($sql);				
			 ?>
                <select name="" id="" onchange="getSes1(this.value);" class="forminputelement">
                  <? while($row=$heart->sql_fetchrow($res)){?>
                  <option value="<?=$row['s_id']?>" <? if($cfg['SESSION_SITE']==$row['s_id']){?> selected="selected"<? }?>>
                  <?=$row['s_name']?>
                  </option>
                  <? }?>
                </select>
				&nbsp;&nbsp;&nbsp;
			<a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;" /></a>&nbsp;&nbsp;
			</td>
            <?php /*?><!--<td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
              <?=$_SESSION['admin_user_name']?>
              </span></td>
            <td  width="56"align="right" valign="middle"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>--><?php */?>
          </tr>
          <tr height="16">
            <td colspan="2" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" style="background-color:#eee8e8;" align="center">
			<? //show all record
	   if($_REQUEST['show']==''){
	   ?>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="4" align="left">&nbsp;<span class="style2">Cart Section</span>&nbsp;</td>
                    <td colspan="9" align="right">
					<form name="frmsearch" id="frmsearch" action="cartView.php" method="post">
                        <input type="hidden" name="category" id="category" value="<?=$_REQUEST['category']?>" />
                        <input type="hidden" name="searchname" id="searchname" value="search" />
                        <input type="text" name="search_val" id="search_val" class="forminputelement" value="<?=$_REQUEST['search_val']?>" />
                        &nbsp;
                        <input type="submit" name="prodsearch"  class="loginbttn" value="Go" />
                        &nbsp;
                      </form></td>
                  </tr>
                </thead>
                <form name="frm1" id="frm1" action="cartView_process.php" method="post">
                  <input type="hidden" name="act" id="act" value="order" />
                  <input type="hidden" name="cat_returnid" id="cat_returnid" value="<?=$_REQUEST['category']?>" />
                  <? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
                  <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row1">
                      <td colspan="12" align="right" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <tr class="headercontent">
                      <td width="8%" align="center" class="leftBarText_new1">Sl No </td>
                      <td width="8%" align="center" class="leftBarText_new1">cart Id </td>
                      <td align="left" class="leftBarText_new1" colspan="2">Product Name [#ID]</td>
                      <td align="center" class="leftBarText_new1" colspan="3">Product Image</td>
                      <td width="10%" align="center" class="leftBarText_new1">Quantity</td>
                      <td width="10%" align="center" class="leftBarText_new1">Price</td>
                      <td width="10%" align="center" class="leftBarText_new1">Total Price</td>
                      <td width="9%" align="center" class="leftBarText_new1">preference</td>
                    </tr>
    <? 
		if(isset($_REQUEST['prodsearch']))
		{
				if($_REQUEST['searchname']=='search')
				{
			  			$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  (`pd_name` LIKE '%".$_REQUEST['search_val']."%' OR `location` LIKE '%".$_REQUEST['search_val']."%' OR `pd_code` LIKE '%".$_REQUEST['search_val']."%')  AND `siteId`= '".$cfg['SESSION_SITE']."' ".$search_query;
				}
		}
		else
		{
			$sql = "SELECT ct_id, ct.delivar_date,ct.pd_id,pd.pd_code,ct.siteId,ct.preference,ct.num_price, ct_qty, pd_name, pd_price, pd_image, pd.category,ct.shipping_type_charges
         FROM ".$cfg['DB_CART']." ct, ".$cfg['DB_PRODUCT']." pd
         WHERE ct.pd_id = pd.pd_id AND ct.siteId ='".$_SESSION['site']."'" ;   
		}
	
		$res=$heart->sql_query($sql);
		$maxrow=$heart->sql_numrows($res);

		if(!isset($_REQUEST['prodsearch']))
		{
			 $sql = $sql. " LIMIT $offset,$limit";
			 $res = $heart->sql_query($sql);
		}
		if($maxrow >0)
		{
			 while($row=$heart->sql_fetchrow($res)){
			 @$i++;
		?>
				<tr class="<?=($i%2==0)?'row1':'row2'?>">
				  <td align="center" valign="top"><?=$i+$offset?></td>
				  <td align="center" valign="top"><?=$row['ct_id']?></td>
				  <td colspan="2" align="left" valign="top" >&nbsp;
					<?=$row['pd_name']?>&nbsp;&nbsp;[#<?=$row['pd_id']?>
					]</td>
				  <td colspan="3" align="center" valign="top" ><img src="../<?=$cfg['PRODUCT_IMAGES'].$row['pd_image']?>"  width="70" align="top"/></td>
				 <td align="center" valign="top"><?=$row['ct_qty']?></td>
				 <?
				 if($row['num_price']!=0)
				 {
				 	$totalPrice = round($row['ct_qty']*$row['num_price']);
				 	?>
				 	<td align="center" valign="top"><?=$row['num_price']?></td>
				 	<?
				 }
				 else
				 {
				 	$totalPrice = round($row['ct_qty']*$row['pd_price']);
				 	?>
				 	 <td align="center" valign="top"><?=$row['pd_price']?></td>
				 	<?

				 }
				 ?>
				 
				   <td align="center" valign="top"><?=$totalPrice?></td>
				   <td align="center" valign="top"><?=$row['preference']?></td>
				</tr>
	<? }
	   } 
	   else 
	   {?>
                <tr class="row1">
                      <td colspan="12" align="center" class="msg">No Record.</td>
                    </tr>
	<? } ?>
</tbody>
                </form>
              </table>
              <div class="bottomsecc">
				<div class="pagisecc">
                <? if(!isset($_REQUEST['prodsearch'])){ ?>
                <?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
                <? } ?>
              
              </div>
			  </div>
              <? }
		
		
	
		// add new customer
		
		
		
		/* Stary Brand */
		
		
	  
	  /* end brand */
	  
	 ?>
            </td>
          </tr>
          <tr height="16">
            <td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="right"></td>
    </tr>
  </table>
<?
/*	
function countRightbar()
{
	global $cfg,$heart;
	//$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_rightbar`='A' ";
	//$res=$heart->sql_query($sql);
	//$num=$heart->sql_numrows($res);	
	return $num;	
	
}
*/
?>