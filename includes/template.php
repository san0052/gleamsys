<?php
include_once('links.php');

function page_header($HeaderTitle)
{
	global $cfg,$mycms;
?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/tr/1999/REC-html401-19991224/loose.dtd">
		<html>
			<head>
				<title><?=$HeaderTitle;?></title>
				<meta http-equiv=Content-Type content="application/xhtml+xml; charset=UTF-8">
				<link href="favicon.ico" rel="shortcut icon">
				<script language="javascript" src="js/jquery-1.7.2.min.js"></script>
				<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
				<script type="text/javascript" language="javascript">
					$(document).ready(function(){
						$('div.msg').delay(1200).slideUp('slow');
					});
				</script>
				<META content="MSHTML 6.00.2900.2722" name=GENERATOR>
			</head>
			<body style="overflow-x:hidden; ">
				<h1 class="myheader">					
					<a href="login-details.php" class="logo"><!--<img src="../images/logo.png" class="admin-logo" align="absmiddle"/>-->Kunani</a>
					<div onClick="showMenu();" id="menuicn" class="menu_icn"></div>
					<div class="welcome_box">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tbody>
								<tr>
									<td width="30%" align="right" valign="top">
										<div class="user_name" onClick="window.location.href='login-details.php';">Welcome, <?=admin_name($_SESSION['admin_login_uid'])?></div>
										<div class="welcome_list">
											<ul>
												<li onClick="window.location.href='login-details.php'" style="cursor:pointer;">Dashboard</li>
												<li onClick="window.location.href='changpass.php';">Change Password</li>
												<li onClick="window.location.href='login.php?act=<?=md5("logout")?>'">Log Out</li>
											</ul>
										</div>
									</td>
									<td width="5%" align="left" valign="top">								
										<div class="arow"><a href="javascript:void(0);"><img src="images/hdr_top_arw.png" alt=" "></a></div>										
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</h1>
<?php
}

function page_footer()
{
	global $cfg,$mycms;
?>
<div class="clear"></div>
<script>
	var height=$(document).height();
	var width=$(document).width();
	width=(width-210);
	height=(height-60);
	$('.left_body').css({
	    minHeight:height
	});
	//$('.left_body').height(height);
	$('.mainTable').width(width+'px');
	$('.mainTable').css({
	    marginLeft:'210px'
	});
</script>
<?php
}
?>
