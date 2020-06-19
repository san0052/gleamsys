<?php
function pageContentTitle($pageid)
{
	global  $mycms,$cfg;
	$sql	=	"SELECT * FROM ".$cfg['DB_HOME_VIEWMORE']." WHERE `id` = '".$pageid."'  AND `status`= 'A' ";
	$res	=	$mycms->sql_query($sql);
	$row	=	$mycms->sql_fetchrow($res);
	if($row['status']=='A')
		return stripslashes($row['name']);
	else
		return ''; 
}

function ItBanners($banner_id) {

	global  $mycms,$cfg;
	$sql	=	"SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `id` = '".$banner_id."'  AND `status`= 'A' ";
	$res	=	$mycms->sql_query($sql);
	$row	=	$mycms->sql_fetchrow($res);
	return 		!empty($row) ? $row : array(); 
}
	

function content($pageid,$flag = null)
{
	global  $mycms,$cfg;
	
	$sql	=	"SELECT * FROM ".$cfg['DB_HOME_VIEWMORE']." WHERE `id` = '".$pageid."'  AND `status`= 'A' ";
	$res	=	$mycms->sql_query($sql);
	$row	=	$mycms->sql_fetchrow($res);
	if($row['status']=='A') {
		if (!is_null($flag) && ($flag == 'tick_sign')) {
			if (!empty($row['desc1'])) {
				$newcontent = $row['desc1'];
				$newcontent = str_replace('<ul>','<ul class="why-us-content">', $newcontent);

				$newcontent = str_replace('<li>','<li><span class="chk-tick"><i class="fa fa-check"></i></span>', $newcontent);	
				$newcontent = stripslashes($newcontent);
				return $newcontent;	
			}	
		} else {
			return stripslashes($row['desc1']);
		}
	}
	else
		return ''; 
}

function serviceDesc($pageid,$flag = null,$pageName)
{
	global  $mycms,$cfg;
	
	if($pageName=='tech-support'){
		$sql	=	"SELECT * FROM ".$cfg['DB_SERVICE_INFO']." WHERE `id` = '".$pageid."'  AND `status`= 'A' AND `pageName`= 'tech-support' AND `subjectName`='Work Process'";
		$res	=	$mycms->sql_query($sql);
		$row	=	$mycms->sql_fetchrow($res);
	}else{
		$sql	=	"SELECT * FROM ".$cfg['DB_SERVICE_INFO']." WHERE `id` = '".$pageid."'  AND `status`= 'A' AND `pageName`= 'it-service' AND `subjectName`='IT' ";
		$res	=	$mycms->sql_query($sql);
		$row	=	$mycms->sql_fetchrow($res);
	}
	if($row['status']=='A') {
		
		if (!is_null($flag) && ($flag == 'tick_sign')) {
			if (!empty($row['description'])) {
				$newcontent = $row['description'];
				$newcontent = str_replace('<ul>','<ul class="why-us-content">', $newcontent);

				$newcontent = str_replace('<li>','<li><span class="chk-tick"><i class="fa fa-check"></i></span>', $newcontent);	
				$newcontent = stripslashes($newcontent);
				return $newcontent;	
			}	
		} else {
			return stripslashes($row['description']);
		}
	}
	else
		return ''; 
}
function serviceTitle($pageid,$pageName){
	global  $mycms,$cfg;
	if($pageName == 'tech-support'){
		$sql	=	"SELECT * FROM ".$cfg['DB_SERVICE_INFO']." WHERE `id` = '".$pageid."'  AND `status`= 'A' AND `pageName`= 'tech-support'";
		$res	=	$mycms->sql_query($sql);
		$row	=	$mycms->sql_fetchrow($res);
	}else{
		$sql	=	"SELECT * FROM ".$cfg['DB_SERVICE_INFO']." WHERE `id` = '".$pageid."'  AND `status`= 'A' AND `pageName`= 'it-service'";
		$res	=	$mycms->sql_query($sql);
		$row	=	$mycms->sql_fetchrow($res);
	}
	if($row['status']=='A')
		return stripslashes($row['serviceTitle']);
	else
		return '';
}


function computer_desc($pageid,$flag = null)
{
	global  $mycms,$cfg;
	
	$sql	=	"SELECT * FROM ".$cfg['DB_COMPUTER_TRAIN']." WHERE `id` = '".$pageid."'  AND `status`= 'A' AND `pageName`= 'computer-training'";
	$res	=	$mycms->sql_query($sql);
	$row	=	$mycms->sql_fetchrow($res);
	if($row['status']=='A') {
		if (!is_null($flag) && ($flag == 'tick_sign')) {
			if (!empty($row['serviceDescription'])) {
				$newcontent = $row['serviceDescription'];
				$newcontent = str_replace('<ul>','<ul class="why-us-content">', $newcontent);

				$newcontent = str_replace('<li>','<li><span class="chk-tick"><i class="fa fa-check"></i></span>', $newcontent);	
				$newcontent = stripslashes($newcontent);
				return $newcontent;	
			}	
		} else {
			return stripslashes($row['serviceDescription']);
		}
	}
	else
		return ''; 
}


function getShopCategory($pageid)
{
	global  $mycms,$cfg;

	$sql	=	"SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `id` = '".$pageid."'  AND `status`= 'A' ";
	$res	=	$mycms->sql_query($sql);
	$row	=	$mycms->sql_fetchrow($res);
	if($row['status']=='A')
		return stripslashes($row['name']);
	else
		return ''; 
}


function roundup($val,$pressision=2)

{

	if($pressision==0)

	{

    	return ceil($val);

	}

	else

	{

		//$p = pow(10,$pressision-1);

		$p = pow(10,$pressision);

    	$val = $val*$p;

    	$val = ceil($val);

  		return $val /$p;

	}

}













/* *************************************************************** */

/* ******************** Admin Panel Functions ******************** */

/* *************************************************************** */











function admin_name($aid)

{

	global  $mycms,$mycommoncms,$cfg;



	$sql_admin   = array();

	$sql_admin['QUERY']   =	"SELECT * FROM ".DB_WEBMASTER." WHERE `a_id` = ?";



	$sql_admin['PARAM'][] = array('FILD' => 'a_id',  'DATA'=>$aid,   'TYP'=>'s');



	$res_admin 		=	$mycms->sql_select($sql_admin);

	$row_admin		=	$res_admin[0];

	$admin_name		=	$row_admin['name'];

	return ucwords($admin_name);

}



function priv_all_details($type,$menu)

{

    global  $mycms,$mycommoncms,$cfg;

	$sql = array();

   	$sql['QUERY'] = "SELECT * 

						FROM ".DB_WEBMASTER_PRIVILEGES." 

						WHERE `typeId` 	= ? 

						AND `menuId`	= ? 

						AND `pvlgStatus`!= ?";

	$sql['PARAM'][]	=	array('FILD' => 'typeId' , 		'DATA' => $type , 	'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'menuId' , 		'DATA' => $menu , 	'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'pvlgStatus' , 	'DATA' => 'D' , 	'TYP' => 's');

    $res = $mycms->sql_select($sql);

	$maxrow1=$mycms->sql_numrows($res);

	if($maxrow1>0){ return false; }

	else{

    return true;

	}

}



function webmaster_type_all_details($con,$uid)

{

    global  $mycms,$mycommoncms,$cfg;

	$sql   		  = array();

    $sql['QUERY'] = "SELECT * FROM ".DB_WEBMASTER_TYPE." WHERE `typeId` = ?";



	$sql['PARAM'][] = array('FILD' => 'typeId',  'DATA'=>$uid,   'TYP'=>'s');

    $res = $mycms->sql_select($sql);

    $row = $res[0];

    return $row[$con];

}



function webmaster_menu_all_details($con,$uid)

{

    global  $mycms,$mycommoncms,$cfg;

	$sql   		  = array();

    $sql['QUERY'] = "SELECT * FROM ".DB_WEBMASTER_MENU." WHERE `menuId` = ?";



	$sql['PARAM'][] = array('FILD' => 'menuId',  'DATA'=>$uid,   'TYP'=>'s');

    $res = $mycms->sql_select($sql);

    $row = $res[0];

    return $row[$con];

}



function webmaster_all_detailmenu_is_parent($uid)

{

    global  $mycms,$mycommoncms,$cfg;

	$sql   		  = array();

   	$sql['QUERY'] = "SELECT * FROM ".DB_WEBMASTER_MENU." WHERE `menuId`	=	?";



	$sql['PARAM'][] = array('FILD' => 'menuId',  'DATA'=>$uid,   'TYP'=>'s');

    $res = $mycms->sql_select($sql);

    $row = $res[0];

    return $row['pMenuId'];

}



function adminUserMenuList($userType)

{

	global  $mycms,$mycommoncms,$cfg;

	$k = 0;

	$menuList = array();

	$sqlpvlg  = array();

	$sqlpvlg['QUERY'] = "SELECT * 

							FROM ".DB_WEBMASTER_PRIVILEGES."

							WHERE `pvlgStatus`=? 

							AND   `typeId`=?";

	$sqlpvlg['PARAM'][]	=	array('FILD' => 'pvlgStatus' , 	'DATA' => 'A' , 		'TYP' => 's');

	$sqlpvlg['PARAM'][]	=	array('FILD' => 'typeId' , 		'DATA' => $userType , 	'TYP' => 's');



	$respvlg = $mycms->sql_select($sqlpvlg);



	foreach($respvlg as $key=>$rowpvlg){

		$menuList[$k] = $rowpvlg['menuId'];

		$k++;

	}

	return $menuList;

}



/* ********************************************************* */

/* ******************** Common Function ******************** */

/* ********************************************************* */

function getWebmasterUserLastLoginDetails($userId,$userType)

{

	global $cfg,$mycms,$mycommoncms;

	$sqlLogin				=	array();

	$sqlLogin['QUERY']		=	"SELECT * 

								   FROM ".DB_LOGIN_DETAILS." 

								  WHERE `a_id` = ?

									AND `userType` = ?

							   ORDER BY `id` DESC";

	$sqlLogin['PARAM'][]	=	array('FILD' => 'a_id', 		'DATA' => $userId, 		'TYP' => 's');

	$sqlLogin['PARAM'][]	=	array('FILD' => 'userType', 	'DATA' => $userType, 	'TYP' => 's');

	$resLogin				=	$mycms->sql_select($sqlLogin);

	$numLogin				=	$mycms->sql_numrows($resLogin);

	return $numLogin;

}



function getaddressFromLatitudeLongitude($lat,$lng)

{

	$url	=	'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';

	$json	=	@file_get_contents($url);

	$data	=	json_decode($json);

	$status	=	$data->status;

	if($status=="OK")

	{

		return $data->results[0]->formatted_address;

	}

	else

	{

		return false;

	}

}





function maskMessage($message,$match,$flag)

{

	$matchKey	=	strpos($message,$match);

	//$matchKey	=	$matchKey+1;

	if($matchKey>0)

	{

		$msgArr	=	explode('.',$message);

		if($flag=='Email')

		{

			$otpMsg	=	explode(' ',$msgArr[1]);

		}

		else if($flag=='SMS')

		{

			$otpMsg	=	explode(' ',$msgArr[0]);

		}

		if($flag=='Email' || $flag=='SMS')

		{

			foreach($otpMsg as $mkey=> $mval)

			{

				$msgVal	=	trim($mval);

				if(is_numeric($msgVal))

				{

					$newMsg	=	str_replace($msgVal,"XXXXXX",$message);

					break;

				}

				else

				{

					$newMsg = $message;

				}

			}

		}

		else

		{

			$newMsg = $message;

		}

	}

	else

	{

		$newMsg	=	$message;

	}



	return $newMsg;

}



function getNote($flag)

{

	global $mycms,$mycommoncms,$cfg;

	$sql['QUERY']	=	"SELECT * FROM ".DB_NOTE_MASTER." WHERE `noteFlag` = ? AND `status` = ?";



	$sql['PARAM'][] = array('FILD' => 'noteFlag',  	'DATA'=>$flag,   	'TYP'=>'s');

	$sql['PARAM'][] = array('FILD' => 'status',  	'DATA'=>'A',   		'TYP'=>'s');



	$res			=	$mycms->sql_select($sql);

	$row			=	$res[0];

	return $row['note'];

}



function noAccess()

{

	?>

<div class="fld_row">

    <div class="warning">

        No Access

    </div>

</div>

<?

}



/* *************************************************************** */

/* ******************** Required Functions ******************** */

/* *************************************************************** */





function pagecontent($pageid)

{

	global  $mycms,$mycommoncms,$cfg;



	$sql			=	array();

	$sql['QUERY']	=	"SELECT * FROM ".DB_PAGECONTENT." WHERE `cmsId` = ?  AND `cmsStatus`= ? ";



	$sql['PARAM'][] = array('FILD' => 'cmsId', 		'DATA'=>$pageid, 'TYP'=>'s');

	$sql['PARAM'][] = array('FILD' => 'cmsStatus', 	'DATA'=>'A', 	 'TYP'=>'s');



	$res	=	$mycms->sql_select($sql);

	$row	=	$res[0];

	if($row['cmsStatus']=='A')

		return stripslashes($row['content']);

	else

		return '';

}



function getFieldsFromTable($id,$tb,$tname,$fid,$extraSql='')

{

	global  $mycms,$mycommoncms,$cfg;



	if ($tb!='*') {

		$newTb 	=	"`".$tb."`";

	} else {

		$newTb 	=	$tb;

	}



	$sql			=	array();

	$sql['QUERY']	=	"SELECT ".$newTb." FROM ".$tname." where `".$fid."`= ? ".$extraSql;

	$sql['PARAM'][]	= 	array('FILD' => $fid, 	'DATA'=>$id, 'TYP'=>'s');

	$res 			= 	$mycms->sql_select($sql);

	$row 			= 	$res[0];

	$num 			=	$mycms->sql_numrows($res);



	if ($num) {

		if ($tb=='*') {

			return $res;

		} else {

			return $row[$tb];

		}

	} else {

		return false;

	}



	/*if($row[$tb])

		return $row[$tb];

	else

		return '';*/

}





/* ************************************************************* */

/* ******************** Important Functions ******************** */

/* ************************************************************* */





function serializedData($arr)

{

	$processArray = array();

	if(is_array($arr))

	{

		foreach($arr as $key=>$ar)

		{

			$type = gettype ($ar);

			if($type=='object')

			{

				$processArray[$key] = parsedArray($ar);

			}

			else

			{

				$processArray[$key] = $ar;

			}

		}

	}

	else

	{

		$type = gettype ($arr);

		if($type=='object')

		{

			$processArray = parsedArray($ar);

		}

		else

		{

			$processArray = $ar;

		}

	}

	$serializeForm	=	serialize($processArray);

	$encodeForm		=	base64_encode($serializeForm);

	return $encodeForm;

}



function unserializedData($data)

{

	$decodeForm			=	base64_decode($data);

	$unserializeForm	=	unserialize($decodeForm);

	return $unserializeForm;

}



function parsedArray($object)

{

	$array = array();

	foreach($object as $key=>$value)

	{

		$type = gettype ($value);

		if($type=='object')

		{

			$array[$key] = parsedArray($value);

		}

		else if($type=='array')

		{

			$array[$key] = parsedArray($value);

		}

		else

		{

			$array[$key] = $value;

		}

	}

	return $array;

}



