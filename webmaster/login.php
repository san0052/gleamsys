<?php
    include('../includes_webmaster/links.php');
	include('../includes_webmaster/template.php');
	switch($action){
		//login section
		case md5("login"):
			$user_name = $_REQUEST['uname'];
			$user_pass = $heart->encoded($_REQUEST['pass']);
			if($heart->login($user_name,$user_pass)){
        $sql="INSERT INTO " .$cfg['DB_LOGIN_RECORDS']. " (`ip`,`sessionId`,`loginTime`) VALUES ( '".$_SERVER['REMOTE_ADDR']."','".session_id()."','".date('Y-m-d H:i:s')."')";
        $insetData = $heart->sql_query($sql);
        if($insetData){
				  $heart->redirect("admin.php");
        }else{
           $heart->redirect("login.php");
        }
			}else{
				$msg = "User name or Password may be incorrect...";
			}
			break;
		//logout section
		case md5("logout"):
			$heart->logout("login.php");
			break;
		default:
			break;
	}
	page_header(":: ADMIN SECTION ::");	
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<!-- Start Body Here -->
<TD vAlign="middle" align="center" width="99%"><TABLE width="637" height="321" border=0 align=center cellPadding=0 cellSpacing=0 class=tborder>
    <TBODY>
    <FORM name="frm_login" onsubmit="submitonce(this)" action="login.php" method="post">
      <INPUT id="act" type="hidden" value="<?=md5("login")?>" name="act">
      <TR>
        <TD height="30">&nbsp;</TD>
        <TD width="31%" align="right">&nbsp;</TD>
        <TD width="35%" height="37" align="right" valign="top"><table width="210" height="37" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center" valign="middle" background="images/forgot_pass.jpg" class="cornerlogsec">Login </td>
            </tr>
          </table></TD>
        <TD width="5%">&nbsp;</TD>
      </TR>
      <TR>
        <TD vAlign=center align=center colSpan=4 class="msgerrors" style="padding:20px;"><?=isset($msg)?$msg:""?></TD>
      </TR>
      <TR>
        <TD align="center" colSpan=4 valign="middle"><TABLE width="69%" border=0 align="center">
            <TBODY>
              <TR>
                <TD class="commontxtnew loglabb" align=left width="33%">User Name</TD>
                <TD width="67%"><INPUT class="forminputelement_big loginputsec" id=uname size=30 
name=uname value="<?=isset($user_name)?$user_name:""?>"></TD>
              </TR>
              <TR>
                <TD class=commontxtnew align=left>&nbsp;</TD>
                <TD>&nbsp;</TD>
              </TR>
              <TR>
                <TD class="commontxtnew loglabb" align=left>Password</TD>
                <TD><INPUT class="forminputelement_big loginputsec" id=pass type=password 
size=30 name=pass></TD>
              </TR>
            </TBODY>
          </TABLE>
          <br />
          <br />
          <table align="center">
            <tbody>
              <tr>
                <td><input class="loginbttn" type="submit" value="Login" name="submit" />
                  &nbsp;&nbsp;
                  <input class="blakbttn" type="reset" value="Cancel" name="reset" />
                </td>
              </tr>
            </tbody>
          </table></TD>
      </TR>
      <TR>
        <TD align=left width="29%">&nbsp;</TD>
        <TD colspan="2" align=right>&nbsp;
          <!--<a href="http://www.directvvsdish.com/webmaster/Dish.chm" target="_blank">Click here to download user guide</a>--></TD>
        <TD align=right>&nbsp;</TD>
      </TR>
    </FORM>
    </TBODY>
    
  </TABLE>
  