<?

include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');

//die("************111111");

$act=@$_REQUEST['act']; 

//echo $act;



switch($act){

case 'update_delivered_status':

			$delivered = $_REQUEST['delivered'];
			$reason  = $_REQUEST['reason'];
			
			
			$sql="UPDATE ".$cfg['DB_VENDOR_ORDER']."
				  SET `delivery_status` = '".$delivered."',
				  	  `delivery_faild_reason` = '".$reason."'
				  WHERE `od_id` = '".$_REQUEST['id']."'";

	 		$heart->sql_query($sql);
			
			$heart->redirect('vendor_order.php');
			
			
			
exit();
break;

}





?>
