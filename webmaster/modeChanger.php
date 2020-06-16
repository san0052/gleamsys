<?
include_once('../includes_webmaster/links.php');
$cfg['SESSION_SITE']=$_REQUEST['mode'];
//echo $_SERVER['HTTP_REFERER'];
header( 'Location:'.$_SERVER['HTTP_REFERER']) ;
?>