function copyFile($filetemp,$filepath,$foldername='')

{

	copy($filetemp,$filepath);

}



function dateDifference($date_1 , $date_2)

{

	$dateFrom	= strtotime($date_1); // or your date as well

	$dateTo		= strtotime($date_2);

	$datediff 	= $dateTo - $dateFrom;

	return floor($datediff / (60 * 60 * 24));

}







function send_mail($to_name,$to_email,$from_name,$from_email,$subject,$messege,$useSendGrid='no',$type=''){

	global $mycms,$companyIDConnection;



	$to_email 	=	($to_email=='suman@evedev.in')?'suman.samanta@encoders.co.in':$to_email;

	if($to_email!='suman@evedev.in'){

		$idArr 	=	explode("@", $to_email);

		if ($idArr[1]=='evedev.in') {

			$idArr[1]	=	'encoders.co.in';

		}

		$to_email 	=	implode("@", $idArr);

	}



	//$messege		.=	"<br><br><br>Thanks<br>EVE";



	$newMessage 	=	'<body style="padding:0; margin:0;">';

	$newMessage 	.=	'<div style="width:800px; padding:0; margin:0; font-family:Arial, Helvetica, sans-serif;">';

	$newMessage 	.=	'<table width="100%" cellspacing="0" cellpadding="10" border="0">';

	$newMessage 	.=	'<tr style="background:#21b6bc;">';

	$newMessage 	.=	'<td style="padding-bottom:0;"><img src="https://www.eve24hrs.com/eve/images/login_logo.png" style="width:95px; height:auto;"></td>';

	$newMessage 	.=	'<td align="right">';

	$newMessage 	.=	'<span style="width: 25px; margin-right:5px; display:inline-block;"><img src="https://www.eve24hrs.com/eve/images/web.png" style="width: 100%;vertical-align: middle;"></span>';

	$newMessage 	.=	'<p style="display:inline-block; margin-top: 0; margin-bottom: 0; color: #fff;"> <a href="www.eve24hrs.com" style="color:white; text-decoration:none;">www.eve24hrs.com</a></p>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'<tr align="left" valign="top">';

	if($type=='webmaster'){

		$newMessage 	.=	'<td colspan="2" style="color: #333; padding-top: 20px; padding-bottom: 20px; border-top: solid 1px #ccc; border-bottom: solid 1px #ccc;  color:white; background: url(https://www.eve24hrs.com/eve/images/Into_bg.png)">';

	} else {

		$newMessage 	.=	'<td colspan="2" style="color: #333; padding-top: 20px; padding-bottom: 20px; border-top: solid 1px #ccc; border-bottom: solid 1px #ccc;">';

	}

	$newMessage 	.=	'<div style="min-height:300px;">';

	$newMessage 	.=	'<p>';

	$newMessage 	.=	$messege;

	$newMessage 	.=	'</p>';

	if($type==''){

		$newMessage 	.=	'<p>';

		$newMessage 	.=	'We would love to answer any questions you might have about us, so please check the FAQ section in our website, or contact us on helpline@eve24hrs.com , or call us on our toll free number -  <span style="color:red;">1800 120 141 141</span>';

		$newMessage 	.=	'</p>';

	}

	$newMessage 	.=	'<p>';

	$newMessage 	.=	'<strong>Thank you, <br> Team EVE</strong>';

	$newMessage 	.=	'</p>';

	if($type=='' || $type=='crm'){

		$newMessage 	.=	'<div>';

		$newMessage 	.=	'<img src="https://www.eve24hrs.com/eve/images/eve-logo-new.png" style="width:50px;">';

		$newMessage 	.=	'</div>';

	}

	else if($type=='webmaster'){

		$newMessage 	.=	'<div style="text-align: center;">';

		$newMessage 	.=	'<img src="https://www.eve24hrs.com/eve/images/eve-logo-new.png" style="width:50px;">';

		$newMessage		.=	'<p>';

		$newMessage		.=	'WORK FAST, WORK EASY';

		$newMessage		.=	'</p>';

		$newMessage		.=	'<p>';

		$newMessage		.=	'For More Details: <a href="https://www.eve24hrs.com" style="color:white;">Visit Our Website</a>';

		$newMessage		.=	'</p>';

		$newMessage 	.=	'</div>';

	}

	$newMessage 	.=	'</div>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'<tr>';

	$newMessage 	.=	'<td colspan="2">';

	$newMessage 	.=	'<p style="text-align:center">';



	$newMessage 	.=	'<a href="https://www.facebook.com/Eveapp-339351973294432/"  style="text-decoration: none;"> <img src="https://www.eve24hrs.com/eve/images/facebook.png" height="45px" width="45px" style="padding:0px 12px" > </a>';

	$newMessage 	.=	'<a href="https://twitter.com/@EVE78695059" style="text-decoration: none;"> <img src="https://www.eve24hrs.com/eve/images/twitter.png" height="45px" width="45px" style="padding:0px 12px" > </a>';

	$newMessage 	.=	'<a href="https://www.linkedin.com/in/eve-app-32ba43174/" style="text-decoration: none;"> <img src="https://www.eve24hrs.com/eve/images/link-in.png" height="45px" width="45px" style="padding:0px 12px" > </a>';

	$newMessage 	.=	'<a href="https://www.instagram.com/eve24hrs/" style="text-decoration: none;"> <img src="https://www.eve24hrs.com/eve/images/instagram.png" height="45px" width="45px" style="padding:0px 12px" > </a>';





	$newMessage 	.=	'</p>';



	$newMessage 	.=	'</td>';



	$newMessage 	.=	'</tr>';



	$newMessage 	.=	'<tr style="background:#26cacc;">';

	$newMessage 	.=	'<td colspan="2">';

	$newMessage 	.=	'<table width="100%" cellspacing="0" cellpadding="0" border="0" style="color:#fff; font-size:14px;">';

	$newMessage 	.=	'<tr>';

	$newMessage 	.=	'<td align="center">';

	$newMessage 	.=	'<img src="https://www.eve24hrs.com/eve/images/m1.png" style="width:45px;">';

	$newMessage 	.=	'<p>Real-time Location Tracking</p>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'<td align="center"><img src="https://www.eve24hrs.com/eve/images/m2.png" style="width:45px;"><p>24/7 Access On Any Device</p></td>';

	$newMessage 	.=	'<td align="center"><img src="https://www.eve24hrs.com/eve/images/m3.png" style="width:45px;"><p>Live ERP Dashboard</p></td>';

	$newMessage 	.=	'<td align="center"><img src="https://www.eve24hrs.com/eve/images/m4.png" style="width:45px;"><p>All-In-One Communication Wall</p></td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'</table>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'</table>';

	$newMessage 	.=	'</div>';

	$newMessage 	.=	'</body>';

	//$newMessage 	.=	"<style type='text/css'> .bgimg { min-height:300px;background-image: url('https://www.eve24hrs.com/eve/images/Into bg.png'); color: white;}</style>";





	if($useSendGrid=='no'){



		$headers = "From: $from_name <$from_email>\r\n".

	               "MIME-Version: 1.0" . "\r\n" .

	               "Content-type: text/html; charset=UTF-8" . "\r\n";



	    $headers .= "Reply-To: No Reply <$from_email>\r\n";

	    $headers .= "Return-Path:<$from_email>\r\n";

	    $headers .= "X-Priority: 3\r\n";

	    $headers .= "X-MSMail-Priority: Normal\r\n";

	  	$headers .= "X-Mailer: php\r\n";



		if(mail($to_email,$subject,$newMessage,$headers)){

			$status	=	'sucess';

			//return true;

		}

		else {

			$status	=	'failed';

			//return false;

		}

	}

	else {

		$url  = "https://api.sendgrid.com/";

		//$user = "flynewsletter@gmail.com";

		//$pass = "flynewsletter@2Gmail123456";//"flynewsletter@2Gmail";



		$user = "developer@eve24hrs.com";

		$pass = "eve@12345";



		$ret  = array('STATUS'=>'PRE-RUN');



		$params = array(

		'api_user'  => $user,

		'api_key'   => $pass,

		'to'        => $to_email,

		'subject'   => $subject,

		'html'      => $newMessage,

		'text'      => $newMessage,

		'fromname'  => $from_name,

		'from'      => $from_email

		 );



		if($attachments!=""){

			$attch = unserialize($attachments);

			foreach($attch as $k=>$val){

				$params['files'][$k]=$val;

			}

		}



		$request =  $url.'api/mail.send.json';



		if($_SERVER['HTTP_HOST']!='localhost')

		{

		// Generate curl request

			$session = curl_init($request);

			curl_setopt($session, CURLOPT_HTTPHEADER , array("Content-Type:multipart/form-data"));

			// Tell curl to use HTTP POST

			curl_setopt ($session, CURLOPT_POST, true);

			// Tell curl that this is the body of the POST

			curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

			// Tell curl not to return headers, but do return the response

			curl_setopt($session, CURLOPT_HEADER, false);

			// Tell PHP not to use SSLv3 (instead opting for TLS)

			curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);

			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);



			// obtain response

			$response = curl_exec($session);



			curl_close($session);



			$ret['STATUS'] = 'SUCCESS';

			$status	=	'success';

		}



	}





	$sqlEmail 	=	array();

	$sqlEmail['QUERY']	=	"INSERT INTO ".DB_EMAIL_HISTORY."

								SET

									`to_name`			=	'".$to_name."',

									`email_to`			=	'".$to_email."',

									`sender_name`		=	'".$from_name."',

									`email_from`		=	'".$from_email."',

									`subject`			=	'".$subject."',

									`email_body`		=	'".base64_encode($newMessage)."',

									`response`			=	'".$response."',

									`created_date`		=	'".date('y-m-d H:i:s')."',

									`created_session`	=	'".session_id()."',

									`created_ip`		=	'".$_SERVER['REMOTE_ADDR']."'";

	$resEmail	=	$mycms->sql_insert($sqlEmail);



	//$connectedDB 	=	$mycms->defaultQueryManager->dbname;



	/*if ($connectedDB!='eve24hrs_main') {

		swapDatabaseConnect(2,DB_SERVER_MAIN,DB_SERVER_USERNAME_MAIN,DB_SERVER_PASSWORD_MAIN,DB_DATABASE_MAIN);

		require_once("/home/eve24hrs/public_html/eve/includes/configure.override.php");

		updateCompanyCredits($companyIDConnection,'email');

		swapDatabaseDisconnect(2);

	} else {

		updateCompanyCredits($companyIDConnection,'email');

	}*/







	return $status;



}



function send_mail_with_attachment($to_name,$to_email,$from_name,$from_email,$subject,$messege,$fileName,$filePath,$useSendGrid='no'){

	global $mycms,$companyIDConnection;



	$to_email 	=	($to_email=='suman@evedev.in')?'suman.samanta@encoders.co.in':$to_email;

	if($to_email!='suman@evedev.in'){

		$idArr 	=	explode("@", $to_email);

		if ($idArr[1]=='evedev.in') {

			$idArr[1]	=	'encoders.co.in';

		}

		$to_email 	=	implode("@", $idArr);

	}



	//$messege		.=	"<br><br><br>Thanks<br>EVE";



	$newMessage 	=	'<body style="padding:0; margin:0;">';

	$newMessage 	.=	'<div style="width:800px; padding:0; margin:0; font-family:Arial, Helvetica, sans-serif;">';

	$newMessage 	.=	'<table width="100%" cellspacing="0" cellpadding="10" border="0">';

	$newMessage 	.=	'<tr style="background:#21b6bc;">';

	$newMessage 	.=	'<td><img src="https://www.eve24hrs.com/eve/images/logo2.png" style="width:110px;"></td>';

	$newMessage 	.=	'<td align="right">';

	$newMessage 	.=	'<span style="width: 25px; margin-right:5px; display:inline-block;"><img src="https://www.eve24hrs.com/eve/images/web.png" style="width: 100%;vertical-align: middle;"></span>';

	$newMessage 	.=	'<p style="display:inline-block; margin-top: 0; margin-bottom: 0; color: #fff;"> www.eve24hrs.com</p>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'<tr align="left" valign="top">';

	$newMessage 	.=	'<td colspan="2" style="color: #333; padding-top: 20px; padding-bottom: 20px; border-top: solid 1px #ccc; border-bottom: solid 1px #ccc;">';

	$newMessage 	.=	'<div style="min-height:300px;">';

	$newMessage 	.=	'<p>';

	$newMessage 	.=	$messege;

	$newMessage 	.=	'</p>';

	$newMessage 	.=	'<p>';

	$newMessage 	.=	'We would love to answer any questions you might have about us, so please check the FAQ section in our website, or contact us on helpline@eve24hrs.com , or call us on our toll free number -  <span style="color:red;">1800 120 141 141</span>';

	$newMessage 	.=	'</p>';

	$newMessage 	.=	'<p>';

	$newMessage 	.=	'Thank you ! <br> Team EVE';

	$newMessage 	.=	'</p>';

	$newMessage 	.=	'<div>';

	$newMessage 	.=	'<img src="https://www.eve24hrs.com/eve/images/eve-logo-new.png" style="width:50px;">';

	$newMessage 	.=	'</div>';

	$newMessage 	.=	'</div>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'<tr style="background:#26cacc;">';

	$newMessage 	.=	'<td colspan="2">';

	$newMessage 	.=	'<table width="100%" cellspacing="0" cellpadding="0" border="0" style="color:#fff; font-size:14px;">';

	$newMessage 	.=	'<tr>';

	$newMessage 	.=	'<td align="center">';

	$newMessage 	.=	'<img src="https://www.eve24hrs.com/eve/images/m1.png" style="width:45px;">';

	$newMessage 	.=	'<p>Real-time location tracking</p>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'<td align="center"><img src="https://www.eve24hrs.com/eve/images/m2.png" style="width:45px;"><p>24/7 Access On Any Device</p></td>';

	$newMessage 	.=	'<td align="center"><img src="https://www.eve24hrs.com/eve/images/m3.png" style="width:45px;"><p>Live ERP Dashboard</p></td>';

	$newMessage 	.=	'<td align="center"><img src="https://www.eve24hrs.com/eve/images/m4.png" style="width:45px;"><p>All-In-One Communication Wall</p></td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'</table>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'</table>';

	$newMessage 	.=	'</div>';

	$newMessage 	.=	'</body>';





	if($useSendGrid=='no'){



		$headers = "From: $from_name <$from_email>\r\n".

	               "MIME-Version: 1.0" . "\r\n" .

	               "Content-type: text/html; charset=UTF-8" . "\r\n";



	    $headers .= "Reply-To: No Reply <$from_email>\r\n";

	    $headers .= "Return-Path:<$from_email>\r\n";

	    $headers .= "X-Priority: 3\r\n";

	    $headers .= "X-MSMail-Priority: Normal\r\n";

	  	$headers .= "X-Mailer: php\r\n";



		if(mail($to_email,$subject,$newMessage,$headers)){

			$status	=	'sucess';

			//return true;

		}

		else {

			$status	=	'failed';

			//return false;

		}

	}

	else {

		$url  			= 	"https://api.sendgrid.com/";

		//$user 			= 	"flynewsletter@gmail.com";

		//$pass 			= 	"flynewsletter@2Gmail123456";//"flynewsletter@2Gmail";



		$user = "developer@eve24hrs.com";

		$pass = "eve@12345";



		$ret  			= 	array('STATUS'=>'PRE-RUN');



		$params = array(

		'api_user'  => $user,

		'api_key'   => $pass,

		'to'        => $to_email,

		'subject'   => $subject,

		'html'      => $newMessage,

		'text'      => $newMessage,

		'fromname'  => $from_name,

		'from'      => $from_email,

		'files['.$fileName.']' => $filePath.'/'.$fileName

		 );



		/*if($attachments!=""){

			$attch = unserialize($attachments);

			foreach($attch as $k=>$val){

				$params['files'][$k]=$val;

			}

		}*/



		$request =  $url.'api/mail.send.json';



		if($_SERVER['HTTP_HOST']!='localhost')

		{

		// Generate curl request

			$session = curl_init($request);

			curl_setopt($session, CURLOPT_HTTPHEADER , array("Content-Type:multipart/form-data"));

			// Tell curl to use HTTP POST

			curl_setopt ($session, CURLOPT_POST, true);

			// Tell curl that this is the body of the POST

			curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

			// Tell curl not to return headers, but do return the response

			curl_setopt($session, CURLOPT_HEADER, false);

			// Tell PHP not to use SSLv3 (instead opting for TLS)

			curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);

			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);



			// obtain response

			$response = curl_exec($session);



			curl_close($session);



			$ret['STATUS'] = 'SUCCESS';

			$status	=	'sucess';

		}



	}





	$sqlEmail 	=	array();

	$sqlEmail['QUERY']	=	"INSERT INTO ".DB_EMAIL_HISTORY."

								SET

									`to_name`			=	'".$to_name."',

									`email_to`			=	'".$to_email."',

									`sender_name`		=	'".$from_name."',

									`email_from`		=	'".$from_email."',

									`subject`			=	'".$subject."',

									`email_body`		=	'".base64_encode($newMessage)."',

									`response`			=	'".$status."',

									`created_date`		=	'".date('y-m-d H:i:s')."',

									`created_session`	=	'".session_id()."',

									`created_ip`		=	'".$_SERVER['REMOTE_ADDR']."'";

	$resEmail	=	$mycms->sql_insert($sqlEmail);



	$connectedDB 	=	$mycms->defaultQueryManager->dbname;



	if ($connectedDB!='eve24hrs_main') {

		swapDatabaseConnect(2,DB_SERVER_MAIN,DB_SERVER_USERNAME_MAIN,DB_SERVER_PASSWORD_MAIN,DB_DATABASE_MAIN);

		require_once("/home/eve24hrs/public_html/eve/includes/configure.override.php");

		updateCompanyCredits($companyIDConnection,'email');

		swapDatabaseDisconnect(2);

	} else {

		updateCompanyCredits($companyIDConnection,'email');

	}







	return $status;



}



