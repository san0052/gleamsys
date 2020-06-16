<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==5) { $msg='Mail has been sent successfully';}
if($_REQUEST['m']==6) { $msg='Mail Content should not be blank';}
if($_REQUEST['m']==7) { $msg='Please select any email id';}

page_header($cfg['ADMIN_TITLE']." - Newsletter Management");

$show=$_REQUEST['show'];
?>

<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="boxover.js"></script>
<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>
<script language="javascript" src="scripts/ckeditor.js"></script>

<script>
function check_emailadd(email)
{
	//alert(email);
	if(email!="")
	{
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(email))
		{
			document.getElementById("invalid_add").style.display = 'inline';
			document.getElementById("exists_add").style.display='none';
			document.getElementById("notexists_add").style.display='none';
			document.getElementById("valid_add").value=2;
		}
		else
		{
			var act='addexist';
			//alert('send_mail_process.php?act='+act+'&email='+email);
			http.open('get','send_mail_process.php?act='+act+'&email='+email);
			http.onreadystatechange = handleResponseEmailAdd;
			http.send(null);
		}
	}
	else
	{
		document.getElementById("exists_add").style.display='none';
		document.getElementById("notexists_add").style.display='none';
		document.getElementById("invalid_add").style.display = 'none';
	}
}
function handleResponseEmailAdd() {
	if(http.readyState == 4 && http.status == 200){
	var response = http.responseText;
	if(response!="")
	{
		
		if(response==1)
		{
			//alert(response);
			document.getElementById("exists_add").style.display='inline';
			document.getElementById("notexists_add").style.display='none';
			document.getElementById("invalid_add").style.display = 'none';
			document.getElementById("valid_add").value=1;
		}
		 if(response==0)
		 {
			//alert(response);
			document.getElementById("notexists_add").style.display='inline';
			document.getElementById("exists_add").style.display='none';
			document.getElementById("invalid_add").style.display = 'none';
			document.getElementById("valid_add").value=0;
		}
	}
	}
}

