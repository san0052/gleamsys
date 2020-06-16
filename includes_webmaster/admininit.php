<?php
include('../includes_webmaster/template.php');
$pagename=$_SERVER['REQUEST_URI'];
$pagename=explode("/",$pagename);
//echo ($pagename[2]);for public site
//echo ($pagename[3]);for localhost or as per directory
//session_register('request_page');
//$_SESSION['request_page']=$pagename[2];
$_SESSION['request_page']=$pagename[3]; //local
if($_SESSION['admin_login_uid']=='') {
	$heart->redirect("login.php");	

}

?>