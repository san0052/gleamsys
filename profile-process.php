<?php
include_once("includes/links_frontend.php");
$action = $_REQUEST['act'];
switch($action)
{
	case 'updateUser_Profile':

	$name 		= stripslashes(strip_tags($_REQUEST['name']));
	$mobile 	= stripslashes(strip_tags($_REQUEST['mobile']));
	$email 		= stripslashes(strip_tags($_REQUEST['email']));
	$location 	= stripslashes(strip_tags($_REQUEST['location']));
	$city 		= stripslashes(strip_tags($_REQUEST['city']));
	$state 		= stripslashes(strip_tags($_REQUEST['state']));
	$country 	= stripslashes(strip_tags($_REQUEST['country']));
	$pincode 	= stripslashes(strip_tags($_REQUEST['pincode']));

	$userPhoto = $_FILES['image']['name'];
	$temp 	   = $_FILES['image']['tmp_name'];
	   
	$last_id = 'userProfile';
	if($userPhoto!='')
	{

			$file_ext1=explode(".",$userPhoto);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="uploads/userProfile/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($temp,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_USERS']." SET
	       `name` 		= '".$name."',
	       `mobile` 	= '".$mobile."',
	       `email` 		= '".$email."',
	       `location` 	= '".$location."',
	       `city` 		= '".$city."',
	       `state` 		= '".$state."',
	       `country` 	= '".$country."',
	       `pincode` 	= '".$pincode."',
	       `image` 		= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
		$mycms->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_USERS']." SET
		       	`name` 		= '".$name."',
		     	`mobile` 	= '".$mobile."',
		     	`email` 	= '".$email."',
		     	`location` 	= '".$location."',
		     	`city` 		= '".$city."',
		     	`state` 	= '".$state."',
		     	`country` 	= '".$country."',
		     	`pincode` 	= '".$pincode."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$mycms->sql_query($sql1);
	}
	$mycms->redirect('profile.php');
}