<?php
//include_once('links_frontend.php');
	
	include_once('../lib/class.common.php');
	
	
	/*echo $sql="SELECT * FROM ".$cfg['DB_WATERMARK']." AND `status`='A'";
	$res=$heart->sql_query($sql);
	$row=$heart->sql_fetchrow($res);*/
	
	
	$path   = (isset($_REQUEST['path']) AND (is_file($_REQUEST['path'])))?$_REQUEST['path']:"photo_gallary/default.jpg";
	$width  = $_REQUEST['width'];
	$height = $_REQUEST['height'];
	$pic = $_REQUEST['pic'];
	$img = new Thumbnail($path,$width,$height,'',99,'');
	$img->merge('../image_bank/watermark/'.$pic, 157, 87, 70, 50, 60, "");
	$image=$img->create();
	print($image);
 ?>
 