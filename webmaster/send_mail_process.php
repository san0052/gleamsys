<? 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
if($_REQUEST['m']==1)
{$msg='NEWS LETTER SEND';}
$action=@$_REQUEST['act'];
switch($action)
{

case'addexist':
	
			$newemail=$_REQUEST['email'];
			$sql1="SELECT * FROM ".$cfg['DB_NEWSLETTER_EMAIL']." WHERE  `email` ='".$newemail."'";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_numrows($res1);
			if($row1>0){
			echo 1;
			}
			else{
			echo 0;
			}
			break;
			
case'send_news_letter':
	
			//$user_name=$_REQUEST['username'];
			$email=$_REQUEST['checkvalue'];
			$useremail=implode(',',$_REQUEST['checkvalue']);
			$news_letter=$_REQUEST['eContent'];
			$newsLetter=addslashes($_REQUEST['eContent']);
			$sub=$_REQUEST['subject'];
			if($news_letter==""){
				//session_register('sub');			
				$_SESSION['sub']=$_REQUEST['subject'];
				
				$heart->redirect('newsletter.php?m=6');
			}
			elseif($useremail==""){
				$heart->redirect('newsletter.php?m=7');
			}else{
			//session_unregister('sub');
			//session_unset('sub');
			//print_r($useremail);
			foreach ($email as $value){
				
		$sql1="SELECT * FROM ".$cfg['DB_NEWSLETTER_EMAIL']." WHERE  `email` ='".$value."' and status='A'";
		$res1=$heart->sql_query($sql1);
		$row1=$heart->sql_fetchrow($res1);

					$to_name=$value;
					$to_email=$value;
					$form_name='Rainbow Florist';
					$form_email=$cfg['ADMIN_ORDER_EMAIL'];
					$msg = str_replace('/userfiles','http://www.lamealcarte.com.au/userfiles',$newsLetter);
				    $message = stripslashes(stripslashes($msg)).'<br>Regards<br>'.$cfg['ADMIN_NAME'].'<br>'."Rainbow Florist";
					$subject=$sub;
					
					$heart->send_mail($to_name, $to_email, $form_name, $form_email, $subject, $message); 
				 } 
			
			$sql="INSERT INTO ".$cfg['DB_NEWSMAIL']." (`siteId`,`mailContent`,`mailSub`,`usrEmail`,`sendDate`,`mStatus`)
			VALUES ('".$cfg['SESSION_SITE']."', '".$newsLetter."','".$sub."','".$useremail."',NOW(),'A')";
			
			$heart->sql_query($sql);
			$heart->redirect('newsletter.php?m=5');
			}
break;
//show all record
case'all':
	$heart->redirect('newsletter.php?show=all');
exit();
break;
case'viewall':
	$heart->redirect('newsletter.php?show=viewall');
exit();
break;
//Add new email
case'addnew':
	$heart->redirect('newsletter.php?show=addnew');
exit();
break;

case'add':
	$heart->redirect('newsletter.php?show=add');
exit();
break;
// Add new Email Address
case'addnewmail':
	
	   $email=$_REQUEST['email_add'];
	   $name=$_REQUEST['name_add'];
	   $sql_src="INSERT INTO ".$cfg['DB_NEWSLETTER_EMAIL']." (`email`,`name`,`date`,`status`)
					VALUES ('".$email."','".$name."',NOW(),'A')";
       $heart->sql_query($sql_src);
	   $heart->redirect('newsletter.php?m=1');

break;

//show each record
case'view':
	$heart->redirect('newsletter.php?show=view&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
exit();
break;

case 'delete':

 	 $sql="DELETE FROM" .$cfg['DB_NEWSLETTER_EMAIL']. "WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('view_newsletter.php?m=3&pageno='.$_REQUEST['pageno']);

break;

case 'deleteMail':

 	 $sql="DELETE FROM" .$cfg['DB_NEWSMAIL']. "WHERE `newsmailId` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('mailedNewsletter.php?m=3&pageno='.$_REQUEST['pageno']);

break;
	 
}
?>