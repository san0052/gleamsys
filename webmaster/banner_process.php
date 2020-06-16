<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
include_once('../lib_webmaster/resize-class.php');
$act=@$_REQUEST['act']; 
switch($act){

case 'update':
	
	$img = $_FILES["image_edit"]["name"];
	$link = $_REQUEST['image_link'];
	
	
	if($img!='')
	{
	
				$fol='../'.$cfg['BANNER_IMAGES'];
				$sql1="SELECT * FROM ".$cfg['DB_BANNER']." WHERE  `banner_id` ='".$_REQUEST['banner_id']."' AND `siteId`='".$cfg['SESSION_SITE']."' ";
				$res1=$heart->sql_query($sql1);
				$row1=$heart->sql_fetchrow($res1);
			
				$ty=$_FILES["image_edit"]["type"];	
				if($ty == "image/jpeg" || $ty =="image/jpg" || $ty =="image/png")
				{
					unlink($fol.$row1['banner_img']);
					$file = array();
					$file = explode(".",$img);
					$count = count($file);
					$ext = $file[$count - 1];
					
					$new_img=$row1['banner_id']._.banner.'.'.$ext;
					
					$newfile_path = $fol.$new_img;
					
					$sql="UPDATE ".$cfg['DB_BANNER']." SET `banner_img` = '".$new_img."' ,`banner_link` = '".$link."' WHERE `banner_id` =".$_REQUEST['banner_id']." AND `siteId`='".$cfg['SESSION_SITE']."' ";
					$res=$heart->sql_query($sql);
					$row=$heart->sql_fetchrow($res);
					
					move_uploaded_file($_FILES['image_edit']['tmp_name'], $newfile_path);
					chmod($newfile_path,0777);
					
					///*RESIZE IMAGE */
                       
    	             $resizeObjn = new resize($newfile_path);
                       // Resize image (options: exact, portrait, landscape, auto, crop)
                     $resizeObjn -> resizeImage($row1['banner_w'], $row1['banner_h'], 'crop');
                      // Save image
                     $resizeObjn -> saveImage($newfile_path, 100);
					 
					$heart->redirect('banner.php?m=2&pageno='.$_REQUEST['pageno']);
				}
				else if($ty != "image/jpeg" || $ty =="image/jpg" || $ty =="image/png")
				{	
					
					$heart->redirect('banner.php?show=edit&id='.$_REQUEST['banner_id'].'&m=10&pageno='.$_REQUEST['pageno']);	
				}	
	
	}
	else
	{
		$sql="UPDATE ".$cfg['DB_BANNER']." SET `banner_link` = '".$link."' WHERE `banner_id` =".$_REQUEST['banner_id']." AND `siteId`='".$cfg['SESSION_SITE']."'";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		$heart->redirect('banner.php?m=2&pageno='.$_REQUEST['pageno']);	
	}		

break;


case 'Active':

	 $sql="UPDATE ".$cfg['DB_BANNER']." SET `status` = 'A' WHERE `banner_id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $heart->redirect('banner.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case 'Inactive':

	 $sql="UPDATE ".$cfg['DB_BANNER']." SET `status` = 'I' WHERE `banner_id` =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	$heart->redirect('banner.php?m=2&pageno='.$_REQUEST['pageno']);

break;
}				           
?>