<?php
ob_start();
$pagename=$_SERVER['REQUEST_URI'];
$pagenameArray = explode("/",$pagename);
$_SESSION['request_page']=$pagenameArray[sizeof($pagenameArray)-1]; //local
$lastActivityTime	=	strtotime($_SESSION['lastActivityTime']);
$idleDuration		=	strtotime(date("Y-m-d H:i:s",time()-60*Session_Time_Out));
if($_SESSION['admin_login_uid']=='') {
	$mycommoncms->redirect("login.php");
}
else
{
	$_SESSION['lastActivityTime']	=	date('Y-m-d H:i:s');
}
ob_end_flush();
?>



