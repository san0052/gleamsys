<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){


//show all record
case'view':
	$heart->redirect('country.php?show=view&id='.$_REQUEST['id']);
exit();
break;
// show edit window
case'edit':
	$heart->redirect('country.php?show=category&id='.$_REQUEST['id']);
exit();
break;
case'country_src':
    $country=$_REQUEST['country_name'];
	if($country!='')
	{
		$heart->redirect('country.php?cntry_id='.$country);
	}
	else
	{
	    $heart->redirect('country.php?view=all');
	}
break;
case'checkcountry':
			
			$sql1="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE  `country_name` ='".$_REQUEST['str']."'";
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
 	 $sql="UPDATE ".$cfg['DB_COUNTRY_MASTER']." SET `status`='D' WHERE `country_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('country.php?m=3&pageno='.$_REQUEST['pageno'].'&view='.$_REQUEST['view']);
break;

//insert record
case 'insert_category':
	$admin_type=addslashes($_REQUEST['category']);
	$abb=addslashes($_REQUEST['abb']);
	$sql="INSERT INTO ".$cfg['DB_COUNTRY_MASTER']."	 SET 	`country_name` = '".$admin_type."', `country_abbreviation` = '".$abb."', `status`='A'";
	$heart->sql_query($sql);
	$heart->redirect('country.php?m=1&pageno='.$_REQUEST['pageno'].'&view='.$_REQUEST['view']);
break;

//edit record
case 'edit_category':
    $admin_type=addslashes($_REQUEST['category_edit']);
	if($admin_type!='')
	{
	    $sql="UPDATE ".$cfg['DB_COUNTRY_MASTER']." SET `country_name` = '".$admin_type."' WHERE `country_id`=".$_REQUEST['countryid'];
	    $heart->sql_query($sql);
	}
	else
	{
	    $sql="UPDATE ".$cfg['DB_COUNTRY_MASTER']." SET `state_id`='".$_REQUEST['country_edit']."' WHERE `country_id`=".$_REQUEST['typeids'];
	    $heart->sql_query($sql);
	}
	if($_REQUEST['view']!='')
	{
	    $heart->redirect('country.php?m=2&pageno='.$_REQUEST['pageno'].'&view='.$_REQUEST['view']);
    }
	else
	{
	    $heart->redirect('country.php?m=2&pageno='.$_REQUEST['pageno'].'&cntry_id='.$_REQUEST['cntry_id']);
	}
break;


case'InactiveCat':
    $sql="UPDATE ".$cfg['DB_COUNTRY_MASTER']." SET `status` = 'I' WHERE `country_id` IN (".$_REQUEST['id'].")";
	$heart->sql_query($sql);
	if($_REQUEST['cntry_id']=='')
	{
	  $heart->redirect('country.php?m=2&pageno='.$_REQUEST['pageno'].'&view='.$_REQUEST['view']);
	}
	else
	{
	  $heart->redirect('country.php?m=2&cntry_id='.$_REQUEST['cntry_id']);
	}
break;


case'ActiveCat':
    $sql="UPDATE ".$cfg['DB_COUNTRY_MASTER']." SET `status` = 'A' WHERE `country_id` IN (".$_REQUEST['id'].")";
	$heart->sql_query($sql);
	if($_REQUEST['cntry_id']=='')
	{
	  $heart->redirect('country.php?m=2&pageno='.$_REQUEST['pageno'].'&view='.$_REQUEST['view']);
	}
	else
	{
	  $heart->redirect('country.php?m=2&cntry_id='.$_REQUEST['cntry_id']);
	}
break;
}
?>