function val()
{
	if(document.getElementById("name_add").value=="")
	{
		alert("Please enter name");
		document.getElementById("name_add").focus();
		return false;
	}
	if(document.getElementById("email_add").value=="")
	{
		alert("Please enter email id");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("valid_add").value==1)
	{
		alert("This email id already exists");
		document.getElementById("email_add").focus();
		return false;
	}
	if(document.getElementById("valid_add").value==2)
	{
		alert("This email id is invalid");
		document.getElementById("email_add").focus();
		return false;
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

function check_add()
{
	
	var flag=0;
	var m=document.frm1.checkvalue.length+'';
		 
		    if(m=='undefined')
		   {
		    
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				
				flag ++;
			  }
		   }
		   if(flag==0)
		   {
		   		alert("Please choose any email address");
				return false;
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
	  <?php /*?><!--<td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome 
  <?=$_SESSION['admin_user_name']?></span></td>
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
	   <form action="send_mail_process.php" method="post" name="frm1" id="frmnews" onsubmit="javascript:return check_add();">
	   <input type="hidden" name="act" value="send_news_letter" />
	    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
			<td align="left">&nbsp;<span class="style2">Send Newsletter Section</span> </td>
              <td align="right" class="media3"><a class="brownbttn" href="send_mail_process.php?act=all">view all mail</a> </td>
              </tr>
          </thead>
          <tbody>

            <? if($_REQUEST['m']){ ?>
            <tr class="row1">
              <td colspan="7" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
			<? } ?>
			
			   <tr class="row2">
              <td colspan="2" align="center" valign="top">
			  <table width="97%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
                  <td>&nbsp;<strong>Select user(s) to send mail </strong></td>
                </tr>
				<tr>
                  <td align="left"><input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/><b>Select all</b> </td>
                </tr>
				<tr>
                  <td align="left" valign="top">
				  <div style="overflow:auto; height:80px;">
			   			<? 
						$i=0;   
						$sql="SELECT * FROM ".$cfg['DB_NEWSLETTER_EMAIL']." where `siteId`='".$cfg['SESSION_SITE']."'";
						$res=$heart->sql_query($sql);
						$maxrow=$heart->sql_numrows($res);
						if($maxrow>0){
						$numberscount=0;
						?>
						<table><tr>
						<?
						while($row=$heart->sql_fetchrow($res)){
						$numberscount++;
						?>
                		<td><input  name="checkvalue[]" id="checkvalue"  value="<?=$row['email']?>" type="checkbox" />
					  &nbsp;<?=$row['email']?></td>
					  <? if($numberscount%3==0){?> </tr><tr><? } ?>
					                 
			<? } ?>
			</tr></table>
			<? }?></div>	</td>
			     </tr>
              </table></td>
              </tr>
			<tr class="row1">
              <td colspan="2" align="center" valign="top" style="border-right:1px solid #CCCCCC;">
			  <table width="97%" border="0" cellspacing="3" cellpadding="4">
			    <tr>
			      <td width="44%" class="leftBarText_new">&nbsp;Mail Subject</td>
			      <td width="56%"><input type="text" name="subject" id="subject" class="forminputelement" size="25" value=<?=($_SESSION['sub']!="")?$_SESSION['sub']:''?> ></td>
			    </tr>
			    <tr>
			      <td colspan="2" align="left" class="leftBarText_new">&nbsp;Mail Content</td>
			      </tr>
			    <tr>
                  <td colspan="2">
                  	<textarea name="eContent" id="eContent" rows="10" cols="" class="textareawid">
		                
		            </textarea>
		              <script>
		                // Replace the <textarea id="editor1"> with a CKEditor
		                // instance, using default configuration.
		                CKEDITOR.replace( 'eContent' );
		            </script>
                      <?php
				// FCKEDITOR
			/*	$oFCKeditor = new FCKeditor('eContent') ;
				$oFCKeditor->BasePath	= $sBasePath;
				$oFCKeditor->Width		= '100%';
				$oFCKeditor->Height		= '400';
				$oFCKeditor->ToolbarSet	= 'Default';
				$oFCKeditor->Value		= '';
				print $oFCKeditor->CreateHtml(); */
				?>				</td>
                </tr>
			</table>			  			  </td>
              </tr>
			 
			<tr class="row2">
			  <td colspan="2" align="center" valign="middle" class="media3">
			    <input name="Submit" type="submit" class="loginbttn" value="Send">			  </td>
			  </tr>
			 <tr>
			  <td align="right">&nbsp;</td>
			   <td align="right" class="redbuttonelements">
				<div class="bottomsecc">
					<a class="brownbttn" href="send_mail_process.php?act=add">Add Newsletter</a>
				</div>
			   </td>
		    </tr>
			
            
		  
		<!--Section-->
          </tbody>
        </table>
		</form>
		
		
		<? }
		if($show=='add'){
	 ?>
	 <form method="post" action="send_mail_process.php" name="fr" onsubmit="return val();">
	 <input name="act" type="hidden" value="addnewmail">
	 <input name="valid_add" id="valid_add" type="hidden" value="">
	  <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="4" align="left">&nbsp;<span class="style2">Add Newsletter Section</span> </td>
            </tr>
          </thead>
          <tbody>
			 <? if($_REQUEST['m']){ ?>
            <tr>
              <td height="20" colspan="2" align="right" class="row1"><?=@$msg?></td>
            </tr>
			<? } ?>
			<tr>
              <td height="20" align="center" class="row2">Name<span class="redstar">*</span></td>
			  <td height="20" align="left" class="row2"><input type="text" name="name_add" id="name_add" class="forminputelement"></td>
            </tr>
			<tr>
              <td height="20" align="center" class="row1">Email Id<span class="redstar">*</span></td>
			  <td height="20" align="left" class="row1"><input type="text" name="email_add" id="email_add" class="forminputelement" onkeyup="check_emailadd(this.value);" onblur="check_emailadd(this.value);">&nbsp;&nbsp;<span style="display:none;" id="exists_add"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span><span style="display:none;" id="notexists_add"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Available</span><span style="display:none;" id="invalid_add"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Invalid Email id</span></td>
            </tr>
			<tr>
				<td align="center" colspan="2">
					<a class="brownbttn" href="newsletter.php" class="back">&lt;&lt;back</a>
					<input type="submit" name="sbemail" id="sbemail" value="Add" class="loginbttn">
				</td>
			</tr>
			
			 
          </tbody>
        </table>
		</form>
	   
	  <? }
		
		
		
	  if($show=='all'){
	 ?>
	  <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="5" align="left">&nbsp;<span class="style2">Newsletter Section</span> </td>
            </tr>
          </thead>
          <tbody>

            <tr>
              <td height="20" colspan="5" align="right" class="row1"><?=@$msg?></td>
            </tr>
            <tr class="headercontent">
				
              <td width="15%" align="center" class="leftBarText_new1">Sl No </td>
              <td width="41%" align="left" class="leftBarText_new1">Mail Subject </td>
              <td width="21%" align="center" class="leftBarText_new1">Date</td>
              <td width="12%" align="center" class="leftBarText_new1">Action</td>
            </tr>
		  <?
		  $i=0; 
		  $sql="SELECT * FROM ".$cfg['DB_NEWSMAIL']."WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `mStatus`='A' OR `mStatus`='I'";
			 $res=$heart->sql_query($sql);
			 $maxrow=$heart->sql_numrows($res);
			 $sql = $sql. " LIMIT $offset,$limit";
			 $res = $heart->sql_query($sql);
			 if($maxrow >0){
			 while($row=$heart->sql_fetchrow($res)){
			 @$i++;
			?>
            <tr>
				
              <td align="center" class="row2"><?=$i+$offset?></td>
              <td align="left" class="row2" ><a href="send_mail_process.php?act=view&id=<?=$row['newsmailId']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>"><?=$row['mailSub']?></a></td>
              <td align="center" valign="middle" class="row2" ><?=getdataformat1($row['sendDate'])?></td>
              <td align="center" class="row2"><a href="send_mail_process.php?act=view&id=<?=$row['newsmailId']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a><?php /*?><a href="newslist_process.php?act=edit&id=<?=$row['newsId']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a><a href="newslist_process.php?act=del&id=<?=$row['newsId']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" /></a><?php */?></td>
            </tr>
			<? }
			}
			  else {?>
            <tr>
              <td height="33" colspan="5" align="center" class="msg">No Record.</td>
            </tr>  <? }?>
			 <tr bgcolor="#0F0F0F">
              <td colspan="5" align="right" style="background-color:#eee8e8;" class="tborder_new">
				<div class="bottomsecc">
					<a href="newsletter.php" class="brownbttn">Send new mail</a>
				</div>
			  </td>
            </tr>
			<tr bgcolor="#0F0F0F">
			  <td colspan="5" align="right" style="background-color:#eee8e8;" class="tborder_new"><?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?></td>
		    </tr>
          </tbody>
        </table>
	   
	  <? }
	  
	  if($show=='view'){
	  $sql="SELECT * FROM ".$cfg['DB_NEWSMAIL']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `newsmailId` = '".$_REQUEST['id']."'";
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
	  
	  ?>
	  <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Newsletter Section </td>
            </tr>
          </thead>
          <tbody>
             <tr>
              <td width="26%" align="left" class="row2"><span class="leftBarText_new">Mail Subject </span></td>
              <td width="74%" colspan="2" align="left" class="row2"><?=$row['mailSub']?></td>
            </tr>
            
			
            <tr>
              <td class="row1" align="left"><span class="leftBarText_new">Mail Content </span></td>
              <td colspan="2" align="left" class="row1"><?=stripslashes($row['mailContent'])?></td>
            </tr>
            <tr>
              <td class="row2" align="left"><span class="leftBarText_new">Sender Address </span></td>
              <td colspan="2" align="left" class="row2">
			  <? $email = explode(',',$row['usrEmail']);
			  for($i=0; $i<=count($email);$i++){ 
			  if($i==6){echo '<br>';}
			  if($i<count($email))
			  	{
					echo $email[$i].',';
			  	}
			  if($i==(count($email)-1)){
				echo $email[$i];
				}
			  }
			  
			  ?></td>
            </tr>
            <tr>
              <td class="row1" align="left"><span class="leftBarText_new">Sent Date </span></td>
              <td colspan="2" align="left" class="row1"><?=getdataformat1($row['sendDate'])?></td>
            </tr>
            <tr>
              <td class="row2" align="left"><span class="leftBarText_new">Status</span></td>
              <td colspan="2" align="left" class="row2"><?=($row['mStatus']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" style="padding-top:10px; padding-bottom:10px;">
				<a class="brownbttn" href="newsletter.php?show=all&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>" class="back">&lt;&lt;back</a>
			  </td>
            </tr>
          </tbody>
        </table>
	   
	  <? }?>
		
		
		
	 
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
  <?php
  	//session_unregister('sub'); 
	unset($_SESSION['sub']);
  ?>
