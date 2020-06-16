<?php
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');


 $sqltype="SELECT * FROM ".$cfg['DB_ALBUM']." WHERE `status`!='D'  AND  `name`='".addslashes($_REQUEST['id'])."'";

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