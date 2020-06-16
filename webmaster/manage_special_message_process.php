<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':
	$message=addslashes($_REQUEST['des_name']);
    $dt = date("Y-m-d");
    $status = 'A';
	
		//session_unregister('title')
        $sql="INSERT INTO " .$cfg['DB_SPECIAL_MESSAGE']. "(`title`,`message`,`status`,`created_date`) VALUES ('".addslashes($_REQUEST['title'])."','".$message."','".$status."','".$dt."')";
          
   		$heart->sql_query($sql);
		$heart->redirect('manage-specialmessage.php?m=1&pageno='.$_REQUEST['pageno']);
	
break;

case'add':

	$heart->redirect('manage-specialmessage.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;



// case'edit':

// 	$heart->redirect('notes.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

// break;

case'del':

 $sql="DELETE FROM" .$cfg['DB_SPECIAL_MESSAGE']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);	
	 $heart->redirect('manage-specialmessage.php?m=3&pageno='.$_REQUEST['pageno']);
break;








case 'muldel':

	 $sql="DELETE FROM" .$cfg['DB_SPECIAL_MESSAGE']."	WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('manage-specialmessage.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_SPECIAL_MESSAGE']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('manage-specialmessage.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_SPECIAL_MESSAGE']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('manage-specialmessage.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'mulactive':

 $sql="UPDATE ".$cfg['DB_SPECIAL_MESSAGE']."SET `status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	
	 $heart->redirect('manage-specialmessage.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':

 $sql="UPDATE ".$cfg['DB_SPECIAL_MESSAGE']."SET `status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('manage-specialmessage.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case 'update':

    $title = addslashes($_REQUEST['title']);
	$message=addslashes($_REQUEST['des_name']);
    $dt = date("Y-m-d"); 
    
	 	 $sql="UPDATE ".$cfg['DB_SPECIAL_MESSAGE']." SET `title` = '".addslashes($_REQUEST['title'])."',`message` = '".$message."' ,`created_date` = '".$dt."' WHERE `id`='".$_REQUEST['id']."' ";
		 $heart->sql_query($sql);	
		 $heart->redirect('manage-specialmessage.php?pageno='.$_REQUEST['pageno'].'&m=2');
	
break;

}


?>
	