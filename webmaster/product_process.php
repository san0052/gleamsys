<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){

//show all record
case'view':
	$heart->redirect('product.php?show=view&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
exit();
break;
// show edit window
case'edit':
	$heart->redirect('product.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
exit();
break;
//delete record
case 'del':
        $sql1="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` IN (".$_REQUEST['id'].")";
		$res1=$heart->sql_query($sql1);
		while($row1=$heart->sql_fetchrow($res1))
		{
			if($row1['pd_image']!="")
			{
				unlink("../".$cfg['PRODUCT_IMAGES'].$row1['pd_image']);
			}
		}
	
$sql="DELETE FROM" .$cfg['DB_PRODUCT']. "WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 
$sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
$sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 
	$heart->redirect('product.php?m=3&pageno='.$_REQUEST['pageno']);
break; 
case 'insert':
	$pname=addslashes($_REQUEST['prod_pname_add']);
	$cate_id=$_REQUEST['cate_id'];
	//print_r($cate_id);
	$cat=implode(',',$cate_id);	
	$key_id=$_REQUEST['key_id'];
	//print_r($cate_id);
	$key=implode(',',$key_id);	
	$prod_loc=addslashes($_REQUEST['prod_loc']);
	//print_r($prod_loc);
	//$locs=implode(',',$prod_loc);
	$prod_dis=addslashes($_REQUEST['prod_dis']);
	$prod_note=addslashes($_REQUEST['prod_note']);	
	$price=addslashes($_REQUEST['prod_price_add']);
	$Unitprice=addslashes($_REQUEST['prod_unit_price_add']);
	$doubleCost=addslashes($_REQUEST['prod_double_flower_price']);
	$sprice=addslashes($_REQUEST['sprod_price_add']);
	$desc=(addslashes($_REQUEST['prod_desc_add']!=""))?addslashes($_REQUEST['prod_desc_add']):'';
	$deliInfo=(addslashes($_REQUEST['prod_del_info']!=""))?addslashes($_REQUEST['prod_del_info']):'';
	
	$pf=addslashes(($_REQUEST['fp']!=""))?'A':'I';
	//$pr=addslashes(($_REQUEST['rp']!=""))?'A':'I';
	$bp=addslashes(($_REQUEST['bp']!=""))?'Y':'N';
	$today_Spcial_product =	addslashes(($_REQUEST['today_Spcial_product']!=""))?'Y':'N';
	$new_arrival_pro =addslashes(($_REQUEST['new_arrival_pro']!=""))?'A':'I';

	 $sql="INSERT INTO ".$cfg['DB_PRODUCT']." SET `pd_name` = '".$pname."',`pd_price` = '".$price."',`pd_unit_price` = '".$Unitprice."',`pd_double_cost`= '".$doubleCost."',`strike_price` = '".$sprice."',	`pd_description` = '".$desc."',`pd_deliveryinformation` = '".$deliInfo."',`category`='".$cat."',`disclaimer` = '".$prod_dis."',`notes` = '".$prod_note."',`location` = '".$prod_loc."',`pd_date`=NOW(),`pd_featured`='".$pf."',`today_Spcial_product`='".$today_Spcial_product."', `new_arrival_pro` = '".$new_arrival_pro."' ,`pd_bestseller`='".$bp."',`status`='A',`keyword`='".$key."',`siteId`= '".$cfg['SESSION_SITE']."' " ;	
	$heart->sql_query($sql);
			 
	 $last_id=$heart->inserted_id();
	 
	 //insert category in the another table
	 
	 	foreach($cate_id as $key=>$val)
		{
			$sqlorders="INSERT INTO ".$cfg['DB_PRODUCT_CAT']." SET `pd_id` = ".$last_id." ,`siteId`= '".$cfg['SESSION_SITE']."',`cat_id` =".$val.",`status`='A' ";
			$heart->sql_query($sqlorders);
		}
	 
	 //insert category in the another table
	 
	  $sqlorders="UPDATE ".$cfg['DB_PRODUCT']." SET 	`order` = ".$last_id." WHERE `pd_id` =".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
	 $heart->sql_query($sqlorders);
			 
	//product code entry		 
			 if($_REQUEST['prod_code']!='')
			 {
				$code=$_REQUEST['prod_code'];
			}
			if($_REQUEST['prod_code']==''){
				$code='H2H '.$last_id;
			}
//@@@@@@@@@@@@@@@@@@@@//
			
	$ph = $_FILES['image_add']['name'];
	$a3 = $_FILES['image_add']['tmp_name'];
			if($ph!="")
			{
				$file_ext=explode(".",$ph);
				$ext= strtolower($file_ext[count($file_ext)-1]);
				$value=$last_id."_".$last_id.".".$ext;
				$path="../".$cfg['PRODUCT_IMAGES'].''.$value;
					
					//echo $value;
					chmod($path,0777);
					copy($a3,$path);
					chmod($path,0777);
					
					 $sqlup="UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image`='".$value."',`pd_code`='".$code."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
					 $heart->sql_query($sqlup);
			}
			/******* Product image gallery Start*********/
				$ph2 = $_FILES['image_add2']['name'];
				$a2 = $_FILES['image_add2']['tmp_name'];
				if($ph2!="")
				{
					$file_ext=explode(".",$ph2);
					$ext= strtolower($file_ext[count($file_ext)-1]);
					$value=$last_id."_".date('YmdHis').".".$ext;
					$path="../".$cfg['PRODUCT_IMAGES'].''.$value;
						
						//echo $value;
						chmod($path,0777);
						copy($a2,$path);
						chmod($path,0777);
						
						 $sqlup="UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image1`='".$value."',`pd_code`='".$code."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
						 $heart->sql_query($sqlup);
				}

				$ph3 = $_FILES['image_add3']['name'];
				$a4 = $_FILES['image_add3']['tmp_name'];
				if($ph3!="")
				{
					$file_ext=explode(".",$ph3);
					$ext= strtolower($file_ext[count($file_ext)-1]);
					$value=$last_id."_".date('YmdHis').".".$ext;
					$path="../".$cfg['PRODUCT_IMAGES'].''.$value;
						
						//echo $value;
						chmod($path,0777);
						copy($a4,$path);
						chmod($path,0777);
						
						 $sqlup="UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image2`='".$value."',`pd_code`='".$code."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
						 $heart->sql_query($sqlup);
				}

				$ph4 = $_FILES['image_add4']['name'];
				$a5 = $_FILES['image_add4']['tmp_name'];
				if($ph4!="")
				{
					$file_ext   = explode(".",$ph4);
					$ext     	= strtolower($file_ext[count($file_ext)-1]);
					$value   	= $last_id."_".$last_id.".".$ext;
					$path    	= "../".$cfg['PRODUCT_IMAGES'].''.$value;
						
						//echo $value;
						chmod($path,0777);
						copy($a5,$path);
						chmod($path,0777);
						
						 $sqlup="UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image3`='".$value."',`pd_code`='".$code."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
						 $heart->sql_query($sqlup);
				}
//*******************************************//		
		
	//this is for addon products
$padd_code=$_REQUEST['prod_pcode_addon'];	
//print_r($padd_code);
$padd_name=$_REQUEST['prod_pname_addon'];
//print_r($padd_name);
$price_addon=$_REQUEST['prod_price_addon'];	
//print_r($price_addon);	
		
		foreach($padd_name as $key=>$val)
		{
				$padd_code_val=$padd_code[$key];	
				$padd_name_val=$val;
				$price_addon_val=$price_addon[$key];			
				$a3=$_FILES['image_addon']['tmp_name'][$key];
				$image_val=$_FILES['image_addon']['name'][$key];				
			if($val!='')	
			{
				$sql12="INSERT INTO ".$cfg['DB_PRODUCT']." SET `pd_name` = '".$padd_name_val."',	`pd_price` = '".$price_addon_val."',`mainaddon`=".$last_id.",`status`='A' ,`siteId`= '".$cfg['SESSION_SITE']."' ";
				$heart->sql_query($sql12);
		
			    $add_id=mysql_insert_id();
				$sqlorders="UPDATE ".$cfg['DB_PRODUCT']."	 SET 	`order` = ".$add_id." WHERE `pd_id` =".$add_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
				$heart->sql_query($sqlorders);			 
				
				$code=$padd_code_val.'.'.$add_id;			
				$file_ext=explode(".",$val);
				$ext= strtolower($file_ext[count($file_ext)-1]);
				$value=$add_id."_".$add_id.".".$ext;
				$path="../".$cfg['PRODUCT_IMAGES'].''.$value;
				
				chmod($path,0777);
				copy($a3,$path);
				chmod($path,0777);
					
				$sqlup="UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image`='".$value."',`pd_code`='".$code."' WHERE `pd_id`=".$add_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
				$heart->sql_query($sqlup);
			
			}		
		}
	$heart->redirect('product.php?category='.$_REQUEST['secpid'].'&m=1');
	$heart->redirect('product.php?&m=1');
break;
// update record

//show add window
case'add':
	$heart->redirect('product.php?show=add&pageno='.$_REQUEST['pageno']);	
break;
//change status

case'Active':
  $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`status` = 'A',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
 $heart->redirect('product.php?m=2&pageno='.$_REQUEST['pageno']);
	 

break;
case'Inactive':
 
 $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`status` = 'I',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('product.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case'mulactive':
 $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`status` = 'A' WHERE prod_id IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
$sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('product.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':
 $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`status` = 'I' WHERE `prod_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
$sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('product.php?m=2&pageno='.$_REQUEST['pageno']);

break;
//insert record 
//default view
/* ------------------------ TYPE START ------------------------------------------------*/

case 'update':


	$cate_id=$_REQUEST['cate_id'];
	
    $cat=implode(',',$cate_id);
	$key_id=$_REQUEST['key_id'];
	
    $key=implode(',',$key_id);
	
	$pageno =addslashes(($_REQUEST['pageno']!=""))?addslashes($_REQUEST['pageno']):'0';
	
	$pname=addslashes($_REQUEST['prod_pname_add']);
	
	
	
	
	$prod_loc=addslashes($_REQUEST['prod_loc']);
	//print_r($prod_loc);
	//$locs=implode(',',$prod_loc);

	
	$prod_dis=addslashes($_REQUEST['prod_dis']);
	$prod_note=addslashes($_REQUEST['prod_note']);
	$prod_deliv=addslashes($_REQUEST['prod_deliv']);
	
	 if($_REQUEST['prod_code']!=''){
				$code=addslashes($_REQUEST['prod_code']);
			}
			if($_REQUEST['prod_code']==''){
				$code='H2H '.$_REQUEST['pd_id'];
			}
	
	$price=addslashes($_REQUEST['prod_price_add']);
	$unitprice=addslashes($_REQUEST['prod_unitprice_add']);
	$doubleCost = addslashes($_REQUEST['double_flower_cost']);
	$sprice=addslashes($_REQUEST['sprod_price_add']);
	$discount=addslashes($_REQUEST['discount']);
	$desc=addslashes(($_REQUEST['prod_desc_add']!=""))?addslashes($_REQUEST['prod_desc_add']):'';

	$pf    = addslashes(($_REQUEST['fp']!=""))?'A':'I';
	$bp    = addslashes(($_REQUEST['bp']!=""))?'Y':'N';
	$today_Spcial_product =	addslashes(($_REQUEST['today_Spcial_product']!=""))?'Y':'N';
	$new_arrival_pro 	  =  addslashes(($_REQUEST['new_arrival_pro']!=""))?'A':'I';		
		
	/******* Product image gallery Start*********/
			$ph2 = $_FILES['image_add2']['name'];
			$a2 = $_FILES['image_add2']['tmp_name'];
			if($ph2!="")
			{
				$file_ext=explode(".",$ph2);
				$ext= strtolower($file_ext[count($file_ext)-1]);
				$value1=$last_id."_".date('YmdHis').".".$ext;
				$path="../".$cfg['PRODUCT_IMAGES'].''.$value;
					
					//echo $value;
					chmod($path,0777);
					copy($a2,$path);
					chmod($path,0777);
					
					 $sqlup="UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image1`='".$value."',`pd_code`='".$code."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
					 $heart->sql_query($sqlup);
			}

			$ph3 = $_FILES['image_add3']['name'];
			$a4 = $_FILES['image_add3']['tmp_name'];
			if($ph3!="")
			{
				$file_ext=explode(".",$ph3);
				$ext= strtolower($file_ext[count($file_ext)-1]);
				$value2=$last_id."_".date('YmdHis').".".$ext;
				$path="../".$cfg['PRODUCT_IMAGES'].''.$value;
					
					//echo $value;
					chmod($path,0777);
					copy($a4,$path);
					chmod($path,0777);
					
					 $sqlup="UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image2`='".$value."',`pd_code`='".$code."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
					 $heart->sql_query($sqlup);
			}

			$ph4 = $_FILES['image_add4']['name'];
			$a5 = $_FILES['image_add4']['tmp_name'];
			if($ph4!="")
			{
				$file_ext   = explode(".",$ph4);
				$ext     	= strtolower($file_ext[count($file_ext)-1]);
				$value3   	= $last_id."_".date('YmdHis').".".$ext;
				$path    	= "../".$cfg['PRODUCT_IMAGES'].''.$value;
					
					//echo $value;
					chmod($path,0777);
					copy($a5,$path);
					chmod($path,0777);
					
					 $sql="UPDATE ".$cfg['DB_PRODUCT']."
						 SET 			
						`pd_name` 				= '".$pname."',
						`pd_price` 				= '".$price."',
						`pd_unit_price` 		= '".$unitprice."',
						`pd_double_cost`		= '".$doubleCost."',
						`earliest_deliveryId` 	= '".$prod_deliv."',
						`strike_price` 			= '".$sprice."',
						`discount`				= '".$discount."',
						`pd_description` 		= '".$desc."',	
						`category`				= '".$cat."',		
						`keyword`				= '".$key."',
						`disclaimer` 			= '".$prod_dis."',
						`notes` 				= '".$prod_note."',			
						`location` 				= '".$prod_loc."',			
						`pd_code` 				= '".$code."',
						`pd_image1`       		= '".$value1."',
						`pd_image2`       		= '".$value2."',
						`pd_image3`       		= '".$value3."',
						`pd_date`				=  NOW(),
						`status`				= 'A',`pd_last_update`=NOW(),
						`pd_featured`			= '".$pf."',
						`pd_bestseller`			= '".$bp."',
						`today_Spcial_product`  = '".$today_Spcial_product."',
						`new_arrival_pro` 		= '".$new_arrival_pro."'

			WHERE `pd_id`=".$_REQUEST['pd_id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
					 $heart->sql_query($sqlup);
			}


		$sql="UPDATE ".$cfg['DB_PRODUCT']."
			 SET 			
			`pd_name` 				= '".$pname."',
			`pd_price` 				= '".$price."',
			`pd_unit_price` 		= '".$unitprice."',
			`pd_double_cost`		= '".$doubleCost."',
			`earliest_deliveryId` 	= '".$prod_deliv."',
			`strike_price` 			= '".$sprice."',
			`discount`				= '".$discount."',
			`pd_description` 		= '".$desc."',	
			`category`				= '".$cat."',		
			`keyword`				= '".$key."',
			`disclaimer` 			= '".$prod_dis."',
			`notes` 				= '".$prod_note."',			
			`location` 				= '".$prod_loc."',			
			`pd_code` 				= '".$code."',
			`pd_date`				=  NOW(),
			`status`				= 'A',`pd_last_update`=NOW(),
			`pd_featured`			= '".$pf."',
			`pd_bestseller`			= '".$bp."',
			`today_Spcial_product`  = '".$today_Spcial_product."',
			`new_arrival_pro` 		= '".$new_arrival_pro."'

			WHERE `pd_id`=".$_REQUEST['pd_id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
	
			
			 $heart->sql_query($sql);
			 $last_id=$_REQUEST['pd_id'];
			 
			 //deleting existing category from that product from product_cat table...
			 
			$sqld="DELETE FROM ".$cfg['DB_PRODUCT_CAT']." WHERE `pd_id` = ".$last_id." ";
			$heart->sql_query($sqld);
			 
			 //deleting existing category from that product from product_cat table...
						 
						 
						 
			 //insert category in the another table
	 
	 	foreach($cate_id as $key=>$val)
		{
			$sqlorders="INSERT INTO ".$cfg['DB_PRODUCT_CAT']." SET `pd_id` = ".$last_id." ,`cat_id` =".$val.",`status`='A' ";
			$heart->sql_query($sqlorders);
		}
	 
	 //insert category in the another table
			 
		foreach($_FILES['image_add']['name'] as $key=>$val)
		{
			$a3=$_FILES['image_add']['tmp_name'][$key];
			if($val!="")
			{
					unlink("../".$cfg['PRODUCT_IMAGES'].''.pd_image_name($last_id));					
					$file_ext=explode(".",$val);
					$ext= strtolower($file_ext[count($file_ext)-1]);
					$value=$last_id."_".$last_id.".".$ext;
					$path="../".$cfg['PRODUCT_IMAGES'].''.$value;
					
					// $value;
					chmod($path,0777);
					copy($a3,$path);
					chmod($path,0777);
					
					 $sqlup = "UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image`='".$value."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
					 $heart->sql_query($sqlup);
			}
			
		}

		$sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
		$heart->sql_query($sqlnew1); 
		$sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
		$heart->sql_query($sqlnew2); 
      	$heart->redirect('product.php?&m=2&pageno='.$pageno);
	
break;


case 'add_addon':


//this is for addon products
    $pname=addslashes($_REQUEST['prod_pname_add']);
	$cat=addslashes($_REQUEST['addon']);
	$prod_loc=addslashes($_REQUEST['prod_loc']);
	//print_r($prod_loc);
	//$locs=implode(',',$prod_loc);
	$prod_dis=addslashes($_REQUEST['prod_dis']);
	$prod_note=addslashes($_REQUEST['prod_note']);	
	$price=addslashes($_REQUEST['prod_price_add']);
	$sprice=addslashes($_REQUEST['sprod_price_add']);
	$discount=addslashes($_REQUEST['discount']);
	$desc=(addslashes($_REQUEST['prod_desc_add']!=""))?addslashes($_REQUEST['prod_desc_add']):'';
	$pf=addslashes(($_REQUEST['fp']!=""))?'A':'I';
	$pr=addslashes(($_REQUEST['rp']!=""))?'A':'I';
	$bp=addslashes(($_REQUEST['bp']!=""))?'Y':'N';
		
$sql="INSERT INTO ".$cfg['DB_PRODUCT']." SET `pd_name` = '".$pname."',`pd_price` = '".$price."',	`strike_price` = '".$sprice."',`discount`= '".$discount."',`pd_description` = '".$desc."',`category`='".$cat."',`disclaimer` = '".$prod_dis."',`notes` = '".$prod_note."',`location` = '".$prod_loc."',`pd_date`=NOW(),`pd_featured`='".$pf."',`pd_rightbar`='".$pr."',`pd_bestseller`='".$bp."',`status`='A',`siteId`= '".$cfg['SESSION_SITE']."' " ;	
		$heart->sql_query($sql);
			 
	 $last_id=mysql_insert_id();
	 
	 //insert category in the another table
	 
	 	foreach($cate_id as $key=>$val)
		{
			$sqlorders="INSERT INTO ".$cfg['DB_PRODUCT_CAT']." SET `pd_id` = ".$last_id." ,`siteId`= '".$cfg['SESSION_SITE']."',`cat_id` =".$val.",`status`='A' ";
			$heart->sql_query($sqlorders);
		}
	 
	 //insert category in the another table
	 
	 $sqlorders="UPDATE ".$cfg['DB_PRODUCT']." SET `order` = ".$last_id.",`isAddon`='Y' WHERE `pd_id` =".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
	 $heart->sql_query($sqlorders);
			 
	//product code entry		 
			 if($_REQUEST['prod_code']!='')
			 {
				$code=$_REQUEST['prod_code'];
			}
			if($_REQUEST['prod_code']==''){
				$code='H2H '.$last_id;
			}
//@@@@@@@@@@@@@@@@@@@@//
			
	 $ph = $_FILES['image_add']['name'];
	$a3 = $_FILES['image_add']['tmp_name'];
			if($ph!="")
			{
				$file_ext=explode(".",$ph);
				$ext= strtolower($file_ext[count($file_ext)-1]);
				$value=$last_id."_".$last_id.".".$ext;
				$path="../".$cfg['PRODUCT_IMAGES'].''.$value;
					
					//echo $value;
					chmod($path,0777);
					copy($a3,$path);
					chmod($path,0777);
					
					 $sqlup="UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image`='".$value."',`pd_code`='".$code."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
					 $heart->sql_query($sqlup);
			}

			
		
		$heart->redirect('addon.php?m=4'.$gourl.'&pageno='.$_REQUEST['pageno']);
break;

case'update_addon':

$cate_id=$_REQUEST['cate_id'];
	//print_r($cate_id);
    $cat=implode(',',$cate_id);
	
	$pageno =addslashes(($_REQUEST['pageno']!=""))?addslashes($_REQUEST['pageno']):'0';
	//$cate_id=$_REQUEST['cate_id'];
	$pname=addslashes($_REQUEST['prod_pname_add']);
	//$secpid=$_REQUEST['secpid'];
	
	
	//print_r($secpid);
	//$cat=implode(',',$cate_id);
	
	$prod_loc=addslashes($_REQUEST['prod_loc']);
	//print_r($prod_loc);
	//$locs=implode(',',$prod_loc);

	
	$prod_dis=addslashes($_REQUEST['prod_dis']);
	$prod_note=addslashes($_REQUEST['prod_note']);
	
	 if($_REQUEST['prod_code']!=''){
				$code=addslashes($_REQUEST['prod_code']);
			}
			if($_REQUEST['prod_code']==''){
				$code='H2H '.$_REQUEST['pd_id'];
			}
	
	$price=addslashes($_REQUEST['prod_price_add']);
	$prod_unitprice_add=addslashes($_REQUEST['prod_unitprice_add']);
	$prod_deliv=addslashes($_REQUEST['prod_deliv']);
	$sprice=addslashes($_REQUEST['sprod_price_add']);
	$discount=addslashes($_REQUEST['discount']);
	$desc=addslashes(($_REQUEST['prod_desc_add']!=""))?addslashes($_REQUEST['prod_desc_add']):'';
	$pf=addslashes(($_REQUEST['fp']=="1"))?'A':'I';
	$pr=addslashes(($_REQUEST['rp']=="1"))?'A':'I';
	$bp=addslashes(($_REQUEST['bp']=="1"))?'Y':'N';		
		
	
		 $sql="UPDATE ".$cfg['DB_PRODUCT']."
			 SET 			
			`pd_name` = '".$pname."',
			`pd_unit_price` = '".$prod_unitprice_add."',
			`earliest_deliveryId` = '".$prod_deliv."',
			`pd_price` = '".$price."',
			`strike_price` = '".$sprice."',
			`discount` = '".$discount."',
			`pd_description` = '".$desc."',	
			`category`='".$cat."',		
			`disclaimer` = '".$prod_dis."',
			`notes` = '".$prod_note."',			
			`location` = '".$prod_loc."',			
			`pd_code` = '".$code."',
			`pd_date`=NOW(),
			`status`='A',`pd_last_update`=NOW(),
			`pd_featured`='".$pf."',
			`pd_rightbar`='".$pr."',
			`pd_bestseller`='".$bp."'
			WHERE `pd_id`=".$_REQUEST['pd_id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
	
			
			 $heart->sql_query($sql);
			 $last_id=$_REQUEST['pd_id'];
			 
			 //deleting existing category from that product from product_cat table...
			 
			$sqld="DELETE FROM ".$cfg['DB_PRODUCT_CAT']." WHERE `pd_id` = ".$last_id." ";
			$heart->sql_query($sqld);
			 
			 //deleting existing category from that product from product_cat table...
						 
						 
						 
			 //insert category in the another table
	 
	 	foreach($cate_id as $key=>$val)
		{
			$sqlorders="INSERT INTO ".$cfg['DB_PRODUCT_CAT']." SET `pd_id` = ".$last_id." ,`cat_id` =".$val.",`status`='A' ";
			$heart->sql_query($sqlorders);
		}
	 
	 //insert category in the another table
			 
		foreach($_FILES['image_add']['name'] as $key=>$val)
		{
			$a3=$_FILES['image_add']['tmp_name'][$key];
			if($val!="")
			{
					unlink("../".$cfg['PRODUCT_IMAGES'].''.pd_image_name($last_id));					
					$file_ext=explode(".",$val);
					$ext= strtolower($file_ext[count($file_ext)-1]);
					$value=$last_id."_".$last_id.".".$ext;
					$path="../".$cfg['PRODUCT_IMAGES'].''.$value;
					
					// $value;
					chmod($path,0777);
					copy($a3,$path);
					chmod($path,0777);
					
					 $sqlup="UPDATE ".$cfg['DB_PRODUCT']." SET `pd_image`='".$value."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
					 $heart->sql_query($sqlup);
			}
			
		}
		$sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
		$heart->sql_query($sqlnew1); 
		$sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
		$heart->sql_query($sqlnew2); 
      	$heart->redirect('addon.php?&m=2&pageno='.$pageno);	

$heart->redirect('addon.php');

break;

case 'del_addon':
        $sql1="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` IN (".$_REQUEST['id'].")";
		$res1=$heart->sql_query($sql1);
		while($row1=$heart->sql_fetchrow($res1))
		{
			if($row1['pd_image']!="")
			{
				unlink("../".$cfg['PRODUCT_IMAGES'].$row1['pd_image']);
			}
		}
	
$sql="UPDATE " .$cfg['DB_PRODUCT']. " SET `status`='D' WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 
$sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
$sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 
	$heart->redirect('addon.php?m=3&pageno='.$_REQUEST['pageno']);
break; 



case'order':
	 $catorder=array();
	 $catorder=$_REQUEST['catorder'];
	 
	 $status = $_REQUEST['cat_returnid'];
	 $status2 = $_REQUEST['status2'];
	 $status3 = $_REQUEST['status3'];
	 $status4 = $_REQUEST['status4'];
	 $gourl = '';
	 if($status!='all'){
		$gourl.='&category='.$status;
	 }
	 if($status2!='all'){
		$gourl.='&occasion='.$status2;
	 }
	 if($status3!='all'){
		$gourl.='&color='.$status3;
	 }
	 if($status4!='all'){
		$gourl.='&location='.$status4;
	 }
	 
	 
	 foreach($catorder as $key => $value)
	 {
	 $num=is_numeric($value);
			 if($num==1)
			 {
			 $sql_menu="UPDATE ".$cfg['DB_PRODUCT']." SET `order` = ".$value."  WHERE `pd_id` = ".$key." ";	
			 $heart->sql_query($sql_menu);	 
			 }
	 }
     $heart->redirect('product.php?m=4'.$gourl.'&pageno='.$_REQUEST['pageno']);
break;

case 'Active_addon':
  $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`status` = 'A',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
 $heart->redirect('addon.php?m=2&pageno='.$_REQUEST['pageno']);
	 

break;
case 'Inactive_addon':
 
 $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`status` = 'I',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('addon.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case'mulactive_addon':
 $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`status` = 'A' WHERE prod_id IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
$sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('addon.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive_addon':
 $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`status` = 'I' WHERE `prod_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
$sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('addon.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'getsec_category':
$id=$_REQUEST['id'];
/*echo $_REQUEST['id'];


$sql_cat="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$_REQUEST['id']."' AND `status` ='A'";
			$res_cat=$heart->sql_query($sql_cat);
			 $maxrow=$heart->sql_numrows($res_cat);
	 if($maxrow >0)
	 {
$str="<select name=\"secpid\" id=\"secpid\" class=\"forminputelement\" >";
$str.="<option value='0' >Select Arka Category</option>";	
 while($row_cat=$heart->sql_fetchrow($res_cat)){
$str.="<optgroup label=$row_cat['name']>";
$sql_cat1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$row_cat['id']."' AND `status` ='A'";
			$res_cat1=$heart->sql_query($sql_cat1);
			while($row_cat1=$heart->sql_fetchrow($res_cat1)){
$str.="<option value=$row_cat1['id'] >$row_cat1['name']</option>";
}
					$str.= "</optgroup>";
				 }
                  $str.= "</select>"; 
echo $str;
*/
$sql_cat="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$_REQUEST['id']."' AND `status` ='A'";
			$res_cat=$heart->sql_query($sql_cat);
			 $maxrow=$heart->sql_numrows($res_cat);
?>
<select name="secpid[]" class="forminputelement" id="secpid" multiple="multiple">
<option value="0" selected="selected">Select Category</option>
<? 
 if($maxrow >0)
{
while($row_cat=$heart->sql_fetchrow($res_cat)){
$sql_cat1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$row_cat['id']."' AND `status` ='A'";
$res_cat1=$heart->sql_query($sql_cat1);
$maxrow_1=$heart->sql_numrows($res_cat1);
 if($maxrow_1 >0){ ?>
 <optgroup label="<?=$row_cat['name']?>">
 <?
while($row_cat1=$heart->sql_fetchrow($res_cat1)){
?>
<option value="<?=$row_cat1['id']?>" ><?=$row_cat1['name']?></option>
<? }?>
</optgroup>
<? } } } ?>
</select> 
Hold Ctrl key to select multilple categories
<?
 
break;

case'getsec_category5':
$id=$_REQUEST['id'];
/*echo $_REQUEST['id'];


$sql_cat="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$_REQUEST['id']."' AND `status` ='A'";
			$res_cat=$heart->sql_query($sql_cat);
			 $maxrow=$heart->sql_numrows($res_cat);
	 if($maxrow >0)
	 {
$str="<select name=\"secpid\" id=\"secpid\" class=\"forminputelement\" >";
$str.="<option value='0' >Select Arka Category</option>";	
 while($row_cat=$heart->sql_fetchrow($res_cat)){
$str.="<optgroup label=$row_cat['name']>";
$sql_cat1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$row_cat['id']."' AND `status` ='A'";
			$res_cat1=$heart->sql_query($sql_cat1);
			while($row_cat1=$heart->sql_fetchrow($res_cat1)){
$str.="<option value=$row_cat1['id'] >$row_cat1['name']</option>";
}
					$str.= "</optgroup>";
				 }
                  $str.= "</select>"; 
echo $str;
*/
$sql_cat="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$_REQUEST['id']."' AND `status` ='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
$res_cat=$heart->sql_query($sql_cat);
$maxrow=$heart->sql_numrows($res_cat);
?>
<select name="secpid" class="forminputelement" id="secpid" onchange="window.location.href='product.php?category='+this.value">
<option value="0" selected="selected">Select Category</option>
<? 
 if($maxrow >0)
{
while($row_cat=$heart->sql_fetchrow($res_cat)){
$sql_cat1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$row_cat['id']."' AND `status` ='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
$res_cat1=$heart->sql_query($sql_cat1);
$maxrow_1=$heart->sql_numrows($res_cat1);
// if($maxrow_1 >0){ ?>
 <option value="<?=$row_cat['id']?>" style="font-weight:bold;"><?=$row_cat['name']?></option>
 <?
while($row_cat1=$heart->sql_fetchrow($res_cat1)){
?>
<option value="<?=$row_cat1['id']?>"  ><?=$row_cat1['name']?></option>
<? }?>

<? //}
 } } ?>
</select>   
<?
 
break;



case 'Addon':
  $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`isAddon` = 'Y',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
 $heart->redirect('allproduct.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'NotAddon':
 
 $sql="UPDATE ".$cfg['DB_PRODUCT']."
	 SET 
	`isAddon` = 'N',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PRODUCT']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('allproduct.php?m=2&pageno='.$_REQUEST['pageno']);

break;case 'catkeylist':$keyid=0;$sql="SELECT DISTINCT keywordid FROM ".$cfg['DB_KEYWORD_CATEGORY_MAP']." WHERE categoryid IN (".$_REQUEST['catid'].")";$res=$heart->sql_query($sql);$numrows=$heart->sql_numrows($res);while($rows=$heart->sql_fetchrow($res)){	if($keyid==0){		$keyid=$rows['keywordid'];	}else{		$keyid=$keyid.','.$rows['keywordid'];	}	}echo $keyid;break;
}				           
?>