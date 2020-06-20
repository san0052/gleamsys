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

	break;
	
	case 'fetchAddress':	
		$email 		= stripslashes(strip_tags($_REQUEST['email']));
		global  $mycms,$cfg;
		//check mobile or Email exist
		$checkSql = "SELECT * FROM ".$cfg['DB_USERS']." WHERE `email` = '".$email."' ";
		$user	=	$mycms->sql_query($checkSql);
		$row	=	$mycms->sql_fetchrow($user);
		if (!empty($row)) {
			echo json_encode(array('status'=>true, 'user_exist'=> 1, 'details'=>$row)); die;
		}
	
	break;


	case 'updateAddress':

	$name 		= stripslashes(strip_tags($_REQUEST['name']));
	$mobile 	= stripslashes(strip_tags($_REQUEST['mobile']));
	$email 		= stripslashes(strip_tags($_REQUEST['email']));
	$location 	= stripslashes(strip_tags($_REQUEST['location']));
	$city 		= stripslashes(strip_tags($_REQUEST['city']));
	$state 		= stripslashes(strip_tags($_REQUEST['state']));
	$country 	= stripslashes(strip_tags($_REQUEST['country']));
	$pincode 	= stripslashes(strip_tags($_REQUEST['pincode']));
	$password   = rand(100000,999999);

	$checkSql = "SELECT `email` FROM ".$cfg['DB_USERS']." WHERE `email` = '".$email."' ";
	$user	=	$mycms->sql_query($checkSql);
	$row	=	$mycms->sql_fetchrow($user);
	if (!empty($row)) {
		$sql1="UPDATE ".$cfg['DB_USERS']." SET
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
		$registerUsers = "INSERT INTO ".$cfg['DB_SHIPPING_ADDRESS']."
								 SET
								 	`name`		=   '".$name."',
								    `mobile`	=   '".$mobile."',
								    `email`		=	'".$email."', 
									`location`	=	'".$location."',  
									`city`		=	'".$city."',
									`state`		=	'".$state."',
									`country`	=	'".$country."',
									`pincode`	=	'".$pincode."',
									`password`	=	'".md5($password)."',
									`session_id`=	'".session_id()."',
									`created_at`=	'".date('Y-m-d H:i:s')."',
									`ip`		=	'".$_SERVER['REMOTE_ADDR']."'";
			$ins = $mycms->sql_insert($registerUsers);

		if($sql1){
			echo json_encode(array('status'=>true,'message'=>'Your shipping address updated successfully','data_id'=>$ins));die;
		}else{
			echo json_encode(array('status'=>false,'message'=>'Failed to update shipping address')); die;
		}
	}else{
			$registerUsers = "INSERT INTO ".$cfg['DB_USERS']."
							 SET
							 	`name`		=   '".$name."',
							    `mobile`	=   '".$mobile."',
							    `email`		=	'".$email."', 
								`location`	=	'".$location."',  
								`city`		=	'".$city."',
								`state`		=	'".$state."',
								`country`	=	'".$country."',
								`pincode`	=	'".$pincode."',
								`password`	=	'".md5($password)."',
								`session_id`=	'".session_id()."',
								`created_at`=	'".date('Y-m-d H:i:s')."',
								`ip`		=	'".$_SERVER['REMOTE_ADDR']."'";

		$ins = $mycms->sql_insert($registerUsers);
		if (!empty($ins)) {
			$userLogin = "INSERT INTO ".$cfg['DB_USER_LOGIN']."
							 SET
							 	`user_id`		=	".$ins.",
							    `user_email`	=	'".$email."', 
								`user_password`	=	'".md5($password)."',
								`session_id`	=	'".session_id()."',
								`created_at`	=	'".date('Y-m-d H:i:s')."',
								`ipAddress` 	=	'".$_SERVER['REMOTE_ADDR']."'
								";
			$ins1 = $mycms->sql_insert($userLogin);

			$registerUsers = "INSERT INTO ".$cfg['DB_SHIPPING_ADDRESS']."
							 SET
							 	`name`		=   '".$name."',
							    `mobile`	=   '".$mobile."',
							    `email`		=	'".$email."', 
								`location`	=	'".$location."',  
								`city`		=	'".$city."',
								`state`		=	'".$state."',
								`country`	=	'".$country."',
								`pincode`	=	'".$pincode."',
								`session_id`=	'".session_id()."',
								`password`	=	'".md5($password)."',
								`created_at`=	'".date('Y-m-d H:i:s')."',
								`ip`		=	'".$_SERVER['REMOTE_ADDR']."'";

		$ins = $mycms->sql_insert($registerUsers);
	
		echo json_encode(array('status'=>'success','message'=>'User registered successfully', 'data_id'=>$ins)); die;
		} else {
			echo json_encode(array('status'=>false,'message'=>'Failed to register user')); die;
		}

	}
	break;
}
