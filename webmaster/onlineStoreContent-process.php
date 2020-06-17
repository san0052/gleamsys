<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){

case'edit':

	$heart->redirect('onlineStoreContent.php?show=editContent&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case'del':

$sql="DELETE FROM" .$cfg['DB_SHOP_CONTENT']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);	
	 $heart->redirect('onlineStoreContent.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_SHOP_CONTENT']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('onlineStoreContent.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_SHOP_CONTENT']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('onlineStoreContent.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'update':

       $altTag        = addslashes($_REQUEST['altTag']);
       $description   = addslashes($_REQUEST['description']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'computerTarin';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1    = $last_id."_".date('YmdHis').".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	$sql1="UPDATE ".$cfg['DB_SHOP_CONTENT']." SET
	       `description` 			= '".$description."',
	       `altTag` 				= '".$altTag."',
	       `image` 		    		= '".$value1."'
	        WHERE `id` 				= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SHOP_CONTENT']." SET
	       		`description` 	= '".$description."',
	       		`altTag` 		= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
	$heart->redirect('onlineStoreContent.php?pageno='.$_REQUEST['pageno'].'&m=2');
	break;


}






?>
	