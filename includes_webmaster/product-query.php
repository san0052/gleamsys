<?php
//if($_REQUEST['category']!=''){ 
//$cats = "AND `category`=".$_REQUEST['category']." ORDER BY `pd_id` ASC"; 
//$pagenames = "Products Under Category - ".getcategoryname($_REQUEST['category']);
//$types = 'Category';
//$absentmessage = 'No Product(s) Found under this Category.';
//}
//if($_REQUEST['location']!=''){ 
//$cats = "AND `location`=".$_REQUEST['location']." ORDER BY `pd_id` ASC"; 
//$pagenames = "Products Under Location - ".getlocationname($_REQUEST['location']);
//$types = 'Location';
//$absentmessage = 'No Product(s) Found under this Location.';
//}
//if($_REQUEST['range']!=''){ 
//$cats = "AND ".getrangedetails($_REQUEST['range'],'range')." ORDER BY `pd_price` ASC"; 
//$pagenames = "Products Under Price Range - ".getrangedetails($_REQUEST['range'],'range_name');
//$types = 'PriceRange';
//$absentmessage = 'No Product(s) Found under this Price Range.';
//}
//if($_REQUEST['category']==''  && $_REQUEST['location']=='' && $_REQUEST['range']==''){
//$cats =' ORDER BY `pd_id` ASC';
//$pagenames = 'All Products';
//$absentmessage = 'No Product(s) Found.';
//}
//$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `status`='A' $cats";
//$res=$heart->sql_query($sql);
//$num = $heart->sql_numrows($res);
//$num1 = $heart->sql_numrows($res);



if($_REQUEST['category']!='')
{ 
//print_r($_REQUEST['category']);
//$cat = explode(',',$_REQUEST['category']);
//print_r($cat);
$cats = "AND `category` IN ( '".$_REQUEST['category']."') ORDER BY `pd_id` ASC"; 
//$cats = "AND `category`like '%,".$_REQUEST['category'].",%' OR `category`like '%".$_REQUEST['category']."%,' ORDER BY `pd_id` ASC"; 
$pagenames = "Products Under Category - ".getcategoryname($_REQUEST['category']);			
$absentmessage = 'No Product(s) Found under this Category.';
}	


if($_REQUEST['act']=='search')
{

if($_REQUEST['max']=='above')
{
$cats = "AND`pd_price` >= '".$_REQUEST['min']."'  ";
$pagenames = "Products above the price - ".$_REQUEST['min'];
$absentmessage = 'No Product(s) Found under this Category.';

}
else
{

$cats = "AND`pd_price` between '".$_REQUEST['min']."' and '".$_REQUEST['max']."' ";
$pagenames = "Products between the price range - ".$_REQUEST['min']." and ".$_REQUEST['max']." ";
$absentmessage = 'No Product(s) Found under this Category.';
}
}



$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `status`='A' AND `siteId`='".$_SESSION['site']."' AND `mainaddon`='0'$cats " ;
$result=$heart->sql_query($sql);
$num = $heart->sql_numrows($result);
$sql1 = $sql. " LIMIT $offset,$limit";	
$result1=$heart->sql_query($sql1);
?>
