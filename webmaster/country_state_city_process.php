<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act){

// Generate City List
case'GetCityIndex':
	$value=$_REQUEST['value'];
	
	$CityControlName=$_REQUEST['CityControlName'];
	$CityPlaceHolder=$_REQUEST['CityPlaceHolder'];
	
	$str="<select name='".$CityControlName."' id='".$CityControlName."' style='width:227px;'>";
	$str.="<option value='' >-- Select City --</option>";	
	$sql="SELECT * FROM ".$cfg['DB_CITIES']."WHERE `state_id`='".$value."'  ORDER BY `city_name`";
	$res=$heart->sql_query($sql);
	$maxrow=$heart->sql_numrows($res);
	if($maxrow >0)
	{
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[ct_id]>$row[city_name]</option>";
		 }
	}
	$str.="</select>|||||".$CityPlaceHolder;
	echo $str;
exit();
break;

// Generate State List
case'GetStateIndex':
    $value=$_REQUEST['value'];
	$StateControlName=$_REQUEST['StateControlName'];
	$StatePlaceHolder=$_REQUEST['StatePlaceHolder'];
	
	$CityControlName=$_REQUEST['CityControlName'];
	$CityPlaceHolder=$_REQUEST['CityPlaceHolder'];
	
   $str="<select name='".$StateControlName."' id='".$StateControlName."' style='width:227px;' onchange=\"getCityList(this.value,'$CityControlName','$CityPlaceHolder')\">";
	$str.="<option value=''>-- Select State --</option>";	
	$sql="SELECT * FROM ".$cfg['DB_STATE']."WHERE `country_id`='".$value."'  ORDER BY `state_name`";
	$res=$heart->sql_query($sql);
	$maxrow=$heart->sql_numrows($res);
	if($maxrow >0)
	{
	 	 while($row=$heart->sql_fetchrow($res))
		 {
			$str.="<option value=$row[st_id]>$row[state_name]</option>";
		 }
	}
	$str.="</select>|||||".$StatePlaceHolder;
	echo $str;
exit();
break;
}
?>


