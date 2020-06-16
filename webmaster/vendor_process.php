<?

include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');

//die("************111111");

$act=@$_REQUEST['act']; 

//echo $act;



switch($act){

case 'add':

			$email 					= addslashes($_REQUEST['email']);
			$password 				= $heart->encoded($_REQUEST['password']);
			$owner_name 			= addslashes($_REQUEST['owner_name']);
			$owner_contact_number 	= addslashes($_REQUEST['owner_contact_number']);
			$contact_person 		= addslashes($_REQUEST['contact_person']);
			$vendor_name 			= addslashes($_REQUEST['vendor_name']);
			$vendor_phone_number 	= addslashes($_REQUEST['vendor_phone_number']);
			$vendor_mobile_number 	= addslashes($_REQUEST['vendor_mobile_number']);
			$address 				= addslashes($_REQUEST['address']);
			$country_add 			= addslashes($_REQUEST['country_add']);
			$state_add 				= addslashes($_REQUEST['state_add']);
			$city_add 				= addslashes($_REQUEST['city_add']);
			$vendor_reference 		= addslashes($_REQUEST['vendor_reference']);
			$vat_no 				= addslashes($_REQUEST['vat_no']);
			$cst_no 				= addslashes($_REQUEST['cst_no']);
			$st_no 					= addslashes($_REQUEST['st_no']);
			$pan_no 				= addslashes($_REQUEST['pan_no']);
			
			
			$sql="INSERT INTO" .$cfg['DB_VENDOR']. "
				  SET `email` = '".$email."',
				  	  `password` = '".$password."',
					  `owner_name` = '".$owner_name."',
					  `owner_contact_number` = '".$owner_contact_number."',
					  `contact_person` = '".$contact_person."',
					  `vendor_name` = '".$vendor_name."',
					  `vendor_phone_number` = '".$vendor_phone_number."',
					  `vendor_mobile_number` = '".$vendor_mobile_number."',
					  `address` = '".$address."',
					  `country` = '".$country_add."',
					  `state` = '".$state_add."',
					  `city` = '".$city_add."',
					  `vendor_reference` = '".$vendor_reference."',
					  `vat_no` = '".$vat_no."',
					  `cst_no` = '".$cst_no."',
					  `st_no` = '".$st_no."',
					  `pan_no` = '".$pan_no."',
					  `status`	=	'A',
					  `modidate` = '".date('Y-m-d H:i:s')."',
					  `modby`	= 'admin',
					  `modify_ip` = '".$_SERVER['REMOTE_ADDR']."'";

	 		$heart->sql_query($sql);
			
			$lastVendorid = mysql_insert_id();
			
			foreach($_REQUEST['checkvalue'] as $key=>$val)
	      	{
			 if($val!="")
		      	{
				  $sql1="INSERT INTO ".$cfg['DB_VENDOR_PRODUCT_AVAIL']."
				         	  SET  `vendor_id`=".$lastVendorid.",
						   	  	   `product_id`='".$val."',
								   `price`='".$_REQUEST['price'][$key]."',
							       `status`='A'";
				 $heart->sql_query($sql1);
		    	}		
	    	}

	 		$heart->redirect('vendor.php?show=view&id='.$lastVendorid);
			
			
			
exit();
break;

case 'edit':

			$owner_name 			= addslashes($_REQUEST['owner_name']);
			$owner_contact_number 	= addslashes($_REQUEST['owner_contact_number']);
			$contact_person 		= addslashes($_REQUEST['contact_person']);
			$vendor_name 			= addslashes($_REQUEST['vendor_name']);
			$vendor_phone_number 	= addslashes($_REQUEST['vendor_phone_number']);
			$vendor_mobile_number 	= addslashes($_REQUEST['vendor_mobile_number']);
			$address 				= addslashes($_REQUEST['address']);
			$country_add 			= addslashes($_REQUEST['country_add']);
			$state_add 				= addslashes($_REQUEST['state_add']);
			$city_add 				= addslashes($_REQUEST['city_add']);
			$vendor_reference 		= addslashes($_REQUEST['vendor_reference']);
			$vat_no 				= addslashes($_REQUEST['vat_no']);
			$cst_no 				= addslashes($_REQUEST['cst_no']);
			$st_no 					= addslashes($_REQUEST['st_no']);
			$pan_no 				= addslashes($_REQUEST['pan_no']);
			$products 				= $_REQUEST['pan_no'];
			$ids 					= $_REQUEST['checkvalue'];
			
			$sql="UPDATE" .$cfg['DB_VENDOR']. "
				  SET `owner_name` = '".$owner_name."',
					  `owner_contact_number` = '".$owner_contact_number."',
					  `contact_person` = '".$contact_person."',
					  `vendor_name` = '".$vendor_name."',
					  `vendor_phone_number` = '".$vendor_phone_number."',
					  `vendor_mobile_number` = '".$vendor_mobile_number."',
					  `address` = '".$address."',
					  `country` = '".$country_add."',
					  `state` = '".$state_add."',
					  `city` = '".$city_add."',
					  `vendor_reference` = '".$vendor_reference."',
					  `vat_no` = '".$vat_no."',
					  `cst_no` = '".$cst_no."',
					  `st_no` = '".$st_no."',
					  `pan_no` = '".$pan_no."',
					  `status`	=	'A',
					  `modidate` = '".date('Y-m-d H:i:s')."',
					  `modby`	= 'admin',
					  `modify_ip` = '".$_SERVER['REMOTE_ADDR']."' 
				  WHERE `id` = '".$_REQUEST['id']."'";

	 		$heart->sql_query($sql);
			
			$sql_id = "SELECT * FROM ".$cfg['DB_VENDOR_PRODUCT_AVAIL']."WHERE `vendor_id` = '".$_REQUEST['id']."'";
			$res_id = $heart->sql_query($sql_id);
			while($row_id = $heart->sql_fetchrow($res_id))
			{
			$pr_id[] = $row_id['id'];
			}
			
			foreach($pr_id as $key=>$val)
	      	{
			 if($val!="")
		      	{
				  $sql1="UPDATE".$cfg['DB_VENDOR_PRODUCT_AVAIL']."
				         	  SET `vendor_id`=".$_REQUEST['id'].",
						   	  	   `product_id`='".$ids[$key]."',
								   `price`='".$_REQUEST['price'][$key]."',
							       `status`='A'
							  WHERE `id` = '".$pr_id[$key]."'";
				  $heart->sql_query($sql1);
		    	}		
	    	}

	 		$heart->redirect('vendor.php?show=view&id='.$_REQUEST['id']);
			
			
			
exit();
break;

case'email_avail':
	
		$email = trim($_REQUEST['email']," ");
		
		$sql = "SELECT * FROM ".$cfg['DB_VENDOR']."
				 WHERE `email` ='".$email."'";
		
		$res = $heart->sql_query($sql);
		$maxrow = $heart->sql_numrows($res);
		
		if($maxrow > 0)
		{
			echo '1';
		}
		else
		{
			echo '0';
		}
exit();
break;	




case'Active':
	
			$sql="UPDATE ".$cfg['DB_VENDOR']." 
				  SET `status`='A' 
				  WHERE `id` 
				  IN (".$_REQUEST['id'].")";
			$heart->sql_query($sql);
			$heart->redirect('vendor.php?m=2');	
			
exit();
break;
	
case'multiactive':
	
			$sql="UPDATE ".$cfg['DB_VENDOR']." 
				  SET `status`='A' 
				  WHERE `id` 
				  IN (".$_REQUEST['id'].")";
			$heart->sql_query($sql);
			$heart->redirect('vendor.php?m=2');	
			

exit();
break;
	
case'Inactive':	

			$sql="UPDATE ".$cfg['DB_VENDOR']." 
				  SET `status`='I' 
				  WHERE `id` 
				  IN (".$_REQUEST['id'].")";
			$heart->sql_query($sql);
			$heart->redirect('vendor.php?m=2'); 
			
			
exit();
break;
		
case'multiinactive':	
	
			$sql="UPDATE ".$cfg['DB_VENDOR']." 
				  SET `status`='I' 
				  WHERE `id` ='".$_REQUEST['id']."'";
			$heart->sql_query($sql);
			$heart->redirect('vendor.php?m=2'); 
			
			
exit();
break;


case'del':



			 $sql="UPDATE ".$cfg['DB_VENDOR']." 
			 	   SET `status` = 'D' 
				   WHERE `id`=".$_REQUEST['id']."";
			
			 $heart->sql_query($sql);
			 $heart->redirect('vendor.php?m=3&pageno='.$_REQUEST['pageno']);

break;



case 'muldel':



 $sql="UPDATE ".$cfg['DB_VENDOR']." 
			 	   SET `status` = 'D' 
				   WHERE `id`=".$_REQUEST['id']."";
			
			 $heart->sql_query($sql);
			 $heart->redirect('vendor.php?m=3&pageno='.$_REQUEST['pageno']);

break;



case 'Active':



 $sql="UPDATE ".$cfg['DB_CATEGORY']."

	 SET 

	`status` = 'A' WHERE `id` =".$_REQUEST['id']."";

	 $heart->sql_query($sql);

	 $heart->redirect('category.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);



break;

case 'Inactive':



 $sql="UPDATE ".$cfg['DB_CATEGORY']."

	 SET 

	`status` = 'I' WHERE `id` =".$_REQUEST['id']."";

	 $heart->sql_query($sql);

	$heart->redirect('category.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);



break;

case 'mulactive':



 $sql="UPDATE ".$cfg['DB_CATEGORY']."

	 SET 

	`status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";

	 $heart->sql_query($sql);

	

	 $heart->redirect('category.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);



break;



case'mulinactive':



 $sql="UPDATE ".$cfg['DB_CATEGORY']."

	 SET 

	`status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";

	 $heart->sql_query($sql);

	 

	 $heart->redirect('category.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);



break;





}





?>
