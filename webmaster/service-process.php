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

}






?>
	