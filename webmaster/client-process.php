<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':

	$altTag = addslashes($_REQUEST['altTag']);
	$projectName = addslashes($_REQUEST['projectName']);
	$projectCountry = addslashes($_REQUEST['projectCountry']);
	$photo  = $_FILES['image']['name'];
	$a31    = $_FILES['image']['tmp_name'];
	$last_id = 'clientLogo';
	if($photo!=''){
		$file_ext1 = explode(".",$photo);
		$ext1      = strtolower($file_ext1[count($file_ext1)-1]);
		$value1    = $last_id."_".date('YmdHis').".".$ext1;
		$path1     = "../uploads/client_logo/".$value1;
		
		//echo $value;
		chmod($path1,0777);
		copy($a31,$path1);
		chmod($path1,0777);

		$sql = "INSERT INTO " .$cfg['DB_CLIENT_INFO']. "(`projectName`,`altTag`,`projectLogo`,`projectCountry`) VALUES ('".$projectName."','".$altTag."','".$value1."','".$projectCountry."')";
			$heart->sql_query($sql);
		
	}else{
		$sql = "INSERT INTO " .$cfg['DB_CLIENT_INFO']. "(`altTag`,`projectName`,`projectCountry`) VALUES ('".$altTag."','".$projectName."','".$projectCountry."')";
		$heart->sql_query($sql);
	}
	$heart->redirect('client.php?m=1&pageno='.$_REQUEST['pageno']);
break;

case'add':

	$heart->redirect('client.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;



case'edit':

	$heart->redirect('client.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case'del':

 $sql="DELETE FROM" .$cfg['DB_CLIENT_INFO']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);	
	 $heart->redirect('client.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'muldel':

	 $sql="DELETE FROM" .$cfg['DB_CLIENT_INFO']."	WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('homeCounter.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_CLIENT_INFO']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('client.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_CLIENT_INFO']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('client.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'mulactive':

 $sql="UPDATE ".$cfg['DB_CLIENT_INFO']."SET `status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	
	 $heart->redirect('homeCounter.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':

 $sql="UPDATE ".$cfg['DB_CLIENT_INFO']."SET `status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('homeCounter.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case 'update':

	$altTag   = addslashes($_REQUEST['altTag']);
	$projectName   = addslashes($_REQUEST['projectName']);
	$projectCountry   = addslashes($_REQUEST['projectCountry']);
	$photo  = $_FILES['image']['name'];
	$a31    = $_FILES['image']['tmp_name'];
	$last_id = 'client';
	if($photo!=''){
		$file_ext1 = explode(".",$photo);
		$ext1      = strtolower($file_ext1[count($file_ext1)-1]);
		$value1    = $last_id."_".date('YmdHis').".".$ext1;
		$path1     = "../uploads/client_logo/".$value1;
		
		//echo $value;
		chmod($path1,0777);
		copy($a31,$path1);
		chmod($path1,0777);
	
	   	 //session_unregister('title');
	   	
	 	$sql="UPDATE ".$cfg['DB_CLIENT_INFO']." SET `projectName`='".$projectName."' ,`altTag` = '".$altTag."',`projectLogo` = '".$value1."',`projectCountry`='".$projectCountry."' WHERE `id`='".$_REQUEST['id']."'  ";
		 $heart->sql_query($sql);
	}else{
		$sql="UPDATE ".$cfg['DB_CLIENT_INFO']." SET `projectName`='".$projectName."',`altTag` = '".$altTag."',`projectCountry`='".$projectCountry."' WHERE `id`='".$_REQUEST['id']."'  ";
		$heart->sql_query($sql);
	}	
	$heart->redirect('client.php?pageno='.$_REQUEST['pageno'].'&m=2');
	
break;

}


?>
	