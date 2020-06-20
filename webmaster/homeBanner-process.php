<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':

	$altTag = addslashes($_REQUEST['altTag']);
	$bannerTitle = addslashes($_REQUEST['bannerTitle']);
	$bannerButton = addslashes($_REQUEST['bannerButton']);
	$photo  = $_FILES['image']['name'];
	$a31    = $_FILES['image']['tmp_name'];
	$last_id = 'homeBanner';
	if($photo!=''){
		$file_ext1 = explode(".",$photo);
		$ext1      = strtolower($file_ext1[count($file_ext1)-1]);
		$value1    = $last_id."_".date('YmdHis').".".$ext1;
		$path1     = "../uploads/banner_img/".$value1;
		
		//echo $value;
		chmod($path1,0777);
		copy($a31,$path1);
		chmod($path1,0777);

		$sql = "INSERT INTO " .$cfg['DB_HOME_BANNER']. "(`bannerTitle`,`altTag`,`bannerImg`,`bannerButton`) VALUES ('".$bannerTitle."','".$altTag."','".$value1."','".$bannerButton."')";
			$heart->sql_query($sql);
		
	}else{
		$sql = "INSERT INTO " .$cfg['DB_HOME_BANNER']. "(`altTag`,`bannerTitle`,`bannerButton`) VALUES ('".$altTag."','".$bannerTitle."','".$bannerButton."')";
		$heart->sql_query($sql);
	}
	$heart->redirect('homeBanner.php?m=1&pageno='.$_REQUEST['pageno']);
break;

case'add':

	$heart->redirect('homeBanner.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;



case'edit':

	$heart->redirect('homeBanner.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case'del':

 $sql="DELETE FROM" .$cfg['DB_HOME_COUNTER']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);	
	 $heart->redirect('homeBanner.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'muldel':

	 $sql="DELETE FROM" .$cfg['DB_HOME_COUNTER']."	WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('homeCounter.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_HOME_BANNER']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('homeBanner.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_HOME_BANNER']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('homeBanner.php?m=2&pageno='.$_REQUEST['pageno']);

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

	$altTag   = addslashes($_REQUEST['altTag']);
	$bannerTitle   = addslashes($_REQUEST['bannerTitle']);
	$bannerButton   = addslashes($_REQUEST['bannerButton']);
	$photo  = $_FILES['image']['name'];
	$a31    = $_FILES['image']['tmp_name'];
	$last_id = 'homeBanner';
	if($photo!=''){
		$file_ext1 = explode(".",$photo);
		$ext1      = strtolower($file_ext1[count($file_ext1)-1]);
		$value1    = $last_id."_".date('YmdHis').".".$ext1;
		$path1     = "../uploads/banner_img/".$value1;
		
		//echo $value;
		chmod($path1,0777);
		copy($a31,$path1);
		chmod($path1,0777);
	
	   	 //session_unregister('title');
	   	
	 	$sql="UPDATE ".$cfg['DB_HOME_BANNER']." SET `bannerTitle`='".$bannerTitle."' ,`altTag` = '".$altTag."',`bannerImg` = '".$value1."',`bannerButton`='".$bannerButton."' WHERE `id`='".$_REQUEST['id']."'  ";
		 $heart->sql_query($sql);
	}else{
		$sql="UPDATE ".$cfg['DB_HOME_BANNER']." SET `bannerTitle`='".$bannerTitle."',`altTag` = '".$altTag."',`bannerButton`='".$bannerButton."' WHERE `id`='".$_REQUEST['id']."'  ";
		$heart->sql_query($sql);
	}	
	$heart->redirect('homeBanner.php?pageno='.$_REQUEST['pageno'].'&m=2');
	
break;

}


?>
	