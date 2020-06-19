<?php
include_once("includes/links_frontend.php");
$action = $_REQUEST['act'];
switch($action)
{
	
	case 'login':

		$email 		= stripslashes(strip_tags($_REQUEST['email']));
		$password 	= stripslashes(strip_tags($_REQUEST['password']));

		global  $mycms,$cfg;
		// // check email exist
		$checkSqlEmail = "SELECT `user_id`,`user_email`,`user_password` FROM ".$cfg['DB_USER_LOGIN']." WHERE `user_email` = '".$email."'";
		$resEmail	=	$mycms->sql_query($checkSqlEmail);
		$rowEmail	=	$mycms->sql_fetchrow($resEmail);
		if (!empty($rowEmail)) {
			if ($rowEmail['user_password'] == md5($password)) {
				session_start();
				$_SESSION['gleam_users_session'] = array(
					'email' => $rowEmail['email'],
					'user_id' => $rowEmail['user_id']
				);
				echo json_encode(array('status'=>true,'message'=>'Login successfull')); die;
			} else {
				echo json_encode(array('status'=>false,'message'=>'Invalid Credentials')); die;
			}
		} else {
			echo json_encode(array('status'=>false,'message'=>'Invalid Credentials')); die;
		}
		
	break;

		case 'forgotPassword':

				$email = !empty($_POST['email'])?trim($_POST['email']):'';

				if (empty($email)) {
					echo 'email_not_found'; die;
				}

				$sql 		=   "SELECT * FROM ".$cfg['DB_USERS']."
                                        WHERE  
                                        `status` ='A' 
                                       AND`email` = '".$email."' ";
    			$res        =   $mycms->sql_query($sql);
    			$row        =   $mycms->sql_fetchrow($res);
				$name    	= $row['name'];
				if (empty($row['email'])) {
					echo "email_not_exist";die;
				}

				$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			    $pass = array(); //remember to declare $pass as an array
			    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			    for ($i = 0; $i < 5; $i++) {
			        $n = rand(0, $alphaLength);
			        $pass[] = $alphabet[$n];
			    }
			    $password = implode($pass);

			    $sql1   =	"UPDATE ".$cfg['DB_USER_LOGIN']." SET
				       		`user_password` 	= '".md5($password)."'
				       		WHERE `user_email` 	= '".$email."' ";
				$updateUserLogin = $mycms->sql_query($sql1);

				$sql2   =	"UPDATE ".$cfg['DB_USERS']." SET
				       		`password` 		= '".md5($password)."'
				       		WHERE `email` 	= '".$email."' ";
				$updateUserReg = $mycms->sql_query($sql2);


		if ($updateUserLogin && $updateUserReg) {
			
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
			$mail.='						<td style="width:10%; padding:0;">New Password</td>';
			$mail.='						<td style="width:2%; padding:0;">:</td>';
			$mail.='						<td style="width:88%; padding:0;">'.$password.'</td>';
			$mail.='					</tr>';

			

			$mail.='					<tr>';
			$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding:10px; border:1px solid #ccc; background:#f9f9f9;">';
			$mail.='							<p style="font-weight:bold;">Query :</p>';
			$mail.='							<p></p>';
			$mail.='						</td>';
			$mail.='					</tr>';
			$mail.='				</table>';		
			
			$message		=	'Updated Credential <br/><br/>';
			
			
			/* ***** Send Email ***** */
			$to_name 		=	$name;
			$to_email 		=	$email;
			$form_name 		=	$cfg['ADMIN_NAME'];
			$form_email		=	$cfg['ADMIN_EMAIL'];
			$subject		=	"Your Updated Login Credentials";		
			$message		.=	'Dear '.$name.',<br/><br/> Your updated login credential.<br>';
			$message 		.= 	'New Password - '.$password;
			
			send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='');
			echo "email_send";die;
			} else {
				echo 'failed_update';die;
			}

			
		break;

	case 'register':
		$name 		= stripslashes(strip_tags($_REQUEST['name']));
		$mobile 	= stripslashes(strip_tags($_REQUEST['mobile']));
		$email 		= stripslashes(strip_tags($_REQUEST['email']));
		$location 	= stripslashes(strip_tags($_REQUEST['location']));
		$city 		= stripslashes(strip_tags($_REQUEST['city']));
		$state 		= stripslashes(strip_tags($_REQUEST['state']));
		$country 	= stripslashes(strip_tags($_REQUEST['country']));
		$pincode 	= stripslashes(strip_tags($_REQUEST['pincode']));
		$password 	= stripslashes(strip_tags($_REQUEST['password']));

		global  $mycms,$cfg;
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

			echo json_encode(array('status'=>true,'message'=>'User registered successfully')); die;
		} else {
			echo json_encode(array('status'=>false,'message'=>'Failed to register user')); die;
		}

	break;

	case 'logout':
		unset($_SESSION['gleam_users_session']);
		echo "done"; die;
	break;

	case 'Contact':
		$contactName	=	$_REQUEST['name'];
		$contactEmail	=	$_REQUEST['email'];
		$contactPhone	=	$_REQUEST['mobileno'];
		$contactMessage	=	$_REQUEST['message'];
		
		//Send Email To Admin
		$mail.='			<table width="100%" border="0" cellspacing="0" cellpadding="12" style="min-width: 700px;">';
		$mail.='				<tr>';
		$mail.='					<td height="9" colspan="3" align="left" valign="top" style="padding:1em 0 0 0;"><h2>There is a query from a visitor!</h2></td>';
		$mail.='				</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">From</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$contactName.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Contact</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$contactPhone.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Email</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$contactEmail.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding: 0;"></td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding:10px; border:1px solid #ccc; background:#f9f9f9;">';
		$mail.='							<p style="font-weight:bold;">Query :</p>';
		$mail.='							<p>'.$contactMessage.'</p>';
		$mail.='						</td>';
		$mail.='					</tr>';
		$mail.='				</table>';		
		
		$message		=	$mail;
		
		$to_name 		=	'Admin';
		$to_email 		=	$cfg['INFO_EMAIL'];
		$form_name 		=	$cfg['ADMIN_NAME'];
		$form_email		=	$cfg['ADMIN_EMAIL'];
		$subject		=	"User Query";		
		send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message);		
			
		/* ***** Send Email ***** */
		$to_name 		=	$contactName;
		$to_email 		=	$contactEmail;
		$form_name 		=	$cfg['ADMIN_NAME'];
		$form_email		=	$cfg['ADMIN_EMAIL'];
		$subject		=	"Thank you for your query";		
		$message		.=	'Dear '.$contactName.',<br/><br/>
							We have received your query, will get back to your soon.';
		send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='');
		$mycms->redirect("contact.php?m=1");
	break;

	case'QuickContact':
		$contactName	=	$_REQUEST['name'];
		$contactEmail	=	$_REQUEST['email'];
		$contactPhone	=	$_REQUEST['mobileno'];
		$contactMessage	=	$_REQUEST['message'];
		
		//Send Email To Admin
		$mail.='			<table width="100%" border="0" cellspacing="0" cellpadding="12" style="min-width: 700px;">';
		$mail.='				<tr>';
		$mail.='					<td height="9" colspan="3" align="left" valign="top" style="padding:1em 0 0 0;"><h2>There is a query from a visitor!</h2></td>';
		$mail.='				</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">From</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$contactName.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Contact</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$contactPhone.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Email</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$contactEmail.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding: 0;"></td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding:10px; border:1px solid #ccc; background:#f9f9f9;">';
		$mail.='							<p style="font-weight:bold;">Query :</p>';
		$mail.='							<p>'.$contactMessage.'</p>';
		$mail.='						</td>';
		$mail.='					</tr>';
		$mail.='				</table>';		
		
		$message		=	$mail;
		
		$to_name 		=	'Admin';
		$to_email 		=	$cfg['INFO_EMAIL'];
		$form_name 		=	$cfg['ADMIN_NAME'];
		$form_email		=	$cfg['ADMIN_EMAIL'];
		$subject		=	"User Query";		
		send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message);		
			
		/* ***** Send Email ***** */
		$to_name 		=	$contactName;
		$to_email 		=	$contactEmail;
		$form_name 		=	$cfg['ADMIN_NAME'];
		$form_email		=	$cfg['ADMIN_EMAIL'];
		$subject		=	"Thank you for your query";		
		$message		.=	'Dear '.$contactName.',<br/><br/>
							We have received your query, will get back to your soon.';
		$sendMail = send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='');
		if($sendMail){
			echo 'true';die;
		}else{
			echo 'false';die;
		}
	break;

	case'booking':
		$name			=	$_REQUEST['name'];
		$email			=	$_REQUEST['email'];
		$mobileno		=	$_REQUEST['mobileno'];
		$support		=	$_REQUEST['support'];
		$massage		=	$_REQUEST['massage'];
		
		//Send Email To Admin
		$mail.='			<table width="100%" border="0" cellspacing="0" cellpadding="12" style="min-width: 700px;">';
		$mail.='				<tr>';
		$mail.='					<td height="9" colspan="3" align="left" valign="top" style="padding:1em 0 0 0;"><h2>There is a query from a visitor!</h2></td>';
		$mail.='				</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">From</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$name.'</td>';
		$mail.='					</tr>';

		$mail.='			<table width="100%" border="0" cellspacing="0" cellpadding="12" style="min-width: 700px;">';
		$mail.='				<tr>';
		$mail.='					<td height="9" colspan="3" align="left" valign="top" style="padding:1em 0 0 0;"><h2>There is a query from a visitor!</h2></td>';
		$mail.='				</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Support Option</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$support.'</td>';
		$mail.='					</tr>';


		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Contact</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$mobileno.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Email</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$email.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding: 0;"></td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding:10px; border:1px solid #ccc; background:#f9f9f9;">';
		$mail.='							<p style="font-weight:bold;">Query :</p>';
		$mail.='							<p>'.$massage.'</p>';
		$mail.='						</td>';
		$mail.='					</tr>';
		$mail.='				</table>';		
		
		$message		=	$mail;
		
		
		$to_name 		=	'Admin';
		$to_email 		=	$cfg['INFO_EMAIL'];
		$form_name 		=	$cfg['ADMIN_NAME'];
		$form_email		=	$cfg['ADMIN_EMAIL'];
		$subject		=	"User Query";		
		send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message);		
			
		/* ***** Send Email ***** */
		$to_name 		=	$contactName;
		$to_email 		=	$contactEmail;
		$form_name 		=	$cfg['ADMIN_NAME'];
		$form_email		=	$cfg['ADMIN_EMAIL'];
		$subject		=	"Thank you for your query";		
		$message		.=	'Dear '.$contactName.',<br/><br/>
							We have received your query, will get back to your soon.';
		$sendMail = send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='');
		if($sendMail){
			echo 'true';die;
		}else{
			echo 'false';die;
		}
	break;

	case'Enquiry_training':
		$contactName	=	$_REQUEST['name'];
		$contactEmail	=	$_REQUEST['email'];
		$contactPhone	=	$_REQUEST['mobileno'];
		$contactMessage	=	$_REQUEST['message'];
		$EnqueryFor		=	$_REQUEST['enquiry'];
		
		//Send Email To Admin
		$mail.='			<table width="100%" border="0" cellspacing="0" cellpadding="12" style="min-width: 700px;">';
		$mail.='				<tr>';
		$mail.='					<td height="9" colspan="3" align="left" valign="top" style="padding:1em 0 0 0;"><h2>There is a query from a visitor!</h2></td>';
		$mail.='				</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Enquiry For</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$EnqueryFor.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">From</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$contactName.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Contact</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$contactPhone.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td style="width:10%; padding:0;">Email</td>';
		$mail.='						<td style="width:2%; padding:0;">:</td>';
		$mail.='						<td style="width:88%; padding:0;">'.$contactEmail.'</td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding: 0;"></td>';
		$mail.='					</tr>';
		$mail.='					<tr>';
		$mail.='						<td height="10" colspan="3" align="left" valign="top" style="padding:10px; border:1px solid #ccc; background:#f9f9f9;">';
		$mail.='							<p style="font-weight:bold;">Query :</p>';
		$mail.='							<p>'.$contactMessage.'</p>';
		$mail.='						</td>';
		$mail.='					</tr>';
		$mail.='				</table>';		
		
		$message		=	$mail;
		
		$to_name 		=	'Admin';
		$to_email 		=	$cfg['INFO_EMAIL'];
		$form_name 		=	$cfg['ADMIN_NAME'];
		$form_email		=	$cfg['ADMIN_EMAIL'];
		$subject		=	"User Query";		
		send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message);		
			
		/* ***** Send Email ***** */
		$to_name 		=	$contactName;
		$to_email 		=	$contactEmail;
		$form_name 		=	$cfg['ADMIN_NAME'];
		$form_email		=	$cfg['ADMIN_EMAIL'];
		$subject		=	"Thank you for your query";		
		$message		.=	'Dear '.$contactName.',<br/><br/>
							We have received your query, will get back to your soon.';
		$sendMail = send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='');
		if($sendMail){
			echo 'true';die;
		}else{
			echo 'false';die;
		}
	break;

	case 'newsletterAdd' :
		$custId	    =	stripslashes(strip_tags($_SESSION['userid']));
		$email	    =	stripslashes(strip_tags($_REQUEST['emailNews']));

		$sqlCustomer = "SELECT * FROM ".$cfg['DB_CUSTOMER']."
						WHERE `status`='A'
						AND `id`='".$custId."'
					   ";
	    $resCustomer = $mycms->sql_select($sqlCustomer);

	    $rowCustomer = $resCustomer[0];

	    $name= $rowCustomer['fname'].' '.$rowCustomer['lname'];

		$sqlInsertNews = "INSERT INTO ".$cfg['DB_NEWSLETTER_EMAIL']."
							 SET
							 	`cust_id`				=   '".$custId."',
							    `siteId`				=   '".$_SESSION['site']."',
							    `email`					=	'".$email."', 
								`name`					=	'".$name."',  
								`date`			        =	'".$date."'
								";
		$ins = $mycms->sql_insert($sqlInsertNews);

		


		if($ins)
		{

			$to_email	= $cfg['INFO_EMAIL'];
			$to_name 	= $cfg['ADMIN_NAME'];
			$form_name 	= $cfg['SITE_NAME'];
			$form_email = $cfg['ADMIN_EMAIL'];
			$subject 	= 'A visitor has sent query';
			$message	= 'Hello, Admin<br /><br />
			A visitor of this site has posted some query/suggestion/comments.<br />
			Following are the details:<br />
			<b>Name:	</b>  '.$name.'	 <br />
			<b>Email:	</b>  '.$_REQUEST['email'].' <br /> <br />
			
			Thanks & Regards,<br />
			'; 
			
			send_mail($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='');
		// die();
			
			$to_email  =$_REQUEST['email']; 
			$to_name = $_REQUEST['name'];
			$form_name = $cfg['ADMIN_NAME'];
			$form_email = $cfg['ADMIN_EMAIL'];
			$subject = 'Thank you for contact with us';
			$message = 'Hello '.$name.',<br><br>
			Thank you for your Opinion.<br>
			In response to your query we will get back to you soon.
			<br><br><br>
			Thanks & Regards,<br>
			'; 
			
			send_mail($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='');

			$mycms->redirect("index.php?m=6");
		}
	break;
}

