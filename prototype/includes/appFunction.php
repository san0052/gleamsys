<?php
/*
function attendanceList($user_id){

	global $mycms,$mycommoncms,$cfg;
	
	$year			=	date('Y');
	$month			=	date('F');
	$intMonth		=	date('m');
	$getTotalDays	=	getDaysOfMonth($month,$year);
	$sundays 		= 	getSundays($year,date('m'));
	$holidays		=	calculateBankHolidays($year);
	
	$data 			=	array();
	
	$data['result']	=	"success";
	
	$itemcnt	=	0;
	
	if($user_id!='')
	{
		for($i=1;$i<=$getTotalDays;$i++)
		{
			$sql 			=	array();
			$sql['QUERY']	=	"SELECT *, 
									   (TIME_TO_SEC(CONCAT(intime,':00'))/60) AS intime_mins,
									   (TIME_TO_SEC(CONCAT(outTime,':00'))/60) AS outTime_mins,
									   (TIME_TO_SEC(CONCAT(startLunch,':00'))/60) AS startLunch_mins,
									   (TIME_TO_SEC(CONCAT(endLunch,':00'))/60) AS endLunch_mins 
									FROM "._DB_ACC_EMPLOYEE_ATTENDENCE."
									WHERE `empId`		=	?
									AND   DATE(`date`)	=	?";

			$sql['PARAM'][]	=	array('FILD' => 'empId',	'DATA' => 	$user_id,	                'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'date',		'DATA' => 	$year.'-'.$intMonth.'-'.$i,	'TYP'=>'s');

			$res 			=	$mycms->sql_select($sql);
			
		//	print_r($res);
			
			
				
				$inhours =  $res[0]['intime_mins'];
				$outhours = $res[0]['outTime_mins'];
				$slunch	  = $res[0]['startLunch_mins'];
				$elunch	  = $res[0]['endLunch_mins'];
				
				$lunchTime = 0;
				if($elunch>$slunch)
				{
					$lunchTime	= $elunch - $slunch;
				}
				
				$workTime = 0;
				if($outhours>$inhours)
				{
					$workTime	= $outhours - $inhours;	
				}
				
				$totalminWork = 0;
				if($workTime > $lunchTime)
				{
					$totalminWork	=	$workTime -	$lunchTime;
				}
				
				$totalWorkHour	=	floor($totalminWork / 60);
				$totalWorkMin	=   $totalminWork % 60;
				
				$data['attendance_list'][$itemcnt]['id']			                    = ''.$res[0]['id']; 
				$data['attendance_list'][$itemcnt]['date']			                    = ''.$res[0]['date']; 
				$data['attendance_list'][$itemcnt]['work_hours']			            = "$totalWorkHour:$totalWorkMin";
				
			
			$itemcnt++;
		}
	}
	else
	{
		$data['result']	=	"fail";
		$data['status']	=	"No such User Exits";
	}
	

	
	return $data;
}



////////////////////////////////////////////Hr Attendance list details///////////////////////////////////////////

function attendanceListDetails($id,$user_id){

	global $mycms,$mycommoncms,$cfg;
	
	$year			=	date('Y');
	$month			=	date('F');
	$intMonth		=	date('m');
	$getTotalDays	=	getDaysOfMonth($month,$year);
	$sundays 		= 	getSundays($year,date('m'));
	$holidays		=	calculateBankHolidays($year);
	
	$data 			=	array();
	
	$data['result']	=	"success";
	
	$itemcnt	=	0;
	
	if($user_id!='')
	{
		
			$sql 			=	array();
			$sql['QUERY']	=	"SELECT *, 
									   (TIME_TO_SEC(CONCAT(intime,':00'))/60) AS intime_mins,
									   (TIME_TO_SEC(CONCAT(outTime,':00'))/60) AS outTime_mins,
									   (TIME_TO_SEC(CONCAT(startLunch,':00'))/60) AS startLunch_mins,
									   (TIME_TO_SEC(CONCAT(endLunch,':00'))/60) AS endLunch_mins 
									FROM "._DB_ACC_EMPLOYEE_ATTENDENCE."
									WHERE `empId`		=	?
									AND   `id`	=	?";

			$sql['PARAM'][]	=	array('FILD' => 'empId',	'DATA' => 	$user_id,	                'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'id',		'DATA' => 	$id,						'TYP'=>'s');

			$res 			=	$mycms->sql_select($sql);
			
		//	print_r($res);
			
			
				
				$inhours =  $res[0]['intime_mins'];
				$outhours = $res[0]['outTime_mins'];
				$slunch	  = $res[0]['startLunch_mins'];
				$elunch	  = $res[0]['endLunch_mins'];
				
				$lunchTime = 0;
				if($elunch>$slunch)
				{
					$lunchTime	= $elunch - $slunch;
				}
				
				$workTime = 0;
				if($outhours>$inhours)
				{
					$workTime	= $outhours - $inhours;	
				}
				
				$totalminWork = 0;
				if($workTime > $lunchTime)
				{
					$totalminWork	=	$workTime -	$lunchTime;
				}
				
				$totalWorkHour	=	floor($totalminWork / 60);
				$totalWorkMin	=   $totalminWork % 60;
				$totalWorkHour	=	$totalWorkHour.'hr';
				$totalWorkMin	=	$totalWorkMin.'min';
				
				$data['attendance_details'][$itemcnt]['id']			                    = ''.$res[0]['id']; 
				$data['attendance_details'][$itemcnt]['date']			                = ''.$res[0]['date']; 
				$data['attendance_details'][$itemcnt]['in_time']			            = ''.$res[0]['intime'];
				$data['attendance_details'][$itemcnt]['out_time']			            = ''.$res[0]['outTime'];
				$data['attendance_details'][$itemcnt]['work_hours']			            = $totalWorkHour.' '.$totalWorkMin;
				$data['attendance_details'][$itemcnt]['start_lunch']			        = ''.$res[0]['startLunch'];
				$data['attendance_details'][$itemcnt]['end_lunch']			            = ''.$res[0]['endLunch'];
				
				
			
		
	}
	else
	{
		$data['result']	=	"fail";
		$data['status']	=	"No such User Exits";
	}
	

	
	return $data;
}


//////////////////////////////////////////////Hr Attendance checkIn//////////////////////////////////////////////

function hrCheckInDetails($user_id,$session_id){

	global $mycms,$mycommoncms,$cfg;
	
	$data 			=	array();
	
	$data['result']	=	"success";
	
	
	
	$time 			=	date('H:i');
	$today			=	date('Y-m-d');
	
	if($user_id!= '' && $session_id!= '')
	{
		/////
		$sqlCheckClockIn	= array();
		
		$sqlCheckClockIn['QUERY']	=	"SELECT * 
											FROM "._DB_ACC_EMPLOYEE_ATTENDENCE." 
											WHERE `status` 		= ?
											AND   `empId`	    = ?
											AND   `date` 	    = ?";
							
		$sqlCheckClockIn['PARAM'][]		=	array('FILD' => 'status',		'DATA' =>'A',			'TYP' => 's');
		$sqlCheckClockIn['PARAM'][]		=	array('FILD' => 'empId',	    'DATA' => $user_id,		'TYP' => 's');	
		$sqlCheckClockIn['PARAM'][]		=	array('FILD' => 'date',	        'DATA' => $today,		'TYP' => 's');		
		$resClockIn						=	$mycms->sql_select($sqlCheckClockIn);
		
		
		
		if($resClockIn )
		{
		    $data['result']		=	"fail";
			$data['status'] 	=	'Already clockIn';	
		}
		else
		{
				//////
			$sql 			=	array();
			$sql['QUERY']	=	"INSERT INTO "._DB_ACC_EMPLOYEE_ATTENDENCE."
									SET 
										`empId`	 			=	?,
										`date`				=	?,
										`intime`			=	?,
										`attenStatus`		=	?,
										`createdDate`		=	?,
										`createdSession`	=	?,
										`createdIp`			=	?";

			$sql['PARAM'][]	=	array('FILD' => 'empId',			'DATA' => 	$user_id,					'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'date',				'DATA' => 	date('Y-m-d'),				'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'intime',			'DATA' => 	$time,						'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'attenStatus',		'DATA' => 	'In',						'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'createdDate',		'DATA' => 	date('Y-m-d'),				'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'createdSession',	'DATA' => 	$session_id,				'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'createdIp',		'DATA' => 	$_SERVER['REMOTE_ADDR'],	'TYP'=>'s');

			$res 			=	$mycms->sql_insert($sql);

			if($res){
				$data['status'] 	=	'clockIn Success';	
			}
			else {
				$data['status'] 	=	'clockIn fail';	
			}
		}
		
		
	}
	else
	{
		$data['result']		=	"error";
		$data['status'] 	=	'UserId/SessionId Mismatch';	
	}

	return $data;
	
}



/////////////////////////////////////////////Hr Attendance checkOut///////////////////////////////////////////////

function hrCheckOutDetails($user_id){

	global $mycms,$mycommoncms,$cfg;
	
	$data 			=	array();
	
	$data['result']	=	"success";

	$time 			=	date('H:i');
	$today			=	date('Y-m-d');
	
	if($user_id!= '')
	{
		/////
		
		$sqlCheckClockIn	= array();
		
		$sqlCheckClockIn['QUERY']	=	"SELECT * 
											FROM "._DB_ACC_EMPLOYEE_ATTENDENCE." 
											WHERE `status` 		= ?
											AND   `empId`	    = ?
											AND   `date` 	    = ?";
							
		$sqlCheckClockIn['PARAM'][]		=	array('FILD' => 'status',		'DATA' =>'A',			'TYP' => 's');
		$sqlCheckClockIn['PARAM'][]		=	array('FILD' => 'empId',	    'DATA' => $user_id,		'TYP' => 's');	
		$sqlCheckClockIn['PARAM'][]		=	array('FILD' => 'date',	        'DATA' => $today,		'TYP' => 's');		
		$resClockIn						=	$mycms->sql_select($sqlCheckClockIn);
		
		if($resClockIn[0][attenStatus] == 'Out')
		{
			 $data['result']		=	"fail";
			 $data['status'] 	    =	'Already clockOut';	
		}
		else
		{
			$sql 			=	array();
			$sql['QUERY']	=	"UPDATE "._DB_ACC_EMPLOYEE_ATTENDENCE."
									SET 
										`outTime`			=	?,
										`attenStatus`		=	?
									WHERE `empId`	 		=	?
									AND   `date`			=	?";

			
			$sql['PARAM'][]	=	array('FILD' => 'outTime',			'DATA' => 	$time,						'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'attenStatus',		'DATA' => 	'Out',						'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'empId',			'DATA' => 	$user_id,					'TYP'=>'s');
			$sql['PARAM'][]	=	array('FILD' => 'date',				'DATA' => 	date('Y-m-d'),				'TYP'=>'s');

			$res 			=	$mycms->sql_update($sql);

			
			if($res){
				$data['status'] 	=	'clockOut Success';	
			}
			else {
				$data['status'] 	=	'clockOut fail';	
			}
			
		}
		
		
	}
	else
	{
		$data['result']		=	"error";
		$data['status'] 	=	'UserId Mismatch';
	}
	
	return $data;
	
}



////////////////////////////////////////////Hr Attendance startLunch/////////////////////////////////////////////////

function hrStartLunchDetails($user_id){

	global $mycms,$mycommoncms,$cfg;
	
	$data 			=	array();
	
	$data['result']	=	"success";

	$time 			=	date('H:i');
	
	if($user_id!= '')
	{
		$sql 			=	array();
		$sql['QUERY']	=	"UPDATE "._DB_ACC_EMPLOYEE_ATTENDENCE."
								SET 
									`startLunch`		=	?,
									`attenStatus`		=	?
								WHERE `empId`	 		=	?
								AND   `date`			=	?";

		
		$sql['PARAM'][]	=	array('FILD' => 'outTime',			'DATA' => 	$time,						'TYP'=>'s');
		$sql['PARAM'][]	=	array('FILD' => 'attenStatus',		'DATA' => 	'Slunch',					'TYP'=>'s');
		$sql['PARAM'][]	=	array('FILD' => 'empId',			'DATA' => 	$user_id,	                'TYP'=>'s');
		$sql['PARAM'][]	=	array('FILD' => 'date',				'DATA' => 	date('Y-m-d'),				'TYP'=>'s');

		$res 			=	$mycms->sql_update($sql);

		
		if($res){
			$data['status'] 	=	'startLunch Success';	
		}
		else {
			$data['status'] 	=	'startLunch fail';	
		}
	}
	else
	{
		$data['result']		=	"error";
		$data['status'] 	=	'UserId Mismatch';
	}
	
	return $data;
	
}



////////////////////////////////////////////Hr Attendance endLunch///////////////////////////////////////////////////

function hrEndLunchDetails($user_id){

	global $mycms,$mycommoncms,$cfg;
	
	$data 			=	array();
	
	$data['result']	=	"success";

	$time 			=	date('H:i');
	
	if($user_id!= '' )
	{
		$sql 			=	array();
		$sql['QUERY']	=	"UPDATE "._DB_ACC_EMPLOYEE_ATTENDENCE."
								SET 
									`endLunch`		=	?,
									`attenStatus`		=	?
								WHERE `empId`	 		=	?
								AND   `date`			=	?";

		
		$sql['PARAM'][]	=	array('FILD' => 'outTime',			'DATA' => 	$time,						'TYP'=>'s');
		$sql['PARAM'][]	=	array('FILD' => 'attenStatus',		'DATA' => 	'Elunch',					'TYP'=>'s');
		$sql['PARAM'][]	=	array('FILD' => 'empId',			'DATA' => 	$user_id,					'TYP'=>'s');
		$sql['PARAM'][]	=	array('FILD' => 'date',				'DATA' => 	date('Y-m-d'),				'TYP'=>'s');

		$res 			=	$mycms->sql_update($sql);

		
		if($res){
			$data['status'] 	=	'endLunch Success';	
		}
		else {
			$data['status'] 	=	'endLunch fail';	
		}
	}
	else
	{
		
	}
	
	return $data;
}

///////////////////////////////////////////Fecth Current Attendance Status Hr//////////////////////////////////////

function getCurrentAttendanceStatusDetails($user_id)
{
	global $mycms,$mycommoncms,$cfg;
	
	$data 			=	array();
	
	$data['result']	=	"success";
	
	$today			=	date('Y-m-d');

	
	$todayDate		=	date("l jS  F Y");
	
	$data['today'] 	=	$todayDate;
	
	if($user_id!= '')
	{
		$sqlCheckAttenStatus		=  array();
		
		$sqlCheckAttenStatus['QUERY']		=	"SELECT * 
													FROM "._DB_ACC_EMPLOYEE_ATTENDENCE." 
													WHERE `status` 		= ?
													AND   `empId`	    = ?
													AND   `date` 	    = ?";
							
		$sqlCheckAttenStatus['PARAM'][]		=	array('FILD' => 'status',		'DATA' =>'A',			'TYP' => 's');
		$sqlCheckAttenStatus['PARAM'][]		=	array('FILD' => 'empId',	    'DATA' => $user_id,		'TYP' => 's');	
		$sqlCheckAttenStatus['PARAM'][]		=	array('FILD' => 'date',	        'DATA' => $today,		'TYP' => 's');		
		$resCheckAttenStatus				=	$mycms->sql_select($sqlCheckAttenStatus);
		
		if($resCheckAttenStatus[0][attenStatus] == 'In')
		{
			$data['status'] 	=	'clockedIn';	
		}
		elseIf($resCheckAttenStatus[0][attenStatus] == 'Out')
		{
			$data['status'] 	=	'clockedOut';
		}
		elseIf($resCheckAttenStatus[0][attenStatus] == 'Slunch')
		{
			$data['status'] 	=	'LunchStarted';
		}
		elseif($resCheckAttenStatus[0][attenStatus] == 'Elunch')
		{
			$data['status'] 	=	'LunchEnded';
		}
		else
		{
			$data['status'] 	=	'freashStarted';
		}
		
	}
	else
	{
		$data['result']		=	"error";
		$data['status'] 	=	'UserId Mismatch';
	}
	
	 return $data;
}
 


	*/

?>