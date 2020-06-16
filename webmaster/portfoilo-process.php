<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':

	$altTag 		= addslashes($_REQUEST['altTag']);
	$portfiloName 	= addslashes($_REQUEST['portfiloName']);
	$photo  		= $_FILES['image']['name'];
	$a31    		= $_FILES['image']['tmp_name'];
	$last_id = 'portfollio';
	if($photo!=''){
		$file_ext1 = explode(".",$photo);
		$ext1      = strtolower($file_ext1[count($file_ext1)-1]);
		$value1    = $last_id."_".date('YmdHis').".".$ext1;
		$path1     = "../uploads/portfolio_image/".$value1;
		
		//echo $value;
		chmod($path1,0777);
		copy($a31,$path1);
		chmod($path1,0777);

		$sql = "INSERT INTO " .$cfg['DB_PORTFOLIO_INFO']. "(`portfiloName`,`altTag`,`portofiloImg`) VALUES ('".$portfiloName."','".$altTag."','".$value1."')";
			$heart->sql_query($sql);
		
	}else{
		$sql = "INSERT INTO " .$cfg['DB_PORTFOLIO_INFO']. "(`altTag`,`portfiloName`) VALUES ('".$altTag."','".$portfiloName."')";
		$heart->sql_query($sql);
	}
	$heart->redirect('portfolio.php?m=1&pageno='.$_REQUEST['pageno']);
break;

case'add':

	$heart->redirect('portfolio.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;



case'edit':

	$heart->redirect('portfolio.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case'del':

 $sql="DELETE FROM" .$cfg['DB_PORTFOLIO_INFO']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);	
	 $heart->redirect('portfolio.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'muldel':

	 $sql="DELETE FROM" .$cfg['DB_PORTFOLIO_INFO']."	WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('homeCounter.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_PORTFOLIO_INFO']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('portfolio.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_PORTFOLIO_INFO']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('portfolio.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'mulactive':

 $sql="UPDATE ".$cfg['DB_PORTFOLIO_INFO']."SET `status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	
	 $heart->redirect('homeCounter.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':

 $sql="UPDATE ".$cfg['DB_PORTFOLIO_INFO']."SET `status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('homeCounter.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case 'update':

	$altTag   = addslashes($_REQUEST['altTag']);
	$portfiloName   = addslashes($_REQUEST['portfiloName']);

	$photo  = $_FILES['image']['name'];
	$a31    = $_FILES['image']['tmp_name'];
	$last_id = 'client';
	if($photo!=''){
		$file_ext1 = explode(".",$photo);
		$ext1      = strtolower($file_ext1[count($file_ext1)-1]);
		$value1    = $last_id."_".date('YmdHis').".".$ext1;
		$path1     = "../uploads/portfolio_image/".$value1;
		
		//echo $value;
		chmod($path1,0777);
		copy($a31,$path1);
		chmod($path1,0777);
	
	   	 //session_unregister('title');
	   	
	 	$sql="UPDATE ".$cfg['DB_PORTFOLIO_INFO']." SET `portfiloName`='".$portfiloName."' ,`altTag` = '".$altTag."',`portofiloImg` = '".$value1."' WHERE `id`='".$_REQUEST['id']."'  ";
		 $heart->sql_query($sql);
	}else{
		$sql="UPDATE ".$cfg['DB_PORTFOLIO_INFO']." SET `portfiloName`='".$portfiloName."',`altTag` = '".$altTag."' WHERE `id`='".$_REQUEST['id']."'  ";
		$heart->sql_query($sql);
	}	
	$heart->redirect('portfolio.php?pageno='.$_REQUEST['pageno'].'&m=2');
	
break;

}


?>
	