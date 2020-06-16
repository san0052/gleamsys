<?php
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');

if($_REQUEST['pid']==0 && $_REQUEST['secpid']==0){
//echo 'Arka';
 $sqltype="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`!='D' AND  `cat_parent_id`=0 AND  `name`='".addslashes($_REQUEST['id'])."'";
}
if($_REQUEST['pid']!=0 && $_REQUEST['secpid']==0){
$sqltype="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`!='D' AND  `cat_parent_id`='".$_REQUEST['pid']."' AND `name`='".addslashes($_REQUEST['id'])."'";
}
if($_REQUEST['pid']!=0 && $_REQUEST['secpid']!=0){
$sqltype="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`!='D' AND  `cat_parent_id`='".$_REQUEST['secpid']."' AND `name`='".addslashes($_REQUEST['id'])."'";
}
$restype=$heart->sql_query($sqltype);
$maxrow=$heart->sql_numrows($restype);				
if($maxrow>0)
{
echo '1';
}
else{
echo '0';
}

?>