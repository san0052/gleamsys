<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==4) { $msg='Order Updated';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Pincode Management");
$category=($_REQUEST['category']!="")?$_REQUEST['category']:'';
$pageno =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/pincode.js"></script>
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
                    <td colspan="4" align="left">&nbsp;<span class="style2">Delivery Pincode Section</span>&nbsp;</td>
                    <td colspan="9" align="right">
					<form name="frmsearch" id="frmsearch" action="delPincode.php" method="post">
                        <input type="hidden" name="category" id="category" value="<?=$_REQUEST['category']?>" />
                        <input type="hidden" name="searchname" id="searchname" value="search" />
                        <input type="text" name="search_val" id="search_val" class="forminputelement" value="<?=$_REQUEST['search_val']?>" />
                        &nbsp;
                        <input type="submit" name="prodsearch"  class="loginbttn" value="Go" />
                      </form></td>
                  </tr>
                </thead>
                <form name="frm1" id="frm1" action="delPincode_process.php" method="post">
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
                      <td width="5%" align="center" class="leftBarText_new1">
					  <input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
                      <td width="8%" align="center" class="leftBarText_new1">Sl No </td>
                      <td width="8%" align="center" class="leftBarText_new1">Post Office Name </td>
                      <td align="left" class="leftBarText_new1">Pincode</td>
                      <td align="center" class="leftBarText_new1">City</td>
                      <td width="10%" align="center" class="leftBarText_new1">Suburb</td>
                      <td width="10%" align="center" class="leftBarText_new1">State</td>
                       <td width="10%" align="center" class="leftBarText_new1">Delivery Charges</td>
                      <td width="9%" align="center" class="leftBarText_new1">Status</td>
                      <td width="14%" align="center" class="leftBarText_new1">Action</td>
                    </tr>
    <?  if($_REQUEST['category']!='')
	    {
		  		$search_query="AND `category`=".$_REQUEST['category']."";
		}
		else
		{
				
		  		$search_query='';
		  
		}
		if(isset($_REQUEST['prodsearch']))
		{
				if($_REQUEST['searchname']=='search')
				{
			  			$sql="SELECT * FROM ".$cfg['DB_PINCODES']." WHERE  (`PostOfficeName` LIKE '%".$_REQUEST['search_val']."%' OR `Pincode` LIKE '%".$_REQUEST['search_val']."%' OR `City` LIKE '%".$_REQUEST['search_val']."%' OR `District` LIKE '%".$_REQUEST['search_val']."%'  OR `State` LIKE '%".$_REQUEST['search_val']."%') ".$search_query;
				}
		}
		else
		{
			$sql="SELECT * FROM ".$cfg['DB_PINCODES']." WHERE `status`!='D' ORDER BY `id` ASC";
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
				  <td align="center" valign="top"><input  name="checkvalue" id="checkvalue"  value="<?=$row['id']?>" type="checkbox" /></td>
				  <td align="center" valign="top"><?=$i+$offset?></td>
				  <td align="center" valign="top"><?=$row['PostOfficeName']?></td>
				  <td align="center" valign="top"><?=$row['Pincode']?></td>
				  <td align="center" valign="top"><?=$row['City']?></td>
				  <td align="center" valign="top"><?=$row['District']?></td>
				  <td align="center" valign="top"><?=$row['State']?></td>
          <td align="center" valign="top"><?=$row['delivery_charges'];?></td>
				  
				  <td align="center" valign="top">&nbsp;<a href="delPincode_process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>">
					<?=($row['status']=='A')?'Active':'Inactive'?>
					</a></td>
				  <td align="center" valign="top">
					<a href="delPincode.php?show=edit&id=<?=$row['id']?>&pageno=<?=$pageno?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
					<a href="delPincode_process.php?act=del&id=<?=$row['id']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a><br />
					</td>
					
				</tr>
	<? }
	   } 
	   else 
	   {?>
                <tr class="row1">
                      <td colspan="12" align="center" class="msg">No Record.</td>
                    </tr>
	<? } ?>
		<tr >
                      <td colspan="10" align="left" class="redbuttonelements"><? if($_REQUEST['main']!='')
			{
			?>
                        <a style="color:#FFFFFF;" href="delPincode.php?category=<?=$_REQUEST['category']?>&pageno=<?=$_REQUEST['page']?>" class="back">&lt;&lt;back</a>
                        <? } ?>
                        &nbsp;
                        <?  if($maxrow >0){ ?>
                        <select name="dropdown1" class="forminputelement">
                          <option value="">Choose an action... </option>
                          <option value="delete">Delete</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                        </select>
                        <input value="Apply to selected"  name="submit" type="button" onclick="return validation1('<?=$category?>','<?=$pageno?>');" class="loginbttn"/>
                        <? } ?>
                      </td>
                    </tr>
