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


	case 'show_cart_details':
		$cart_session = !empty($_SESSION['gleam_cart_session'])?$_SESSION['gleam_cart_session']:'';
		if (!empty($cart_session)) {
			$totalCount = 0;
			$totalAmount = 0;
			foreach ($cart_session as $cart) {
				$sqlgetCartDet = "SELECT pd_id, pd_image, pd_price, pd_name, pd_qty FROM ".$cfg['DB_PRODUCT']." WHERE `status` ='A' AND `pd_id` = ".$cart['product_id']."";
	            $resCart    =   $mycms->sql_query($sqlgetCartDet);
	            $rowCart    =   $mycms->sql_fetchrow($resCart);
	            if (!empty($rowCart)) {
	            	  $totalCount++;
	            	  $totalAmount += $rowCart['pd_price']*$cart['product_count'];
	                  $cartItems .= '<div class="order-list">';
	                      $cartItems .= '<div class="item-pic">';
	                          $cartItems .= '<img src="image_bank/product_image/'.$rowCart['pd_image'].'">';
	                          // $cartItems .= '<p>1</p>';
	                      $cartItems .= '</div>';
	                      $cartItems .= '<div class="item-details">';
	                          $cartItems .= '<p class="prd-name" style="font-weight:600">'.$rowCart['pd_name'].'</p>';

	                                      // <p class="prd-id">product id</p> 
	                                          // <p class="deliver-date">Delivery by Sun 21 Jun | Free</p>
	                          $cartItems .= '<p class="prd-price">Price :- $'.$rowCart['pd_price'].'</p>';
	                          $cartItems .= '<p class="prd-price">Quanity :- '.$cart['product_count'].'</p>';
	                          $cartItems .= '<button class="rmv-btn rmv_cart_item" data-remove_prod_id="'.$rowCart['pd_id'].'">Remove</button>';
	                      $cartItems .= '</div>';
	                  $cartItems .= '</div>';
	            }
			}

			if ($totalCount>0) {
				$cartItems .= '<table class="table totalpayble">';
					$cartItems .= '<thead>';
						$cartItems .= '<tr>';
							$cartItems .= '<th colspan="2">Price Details</th>';
						$cartItems .= '</tr>';
					$cartItems .= '</thead>';
					$cartItems .= '<tbody>';
						$cartItems .= '<tr>';
							$cartItems .= '<td>';
								$cartItems .= 'Price ('.$totalCount.' Items)';
							$cartItems .= '</td>';
							$cartItems .= '<td>';
								$cartItems .= '$'.$totalAmount;
							$cartItems .= '</td>';
						$cartItems .= '</tr>';
						$cartItems .= '<tr>';
							$cartItems .= '<td>';
								$cartItems .= 'Delivery Charge';
							$cartItems .= '</td>';
							$cartItems .= '<td>';
								$cartItems .= 'Free';
							$cartItems .= '</td>';
						$cartItems .= '</tr>';
					$cartItems .= '</tbody>';
					$cartItems .= '<tfoot>';
						$cartItems .= '<tr>';
							$cartItems .= '<td>';
								$cartItems .= 'Total Payble';
							$cartItems .= '</td>';
							$cartItems .= '<td>';
								$cartItems .= '$'.$totalAmount;
							$cartItems .= '</td>';
						$cartItems .= '</tr>';
					$cartItems .= '</tfoot>';
				$cartItems .= '</table>';
			}

			echo json_encode(array('status'=>true, 'details'=>$cartItems, 'totalAmount'=>$totalAmount)); die;
		} else {
			$noDataHtml = '<p style="text-align:center; margin-top:10px">Empty Cart</p>';
     		echo json_encode(array('status'=>false, 'details'=>$noDataHtml)); die;
		}

		break;

	case 'remove_cart_item':
		$data = $_SESSION['gleam_cart_session'];
		$product_id = !empty($_REQUEST['product_id'])?trim($_REQUEST['product_id']) : '';

		if (!empty($data) && !empty($product_id)) {
			$product_id_list = array_column($data, 'product_id');
			if (in_array($product_id, $product_id_list)) {
				$key = key(array_column($data, 'product_id'));
				unset($data[$key]);
				$_SESSION['gleam_cart_session'] = $data;
				echo json_encode(array('status'=>true)); die;
			}
		} else {
			echo json_encode(array('status'=>false)); die;
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