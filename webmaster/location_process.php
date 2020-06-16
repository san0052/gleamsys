<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':
   $sql="INSERT INTO " .$cfg['DB_LOCATION']. " (`name`,`status`) VALUES ( '".$_REQUEST['cat_name']."','A')";
	$heart->sql_query($sql);
	
	$heart->redirect('location.php?m=1&pageno='.$_REQUEST['pageno']);
break;

case'add':

	$heart->redirect('location.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;

case'edit':

	$heart->redirect('location.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case'del':

 $sql="DELETE FROM" .$cfg['DB_LOCATION']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $sql1="UPDATE " .$cfg['DB_PRODUCT']. " set `location`='0' WHERE `location`=".$_REQUEST['id']."";
	 $heart->sql_query($sql1);
	 $heart->redirect('location.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'muldel':

 $sql="DELETE FROM" .$cfg['DB_LOCATION']."
	WHERE `id`IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sql="DELETE FROM" .$cfg['DB_PRODUCT']. "WHERE `location`IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('location.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

 $sql="UPDATE ".$cfg['DB_LOCATION']."
	 SET 
	`status` = 'A' WHERE `id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $heart->redirect('location.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

 $sql="UPDATE ".$cfg['DB_LOCATION']."
	 SET 
	`status` = 'I' WHERE `id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $heart->redirect('location.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'mulactive':

 $sql="UPDATE ".$cfg['DB_LOCATION']."
	 SET 
	`status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	
	 $heart->redirect('location.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':

 $sql="UPDATE ".$cfg['DB_LOCATION']."
	 SET 
	`status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 
	 $heart->redirect('location.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'update':
    
	 $name=$_REQUEST['category_edit'];
	 $sql="UPDATE ".$cfg['DB_LOCATION']."
	 SET 
	`name` = '".$name."'
	 WHERE `id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
     $heart->redirect('location.php?m=2&pageno='.$_REQUEST['pageno']);
break;
case 'edit_category':

 $admin_type=addslashes($_REQUEST['category_edit']);
if($admin_type!=''){
 $sql="UPDATE ".$cfg['DB_LOCATION']."	 SET 	`name` = '".$admin_type."' WHERE `id`=".$_REQUEST['typeids'];
	$heart->sql_query($sql);
	}
	$heart->redirect('location.php?pageno='.$_REQUEST['pageno'].'&m=2');

break;
}

?>
	