</tbody>
                </form>
              </table>
              <div class="bottomsecc">
				<div class="pagisecc">
                <? if(!isset($_REQUEST['prodsearch'])){ ?>
                <?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
                <? } ?>
               </div>
                  <? if($_REQUEST['main']=='')
			{ ?>
                  <a class="brownbttn" href="delPincode.php?show=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">Add New Pincode</a>
                  <? } ?>
                
              </div>
              <? }
		
		
	
		// add new customer
		
		
		
		/* Stary Brand */
		
		
	  if($show=='add') { ?>
              <form name="frmadd" method="post" action="delPincode_process.php" id="frmadd" enctype="multipart/form-data" onsubmit="return pincode_add(this)">
                <p>
                  <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
                  <input type="hidden" name="act" value="insert" />
                  <input type="hidden" name="prod_add_valid" value=""  id="prod_add_valid"/>
                  <input type="hidden" name="type_check" value=""  id="type_check"/>
                </p>
                <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="5" align="left" class="style2">&nbsp;Add Pincode Section </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row2">
                      <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
					
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Post Office Name</span> <span class="redstar">*</span></td>
                      <td width="70%" colspan="4" align="left"><input name="post_office_name" type="text" class="forminputelement" id="post_office_name" value=""/></td>
                    </tr>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Pincode</span><span class="redstar">*</span> </td>
                      <td width="70%" colspan="4" align="left"><input name="pincode" type="text" class="forminputelement" id="pincode" value=""/></td>
                    </tr>
                     <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span><span class="redstar">*</span> </td>
                      <td width="70%" colspan="4" align="left"><input name="city" type="text" class="forminputelement" id="city" value=""/></td>
                    </tr>
                     <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">District</span><span class="redstar">*</span> </td>
                      <td width="70%" colspan="4" align="left"><input name="district" type="text" class="forminputelement" id="district" value=""/></td>
                    </tr>
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">State</span><span class="redstar">*</span> </td>
                      <td width="70%" colspan="4" align="left"><input name="state" type="text" class="forminputelement" id="state" value=""/></td>
                    </tr>
                     <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Country</span><span class="redstar">*</span> </td>
                      <td width="70%" colspan="4" align="left"><input name="country" type="text" class="forminputelement" id="country" value=""/></td>
                    </tr>

                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Delivery Charges</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="delivery_charges_add" type="text" class="forminputelement" id="delivery_charges_add" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" /></td>
                  </tr> 
					       <tr>
                    
                    <td colspan="4" align="center">
						<a href="delPincode.php?category=<?=$_REQUEST['category']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" class="brownbttn">&lt;&lt;back</a>
						<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
					</td>
                  </tr>
                  </tbody>
                  
                </table>
             </form>
              <? }
	  
	  /* end brand */

		
	  // edit customer details
	  if($show=='edit'){
	  
	  		$sql1="SELECT * FROM ".$cfg['DB_PINCODES']." WHERE  `id` =".$_REQUEST['id']." ";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);

	  ?>
              <form name="frmedit" method="post" action="delPincode_process.php" id="frmedit" enctype="multipart/form-data" onsubmit="return product_edit(this)">
                <p>
                  <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
                  <input type="hidden" name="act" value="update" />
                  <input type="hidden" name="id" value="<?=$row1['id']?>" />
                  <input type="hidden" name="prod_edit_valid" value=""  id="prod_edit_valid"/>
                  <input type="hidden" name="type_check_edit" value=""  id="type_check_edit"/>
                </p>
                <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">

                  <thead>
                    <tr>
                      <td colspan="5" align="left" class="style2">&nbsp;Edit Pincode Section </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row2">
                      <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Post Office Name</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="post_office_name" type="text" class="forminputelement" id="post_office_name" value="<?=$row1['PostOfficeName']?>"/></td>
                  </tr>
                   <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Pincode</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="pincode" type="text" class="forminputelement" id="pincode" value="<?=$row1['Pincode']?>"/></td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="city" type="text" class="forminputelement" id="city" value="<?=$row1['City']?>"/></td>
                  </tr>
                   <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">District</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="district" type="text" class="forminputelement" id="district" value="<?=$row1['District']?>"/></td>
                  </tr> 
                   <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">State</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="state" type="text" class="forminputelement" id="state" value="<?=$row1['State']?>"/></td>
                  </tr> 
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Delivery Charges</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="delivery_charges" type="text" class="forminputelement" id="delivery_charges" value="<?=$row1['delivery_charges']?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" /></td>
                  </tr>     
                		  
                    <tr>
                      
                      <td colspan="4" align="center">
          						<a href="delPincode.php?category=<?=$_REQUEST['category']?>&page=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?><? if($row1['mainaddon']!=0){?>&main=<?=$row1['mainaddon']?><? } ?>" class="brownbttn">&lt;&lt;back</a>
          						<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
                      </td>
                    </tr>
                    </thead>
                    
                </table>
              </form>
              <? 
	             } 
	  
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

?>