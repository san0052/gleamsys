<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){


//show all record
case'view':
	$heart->redirect('customer.php?show=view&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
exit();
break;
// show edit window
case'edit':
	$heart->redirect('customer.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
exit();
break;

case'cust_getstate':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='cust_state_add' id='cust_state_add' class='forminputelement' onchange='getcity_cust(this.value);'>";
$str.="<option value='' >Select State</option>";	
	$sql="SELECT * FROM ".$cfg['DB_STATE']."WHERE `country_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[st_id]>$row[state_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 
break;

case'getcity_cust':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='cust_city_add' id='cust_city_add' class='forminputelement' >";
$str.="<option value='' >Select City</option>";	
	$sql="SELECT * FROM ".$cfg['DB_CITIES']."WHERE `state_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[ct_id]>$row[city_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 else
	 {
	 	echo $str;
	 }
	 
break;

case'bill_getstate':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='bill_state_add' id='bill_state_add' class='forminputelement' onchange='getcity_bill(this.value);'>";
$str.="<option value='' >Select State</option>";	
	$sql="SELECT * FROM ".$cfg['DB_STATE']."WHERE `country_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[st_id]>$row[state_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 
break;

case'getcity_bill':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='bill_city_add' id='bill_city_add' class='forminputelement' >";
$str.="<option value='' >Select City</option>";	
	$sql="SELECT * FROM ".$cfg['DB_CITIES']."WHERE `state_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[ct_id]>$row[city_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 else
	 {
	 	echo $str;
	 }
	 
break;


case'shipp_getstate':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='shipp_state_add' id='shipp_state_add' class='forminputelement' onchange='getcity_shipp(this.value);'>";
$str.="<option value='' >Select State</option>";	
	$sql="SELECT * FROM ".$cfg['DB_STATE']."WHERE `country_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[st_id]>$row[state_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 
break;

case'getcity_shipp':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='shipp_city_add' id='shipp_city_add' class='forminputelement' >";
$str.="<option value='' >Select City</option>";	
	$sql="SELECT * FROM ".$cfg['DB_CITIES']."WHERE `state_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[ct_id]>$row[city_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 else
	 {
	 	echo $str;
	 }
	 
break;

// get state and city edit
case'getstate_edit1':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='cust_state_edit' id='cust_state_edit' class='forminputelement' onchange='getcity_edit1(this.value);'>";
$str.="<option value='' >Select State</option>";	
	$sql="SELECT * FROM ".$cfg['DB_STATE']."WHERE `country_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[st_id]>$row[state_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 
break;

case'getcity_edit1':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='cust_city_edit' id='cust_city_edit' class='forminputelement' >";
$str.="<option value='' >Select City</option>";	
	$sql="SELECT * FROM ".$cfg['DB_CITIES']."WHERE `state_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[ct_id]>$row[city_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 else
	 {
	 	echo $str;
	 }
	 
break;


case'getstate_edit2':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='bill_state_edit' id='bill_state_edit' class='forminputelement' onchange='getcity_edit2(this.value);'>";
$str.="<option value='' >Select State</option>";	
	$sql="SELECT * FROM ".$cfg['DB_STATE']."WHERE `country_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[st_id]>$row[state_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 
break;

case'getcity_edit2':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='bill_city_edit' id='bill_city_edit' class='forminputelement' >";
$str.="<option value='' >Select City</option>";	
	$sql="SELECT * FROM ".$cfg['DB_CITIES']."WHERE `state_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[ct_id]>$row[city_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 else
	 {
	 	echo $str;
	 }
	 
break;

case'getstate_edit3':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='shipp_state_edit' id='shipp_state_edit' class='forminputelement' onchange='getcity_edit3(this.value);'>";
$str.="<option value='' >Select State</option>";	
	$sql="SELECT * FROM ".$cfg['DB_STATE']."WHERE `country_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[st_id]>$row[state_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 
break;

case'getcity_edit3':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='shipp_city_edit' id='shipp_city_edit' class='forminputelement' >";
$str.="<option value='' >Select City</option>";	
	$sql="SELECT * FROM ".$cfg['DB_CITIES']."WHERE `state_id`='".$id."'";
	 $res=$heart->sql_query($sql);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[ct_id]>$row[city_name]</option>";
		}
		$str.="</select>";
		echo $str;
	 }
	 else
	 {
	 	echo $str;
	 }
	 
break;




// Check email id availability for edit customer
case'check_emailedit':
$email=$_REQUEST['email'];
//echo $_REQUEST['id'];
$sql="SELECT * FROM ".$cfg['DB_CUSTOMER']."WHERE `email`='".$email."'";
	 $res=$heart->sql_query($sql);
	 $row=$heart->sql_fetchrow($res);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
	 	if($row['id']==$_REQUEST['id'])
		{
			echo 2;
		}
		else
		{
			echo 1;
		}
	 }
	 else
	 {
	 	echo 0;
	 }
