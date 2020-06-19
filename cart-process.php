<?php 

include_once("includes/links_frontend.php");
$action = $_REQUEST['act'];
switch($action) {
	case 'add_to_cart':
		// unset($_SESSION['gleam_cart_session']);
		#check product with available items are available
		$product_id = !empty($_REQUEST['product_id'])?trim($_REQUEST['product_id']) : '';
		$product_count = !empty($_REQUEST['product_count'])?trim($_REQUEST['product_count']) : '';

		if (empty($product_id)) {
			echo json_encode(array('status'=>false, 'message'=>'Something went wrong. Please try again later')); die;
		}
		$checkProductAvailable = "SELECT `pd_id`,`pd_name`,`pd_qty` FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = ".$product_id;
		$resProducts	=	$mycms->sql_query($checkProductAvailable);
		$rows			=	$mycms->sql_fetchrow($resProducts);
		if(!empty($rows)) {
			$database_count = $rows['pd_qty'];
			if ($rows['pd_qty']<$product_count) {
				if ($rows['pd_qty'] == 0) {
					echo json_encode(array('status'=>false, 'message'=>$rows['pd_name'].' is out of stock')); die;
				}
				echo json_encode(array('status'=>false, 'message'=>$rows['pd_qty'].' quantity of '.$rows['pd_name'].' are available only')); die;
			} else {
				# store to cart session

				$cart_array = array();
				$cart_counter = 0;
				if (!empty($_SESSION['gleam_users_session'])) {
					$user_id = $_SESSION['gleam_users_session']['user_id'];
					$cart_array = array('user_id'=>$user_id, 'product_id'=>$product_id, 'product_count'=>$product_count);
					checkProductExist($pd_id, $product_id, $product_count, $user_id);
				} else {
					checkProductExistInCart($product_id, $product_count);				
				}

				$cart_counter = count($_SESSION['gleam_cart_session']);
				echo json_encode(array('status'=>true, 'message'=>'product added to cart', 'cart_session'=>$_SESSION['gleam_cart_session'], 'cart_count'=>$cart_counter)); die;
			}
		} else {
			echo json_encode(array('status'=>false, 'message'=>'Something went wrong. Please try again later')); die;
		}
		break;
}


// if product is already present then add product count only
function checkProductExistInCart($product_id, $product_count, $user_id = 0) {

	$data = $_SESSION['gleam_cart_session'];
	if (!empty($data)) {
		$product_id_list = array_column($data, 'product_id');
		if (in_array($product_id, $product_id_list)) {
			$key 				= key(array_column($data, 'product_id'));
			$product_count_prev = $data[$key]['product_count'];
			$data[$key]['product_count'] = $product_count_prev+$product_count;
			$_SESSION['gleam_cart_session'] = $data;
			return 1;
		} else { 
			$cart_array = array('product_id'=>$product_id, 'product_count'=>$product_count, 'user_id'=>$user_id);
			array_push($_SESSION['gleam_cart_session'],$cart_array);
		}
	} else { 
		$cart_array = array('product_id'=>$product_id, 'product_count'=>$product_count, 'user_id'=>$user_id);
		$_SESSION['gleam_cart_session'][] = $cart_array;
	}
}


?>