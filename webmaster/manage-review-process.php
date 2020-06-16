<?php
	include_once('../includes_webmaster/links.php');
    include_once('../includes_webmaster/admininit.php');
	$act=@$_REQUEST['action']; 

	switch ($act) 
	{
		case 'update':
		$status = $_REQUEST['review'];
		$id 	= $_REQUEST['id'];

		$sql="UPDATE ".$cfg['DB_PRODUCT_REVIEWS']." SET 
						`flag` = '".$status."'
						WHERE `id` = '".$id."' ";
		$heart->sql_query($sql);
		$heart->redirect('manage-review.php?show=&m=2&id='.$_REQUEST['id'].'&status='.$_REQUEST['review']);
		
		break;

		case 'delreiew':
		$Delid 	= $_REQUEST['id'];

		$sql="DELETE FROM ".$cfg['DB_PRODUCT_REVIEWS']." WHERE `id` = '".$Delid."' ";

						
					
		$heart->sql_query($sql);
		$heart->redirect('manage-review.php?show=&m=1');
		
		break;
		
		
		
	}

?>