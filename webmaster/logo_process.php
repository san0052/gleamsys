<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');

$act=@$_REQUEST['act']; 
switch($act)
{
	
case'edit':
	$heart->redirect('managelogo.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
break;	
case 'update':
	if($_FILES["w_image"]["name"]!='')
	{
		
			$fol='../'.$cfg['DIR_LOGO'];
			$sql1="SELECT * FROM ".$cfg['DB_LOGO']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and  `l_id` =".$_REQUEST['w_id']."";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);
			
			//to replace the existing file...
			
			if($row1['l_image']!="")
			{
				

				 $ty=$_FILES["w_image"]["type"];	
				if($ty == "image/png" )
				{					 
					 
					 unlink($fol.$row1['l_image']);
					 $p_filename=$_FILES['w_image']['name'];
					 $newfile_path = $fol.$p_filename;
					chmod($newfile_path,0777);				
						
					$sql="UPDATE ".$cfg['DB_LOGO']." SET `l_image` = '".$p_filename."'WHERE `siteId`='".$cfg['SESSION_SITE']."' and `l_id`='".$_REQUEST['w_id']."'";
					$heart->sql_query($sql);
					 move_uploaded_file($_FILES['w_image']['tmp_name'], $newfile_path);				 
					 $heart->redirect('managelogo.php?pageno='.$_REQUEST['pageno'].'&m=2');
		
				}
				else if($ty != "image/png" )
				{				
					$heart->redirect('managelogo.php?show=edit&m=10');	
				}	
			}


		$fol='../'.$cfg['DIR_LOGO'];
		$f=$_FILES['w_image']['name'];
		$t=$f; // THIS VALUE WILL BE INSERTED INTO THE DATABASE
		$con=$fol.$t;
		$temp=$_FILES["w_image"]["tmp_name"];
		$ty=$_FILES["w_image"]["type"];	
	
	if($f!='')
	{	
		if($ty == "image/png" )
		{
 			$sql="UPDATE ".$cfg['DB_LOGO']." SET `l_image` = '".$t."' WHERE `siteId`='".$cfg['SESSION_SITE']."' and `l_id`='".$_REQUEST['w_id']."'";
			$heart->sql_query($sql);	
			move_uploaded_file($temp,$con);
			$heart->redirect('managelogo.php?pageno='.$_REQUEST['pageno'].'&m=2');
		}
		else if($ty != "image/png" )
		{
			echo " File cannot be uploaded.File type must be PNG";
			$heart->redirect('managelogo.php?show=edit&id='.$_REQUEST['w_id'].'&m=10&pageno='.$_REQUEST['pageno']);
		}
	}
	

	}

break;
case 'Active':
	 $sql="UPDATE ".$cfg['DB_LOGO']."SET `status` = 'A' WHERE `l_id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('managelogo.php?m=2&pageno='.$_REQUEST['pageno']);
break;
case 'Inactive':
 	 $sql="UPDATE ".$cfg['DB_LOGO']."SET `status` = 'I' WHERE `l_id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('managelogo.php?m=2&pageno='.$_REQUEST['pageno']);
break;
}
?>
