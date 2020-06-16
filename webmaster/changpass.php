<?php 
	include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
	if(isset($_REQUEST['act']) AND ($_REQUEST['act']=="1")){
	 $pass1 = $heart->encoded($_REQUEST['pass1']);
	 $pass2 = $heart->encoded($_REQUEST['pass2']);
	$user_check_quary = "SELECT * FROM ".$cfg['DB_WEBMASTER']." WHERE `user_pass` ='".$pass1."';";
	$user_check_result = $heart->sql_query($user_check_quary);
	if ($heart->sql_numrows($user_check_result)!=0){
	$change_pass = "UPDATE ".$cfg['DB_WEBMASTER']." SET `user_pass` = '".$pass2."'
	WHERE `a_id` = '".$_SESSION['admin_log_in']."' ";
	 $change_result = $heart->sql_query($change_pass);
	$MSG[] = "Password Changed...";
	}else{
	$ERR[] = "Please enter correct password.";
	}
}
	page_header($cfg['ADMIN_TITLE']." - Password Change Management");
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
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
            <?php /*?><!--<td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
              <?=$_SESSION['admin_user_name']?>
              </span></td>
            <td align="right" valign="middle" class="style5"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" /></a>&nbsp;&nbsp;</td>--><?php */?>
          </tr>
          <tr>
            <td colspan="2" style="background-color:#eee8e8;">&nbsp;
              <script language="javascript"  src="ajax.js"></script>
              <script language="javascript" type="text/javascript">
	  function submitform()	{
			validatePass();
			var url = 'actAjax=editpasword';
			obj = document.frm_changpass.elements;
			for(i=0;i<obj.length;i++){
				//alert(obj[i].type);
				if(obj[i].type=='text' || obj[i].type=='hidden' || obj[i].type=='password' ){
					if(url == '')
						url = obj[i].name+'='+obj[i].value;
					else
						url += '&'+obj[i].name+'='+obj[i].value;
				}
			}
			//alert(url);
		   document.getElementById("formArea").style.display = 'none';
		   document.getElementById("processArea").style.display = 'inline';
		   http.open('get','ajaxProcess.php?'+url);
		   http.onreadystatechange = handleOptionResponse;
		   http.send(null);	
		}
		function handleOptionResponse() {
		   if(http.readyState == 4 && http.status == 200){
			  var response = http.responseText;
			  if(response!=""){
				 document.getElementById("processArea").style.display = 'none';
				 document.getElementById("formArea").style.display = 'inline';
				 document.getElementById("formArea").innerHTML = '';
				 document.getElementById("formArea").innerHTML = response;
			  }
		   }
		}
		
		function change_password_valivation()
		{
			//alert('fdkjhfuoifsdih');
			if(document.frm_changpass.pass1.value==''){
			alert('Old password not found ');
			document.frm_changpass.pass1.focus();
			return false;
			}
			if(document.frm_changpass.pass2.value==''){
			alert('New password not found ');
			document.frm_changpass.pass2.focus();
			return false;
			}
			if(document.frm_changpass.pass2.value!=document.frm_changpass.pass3.value){
			alert('Conferm password Missmach ');
			document.frm_changpass.pass2.focus();
			return false;
			}
			//return false;
		}
	  </script>
              <form name="frm_changpass" onsubmit="return change_password_valivation()">
                <div id="formArea">
                  <p>
                    <input type="hidden" name="act" value="1" />
                  </p>
                  <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                    <thead>
                      <tr>
                        <td colspan="2" align="left" class="style2">Change Password </td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="row2">
                        <td colspan="2" align="left" ><?=Reporting()?></td>
                      </tr>
                      <tr class="row1">
                        <td width="42%" align="left" class="leftBarText_new">User Name</td>
                        <td width="58%" align="left"><strong>
                          <?=$_SESSION['admin_user_name']?>
                          </strong></td>
                      </tr>
                      <tr class="row2">
                        <td class="leftBarText" align="left"><span class="leftBarText_new">Old Password</span> <span class="redstar">*</span></td>
                        <td align="left"><input name="pass1" type="password" class="forminputelement" id="pass1"></td>
                      </tr>
                      <tr class="row1">
                        <td class="leftBarText" align="left"><span class="leftBarText_new">New Password</span> <span class="redstar">*</span></td>
                        <td align="left"><input name="pass2" type="password" class="forminputelement" id="pass2"></td>
                      </tr>
                      <tr class="row2">
                        <td class="leftBarText" align="left"><span class="leftBarText_new">Confirm Password</span> <span class="redstar">*</span></td>
                        <td align="left"><input name="pass3" type="password" class="forminputelement" id="pass3" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="left" valign="top"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn" >
                          &nbsp;
                          <input type="reset" name="Reset" id="Reset" class="blakbttn"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div align="center" id="processArea" style="display:none">
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p><img src="ajax-loader-xx.gif" border="0"></p>
                </div>
              </form></td>
          </tr>
          <tr height="16">
            <td colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="right"></td>
    </tr>
  </table>
