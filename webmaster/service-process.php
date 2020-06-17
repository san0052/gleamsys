<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':
	
	$serviceTitle = addslashes($_REQUEST['serviceTitle']);
	$description   = addslashes($_REQUEST['description']);
	$subjectName   = addslashes($_REQUEST['subjectName']);
		
  		$sql="INSERT INTO " .$cfg['DB_SERVICE_INFO']. "(`serviceTitle`,`description`,`subjectName`) VALUES ('".$serviceTitle."','".$description."','".$subjectName."')";
   		$heart->sql_query($sql);
		$heart->redirect('tech-service.php?m=1&pageno='.$_REQUEST['pageno']);
break;

case 'insertIt-info':
	
	$serviceTitle = addslashes($_REQUEST['serviceTitle']);
	$description   = addslashes($_REQUEST['description']);
	$subjectName   = addslashes($_REQUEST['subjectName']);
		
  		$sql="INSERT INTO " .$cfg['DB_SERVICE_INFO']. "(`serviceTitle`,`description`,`subjectName`,`pageName`) VALUES ('".$serviceTitle."','".$description."','".$subjectName."','it-service')";
   		$heart->sql_query($sql);
		$heart->redirect('It-Services.php?m=1&pageno='.$_REQUEST['pageno']);
break;

case'add':
	$heart->redirect('tech-service.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;
case'addIt':
	$heart->redirect('It-Services.php?show=addIT-service&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;



case'edit':

	$heart->redirect('tech-service.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;
case'editItServe':

	$heart->redirect('It-Services.php?show=editItServe&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case 'editComputerService' :
	$heart->redirect('computer-training.php?show=editComputer&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
break;
case'del':

 $sql="DELETE FROM" .$cfg['DB_SERVICE_INFO']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);	
	 $heart->redirect('tech-service.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'muldel':

	 $sql="DELETE FROM" .$cfg['DB_HOME_COUNTER']."	WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('tech-service.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_SERVICE_INFO']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('tech-service.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_SERVICE_INFO']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('tech-service.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case 'ActiveTraining':

	 $sql="UPDATE ".$cfg['DB_COMPUTER_TRAIN']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('computer-training.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'InactiveTraining':

	$sql="UPDATE ".$cfg['DB_COMPUTER_TRAIN']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('computer-training.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'mulactive':

 $sql="UPDATE ".$cfg['DB_HOME_COUNTER']."SET `status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	
	 $heart->redirect('tech-service.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':

 $sql="UPDATE ".$cfg['DB_HOME_COUNTER']."SET `status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('tech-service.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case 'updateTechSupport':

	$serviceTitle  = addslashes($_REQUEST['serviceTitle']);
	$description   = addslashes($_REQUEST['description']);
	$subjectName   = addslashes($_REQUEST['subjectName']);
	
	   	 //session_unregister('title');
	   	
	 	 $sql="UPDATE ".$cfg['DB_SERVICE_INFO']." SET `serviceTitle` = '".$serviceTitle."',`description` = '".$description."',`subjectName`='".$subjectName."' WHERE `id`='".$_REQUEST['id']."' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
		 $heart->sql_query($sql);	
		 $heart->redirect('tech-service.php?pageno='.$_REQUEST['pageno'].'&m=2');
	
break;

case 'updateITService':

	$serviceTitle  = addslashes($_REQUEST['serviceTitle']);
	$description   = addslashes($_REQUEST['description']);
	$subjectName   = addslashes($_REQUEST['subjectName']);
	
	   	 //session_unregister('title');
	   	
	 	$sql="UPDATE ".$cfg['DB_SERVICE_INFO']." SET `serviceTitle` = '".$serviceTitle."',`description` = '".$description."',`subjectName`='".$subjectName."' WHERE `id`='".$_REQUEST['id']."' AND `siteId`= '".$cfg['SESSION_SITE']."' AND `pageName`='it-service' ";
	 	 
		$heart->sql_query($sql);	
		$heart->redirect('It-Services.php?pageno='.$_REQUEST['pageno'].'&m=2');
	
break;

case'updateComputerService':

       $serviceOption 			= addslashes($_REQUEST['serviceOption']);
       $altTag        			= addslashes($_REQUEST['altTag']);
       $serviceDescription      = addslashes($_REQUEST['serviceDescription']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'computerTarin';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	$sql1="UPDATE ".$cfg['DB_COMPUTER_TRAIN']." SET
	       `serviceOption` 			= '".$serviceOption."',
	       `serviceDescription` 	= '".$serviceDescription."',
	       `altTag` 				= '".$altTag."',
	       `computerImg` 		    = '".$value1."'
	        WHERE `id` 				= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_COMPUTER_TRAIN']." SET
		      	`serviceOption` 			= '".$serviceOption."',
	       		`serviceDescription` 	    = '".$serviceDescription."',
	       		`altTag` 					= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
	$heart->redirect('computer-training.php?pageno='.$_REQUEST['pageno'].'&m=2');
	break;


}






?>
	