break;

// Check email id availability for add customer
case'check_emailadd':
$email=$_REQUEST['email'];
//echo $_REQUEST['id'];
$sql="SELECT * FROM ".$cfg['DB_CUSTOMER']."WHERE `email`='".$email."'";
	 $res=$heart->sql_query($sql);
	 $row=$heart->sql_fetchrow($res);
	 $maxrow=$heart->sql_numrows($res);
	 if($maxrow >0)
	 {
		echo 1;
	 }
	 else
	 {
	 	echo 0;
	 }
break;

//delete record
case 'del':
 //$sql="SELECT * FROM ".$cfg['DB_CARD_DETAILS']." WHERE `cust_id`='".$_REQUEST['id']."'";
// $res=$heart->sql_query($sql);
// while($row=$heart->sql_fetchrow($res))
// {
// 	$sql2="DELETE FROM  ".$cfg['DB_CARD']." WHERE `id`  =".$row['card_id']."";
//	 $heart->sql_query($sql2);
// }
// $sql1="DELETE FROM  ".$cfg['DB_CARD_DETAILS']." WHERE `cust_id`  =".$_REQUEST['id']."";
//	 $heart->sql_query($sql1);

$sql="SELECT * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE `cust_id`='".$_REQUEST['id']."'";
$res=$heart->sql_query($sql);
while($row=$heart->sql_fetchrow($res))
{
	$sql2="DELETE FROM  ".$cfg['DB_CUSTOMER_DETAILS']."";
	$heart->sql_query($sql2);
}

 $sql="DELETE FROM  ".$cfg['DB_CUSTOMER']." WHERE `id`  =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $heart->redirect('customer.php?m=3&pageno='.$_REQUEST['pageno']);

break;

case 'muldel':
//$sql="SELECT * FROM ".$cfg['DB_CARD_DETAILS']." WHERE `cust_id` IN (".$_REQUEST['id'].")";
// $res=$heart->sql_query($sql);
// while($row=$heart->sql_fetchrow($res))
// {
// 	$sql2="DELETE FROM  ".$cfg['DB_CARD']." WHERE `id`  =".$row['card_id']."";
//	$heart->sql_query($sql2);
// }
// $sql1="DELETE FROM  ".$cfg['DB_CARD_DETAILS']." WHERE `cust_id` IN (".$_REQUEST['id'].")";
//	 $heart->sql_query($sql1);

$sql="SELECT * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE `cust_id`IN (".$_REQUEST['id'].")";
$res=$heart->sql_query($sql);
while($row=$heart->sql_fetchrow($res))
{
	$sql2="DELETE FROM  ".$cfg['DB_CUSTOMER_DETAILS']."";
	$heart->sql_query($sql2);
}


$sql="DELETE FROM  ".$cfg['DB_CUSTOMER']." WHERE `id`  IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	
	 $heart->redirect('customer.php?m=3&pageno='.$_REQUEST['pageno']);
break;
	 
