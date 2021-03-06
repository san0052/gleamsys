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

		$checkSql = "SELECT `email`,`id` FROM ".$cfg['DB_USERS']." WHERE `email` = '".$email."' ";
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
										`session_id`=	'".session_id()."',
										`created_at`=	'".date('Y-m-d H:i:s')."',
										`ip`		=	'".$_SERVER['REMOTE_ADDR']."'";
				$ins = $mycms->sql_insert($registerUsers);
				
			if($sql1){
					session_start();
					$_SESSION['gleam_users_session'] = array(
						'email' => $row['email'],
						'user_id' => $row['id']
					);
				echo json_encode(array('status'=>true,'message'=>'Your shipping address updated successfully','data_id'=>$ins));die;
			}else{
				echo json_encode(array('status'=>false,'message'=>'Failed to update shipping address')); die;
			}
		}else{

			//check mobile exist
			$checkSqlMobile = "SELECT `mobile` FROM ".$cfg['DB_USERS']." WHERE `mobile` = '".$mobile."'";
			$resMobile	=	$mycms->sql_query($checkSqlMobile);
			$rowMobile	=	$mycms->sql_fetchrow($resMobile);
			if (!empty($rowMobile)) {
				echo json_encode(array('status'=>false,'message'=>'Mobile already exist')); die;
			}

			// check email exist
			$checkSqlEmail = "SELECT `email` FROM ".$cfg['DB_USERS']." WHERE `email` = '".$email."'";
			$resEmail	=	$mycms->sql_query($checkSqlEmail);
			$rowEmail	=	$mycms->sql_fetchrow($resEmail);
			if (!empty($rowEmail)) {
				echo json_encode(array('status'=>false,'message'=>'Email already exist')); die;
			}
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

					session_start();
					$_SESSION['gleam_users_session'] = array(
						'email' => $email,
						'user_id' => $ins
					);
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
									`created_at`=	'".date('Y-m-d H:i:s')."',
									`ip`		=	'".$_SERVER['REMOTE_ADDR']."'";
								
				$ins = $mycms->sql_insert($registerUsers);

					//Send Email To Admin
					$mail.='			<table width="100%" border="0" cellspacing="0" cellpadding="12" style="min-width: 700px;">';
					$mail.='				<tr>';
					$mail.='					<td height="9" colspan="3" align="left" valign="top" style="padding:1em 0 0 0;"><h2>New User Registration</h2></td>';
					$mail.='				</tr>';
					$mail.='					<tr>';
					$mail.='						<td style="width:10%; padding:0;">Name</td>';
					$mail.='						<td style="width:2%; padding:0;">:</td>';
					$mail.='						<td style="width:88%; padding:0;">'.$name.'</td>';
					$mail.='					</tr>';
					$mail.='					<tr>';
					$mail.='						<td style="width:10%; padding:0;">Contact</td>';
					$mail.='						<td style="width:2%; padding:0;">:</td>';
					$mail.='						<td style="width:88%; padding:0;">'.$mobile.'</td>';
					$mail.='					</tr>';
					$mail.='					<tr>';
					$mail.='						<td style="width:10%; padding:0;">Email</td>';
					$mail.='						<td style="width:2%; padding:0;">:</td>';
					$mail.='						<td style="width:88%; padding:0;">'.$email.'</td>';
					$mail.='					</tr>';
					$mail.='					<tr>';
					$mail.='						<td style="width:10%; padding:0;">Address</td>';
					$mail.='						<td style="width:2%; padding:0;">:</td>';
					$mail.='						<td style="width:88%; padding:0;">'.$location.','.$city.', '.$state.', '.$pincode.', '.$country.'</td>';
					$mail.='					</tr>';
					$mail.='					<tr>';
					$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding:10px; border:1px solid #ccc; background:#f9f9f9;">';
					$mail.='							<p style="font-weight:bold;">Query :</p>';
					$mail.='							<p></p>';
					$mail.='						</td>';
					$mail.='					</tr>';
					$mail.='				</table>';		
					
					$message		=	'New User Registration';
					
					$to_name 		=	'Admin';
					$to_email 		=	$cfg['INFO_EMAIL'];
					$form_name 		=	$cfg['ADMIN_NAME'];
					$form_email		=	$cfg['ADMIN_EMAIL'];
					$subject		=	"User Query";		
					send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message);		
						
					/* ***** Send Email ***** */
					$to_name 		=	$name;
					$to_email 		=	$email;
					$form_name 		=	$cfg['ADMIN_NAME'];
					$form_email		=	$cfg['ADMIN_EMAIL'];
					$subject		=	"Login Credentials";		
					$message		.=	'Dear '.$name.',<br/><br/> your login credentials.<br>';
					$message 		.= 	'Email - '.$email.'<br> Password - '.$password;
					send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='');
		
				echo json_encode(array('status'=>'success','message'=>'User registered successfully', 'data_id'=>$ins)); die;
			} else {
				echo json_encode(array('status'=>false,'message'=>'Failed to register user')); die;
			}

		}
	break;

	/*case 'place_order':
		$shipping_id = !empty($_REQUEST['shippingAddressId'])?$_REQUEST['shippingAddressId']:'';
		$cart_session = !empty($_SESSION['gleam_cart_session'])?$_SESSION['gleam_cart_session']:'';

		if (!empty($shipping_id) && !empty($cart_session)) {
			$totalAmount=0;
			foreach ($cart_session as $cart) {
				$sqlgetCartDet = "SELECT pd_id, pd_image, pd_price, pd_name, pd_qty FROM ".$cfg['DB_PRODUCT']." WHERE `status` ='A' AND `pd_id` = '".$cart['product_id']."'";
				$cart	=	$mycms->sql_query($sqlgetCartDet);
				$rows	=	$mycms->sql_fetchrow($cart);
				if (!empty($rows)) {
					$totalAmount += $rows['pd_price'];
				}
			}

			$checkSql = "SELECT * FROM ".$cfg['DB_SHIPPING_ADDRESS']." WHERE `id` = '".$shipping_id."' ";
			$shipping	=	$mycms->sql_query($checkSql);
			$row		=	$mycms->sql_fetchrow($shipping);
			if (!empty($row)) {
				$time = time();
				$random_number = 'GLEAM_'.$time.'_'.rand(100,9999);
				$insert_order = "INSERT INTO ".$cfg['DB_ORDER']." SET
							 	`delivery_time`		=   '".date('Y-m-d H:i:s')."',
							    `siteId`			=   '2',
							    `od_date`			=	'".date('Y-m-d')."', 
								`od_delivery_date`	=	'".date('Y-m-d H:i:s')."',
								`od_status`			=	'Unpaid',
								`od_delivered_by`	=	'',
								`od_feedback`		=	'',
								`od_received_by`	=	'',
								`od_amount`			=	'".$totalAmount."',
								`od_shipping_first_name`	=	'".$row['name']."',
								`od_shipping_email`	=	'".$row['email']."',
								`od_shipping_last_name`	=	'',
								`od_shipping_address1`	=	'".$row['location']."',
								`od_shipping_phone`	=	'".$row['mobile']."',
								`od_shipping_city`	=	'".$row['city']."',
								`od_shipping_state`	=	'".$row['state']."',
								`od_shipping_country`	=	'".$row['country']."',
								`or_pattern`		=	'".$random_number."',
								`od_shipping_postal_code`	=	'".$row['pincode']."'
							";
				$ins = $mycms->sql_insert($insert_order);
				if (!empty($ins)) {
					foreach ($cart_session as $cart) {
						$insert_order_item = "INSERT INTO ".$cfg['DB_ORDER_ITEM']." SET
							`od_id` = '".$ins."',
							`siteId` = '2',
							`pd_id`	= '".$cart['product_id']."',
							`od_qty` = '".$cart['product_count']."'
						";
						$ins1 = $mycms->sql_insert($insert_order_item);

						// update product count
						$update_product_count = "UPDATE ".$cfg['DB_PRODUCT']." SET 
						`pd_qty` = `pd_qty` - '".$cart['product_count']."' WHERE `pd_id` = '".$cart['product_id']."'";
						$upd = $mycms->sql_query($update_product_count);

					}
					echo json_encode(array('status'=>true,'message'=>'cart updated')); die;
				}
			}
		} else {
			echo json_encode(array('status'=>false,'message'=>'Something went wrong.')); die;
		}
		break;*/
}
