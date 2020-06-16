<?php
@session_start();
//header("Cache-Control: no-cache, must-revalidate");
date_default_timezone_set("Asia/Kolkata");

$user=@$_SESSION['admin_user_name'];
//$_SESSION['H_MENU'].='';
include("timeFunction.php");
include_once("configure.php");
include_once("function.php");
include_once("product-functions.php");
include_once("category-functions.php");
// $cfg['DIR_WS_CLASSES']."class.common.php";
//include_once($cfg['DIR_WS_CLASSES']."class.common.php");
include_once("lib_webmaster/class.common.php"); 
include_once("scripts/FCKeditor/fckeditor.php");
$sBasePath = "scripts/FCKeditor/" ;
$_SESSION['shoppingReturnUrl'] = $_SERVER['REQUEST_URI'];

$heart= new commonClass();
$heart->del_cache();
$shopConfig =getShopConfig();
function startTime(){
	global $heart;
	return $heart->microtime_float();
}
$startTime=startTime();
function endTime(){
	global $heart;
	global $startTime; 
	$time_end = $heart->microtime_float();
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
$limit  =16;// $cfg['LINK_PER_PAGE'];
$limit1  =9;// $cfg['LINK_PER_PAGE'];
$offset = (isset($_REQUEST['pageno']) AND $_REQUEST['pageno']!=0)?$_REQUEST['pageno']*$limit:"0";
$offset1 = (isset($_REQUEST['pageno']) AND $_REQUEST['pageno']!=0)?$_REQUEST['pageno']*$limit1:"0";
$limitprod  =20;// $cfg['LINK_PER_PAGE'];
$offsetprod = (isset($_REQUEST['pageno']) AND $_REQUEST['pageno']!=0)?$_REQUEST['pageno']*$limitprod:"0";
$limitloc  =90;// $cfg['LINK_PER_PAGE'];
$offsetloc = (isset($_REQUEST['pageno']) AND $_REQUEST['pageno']!=0)?$_REQUEST['pageno']*$limitloc:"0";
$pageno = (isset($_REQUEST['pageno']) AND $_REQUEST['pageno']!=0)?$_REQUEST['pageno']:"0"; 
$order  = (isset($_REQUEST['order']) AND ($_REQUEST['order']=="ASC"))?"DESC":"ASC";


function formatAdAddress($adArray){
	$sql = "SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE `country_id` = ".$adArray['add_country']."";
	$res = $heart->sql_query($sql);
	$country ='' ;}
?>