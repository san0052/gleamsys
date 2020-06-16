<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){
case 'insert':
	
	$subjectBy = addslashes($_REQUEST['subjectBy']);
	$subject   = addslashes($_REQUEST['subject']);
		
  		$sql="INSERT INTO " .$cfg['DB_TESTIMONIAL']. "(`subjectBy`,`subject`) VALUES ('".$subjectBy."','".$subject."')";
   		$heart->sql_query($sql);
		$heart->redirect('testimonials.php?m=1&pageno='.$_REQUEST['pageno']);
break;

case'add':
	$heart->redirect('testimonials.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	
break;



case'edit':

	$heart->redirect('testimonials.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

break;

case'del':

 $sql="DELETE FROM" .$cfg['DB_TESTIMONIAL']. "WHERE `id`=".$_REQUEST['id']."";
	 $heart->sql_query($sql);	
	 $heart->redirect('testimonials.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'muldel':

	 $sql="DELETE FROM" .$cfg['DB_HOME_COUNTER']."	WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);	 
	 $heart->redirect('homeCounter.php?m=3&pageno='.$_REQUEST['pageno']);
break;

case 'Active':

	 $sql="UPDATE ".$cfg['DB_TESTIMONIAL']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('testimonials.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

	$sql="UPDATE ".$cfg['DB_TESTIMONIAL']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('testimonials.php?m=2&pageno='.$_REQUEST['pageno']);

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


	$subjectBy = addslashes($_REQUEST['subjectBy']);
	$subject   = addslashes($_REQUEST['subject']);
	
	
	   	 //session_unregister('title');
	   	
	 	 $sql="UPDATE ".$cfg['DB_TESTIMONIAL']." SET `subjectBy` = '".$subjectBy."',`subject` = '".$subject."' WHERE `id`='".$_REQUEST['id']."' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
		 $heart->sql_query($sql);	
		 $heart->redirect('testimonials.php?pageno='.$_REQUEST['pageno'].'&m=2');
	
break;

}


?>
	