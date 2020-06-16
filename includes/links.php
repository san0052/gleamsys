<?php
@session_start();
header("Cache-Control: no-cache, must-revalidate");
include_once("configure.php");
include_once("configure.override.php");
include_once("configure.language.php");
include_once("function.php");
include_once("frontend.template.php");
include_once("../libs/class.common.php"); 
include_once("scripts/FCKeditor/fckeditor.php");
$sBasePath 	=	"scripts/FCKeditor/" ;

$mycms		=	new commonClass();
$mycms->del_cache();

if($_SESSION['LANGUAGE']!='')
	$cfg['LANGUAGE']	=	$_SESSION['LANGUAGE'];

$action		=	(isset($_REQUEST['act']))?$_REQUEST['act']:"";
$limit  	=	100;// $cfg['LINK_PER_PAGE'];
$offset 	=	(isset($_REQUEST['pageno']) AND $_REQUEST['pageno']!=0)?$_REQUEST['pageno']*$limit:"0";
$pageno 	=	(isset($_REQUEST['pageno']) AND $_REQUEST['pageno']!=0)?$_REQUEST['pageno']:"0"; 
$order  	=	(isset($_REQUEST['order']) AND ($_REQUEST['order']=="ASC"))?"DESC":"ASC";


foreach($_GET as $key=>$request)
{
	$str		=	str_replace('\'', '', $request);
	$str		=	str_replace(';', '', $str);
	$str		=	str_replace('"', '', $str);
	$_GET[$key]	=	$str;
}
$language	=	($_SESSION['language']=='')?$cfg['LANGUAGE']:'English';
?>