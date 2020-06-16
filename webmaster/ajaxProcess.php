<?php 
	include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
	
$action=$_REQUEST['actAjax'];	
switch($action){
	case 'editpasword' :
	{		
		
		
		if(isset($_REQUEST['act']) && ($_REQUEST['act']=="1")){
			$pass1 = $heart->encoded($_REQUEST['pass1']);
			$pass2 = $heart->encoded($_REQUEST['pass2']);
			$user_check_quary = "SELECT * FROM ".$cfg['DB_WEBMASTER']." WHERE `user_pass` ='".$pass1."';";
			$user_check_result = $heart->sql_query($user_check_quary);
			if ($heart->sql_numrows($user_check_result)!=0){
				$change_pass = "UPDATE ".$cfg['DB_WEBMASTER']." SET `user_pass` = '".$pass2."'
				WHERE `a_id` = '".$_SESSION['admin_log_in']."' ";
				$change_result = $heart->sql_query($change_pass);
				$MSG[] = "Password Change...";
			}else{
				$ERR[] = "Please enter correct password.";
			}
		}
	
	?>

<input type="hidden" name="act" value="1" />
<table width="70%" class="tborder" cellSpacing=1 cellPadding=6>
  <THEAD>
    <TR>
      <TD class="tcat" colspan="2" align="left">Change Password </TD>
    </TR>
  </THEAD>
  <tbody>
    <tr class="alt1">
      <td colspan="2" align="left" class="alt1"><?=Reporting()?></td>
    </tr>
    <tr class="alt1">
      <td width="42%" align="left" class="leftBarText">User Name</td>
      <td width="58%" align="left"><?=$_SESSION['admin_user_name']?></td>
    </tr>
    <tr class="alt2">
      <td class="leftBarText" align="left"> Old Password <font color="#FF0000">*</font></td>
      <td align="left"><input name="pass1" type="password" class="forminputelement" id="pass1"></td>
    </tr>
    <tr class="alt1">
      <td class="leftBarText" align="left">New Password <font color="#FF0000">*</font></td>
      <td align="left"><input name="pass2" type="password" class="forminputelement" id="pass2"></td>
    </tr>
    <tr class="alt1">
      <td class="leftBarText" align="left">Confirm Password <font color="#FF0000">*</font></td>
      <td align="left"><input name="pass3" type="password" class="forminputelement" id="pass3" /></td>
    </tr>
    <tr class="alt2">
      <td>&nbsp;</td>
      <td><input type="button" name="Save" id="Save" value="Save" class="greenbuttonelements" onclick="submitform()">
        &nbsp;
        <input type="reset" name="Reset" id="Reset" class="redbuttonelements">
      </td>
    </tr>
  </tbody>
</table>
<?
		break;
	}
	default :
		break;
}
?>
