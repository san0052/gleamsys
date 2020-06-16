<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');
//$this_page='spe_category.php';
//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
//if($_REQUEST['m']==3) { $msg='Record Deleted';}
//if($_REQUEST['m']==4) { $msg='Order Updated';}
//if($_REQUEST['m']==5) { $msg='Record Details';}
//if($_REQUEST['m']==9) { $msg='Content should not be blank';}
if($_REQUEST['m']==10) { $msg='Unable to uploade';}
if($_REQUEST['m']==11) { $msg='Only Excel File can be uploaded';}
page_header($cfg['ADMIN_TITLE']." - Mass Uploading Management");


// $parentId=($_REQUEST['pId']=="")?'0':$_REQUEST['pId'];
$show=$_REQUEST['show'];
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
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

<script language="javascript" src="scripts/category.js"></script>
		

 

<style type="text/css">
<!--
.style3 {color: #FFFFFF}
-->
</style>



<td vAlign=top align="center" width="99%"><!-- Start Body Here -->
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" >
  
    <tr height="34">
      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br /><br />
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
	  <?php /*?><!--<td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome <?=$_SESSION['admin_user_name']?></span></td>
      
	  <td  width="56"align="right" valign="middle">
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
                <td  width="56"align="right" valign="middle">
      
      <a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>--><?php */?>
	  </tr>
	  <tr height="16">
	  <td colspan="2" align="left" valign="middle" bgcolor="#CFCFCF">&nbsp;</td>
	  </tr>
        <tr>
          <td colspan="2" bgcolor="#CFCFCF" align="center">
	  <? //show all record
	   if($_REQUEST['show']=='')
	   	  {            
	  ?>
	  <form name="frmedit"  id="frm3" method="post" action="mass_uploade_process.php" onsubmit="return mass()" enctype="multipart/form-data">
          <p>
           
			<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
			

          </p>
          <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Mass Uploading</td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row1">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
			 			
				
				<tr class="row1"> 
                	<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Upload excel file</span></td> 
            	    <td width="70%" colspan="4" align="left"><input name="file" type="file" class="forminputelement" id="file"/></td>
			  </tr> 
			  <tr>
				  <td colspan="4" align="center"><input type="submit" name="Save" id="Save" value="Submit" class="loginbttn">&nbsp;</td> 
              </tr> 
			  
            </tbody> 
          </table> 
      </form>
	 <?
	  }
	?>	  </td>
        </tr>
		
		<tr height="16">
			<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
      </table> 
      </td>   
	  
    </tr>
	<tr><td colspan="3" align="right"></td></tr>
  </table>	  
	   
