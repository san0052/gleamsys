<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':
    $sql="INSERT INTO " .$cfg['DB_CITY']. " (`name`,`status`,`parent_id`) VALUES ( '".$_REQUEST['zone']."','A','0')";
	$heart->sql_query($sql);
	
	$last_id = mysql_insert_id();
	$prod_loc=$_REQUEST['prod_loc'];
	//print_r($prod_loc);
	$locs=implode(',',$prod_loc);
	
	
	$sql="UPDATE " .$cfg['DB_CITY']. " SET `city_id`='".$locs."' WHERE `id`='".$last_id."'  ";
	$heart->sql_query($sql);
	
	
	
	$heart->redirect('zone.php?m=1&pageno='.$_REQUEST['pageno']);
break;

case'add':

	$heart->redirect('zone.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;

case'edit':

	$heart->redirect('zone.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case'del':

 $sql="DELETE FROM" .$cfg['DB_CITY']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $sql1="UPDATE " .$cfg['DB_PRODUCT']. " set `location`='0' WHERE `location`=".$_REQUEST['id']."";
	 $heart->sql_query($sql1);
	 $heart->redirect('zone.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'muldel':

 $sql="DELETE FROM" .$cfg['DB_CITY']."
	WHERE `id`IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sql="DELETE FROM" .$cfg['DB_PRODUCT']. "WHERE `location`IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('zone.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

 $sql="UPDATE ".$cfg['DB_CITY']."
	 SET 
	`status` = 'A' WHERE `id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $heart->redirect('zone.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

 $sql="UPDATE ".$cfg['DB_CITY']."
	 SET 
	`status` = 'I' WHERE `id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $heart->redirect('zone.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'mulactive':

 $sql="UPDATE ".$cfg['DB_CITY']."
	 SET 
	`status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	
	 $heart->redirect('zone.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':

 $sql="UPDATE ".$cfg['DB_CITY']."
	 SET 
	`status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 
	 $heart->redirect('zone.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'update1':
    
	 $name=$_REQUEST['category_edit'];
	 $sql="UPDATE ".$cfg['DB_CITY']."
	 SET 
	`name` = '".$name."'
	 WHERE `id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
     $heart->redirect('zone.php?m=2&pageno='.$_REQUEST['pageno']);
break;
case 'update':

	$prod_loc=$_REQUEST['prod_loc'];
	//print_r($prod_loc);
	$locs=implode(',',$prod_loc);

  $sql="UPDATE ".$cfg['DB_CITY']."	 SET 	`name` = '".$_REQUEST['zone']."' ,`city_id`='".$locs."' WHERE `id`=".$_REQUEST['typeids'];
	$heart->sql_query($sql);

	$heart->redirect('zone.php?pageno='.$_REQUEST['pageno'].'&m=2');

break;
}

?>
	