function sendgridMailSend($toname, $toemail, $fromname, $fromemail, $subject, $message, $fileName='',$filePath=''){

	global $cfg;



	$toemail 	=	($to_email=='suman@evedev.in')?'suman.samanta@encoders.co.in':$toemail;

	if($toemail!='suman@evedev.in'){

		$idArr 	=	explode("@", $toemail);

		if ($idArr[1]=='evedev.in') {

			$idArr[1]	=	'encoders.co.in';

		}

		$toemail 	=	implode("@", $idArr);

	}



	$newMessage 	=	'<body style="padding:0; margin:0;">';

	$newMessage 	.=	'<div style="width:800px; padding:0; margin:0; font-family:Arial, Helvetica, sans-serif;">';

	$newMessage 	.=	'<table width="100%" cellspacing="0" cellpadding="10" border="0">';

	$newMessage 	.=	'<tr style="background:#21b6bc;">';

	$newMessage 	.=	'<td style="padding-bottom:0;"><img src="https://www.eve24hrs.com/eve/images/login_logo.png" style="width:95px; height:auto;"></td>';

	$newMessage 	.=	'<td align="right">';

	$newMessage 	.=	'<span style="width: 25px; margin-right:5px; display:inline-block;"><img src="https://www.eve24hrs.com/eve/images/web.png" style="width: 100%;vertical-align: middle;"></span>';

	$newMessage 	.=	'<p style="display:inline-block; margin-top: 0; margin-bottom: 0; color: #fff;"> <a href="www.eve24hrs.com" style="color:white; text-decoration:none;">www.eve24hrs.com</a></p>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'<tr align="left" valign="top">';

	if($type=='webmaster'){

		$newMessage 	.=	'<td colspan="2" style="color: #333; padding-top: 20px; padding-bottom: 20px; border-top: solid 1px #ccc; border-bottom: solid 1px #ccc;  color:white; background: url(https://www.eve24hrs.com/eve/images/Into_bg.png)">';

	} else {

		$newMessage 	.=	'<td colspan="2" style="color: #333; padding-top: 20px; padding-bottom: 20px; border-top: solid 1px #ccc; border-bottom: solid 1px #ccc;">';

	}

	$newMessage 	.=	'<div style="min-height:300px;">';

	$newMessage 	.=	'<p>';

	$newMessage 	.=	$message;

	$newMessage 	.=	'</p>';

	if($type==''){

		$newMessage 	.=	'<p>';

		$newMessage 	.=	'We would love to answer any questions you might have about us, so please check the FAQ section in our website, or contact us on helpline@eve24hrs.com , or call us on our toll free number -  <span style="color:red;">1800 120 141 141</span>';

		$newMessage 	.=	'</p>';

	}

	$newMessage 	.=	'<p>';

	$newMessage 	.=	'<strong>Thank you, <br> Team EVE</strong>';

	$newMessage 	.=	'</p>';

	if($type==''){

		$newMessage 	.=	'<div>';

		$newMessage 	.=	'<img src="https://www.eve24hrs.com/eve/images/eve-logo-new.png" style="width:50px;">';

		$newMessage 	.=	'</div>';

	}

	else if($type=='webmaster'){

		$newMessage 	.=	'<div style="text-align: center;">';

		$newMessage 	.=	'<img src="https://www.eve24hrs.com/eve/images/eve-logo-new.png" style="width:50px;">';

		$newMessage		.=	'<p>';

		$newMessage		.=	'WORK FAST, WORK EASY';

		$newMessage		.=	'</p>';

		$newMessage		.=	'<p>';

		$newMessage		.=	'For More Details: <a href="https://www.eve24hrs.com" style="color:white;">Visit Our Website</a>';

		$newMessage		.=	'</p>';

		$newMessage 	.=	'</div>';

	}

	$newMessage 	.=	'</div>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'<tr style="background:#26cacc;">';

	$newMessage 	.=	'<td colspan="2">';

	$newMessage 	.=	'<table width="100%" cellspacing="0" cellpadding="0" border="0" style="color:#fff; font-size:14px;">';

	$newMessage 	.=	'<tr>';

	$newMessage 	.=	'<td align="center">';

	$newMessage 	.=	'<img src="https://www.eve24hrs.com/eve/images/m1.png" style="width:45px;">';

	$newMessage 	.=	'<p>Real-time Location Tracking</p>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'<td align="center"><img src="https://www.eve24hrs.com/eve/images/m2.png" style="width:45px;"><p>24/7 Access On Any Device</p></td>';

	$newMessage 	.=	'<td align="center"><img src="https://www.eve24hrs.com/eve/images/m3.png" style="width:45px;"><p>Live ERP Dashboard</p></td>';

	$newMessage 	.=	'<td align="center"><img src="https://www.eve24hrs.com/eve/images/m4.png" style="width:45px;"><p>All-In-One Communication Wall</p></td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'</table>';

	$newMessage 	.=	'</td>';

	$newMessage 	.=	'</tr>';

	$newMessage 	.=	'</table>';

	$newMessage 	.=	'</div>';

	$newMessage 	.=	'</body>';



	$url  			= 	"https://api.sendgrid.com/";

	//$url  			= 	"https://api.sendgrid.com/";

	//$user 			= 	"flynewsletter@gmail.com";

	//$pass 			= 	"flynewsletter@2Gmail123456";//"flynewsletter@2Gmail";

	$user 			= "developer@eve24hrs.com";

	$pass 			= "eve@12345";



	$ret  			= array('STATUS'=>'PRE-RUN');



	$params 		= array(

		'api_user'  => $user,

		'api_key'   => $pass,

		'to'        => $toemail,

		'subject'   => $subject,

		'html'      => $newMessage,

		'text'      => $newMessage,

		'fromname'  => $fromname,

		'from'      => $fromemail,

		'files['.$fileName.']' => file_get_contents($filePath.'/'.$fileName)

	 );



	$request =  $url.'api/mail.send.json';



	if($_SERVER['HTTP_HOST']!='localhost')

	{

	// Generate curl request

		$session = curl_init($request);

		curl_setopt($session, CURLOPT_HTTPHEADER , array("Content-Type:multipart/form-data"));

		// Tell curl to use HTTP POST

		curl_setopt ($session, CURLOPT_POST, true);

		// Tell curl that this is the body of the POST

		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

		// Tell curl not to return headers, but do return the response

		curl_setopt($session, CURLOPT_HEADER, false);

		// Tell PHP not to use SSLv3 (instead opting for TLS)

		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);

		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);



		// obtain response

		$response = curl_exec($session);



		curl_close($session);



		$ret['STATUS'] = 'SUCCESS';

		$status	=	'sucess';

	}

	return $response;

}



function dayCount($from, $to) {

    return round(abs(strtotime($from)-strtotime($to))/86400);

}

function send_mail_contact($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='')
{
	global $cfg,$mycms;
	$msg		='<table width="800" border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:22px; background:#eee;">';
	$msg		.='	<tbody style="padding: 15px; background: #f9f9f9; border: 1px solid #ddd; margin-left:12px;width:800px;">';
	$msg		.='		<tr>';
	$msg		.='			<td height="60" align="left" valign="middle" style="border-bottom:2px dotted #FABE06;">';
	$msg		.='				<img src="'.$cfg['base_url'].'images/logo.png" style="height:auto;width:30%"/>';
	$msg		.='			</td>';
	$msg		.=			'</tr>';
	$msg		.='		<tr>';
	$msg		.='			<td align="left" valign="top"></td>';
	$msg		.='		</tr>';
	$msg		.='		<tr>';
	$msg		.='			<td align="left" valign="top">';
	$msg		.='				<table width="100%" border="0" cellspacing="0" cellpadding="12">';
	$msg		.='					<tr>';
	$msg		.='						<td height="10" colspan="2" align="left" valign="top" style="padding: 0;">';
	$msg		.='							<p style="margin:0;"><br/>';		
	$msg		.=		$message;
	$msg		.=							'</p>';
	$msg		.='						</td>';
	$msg		.='					</tr>';
	$msg		.='					<tr>';
	$msg		.='						<td height="10" colspan="2" align="left" valign="top" style="padding: 0;"></td>';
	$msg		.='					</tr>';
	$msg		.='					<tr>';
	$msg		.='						<td height="10" colspan="2" align="left" valign="top" style="padding: 0;"></td>';
	$msg		.='					</tr>';
	$msg		.='					<tr>';
	$msg		.='						<td height="10" colspan="2" align="left" valign="top" style="padding: 0;"></td>';
	$msg		.='					</tr>';
	$msg		.=						'<tr>';
	$msg		.='						<td height="10" colspan="2" align="left" valign="top" style="padding: 0;"></td>';
	$msg		.='					</tr>';
	$msg		.='					<tr>';
	$msg		.='						<td height="9" colspan="2" align="left" valign="top" style="padding: 0;">';
	$msg		.='							<p style="margin:0;">Regards,</p>';
	$msg		.='						</td>';
	$msg		.='					</tr>';
	$msg		.='					<tr>';
	$msg		.='						<td height="10" colspan="2" align="left" valign="top" style="padding:0 0 0 0;">';
	$msg		.='							<p style="margin:0;">'.$cfg['SITE_NAME'].'</p>';
	$msg		.='						</td>';
	$msg		.='					</tr>';
	$msg		.='					<tr>';
	$msg		.='						<td colspan="2" align="left" valign="top" style="padding: 0;">';
	$msg		.='							<img src="'.$cfg['base_url'].'images/logo.png" width="15%" height="auto" style="margin: 1em 0;" />';
	$msg		.='						</td>';
	$msg		.='					</tr>';
	$msg		.='				</table>';
	$msg		.='			</td>';
	$msg		.='		</tr>';
	$msg		.='	</tbody>';
	$msg		.='</table>';
	
	
	if($_SERVER['HTTP_HOST']!='localhost')
	{		
		$headers	=	"MIME-Version: 1.0\r\n";
		$headers 	.=	"Content-type: text/html; charset=iso-8859-1\r\n";
		$headers 	.=	"From: ". $form_name ."<".$form_email."> \r\n";
		if ($bcc != "")
			$headers	.=	"Bcc: ".$bcc."\n";
		$output		=	$msg;
		$output 	= 	wordwrap($output, 72);
		$response	=	mail($to_email, $subject, $output, $headers);
	}else{
		$response  = 1;
	}
	
	$ins="INSERT INTO ".$cfg['DB_EMAIL_HISTORY']."
				SET
			`status`		=	'".addslashes($response)."',
			`date`			=	'".date("Y-m-d")."',
			`time`			=	'".date("H:i:s")."',
			`subject`		=	'".addslashes($subject)."',
			`message`		=	'".addslashes($msg)."',
			`to_name`		=	'".addslashes($to_name)."',
			`to_email`		=	'".addslashes($to_email)."',
			`from_name`		=	'".addslashes($form_name)."',
			`from_email`	=	'".addslashes($form_email)."',
			`pagename`		=	'".addslashes($_SERVER['PHP_SELF'])."',
			`ipaddress`		=	'".addslashes($_SERVER['REMOTE_ADDR'])."',
			`session`		=	'".session_id()."',
			`session_array`	=	'".serialize($_SESSION)."',
			`server_array`	=	'".serialize($_SERVER)."' ";
	$mycms->sql_query($ins);	
	return($response);
}

/* ********************************************************* */

/* ******************** Other Functions ******************** */

/* ********************************************************* */



function formatPrice($price)

{

	if($price!='')

		return number_format($price,2);

	else

		return 0.00;

}



function formatPriceDecimal($price){

    if($price!='')

        return number_format($price, 2, '.', '');

    else

        return 0.00;

}



function formatDate($date)

{

	global $cfg,$mycms,$mycommoncms;

	if ($date!='') {

		return date('M j, Y',strtotime($date));

	} else {

		return '';

	}

}



function formatTime($time)

{

	global $cfg,$mycms;

	return date('h:i A',strtotime($time));

}



function formatDateTime($datetime)

{

	global $cfg,$mycms;

	if ($datetime!='') {

		return date('M j, Y h:i A',strtotime($datetime));

	} else {

		return '';

	}

}



function getNoOfDays($fromdate,$todate)

{

	$start		=	strtotime($fromdate);

	$end		=	strtotime($todate);

	$noOfDays	=	ceil(abs($end - $start) / 86400);

	return $noOfDays;

}



function getAge($then) {

    $then_ts = strtotime($then);

    $then_year = date('Y', $then_ts);

    $age = date('Y') - $then_year;

    if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;

    return $age;

}



function randomNumber($length = 6, $seeds = 'alphanum')

