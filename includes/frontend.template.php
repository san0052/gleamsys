<?
//Meta Tags & Favicons
function setMetaTags($title)
{
	global $cfg , $mycms;
?>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title><?=$cfg['TITLE']?> - <?=$title?></title>
	<link rel="icon" type="image/ico" href="images2/fav.png"/>
<?
}

//Include Files
function pageHeader()
{
	global $cfg,$mycms;
?>
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/animate.css" type="text/css">
	<link rel="stylesheet" href="css/responsive.css" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<?
}
?>