function email_with_attachments($toemail,$toname,$fromemail,$fromname,$subject,$message,$fileControl)
{
	global $cfg, $mycms;
   	$strTo = $toemail;
   	$strSubject = $subject;
   	$strMessage = nl2br($message);
   
   	//* Uniqid Session *//
   	$strSid = md5(uniqid(time()));
   
  	$strHeader = "";
   	$strHeader .= "From: ".$fromname."<".$fromemail.">\nReply-To: ".$fromemail."";
   
   	$strHeader .= "MIME-Version: 1.0\n";
   	$strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";
   	$strHeader .= "This is a multi-part message in MIME format.\n";
   
   	$strHeader .= "--".$strSid."\n";
   	$strHeader .= "Content-type: text/html; charset=utf-8\n";
   	$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";
   	$strHeader .= $strMessage."\n\n";
   
   	//* Attachment *//
   	if($_FILES[$fileControl]["name"] != "")
   	{
    	$strFilesName = $_FILES[$fileControl]["name"];
    	$strContent = chunk_split(base64_encode(file_get_contents($_FILES[$fileControl]["tmp_name"])));
       	$strHeader .= "--".$strSid."\n";
      	$strHeader .= "Content-Type: application/octet-stream; name=\"".$strFilesName."\"\n";
       	$strHeader .= "Content-Transfer-Encoding: base64\n";
       	$strHeader .= "Content-Disposition: attachment; filename=\"".$strFilesName."\"\n\n";
       	$strHeader .= $strContent."\n\n";
   	}
   
   	$flgSend = @mail($strTo,$strSubject,null,$strHeader);  // @ = No Show Error //
   	if($flgSend=='1')
		$arr = array('message' => 'success');
	else
		$arr = array('message' => 'error');
	
   	$response=json_encode($arr);   	
	$ins="INSERT INTO ".$cfg['DB_EMAIL_HISTORY']."
				SET
			`status`		=	'".addslashes($response)."',
			`date`			=	'".date("Y-m-d")."',
			`time`			=	'".date("H:i:s")."',
			`subject`		=	'".addslashes($subject)."',
			`message`		=	'".addslashes($message)."',
			`to_name`		=	'".addslashes($toname)."',
			`to_email`		=	'".addslashes($toemail)."',
			`from_name`		=	'".addslashes($fromname)."',
			`from_email`	=	'".addslashes($fromemail)."',
			`loginid`		=	'".addslashes($loginid)."',
			`logintype`		=	'".addslashes($logintype)."',
			`pagename`		=	'".addslashes($_SERVER['PHP_SELF'])."',
			`ipaddress`		=	'".addslashes($_SERVER['REMOTE_ADDR'])."',
			`session`		=	'".session_id()."',
			`session_array`	=	'".serialize($_SESSION)."',
			`server_array`	=	'".serialize($_SERVER)."' ";			
	$mycms->sql_query($ins);
   
   if($flgSend)
   {
        return 1;
   }
   else
   {
        return 0;
   }
}
?>