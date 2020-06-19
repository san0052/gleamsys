<?php 

include_once("includes/links_frontend.php");
$action = $_REQUEST['act'];
switch($action) {
	case 'add_to_cart':
		#check product with available items are available
		$category_id = !empty($_REQUEST['category_id'])?trim($_REQUEST['category_id']) : '';
		$product_count = !empty($_REQUEST['product_count'])?trim($_REQUEST['product_count']) : '';

		if (empty($category_id)) {
			echo json_encode(array('status'=>false, 'message'=>'Something went wrong. Please try again later')); die;
		}
		$checkProductAvailable = "SELECT `pd_id`,`pd_name`,`pd_qty` FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = ".$category_id;
		$resProducts	=	$mycms->sql_query($checkProductAvailable);
		$rows			=	$mycms->sql_fetchrow($resProducts);
		if(!empty($rows)) {
			$database_count = $rows['pd_qty'];
			if ($rows['pd_qty']<$product_count) {
				echo json_encode(array('status'=>false, 'message'=>$product_count.' quantity of '.$rows['pd_name'].' are available only')); die;
			} else {
				# store to cart session

				$cart_array = array();
				if (!empty($_SESSION['gleam_users_session'])) {
					$user_id = $_SESSION['gleam_users_session']['user_id'];
					$cart_array = array('user_id'=>$user_id, 'category_id'=>$category_id, 'product_count'=>$product_count);
				} else {
					$cart_array = array('category_id'=>$category_id, 'product_count'=>$product_count);
				}

				if (!empty($_SESSION['gleam_cart_session'])) {
					array_push($_SESSION['gleam_cart_session'],$cart_array);
				} else {
					$_SESSION['gleam_cart_session'] = $cart_array;
				}
				echo json_encode(array('status'=>true, 'message'=>'product added to cart', 'cart_session'=>$_SESSION['gleam_cart_session'])); die;
			}
		} else {
			echo json_encode(array('status'=>false, 'message'=>'Something went wrong. Please try again later')); die;
		}
		break;
}

?>