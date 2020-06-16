<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){

case'getstateindex':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='state_name' id='state_name' class='forminputelement' onchange='city_availability_add()' onclick='city_availability_add()'>";
$str.="<option value='' >Select State</option>";	
	$sql="SELECT * FROM ".$cfg['DB_STATE']."WHERE `country_id`='".$id."'  ORDER BY `state_name`";
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

case'getstateindexAdd':
$id=$_REQUEST['id'];
//echo $_REQUEST['id'];

$str="<select name='state_add' id='state_add' class='forminputelement'>";
$str.="<option value='' >Select State</option>";	
	$sql="SELECT * FROM ".$cfg['DB_STATE']."WHERE `country_id`='".$id."'  ORDER BY `state_name`";
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
	 
break;

//show all record
case'view':
	$heart->redirect('city.php?show=view&id='.$_REQUEST['id']);
exit();
break;
// show edit window
case'edit':
	$heart->redirect('city.php?show=category&id='.$_REQUEST['id']);
exit();
break;

case'checkcity':
			
			$city_name=addslashes(trim($_REQUEST['str']));
			$sql1="SELECT * FROM ".$cfg['DB_CITIES']." WHERE  `city_name` ='".$city_name."' AND `state_id`='".$_REQUEST['city']."'";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_numrows($res1);
			if($row1>0)
			{
			  echo 1;
			}
			else
			{
			  echo 0;
			}
break;

case'search_city':
$city=$_REQUEST['city_name'];
$country=$_REQUEST['country_name'];
$state=$_REQUEST['state_name'];
if($city=='' && $country==0 && $state==0)
{
     $heart->redirect('city.php?view=all');
}
else
{
     $heart->redirect('city.php?src_ct='.$city.'&src_country='.$country.'&src_state='.$state);
}
break;

//delete record
case'del_category':
 	 $sql="UPDATE ".$cfg['DB_CITIES']." SET `status`='D' WHERE `ct_id` IN (".$_REQUEST['id'].")";
	 $heart->sql_query($sql);
	 if($_REQUEST['src_ct']=='' && $_REQUEST['src_country']==0 && $_REQUEST['src_state']=='')
     {
	     $heart->redirect('city.php?pageno='.$_REQUEST['pageno'].'&m=3&sid='.$_REQUEST['sid'].'&cid='.$_REQUEST['cid'].'&view='.$_REQUEST['view']);
	 }
	 else
	 {
	    $heart->redirect('city.php?pageno='.$_REQUEST['pageno'].'&m=3&src_ct='.$_REQUEST['src_ct'].'&src_country='.$_REQUEST['src_country'].'&src_state='.$_REQUEST['src_state']);
	 }
break;

//insert record
case 'insert_category':
    $admin_type=addslashes($_REQUEST['category']);
	$mid_price = $_REQUEST['mid_price'];
	$remote_price = $_REQUEST['remote_price'];
	$fixed_price = $_REQUEST['fixed_price'];
	if($_REQUEST['display_city']=='Yes')
	{
		$display=$_REQUEST['display_city'];
	}
	else
	{
		$display='No';
	}
	if($_REQUEST['display_fortext']=='Y')
	{
		$text='Y';
	}
	else
	{
		$text='N';
	}
	$sql="	INSERT INTO ".$cfg['DB_CITIES']."	 
				    SET  `city_name` = '".$admin_type."',
						 `state_id`='".$_REQUEST['state_add']."',
						 `status`='A',
						 `midnight_delivery_price` = '".$mid_price."',
						 `remote_area_delivery_price` = '".$remote_price."',
						 `fixed_time_delivery_price` = '".$fixed_price."'";
	$heart->sql_query($sql);
	$heart->redirect('city.php?pageno='.$_REQUEST['pageno'].'&m=1&sid='.$_REQUEST['sid'].'&cid='.$_REQUEST['cid'].'&view='.$_REQUEST['view']);

break;

//edit record
case 'edit_category':
 	$city=addslashes($_REQUEST['category_edit']);
	$mid_price_edit=$_REQUEST['mid_price_edit'];
	$remote_price_edit=$_REQUEST['remote_price_edit'];
	$fixed_price_edit=$_REQUEST['fixed_price_edit'];

	if($_REQUEST['display_city']=='Yes')
	{
		$display=$_REQUEST['display_city'];
	}
	else
	{
		$display='No';
	}
	if($_REQUEST['display_fortext']=='Y')
	{
		$text='Y';
	}
	else
	{
		$text='N';
	}
	if($city!=''){
	
	//echo "@@@@";die();
	  $sql="	UPDATE ".$cfg['DB_CITIES']." 
	  			  SET   `city_name` = '".$city."',
				  	    `state_id` ='".$_REQUEST['state_add']."',
					    `status`= 'A',
						`midnight_delivery_price` = '".$mid_price_edit."',
						`remote_area_delivery_price` = '".$remote_price_edit."',
						`fixed_time_delivery_price` = '".$fixed_price_edit."'
			    WHERE   `ct_id`=".$_REQUEST['cityid'];
	  $heart->sql_query($sql);
	}
	/*else
	{
	
	//echo "bbb";die();
    $sql="UPDATE ".$cfg['DB_CITIES']."	 SET  `display_status`='".$display."',`ForTextProject`='".$text."',
         `state_id`='".$_REQUEST['state_add']."' ,`status`='A'  WHERE `ct_id`=".$_REQUEST['cityid'];
	$heart->sql_query($sql);
	}*/
	$heart->redirect('city.php?pageno='.$_REQUEST['pageno'].'&m=2&sid='.$_REQUEST['sid'].'&cid='.$_REQUEST['cid'].'&view='.$_REQUEST['view']);

break;


case'InactiveCat':
    $sql="UPDATE ".$cfg['DB_CITIES']." SET 
	     `status` = 'I' WHERE `ct_id` IN (".$_REQUEST['id'].")";
    $heart->sql_query($sql);
	if($_REQUEST['src_ct']=='' && $_REQUEST['src_country']==0 && $_REQUEST['src_state']=='')
    {
        $heart->redirect('city.php?pageno='.$_REQUEST['pageno'].'&m=2&view='.$_REQUEST['view']);
    }
	else
	{
	    $heart->redirect('city.php?pageno='.$_REQUEST['pageno'].'&m=2&src_ct='.$_REQUEST['src_ct'].'&src_country='.$_REQUEST['src_country'].'&src_state='.$_REQUEST['src_state']);
	}
break;


case'ActiveCat':
    $sql="UPDATE ".$cfg['DB_CITIES']." SET 
	     `status` = 'A' WHERE `ct_id` IN (".$_REQUEST['id'].")";
    $heart->sql_query($sql);
	if($_REQUEST['src_ct']=='' && $_REQUEST['src_country']==0 && $_REQUEST['src_state']=='')
    {
        $heart->redirect('city.php?pageno='.$_REQUEST['pageno'].'&m=2&view='.$_REQUEST['view']);
    }
	else
	{
	    $heart->redirect('city.php?pageno='.$_REQUEST['pageno'].'&m=2&src_ct='.$_REQUEST['src_ct'].'&src_country='.$_REQUEST['src_country'].'&src_state='.$_REQUEST['src_state']);
	}
break;
}
?>