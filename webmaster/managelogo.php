<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==10) { $msg='File type should be Image file(PNG)';}
page_header($cfg['ADMIN_TITLE']." - Logo Management");
$show=$_REQUEST['show'];
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/category.js"></script>
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
			<a href="login.php?act=<?=md5("logout")?>" title="Logout"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;" /></a>&nbsp;&nbsp;
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
	   if($_REQUEST['show']=='ss')
	   {?>
              <form name="frm1" id="frm1" action="logo_process.php" method="post">
                <? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
                <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
                <table width="95%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="10" align="left">&nbsp;<span class="style2">Site Logo</span> </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row1">
                      <td colspan="15" align="right" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <tr class="headercontent">
                      <td width="16%" align="center" class="leftBarText_new1">Sl No </td>
                      <td width="30%" align="center" class="leftBarText_new1">Image File</td>
                      <td width="25%" align="center" class="leftBarText_new1">Action</td>
                    </tr>
                    <? 
		
			 $sql="SELECT * FROM ".$cfg['DB_LOGO']." where `siteId`='".$cfg['SESSION_SITE']."'";
			$res=$heart->sql_query($sql);
			$maxrow=$heart->sql_numrows($res);
			
			 if($maxrow >0)
			 {
			 	while($row=$heart->sql_fetchrow($res)){
				 @$i++;
			?>
                    <tr class="<?=($i%2==0)?'row1':'row2'?>">
                      <td align="center"><?=$i+$offset?></td>
                      <td align="center" class="leftBarText"><? if($row['l_image']==''){ ?>
                        No File Exists
                        <? } else{ ?>
                        <img src="../<?=$cfg['DIR_LOGO']?><?=$row['l_image']?>" >
                        <? } ?></td>
                      <td align="center"><a href="logo_process.php?act=edit&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['l_id']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a> </td>
                    </tr>
                    <? }
			}
			else
			 {
				?>
                    <tr class="row1">
                      <td colspan="10" align="center" class="msg">No Record.</td>
                    </tr>
                    <? }?>
                  </tbody>
                </table>
              </form>
              <? }
		
          if($show==$_REQUEST['show'])
		  {
            $sql="SELECT * FROM ". $cfg['DB_LOGO']." where `siteId`='".$cfg['SESSION_SITE']."'";
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
	  ?>
              <form name="frmedit"  id="frm3" method="post" action="logo_process.php" onsubmit="return mark();" enctype="multipart/form-data">
                <p>
                  <input type="hidden" name="act" value="update" />
                  <input type="hidden" name="w_id" value="<?=$row['l_id']?>" />
                  <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
                </p>
                <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="5" align="left" class="style2">&nbsp;Edit Image</td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row1">
                      <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Upload to change file</span></td>
                      <td width="70%" colspan="4" align="left"><input name="w_image" type="file" class="forminputelement" id="w_image"/>
                        &nbsp;&nbsp; <img src="../<?=$cfg['DIR_LOGO']?><?=$row['l_image']?>" width="60"  align="middle"> </td>
                    </tr>
                    <tr>
                      <td align="center" colspan="2">
						<a class="brownbttn" style="text-decoration:none;" href="managelogo.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
						<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
					  </td>
                      
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
