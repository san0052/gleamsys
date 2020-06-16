<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){

//show all record
case'view':
	$heart->redirect('delPincode.php?show=view&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
exit();
break;
// show edit window
case'edit':
	$heart->redirect('delPincode.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
exit();
break;
//delete record
case 'del':
	
     $sql="DELETE FROM" .$cfg['DB_PINCODES']. "WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 
	$heart->redirect('delPincode.php?m=3&pageno='.$_REQUEST['pageno']);
break; 
case 'insert':

	$postOfficeName = addslashes($_REQUEST['post_office_name']);
	$pincode        = addslashes($_REQUEST['pincode']);	
	$city           = addslashes($_REQUEST['city']);
	$district       = addslashes($_REQUEST['district']);
	$state       = addslashes($_REQUEST['state']);
	$country       = addslashes($_REQUEST['country']);

		
$sql="INSERT INTO ".$cfg['DB_PINCODES']." SET 
				`PostOfficeName` = '".$postOfficeName."',
				`Pincode` = '".$pincode."',	
				`City` = '".$city."',
				`District` = '".$district."',
				`State`='".$state."',
				`country`='".$country."'
			    " ;	
	    $heart->sql_query($sql);
			 
	    $last_id=mysql_insert_id();
	 
	$heart->redirect('delPincode.php?category='.$_REQUEST['secpid'].'&m=1');
	$heart->redirect('delPincode.php?&m=1');
break;
// update record

//show add window
case'add':
	$heart->redirect('delPincode.php?show=add&pageno='.$_REQUEST['pageno']);	
break;
//change status

case'Active':
  $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`status` = 'A'  WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
 $heart->redirect('delPincode.php?m=2&pageno='.$_REQUEST['pageno']);
	 

break;
case'Inactive':
 
  $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('delPincode.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case'mulactive':
 $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`status` = 'A' WHERE id IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $heart->redirect('delPincode.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive':
 $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);

	 $heart->redirect('delPincode.php?m=2&pageno='.$_REQUEST['pageno']);

break;
//insert record 
//default view
/* ------------------------ TYPE START ------------------------------------------------*/

case 'update':
	
	$postOfficeName = addslashes($_REQUEST['post_office_name']);
	$pincode        = addslashes($_REQUEST['pincode']);
	$city           = addslashes($_REQUEST['city']);
	$district       = addslashes($_REQUEST['district']);
	$state          = addslashes($_REQUEST['state']);
	
		
	
		$sql="UPDATE ".$cfg['DB_PINCODES']."
			 SET 			
			`PostOfficeName` = '".$postOfficeName."',
			`Pincode` = '".$pincode."',
			`City` = '".$city."',
			`District` = '".$district."',
			`State` = '".$state."',
			`status`='A'
			WHERE `id`=".$_REQUEST['id']." ";

			$heart->sql_query($sql);
			$last_id=$_REQUEST['id'];

      	$heart->redirect('delPincode.php?&m=2&pageno='.$pageno);
	
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
	$desc=(addslashes($_REQUEST['prod_desc_add']!=""))?addslashes($_REQUEST['prod_desc_add']):'';
	$pf=addslashes(($_REQUEST['fp']!=""))?'A':'I';
	$pr=addslashes(($_REQUEST['rp']!=""))?'A':'I';
	$bp=addslashes(($_REQUEST['bp']!=""))?'Y':'N';
		
$sql="INSERT INTO ".$cfg['DB_PINCODES']." SET `pd_name` = '".$pname."',`pd_price` = '".$price."',	`strike_price` = '".$sprice."',	`pd_description` = '".$desc."',`category`='".$cat."',`disclaimer` = '".$prod_dis."',`notes` = '".$prod_note."',`location` = '".$prod_loc."',`pd_date`=NOW(),`pd_featured`='".$pf."',`pd_rightbar`='".$pr."',`pd_bestseller`='".$bp."',`status`='A',`siteId`= '".$cfg['SESSION_SITE']."' " ;	
		$heart->sql_query($sql);
			 
	 $last_id=mysql_insert_id();
	 
	 //insert category in the another table
	 
	 	foreach($cate_id as $key=>$val)
		{
			$sqlorders="INSERT INTO ".$cfg['DB_PINCODES_CAT']." SET `pd_id` = ".$last_id." ,`siteId`= '".$cfg['SESSION_SITE']."',`cat_id` =".$val.",`status`='A' ";
			$heart->sql_query($sqlorders);
		}
	 
	 //insert category in the another table
	 
	 $sqlorders="UPDATE ".$cfg['DB_PINCODES']." SET `order` = ".$last_id.",`isAddon`='Y' WHERE `pd_id` =".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
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
					
					 $sqlup="UPDATE ".$cfg['DB_PINCODES']." SET `pd_image`='".$value."',`pd_code`='".$code."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
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
	$desc=addslashes(($_REQUEST['prod_desc_add']!=""))?addslashes($_REQUEST['prod_desc_add']):'';
	$pf=addslashes(($_REQUEST['fp']=="1"))?'A':'I';
	$pr=addslashes(($_REQUEST['rp']=="1"))?'A':'I';
	$bp=addslashes(($_REQUEST['bp']=="1"))?'Y':'N';		
		
	
		 $sql="UPDATE ".$cfg['DB_PINCODES']."
			 SET 			
			`pd_name` = '".$pname."',
			`pd_unit_price` = '".$prod_unitprice_add."',
			`earliest_deliveryId` = '".$prod_deliv."',
			`pd_price` = '".$price."',
			`strike_price` = '".$sprice."',
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
			 
			$sqld="DELETE FROM ".$cfg['DB_PINCODES_CAT']." WHERE `pd_id` = ".$last_id." ";
			$heart->sql_query($sqld);
			 
			 //deleting existing category from that product from product_cat table...
						 
						 
						 
			 //insert category in the another table
	 
	 	foreach($cate_id as $key=>$val)
		{
			$sqlorders="INSERT INTO ".$cfg['DB_PINCODES_CAT']." SET `pd_id` = ".$last_id." ,`cat_id` =".$val.",`status`='A' ";
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
					
					 $sqlup="UPDATE ".$cfg['DB_PINCODES']." SET `pd_image`='".$value."' WHERE `pd_id`=".$last_id." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
					 $heart->sql_query($sqlup);
			}
			
		}
		$sqlnew1="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'n'";
		$heart->sql_query($sqlnew1); 
		$sqlnew2="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
		$heart->sql_query($sqlnew2); 
      	$heart->redirect('addon.php?&m=2&pageno='.$pageno);	

$heart->redirect('addon.php');

break;

case 'del_addon':
        $sql1="SELECT * FROM ".$cfg['DB_PINCODES']." WHERE  `pd_id` IN (".$_REQUEST['id'].")";
		$res1=$heart->sql_query($sql1);
		while($row1=$heart->sql_fetchrow($res1))
		{
			if($row1['pd_image']!="")
			{
				unlink("../".$cfg['PRODUCT_IMAGES'].$row1['pd_image']);
			}
		}
	
$sql="UPDATE " .$cfg['DB_PINCODES']. " SET `status`='D' WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 
$sqlnew1="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
$sqlnew2="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
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
			 $sql_menu="UPDATE ".$cfg['DB_PINCODES']." SET `order` = ".$value."  WHERE `pd_id` = ".$key." ";	
			 $heart->sql_query($sql_menu);	 
			 }
	 }
     $heart->redirect('delPincode.php?m=4'.$gourl.'&pageno='.$_REQUEST['pageno']);
break;

case 'Active_addon':
  $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`status` = 'A',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
 $heart->redirect('addon.php?m=2&pageno='.$_REQUEST['pageno']);
	 

break;
case 'Inactive_addon':
 
 $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`status` = 'I',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('addon.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case'mulactive_addon':
 $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`status` = 'A' WHERE prod_id IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $sqlnew1="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
$sqlnew2="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('addon.php?m=2&pageno='.$_REQUEST['pageno']);

break;

case'mulinactive_addon':
 $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`status` = 'I' WHERE `prod_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 $sqlnew1="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
$sqlnew2="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
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
<select name="secpid" class="forminputelement" id="secpid" onchange="window.location.href='delPincode.php?category='+this.value">
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
  $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`isAddon` = 'Y',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
 $heart->redirect('alldelPincode.php?m=2&pageno='.$_REQUEST['pageno']);

break;
case 'NotAddon':
 
 $sql="UPDATE ".$cfg['DB_PINCODES']."
	 SET 
	`isAddon` = 'N',`pd_last_update`=NOW() WHERE `pd_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	  $sqlnew1="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'n'";
$heart->sql_query($sqlnew1); 
 $sqlnew2="UPDATE ".$cfg['DB_PINCODES']." SET `new_status` = 'y' WHERE `status`='A' ORDER BY `pd_id` DESC LIMIT 10";
$heart->sql_query($sqlnew2); 
	 $heart->redirect('alldelPincode.php?m=2&pageno='.$_REQUEST['pageno']);

break;case 'catkeylist':$keyid=0;$sql="SELECT DISTINCT keywordid FROM ".$cfg['DB_KEYWORD_CATEGORY_MAP']." WHERE categoryid IN (".$_REQUEST['catid'].")";$res=$heart->sql_query($sql);$numrows=$heart->sql_numrows($res);while($rows=$heart->sql_fetchrow($res)){	if($keyid==0){		$keyid=$rows['keywordid'];	}else{		$keyid=$keyid.','.$rows['keywordid'];	}	}echo $keyid;break;
}				           
?>