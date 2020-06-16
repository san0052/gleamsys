<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':
	
	$pagedescription=addslashes($_REQUEST['des_name']);
	$dt = date("Y-m-d"); 
	if($_REQUEST['des_name']=="")
	{	
		
		$heart->redirect('homeCounter.php?show=add&m=9&pageno='.$_REQUEST['pageno']);	

		//session_register('title');
		$_SESSION['title']=addslashes($_REQUEST['title']);
	}
	else
	{
		//session_unregister('title');
		unset($_SESSION['title']);
  		$sql="INSERT INTO " .$cfg['DB_HOME_COUNTER']. "(`title`,`description`,`n_date`,`siteId`) VALUES ('".addslashes($_REQUEST['title'])."','".$pagedescription."','".$dt."','".$cfg['SESSION_SITE']."' )";
   		$heart->sql_query($sql);
		$heart->redirect('homeCounter.php?m=1&pageno='.$_REQUEST['pageno']);
	

	}
	
break;

case'add':

	$heart->redirect('homeCounter.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;



case'edit':

	$heart->redirect('homeCounter.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case'del':

 $sql="DELETE FROM" .$cfg['DB_HOME_COUNTER']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);	
	 $heart->redirect('homeCounter.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'muldel':

	 $sql="DELETE FROM" .$cfg['DB_HOME_COUNTER']."	WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('homeCounter.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_HOME_COUNTER']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('homeCounter.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_HOME_COUNTER']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('homeCounter.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'mulactive':

 $sql="UPDATE ".$cfg['DB_HOME_COUNTER']."SET `status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	
	 $heart->redirect('homeCounter.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':

 $sql="UPDATE ".$cfg['DB_HOME_COUNTER']."SET `status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('homeCounter.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case 'update':


	$title    = addslashes($_REQUEST['title']);
	$counter  = addslashes($_REQUEST['counter']);
	
	
	   	 //session_unregister('title');
	   	
	 	 $sql="UPDATE ".$cfg['DB_HOME_COUNTER']." SET `title` = '".$title."',`counter` = '".$counter."' WHERE `id`='".$_REQUEST['id']."' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
		 $heart->sql_query($sql);	
		 $heart->redirect('homeCounter.php?pageno='.$_REQUEST['pageno'].'&m=2');
	
break;

}


?>
	