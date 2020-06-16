<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':
	
	$keyword=addslashes($_REQUEST['cat_name']);	$category=$_REQUEST['catkey'];	//print_r($category);
  	$sql="INSERT INTO " .$cfg['DB_KEYWORD']. "(`key_name`,`siteId`,`status`) VALUES ('".$keyword."','".$cfg['SESSION_SITE']."','A' )";
   	$heart->sql_query($sql);		$keyid=mysql_insert_id();	foreach($category as $keys =>$catid){	$sqlmp="INSERT INTO ".$cfg['DB_KEYWORD_CATEGORY_MAP']." 				   SET				   `keywordid`='".$keyid."',				   `categoryid`='".$catid."',				   `status`='A'";	$heart->sql_query($sqlmp);			   	}
	$heart->redirect('keyword.php?m=1&pageno='.$_REQUEST['pageno']);
break;

case 'add':

	$heart->redirect('keyword.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;



case 'edit':

	$heart->redirect('keyword.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case 'del':

 $sql="UPDATE " .$cfg['DB_KEYWORD']. " SET `status`='D' WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);		  $sqlmp= "UPDATE ".$cfg['DB_KEYWORD_CATEGORY_MAP']."SET `status` = 'D' WHERE `keywordid` =".$_REQUEST['id']."";	 $heart->sql_query($sqlmp);	
	 $heart->redirect('keyword.php?m=3&pageno='.$_REQUEST['pageno']);
break;
case 'muldel':

	 $sql="DELETE FROM" .$cfg['DB_KEYWORD']."	WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 	 	 $sqlmp= "UPDATE ".$cfg['DB_KEYWORD_CATEGORY_MAP']."SET `status` = 'D' WHERE `keywordid` IN (".$_REQUEST['id'].")";	 $heart->sql_query($sqlmp);	
	 $heart->redirect('keyword.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_KEYWORD']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);	 	 $sqlmp= "UPDATE ".$cfg['DB_KEYWORD_CATEGORY_MAP']."SET `status` = 'A' WHERE `keywordid` = ".$_REQUEST['id']."";	 $heart->sql_query($sqlmp);	
	 $heart->redirect('keyword.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_KEYWORD']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);	 	 $sqlmp= "UPDATE ".$cfg['DB_KEYWORD_CATEGORY_MAP']."SET `status` = 'I' WHERE `keywordid` =".$_REQUEST['id']."";	 $heart->sql_query($sqlmp);	
	 $heart->redirect('keyword.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'mulactive':

 $sql="UPDATE ".$cfg['DB_KEYWORD']."SET `status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	  $sqlmp= "UPDATE ".$cfg['DB_KEYWORD_CATEGORY_MAP']."SET `status` = 'A' WHERE `keywordid` IN (".$_REQUEST['id'].")";	 $heart->sql_query($sqlmp);	 	 	
	 $heart->redirect('keyword.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':

 $sql="UPDATE ".$cfg['DB_KEYWORD']."SET `status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 	$sqlmp= "UPDATE ".$cfg['DB_KEYWORD_CATEGORY_MAP']."SET `status` = 'I' WHERE `keywordid` IN (".$_REQUEST['id'].")";	 $heart->sql_query($sqlmp);	 
	 $heart->redirect('keyword.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case 'update':


	$keyword=addslashes($_REQUEST['cat_name']);	$category=$_REQUEST['catkey'];	$keyid=$_REQUEST['typeids'];
    $sql="UPDATE ".$cfg['DB_KEYWORD']." SET `key_name` = '".$keyword."' WHERE `id`='".$_REQUEST['typeids']."' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
	$heart->sql_query($sql);		$sqlDel="DELETE FROM ".$cfg['DB_KEYWORD_CATEGORY_MAP']." WHERE keywordid='".$keyid."'";	$heart->sql_query($sqlDel);		foreach($category as $keys =>$catid){	$sqlmp="INSERT INTO ".$cfg['DB_KEYWORD_CATEGORY_MAP']." 				   SET				   `keywordid`='".$keyid."',				   `categoryid`='".$catid."',				   `status`='A'";	$heart->sql_query($sqlmp);			   	}	
	$heart->redirect('keyword.php?pageno='.$_REQUEST['pageno'].'&m=2');

	
break;

}


?>
	