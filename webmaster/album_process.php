<?

include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');

//die("************111111");

$act=@$_REQUEST['act']; 

//echo $act;



switch($act){

case 'insert':





if($_REQUEST['pId']==0)

{

 $sql="INSERT INTO " .$cfg['DB_ALBUM']. " (`name`,`status`,`content`) VALUES ( '".$_REQUEST['cat_name']."','A','".$_REQUEST['cat_name']."')";

}

if($_REQUEST['pId']!=0 && $_REQUEST['secpid']==0)   

{

 $sql="INSERT INTO " .$cfg['DB_ALBUM']. " (`name`,`status`,`content`) VALUES ( '".$_REQUEST['cat_name']."','A','".$_REQUEST['cat_name']."')";

} 

if($_REQUEST['pId']!=0 && $_REQUEST['secpid']!=0 )   

{

$sql="INSERT INTO " .$cfg['DB_ALBUM']. " (`name`,`status`,`content`) VALUES ( '".$_REQUEST['cat_name']."','A','".$_REQUEST['cat_name']."')";

}  

 



	$heart->sql_query($sql);

	$ids = mysql_insert_id();

	$ch=($_REQUEST['ch1']!="")?'Y':'N';

	/* $sql1="UPDATE ".$cfg['DB_ALBUM']."

	 SET 

	`order` = ".$ids.",`show_in_top_menu` = '".$ch."' WHERE `id` =".$ids." AND `siteId`='".$cfg['SESSION_SITE']."'" ;

	 $heart->sql_query($sql1);
*/


	$heart->redirect('album.php?m=1&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);

break;



case'add':



	$heart->redirect('album.php?show=add&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);	

break;



case'edit':



	$heart->redirect('album.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);



break;



case'del':



 $sql="UPDATE ".$cfg['DB_ALBUM']."

	 SET 

	`status` = 'D' WHERE `id`=".$_REQUEST['id']."";

	 $heart->sql_query($sql);

	 $sql1="UPDATE ".$cfg['DB_ALBUM']."

	 SET 

	`status` = 'D' WHERE `albumid`=".$_REQUEST['id']."";

	 $heart->sql_query($sql1);

	 $heart->redirect('album.php?m=3&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);

break;



case 'muldel':



 $sql="UPDATE ".$cfg['DB_ALBUM']."

	 SET 

	`status` = 'D' 

	WHERE `id`IN (".$_REQUEST['id'].")";

	 $heart->sql_query($sql);

	  $sql="UPDATE ".$cfg['DB_ALBUM']."

	 SET 

	`status` = 'D' WHERE `albumid`IN (".$_REQUEST['id'].")";

	 $heart->sql_query($sql);

	$heart->redirect('album.php?m=3&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);

break;



case 'Active':



 $sql="UPDATE ".$cfg['DB_ALBUM']."

	 SET 

	`status` = 'A' WHERE `id` =".$_REQUEST['id']."";

	 $heart->sql_query($sql);

	 $heart->redirect('album.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);



break;

case 'Inactive':



 $sql="UPDATE ".$cfg['DB_ALBUM']."

	 SET 

	`status` = 'I' WHERE `id` =".$_REQUEST['id']."";

	 $heart->sql_query($sql);

	$heart->redirect('album.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);



break;

case 'mulactive':



 $sql="UPDATE ".$cfg['DB_ALBUM']."

	 SET 

	`status` = 'A' WHERE `id` IN (".$_REQUEST['id'].")";

	 $heart->sql_query($sql);

	

	 $heart->redirect('album.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);



break;



case'mulinactive':



 $sql="UPDATE ".$cfg['DB_ALBUM']."

	 SET 

	`status` = 'I' WHERE `id` IN (".$_REQUEST['id'].")";

	 $heart->sql_query($sql);

	 

	 $heart->redirect('album.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);



break;



case 'edit_category':

// echo $_REQUEST['secpid1'];

  if($_REQUEST['ch1']=="Y"){
		$sql="UPDATE ".$cfg['DB_ALBUM']." SET `name` = '".$_REQUEST['cat_name']."',`content`='".$_REQUEST['cat_name']."'  WHERE `id`=".$_REQUEST['typeids']."";
	}
	else{
		$sql="UPDATE ".$cfg['DB_ALBUM']."	 SET 	`content`='".$_REQUEST['cat_name']."',`name` = '".$_REQUEST['cat_name']."'WHERE `id`=".$_REQUEST['typeids']."";
	}
	
	$heart->sql_query($sql);

 

 
	

	$heart->redirect('album.php?m=2&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);



break;

case'order':

     $catorder=array();

	 $catorder=$_REQUEST['catorder'];

	 foreach($catorder as $key => $value)

	 {

	 $num=is_numeric($value);

			 if($num==1)

			 {

			 $sql_menu="UPDATE ".$cfg['DB_ALBUM']." SET `order` = ".$value."  WHERE `id` = ".$key." ";	

			 $heart->sql_query($sql_menu);	 

			 }

	 }

     $heart->redirect('album.php?m=4&pageno='.$_REQUEST['pageno'].'&secpid='.$_REQUEST['secpid'].'&pId='.$_REQUEST['pId']);

break;



case'getsec_category':

$id=$_REQUEST['id'];

//echo $_REQUEST['id'];







$sql="SELECT * FROM ".$cfg['DB_ALBUM']."WHERE `status`='A' AND `cat_parent_id`='".$_REQUEST['id']."' AND `siteId`= '".$cfg['SESSION_SITE']."' ";

	 $res=$heart->sql_query($sql);

	 $maxrow=$heart->sql_numrows($res);

	 if($maxrow >0)

	 {

	 $str="<select name=\"secpid\" id=\"secpid\" class=\"forminputelement\" onchange=\"category_availability();\">";

$str.="<option value='0' >Select Second parent</option>";	

	 	 while($row=$heart->sql_fetchrow($res))

		 {

			$str.="<option value=$row[id]>$row[name]</option>";

		}

		$str.="</select>";

		echo $str;

	 }else{

	 $str="<select name=\"secpid\" id=\"secpid\" class=\"forminputelement\" onchange=\"category_availability();\" disabled=\"disabled\">";

$str.="<option value='0' >No Subcategory Found</option>";	

	 $str.="</select>";

		echo $str;

		}

	 

break;



// get state and city edit

case'getsec_category1':

$id=$_REQUEST['id'];

//echo $_REQUEST['id'];





	$sql="SELECT * FROM ".$cfg['DB_CATEGORY']."WHERE `status`='A' AND `cat_parent_id`='".$_REQUEST['id']."' AND `siteId`= '".$cfg['SESSION_SITE']."'  ";

	 $res=$heart->sql_query($sql);

	 $maxrow=$heart->sql_numrows($res);

	 if($maxrow >0)

	 {

	 

	 $str="<select name='secpid1' id='secpid1' class='forminputelement' onchange='category_availability();' >";

$str.="<option value='' >Select Second parent</option>";	

	 	 while($row=$heart->sql_fetchrow($res))

		 {

			$str.="<option value=$row[id]>$row[name]</option>";

		}

		$str.="</select>";

		echo $str;

	 }else{

	 $str="<select name='secpid1' id='secpid1' class='forminputelement' onchange='category_availability();' disabled=\"disabled\">";

$str.="<option value='' >No Second parent Found</option>";	

$str.="</select>";

		echo $str;

		}



	 

break;





}





?>
