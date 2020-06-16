<?php
	include_once('../lib/class.common.php');
	$path   = (isset($_REQUEST['path']) AND (is_file($_REQUEST['path'])))?$_REQUEST['path']:"photo_gallary/default.jpg";
	$width  = $_REQUEST['width'];
	$height = $_REQUEST['height'];
	$img = new Thumbnail($path,$width,$height,'',80,'');
	$img->round_edges(0,"ffffff",0);
	$image=$img->create();
	print($image);
 ?>
 