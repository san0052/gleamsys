<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){

// delete record
case'del':
	 $sql="DELETE FROM ".$cfg['DB_CATEGORY']." WHERE `cat_id` = '".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
     $heart->redirect('order.php?pId='.$_REQUEST['pId']);

break;
//show all record
case'view':
	$heart->redirect('order.php?show=view&id='.$_REQUEST['id']);
exit();
break;
// show edit window
case'edit':
	$heart->redirect('order.php?show=edit&id='.$_REQUEST['id']);
exit();
break;
// update record
case'update':
    
	$categoryName=$_REQUEST['categoryName'];
	$pId=$_REQUEST['pId'];
	$description=addslashes($_REQUEST['description_edit']);
	
	$sql="UPDATE ".$cfg['DB_CATEGORY']." SET 
	`cat_name` = '".$categoryName."',
	`cat_parent_id` = '".$pId."',
	`cat_description` = '".$description."'
	 WHERE `cat_id` = '".$_REQUEST['id']."' ";
	$heart->sql_query($sql);
	
	$heart->redirect('order.php?show=view&m=2&id='.$_REQUEST['id']);
break;

//show add window
case'add':
	$heart->redirect('order.php?show=add');	
break;

//show add window
case'modify':

	if (!isset($_REQUEST['oid']) || (int)$_REQUEST['oid'] <= 0
	    || !isset($_REQUEST['status']) || $_REQUEST['status'] == '') {
		header('Location: order.php?show=view&id='.$_REQUEST['oid']);
	}
	
	$orderId = (int)$_REQUEST['oid'];
	$status  = $_REQUEST['status'];
	
	modifyOrder($orderId,$status);
	$heart->redirect('order.php?show=view&id='.$orderId);	
break;


//change status

case'Active':
$sql="UPDATE ".$cfg['DB_CATEGORY']." SET 
	 `categoryStatus` ='A' 
	  WHERE `cat_id` = '".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
     $heart->redirect('order.php?pId='.$_REQUEST['pId']);

break;
case'Inactive':
$sql="UPDATE ".$cfg['DB_CATEGORY']." SET 
	 `categoryStatus` = 'I' 
	  WHERE `cat_id` = '".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('order.php?pId='.$_REQUEST['pId']);

break;
//insert record 
case 'insert':
    $categoryName=$_REQUEST['categoryName'];
	$pId=$_REQUEST['pId'];
	$description=addslashes($_REQUEST['description_add']);
	
	$sql="INSERT INTO ".$cfg['DB_CATEGORY']." ( `cat_parent_id`,`cat_description`,`cat_name`,`categoryStatus`) 
	VALUES ( '".$pId."','".$description."','".$categoryName."','A')";
	$heart->sql_query($sql);
	
	$heart->redirect('order.php?m=1');
break;

case 'searc':

 
	echo ">>>>";
    echo $dd=$_REQUEST['dd'];
	echo	$month=$_REQUEST['month'];
	echo	$o_id=$_REQUEST['o_id'];
	echo	$remarks=$_REQUEST['remarks'];
	//die();
	
	$heart->redirect('order.php?m=1234&dd='.$_REQUEST['dd'].'&month='.$_REQUEST['month'].'&o_id='.$_REQUEST['o_id'].'&remarks='.$_REQUEST['remarks']);
break;
//default view

}
?>