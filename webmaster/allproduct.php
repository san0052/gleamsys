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


function countRightbar()
{
	global $cfg,$heart;$num;
	$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_rightbar`='A' ";
	$res=$heart->sql_query($sql);
	$num=$heart->sql_numrows($res);	
	return $num;	
	
}

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
			<a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" /></a>&nbsp;&nbsp;
			</td>
            <?php /*?><!--<td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
              <?=$_SESSION['admin_user_name']?>
              </span></td>
            <td  width="56"align="right" valign="middle"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>--><?php */?>
          </tr>
          <tr height="16">
            <td colspan="2" align="left" valign="middle" bgcolor="#CFCFCF">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#CFCFCF" align="center"><? //show all record
	   if($_REQUEST['show']==''){
	   ?>
              <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="4" align="left">&nbsp;<span class="style2">Addon Product Section</span>&nbsp;</td>
                    <td colspan="9" align="right">
					<form name="frmsearch" id="frmsearch" action="addon.php" method="post">
                        <input type="hidden" name="category" id="category" value="<?=$_REQUEST['category']?>" />
                        <input type="hidden" name="searchname" id="searchname" value="search" />
						<input type="hidden" name="addon" id="addon" value="addon" />
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
                      <td width="14%" align="center" class="leftBarText_new1">IsAddon</td>
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
							 $sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `order` ASC";
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
		?>
				<tr class="<?=($i%2==0)?'row1':'row2'?>">
				  <td align="center" valign="top"><input  name="checkvalue" id="checkvalue"  value="<?=$row['pd_id']?>" type="checkbox" /></td>
				  <td align="center" valign="top"><?=$i+$offset?></td>
				  <td align="center" valign="top"><?=$row['pd_id']?></td>
				  <td colspan="2" align="left" valign="top" ><?=$row['pd_name']?>&nbsp;&nbsp;[#<?=$row['pd_id']?>]</td>
				  <td colspan="3" align="center" valign="top" ><img src="../<?=$cfg['PRODUCT_IMAGES'].$row['pd_image']?>"  width="70" align="top"/></td>
				  <td align="center" valign="top" class="leftBarText"><input name="catorder[<?=$row['pd_id'];?>]" type="text" class="forminputelement" id="catorder[<?=$row['pd_id'];?>]"  size="2" value="<?=$row['order'];?>"/></td>
				  <td align="center" valign="top"><?=$row['pd_price']?></td>
				  <td align="center" valign="top">&nbsp;
				    <a href="product_process.php?act=<?=($row['isAddon']=='Y')?'NotAddon':'Addon'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['pd_id']?>" class="<?=($row['isAddon']=='Y')?'greenbuttonelementsNew':'redbuttonelementsNew'?>">
					<?=($row['isAddon']=='Y')?'Addon':'NotAddon'?>
					</a></td>
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
              <div style="width:90%; text-align:right;">
                <? if(!isset($_REQUEST['prodsearch'])){ ?>
                <?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
                <? } ?>
              </div>
              <? }
	  
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
