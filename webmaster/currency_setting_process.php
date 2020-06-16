<?

include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');

$act=@$_REQUEST['act']; 

switch($act)

{
	
	case'edit':

		$heart->redirect('currency_setting.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);

	break;

	
	case 'update':
	
 	$sql="UPDATE ".$cfg['DB_CURRENCY_SETTING']." SET `indian_value` = '".$_REQUEST['indianValue']."' WHERE `id`='".$_REQUEST['id']."'";

	$heart->sql_query($sql);

	
	$heart->redirect('currency_setting.php?pageno='.$_REQUEST['pageno'].'&m=2');


	break;

}

?>

	

