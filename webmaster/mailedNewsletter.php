<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Mailed Newsletter Content Management");
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="boxover.js"></script>
<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>

<style type="text/css">
<!--
.style3 {color: #FFFFFF}
-->
</style>
<script>



function validation_delete(pageno)
{  
     var flag=0;
     var ar=new Array();
	 var n=0;
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
	 	
	if(m>1)
	{
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
			window.location.href="send_mail_process.php?&act=deleteMail&id="+ar+'&pageno='+pageno;
			return true;
	    }
		else
		{
		    return false;
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
			<a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;"/></a>&nbsp;&nbsp;
			</td>
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
              <td colspan="7" align="left">&nbsp;<span class="style2">Mailed Newsletter</span> </td>
              </tr>
          </thead>
          <tbody>

            <? if($_REQUEST['m']){ ?>
            <tr class="row1">
              <td colspan="7" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
			<? } ?>
			 <form name="frm1" id="frm1" action="">
            <tr class="headercontent">
				<td width="6%" align="center" class="leftBarText_new1"><input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
              <td width="15%" align="center" class="leftBarText_new1">Sl No </td>
              <td width="41%" align="left" class="leftBarText_new1">Subject </td>
              <td width="21%" align="center" class="leftBarText_new1">Mail Content</td>
              <td width="12%" align="center" class="leftBarText_new1">Mail Id</td>
              <td width="12%" align="center" class="leftBarText_new1">Sent Date</td>
              <td width="12%" align="center" class="leftBarText_new1">Action</td>
            </tr>
		  
		<?  $sql="SELECT * FROM ".$cfg['DB_NEWSMAIL']." WHERE `siteId`='".$cfg['SESSION_SITE']."'";
			 $res=$heart->sql_query($sql);
			 $maxrow=$heart->sql_numrows($res);
			 $sql = $sql. " LIMIT $offset,$limit";
			 $res = $heart->sql_query($sql);
			 if($maxrow >0){
			 while($row=$heart->sql_fetchrow($res)){
			 @$i++;
			?>
            <tr class="<?=($i%2==0)?'row1':'row2'?>">
				<td align="center"><input  name="checkvalue" id="checkvalue"  value="<?=$row['newsmailId']?>" type="checkbox" /></td>	
             <td align="center"><?=$i+$offset?></td>
              <td align="left"><?=$row['mailSub']?></td>
              <td align="center" valign="middle" ><?=$row['mailContent']?></td>
              <td align="left" valign="middle" >
              	<div style="width:200px !important; word-wrap:break-word;">
              		<?=$row['usrEmail']?>
              	</div>
              </td>
              <td align="center" valign="middle" ><?=$row['sendDate']?></td>
              <td align="center"><!--<a href="send_mail_process.php?act=view&id=<?=$row['id']?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a><a href="newslist_process.php?act=edit&id=<?=$row['newsId']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>-->
              	<a href="send_mail_process.php?act=deleteMail&id=<?=$row['newsmailId']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" / onClick="return confirm('Do you really want to delete this record');"></a></td>
            </tr>
			<? }
			}
			  else {?>
            <tr class="row1">
              <td colspan="5" align="center" class="msg">No Record.</td>
            </tr>  <? }

?>

<div style="width:90%; text-align:right;">
		<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
		</div>
		<tr >
			<td colspan="7" align="center" class="redbuttonelements">
				<? if($maxrow >0){?>
				
				<input value="Delete"  name="submit" type="button" onclick="return validation_delete(<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>);" class="loginbttn"/>
				<? } ?>
			    </form>
                
              </tr>

          </tbody>
        </table>
		
		
		<? }
	 ?>
	    </td>
        </tr>
		<tr height="16">
		<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
      </table> 
      </td>   
	  
    </tr>
	<tr><td colspan="3" align="right"></td></tr>
  </table>