case 'insert':

     $cust_email=$_REQUEST['cust_email_add'];
     $cust_pass=$heart->encoded($_REQUEST['cust_pass_add']);
     $cust_name=addslashes($_REQUEST['cust_name_add']);
     $cust_phone=addslashes($_REQUEST['cust_phone_add']);
     $cust_address=addslashes($_REQUEST['cust_addr_add']);
     $cust_country=addslashes($_REQUEST['cust_country_add']);
     $cust_state=addslashes($_REQUEST['cust_state_add']);
     $cust_city=addslashes($_REQUEST['cust_city_add']);
     $cust_zip=addslashes($_REQUEST['cust_zip_add']);
	 $sql1="INSERT INTO ".$cfg['DB_CUSTOMER']."
						 SET `email` = '".$cust_email."',
							 `password` = '".$cust_pass."',
							 `name` = '".$cust_name."',
							 `contact` = '".$cust_phone."',
							 `address` = '".$cust_address."',
							 `country_id` = '".$cust_country."',
							 `state` = '".$cust_state."',
							 `city_id` = '".$cust_city."',
						 	 `zip` = '".$cust_zip."',
							 `status`='I',
							 `date`=NOW()";
	 $heart->sql_query($sql1);
	 $customer_id=mysql_insert_id();
	 $sqlchecknews="SELECT * FROM ".$cfg['DB_NEWSLETTER_EMAIL']." WHERE  `email` ='".$cust_email."'";
	 $reschecknews=$heart->sql_query($sqlchecknews);
	 $numchecknews=$heart->sql_numrows($reschecknews);
	 if($numchecknews==0){
		 $sql_src="INSERT INTO ".$cfg['DB_NEWSLETTER_EMAIL']." 
		 							SET `siteId` = '".$cfg['SESSION_SITE']."',
		 								`name` = '".$cust_name."',
		 								`email` = '".$cust_email."',
		 							    `date` = NOW(),
		 							    `status` = 'A'";
		 $heart->sql_query($sql_src);
	 }
   
	 
	 // insert billing details
	 
	$bill_fname=$_REQUEST['bill_fname_add'];
	$bill_lname=$_REQUEST['bill_lname_add'];
	$bill_addr=$_REQUEST['bill_addr_add'];
	$bill_phone=$_REQUEST['bill_phone_add'];
	$bill_country=$_REQUEST['bill_country_add'];
	$bill_city=$_REQUEST['bill_city_add'];
	$bill_state=$_REQUEST['bill_state_add'];
	$bill_pin=$_REQUEST['bill_pin_add'];
	$bill_gender=$_REQUEST['bill_salutation_add'];
	
	 $sql3="INSERT INTO ".$cfg['DB_CUSTOMER_DETAILS']."
	 SET 
	`fname` = '".addslashes($bill_fname)."',
	`lname` = '".addslashes($bill_lname)."',
	`cust_id`='".$customer_id."',
	`address` = '".addslashes($bill_addr)."',
	`phone` = '".$bill_phone."',
	`country`='".$bill_country."',
	`city` = '".$bill_city."',
	`state` = '".$bill_state."',
	`pincode` = '".$bill_pin."',
	`details`='billing',
	`siteId` ='".$cfg['SESSION_SITE']."',
	`salutation`='".$bill_gender."'";
	 $heart->sql_query($sql3);
	 
	 // insert shipping details
	 
	$shipp_fname=$_REQUEST['shipp_fname_add'];
	$shipp_lname=$_REQUEST['shipp_lname_add'];	
	$shipp_addr=$_REQUEST['shipp_addr_add'];
	$shipp_phone=$_REQUEST['shipp_phone_add'];
	$shipp_country=$_REQUEST['shipp_country_add'];
	$shipp_city=$_REQUEST['shipp_city_add'];
	$shipp_state=$_REQUEST['shipp_state_add'];
	$shipp_pin=$_REQUEST['shipp_pin_add'];
	$shipp_gender=$_REQUEST['shipp_salutation_add'];
	
	  $sql4="INSERT INTO ".$cfg['DB_CUSTOMER_DETAILS']."
	 SET 
	`fname` = '".addslashes($shipp_fname)."',
	`lname` = '".addslashes($shipp_lname)."',
	`cust_id`='".$customer_id."',
	`address` = '".addslashes($shipp_addr)."',
	`phone` = '".$shipp_phone."',
	`country`='".$shipp_country."',
	`city` = '".$shipp_city."',
	`state` = '".$shipp_state."',
	`pincode` = '".$shipp_pin."',
	`details`='shipping',
	`siteId` ='".$cfg['SESSION_SITE']."',
	`salutation`='".$shipp_gender."'";
	 $heart->sql_query($sql4);
	 
	 
	
	
	 	//$to_name = $cust_fname.' '.$cust_lname;
//		$to_email = $cust_email;
//		$from_name = 'La Meal Carte';
//		$from_email = $cfg['ADMIN_EMAIL'];
//		$subject = 'Confirm Registration';
//		
//			$message = $cust_gender.' '.$cust_fname.'<br>
//			Thank you for registration.</b><br><br>
//		You have successfully registered to our site<br><br>	
//		Please click the link below to view our site<br>
//		 http://underconstruction.in/lmc<br><br>
//			Thank you<br>
//			La Meal Carte';
//	
//		
//		$bcc = '';
//		$heart->send_mail($to_name, $to_email, $from_name, $from_email, $subject, $message, $bcc='');
	 
	 
	$heart->redirect('customer.php?m=1');
break;
// update record

//show add window
case'add':
	$heart->redirect('customer.php?show=add');	
break;
//change status

