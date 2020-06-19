<?php
include_once("includes/links_frontend.php");
$action = $_REQUEST['act'];
switch($action)
{
	case 'updateShipAddress':

	$name 		= stripslashes(strip_tags($_REQUEST['name']));
	$mobile 	= stripslashes(strip_tags($_REQUEST['mobile']));
	$email 		= stripslashes(strip_tags($_REQUEST['email']));
	$location 	= stripslashes(strip_tags($_REQUEST['location']));
	$city 		= stripslashes(strip_tags($_REQUEST['city']));
	$state 		= stripslashes(strip_tags($_REQUEST['state']));
	$country 	= stripslashes(strip_tags($_REQUEST['country']));
	$pincode 	= stripslashes(strip_tags($_REQUEST['pincode']));

	
	$sql1="UPDATE ".$cfg['DB_SHIPPING_ADDRESS']." SET
	       	`name` 		= '".$name."',
	     	`mobile` 	= '".$mobile."',
	     	`email` 	= '".$email."',
	     	`location` 	= '".$location."',
	     	`city` 		= '".$city."',
	     	`state` 	= '".$state."',
	     	`country` 	= '".$country."',
	     	`pincode` 	= '".$pincode."'
	        WHERE `email` = '".$email."' ";
	$mycms->sql_query($sql1);
	if($sql1){
		echo json_encode(array('status'=>true,'message'=>'Your shipping address updated successfully'));die;
	}else{
		echo json_encode(array('status'=>false,'message'=>'Failed to update shipping address')); die;
	}
}