{

	// Possible seeds

	$seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';

	$seedings['numeric'] = '0123456789';

	$seedings['alphanum'] = 'abcdefghijkl0123456789mnopqrstuvwxyz';

	$seedings['hexidec'] = '0123456789abcdef';

	// Choose seed

	if (isset($seedings[$seeds])){

		$seeds = $seedings[$seeds];

	}

	// Seed generator

	list($usec, $sec) = explode(' ', microtime());

	$seed = (float) $sec + ((float) $usec * 100000);

	mt_srand($seed);



	// Generate

	$str = '';

	$seeds_count = strlen($seeds);



	for ($i = 0; $length > $i; $i++){

		$str .= $seeds{mt_rand(0, $seeds_count - 1)};

	}

	return $str;

}













function calculateTime($date,$from_time="")

{

	//echo $date;

	$dt=explode(" ",$date);

	$to_time = strtotime($date);

	if ($from_time=="") {

		$from_time = strtotime(date('Y-m-d H:i:s'));

	}

	$diff=strtotime($date)-strtotime($from_time) ;

	//echo $min=$diff/86400;

	$minutesago=round(abs($to_time - $from_time) / 60);

	$Minutes=round(abs($to_time - $from_time) / 60);

	$time=($Minutes=='0' || $Minutes=='1')?'a few secs':$Minutes." Mins";

	if($Minutes>=60)

	{

		//echo '=====';

		if ($Minutes < 0)

		{

			$Min = Abs($Minutes);

		}

		else

		{

			$Min = $Minutes;

		}

		$iHours = Floor($Min / 60);

		$Minutes = ($Min - ($iHours * 60)) / 100;

		$tHours = $iHours + $Minutes;

		if ($Minutes < 0)

		{

			$tHours = $tHours * (-1);

		}

		$aHours = explode(".", $tHours);

		$iHours = $aHours[0];

		if (empty($aHours[1]))

		{

			$aHours[1] = "00";

		}

		$Minutes = $aHours[1];

		if (strlen($Minutes) < 2)

		{

			$Minutes = $Minutes ."0";

		}

		if($iHours==1){

			$hourString 	=	'Hr';

		}

		else {

			$hourString 	=	'Hrs';

		}

		if($Minutes==1 || $Minutes=='01'){

			$minuteString 	=	'Min';

		}

		else {

			$minuteString 	=	'Mins';

		}

		$tHours = $iHours ." ".$hourString." ". $Minutes." ".$minuteString;



		$hoursago=$tHours;

		/*$day=explode(' ',$date);

		$daysago=date('Y-m-d') - $day[0];*/

		$time=$hoursago;

	}

	if($iHours>=24)

	{

		$daysago = floor ($minutesago / 1440);

		$h = floor (($minutesago - $d * 1440) / 60);

		$m = $minutesago - ($d * 1440) - ($h * 60);

		if($daysago==1){

			$dayString 	=	'Day';

		}

		else {

			$dayString 	=	'Days';

		}

		$time=$daysago." ".$dayString;

	}

	if($daysago>10)

	{

		$dt=explode(" ",$date);;

        $time=date('F j',strtotime($date))." at ".getTimeFormat($dt[1]);

	}

	return $time;

}



function getTimeFormat($time)

{

	if($time=='00:00' || $time=='00:00:00')

	{

		$tm='12:00 AM';

	}

	else

	{

		$tms = array();

		$tms = explode(':',$time);

		if($tms[0]==12)

		{

			$tms1 = $tms[0];

			$tm = $tms1.':'.$tms[1].' PM';

		}

		if($tms[0] > 12){

		$tms1 = $tms[0] - 12;

		$tm = $tms1.':'.$tms[1].' PM';

		}

		if($tms[0] < 12){

		$tms1 = $tms[0];

		$tm = $tms1.':'.$tms[1].' AM';

		}

	}

	return $tm;

}



function number_pad($number,$places)

{

		return str_pad((int) $number, $places, "0", STR_PAD_LEFT);

}





function sendSMS($mobile,$message)

{

	global $cfg,$mycms,$mycommoncms;

	if($_SERVER['SERVER_NAME']!='localhost')

	{

		$userId		=	'OMTPL1';

		$password	=	'OMTPL1@123';

		$senderId	=	'OHMYTL';

		$message	=	$message."\n Regards, \n OMLp2p team";

		$msg		=	urlencode($message);



		$mobileLen	=	strlen((string)$mobile);

		if($mobileLen==13)

			$mobile     =   substr($mobile,3);

		else if($mobileLen==12)

			$mobile     =   substr($mobile,2);

		else if($mobileLen==11)

			$mobile     =   substr($mobile,1);

		else

			$mobile     =   $mobile;

		$curl = curl_init();

		curl_setopt_array($curl, array(

		  CURLOPT_URL => "http://bhashsms.com/api/sendmsg.php?user=".$userId."&pass=".$password."&sender=".$senderId."&phone=".$mobile."&text=".$msg."&priority=ndnd&stype=normal",

		  CURLOPT_RETURNTRANSFER => true,

		  CURLOPT_ENCODING => "",

		  CURLOPT_MAXREDIRS => 10,

		  CURLOPT_TIMEOUT => 30,

		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

		  CURLOPT_HTTPHEADER => array(

			"cache-control: no-cache",

			"content-type: application/json",

		  ),

		));



		$response = curl_exec($curl);

		$err = curl_error($curl);

		curl_close($curl);

		//return $response;

		if($response!='')

		{

			$responseArr = explode('.',$response);

			if($responseArr[0]=='S')

			{

				$res = 1;

			}

			else

			{

				$res = 0;

			}

		}

		else

		{

			$res = 0;

		}

		if($res==1)

		{

			$status = 'Success';

		}

		else

		{

			$status = 'Failed';

		}



		$sqlSms['QUERY']	=	"INSERT INTO ".DB_SMS_HISTORY."

										 SET `status`		= ?,

											 `response`		= ?,

											 `date`			= ?,

											 `time`			= ?,

											 `message`		= ?,

											 `phone_no`		= ?,

											 `pagename`		= ?,

											 `ipaddress`	= ?,

											 `session`		= ?";

		$sqlSms['PARAM'][]  = 	array('FILD' => 'status', 	   'DATA'=>$status, 				'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'response',    'DATA'=>$response, 				'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'date', 	   'DATA'=>date('Y-m-d'), 			'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'time', 	   'DATA'=>date('H:i:s'), 			'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'message', 	   'DATA'=>$message, 			    'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'phone_no',    'DATA'=>$mobile, 			    'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'pagename',    'DATA'=>$_SERVER['PHP_SELF'], 	'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'ipaddress',   'DATA'=>$_SERVER['REMOTE_ADDR'], 'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'session', 	   'DATA'=>session_id(), 			'TYP'=>'s');

		$mycms->sql_insert($sqlSms);



		return $res;

	}

	else

	{

		$status = 	'Failed';

		$mobileLen	=	strlen((string)$mobile);

		if($mobileLen==13)

			$mobile     =   substr($mobile,3);

		else if($mobileLen==12)

			$mobile     =   substr($mobile,2);

		else if($mobileLen==11)

			$mobile     =   substr($mobile,1);

		else

			$mobile     =   $mobile;

		$sqlSms['QUERY']	=	"INSERT INTO ".DB_SMS_HISTORY."

										 SET `status`		= ?,

											 `response`		= ?,

											 `date`			= ?,

											 `time`			= ?,

											 `message`		= ?,

											 `phone_no`		= ?,

											 `pagename`		= ?,

											 `ipaddress`	= ?,

											 `session`		= ?";

		$sqlSms['PARAM'][]  = 	array('FILD' => 'status', 	   'DATA'=>$status, 				'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'response',    'DATA'=>$response, 				'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'date', 	   'DATA'=>date('Y-m-d'), 			'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'time', 	   'DATA'=>date('H:i:s'), 			'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'message', 	   'DATA'=>$message, 			    'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'phone_no',    'DATA'=>$mobile, 			    'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'pagename',    'DATA'=>$_SERVER['PHP_SELF'], 	'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'ipaddress',   'DATA'=>$_SERVER['REMOTE_ADDR'], 'TYP'=>'s');

		$sqlSms['PARAM'][]  = 	array('FILD' => 'session', 	   'DATA'=>session_id(), 			'TYP'=>'s');

		$mycms->sql_insert($sqlSms);

		return 0;

	}



}



function convertNumberToWords($number) {



    $hyphen      = '-';

    $conjunction = ' and ';

    $separator   = ', ';

    $negative    = 'negative ';

    $decimal     = ' point ';

    $dictionary  = array(

        0                   => 'zero',

        1                   => 'one',

        2                   => 'two',

        3                   => 'three',

        4                   => 'four',

        5                   => 'five',

        6                   => 'six',

        7                   => 'seven',

        8                   => 'eight',

        9                   => 'nine',

        10                  => 'ten',

        11                  => 'eleven',

        12                  => 'twelve',

        13                  => 'thirteen',

        14                  => 'fourteen',

        15                  => 'fifteen',

        16                  => 'sixteen',

        17                  => 'seventeen',

        18                  => 'eighteen',

        19                  => 'nineteen',

        20                  => 'twenty',

        30                  => 'thirty',

        40                  => 'fourty',

        50                  => 'fifty',

        60                  => 'sixty',

        70                  => 'seventy',

        80                  => 'eighty',

        90                  => 'ninety',

        100                 => 'hundred',

        1000                => 'thousand',

        1000000             => 'million',

        1000000000          => 'billion',

        1000000000000       => 'trillion',

        1000000000000000    => 'quadrillion',

        1000000000000000000 => 'quintillion'

    );



    if (!is_numeric($number)) {

        return false;

    }



    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {

        // overflow

        trigger_error(

            'convertNumberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,

            E_USER_WARNING

        );

        return false;

    }



    if ($number < 0) {

        return $negative . convertNumberToWords(abs($number));

    }



    $string = $fraction = null;



    if (strpos($number, '.') !== false) {

        list($number, $fraction) = explode('.', $number);

    }



    switch (true) {

        case $number < 21:

            $string = $dictionary[$number];

            break;

        case $number < 100:

            $tens   = ((int) ($number / 10)) * 10;

            $units  = $number % 10;

            $string = $dictionary[$tens];

            if ($units) {

                $string .= $hyphen . $dictionary[$units];

            }

            break;

        case $number < 1000:

            $hundreds  = $number / 100;

            $remainder = $number % 100;

            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];

            if ($remainder) {

                $string .= $conjunction . convertNumberToWords($remainder);

            }

            break;

        default:

            $baseUnit = pow(1000, floor(log($number, 1000)));

            $numBaseUnits = (int) ($number / $baseUnit);

            $remainder = $number % $baseUnit;

            $string = convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];

            if ($remainder) {

                $string .= $remainder < 100 ? $conjunction : $separator;

                $string .= convertNumberToWords($remainder);

            }

            break;

    }



    if (null !== $fraction && is_numeric($fraction)) {

        $string .= $decimal;

        $words = array();

        foreach (str_split((string) $fraction) as $number) {

            $words[] = $dictionary[$number];

        }

        $string .= implode(' ', $words);

    }



    return $string;

}





function getUserAge($dateOfBirth){

	//$dateOfBirth = "1995-12-05";

	$today = date("Y-m-d");

	$diff = date_diff(date_create($dateOfBirth), date_create($today));

	echo $diff->format('%y');

}



function getMonthDate($userId,$month)

{

	global $cfg,$mycms;

	$time	= array();

	for($day=1;$day<=30;$day++)

	{

	?>

<tr>

    <td><?=$day?></td>

</tr>

<?

	}

}





/**************************** Download PDF Function***********************************************/

function downloadHtmlPdf($agreement,$name)

