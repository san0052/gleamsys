   
<?php 
include_once('../includes/links.php');
include_once('../includes/admininit.php');
//print_r($_REQUEST);
$act=@$_REQUEST['act']; 
switch($act){
case'general':

$sql="SELECT * FROM ".$cfg['DB_NEWSLETTER']." WHERE `categoryId`=0 AND `status`='A'";
$res=$heart->sql_query($sql);


 $row=$heart->sql_fetchrow($res);

 $content=$row['content'];
  $sub=$row['subject'];
	
	  $sql_email="SELECT * FROM ".$cfg['DB_NEWSEMAIL']." WHERE  `status`='A'";
	$res_email=$heart->sql_query($sql_email);
	$maxrow_email=$heart->sql_numrows($res_email);
	
	if($maxrow_email >0){	
		while($row_email=$heart->sql_fetchrow($res_email)){
		@$i++;
		$to=$row_email['email'];
		
		$msg='you have succesfully send your ';
		
		mail($to,$sub,$content);
		}
	}
	
	
	$heart->redirect('general-button-mail.php?m=9');
	
	break;
	
	case'special':
		$cid=$_REQUEST['category'];
		$sql="SELECT * FROM ".$cfg['DB_USERINFO']." ";
		$res=$heart->sql_query($sql);
		$heart->sql_numrows($res);
		while($row=$heart->sql_fetchrow($res)){
			@$i++;
			$liking=array_map("utrim",explode(",",$row['liking']));
			if(in_array($cid,$liking)){
				$email[$i]=$row['liking'];
				$sql_email="SELECT * FROM ".$cfg['DB_USER']." WHERE `userId`='".$row['userId']."' ";
				$res_email=$heart->sql_query($sql_email);
				$row_email=$heart->sql_fetchrow($res_email);
			}
		}
		$sql_con="SELECT * FROM ".$cfg['DB_NEWSLETTER']." WHERE `categoryId`='".$cid."'  AND status='A'";
		$res_con=$heart->sql_query($sql_con);
		$row_con=$heart->sql_fetchrow($res_con);
		$content=$row_con['content'];
		$sub=$row_con['subject'];
		$msg='';	
		foreach($email as $em){
		mail($row_email['userName'],$sub,$content);
		}
		$heart->redirect('special-button-mail.php?m=8');
		break;
}
function utrim($a){ return trim ($a); }
?>