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
		
		$heart->redirect('notes.php?show=add&m=9&pageno='.$_REQUEST['pageno']);	

		//session_register('title');
		$_SESSION['title']=addslashes($_REQUEST['title']);
	}
	else
	{
		//session_unregister('title');
		unset($_SESSION['title']);
  		$sql="INSERT INTO " .$cfg['DB_NOTES']. "(`title`,`description`,`n_date`,`siteId`) VALUES ('".addslashes($_REQUEST['title'])."','".$pagedescription."','".$dt."','".$cfg['SESSION_SITE']."' )";
   		$heart->sql_query($sql);
		$heart->redirect('notes.php?m=1&pageno='.$_REQUEST['pageno']);
	

	}
	
break;

case'add':

	$heart->redirect('notes.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;



case'edit':

	$heart->redirect('notes.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case'del':

 $sql="DELETE FROM" .$cfg['DB_DISCLAIMER']. "WHERE `n_id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);	
	 $heart->redirect('notes.php?m=3&pageno='.$_REQUEST['pageno']);
break;








case 'muldel':

	 $sql="DELETE FROM" .$cfg['DB_NOTES']."	WHERE `n_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('notes.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_NOTES']."SET `status` = 'A' WHERE `n_id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('notes.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_NOTES']."SET `status` = 'I' WHERE `n_id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('notes.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'mulactive':

 $sql="UPDATE ".$cfg['DB_NOTES']."SET `status` = 'A' WHERE `n_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	
	 $heart->redirect('notes.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':

 $sql="UPDATE ".$cfg['DB_NOTES']."SET `status` = 'I' WHERE `n_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('notes.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case 'update':


	$pagedescription=addslashes($_REQUEST['des_name']);
	$dt = date("Y-m-d"); 
	if($_REQUEST['des_name']=="")
	{	
	
		//session_register('title');
		$_SESSION['title']=addslashes($_REQUEST['title']);
		
		$heart->redirect('notes.php?show=edit&id='.$_REQUEST['n_id'].'&m=9&pageno='.$_REQUEST['pageno']);	
//		$fgccms->redirect('press_category.php?show=add&m=10&pageno='.$_REQUEST['pageno']);
	}
	else
	{	
	
	   	 //session_unregister('title');
	   	 unset($_SESSION['title']);
	 	 $sql="UPDATE ".$cfg['DB_NOTES']." SET `title` = '".addslashes($_REQUEST['title'])."',`description` = '".$pagedescription."' ,`n_date` = '".$dt."' WHERE `n_id`='".$_REQUEST['n_id']."' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
		 $heart->sql_query($sql);	
		 $heart->redirect('notes.php?pageno='.$_REQUEST['pageno'].'&m=2');
	
	}
	
break;

}


?>
	