{

	global $mycms,$cfg;

	/*require_once('../tcpdfNew/examples/tcpdf_include.php');

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	$pdf->AddPage();

	$html = $agreement;

	$pdf->writeHTML($html, true, false, true, false, '');

	$pdf->lastPage();

	$pdf->Output($name.'.'.'pdf', 'I');*/



	include('../pdf_class/mpdf/mpdf.php');

	$mpdf = new mPDF('','', 0, '', 2, 2, 2, 2, 2, 2, 'L');

	$html		=	$agreement;

	//$html		=	file_get_contents('pdf-html.php');



	$mpdf->WriteHTML($html);

	//$mpdf->Output('pdf/test_pdf.pdf', 'F');

	//$mpdf->Output();

	$mpdf->Output($name.'_pdf.pdf', 'D');

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		checkEmailValidation

	* Params:			email

	* Returns:			1 or 0

	* Description:		Check Valid Email

	*

	*/



function checkEmailValidation($email){

	global $mycms,$cfg;



	//$email	=	$mycommoncms->getFieldValue($email);

	if(filter_var($email,FILTER_VALIDATE_EMAIL)){

		return 1;

	}

	else {

		return 0;

	}

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		checkNumberValidation

	* Params:			number

	* Returns:			1 or 0

	* Description:		Check Number or Not

	*

	*/

function checkNumberValidation($number){

	global $mycms,$cfg;



	//$number		=	$mycommoncms->getFieldValue($number);

	if(preg_match('/^[0-9]*$/',$number)){

		return 1;

	}

	else {

		return 0;

	}

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		checkStringValidation

	* Params:			string

	* Returns:			1 or 0

	* Description:		Check String or Not

	*

	*/

function checkStringValidation($string){

	global $mycms,$cfg;



	//$string		=	$mycommoncms->getFieldValue($string);

	if(preg_match('/^[A-Za-z ]+$/',$string)){

		return 1;

	}

	else {

		return 0;

	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		checkStringNumberValidation

	* Params:			string

	* Returns:			1 or 0

	* Description:		Check String And Number or Not

	*

	*/



function checkStringNumberValidation($string){

	global $mycms,$cfg;



	//$string		=	$mycommoncms->getFieldValue($string);

	if(preg_match('/^[A-Za-z0-9]+$/',$string)){

		return 1;

	}

	else {

		return 0;

	}

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		checkSpecialCharacterValidation

	* Params:			string

	* Returns:			1 or 0

	* Description:		Check Special Character in a string

	*

	*/

function checkSpecialCharacterValidation($string){

	global $mycms,$cfg;



	//$string		=	$mycommoncms->getFieldValue($string);

	if (preg_match('/[\'^�$%&*()}{@#~?>

<>,|=_+�-]/', $string)){

    return 0;

    }

    else {

    return 1;

    }

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    /**

    *

    * Case Name: checkAlphaNumericValidation

    * Params: string

    * Returns: 1 or 0

    * Description: Check Alpha Numeric

    *

    */

    function checkAlphaNumericValidation($string){

    global $mycms,$cfg;

    if(preg_match('/^[\/()A-Za-z0-9,-._:+ ]+$/',$string)){

    return 1;

    }

    else {

    return 0;

    }

    return $string;

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    /**

    *

    * Case Name: checkURLValidation

    * Params: url

    * Returns: 1 or 0

    * Description: Check valid url

    *

    */

    function checkURLValidation($url){

    global $mycms,$cfg;

    if(preg_match('/^[\/A-Za-z0-9?%&-.:=]+$/',$url)){

    return 1;

    }

    else {

    return 0;

    }

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    /**

    *

    * Case Name: checkMobileValidation

    * Params: mobile

    * Returns: 1 or 0

    * Description: Check Mobile Number Is Valid Or Not

    *

    */

    function checkMobileValidation($mobile){

    global $mycms,$cfg;

    if(substr($mobile, 0, 1)=='+'){

    $mobile = substr($mobile, 3);

    }

    //$mobile = $mycommoncms->getFieldValue($mobile);

    $mobileLen = strlen($mobile);

    $checkMobile = checkNumberValidation($mobile);

    if($mobileLen==10 && $checkMobile==1){

    return 1;

    }

    else {

    return 0;

    }



    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    /**

    *

    * Case Name: checkPANCardValidation

    * Params: PAN Card number

    * Returns: 1 or 0

    * Description: Check PAN Card Number Is Valid Or Not

    *

    */

    function checkPANCardValidation($PANCardNumber){

    global $mycms,$cfg;



    //$PANCardNumber = $mycommoncms->getFieldValue($PANCardNumber);

    $flag = 0;

    $PANCardLen = strlen($PANCardNumber);

    if($PANCardLen!=10){

    $flag++;

    }

    if (!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $PANCardNumber)){

    $flag++;

    }

    if($flag==0){

    return 1;

    }

    else {

    return 0;

    }

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    /**

    *

    * Case Name: checkAADHAARCardValidation

    * Params: AADHAAR Card number

    * Returns: 1 or 0

    * Description: Check AADHAAR Card Number Is Valid Or Not

    *

    */

    function checkAADHAARCardValidation($AADHAARCardNumber){

    global $mycms,$cfg;



    //$AADHAARCardNumber = $mycommoncms->getFieldValue($AADHAARCardNumber);

    $flag = 0;

    $AADHAARCardNumberLen = strlen($AADHAARCardNumber);

    if($AADHAARCardNumberLen!=12){

    $flag++;

    }

    $checkAADHAARCardNumber = checkNumberValidation($AADHAARCardNumber);

    if($checkAADHAARCardNumber==0){

    $flag++;

    }

    if($flag==0){

    return 1;

    }

    else {

    return 0;

    }

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    /**

    *

    * Case Name: checkImageValidation

    * Params: $file (array), $filetype (blank / Doc / Excel) [Blank(Image) && Doc(Document) && Excel(Any excel)]

    * Returns: 1 or 0

    * Description: Check Image Extension Or Size

    *

    */



    function checkImageValidation($file,$filetype=''){

    $flag = 0;

    $maxSize = 10485760;

    if($filetype=='Doc'){

    $support_ext = array('jpg','jpeg','png','doc','docx','pdf');

    }

    else if($filetype=='PDF'){

    $support_ext = array('pdf');

    }

    else if($filetype=='Excel'){

    $support_ext = array('xls','xlsx');

    }

    else {

    $support_ext = array('jpg','jpeg','png');

    }



    $ext = strtolower(end(explode('.',$file['name'])));

    if(!in_array($ext,$support_ext)){

    $flag++;

    }

    if($file['size']>=$maxSize || $file['size']==0 || $file['size']==''){

    $flag++;

    }

    if($flag==0){

    return 1;

    }

    else {

    return 0;

    }

    }



    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    /**

    *

    * Case Name: showCaptcha

    * Params: null

    * Returns: captcha

    * Description: Show captcha image

    *

    */



    function showCaptcha($i,$valField){

    ?>

    <img src="<?=BASE_URL?>captcha-code.php?rand=<?php echo rand();?>&valField=<?=$valField?>" id='captchaimg<?=$i?>'

        style="width:140px;">

    <img src="<?=BASE_URL?>images/reload.png" title="Refresh Captcha" id="reloadCaptcha<?=$i?>"

        onClick="refreshCaptcha<?=$i?>();" style="width:30px; margin-left:25px; cursor:pointer;" alt="Refresh Captcha">

    <script>

    function refreshCaptcha < ? = $i ? > () {

        var img = document.images['captchaimg<?=$i?>'];

        img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000 +

            "&valField=<?=$valField?>";

        $("#<?=$valField?>").val('');

    }

    </script>

    <?

}





////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		getDaysOfMonth

	* Params:			null

	* Returns:			days

	* Description:

	*

	*/



function getDaysOfMonth($month,$year){

	if($month=='January' || $month=='March' || $month=='May' || $month=='July' || $month=='August' || $month=='October' || $month=='December'){

		return '31';

	}

	else if($month=='April' || $month=='June' || $month=='September' || $month=='November'){

		return '30';

	}

	else if($month=='February'){

		if( (0 == $year % 4) and (0 != $year % 100) or (0 == $year % 400) )

		{

			return '29';

		}

		else

		{

			return '28';

		}

	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		getSundays

	* Params:			year,month

	* Returns:			all sunday date

	* Description:

	*

	*/



function getSundays($y,$m){

    $date = "$y-$m-01";

    $first_day = date('N',strtotime($date));

    $first_day = 7 - $first_day + 1;

    $last_day =  date('t',strtotime($date));

    $days = array();

    for($i=$first_day; $i<=$last_day; $i=$i+7 ){

        $days[] = $i;

    }

    return  $days;

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		calculateBankHolidays

	* Params:			year,

	* Returns:			all holidays

	* Description:

	*

	*/



function calculateBankHolidays($yr) {



    $bankHols = Array();



    // New year's:

    switch ( date("w", strtotime("$yr-01-01 12:00:00")) ) {

        case 6:

            $bankHols[]["date"] = "$yr-01-03";

            $bankHols[]["name"] = "New Year";

            break;

        case 0:

            $bankHols[]["date"] = "$yr-01-02";

            $bankHols[]["name"] = "New Year";

            break;

        default:

            $bankHols[]["date"] = "$yr-01-01";

            $bankHols[]["name"] = "New Year";

    }



    // Good friday:

    $bankHols[]["date"] = date("Y-m-d", strtotime( "+".(easter_days($yr) - 2)." days", strtotime("$yr-03-21 12:00:00") ));

    $bankHols[]["name"] = "Good Friday";

    // Easter Monday:

    $bankHols[]["date"] = date("Y-m-d", strtotime( "+".(easter_days($yr) + 1)." days", strtotime("$yr-03-21 12:00:00") ));

    $bankHols[]["name"] = "Easter Monday";

    // May Day:

    if ($yr == 1995) {

        $bankHols[]["date"] = "1995-05-08"; // VE day 50th anniversary year exception

    	$bankHols[]["name"] = "May Day";

    } else {

        switch (date("w", strtotime("$yr-05-01 12:00:00"))) {

            case 0:

                $bankHols[]["date"] = "$yr-05-02";

                $bankHols[]["name"] = "May Day";

                break;

            case 1:

                $bankHols[]["date"] = "$yr-05-01";

                $bankHols[]["name"] = "May Day";

                break;

            case 2:

                $bankHols[]["date"] = "$yr-05-07";

                $bankHols[]["name"] = "May Day";

                break;

            case 3:

                $bankHols[]["date"] = "$yr-05-06";

                $bankHols[]["name"] = "May Day";

                break;

            case 4:

                $bankHols[]["date"] = "$yr-05-05";

                $bankHols[]["name"] = "May Day";

                break;

            case 5:

                $bankHols[]["date"] = "$yr-05-04";

                $bankHols[]["name"] = "May Day";

                break;

            case 6:

                $bankHols[]["date"] = "$yr-05-03";

                $bankHols[]["name"] = "May Day";

                break;

        }

    }



    // Whitsun:

    if ($yr == 2002) { // exception year

        $bankHols[]["date"] = "2002-06-03";

        $bankHols[]["name"] = "Whitsun";

        $bankHols[]["date"] = "2002-06-04";

        $bankHols[]["name"] = "Whitsun";

    } else {

        switch (date("w", strtotime("$yr-05-31 12:00:00"))) {

            case 0:

                $bankHols[]["date"] = "$yr-05-25";

                $bankHols[]["name"] = "Whitsun";

                break;

            case 1:

                $bankHols[]["date"] = "$yr-05-31";

                $bankHols[]["name"] = "Whitsun";

                break;

            case 2:

                $bankHols[]["date"] = "$yr-05-30";

                $bankHols[]["name"] = "Whitsun";

                break;

            case 3:

                $bankHols[]["date"] = "$yr-05-29";

                $bankHols[]["name"] = "Whitsun";

                break;

            case 4:

                $bankHols[]["date"] = "$yr-05-28";

                $bankHols[]["name"] = "Whitsun";

                break;

            case 5:

                $bankHols[]["date"] = "$yr-05-27";

                $bankHols[]["name"] = "Whitsun";

                break;

            case 6:

                $bankHols[]["date"] = "$yr-05-26";

                $bankHols[]["name"] = "Whitsun";

                break;

        }

    }



    // Summer Bank Holiday:

    switch (date("w", strtotime("$yr-08-31 12:00:00"))) {

        case 0:

            $bankHols[]["date"] = "$yr-08-25";

            $bankHols[]["name"] = "Summer Bank Holiday";

            break;

        case 1:

            $bankHols[]["date"] = "$yr-08-31";

            $bankHols[]["name"] = "Summer Bank Holiday";

            break;

        case 2:

            $bankHols[]["date"] = "$yr-08-30";

            $bankHols[]["name"] = "Summer Bank Holiday";

            break;

        case 3:

            $bankHols[]["date"] = "$yr-08-29";

            $bankHols[]["name"] = "Summer Bank Holiday";

            break;

        case 4:

            $bankHols[]["date"] = "$yr-08-28";

            $bankHols[]["name"] = "Summer Bank Holiday";

            break;

        case 5:

            $bankHols[]["date"] = "$yr-08-27";

            $bankHols[]["name"] = "Summer Bank Holiday";

            break;

        case 6:

            $bankHols[]["date"] = "$yr-08-26";

            $bankHols[]["name"] = "Summer Bank Holiday";

            break;

    }



    // Christmas:

    switch ( date("w", strtotime("$yr-12-25 12:00:00")) ) {

        case 5:

            $bankHols[]["date"] = "$yr-12-25";

            $bankHols[]["name"] = "Christmas";

            $bankHols[]["date"] = "$yr-12-28";

            $bankHols[]["name"] = "Christmas";

            break;

        case 6:

            $bankHols[]["date"] = "$yr-12-27";

            $bankHols[]["name"] = "Christmas";

            $bankHols[]["date"] = "$yr-12-28";

            $bankHols[]["name"] = "Christmas";

            break;

        case 0:

            $bankHols[]["date"] = "$yr-12-26";

            $bankHols[]["name"] = "Christmas";

            $bankHols[]["date"] = "$yr-12-27";

            $bankHols[]["name"] = "Christmas";

            break;

        default:

            $bankHols[]["date"] = "$yr-12-25";

            $bankHols[]["name"] = "Christmas";

            $bankHols[]["date"] = "$yr-12-26";

            $bankHols[]["name"] = "Christmas";

    }



    // Millenium eve

    if ($yr == 1999) {

        $bankHols[]["date"] = "1999-12-31";

        $bankHols[]["name"] = "Millenium eve";

    }



    return $bankHols;



}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		logout

	* Params:			null

	* Returns:			logout the user

	* Description:

	*

	*/



function logout(){

	session_unset($_SESSION['login_status']);

	session_unset($_SESSION['login_type']);

	session_unset($_SESSION['login_id']);



}





////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	/**

	*

	* Case Name:		getUserType

	* Params:			null

	* Returns:			user type name

	* Description:

	*

	*/





function getUserType($typeId){

	global $mycms;

	$sql	=	array();

	$sql['QUERY']		=	"SELECT `name`,`type` 

								FROM ".DB_USER_TYPE."

								WHERE `id`	=	?";



	$sql['PARAM'][]	=	array('FILD' => 'id', 	'DATA' => $typeId, 		'TYP' => 's');



	$res =	$mycms->sql_select($sql);



	$details	=	array();

	$details['name']	=	$res[0]['name'];

	$details['type']	=	$res[0]['type'];

	return $details;

}







function printHeader()

{

	global $mycms,$mycommoncms;



	$branchDetails	=	getBranchName($_SESSION['login_user_branch'],'Details');

	//echo '<pre>';

	//print_r($branchDetails);

?>

    <tr>

        <td align="left" valign="top" style="border:0;">

            <div class="prtab">

                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                        <td width="25%" align="left" valign="top" border="0"><img

                                src="<?=$cfg['base_url']?>images/logo.png" width="120" /></td>

                        <td width="10%" align="left" valign="top" border="0"></td>

                        <td width="65%" align="left" valign="top" border="0">

                            <h3 style="margin:0 0 5px 0; padding:0; font-size:14px;"><?=$branchDetails['name']?></h3>

                            <p style="margin:0; padding:0;">

                                <?=$branchDetails['address']?></p>

                            <p style="margin:0; padding:0;"> </p>

                            <p style="margin:0; padding:0;">

                                <a href="#">E-mail:- <?=$branchDetails['email']?></a>

                            </p>

                            <p style="margin:0; padding:0;"> Contact No :- <?=$branchDetails['contact']?></p>

                        </td>

                        <!--

					<td width="22%" align="right" valign="top">

						<h1 style="margin:0 0 5px 0; padding:0; font-size:30px;">INVOICE</h1>

						<p>

							INVOICE NO: dds/15-16/027<br/>

							Date: 	12-07-2015<br/>

							Client Nr :- 112

						</p>

					</td>

					-->

                    </tr>

                    <tr>

                        <td colspan="3" align="left" valign="top" border="0">

                            <div style="border-bottom:solid 1px #ccc; margin:10px 0 0 0;"></div>

                        </td>

                    </tr>

                </table>

            </div>

        </td>

    </tr>

    <?

}





function send_sms($mobile,$message,$isOTPcode=false, $OTPcode='', $fullMessage=''){

	global $mycms,$mycommoncms,$companyIDConnection;





	$dateTime		=	date('Y-m-d H:i:s');

	//$dateTime		=	urlencode($dateTime);

	if ($isOTPcode) {

		$message 		=	$message." \r\nThank You \r\nTEAM EVE\r\n0ycpfi7C+nK";

	} elseif ($OTPcode) {

		$message 		=	$message." \r\nThank You \r\nTEAM EVE\r\n".$OTPcode;

	} elseif ($fullMessage) {

		$message 		=	$message;

	}

	else {

		$message 		=	$message." \r\nThank You \r\nTEAM EVE";

	}



	$encodeMessage	=	urlencode($message);



	 /*$curl = curl_init();

		curl_setopt_array($curl, array(

		  CURLOPT_URL => "https://malert.in/api/api_http.php?username=".SMS_USERNAME."&password=".SMS_PASSWORD."&senderid=".SMS_SENDERID."&to=$mobile&text=$encodeMessage&route=Informative&type=text&datetime=$dateTime",

		  CURLOPT_RETURNTRANSFER => true,

		  CURLOPT_ENCODING => "",

		  CURLOPT_MAXREDIRS => 10,

		  CURLOPT_TIMEOUT => 30,

		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

		  CURLOPT_CUSTOMREQUEST => "GET",

		  CURLOPT_POSTFIELDS => "",

		  CURLOPT_HTTPHEADER => array(

			"content-type: application/json"

		  ),

		));



	$response = curl_exec($curl);

	$err = curl_error($curl);



	curl_close($curl);*/



	$url = "https://sms.encoders.co.in/api/api_http.php";

    $recipients = array($mobile);

    $params = array(

        'username'  => SMS_USERNAME,

        'password'  => SMS_PASSWORD,

        'senderid'  => SMS_SENDERID,

        'text'      => $message,

        'route'     => 'Informative',

        'type'      => 'text',

        'datetime'  => $dateTime,

        'to'        => implode(';', $recipients)

    );

    $post = http_build_query($params, '', '&');



    $ch = curl_init();

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Connection: close"));

    $result = curl_exec($ch);

    if(curl_errno($ch)) {

        $result = "cURL ERROR: " . curl_errno($ch) . " " . curl_error($ch);

        $status	=	'Failed';

    } else {

        $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);

        switch($returnCode) {

            case 200 :

            	//$status	=	'Success';

            	$responseArr	=	explode(' ',$result);

            	$status			=	($responseArr[0]=='OK')?'Success':'Failed';

                break;

            default :

                $result = "HTTP ERROR: " . $returnCode;

                $status	=	'Failed';

        }

    }

    curl_close($ch);



	/*$responseArr	=	explode(' ',$response);



	if($responseArr[0]=='OK'){

		$status	=	'Success';

	}

	else {

		$status	=	'Failed';

	}*/



	$sql		=	array();

	$sql['QUERY']	=	"INSERT INTO ".DB_SMS_HISTORY."

							SET

								`status`		=	?,

								`response`		=	?,

								`date`			=	?,

								`time`			=	?,

								`message`		=	?,

								`phone_no`		=	?,

								`ipaddress`		=	?,

								`session_array`	=	?,

								`server_array`	=	?";



	$sql['PARAM'][]	=	array('FILD' => 'status', 				'DATA' => $status, 								'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'response', 			'DATA' => $result, 								'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'date', 				'DATA' => date('Y-m-d'), 						'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'time', 				'DATA' => date('H:i:s'), 						'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'message', 				'DATA' => $message, 							'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'phone_no', 			'DATA' => $mobile, 								'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'ipaddress', 			'DATA' => $_SERVER['REMOTE_ADDR'], 				'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'session_array', 		'DATA' => serialize($_SESSION), 				'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'server_array', 		'DATA' => serialize($_SERVER), 					'TYP' => 's');



	$mycms->sql_insert($sql);



	$connectedDB 	=	$mycms->defaultQueryManager->dbname;



	// if ($connectedDB!='eve24hrs_main') {

	// 	swapDatabaseConnect(2,DB_SERVER_MAIN,DB_SERVER_USERNAME_MAIN,DB_SERVER_PASSWORD_MAIN,DB_DATABASE_MAIN);

	// 	require_once("/home/eve24hrs/public_html/eve/includes/configure.override.php");

	// 	updateCompanyCredits($companyIDConnection,'sms');

	// 	swapDatabaseDisconnect(2);

	// } else {

	// 	updateCompanyCredits($companyIDConnection,'sms');

	// }



	return $status;

}



function getCompanyAuthentication($companyId){

	global $mycms,$mycommoncms;



	$sql 		=	array();

	$sql['QUERY']		=	"SELECT * 

								FROM "._DB_COMPANY_LOGIN_."

								WHERE `companyId`		=	?

								AND   `status`			=	?";



	$sql['PARAM'][]	=	array('FILD' => 'companyId', 		'DATA' => $companyId, 			'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'status', 			'DATA' => 'A', 					'TYP' => 's');



	$res 			=	$mycms->sql_select($sql);

	$num 			=	$mycms->sql_numrows($res);



	$result 		=	array();

	$result['numrow']	=	$num;

	$result['row']		=	$res[0];





	return $result;

}

/*function authenticationCheck($isInner='') {

    global  $mycms, $mycommoncms;

    if($_SESSION['login']!='true' || $_SESSION['IPAddr']!=$_SERVER['REMOTE_ADDR'] || $_SESSION['loginSerVaddr']!=$_SERVER['SERVER_ADDR'])

    {

        $status	=	'Fail';

    } else if (date("YmdHid")>date("YmdHid",strtotime($_SESSION['lastActivityTime']." +10 minutes"))){

        $status	=	'Fail';

    }



    /*else if($_SESSION['IPAddr']!=$_SERVER['REMOTE_ADDR']){

        $status	=	'Fail';

    }*/

    /*else {

        if ($_SESSION['user_cpanelid']!="") {

            if ($isInner=='yes') {

                require_once("../includes/configure.override.php");

                require_once("../includes/configure.php");

            } else {

                require_once("includes/configure.override.php");

                require_once("includes/configure.php");

            }

            // echo DB_SERVER_MAIN;

            swapDatabaseConnect(2,DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD,DB_DATABASE);

            $sqlCheckCompanyStatus			=	array();

            $sqlCheckCompanyStatus['QUERY']	=	"SELECT `status`

														FROM ".DB_COMPANY."

														WHERE `id`	=	?";

            $sqlCheckCompanyStatus['PARAM'][]	=	array('FILD' => 'id',	 	'DATA' => $_SESSION['user_cpanelid'],			'TYP' => 's');

            $resCheckCompanyStatus 				=	$mycms->sql_select($sqlCheckCompanyStatus);

            $numCheckCompanyStatus				=	$mycms->sql_numrows($resCheckCompanyStatus);

            swapDatabaseDisconnect(2);

            if ($numCheckCompanyStatus>0) {

                if ($resCheckCompanyStatus[0]['status']=='A') {

                    $status     =	'Success';

                    $_SESSION['lastActivityTime']	=	date('Y-m-d H:i:s');

                } else {

                    $status     =	'Fail';

                }

            }

        } else {

            $status     =	'Success';

            $_SESSION['lastActivityTime']	=	date('Y-m-d H:i:s');

        }

    }



    if($status=='Fail')

    {

        $mycommoncms->redirect(BASE_URL.'logout.php');

    }



}*/



function authenticationCheck()

{



	global  $mycms, $mycommoncms;

	if($_SESSION['login']!='true' || $_SESSION['IPAddr']!=$_SERVER['REMOTE_ADDR'] || $_SESSION['loginSerVaddr']!=$_SERVER['SERVER_ADDR'])

	{

		$status	=	'Fail';

	} else if (date("YmdHid")>date("YmdHid",strtotime($_SESSION['lastActivityTime']." +10 minutes"))){

        $status	=	'Fail';

    }



	/*else if($_SESSION['IPAddr']!=$_SERVER['REMOTE_ADDR']){

		$status	=	'Fail';

	}*/

	else

	{

		$status	=	'Success';

        $_SESSION['lastActivityTime']	=	date('Y-m-d H:i:s');

	}



	if($status=='Fail')

	{

		$mycommoncms->redirect(BASE_URL.'logout.php');

	}



}



function loginStatus(){

	global  $mycms, $mycommoncms;

		if($_SESSION['login']=='true' && $_SESSION['IPAddr']==$_SERVER['REMOTE_ADDR']){

			$mycommoncms->redirect(BASE_URL.'dashboard');

		}

	}





/////////////////////////////////////////////////////SHOW CURRENT MONTH YEAR////////////////////////////////////////////////////////////////////



function showAllMonthYr()

{

 // echo"okk";



	global $mycms,$mycommoncms;

	$response 			=	array();



	for($m=1; $m<=12; ++$m)

	{

		$val  =  date('m-Y', mktime(0, 0, 0, $m, 1));



		$response[$m]['id']		= $val;

		$response[$m]['value']	= date('F-Y', mktime(0, 0, 0, $m, 1));

		$response[$m]['selected']= ($val==date('m-Y'))?true:false;

	}

	return $response;

}



function send_notification($senderId,$userId,$notificationSubject,$notificationBody,$section,$sectionId,$deviceType='WINDOWS', $subSectionId=''){



	global $mycms, $mycommoncms;

	$insertIntoNotification				=	array();

	$insertIntoNotification['QUERY']	=	"INSERT INTO "._DB_ACC_EMPLOYEE_NOTIFICATION."

													 SET

													 	 `empid`			=	?,

														 `sender_id`		=	?,

														 `section`			=	?,

														 `sectionId`		=	?, 

														 `subSectionId`		=	?, 

													 	 `subject`			=	?,

													 	 `body`				=	?,

													 	 `deviceType`		=	?,

													 	 `created_date`		=	?,

													 	 `created_ip`		=	?,

													 	 `created_session`	=	?";



	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'empid', 			'DATA' => $senderId, 				'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'sender_id', 		'DATA' => $userId, 					'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'section', 			'DATA' => $section, 				'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'sectionId', 		'DATA' => $sectionId, 				'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'subSectionId', 	'DATA' => $subSectionId, 			'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'subject', 			'DATA' => $notificationSubject, 	'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'body', 			'DATA' => $notificationBody, 		'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'deviceType', 		'DATA' => $deviceType, 				'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'created_date', 	'DATA' => date('Y-m-d H:i:s'), 		'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'created_ip', 		'DATA' => $_SERVER['REMOTE_ADDR'], 	'TYP' => 's');

	$insertIntoNotification['PARAM'][]	=	array('FILD' => 'created_session', 	'DATA' => session_id(), 			'TYP' => 's');

	$resIntoNotification				=	$mycms->sql_insert($insertIntoNotification);

}





function notificationDetails($id){



	global $mycms, $mycommoncms;

	$getNotificationDetails				=	array();

	$getNotificationDetails['QUERY']	=	"SELECT * FROM "._DB_ACC_EMPLOYEE_NOTIFICATION_TEMPLATE."

													 WHERE `id`	=	?";

	$getNotificationDetails['PARAM'][]	=	array('FILD' => 'id', 'DATA' => $id, 'TYP' => 's');

	$resNotificationDetails				=	$mycms->sql_select($getNotificationDetails);

	$rowNotificationDetails				=	$resNotificationDetails[0];

	$notificationArray					=	array();

	$notificationArray['subject']		=	$rowNotificationDetails['subject'];

	$notificationArray['body']			=	$rowNotificationDetails['body'];

	return $notificationArray;

}



function getNotificationCounter($userId){



	global $mycms, $mycommoncms;



	$counter 					=	array();

	$getNotificCount 			=	array();

	$getNotificCount['QUERY']	=	"SELECT * FROM "._DB_ACC_EMPLOYEE_NOTIFICATION."

										 	 WHERE `empid`			=	?

										 	 AND 	`listView`		=	?

										 	 AND 	`status`		=	?";



	$getNotificCount['PARAM'][]	=	array('FILD' => 'empid', 		'DATA' => $userId, 	'TYP' => 's');

	$getNotificCount['PARAM'][]	=	array('FILD' => 'view_status', 	'DATA' => 'no', 	'TYP' => 's');

	$getNotificCount['PARAM'][]	=	array('FILD' => 'status', 		'DATA' => 'A', 		'TYP' => 's');

	$resNotificCount			=	$mycms->sql_select($getNotificCount);

	$numNotificCount			=	$mycms->sql_numrows($resNotificCount);

	if($numNotificCount>0){



		$counter['counter']		=	$numNotificCount;

	}

	else{



		$counter['counter']		=	'0';

	}

	return $counter;

}



function getSMSdetails($smsId){



	global $mycms, $mycommoncms;



	$sql 			=	array();

	$sql['QUERY']	=	"SELECT * FROM "._DB_SMS_TEMPLATE." WHERE `id`	=	?";

	$sql['PARAM'][]	=	array('FILD' => 'id', 'DATA' => $smsId, 'TYP' => 's');

	$res 			=	$mycms->sql_select($sql);

	$row 			=	$res[0];

	$details 		=	array();

	$details['body']=	$row['content'];

	return $details;

}



function getEmailDetails($emailId)

{

	global $mycms, $mycommoncms;



	$sqlGetMail 	=	array();

	$sqlGetMail['QUERY']	=	"SELECT * FROM "

							._DB_EMAIL_TEMPLATE.

							"WHERE `id` =	?";



	$sqlGetMail['PARAM'][]	=	array('FILD' => 'id',	'DATA' => $emailId ,		'TYP' => 's');



	$resGetMail 	=	$mycms->sql_select($sqlGetMail);

	$row 			=   $resGetMail[0];

	$emailDetails 	=	array();

    $emailDetails['subject']	=	$row['subject'];

	$emailDetails['content']	=	$row['content'];



	return $emailDetails;

}



function getNotificationDetails($notificationId){



	global $mycms, $mycommoncms;



	$sql 			=	array();

	$sql['QUERY']	=	"SELECT * FROM "._DB_ACC_EMPLOYEE_NOTIFICATION_TEMPLATE." WHERE `id`	=	?";

	$sql['PARAM'][]	=	array('FILD' => 'id', 'DATA' => $notificationId, 'TYP' => 's');

	$res 			=	$mycms->sql_select($sql);

	$row 			=	$res[0];

	$details 		=	array();



	$details['body']	=	$row['body'];

	$details['subject']	=	$row['subject'];



	return $details;

}





function checkFileExist($filePath,$filename,$type='image'){



	if($filename!=''){

		$modFilePath 	=	$filePath.$filename;

		$pathSlice	 	=	explode('/', $filePath);



		foreach ($pathSlice as $key => $value) {

			if (($key = array_search('..', $pathSlice)) !== false) {

			    unset($pathSlice[$key]);

			}

		}



		$fileExist 		= 	file_exists($modFilePath);



		$finalPath 	=	implode('/', $pathSlice);

		$finalPath	=	BASE_URL.$finalPath.$filename;



		if($fileExist==1){

			return $finalPath;

		}

		else if($type=='image'){

            return $finalPath 	=	BASE_URL.'images/no_img.jpg';

        } else if ($type=='document') {

            return $finalPath 	=	BASE_URL.'images/no_doc.png';

        }

	}

	else {

		if($type=='image'){

			$finalPath 	=	BASE_URL.'images/no_img.jpg';

		} else if ($type=='document') {

			$finalPath 	=	BASE_URL.'images/no_doc.png';

		}

		else {

			$finalPath 	=	'false';

		}

		return $finalPath;

	}

}



function getLastActivityTime($employeeId){



	global $mycms;



	$sqlGetTime				=	array();

	$sqlGetTime['QUERY']	=	"SELECT * 

									FROM "._DB_ACC_EMPLOYEE_ACTIVE_HISTORY." 

									WHERE `empId`	=	?

									ORDER BY `dateTime` DESC";



	$sqlGetTime['PARAM'][]	=	array('FILD' => 'empId', 'DATA' => $employeeId, 'TYP' => 's');



	$resGetTime				=	$mycms->sql_select($sqlGetTime);

	$rowGetTime				=	$resGetTime[0];



	$lastActivityTimeCon 	=	$rowGetTime['dateTimeCons'];

	$lastActivityTime 		=	$rowGetTime['dateTime'];



	$differenceFromNow		=	date('YmdHis')-$lastActivityTimeCon;

	$responseArray			=	array();



	$nowTimeStr 			=	strtotime(date("Y-m-d H:i:s"));

	$lastTimeActive 		=	strtotime($rowGetTime['dateTime']);



	$diffTimeStr 			=	$nowTimeStr-$lastTimeActive;



	$totalMins 				=	round(abs($nowTimeStr - $lastTimeActive) / 60,2);



	/*if($differenceFromNow>180){



		$responseArray['activeStatus']		=	'N';

		$responseArray['lastActiveTime']	=	calculateTime($lastActivityTime);

	}

	else{



		$responseArray['activeStatus']		=	'Y';

		$responseArray['lastActiveTime']	=	'';

	}*/



	if ($totalMins<=10) {

		$responseArray['activeStatus']		=	'Y';

		$responseArray['lastActiveTime']	=	'';

	} else {

		$responseArray['activeStatus']		=	'N';

		$responseArray['lastActiveTime']	=	calculateTime($lastActivityTime);

		//$responseArray['lastActiveTime']	=	$totalMins;

	}



	//$responseArray['minsDiff']	=	$totalMins;



	return $responseArray;

}



/**

* Function Name: getPlaceNameFunction()

* $latitude => Latitude.

* $longitude => Longitude.

* Return =>  Address of the given Latitude and longitude.

**/

function getPlaceNameFunction($latitude,$longitude){

    if(!empty($latitude) && !empty($longitude)){



    	//echo $latitude;

    	//echo $longitude;

        //Send request and receive json data by address

        $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&key=AIzaSyCGoCoxYuDMeh3OX4113t-8gw8RMkuj57M');

        $output = json_decode($geocodeFromLatLong);

        $status = $output->status;



        //print_r($output);

        // print_r($status);

        //Get address from json data

        $address = ($status=="OK")?$output->results[1]->formatted_address:'';

        //Return address of the given latitude and longitude

        //print_r($address);

        if(!empty($address)){

        	//echo $address;

            return $address;

        }else{

            return false;

        }

    }else{

        return false;

    }

}



//The function returns the no. of business days between two dates and it skips the holidays

function getWorkingDays($startDate,$endDate,$holidays){

    // do strtotime calculations just once

    $endDate = strtotime($endDate);

    $startDate = strtotime($startDate);





    //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24

    //We add one to inlude both dates in the interval.

    $days = ($endDate - $startDate) / 86400 + 1;



    $no_full_weeks = floor($days / 7);

    $no_remaining_days = fmod($days, 7);



    //It will return 1 if it's Monday,.. ,7 for Sunday

    $the_first_day_of_week = date("N", $startDate);

    $the_last_day_of_week = date("N", $endDate);



    //---->The two can be equal in leap years when february has 29 days, the equal sign is added here

    //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.

    if ($the_first_day_of_week <= $the_last_day_of_week) {

        if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;

        if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;

    }

    else {

        // (edit by Tokes to fix an edge case where the start day was a Sunday

        // and the end day was NOT a Saturday)



        // the day of the week for start is later than the day of the week for end

        if ($the_first_day_of_week == 7) {

            // if the start date is a Sunday, then we definitely subtract 1 day

            $no_remaining_days--;



            if ($the_last_day_of_week == 6) {

                // if the end date is a Saturday, then we subtract another day

                $no_remaining_days--;

            }

        }

        else {

            // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)

            // so we skip an entire weekend and subtract 2 days

            $no_remaining_days -= 2;

        }

    }



    //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder

//---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it

   $workingDays = $no_full_weeks * 5;

    if ($no_remaining_days > 0 )

    {

      $workingDays += $no_remaining_days;

    }



    //We subtract the holidays

    foreach($holidays as $holiday){

        $time_stamp=strtotime($holiday);

        //If the holiday doesn't fall in weekend

        if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)

            $workingDays--;

    }



    return $workingDays;

}



function total_sun($month,$year)

{

    $sundays=0;

    $total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);

    for($i=1;$i<=$total_days;$i++)

    if(date('N',strtotime($year.'-'.$month.'-'.$i))==7)

    $sundays++;

    return $sundays;

}





function getCompanyLatLong($companyId){

	global $mycms;



	$sql 		=	array();

	$sql['QUERY']	=	"SELECT `companyLat`,

								`companyLong`

							FROM ".DB_COMPANY."

							WHERE `id` 		=	?";



	$sql['PARAM'][]	=	array('FILD' => 'id', 'DATA' => $companyId, 'TYP' => 's');



	$res 			=	$mycms->sql_select($sql);



	$data 		=	array();



	$data['lat']	=	$res[0]['companyLat'];

	$data['lon']	=	$res[0]['companyLong'];



	return $data;

}





function compute_distance($from_lat, $from_lon, $to_lat, $to_lon, $units='KM')

{

    $units = strtoupper(substr(trim($units),0,1));

    // ENSURE THAT ALL ARE FLOATING POINT VALUES

    $from_lat = floatval($from_lat);

    $from_lon = floatval($from_lon);

    $to_lat   = floatval($to_lat);

    $to_lon   = floatval($to_lon);



    // IF THE SAME POINT

    if ( ($from_lat == $to_lat) && ($from_lon == $to_lon) )

    {

        return 0.0;

    }



    // COMPUTE THE DISTANCE WITH THE HAVERSINE FORMULA

    $distance = acos( sin(deg2rad($from_lat))

              * sin(deg2rad($to_lat))

              + cos(deg2rad($from_lat))

              * cos(deg2rad($to_lat))

              * cos(deg2rad($from_lon - $to_lon)) );



    $distance = rad2deg($distance);



    // DISTANCE IN MILES AND KM - ADD OTHERS IF NEEDED

    $miles = (float) $distance * 69.0;

    $km    = (float) $miles * 1.61;

    $meter 	=	(float)$miles * 1609.34;



    // RETURN MILES

    /*if ($units == 'M') return (float)round($miles,1);



    // RETURN KILOMETERS = MILES * 1.61

    if ($units == 'K') return (float)round($km,2);



    if ($units == 'METER') return $meter;*/



    return round($meter,2);

}



function isValidMd5($md5 =''){

   if(preg_match('/^[a-f0-9]{32}$/', $md5)){

   		return true;

   } else {

   		return false;

   }

}



function setCronJob($data=''){

	global $mycms;



	if($data!=''){

		$decodeData 	=	json_decode($data,true);



		$type 					=	$decodeData['type'];

		$empid 					=	$decodeData['empid'];

		$cpanelid 				=	$decodeData['cpanelid'];

		$fcmid 					=	$decodeData['fcmid'];

		$deviceid 				=	$decodeData['deviceid'];

		$toname 				=	$decodeData['toname'];

		$tomailnum 				=	$decodeData['tomailnum'];

		$subject 				=	$decodeData['subject'];

		$content 				=	$decodeData['content'];

		$fcmNotificationTag 	=	$decodeData['fcmNotificationTag'];

		$notificationSection 	=	$decodeData['notificationSection'];

		$notificationSectionId 	=	$decodeData['notificationSectionId'];



		$connectedDB 	=	$mycms->defaultQueryManager->dbname;



		if($connectedDB!='eve24hrs_main'){

			$swapDb 	=	true;

			include_once("/home/eve24hrs/public_html/eve/includes/configure.override.php");

			swapDatabaseConnect(2,DB_SERVER_MAIN,DB_SERVER_USERNAME_MAIN,DB_SERVER_PASSWORD_MAIN,DB_DATABASE_MAIN);

		}



		$sql 		=	array();



		$sql['PARAM'][]		=	array('FILD' => 'type',			'DATA' => $type,		'TYP' => 's');

		$sql['PARAM'][]		=	array('FILD' => 'empId',		'DATA' => $empid,		'TYP' => 's');

		$sql['PARAM'][]		=	array('FILD' => 'companyId',	'DATA' => $cpanelid,	'TYP' => 's');





		if($type=='notification'){

			$where 		=	" `fcmId` 	=	?, `deviceId`	=	?, `fcmNotificationTag` = ?, `notificationSection` = ?, `notificationSectionId` = ?,";



			$sql['PARAM'][]		=	array('FILD' => 'fcmId',					'DATA' => $fcmid,					'TYP' => 's');

			$sql['PARAM'][]		=	array('FILD' => 'deviceId',					'DATA' => $deviceid,				'TYP' => 's');

			$sql['PARAM'][]		=	array('FILD' => 'fcmNotificationTag',		'DATA' => $fcmNotificationTag,		'TYP' => 's');

			$sql['PARAM'][]		=	array('FILD' => 'notificationSection',		'DATA' => $notificationSection,		'TYP' => 's');

			$sql['PARAM'][]		=	array('FILD' => 'notificationSectionId',	'DATA' => $notificationSectionId,	'TYP' => 's');



		}

		else {

			$where 		=	" `toName` 	=	?, `toMailNum`	=	?,";



			$sql['PARAM'][]		=	array('FILD' => 'toName',		'DATA' => $toname,		'TYP' => 's');

			$sql['PARAM'][]		=	array('FILD' => 'toMailNum',	'DATA' => $tomailnum,	'TYP' => 's');



		}



		$sql['QUERY']	=	"INSERT INTO "._DB_CRON_JOB_."

								SET 

									`type`			=	?,

									`empId`			=	?,

									`companyId`		=	?,

									".$where."

									`subject`		=	?,

									`content`		=	?,

									`createdDate`	=	?,

									`createdIp`		=	?";



		$sql['PARAM'][]		=	array('FILD' => 'subject',		'DATA' => $subject,					'TYP' => 's');

		$sql['PARAM'][]		=	array('FILD' => 'content',		'DATA' => $content,					'TYP' => 's');

		$sql['PARAM'][]		=	array('FILD' => 'createdDate',	'DATA' => date('Y-m-d H:i:s'),		'TYP' => 's');

		$sql['PARAM'][]		=	array('FILD' => 'createdIp',	'DATA' => $_SERVER['REMOTE_ADDR'],	'TYP' => 's');



		$res 				=	$mycms->sql_insert($sql);

		if($swapDb){

			swapDatabaseDisconnect(2);

			$swapDb  =	false;

		}

	}

}



function swapDatabaseConnect($index,$host,$user,$password,$db){

	global $mycms;



	$mycms->addDatabase($index,$host,$user,$password,$db);

	$mycms->setDatabase($index);

}



function swapDatabaseDisconnect($index){

	global $mycms;



	$mycms->resetDatabase($index);

}





 /**

   * Created by PhpStorm.

   * User: sakthikarthi

   * Date: 9/22/14

   * Time: 11:26 AM

   * Converting Currency Numbers to words currency format

   */

//$number = 190908100.25;

function convertToWordsINR($number){

   $no = round($number);

   $point = round($number - $no, 2) * 100;

   $hundred = null;

   $digits_1 = strlen($no);

   $i = 0;

   $str = array();

   $words = array('0' => '', '1' => 'one', '2' => 'two',

    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',

    '7' => 'seven', '8' => 'eight', '9' => 'nine',

    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',

    '13' => 'thirteen', '14' => 'fourteen',

    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',

    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',

    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',

    '60' => 'sixty', '70' => 'seventy',

    '80' => 'eighty', '90' => 'ninety');

   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');

   while ($i < $digits_1) {

     $divider = ($i == 2) ? 10 : 100;

     $number = floor($no % $divider);

     $no = floor($no / $divider);

     $i += ($divider == 10) ? 1 : 2;

     if ($number) {

        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;

        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;

        $str [] = ($number < 21) ? $words[$number] .

            " " . $digits[$counter] . $plural . " " . $hundred

            :

            $words[floor($number / 10) * 10]

            . " " . $words[$number % 10] . " "

            . $digits[$counter] . $plural . " " . $hundred;

     } else $str[] = null;

  }

  $str = array_reverse($str);

  $result = implode('', $str);

  $points = ($point) ?

    "and " . convertNumberToWords($point)." paise" : '';

  return $result . "rupees  " . $points;

}





function insertTableValue($tableName,$dataArr){

	global $mycms;



	if (!empty($dataArr)) {

		$sql 		=	array();



		$dataArrLength 	=	count($dataArr);



		$s 			=	1;

		$paramValue	=	"";

		foreach ($dataArr as $key => $value) {

			$paramValue		.=	"`".$key."`  = 	?";

			if (end($dataArr)!=$value || $dataArrLength!=$s) {

				$paramValue		.= 	",";

			}

			$s++;



			$sql['PARAM'][] 	=	array("FILD" => $key, 	"DATA" => $value, 	"TYP" => "s");

		}



		$sql['QUERY'] 		=	"INSERT INTO ".$tableName."

									SET 

										".$paramValue."";



		$res 		=	$mycms->sql_insert($sql);

		if ($res) {

			return $res;

		} else {

			$error = $mycms->sql_error();

			$mycms->kill("There is an error => ".$error['message']);

		}

	} else {

		$mycms->kill("Data Array could not be null.");

	}

}



function updateTableValue($tableName,$dataArr,$whereArr){

	global $mycms;



	if (!empty($dataArr) && !empty($whereArr)) {

		$sql 		=	array();



		$paramValue	=	"";

		foreach ($dataArr as $key => $value) {

			$paramValue		.=	"`".$key."`  = 	?";

			if (end($dataArr)!=$value) {

				$paramValue		.= 	",";

			}



			$sql['PARAM'][] 	=	array("FILD" => $key, 	"DATA" => $value, 	"TYP" => "s");

		}



		$whereSqlValue 	=	"";

		foreach ($whereArr as $whereKey => $whereValue) {

			$whereSqlValue		.=	"`".$whereKey."`  = 	?";

			if (end($whereArr)!=$whereValue) {

				$whereSqlValue		.= 	" AND ";

			}

			$sql['PARAM'][] 	=	array("FILD" => $whereKey, 	"DATA" => $whereValue, 	"TYP" => "s");

		}





		$sql['QUERY'] 		=	"UPDATE ".$tableName."

									SET 

										".$paramValue."

									WHERE ".$whereSqlValue."";

		//print_r($sql);

		$res 		=	$mycms->sql_update($sql);

		//if ($res) {

		return $res;

		/*} else {

			$error = $mycms->sql_error();

			$mycms->kill("There is an error => ".$error);

			return $res;

		}*/

	} else {

		$mycms->kill("Data Array could not be null.");

	}

}



function insertLoginHistory($userId,$deviceType){

	global $mycms;



	$insertValue 						=	array();

	$insertValue['empId'] 				=	$userId;

	$insertValue['deviceType'] 			=	$deviceType;

	$insertValue['dateTime'] 			=	date("Y-m-d H:i:s");

	$insertValue['dateTimeCons'] 		=	date("YmdHis");

	$insertValue['createdDate'] 		=	date("Y-m-d H:i:s");

	$insertValue['createdSession'] 		=	session_id();

	$insertValue['createdIp'] 			=	$_SERVER['REMOTE_ADDR'];



	$response 	=	insertTableValue(_DB_ACC_EMPLOYEE_LOGIN_HISTORY_,$insertValue);

	return $response;

}



function insertIntoMailLog($toMail,$mailSubject,$mailBody,$companyName='',$mailType='teaser'){

	global $mycms;

	$sqlInsert 				=	array();

	$sqlInsert['QUERY']		=	"INSERT INTO "._DB_MAIL_LOG_."

										SET 

											`toMailID`			=	?,

											`mailSubject`		=	?,

											`mailBody`			=	?,

											`companyName`		=	?,

											`mailType`			=	?,

											`createdBy`			=	?,

											`createdDateTime`	=	?,

											`createdSession`	=	?,

											`createdIp`			=	?";

	$sqlInsert['PARAM'][]	=	array('FILD' => 'toMailID', 		'DATA' => $toMail, 						'TYP' => 's');

	$sqlInsert['PARAM'][]	=	array('FILD' => 'mailSubject', 		'DATA' => $mailSubject, 				'TYP' => 's');

	$sqlInsert['PARAM'][]	=	array('FILD' => 'mailBody', 		'DATA' => $mailBody, 					'TYP' => 's');

	$sqlInsert['PARAM'][]	=	array('FILD' => 'companyName', 		'DATA' => $companyName, 				'TYP' => 's');

	$sqlInsert['PARAM'][]	=	array('FILD' => 'mailType', 		'DATA' => $mailType, 					'TYP' => 's');

	$sqlInsert['PARAM'][]	=	array('FILD' => 'createdBy', 		'DATA' => $_SESSION['admin_login_uid'], 'TYP' => 's');

	$sqlInsert['PARAM'][]	=	array('FILD' => 'createdDateTime', 	'DATA' => date('Y-m-d H:i:s'), 			'TYP' => 's');

	$sqlInsert['PARAM'][]	=	array('FILD' => 'createdSession', 	'DATA' => session_id(), 				'TYP' => 's');

	$sqlInsert['PARAM'][]	=	array('FILD' => 'createdIp', 		'DATA' => $_SERVER['REMOTE_ADDR'], 		'TYP' => 's');

	$mycms->sql_insert($sqlInsert);

}



function checkHolidayDate($date){

	global $mycms;



    //echo "####".$date;



	$date 		=	date("Y-m-d",strtotime($date));



	$sql 		=	array();

	$sql['QUERY']	=	"SELECT * 

							FROM "._DB_ACC_COMPANY_HOLIDAY."

							WHERE `status`		=	?

							AND    `branchId` 	=	?

							AND   DATE(`date`)	=	?";



	$sql['PARAM'][]	=	array('FILD' => 'status', 		'DATA' => "A", 		'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'branchId', 		'DATA' => $_SESSION['empBranchId'], 		'TYP' => 's');

	$sql['PARAM'][]	=	array('FILD' => 'date', 	'DATA' => $date, 	'TYP' => 's');



	$res 			=	$mycms->sql_select($sql);

    // print_r($res);

	$num 			=	$mycms->sql_numrows($sql);



	if ($num>0) {

		return "yes";

	} else {

		return "no";

	}



}



function uploadFile($filePath,$fileTmpName){

    return move_uploaded_file($fileTmpName,$filePath);

}



function isHTML($string){

	if($string != strip_tags($string)) {

  		// is HTML

  		//echo '0';

  		return false;

 	} else {

  		// not HTML

  		//echo '1';

  		return $string;

 	}

}



function buildLoginAuthtokenAndSetCookie($loginCompanyId, $loginUserId, $platform, $loginStatus,$useFor='') {

	global $mycms;



    $employeeDetails 	=	getEmployeeDetails1($loginUserId);

	$buildUserAuth		=	array();

    if ($useFor=='evesheet') {

        $buildUserAuth["companyId"] = $loginCompanyId;

        $buildUserAuth["userId"] = $loginUserId;

        $buildUserAuth["mainUserId"] = $_SESSION['user_masterid'];

        $buildUserAuth["platform"] = $platform;

        $buildUserAuth["loginStatus"] = $loginStatus;

    } else {

        $buildUserAuth["companyId"]     =	$loginCompanyId;

        $buildUserAuth["userId"]        =	$loginUserId;

        $buildUserAuth["mainUserId"]    =   $_SESSION['user_masterid'];

        $buildUserAuth["platform"]      =	"web";

        $buildUserAuth["loginStatus"]   =	$loginStatus;

    }



	$setAuthenticationVar       =   $loginUserId.'/'.$loginCompanyId.'/true/'.$_SESSION['user_masterid'];

    $encodedAuthenticationVar   =   base64_encode($setAuthenticationVar);

    $buildUserAuth			=	json_encode($buildUserAuth);

    $authenticationToken	=	base64_encode(base64_encode(base64_encode($buildUserAuth)));



    //setcookie("suman", "samanta",time()+86400,'/');



	$sqlCheck 			=	array();

	$sqlCheck['QUERY']	=	"SELECT `authToken`

								FROM "._DB_ACC_EMPLOYEE_LOGIN_AUTHENTICATION_."

								WHERE `employeeId`	=	?

									AND `status`	=	?";

	$sqlCheck['PARAM'][]	=	array('FILD' => 'employeeId', 	'DATA' => $loginUserId, 	'TYP' => 's');

	$sqlCheck['PARAM'][]	=	array('FILD' => 'status', 		'DATA' => 'A', 				'TYP' => 's');

	$resCheck 				=	$mycms->sql_select($sqlCheck);

	$numCheck 				=	$mycms->sql_numrows($resCheck);

	if ($numCheck>0) {

		$sql 			=	array();

		$sql['QUERY']	=	"UPDATE "._DB_ACC_EMPLOYEE_LOGIN_AUTHENTICATION_."

								SET 

									`authToken`		=	?,

									`loginStatus`	=	?

								WHERE `employeeId`	=	?

									AND `status`	=	?";

		$sql['PARAM'][]	=	array('FILD' => 'authToken', 	'DATA' => $authenticationToken,         'TYP' => 's');

		$sql['PARAM'][]	=	array('FILD' => 'loginStatus', 	'DATA' => $loginStatus, 		        'TYP' => 's');

		$sql['PARAM'][]	=	array('FILD' => 'employeeId', 	'DATA' => $loginUserId, 		        'TYP' => 's');

		$sql['PARAM'][]	=	array('FILD' => 'status', 		'DATA' => 'A', 					        'TYP' => 's');

		$mycms->sql_update($sql);

	} else {

		$sql 			=	array();

		$sql['QUERY']	=	"INSERT INTO "._DB_ACC_EMPLOYEE_LOGIN_AUTHENTICATION_."

									SET 

										`employeeId`		=	?,

										`authToken`			=	?,

										`loginStatus`		=	?,

										`createdDateTime`	=	?,

										`createdSession`	=	?,

										`createdIp`			=	?";

		$sql['PARAM'][]	=	array('FILD' => 'employeeId', 		'DATA' => $loginUserId, 			    'TYP' => 's');

		$sql['PARAM'][]	=	array('FILD' => 'authToken', 		'DATA' => $authenticationToken, 	    'TYP' => 's');

		$sql['PARAM'][]	=	array('FILD' => 'loginStatus', 		'DATA' => $loginStatus, 			    'TYP' => 's');

		$sql['PARAM'][]	=	array('FILD' => 'createdDateTime', 	'DATA' => date('Y-m-d H:i:s'), 	'TYP' => 's');

		$sql['PARAM'][]	=	array('FILD' => 'createdSession', 	'DATA' => session_id(), 			    'TYP' => 's');

		$sql['PARAM'][]	=	array('FILD' => 'createdIp', 		'DATA' => $_SERVER['REMOTE_ADDR'], 	    'TYP' => 's');

		$mycms->sql_insert($sql);

		//print_r($sql);

	}

	if ($useFor=='evesheet'){

        return $authenticationToken;

    } else {

        return $encodedAuthenticationVar;

    }



}



function checkLoginUserAuthenticationCheck($authorizationEncoded) {

	global $mycms;

	$result 				=	array();



	//*************build up auth token*************\\

    $decodedAuthToken   =   base64_decode($authorizationEncoded);

    $authTokenArray     =   explode("/", $decodedAuthToken);

    $loginUserId        =   $authTokenArray[0];

    $loginCompanyId     =   $authTokenArray[1];

    $loginStatus        =   $authTokenArray[2];

    $userMainId         =   $authTokenArray[3];



    $buildUserAuth                  =	array();

    $buildUserAuth["companyId"]     =	$loginCompanyId;

    $buildUserAuth["userId"]        =	$loginUserId;

    $buildUserAuth["mainUserId"]    =   $userMainId;

    $buildUserAuth["platform"]      =	"web";

    $buildUserAuth["loginStatus"]   =	$loginStatus;



    $buildUserAuth			=	json_encode($buildUserAuth);

    $authorizationEncoded	=	base64_encode(base64_encode(base64_encode($buildUserAuth)));



    //****************** end **********************\\



	$checkAuthorization				=	array();

	$checkAuthorization['QUERY']	=	"SELECT `id` 

											FROM "._DB_ACC_EMPLOYEE_LOGIN_AUTHENTICATION_."

											WHERE `employeeId`	=	?

												AND `authToken`	=	?

												AND `loginStatus`	=	?";

	$checkAuthorization['PARAM'][]	=	array('FILD' => 'employeeId', 	'DATA' => trim($loginUserId), 					'TYP' => 's');

	$checkAuthorization['PARAM'][]	=	array('FILD' => 'authToken', 	'DATA' => trim($authorizationEncoded), 	        'TYP' => 's');

	$checkAuthorization['PARAM'][]	=	array('FILD' => 'loginStatus', 	'DATA' => trim('true'), 					    'TYP' => 's');

	$resCheckAuthorization			=	$mycms->sql_select($checkAuthorization);

	$numCheckAuthorization			=	$mycms->sql_numrows($resCheckAuthorization);

	//print_r($checkAuthorization);

	if ($numCheckAuthorization>0) {

		$_SESSION['user_empid']		=	$loginUserId;

	} else {

		$result['result']		=	'failed';

		$result['loginStatus']	=	'false';

		echo json_encode($result);

		die();

	}

}



function compress_image($source_url, $destination_url,$platform='ios') {

    $info = getimagesize($source_url);

    $fileSize = filesize($source_url);

    // if ($platform!='android'){

        if($fileSize>10485760) {

            $quality = 15;

        } else if($fileSize>5242880 && $fileSize<10485760) {

            $quality = 30;

        } else if($fileSize>2097152 && $fileSize<5242880) {

            $quality = 45;

        } else if($fileSize>1048576 && $fileSize<2097152) {

            $quality = 55;

        } else {

            $quality = 80;

        }

    /*} else {

        $quality = 100;

    }*/





    if ($info['mime'] == 'image/jpeg')

        $image = imagecreatefromjpeg($source_url);



    elseif ($info['mime'] == 'image/gif')

        $image = imagecreatefromgif($source_url);



    elseif ($info['mime'] == 'image/png')

        $image = imagecreatefrompng($source_url);



    imagejpeg($image, $destination_url, $quality);

    return $destination_url;

}



function openSSLEncryption ($str=''){

	if ($_SERVER['HTTP_HOST'] != 'localhost') {

	 	// Store the cipher method

		$ciphering = "AES-256-CBC";

		 

		// Use OpenSSl Encryption method

		$iv_length = openssl_cipher_iv_length($ciphering);

		$options = 0;

		 

		// Non-NULL Initialization Vector for encryption

		$encryption_iv = 'ABCDEFGH91011121';

		 

		// Store the encryption key

		$encryption_key = "LmLWPyqOa1b3nqvOhUdlXoJoKjgZkIjii2eNya6DMbuXRLE3rgXO28q7GLAGfkRZFxkjuGAMOGR";

		 

		// Use openssl_encrypt() function to encrypt the data

		$encryption = openssl_encrypt($str, $ciphering,$encryption_key, $options, $encryption_iv);

		return  $encryption;

	} else {

		return $str;

	} 

}

function  openSSLDecryption ($str=''){

	if ($_SERVER['HTTP_HOST'] != 'localhost') {

		// Store the cipher method

		$ciphering = "AES-256-CBC";

		 

		// Use OpenSSl Encryption method

		$iv_length = openssl_cipher_iv_length($ciphering);

		$options = 0;



		 

		// Non-NULL Initialization Vector for decryption

		$decryption_iv = 'ABCDEFGH91011121';

		 

		// Store the decryption key

		$decryption_key = "LmLWPyqOa1b3nqvOhUdlXoJoKjgZkIjii2eNya6DMbuXRLE3rgXO28q7GLAGfkRZFxkjuGAMOGR";

		 

		// Use openssl_decrypt() function to decrypt the data

		$decryption=openssl_decrypt ($str, $ciphering, $decryption_key, $options, $decryption_iv);

		return  $decryption;

	} else {

		return $str;

	}

}



function getStateDetails($stateId) {

	global $mycms;

	$sql 	=	array();

	$sql['QUERY']	=	"SELECT *

							FROM ".DB_STATE."

							WHERE `id`	=	?";



	$sql['PARAM'][]	=	array("FILD" => "id", "DATA" => $stateId, "TYP" => "s");



	$res 	=	$mycms->sql_select($sql);

	return $res[0];

}

function getCountryDetails($countryId) {

	global $mycms;

	$sql 	=	array();

	$sql['QUERY']	=	"SELECT *

							FROM ".DB_COUNTRY."

							WHERE `id`	=	?";



	$sql['PARAM'][]	=	array("FILD" => "id", "DATA" => $countryId, "TYP" => "s");



	$res 	=	$mycms->sql_select($sql);

	return $res[0];

}

function getCityDetails($cityId) {

	global $mycms;

	$sql 	=	array();

	$sql['QUERY']	=	"SELECT *

							FROM ".DB_CITY."

							WHERE `id`	=	?";



	$sql['PARAM'][]	=	array("FILD" => "id", "DATA" => $cityId, "TYP" => "s");



	$res 	=	$mycms->sql_select($sql);

	return $res[0];

}

function getActivitiesCategoryDetails($categoryId) {

	global $mycms;

	$sql 	=	array();

	$sql['QUERY']	=	"SELECT *

							FROM ".DB_ACTIVITIES_CATEGORY."

							WHERE `id`	=	?";



	$sql['PARAM'][]	=	array("FILD" => "id", "DATA" => $categoryId, "TYP" => "s");



	$res 	=	$mycms->sql_select($sql);

	return $res[0];

}





function pagesource()

{

?>



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="image/favicon.png" type="favicon">

    <title>GLEAMSYS</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Lateral On-Scroll Sliding with jQuery - Timeline Example with CSS3" />

    <meta name="keywords" content="lateral, sides, slide, scroll, jquery, css3, timeline" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="stylesheet" type="text/css" href="css/responcive.css">

    <link href="css/owl.carousel.min.css?v=2" rel="stylesheet" type="text/css">

	<link href="css/owl.theme.default.min.css?v=2" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/price_range_style.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <script src="js/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery.gScrollingCarousel.js"></script>

    <script src="js/owl.carousel.js"></script>



	<script src="js/simplyscroll.js"></script>
	<!-- <script src="ls/price_range_script.js"></script> -->

    <script>

        $(document).ready(function() {

            $(".g-scrolling-carousel .items").gScrollingCarousel();

            

        });

    </script>

</head>

<?

}



function svg()

{

?>

 

 <svg class="main-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 135">

  <path fill="#fff" fill-opacity="1" d="M0,96L80,106.7C160,117,320,139,480,122.7C640,107,800,53,960,37.3C1120,21,1280,43,1360,53.3L1440,64L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>

</svg>

<?

}

  

function booknowcmn()

{

?>

<div>

        <button onclick="book(this)" class="left-book-buton" style="background: #333333;color: white;padding: 14px 15px;position: fixed;top: 50%;left: 0;transform:translate(0,-50%); font-family: myFirstFont;">

            B<br>o<br>o<br>k<br> <br>N<br>o<br>w<br><br><span ><i class="fas fa-long-arrow-alt-right" dep="rot" style="transition: .6s ease;"></i></span>

        </button>

        <script>

            function book(obj)

                { 

                    var parent=$(obj).parent().closest("div");

                    var thediv=$(parent).find("div[dep=book_form]");

                    var thebtn=$(parent).find("i[dep=rot]");

                    $(thediv).toggleClass("margin");

                    $(thebtn).toggleClass("rotate");      

                }

        </script>

</div>

<?php

}



?>