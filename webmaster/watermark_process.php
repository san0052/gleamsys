<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act)
{
	
	case'edit':
		$heart->redirect('watermark.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
	break;
	
case 'update':
	
	//echo "11...";die();
	if($_FILES["w_image"]["name"]!='')
	{
			$fol='../'.$cfg['DIR_IMAGE'];
			$sql1="SELECT * FROM ".$cfg['DB_WATERMARK']." WHERE  `w_id` =".$_REQUEST['w_id']." AND`siteId`= '".$cfg['SESSION_SITE']."'";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);
			
			//to replace the existing file...
			
			if($row1['w_image']!="")
			{
				//echo "111";die();

				 $ty=$_FILES["w_image"]["type"];	
				if($ty == "image/png" )
				{
					//echo "uuu";die();
					 unlink($fol.$row1['w_image']);
//					 $p_filename=watermark.'.'.png;
					 $p_filename=$_FILES['w_image']['name'];
					 $newfile_path = $fol.$p_filename;
					chmod($newfile_path,0777);
					$sql="UPDATE ".$cfg['DB_WATERMARK']." SET `w_image` = '".$p_filename."'WHERE `w_id`='".$_REQUEST['w_id']."' AND `siteId`= '".$cfg['SESSION_SITE']."'";
					$heart->sql_query($sql);
					 move_uploaded_file($_FILES['w_image']['tmp_name'], $newfile_path);
					 
					 $heart->redirect('watermark.php?pageno='.$_REQUEST['pageno'].'&m=2');
		
				}
				else if($ty != "image/png" )
				{
					//echo " File cannot be uploaded.File type must be Image";
					$heart->redirect('watermark.php?show=edit&id='.$_REQUEST['p_id'].'&m=10&pageno='.$_REQUEST['pageno']);	
				}	
			}

//echo "2222";die();
		$fol='../'.$cfg['DIR_IMAGE'];
	//	$f=watermark.'.'.png;
		$f=$_FILES['w_image']['name'];
		$t=$f; // THIS VALUE WILL BE INSERTED INTO THE DATABASE
		$con=$fol.$t;
		$temp=$_FILES["w_image"]["tmp_name"];
		$ty=$_FILES["w_image"]["type"];	
	
	if($f!='')
	{	
		if($ty == "image/png" )
		{
 			$sql="UPDATE ".$cfg['DB_WATERMARK']." SET `w_image` = '".$t."' WHERE `w_id`='".$_REQUEST['w_id']."'  AND `siteId`= '".$cfg['SESSION_SITE']."'";
			$heart->sql_query($sql);	
			move_uploaded_file($temp,$con);
			$heart->redirect('watermark.php?pageno='.$_REQUEST['pageno'].'&m=2');
		}
		else if($ty != "image/png" )
		{
			echo " File cannot be uploaded.File type must be image";
			$heart->redirect('watermark.php?show=edit&id='.$_REQUEST['w_id'].'&m=10&pageno='.$_REQUEST['pageno']);
		}
	}
	

}

break;

case 'Active':



	 $sql="UPDATE ".$cfg['DB_WATERMARK']."SET `status` = 'A' WHERE `w_id` ='".$_REQUEST['id']."' ";
	 $heart->sql_query($sql);
	 $heart->redirect('watermark.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

 		$sql="UPDATE ".$cfg['DB_WATERMARK']."SET `status` = 'I' WHERE `w_id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('watermark.php?m=2&pageno='.$_REQUEST['pageno']);

break;

}
?>
