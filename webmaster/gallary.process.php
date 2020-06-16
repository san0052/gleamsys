<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act)
{
	
	case'edit':
		$heart->redirect('gallary.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno'].'&album='.$_REQUEST['album']);
	break;
	case'add':
		$heart->redirect('gallary.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno'].'&album='.$_REQUEST['album']);
	break;
	case'delete':
	 $sql="UPDATE ".$cfg['DB_GALLERY']."SET `status` = 'D' WHERE `id` ='".$_REQUEST['id']."' ";
	 $heart->sql_query($sql);
	 $heart->redirect('gallary.php?m=3&pageno='.$_REQUEST['pageno']);
	break;
	
case 'update':
	
	//echo "11...";die();
	$albumid=$_REQUEST['album'];
	$sql1="SELECT * FROM ".$cfg['DB_GALLERY']." WHERE  `id` =".$_REQUEST['id']."";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);
	if($_FILES["image_name"]["name"]!='')
	{
			$fol='../'.$cfg['GALLERY_IMAGES'];
			//to replace the existing file...
			if($row1['image_name']!="")
			{
				//echo "111";die();

				 $ty=$_FILES["image_name"]["type"];	
				if($ty == "image/png" )
				{
					//echo "uuu";die();
					 unlink($fol.$row1['image_name']);
//					 $p_filename=watermark.'.'.png;
					 $p_filename=$_FILES['image_name']['name'];
					 $newfile_path = $fol.$p_filename;
					chmod($newfile_path,0777);
					$sql="UPDATE ".$cfg['DB_GALLERY']." SET 
									`image_name` = '".$p_filename."',
									`albumid`='".$albumid."' WHERE `id`='".$_REQUEST['id']."'";
					$heart->sql_query($sql);
					 move_uploaded_file($_FILES['image_name']['tmp_name'], $newfile_path);
					 
					 $heart->redirect('gallary.php?pageno='.$_REQUEST['pageno'].'&m=2');
		
				}
				else if($ty != "image/png" )
				{
					//echo " File cannot be uploaded.File type must be Image";
					$heart->redirect('gallary.php?show=edit&id='.$_REQUEST['p_id'].'&m=10&pageno='.$_REQUEST['pageno']);	
				}	
			}

//echo "2222";die();
		$fol='../'.$cfg['GALLERY_IMAGES'];
	//	$f=watermark.'.'.png;
		$f=$_FILES['image_name']['name'];
		$t=$f; // THIS VALUE WILL BE INSERTED INTO THE DATABASE
		$con=$fol.$t;
		$temp=$_FILES["image_name"]["tmp_name"];
		$ty=$_FILES["image_name"]["type"];	
	
	if($f!='')
	{	
		
 			$sql="UPDATE ".$cfg['DB_GALLERY']." SET 
 							`image_name` = '".$t."',
 							`albumid`='".$albumid."'  WHERE `id`='".$_REQUEST['id']."'";
			$heart->sql_query($sql);	
			move_uploaded_file($temp,$con);
			$heart->redirect('gallary.php?pageno='.$_REQUEST['pageno'].'&m=2');
		
	}
	

}else{
	$sql="UPDATE ".$cfg['DB_GALLERY']." SET 
					`name` = '".$_REQUEST['name']."',
					`albumid`='".$albumid."' WHERE `id`='".$_REQUEST['id']."'";
			$heart->sql_query($sql);
	$heart->redirect('gallary.php?pageno='.$_REQUEST['pageno'].'&m=2');			
}

break;
case'add_image':
$name=$_REQUEST['name'];
$image1=$_FILES['image_name']['name'];
$sql="INSERT INTO".$cfg['DB_GALLERY']." SET
			 `name`='".$name."',
			 `image_name`='".$image."',
			 `albumid`='".$_REQUEST['album']."'"	;
$heart->sql_query($sql);
$lastid=mysql_insert_id();
$image=explode('.',$image1);
$image_name=$image[0].$lastid.'.'.$image[1];
$temp=$_FILES["image_name"]["tmp_name"];
$destination='../'.$cfg['GALLERY_IMAGES'].$image_name;
move_uploaded_file($temp, $destination);

$sql_up="UPDATE".$cfg['DB_GALLERY']."SET 
				`image_name`='".$image_name."',
			 `albumid`='".$_REQUEST['album']."' WHERE id='".$lastid."'"	;
$heart->sql_query($sql_up);	

$heart->redirect('gallary.php?pageno='.$_REQUEST['pageno'].'&m=1'); 
break;
case 'Active':



	 $sql="UPDATE ".$cfg['DB_GALLERY']."SET `status` = 'A' WHERE `id` ='".$_REQUEST['id']."' ";
	 $heart->sql_query($sql);
	 $heart->redirect('gallary.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'Inactive':

 		$sql="UPDATE ".$cfg['DB_GALLERY']."SET `status` = 'I' WHERE `id` ='".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('gallary.php?m=2&pageno='.$_REQUEST['pageno']);

break;

}
?>
