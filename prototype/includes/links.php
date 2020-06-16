<?php
@session_start();
header("Cache-Control: no-cache, must-revalidate");
$user=@$_SESSION['admin_user_name'];
include_once("configure.php");
include_once("configure.override.php");
include_once("configure.dir.php");
include_once("function.php");
include_once("template.php");
//include_once("authentication-check.php");
include_once("../lib/class.common.php"); 
//include_once("scripts/FCKeditor/fckeditor.php");
//$sBasePath = "scripts/FCKeditor/" ;

$mycms		=	new CMS();
$mycommoncms	= new CommonCMS();



$mycms->del_cache();
//$shopConfig = getShopConfig();
function startTime(){
	global $mycms;
	return $mycms->microtime_float();
}
$startTime=startTime();
function endTime(){
	global $mycms;
	global $startTime; 
	$time_end = $mycms->microtime_float();
	return $time_end - $startTime;
}

function isEven ($num){
   return !($num % 2);
} 
function processURI() { 
	$url = str_replace("/adminxp","",$_SERVER["REQUEST_URI"]);
	$request = explode("/",$url);
	$count = count($request);     
    for ($i = 1 ; $i < $count ; $i++) {              
        $values["url".$i] = $request[$i];   
    }
    return $values;   
}
$cfg['PAGE_NAME']	= basename($_SERVER['PHP_SELF']);



$action=(isset($_REQUEST['act']))?$_REQUEST['act']:"";
$limit  =20;// $cfg['LINK_PER_PAGE'];
$offset = (isset($_REQUEST['pageno']) AND $_REQUEST['pageno']!=0)?$_REQUEST['pageno']*$limit:"0";
$pageno = (isset($_REQUEST['pageno']) AND $_REQUEST['pageno']!=0)?$_REQUEST['pageno']:"0"; 
$order  = (isset($_REQUEST['order']) AND ($_REQUEST['order']=="ASC"))?"DESC":"ASC";


function formatAdAddress($adArray){
	$sql = "SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE `country_id` = ".$adArray['add_country']."";
	$res = $mycms->sql_query($sql);
	$country ='' ;}

foreach($_GET as $key=>$request)
{
	$str=str_replace('\'', '', $request);
	$str=str_replace(';', '', $str);
	$str=str_replace('"', '', $str);
	$_GET[$key]=$str;
}
$limit 		=	50;
if($_REQUEST['pageno']==''){
	$pageNumber		=	0;	
}else {
	$pageNumber		=	$_REQUEST['pageno'];
}
$offset 	=	$pageNumber*$limit;
?>

