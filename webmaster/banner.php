<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==4) { $msg='Order Updated';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}
if($_REQUEST['m']==10) { $msg='File should be image';}

page_header($cfg['ADMIN_TITLE']." - Banner Management");
$category=($_REQUEST['category']!="")?$_REQUEST['category']:'all';
$pageno =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];
?>
<script>
function getSes1(site){
window.location.href="admin.php?act=ses&site="+site;	
}
</script>
<?
	if($_REQUEST['act']=='ses')
	{ 
		session_register('site');
		$cfg['SESSION_SITE']=$_REQUEST['site'];
		$heart->redirect('admin.php');
	}
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/location.js"></script>
<script language="javascript" src="scripts/product.js"></script>
<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>
<script language="javascript" type="text/javascript">

</script>

<script>
function checkLink()
{
var str=document.getElementById("image_link").value;
if(str!=''){

	
	var htt="http://";
	var dot=".";
	var lstr=str.length;
	var ldot=str.indexOf(dot);
	if (str.indexOf(htt)==-1)
	{
		 alert("Invalid Link");
		 document.getElementById("image_link").focus();
		 return false;
   }
    if (str.indexOf(htt)!=0)
	{
		 alert("Invalid Link");
		 document.getElementById("image_link").focus();
		 return false;
   }
    if (str.lastIndexOf(htt)!=0)
	{
		alert("Invalid Link");
		document.getElementById("image_link").focus();
		return false;
   }
   if (str.indexOf(" ")!=-1)
   {
		alert("Invalid Link");
		document.getElementById("image_link").focus();
		return false;
}
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
	{
		 alert("Invalid Link");
		 document.getElementById("image_link").focus();
		 return false;
 	}
}
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
          <tr height="35" >
          <td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
              <?=$_SESSION['admin_user_name']?>
              </span>               
             </td>
            <td align="right" valign="middle" class="style5">
			<?
			 	$sql="SELECT * FROM ".$cfg['DB_SITE']."   ";
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
			<a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" /></a>&nbsp;&nbsp;
			</td>
            <?php /*?><!--<td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
              <?=$_SESSION['admin_user_name']?>
              </span></td>
               <td width="10" align="right" valign="middle">
      <?
			 	$sql="SELECT * FROM ".$cfg['DB_SITE']."   ";
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
                </td>
            <td width="10" align="right" valign="middle"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>--><?php */?>
          </tr>
          <tr height="16">
            <td colspan="2" align="left" valign="middle" bgcolor="#CFCFCF">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#CFCFCF" align="center"><? //show all record
	   if($_REQUEST['show']==''){
	   ?>
              <?php /*?><form name="frm1" id="frm1" action="product_process.php" method="post">
		 <input type="hidden" name="act" id="act" value="order" /> 
		 <? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
		 <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" /><?php */?>
              <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                   <td colspan="7" align="left">&nbsp;<span class="style2">Manage Banner Section</span></td>
                  </tr>
                </thead>
                <form name="frm1" id="frm1" action="" method="post">
                 
                  
                  <? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
                  <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row1">
                      <td colspan="7" align="right" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <tr class="headercontent">
                      <td width="8%" align="center" class="leftBarText_new1">Sl No </td>    
					  <td width="12%" align="center" class="leftBarText_new1">Db No [#]</td>                  
                      <td width="16%" align="center" class="leftBarText_new1">Banner Image</td>
					  <td width="10%" align="center" class="leftBarText_new1">Position</td>
                      <?php /*?><td width="10%" align="center" class="leftBarText_new1" >Status</td><?php */?>
                      <td width="35%" align="center" class="leftBarText_new1" >Link</td>
                      <td width="9%" align="center" class="leftBarText_new1">Action</td>
                    </tr>
                   
                    <? 
			$sql="SELECT * FROM ".$cfg['DB_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' ";			
			$res=$heart->sql_query($sql);			
			 while($row=$heart->sql_fetchrow($res)){
			 @$i++;
			?>
                    <tr class="<?=($i%2==0)?'row1':'row2'?>">
                      <td align="center" valign="top"><?=$i+$offset?></td>
					  <td align="center" valign="top"><?=$row['banner_id']?></td>
                      
                      <td align="center" valign="top" ><img src="../<?=$cfg['BANNER_IMAGES'].$row['banner_img']?>"  width="70" align="top"/></td>
                      
                      <td align="center" valign="top"><?=$row['banner_position']?></td>
                      <?php /*?><td align="center" valign="top" ><a href="banner_process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['banner_id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>">
                        <?=($row['status']=='A')?'Active':'Inactive'?>
                        </a></td><?php */?>
                      <td align="center" valign="top" ><? if($row['banner_link']==''){echo "No link found"; } else {?><a href="<?=$row['banner_link']?>" target="_blank" style="color:#000000"><?=$row['banner_link']?></a><? }?></td>
                      <td align="center" valign="top"><a href="banner.php?show=edit&id=<?=$row['banner_id']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a><br /></td>
                    </tr>
                    <? }
			
?>
                    <tr>
                    <td colspan="7" align="left" class="redbuttonelements"></td>
                    </tr>
                  </tbody>
                </form>
              </table>
              
              <? }
		
	
	  if($show=='edit'){
	  
	  		$sql1="SELECT * FROM ".$cfg['DB_BANNER']." WHERE  `banner_id` =".$_REQUEST['id']." AND `siteId`='".$cfg['SESSION_SITE']."' ";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);
	  ?>
              <form name="frmedit" method="post" action="banner_process.php" id="frmedit" enctype="multipart/form-data" onsubmit="return checkLink();">
                <p>
                  <input type="hidden" name="pageno" value="<?=$pageno?>" />
                  <input type="hidden" name="act" value="update" />
                  <input type="hidden" name="banner_id" value="<?=$row1['banner_id']?>" />
                 
                </p>
                <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="3" align="left" class="style2">&nbsp;Edit Banner Section </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row2">
                      <td colspan="3" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
					
					
					<tr class="row1">
                    <td width="25%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Change Image </span> </td>
                    <td width="70%" align="left" valign="top"><input name="image_edit" id="image_edit" type="file" class="forminputelement"/>
                      <br />Best Size &nbsp;[ <?=$row1['banner_w']?> X <?=$row1['banner_h']?> ]</td>
                    <td align="center" valign="top"><img src="../<?=$cfg['BANNER_IMAGES'].$row1['banner_img']?>"  width="70" align="top"/></td>
                    </tr>
                  
                    <tr class="row2">
                     <td width="25%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Change Link</span> </td><td width="70%" colspan="2" align="left" valign="top"><input name="image_link" id="image_link" type="text" class="forminputelement" value="<?=($_SESSION['link']!='')?$_SESSION['link']:$row1['banner_link']?>"/></td>
                    </tr>
					
                   
                    <tr>
                      <td align="right"><a href="banner.php" class="back">&lt;&lt;back</a></td>
                      <td colspan="2" align="left"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
                        &nbsp;</td>
                    </tr>
                  </tbody>
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
