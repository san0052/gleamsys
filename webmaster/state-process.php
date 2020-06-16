<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){


//show all record
case'view':
	$heart->redirect('state.php?show=view&id='.$_REQUEST['id']);
exit();
break;

case'state_src':
$state=$_REQUEST['state_name'];
$country=$_REQUEST['country_name'];
if($state=='' && $country=='')
{
    $heart->redirect('state.php?view=all');
}
else
{
	$heart->redirect('state.php?state='.$state.'&country='.$country);
}
break;

case'checkState':
			$st=addslashes(trim($_REQUEST['str']));
			$sql1="SELECT * FROM ".$cfg['DB_STATE']." WHERE  `state_name` ='".$st."' AND `country_id`='".$_REQUEST['city']."'";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_numrows($res1);
			if($row1>0){
			echo 1;
			}
			else{
			echo 0;
			}
break;

//delete record
case'del_category':
 	 $sql="UPDATE ".$cfg['DB_STATE']." SET `status`='D' WHERE `st_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 if($_REQUEST['view']!='')
	 {
	     $heart->redirect('state.php?pageno='.$_REQUEST['pageno'].'&m=3&cid='.$_REQUEST['cid'].'&view='.$_REQUEST['view']);
	 }
     else
	 {
	     $heart->redirect('state.php?pageno='.$_REQUEST['pageno'].'&m=3&cid='.$_REQUEST['cid'].'&state='.$_REQUEST['qstate'].'&country='.$_REQUEST['qcountry']);
	 }
break;
//inset record
case 'insert_category':
    $admin_type=addslashes($_REQUEST['category']);
	$sql="INSERT INTO ".$cfg['DB_STATE']."	 SET 	`state_name` = '".$admin_type."',`country_id`='".$_REQUEST['city']."', `status`='A'";
	$heart->sql_query($sql);
	$heart->redirect('state.php?m=1&cid='.$_REQUEST['cid'].'&view='.$_REQUEST['view']);

break;
//edit record
case 'edit_category':
    $admin_type=addslashes($_REQUEST['category_edit']);
	if($admin_type!=''){
	$sql="UPDATE ".$cfg['DB_STATE']." SET `state_name` = '".$admin_type."',`country_id`=".$_REQUEST['country_edit']." WHERE `st_id`=".$_REQUEST['typeids'];
	$heart->sql_query($sql);
	}
	else
	{
	    $sql="UPDATE ".$cfg['DB_STATE']."	 SET  `country_id`='".$_REQUEST['country_edit']."' WHERE `st_id`=".$_REQUEST['typeids'];
	    $heart->sql_query($sql);
	}
	if($_REQUEST['view']!='')
	{
	    $heart->redirect('state.php?pageno='.$_REQUEST['pageno'].'&m=2&cid='.$_REQUEST['cid'].'&view='.$_REQUEST['view']);
    }
	else
	{
	    $heart->redirect('state.php?pageno='.$_REQUEST['pageno'].'&m=2&cid='.$_REQUEST['cid'].'&state='.$_REQUEST['qstate'].'&country='.$_REQUEST['qcountry']);
	}
break;

case'InactiveCat':
  $sql="UPDATE ".$cfg['DB_STATE']."
	 SET 
	`status` = 'I' WHERE `st_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 if($_REQUEST['state']=='' && $_REQUEST['country']=='')
	 {
	     $heart->redirect('state.php?pageno='.$_REQUEST['pageno'].'&m=2&cid='.$_REQUEST['cid'].'&view='.$_REQUEST['view']);
	 }
     else
	 {
	     $heart->redirect('state.php?pageno='.$_REQUEST['pageno'].'&m=2&cid='.$_REQUEST['cid'].'&state='.$_REQUEST['state'].'&country='.$_REQUEST['country']);
	 }
break;

case'ActiveCat':
$sql="UPDATE ".$cfg['DB_STATE']."
	 SET 
	`status` = 'A' WHERE `st_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 if($_REQUEST['state']=='' && $_REQUEST['country']=='')
	 {
	     $heart->redirect('state.php?pageno='.$_REQUEST['pageno'].'&m=2&cid='.$_REQUEST['cid'].'&view='.$_REQUEST['view']);
	 }
     else
	 {
	     $heart->redirect('state.php?pageno='.$_REQUEST['pageno'].'&m=2&cid='.$_REQUEST['cid'].'&state='.$_REQUEST['state'].'&country='.$_REQUEST['country']);
	 }
break;

}
?>
