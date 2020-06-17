<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){


//show all record
case'view':
	if($_REQUEST['page']=='About Us')
	{
		$heart->redirect('content.php?show=view&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Contact Us')
	{
		$heart->redirect('content.php?show=viewContact&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Privacy Policy')
	{
		$heart->redirect('content.php?show=viewPrivacy&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Refund Policy')
	{
		$heart->redirect('content.php?show=viewRefund&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Terms and Conditions')
	{
		$heart->redirect('content.php?show=viewTerms&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Client')
	{
		$heart->redirect('content.php?show=viewClient&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Portfolio')
	{
		$heart->redirect('content.php?show=viewPortfollio&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Tech-support')
	{
		$heart->redirect('content.php?show=viewTechSupport&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='It-service')
	{
		$heart->redirect('content.php?show=viewIt-service&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Computer-training')
	{
		$heart->redirect('content.php?show=viewComputer-training&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Mobile-development')
	{
		$heart->redirect('content.php?show=viewMobile-development&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Ecommerce-development')
	{
		$heart->redirect('content.php?show=viewEcommerce-development&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Web-designing')
	{
		$heart->redirect('content.php?show=viewWeb-designing&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Web-development')
	{
		$heart->redirect('content.php?show=viewWeb-development&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Software-development')
	{
		$heart->redirect('content.php?show=viewSoftware-development&id='.$_REQUEST['id']);
	}
	if($_REQUEST['page']=='Codeigniter-development')
	{
		$heart->redirect('content.php?show=viewCodeigniter-development&id='.$_REQUEST['id']);
	}
exit();
break;
// show edit window
case'edit':
	if($_REQUEST['id']==100 || $_REQUEST['id']==1)
	{
		$heart->redirect('content.php?show=edit&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==111 || $_REQUEST['id']==2)
	{
		$heart->redirect('content.php?show=editContact&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==113 || $_REQUEST['id']==3)
	{
		$heart->redirect('content.php?show=editPrivacy&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==114 || $_REQUEST['id']==4)
	{
		$heart->redirect('content.php?show=editRefund&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==115 || $_REQUEST['id']==5)
	{
		$heart->redirect('content.php?show=editTerms&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==116 || $_REQUEST['id']==6)
	{
		$heart->redirect('content.php?show=editClient&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==117 || $_REQUEST['id']==7)
	{
		$heart->redirect('content.php?show=editPortfollio&id='.$_REQUEST['id']);
	}if($_REQUEST['id']==118 || $_REQUEST['id']==8)
	{
		$heart->redirect('content.php?show=editTechSupport&id='.$_REQUEST['id']);
	}if($_REQUEST['id']==119 || $_REQUEST['id']==9)
	{
		$heart->redirect('content.php?show=editIt-service&id='.$_REQUEST['id']);
	}if($_REQUEST['id']==120 || $_REQUEST['id']==10)
	{
		$heart->redirect('content.php?show=editComputer-service&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==121 || $_REQUEST['id']==11)
	{
		$heart->redirect('content.php?show=editMobile-development&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==122 || $_REQUEST['id']==12)
	{
		$heart->redirect('content.php?show=editEcommerce-development&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==123 || $_REQUEST['id']==13)
	{
		$heart->redirect('content.php?show=editWeb-designing&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==124 || $_REQUEST['id']==14)
	{
		$heart->redirect('content.php?show=editWeb-development&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==125 || $_REQUEST['id']==15)
	{
		$heart->redirect('content.php?show=editSoftware-development&id='.$_REQUEST['id']);
	}
	if($_REQUEST['id']==126 || $_REQUEST['id']==16)
	{
		$heart->redirect('content.php?show=editCodeigniter-development&id='.$_REQUEST['id']);
	}
	
exit();
break;
// update record
case'updateTerms':
		$pageheading  =  addslashes($_REQUEST['desc1']);
		$desc         =  addslashes($_REQUEST['desc2']);
		$desc1        =  addslashes($_REQUEST['desc3']);

		$sql1="UPDATE ".$cfg['DB_TERMS']." SET
		       `desc1` = '".$pageheading."',
		       `desc2` = '".$desc."',
		       `desc3` = '".$desc1."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
        $heart->redirect('content.php?show=viewTerms&m=2&id='.$_REQUEST['id']);
exit();
break;

case'updateRefund':
		$pageheading  =  addslashes($_REQUEST['desc1']);
		$desc         =  addslashes($_REQUEST['desc2']);
		$desc1        =  addslashes($_REQUEST['desc3']);

		$sql1="UPDATE ".$cfg['DB_PRODUCT_REFUND']." SET
		       `desc1` = '".$pageheading."',
		       `desc2` = '".$desc."',
		       `desc3` = '".$desc1."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
        $heart->redirect('content.php?show=viewRefund&m=2&id='.$_REQUEST['id']);
exit();
break;
case'updatePrivacy':
//print_r($_REQUEST); die();
		$heading  	  =  addslashes($_REQUEST['heading']);
		$pageheading  =  addslashes($_REQUEST['desc1']);
		$desc         =  addslashes($_REQUEST['desc2']);
		$desc1        =  addslashes($_REQUEST['desc3']);

		$sql1="UPDATE ".$cfg['DB_PRIVACY']." SET
			   `heading`	= '".$heading."',
		       `desc1` 		= '".$pageheading."',
		       `desc2` 		= '".$desc."',
		       `desc3` 		= '".$desc1."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
        $heart->redirect('content.php?show=viewPrivacy&m=2&id='.$_REQUEST['id']);

exit();
break;
case'updateContact':
		$pageheading=addslashes($_REQUEST['pageheading']);
		$address=addslashes($_REQUEST['address']);
		$address2=addslashes($_REQUEST['address2']);
		$address3=addslashes($_REQUEST['address3']);
		$phone1=addslashes($_REQUEST['phone1']);
		$phone2=addslashes($_REQUEST['phone2']);
		$tel=addslashes($_REQUEST['tel']);
		$email=addslashes($_REQUEST['email']);
		$order_email=addslashes($_REQUEST['order_email']);
		$manager_email=addslashes($_REQUEST['manager_email']);
		$ph1 = $_FILES['image']['name'];
	   	$a31 = $_FILES['image']['tmp_name'];
	   	$last_id = 'Contact';
	   	if($ph1!=''){
	   		$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
			
			//echo $value;
			chmod($path1,0777);
			copy($a31,$path1);
			chmod($path1,0777);
			$sql1="UPDATE ".$cfg['DB_CONTACT_US']." SET
						       `heading` = '".$pageheading."',
						       `address` = '".$address."',
						       `address2` = '".$address2."',
						       `address3` = '".$address3."',
						       `phone1` = '".$phone1."',
						       `phone2` = '".$phone2."',
						       `tel` = '".$tel."',
						       `email` = '".$email."',
						       `image` = '".$value1."',
						       `imgAlt`= '".$_REQUEST['imgAlt']."'
						       `order_email` = '".$order_email."',
						       `manager_email` = '".$manager_email."'
						        WHERE `id` = '".$_REQUEST['id']."' ";
			$heart->sql_query($sql1);
		}else{
			$sql1="UPDATE ".$cfg['DB_CONTACT_US']." SET
						       `heading` = '".$pageheading."',
						       `address` = '".$address."',
						       `address2` = '".$address2."',
						       `address3` = '".$address3."',
						       `phone1` = '".$phone1."',
						       `phone2` = '".$phone2."',
						       `tel` = '".$tel."',
						       `email` = '".$email."',
						       `imgAlt`= '".$_REQUEST['imgAlt']."',
						       `order_email` = '".$order_email."',
						       `manager_email` = '".$manager_email."'
						        WHERE `id` = '".$_REQUEST['id']."' ";
			$heart->sql_query($sql1);
		}
$heart->redirect('content.php?show=viewContact&m=2&id='.$_REQUEST['id']);
exit();
break;
case'update':
   //$banner_id = $_REQUEST['id'];
	/*print_r($_REQUEST); 
	print_r($_FILES);
	die();*/
       $pageheading=addslashes($_REQUEST['pageheading']);
       $title=addslashes($_REQUEST['title']);
       $description1=addslashes($_REQUEST['description1']);
       $description2=addslashes($_REQUEST['description2']);
       $ph1 = $_FILES['image1_add']['name'];
	   $a31 = $_FILES['image1_add']['tmp_name'];
	   $ph2 = $_FILES['image2_add']['name'];
	   $a32 = $_FILES['image2_add']['tmp_name'];
	   $last_id = 'content';
	if($ph1!='' || $ph2!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		    $file_ext2=explode(".",$ph2);
			$ext2= strtolower($file_ext2[count($file_ext2)-1]);
			$value2=$last_id."_".$last_id.".".$ext2;
			$path2="../images/".$value2;
				
				//echo $value;
				chmod($path2,0777);
				copy($a32,$path2);
				chmod($path2,0777);		
	 	$sql1="UPDATE ".$cfg['DB_PRODUCT_ABOUTUS']." SET
	       `title1` = '".$pageheading."',
	       `title2` = '".$title."',
	       `desc1` = '".$description1."',
	       `desc2` = '".$description2."',
	       `image1` = '".$value1."',
	       `image2` = '".$value2."'
	        WHERE `id` = '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}
	elseif($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);
		
	$sql1="UPDATE ".$cfg['DB_PRODUCT_ABOUTUS']." SET
	       `title1` = '".$pageheading."',
	       `title2` = '".$title."',
	       `desc1` = '".$description1."',
	       `desc2` = '".$description2."',
	       `image1` = '".$value1."'
	        WHERE `id` = '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}
	elseif($ph2!='')
	{

		    $file_ext2=explode(".",$ph2);
			$ext2= strtolower($file_ext2[count($file_ext2)-1]);
			$value2=$last_id."_".$last_id.".".$ext2;
			$path2="../images/".$value2;
				
				//echo $value;
				chmod($path2,0777);
				copy($a32,$path2);
				chmod($path2,0777);		
	$sql1="UPDATE ".$cfg['DB_PRODUCT_ABOUTUS']." SET
	       `title1` = '".$pageheading."',
	       `title2` = '".$title."',
	       `desc1` = '".$description1."',
	       `desc2` = '".$description2."'
	       `image2` = '".$value2."'
	        WHERE `id` = '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}
	else
	{
	$sql1="UPDATE ".$cfg['DB_PRODUCT_ABOUTUS']." SET
	       `title1` = '".$pageheading."',
	       `title2` = '".$title."',
	       `desc1` = '".$description1."',
	       `desc2` = '".$description2."'
	        WHERE `id` = '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=view&m=2&id='.$_REQUEST['id']);
break;

case'updateClientBanner':
  
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   
	   $last_id = 'clientBanner';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_CLIENT_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_CLIENT_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewClient&m=2&id='.$_REQUEST['redirect_id']);
break;

case'updatePortfollioBanner':
  
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   
	   $last_id = 'PortfolioBanner';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_PORTFOLIO_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_PORTFOLIO_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewPortfollio&m=2&id='.$_REQUEST['redirect_id']);
break;

case'updateTechSupportBanner':
  
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'TechSupport';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewTechSupport&m=2&id='.$_REQUEST['redirect_id']);
break;

case'updateIt-ServiceBanner':
  
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'IT';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewIt-service&m=2&id='.$_REQUEST['redirect_id']);
break;

case'update_ComputerTraining_Banner':
  
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'computerTarin';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
	$heart->redirect('content.php?show=viewComputer-training&m=2&id='.$_REQUEST['redirect_id']);
	break;


case 'update_MobileDevelopment_banner':
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'mobileDevelopment';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewMobile-development&m=2&id='.$_REQUEST['redirect_id']);
break;

case 'update_EcommerceDevelopment_banner':
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'ecommerceDevelopment';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewEcommerce-development&m=2&id='.$_REQUEST['redirect_id']);
break;

case 'update_WebDesigning_banner':
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'webDesigning';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewWeb-designing&m=2&id='.$_REQUEST['redirect_id']);
break;

case 'update_WebDevelopment_banner':
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'webDevelopment';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewWeb-development&m=2&id='.$_REQUEST['redirect_id']);
break;

case 'update_SoftwareDevelopment_banner':
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'softDevelopment';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewSoftware-development&m=2&id='.$_REQUEST['redirect_id']);
break;


case 'update_CodeigniterDevelopment_banner':
       $BannerTitle=addslashes($_REQUEST['BannerTitle']);
       $altTag=addslashes($_REQUEST['altTag']);
       $ph1 = $_FILES['image']['name'];
	   $a31 = $_FILES['image']['tmp_name'];
	   $last_id = 'codeDevelopment';
	if($ph1!='')
	{

			$file_ext1=explode(".",$ph1);
			$ext1= strtolower($file_ext1[count($file_ext1)-1]);
			$value1=$last_id."_".$last_id.".".$ext1;
			$path1="../images/".$value1;
				
				//echo $value;
				chmod($path1,0777);
				copy($a31,$path1);
				chmod($path1,0777);

		   	
	 	$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
	       `BannerTitle` = '".$BannerTitle."',
	       `altTag` 	= '".$altTag."',
	       `bannerImg` 	= '".$value1."'
	        WHERE `id` 	= '".$_REQUEST['id']."' ";
	$heart->sql_query($sql1);
	}else{
		$sql1="UPDATE ".$cfg['DB_SERVICE_BANNER']." SET
		       `BannerTitle` = '".$BannerTitle."',
		     	`altTag` 	= '".$altTag."'
		        WHERE `id` = '".$_REQUEST['id']."' ";
		$heart->sql_query($sql1);
	}
       
	$heart->redirect('content.php?show=viewCodeigniter-development&m=2&id='.$_REQUEST['redirect_id']);
break;

//show add window
case'add':
	$heart->redirect('content.php?show=add');	
break;
//change status

case'Active':
$sql="UPDATE ".$cfg['DB_PAGECONTENT']." SET 
	 `cmsStatus` ='A' 
	  WHERE `cmsId` = '".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
     $heart->redirect('content.php');

break;
case'Inactive':
$sql="UPDATE ".$cfg['DB_PAGECONTENT']." SET 
	 `cmsStatus` = 'I' 
	  WHERE `cmsId` = '".$_REQUEST['id']."'";
	 $heart->sql_query($sql);
	 $heart->redirect('content.php');

break;
//insert record 
case 'insert':
    $pageheading=$_REQUEST['pageheading'];
	$description=nl2br($_REQUEST['description']);
	
	$sql="INSERT INTO ".$cfg['DB_PAGECONTENT']." ( `cmsName`,`content` , `cmsStatus`) 
	VALUES ( '".$pageheading."', '".$description."', 'A')";
	$heart->sql_query($sql);
	header("Location:$cfg[PAGE_NAME]?m=2");
	$heart->redirect('content.php?m=1');
break;
//default view

}
?>