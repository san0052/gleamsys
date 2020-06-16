<?php
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include_once('../includes/reader.php');
require_once '../Excel/reader.php'; 

if(isset($_FILES['file']['tmp_name']) AND ($_FILES['file']['tmp_name']!=""))
{
   					if (is_uploaded_file($_FILES['file']['tmp_name']))
					{
					 	$file_ext=explode(".",$_FILES['file']['name']);
                        if($file_ext[1]=='xls')
                        {
							
							$date=date('Y-m-dmis');
							$filename=str_replace('-','',$date);
							$img_filename=strtolower($filename.".".strtolower($file_ext[count($file_ext)-1]));
							$newfile_path = "../ExcelData/".$img_filename;
							$_FILES['file']['tmp_name'];
							move_uploaded_file($_FILES['file']['tmp_name'], $newfile_path);
							chmod($newfile_path,0777);																
							$add = "../ExcelData/archive/".$img_filename;								
							copy($newfile_path, $add);
							@unlink($_FILES['filename']['tmp_name']);
							//echo "check both folder now";	die();
                         }
                        
						else
						{
							//echo "file type";	die();
							 $heart->redirect('mass_uploade.php?m=11');
						}
					}
 $data = new Spreadsheet_Excel_Reader();
 $readfile="../ExcelData/".$img_filename;
 $data->read($readfile);
 error_reporting(E_ALL ^ E_NOTICE); 
 
 $sql1 = "select * from ".$cfg['DB_PRODUCT']." ";
 $res1=$heart->sql_query($sql1);
 while($row1=$heart->sql_fetchrow($res1))
 {
 	$code[]=$row1['pd_code'];
 }
 

for ($j = 1; $j < $data->sheets[0]['numRows']; $j++)							
{
	

	

	$siteId					=$data->sheets[0]['cells'][$j+1][1];	
	$pd_code				=$data->sheets[0]['cells'][$j+1][2];				
	$disclaimer				=$data->sheets[0]['cells'][$j+1][3];
   	$category 				=$data->sheets[0]['cells'][$j+1][4];
    $notes					=$data->sheets[0]['cells'][$j+1][5];
    $location				=$data->sheets[0]['cells'][$j+1][6];
    $pd_name			    =$data->sheets[0]['cells'][$j+1][7];
	$pd_description		=$data->sheets[0]['cells'][$j+1][8];
    $pd_price				=$data->sheets[0]['cells'][$j+1][9];
    $pd_qty					=$data->sheets[0]['cells'][$j+1][10];
    $pd_image				=$data->sheets[0]['cells'][$j+1][11];
	//$pd_thumbnail		=$data->sheets[0]['cells'][$j+1][12];
	//$pd_date				=$data->sheets[0]['cells'][$j+1][12];
	//$pd_last_update		=$data->sheets[0]['cells'][$j+1][13];
	$pd_featured			=$data->sheets[0]['cells'][$j+1][12];
	
	$pd_rightbar			=$data->sheets[0]['cells'][$j+1][13];	
	$status					=$data->sheets[0]['cells'][$j+1][14];
  	$new_status			=$data->sheets[0]['cells'][$j+1][15]; 
	$order					=$data->sheets[0]['cells'][$j+1][16]; 
	$mainaddon			=$data->sheets[0]['cells'][$j+1][17];	
	
	$strike_price			=$data->sheets[0]['cells'][$j+1][18];
	$pd_bestseller			=$data->sheets[0]['cells'][$j+1][19];

if(!in_array($pd_code,$code))
{
	 $sql="INSERT INTO ".$cfg['DB_PRODUCT']."(
`pd_code`,`siteId`,`disclaimer`,`notes`,`location`,`pd_name`,`pd_description`,`pd_price`,`pd_qty`,`pd_image`,`pd_thumbnail`,`pd_date`,`pd_last_update`,`pd_featured`,`pd_rightbar`,`status`,`new_status`,`order`,`mainaddon`,`strike_price`,`pd_bestseller`) VALUES ('".$pd_code."','".$siteId."','".addslashes($disclaimer)."','".addslashes($notes)."','".addslashes($location)."','".addslashes($pd_name)."','".addslashes($pd_description)."','".addslashes($pd_price)."','".addslashes($pd_qty)."','".addslashes($pd_image)."','".addslashes($pd_thumbnail)."','".addslashes($pd_date)."','".addslashes($pd_last_update)."','".addslashes($pd_featured)."','".addslashes($pd_rightbar)."','".addslashes($status)."','".addslashes($new_status)."','".addslashes($order)."','".addslashes($mainaddon)."','".addslashes($strike_price)."','".addslashes($pd_bestseller)."')";

$heart->sql_query($sql);

$last_id=mysql_insert_id();

 //insert category in the another table
		$cat = explode(',',$category);
	 	foreach($cat as $key=>$val)
		{
			$sqlorders="INSERT INTO ".$cfg['DB_PRODUCT_CAT']." SET `pd_id` = ".$last_id." ,`cat_id` =".$val.",`status`='A',`siteId`=".$siteId." ";
			$heart->sql_query($sqlorders);
		}
	 
	 //insert category in the another table


}
else
{
	$sql="UPDATE ".$cfg['DB_PRODUCT']." SET
`siteId`='".$siteId."',
`disclaimer`='".addslashes($disclaimer)."',
`notes`='".addslashes($notes)."',
`location`='".addslashes($location)."',
`pd_name`='".addslashes($pd_name)."',
`pd_description`='".addslashes($pd_description)."',
`pd_price`='".addslashes($pd_price)."',
`pd_qty`='".addslashes($pd_qty)."',
`pd_image`='".addslashes($pd_image)."',
`pd_thumbnail`='".addslashes($pd_thumbnail)."',
`pd_date`='".addslashes($pd_date)."',
`pd_last_update`='".addslashes($pd_last_update)."',
`pd_featured`='".addslashes($pd_featured)."',
`pd_rightbar`='".addslashes($pd_rightbar)."',
`status`='".addslashes($status)."',
`new_status`='".addslashes($new_status)."',
`order`='".addslashes($order)."',
`mainaddon`='".addslashes($mainaddon)."',
`strike_price`='".addslashes($strike_price)."',
`pd_bestseller`='".addslashes($pd_bestseller)."'
 WHERE `pd_code`='".$pd_code."' ";
 $heart->sql_query($sql);
 
  $last_id=getPdId($pd_code);
			 
			 //deleting existing category from that product from product_cat table...
			 
			$sqld="DELETE FROM ".$cfg['DB_PRODUCT_CAT']." WHERE `pd_id` = ".$last_id." ";
			$heart->sql_query($sqld);
			 
			 //deleting existing category from that product from product_cat table...
						 
						 
						 
			 //insert category in the another table
	 	$cat = explode(',',$category);
	 	foreach($cat as $key=>$val)
		{
			$sqlorders="INSERT INTO ".$cfg['DB_PRODUCT_CAT']." SET `pd_id` = ".$last_id." ,`cat_id` =".$val.",`status`='A',`siteId`=".$siteId." ";
			$heart->sql_query($sqlorders);
		}
	 
	 //insert category in the another table

}

		
}
     unlink($readfile);
	$heart->redirect('mass_uploade.php?m=1');
	exit();
}else{



	$heart->redirect('mass_uploade.php?m=10');
	exit();
}
 unlink($readfile);
?>