case'Active':
 $sql="UPDATE ".$cfg['DB_CUSTOMER']."
	 SET 
	`status` = 'A' WHERE id =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $heart->redirect('customer.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case'Inactive':
 $sql="UPDATE ".$cfg['DB_CUSTOMER']."
	 SET 
	`status` = 'I' WHERE id =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	 $heart->redirect('customer.php?m=2&pageno='.$_REQUEST['pageno']);

break;
  case 'mulactive':
    $sql="UPDATE". $cfg['DB_CUSTOMER']. "
	SET
	`status`='A'  WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('customer.php?m=2&pageno='.$_REQUEST['pageno']);
break;

case 'mulinactive':
   $sql="UPDATE" .$cfg['DB_CUSTOMER']."
   SET
   `status`='I' WHERE `id`IN (".$_REQUEST['id'].")"	;
    $heart->sql_query($sql);
	$heart->redirect('customer.php?m=2&pageno='.$_REQUEST['pageno']);
break;
	
//insert record 
//default view
/* ------------------------ TYPE START ------------------------------------------------*/

case 'edit_cust':

	$cust_fname=$_REQUEST['cust_fname_edit'];
	$cust_lname=$_REQUEST['cust_lname_edit'];
	$cust_pass=$heart->encoded($_REQUEST['cust_pass_edit']);
	$cust_email=$_REQUEST['cust_email_edit'];
	$cust_addr=$_REQUEST['cust_addr_edit'];
	$cust_phone=$_REQUEST['cust_phone_edit'];
	$cust_country=$_REQUEST['cust_country_edit'];
	$cust_city=$_REQUEST['cust_city_edit'];
	$cust_state=$_REQUEST['cust_state_edit'];
	$cust_pin=$_REQUEST['cust_pin_edit'];
	$cust_gender=$_REQUEST['cust_salutation_edit'];

	
	$sql="UPDATE ".$cfg['DB_CUSTOMER']."
	 SET 
	`email` = '".$cust_email."',
	`password` = '".$cust_pass."'
	
	 WHERE id =".$_REQUEST['id']."";
	 $heart->sql_query($sql);
	
	$sql_name="UPDATE ".$cfg['DB_CUSTOMER_DETAILS']."
	 SET 
	`fname` = '".addslashes($cust_fname)."',
	`lname` = '".addslashes($cust_lname)."',
	`address` = '".addslashes($cust_addr)."',
	`phone` = '".$cust_phone."',
	`country`='".$cust_country."',
	`city` = '".$cust_city."',
	`state` = '".$cust_state."',
	`pincode` = '".$cust_pin."',
	`salutation`='".$cust_gender."'
	
	 WHERE cust_id =".$_REQUEST['id']." AND `details`='customer'";
	 $heart->sql_query($sql_name);
	
	 // Update shipping information
	$bill_fname=$_REQUEST['bill_fname_edit'];
	$bill_lname=$_REQUEST['bill_lname_edit'];
	$bill_addr=$_REQUEST['bill_addr_edit'];
	$bill_phone=$_REQUEST['bill_phone_edit'];
	$bill_country=$_REQUEST['bill_country_edit'];
	$bill_city=$_REQUEST['bill_city_edit'];
	$bill_state=$_REQUEST['bill_state_edit'];
	$bill_pin=$_REQUEST['bill_pin_edit'];
	$bill_gender=$_REQUEST['bill_salutation_edit'];
	
	$sql1="UPDATE ".$cfg['DB_CUSTOMER_DETAILS']."
	 SET 
	`fname` = '".addslashes($bill_fname)."',
	`lname` = '".addslashes($bill_lname)."',
	`address` = '".addslashes($bill_addr)."',
	`phone` = '".$bill_phone."',
	`country`='".$bill_country."',
	`city` = '".$bill_city."',
	`state` = '".$bill_state."',
	`pincode` = '".$bill_pin."',
	`salutation`='".$bill_gender."'
	 WHERE `cust_id` =".$_REQUEST['id']." AND `details`='billing'";
	 $heart->sql_query($sql1);
	 
	 $shipp_fname=$_REQUEST['shipp_fname_edit'];
	$shipp_lname=$_REQUEST['shipp_lname_edit'];	
	$shipp_addr=$_REQUEST['shipp_addr_edit'];
	$shipp_phone=$_REQUEST['shipp_phone_edit'];
	$shipp_country=$_REQUEST['shipp_country_edit'];
	$shipp_city=$_REQUEST['shipp_city_edit'];
	$shipp_state=$_REQUEST['shipp_state_edit'];
	$shipp_pin=$_REQUEST['shipp_pin_edit'];
	$shipp_gender=$_REQUEST['shipp_salutation_edit'];
	
	  $sql4="UPDATE ".$cfg['DB_CUSTOMER_DETAILS']."
	 SET 
	`fname` = '".addslashes($shipp_fname)."',
	`lname` = '".addslashes($shipp_lname)."',
	`address` = '".addslashes($shipp_addr)."',
	`phone` = '".$shipp_phone."',
	`country`='".$shipp_country."',
	`city` = '".$shipp_city."',
	`state` = '".$shipp_state."',
	`pincode` = '".$shipp_pin."',
	`salutation`='".$shipp_gender."'
	 WHERE `cust_id` =".$_REQUEST['id']." AND `details`='shipping'";
	 $heart->sql_query($sql4);
	
	$heart->redirect('customer.php?m=2&pageno='.$_REQUEST['pageno']);
break;


}
?>