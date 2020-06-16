<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==4) { $msg='Order Updated';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Product Management");
$category=($_REQUEST['category']!="")?$_REQUEST['category']:'';
$pageno =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];

/*
function countRightbar()
{
	global $cfg,$heart;$num;
	$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_rightbar`='A' ";
	$res=$heart->sql_query($sql);
	$num=$heart->sql_numrows($res);	
	return $num;	
	
}
*/
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
<!--<script type="text/javascript">
ddaccordion.init({
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>-->
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
                <select name="" id="" onChange="getSes1(this.value);" class="forminputelement">
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
            <td colspan="2" style="background-color:#eee8e8;" align="center"><? //show all record
	   if($_REQUEST['show']==''){
	   ?>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="6" align="left">&nbsp;<span class="style2">Addon Product Section</span>&nbsp;</td>
                    <td colspan="6" align="right">
					<form name="frmsearch" id="frmsearch" action="addon.php" method="post">
                        <input type="hidden" name="category" id="category" value="<?=$_REQUEST['category']?>" />
                        <input type="hidden" name="searchname" id="searchname" value="search" />
						<input type="hidden" name="addon" id="addon" value="addon" />
                        <input type="text" name="search_val" id="search_val" class="forminputelement" value="<?=$_REQUEST['search_val']?>" />
                        &nbsp;
                        <input type="submit" name="prodsearch"  class="loginbttn" value="Go" />
                        &nbsp;
                       
                      </form></td>
                  </tr>
                </thead>
                <form name="frm1" id="frm1" action="product_process.php" method="post">
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
					  <input name="check_all" id="check_all" class="check-all" type="checkbox" onClick="checkall();"/></td>
                      <td width="8%" align="center" class="leftBarText_new1">Sl No </td>
                      <td width="8%" align="center" class="leftBarText_new1">Db Id </td>
                      <td align="left" class="leftBarText_new1" colspan="2">Product Name [#ID]</td>
                      <td align="center" class="leftBarText_new1" colspan="3">Product Image</td>
                      <td width="13%" align="center" class="leftBarText_new1">Order &nbsp;
                        <input type="image" src="images/1308660287_order.png"  name="save" value="Save" title="Save" align="absmiddle" />
                      </td>
                      <td width="10%" align="center" class="leftBarText_new1">Price</td>
                      <td width="10%" align="center" class="leftBarText_new1">Unit Price</td>
                      <td width="10%" align="center" class="leftBarText_new1">Delivery By</td>
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
			  			$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  (`pd_name` LIKE '%".$_REQUEST['search_val']."%' OR `location` LIKE '%".$_REQUEST['search_val']."%' OR `pd_code` LIKE '%".$_REQUEST['search_val']."%')  AND `siteId`= '".$cfg['SESSION_SITE']."' ".$search_query;
				}
		}
		else
		{
				if($_REQUEST['main']!='')
				{
				 		$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `siteId`= '".$cfg['SESSION_SITE']."' AND `isAddon` =".$_REQUEST['main']."";
				}
			
				else
				{ 
									
						if($_REQUEST['category']=='' || $_REQUEST['category']=='0')
						{
							 $sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `isAddon` ='Y' AND `status`!='D' AND `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `order` ASC";
						}
						if($_REQUEST['category']=='all' || $_REQUEST['location']=='all' || $_REQUEST['occasion']=='all' || $_REQUEST['color']=='all')
						{
							 $sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `isAddon` ='Y' AND `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `order` ASC";
						}
						if($_REQUEST['category']!='' && $_REQUEST['category']!='all')
						{
						
						//echo
					//	 $sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` IN( CASE ".getProductId($_REQUEST['category'])." WHEN '' THEN 0 ELSE '".getProductId($_REQUEST['category'])."' END ) AND `mainaddon` ='0' AND `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `order` ASC";
						 
						 
						 //echo
						 	$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` IN(".getProductId($_REQUEST['category']).") AND `isAddon` ='Y' AND `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `order` ASC";
						}
						
				}
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
			 $sql_Delivery="SELECT * FROM ".$cfg['DB_EARLIEST_DELIVERYBY']." WHERE  `id` =".$row['earliest_deliveryId']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
	  		 $res_Delivery=$heart->sql_query($sql_Delivery);
			 $row_Delivery=$heart->sql_fetchrow($res_Delivery);
		?>
				<tr class="<?=($i%2==0)?'row1':'row2'?>">
				  <td align="center" valign="top"><input  name="checkvalue" id="checkvalue"  value="<?=$row['pd_id']?>" type="checkbox" /></td>
				  <td align="center" valign="top"><?=$i+$offset?></td>
				  <td align="center" valign="top"><?=$row['pd_id']?></td>
				  <td colspan="2" align="left" valign="top" >&nbsp;
					<?=$row['pd_name']?>&nbsp;&nbsp;[#<?=$row['pd_id']?>
					]</td>
				  <td colspan="3" align="center" valign="top" ><img src="../<?=$cfg['PRODUCT_IMAGES'].$row['pd_image']?>"  width="70" align="top"/></td>
				  <td align="center" valign="top" class="leftBarText"><input name="catorder[<?=$row['pd_id'];?>]" type="text" class="forminputelement" id="catorder[<?=$row['pd_id'];?>]"  size="2" value="<?=$row['order'];?>" style="text-align:center;"/></td>
				  <td align="center" valign="top"><?=$row['pd_price']?></td>
				  <td align="center" valign="top"><?=$row['pd_unit_price']?></td>
				   <td align="center" valign="top"><?=$row_Delivery['name']?></td>
				  <td align="center" valign="top">&nbsp;<a href="product_process.php?act=<?=($row['status']=='A')?'Inactive_addon':'Active_addon'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['pd_id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>">
					<?=($row['status']=='A')?'Active':'Inactive'?>
					</a></td>
				  <td align="center" valign="top"><? if($row['isAddon']!='N'){ ?>
					<a href="addon.php?show=view_addon&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['pd_id']?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a>
					<? }else{?>
					<a href="addon.php?show=view&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['pd_id']?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a>
					<? }?>
					<? if($row['isAddon']!='Y'){ ?>
					<a href="addon.php?show=edit_addon&id=<?=$row['pd_id']?>&pageno=<?=$pageno?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
					<? } else {?>
					<a href="addon.php?show=edit&id=<?=$row['pd_id']?>&pageno=<?=$pageno?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
					<? }?>
					<a href="product_process.php?act=del_addon&category=<?=$category?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['pd_id']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a><br />
					<? if(addonval($row['pd_id'])!=0){ ?>
					<br />
					<a href="addon.php?main=<?=$row['pd_id']?>&page=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&category=<?=$_REQUEST['category']?>">Add-On</a>
					<? } ?></td>
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
                        <a class="brownbttn" href="addon.php?category=<?=$_REQUEST['category']?>&pageno=<?=$_REQUEST['page']?>" class="back">&lt;&lt;back</a>
                        <? } ?>
                        &nbsp;
                        <?  if($maxrow >0){ ?>
                        <select name="dropdown1" class="forminputelement">
                          <option value="">Choose an action... </option>
                          <option value="delete">Delete</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                        </select>
                        <input value="Apply to selected"  name="submit" type="button" onClick="return validation2('<?=$category?>','<?=$pageno?>');" class="loginbttn"/>
                        <? } ?>
						
                      <td colspan="1" align="right" class="redbuttonelements"></td>
                    </tr>
</tbody>
                </form>
              </table>
              <div class="bottomsecc">
				<div class="pagisecc">
                <? if(!isset($_REQUEST['prodsearch'])){ ?>
                <?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
                <? } ?>
				<div class="clearfix"></div>
				</div>
                <div class="clearfix"></div>
                  <? if($_REQUEST['main']=='')
			{ ?>
                  <a class="brownbttn" href="addon.php?show=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">Add New Addon Product </a>
                  <? } ?>
                
              </div>
              <? }
		
		
	
		// add new customer
		
		
		
		/* Stary Brand */
		
		
	  if($show=='add') { ?>
              <form name="frmadd" method="post" action="product_process.php" id="frmadd" enctype="multipart/form-data" onSubmit="return product_add1(this)">
                <p>
                  <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
                  <input type="hidden" name="act" value="insert" />
                  <input type="hidden" name="prod_add_valid" value=""  id="prod_add_valid"/>
                  <input type="hidden" name="type_check" value=""  id="type_check"/>
				  <input type="hidden" name="act" value="add_addon" />
				  <input type="hidden" name="addon" value="addon" />
                </p>
                <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="5" align="left" class="style2">&nbsp;Add Addon Product Section </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row2">
                      <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    
             
				
				
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="redstar">*</span></td>
                      <td width="70%" colspan="4" align="left"><input name="prod_pname_add" type="text" class="forminputelement" id="prod_pname_add"  value="" /></td> 
                    </tr>
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="redstar">*</span></td>
                      <td width="70%" colspan="4" align="left"><input name="prod_price_add" type="text" class="forminputelement" id="prod_price_add" value=""/></td>
                    </tr>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Strik Through Price</span> </td>
                      <td width="70%" colspan="4" align="left"><input name="sprod_price_add" type="text" class="forminputelement" id="sprod_price_add" value=""/></td>
                    </tr>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Discount</span> </td>
                      <td width="70%" colspan="4" align="left"><input name="discount" type="text" class="forminputelement" id="discount" value=""/></td>
                    </tr>
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Disclaimer</span> <span class="redstar">*</span></td>
                      <td width="70%" colspan="4" align="left"><select name="prod_dis" id="prod_dis" class="forminputelement" >
                          <option value="0" >Select Disclaimer</option>
                          <?
						$sqlloc2="SELECT * FROM ".$cfg['DB_DISCLAIMER']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
						$resloc2=$heart->sql_query($sqlloc2);
						while($rowloc2=$heart->sql_fetchrow($resloc2))
						{  ?>
                          <option value=<?=$rowloc2['d_id']?> >
                          <?=stripslashes($rowloc2['title'])?>
                          </option>
                          <? } ?>
                        </select>
                      </td>
                    </tr>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Notes</span> <span class="redstar">*</span></td>
                      <td width="70%" colspan="4" align="left"><!--<input name="prod_loc" type="text" class="forminputelement" id="prod_loc" value=""/>-->
                        <select name="prod_note" id="prod_note" class="forminputelement" >
                          <option value="0" >Select Notes</option>
                          <?
						$sqlloc1="SELECT * FROM ".$cfg['DB_NOTES']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
						$resloc1=$heart->sql_query($sqlloc1);
						while($rowloc1=$heart->sql_fetchrow($resloc1))
						{  ?>
                          <option value=<?=$rowloc1['n_id']?> >
                          <?=stripslashes($rowloc1['title'])?>
                          </option>
                          <? } ?>
                        </select>
                      </td>
                    </tr>
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Lacation</span> <span class="redstar">*</span></td>
                      <td width="70%" colspan="4" align="left"><select name="prod_loc" id="prod_loc" class="forminputelement">
                          <option value="">Select Location</option>
                          <?
						 $sqlloc="SELECT * FROM ".$cfg['DB_CITY']." WHERE  `parent_id`='0'  ";
						$resloc=$heart->sql_query($sqlloc);
						while($rowloc=$heart->sql_fetchrow($resloc))
						{  ?>
                          <option value=<?=$rowloc['id']?> >
                          <?=stripslashes($rowloc['name'])?>
                          </option>
                          <? } ?>
                        </select>
                      </td>
                    </tr>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="redstar">*</span></td>
                      <td width="70%" colspan="4" align="left"><input name="prod_code" type="text" class="forminputelement" id="prod_code" value=""/></td>
                    </tr>
                    <tr class="row2">
                      <td colspan="5" align="left" class="leftBarText"><span class="leftBarText_new">Description</span></td>
                    </tr>
                    <tr class="row1">
                      <td colspan=5 width="30%" align="left" class="leftBarText">
                      <textarea name="prod_desc_add"></textarea>
                     
                      </td>
                    </tr>
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="redstar">*</span> </td>
                      <td width="70%" colspan="4" align="left"><input name="image_add" id="image_add" type="file" class="forminputelement"/></td>
                    </tr>
                    <tr class="row1">
                     <!-- <td colspan="5" align="left" class="leftBarText"><span class="leftBarText_new">Add on Product</span>
                        <input type="checkbox" name="addon" id="addon" value="yes" onclick="addopen();" /></td>-->
                    </tr>
                  <td colspan="5" align="left" class="leftBarText"><div id="addon_prod" style="display:none;">
                        <div id="newlink" style="margin:-7px;">
                          <table width="100%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="0">
                            <tr class="row2">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="redstar">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_pcode_addon[]" type="text" class="forminputelement" id="prod_pcode_addon[]"  value="" /></td>
                            </tr>
                            <tr class="row1">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="redstar">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_pname_addon[]" type="text" class="forminputelement" id="prod_pname_addon[]"  value="" /></td>
                            </tr>
                            <tr class="row2">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="redstar">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_price_addon[]" type="text" class="forminputelement" id="prod_price_addon[]" value=""/></td>
                            </tr>
                            <tr class="row1">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="redstar">*</span> </td>
                              <td width="70%" colspan="4" align="left"><input name="image_addon[]" id="image_addon[]" type="file" class="forminputelement"/></td>
                            </tr>
                          </table>
                        </div>
                        <br />
                        <table align="center" cellpadding="0" cellspacing="0" border="0">
                          <tr class="row1">
                            <td colspan="5" align="right" class="leftBarText"><a href="javascript:new_link()">Add New </a> </td>
                          </tr>
                        </table>
                        <div id="newlinktpl" style="display:none;margin:-7px; width:100%;">
                          <table width="100%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="0">
                            <tr class="row2">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="redstar">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_pcode_addon[]" type="text" class="forminputelement" id="prod_pcode_addon[]"  value="" /></td>
                            </tr>
                            <tr class="row1">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="redstar">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_pname_addon[]" type="text" class="forminputelement" id="prod_pname_addon[]"  value="" /></td>
                            </tr>
                            <tr class="row2">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="redstar">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_price_addon[]" type="text" class="forminputelement" id="prod_price_addon[]" value=""/></td>
                            </tr>
                            <tr class="row1">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="redstar">*</span> </td>
                              <td width="70%" colspan="4" align="left"><input name="image_addon[]" id="image_addon[]" type="file" class="forminputelement"/></td>
                            </tr>
                          </table>
                        </div>
                      </div></td>
                  <tr>
                    <td colspan="5" align="center">
						<a class="brownbttn" href="addon.php?category=<?=$_REQUEST['category']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" class="back">&lt;&lt;back</a>
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
	  
	  		$sql1="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);
			if($row1['category']!=0)
			{
				$cat = explode(',',$row1['category']);
			}
			else
			{
				$catA = getcategoryname2($_REQUEST['id']);				
				$cat = explode(',',$catA);
			}
			//$loc = explode(',',$row1['location']);
	  ?>
              <form name="frmedit" method="post" action="product_process.php" id="frmedit" enctype="multipart/form-data" onSubmit="return product_edit1(this)">
                <p>
                  <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
                  <input type="hidden" name="act" value="update_addon" />
                  <input type="hidden" name="pd_id" value="<?=$row1['pd_id']?>" />
                  <input type="hidden" name="prod_edit_valid" value=""  id="prod_edit_valid"/>
                  <input type="hidden" name="type_check_edit" value=""  id="type_check_edit"/>
                </p>
                <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="5" align="left" class="style2">&nbsp;Edit Addon Product Section </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row2">
                      <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <? if($row1['isAddon']=='N'){
                       
                  		}else{?>
                  <input type="hidden" name="cate_id" id="cate_id" value="<?=getcatid(getcatid($row1['category']))?>" />
                  <input type="hidden" name="secpid" id="secpid" value="<?=$row1['category']?>" />
                  <? } ?>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left">
					<input name="prod_pname_add" type="text" class="forminputelement" id="prod_pname_add"  value="<?=stripslashes($row1['pd_name'])?>" />
                     </td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="prod_price_add" type="text" class="forminputelement" id="prod_price_add" value="<?=$row1['pd_price']?>"/></td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Unit Price</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="prod_unitprice_add" type="text" class="forminputelement" id="prod_unitprice_add" value="<?=$row1['pd_unit_price']?>"/></td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Strike Through Price</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="sprod_price_add" type="text" class="forminputelement" id="sprod_price_add" value="<?=$row1['strike_price']?>"/></td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Discount</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="discount" type="text" class="forminputelement" id="discount" value="<?=$row1['discount']?>"/></td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Disclaimer</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><?php /*?><input name="prod_loc" type="text" class="forminputelement" id="prod_loc" value="<?=$row1['location']?>"/><?php */?>
                      <select name="prod_dis" id="prod_dis" class="forminputelement">
					  <option value="0">Select Any</option>
                        <?
						$sqlloc2="SELECT * FROM ".$cfg['DB_DISCLAIMER']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
						$resloc2=$heart->sql_query($sqlloc2);
						while($rowloc2=$heart->sql_fetchrow($resloc2))
						{  ?>
                        <option value=<?=$rowloc2['d_id']?> <? if($row1['disclaimer']==$rowloc2['d_id']){?> selected="selected" <? } ?>>
                        <?=stripslashes($rowloc2['title'])?>
                        </option>
                        <? } ?>
                      </select>
                    </td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Delivery By</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><?php /*?><input name="prod_loc" type="text" class="forminputelement" id="prod_loc" value="<?=$row1['location']?>"/><?php */?>
                      <select name="prod_deliv" id="prod_deliv" class="forminputelement">
					  <option value="0">Select Any</option>
                        <?
						$sqldeliv="SELECT * FROM ".$cfg['DB_EARLIEST_DELIVERYBY']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
						$resdeliv=$heart->sql_query($sqldeliv);
						while($rowdeliv=$heart->sql_fetchrow($resdeliv))
						{  ?>
                        <option value=<?=$rowdeliv['id']?> <? if($row1['earliest_deliveryId']==$rowdeliv['id']){?> selected="selected" <? } ?>>
                        <?=stripslashes($rowdeliv['name'])?>
                        </option>
                        <? } ?>
                      </select>
                    </td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Notes</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><?php /*?><input name="prod_loc" type="text" class="forminputelement" id="prod_loc" value="<?=$row1['location']?>"/><?php */?>
                      <select name="prod_note" id="prod_note" class="forminputelement">
					  <option value="0">Select Any</option>
                        <?
						$sqlloc1="SELECT * FROM ".$cfg['DB_NOTES']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
						$resloc1=$heart->sql_query($sqlloc1);
						while($rowloc1=$heart->sql_fetchrow($resloc1))
						{  ?>
                        <option value=<?=$rowloc1['n_id']?> <? if($row1['notes']==$rowloc1['n_id']){?> selected="selected" <? } ?>>
                        <?=stripslashes($rowloc1['title'])?>
                        </option>
                        <? } ?>
                      </select>
                    </td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Lacation</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><?php /*?><input name="prod_loc" type="text" class="forminputelement" id="prod_loc" value="<?=$row1['location']?>"/><?php */?>
                      <select name="prod_loc" id="prod_loc" class="forminputelement">
                        <?
						$sqlloc="SELECT * FROM ".$cfg['DB_CITY']." WHERE  `parent_id`='0'  ";
						$resloc=$heart->sql_query($sqlloc);
						while($rowloc=$heart->sql_fetchrow($resloc))
						{  ?>
                        <option value=<?=$rowloc['id']?> <? if($row1['location']==$rowloc['id']){?> selected="selected" <? } ?>>
                        <?=stripslashes($rowloc['name'])?>
                        </option>
                        <? } ?>
                      </select>
                    </td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="redstar">*</span></td>
                    <td width="70%" colspan="4" align="left"><input name="prod_code" type="text" class="forminputelement" id="prod_code" value="<?=stripslashes($row1['pd_code'])?>"/></td>
                  </tr>
                  <tr class="row2">
                    <td colspan="5" align="left" class="leftBarText"><span class="leftBarText_new">Description</span></td>
                  </tr>
                  <tr class="row1">
                    <td colspan=5 width="30%" align="left" class="leftBarText">
                    
                    <textarea name="prod_desc_add" ></textarea>
                   
                    </td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Change Image </span> </td>
                    <td width="70%" colspan="4" align="left" valign="top"><input name="image_add[]" id="image_add" type="file" class="forminputelement"/>
                      &nbsp;&nbsp; <img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image']?>"  width="70" align="top"/></td>
                  </tr>
                  <?  if($row1['isAddon']=='N'){ ?>
                 <!-- <tr class="row1">
                    <td colspan="5" align="left" class="leftBarText"><span class="leftBarText_new">Add on Product</span>
                      <input type="checkbox" name="addon" id="addon" value="yes" onclick="addopen();" /></td>
                  </tr>-->
                  </tbody>
                  
                </table>
				
                <div id="addon_prod" style="display:none;">
                  <div id="newlink">
                    <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                      <thead>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="redstar">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_pcode_addon[]" type="text" class="forminputelement" id="prod_pcode_addon[]"  value="" /></td>
                        </tr>
                        <tr class="row1">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="redstar">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_pname_addon[]" type="text" class="forminputelement" id="prod_pname_addon[]"  value="" /></td>
                        </tr>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="redstar">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_price_addon[]" type="text" class="forminputelement" id="prod_price_addon[]" value=""/></td>
                        </tr>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="redstar">*</span> </td>
                          <td width="70%" colspan="4" align="left"><input name="image_addon[]" id="image_addon[]" type="file" class="forminputelement"/></td>
                        </tr>
                        </tbody>
                        
                    </table>
                  </div>
                  <!--<table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                    <thead>
                      <tr class="row1">
                        <td colspan="5" align="left" class="leftBarText"><a href="javascript:new_link()">Add New </a> </td>
                      </tr>
					  
                      </thead>
                      
                  </table>-->
                  <div id="newlinktpl"  style="display:none;" >
                    <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                      <thead>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="redstar">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_pcode_addon[]" type="text" class="forminputelement" id="prod_pcode_addon[]"  value="" /></td>
                        </tr>
                        <tr class="row1">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="redstar">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_pname_addon[]" type="text" class="forminputelement" id="prod_pname_addon[]"  value="" /></td>
                        </tr>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="redstar">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_price_addon[]" type="text" class="forminputelement" id="prod_price_addon[]" value=""/></td>
                        </tr>
                        <tr class="row1">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="redstar">*</span> </td>
                          <td width="70%" colspan="4" align="left"><input name="image_addon[]" id="image_addon[]" type="file" class="forminputelement"/></td>
                        </tr>
                        </tbody>
                        
                    </table>
                  </div>
                </div>
				
                <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
                    <? }  ?>
                    <tr>
                      <td colspan="4" align="center">
						<a class="brownbttn" href="addon.php?category=<?=$_REQUEST['category']?>&page=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?><? if($row1['mainaddon']!=0){?>&main=<?=$row1['mainaddon']?><? } ?>">&lt;&lt;back</a>
						<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
                      </td>
                    </tr>
                    </thead>
                    
                </table>
              </form>
              <? 
	  } 
	  //edit addon
	  // if($show=='edit_addon'){
	   
	 //  echo "555555555555555555";
	  
	  		/*echo $sql1="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);
			
			$cat = explode(',',$row1['category']);
			$loc = explode(',',$row1['location']);*/
	  ?>
              <!--<form name="frmedit" method="post" action="product_process.php" id="frmedit" enctype="multipart/form-data" onSubmit="">
                <p>
                  <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
                  <input type="hidden" name="act" value="update_addon" />
                  <input type="hidden" name="pd_id" value="<?=$row1['pd_id']?>" />
                  <input type="hidden" name="prod_edit_valid" value=""  id="prod_edit_valid"/>
                  <input type="hidden" name="type_check_edit" value=""  id="type_check_edit"/>
                </p>
                <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="5" align="left" class="style2">&nbsp;Edit Addon Product Section </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row2">
                      <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="style3">*</span></td>
                      <td width="70%" colspan="4" align="left"><input name="prod_pname_addon" type="text" class="forminputelement" id="prod_pname_addon"  value="<?=stripslashes($row1['pd_name'])?>" /></td>
                    </tr>
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="style3">*</span></td>
                      <td width="70%" colspan="4" align="left"><input name="prod_price_addon" type="text" class="forminputelement" id="prod_price_addon" value="<?=$row1['pd_price']?>"/></td>
                    </tr>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="style3">*</span></td>
                      <td width="70%" colspan="4" align="left"><input name="prod_pcode_addon" type="text" class="forminputelement" id="prod_pcode_addon" value="<?=stripslashes($row1['pd_code'])?>"/></td>
                    </tr>
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Change Image </span> </td>
                      <td width="70%" colspan="4" align="left" valign="top"><input name="image_addon" id="image_addon" type="file" class="forminputelement"/>
                        &nbsp;&nbsp; <img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image']?>"  width="70" align="top"/></td>
                    </tr>
                    <tr>
                      <td align="right"><a href="addon.php?category=<?=$_REQUEST['category']?>&page=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?><? if($row1['mainaddon']!=0){?>&main=<?=$row1['mainaddon']?><? } ?>" class="back">&lt;&lt;back</a></td>
                      <td colspan="4" align="left"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
                        &nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </form>-->
              <? 
	  
	//  } 
	  
	  
	  
	  //view customer details
	  if($show=='view_addon'){
	  
	  		$sql_name="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
			$res_name=$heart->sql_query($sql_name);
			$row1=$heart->sql_fetchrow($res_name);
			//print_r($row1);
			$sql_Delivery="SELECT * FROM ".$cfg['DB_EARLIEST_DELIVERYBY']." WHERE  `id` =".$row1['earliest_deliveryId']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
	  		$res_Delivery=$heart->sql_query($sql_Delivery);
			$row_Delivery=$heart->sql_fetchrow($res_Delivery);
	  ?>
              <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="4" align="left" class="style2">&nbsp;View Addon Product Section </td>
                    <td width="14%" align="right" class="style2"><a style="color:#FFFFFF; font-weight:bold;" href="addon.php?show=edit&id=<?=$_REQUEST['id']?>&pageno=<?=$pageno?>"><strong>Edit&nbsp;&nbsp;</strong></a></td>
                  </tr>
                </thead>
                <tbody>
                  <? if($_REQUEST['m']){ ?>
                  <tr class="row2">
                    <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                  </tr>
                  <? } ?>
                  <!--<tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Category</span> </td>
                    <td colspan="4" align="left"><? /*if($row1['category']!=0){?>
                      <?=getcategoryname($row1['category'])?>
                      <? }else{?>
                      <?=getcategoryname(getcategoryname2($row1['pd_id']))?>
                      <? }*/?>
                    </td>
                  </tr>-->
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> </td>
                    <td colspan="4" align="left"><?=stripslashes($row1['pd_name'])?>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <? if($row1['pd_featured']=='A'){?>
                      ( Set as homepage product )
                      <? } ?></td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> </td>
                    <td colspan="4" align="left"><?=$row1['pd_price']?></td>
                  </tr>
                   <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Unit Price</span> </td>
                    <td colspan="4" align="left"><?=$row1['pd_unit_price']?></td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Delivery By</span> </td>
                    <td colspan="4" align="left"><?=$row_Delivery['name']?></td>
                  </tr>
                  <? if($row1['strike_price']){?>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Strike Price</span> </td>
                    <td colspan="4" align="left"><?=$row1['pd_price']?></td>
                  </tr>
                  <tr class="row1">
                    <? }else{?>
                  <tr class="row2">
                    <? }?>
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> </td>
                    <td colspan="4" align="left"><?=stripslashes($row1['pd_code'])?></td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Location</span> </td>
                    <?
						$sql_l="SELECT * FROM ".$cfg['DB_CITY']." WHERE  `id` =".$row1['location']."  ";
						$res_l=$heart->sql_query($sql_l);
						$row_l=$heart->sql_fetchrow($res_l);
					
					
					?>
                    <td colspan="4" align="left"><?=getlocationname($row_l['city_id'])?></td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" valign="top" align="left" class="leftBarText"><span class="leftBarText_new">Product Disclaimer</span></td>
                    <td colspan="4" align="left"><? if($row1['disclaimer']!='') { ?>
                      <?=getdisclaimer($row1['disclaimer'])?>
                      <? } else { ?>
                      None
                      <? } ?>
                    </td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" valign="top" align="left" class="leftBarText"><span class="leftBarText_new">Product Notes</span></td>
                    <td colspan="4" align="left"><? if($row1['notes']!='') { ?>
                      <?=getnotes($row1['notes'])?>
                      <? } else { ?>
                      None
                      <? } ?>
                    </td>
                  </tr>
                  <tr class="row2">
                    <td colspan="5" align="left" class="leftBarText"><span class="leftBarText_new">Description</span></td>
                  </tr>
                  <tr class="row1">
                    <td colspan=5 align="left" class="leftBarText"><?php
				if($row1['pd_description']!='') { echo  stripslashes($row1['pd_description']); } else { echo 'None'; }
				?>
                    </td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Image </span> </td>
                    <td colspan="4" align="left" valign="top"><img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image']?>"  width="70" align="top"/></td>
                  </tr>
                  <? /*$sql_addon="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `status`='A' AND `mainaddon` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
			$res_addon=$heart->sql_query($sql_addon);
			 $maxrow=$heart->sql_numrows($res_addon);
			//$row_addon=$heart->sql_fetchrow($res_addon);
			$k=0;
			 if($maxrow >0)
{
while($row_addon=$heart->sql_fetchrow($res_addon)){
$k++; */
	  ?>
                  <!--<tr class="">
                    <td colspan="5" align="left" class="style2">Add On Product
                      <?=$k?></td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> </td>
                    <td colspan="4" align="left"><?=stripslashes($row_addon['pd_name'])?>
                      <?php /*?>&nbsp;&nbsp;&nbsp;&nbsp;<? if($row1['pd_featured']=='A'){?> ( Set as homepage product ) <? } ?><?php */?></td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> </td>
                    <td colspan="4" align="left"><?=$row_addon['pd_price']?></td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> </td>
                    <td colspan="4" align="left"><?=stripslashes($row_addon['pd_code'])?>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <? if($row_addon['pd_featured']=='A'){?>
                      ( Set as homepage product )
                      <? } ?>
                    </td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Image </span> </td>
                    <td colspan="4" align="left" valign="top"><img src="../<?=$cfg['PRODUCT_IMAGES'].$row_addon['pd_image']?>"  width="70" align="top"/></td>
                  </tr>-->
                  <? //}}
			 
			 ?>
                  <tr>
                    
                    <td colspan="5" align="center" style="padding-top:10px; padding-bottom:10px;">
						<a class="brownbttn" href="addon.php?category=<?=$_REQUEST['category']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" class="back">&lt;&lt;back</a>
					</td>
                  </tr>
                </tbody>
              </table>
              <? 
	  } 
	  
	  
 /* if($show=='view'){		
		$sql_name_addon="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
			$res_name_addon=$heart->sql_query($sql_name_addon);
			$row_addon=$heart->sql_fetchrow($res_name_addon);*/
		?>
              <!--<table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="4" align="left" class="style2">&nbsp;View Product Section </td>
                    <td width="14%" align="right" class="style2"><a style="color:#FFFFFF; font-weight:bold;" href="addon.php?show=edit&id=<?=$_REQUEST['id']?>&pageno=<?=$pageno?>"><strong>Edit&nbsp;&nbsp;</strong></a></td>
                  </tr>
                </thead>
                <tbody>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> </td>
                    <td colspan="4" align="left"><?=stripslashes($row_addon['pd_name'])?>
                    </td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> </td>
                    <td colspan="4" align="left"><?=$row_addon['pd_price']?></td>
                  </tr>
                  <tr class="row1">
                    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> </td>
                    <td colspan="4" align="left"><?=stripslashes($row_addon['pd_code'])?></td>
                  </tr>
                  <tr class="row2">
                    <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Image </span> </td>
                    <td colspan="4" align="left" valign="top"><img src="../<?=$cfg['PRODUCT_IMAGES'].$row_addon['pd_image']?>"  width="70" align="top"/></td>
                  </tr>
                </tbody>
              </table>-->
              <?	//}
	  
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
