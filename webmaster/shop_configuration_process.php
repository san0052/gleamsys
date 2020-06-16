<?
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$act=@$_REQUEST['act']; 
switch($act)
{
	
	case'edit':
		$heart->redirect('shop_configuration.php?show=edit&id='.$_REQUEST['id'].'&pageno='.$_REQUEST['pageno']);
	break;
	
	case 'update':
	
 	$sql="UPDATE ".$cfg['DB_SHOP_CONFIG']." SET `sc_shipping_cost` = '".$_REQUEST['sc_shipping_cost']."',`sc_free_shipping_limit` = '".$_REQUEST['sc_free_shipping_limit']."',`order_id_pattern` = '".$_REQUEST['order_id_pattern']."' WHERE `sc_id`='".$_REQUEST['sc_id']."'";
	$heart->sql_query($sql);
	
	$heart->redirect('shop_configuration.php?pageno='.$_REQUEST['pageno'].'&m=2');

	break;
	

}


?>
	
