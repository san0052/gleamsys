<?php
/*********************************************************
*                 SHOPPING CART FUNCTIONS 
*********************************************************/
 
function addToCart()
{
	global  $sabera,$cfg;
	// make sure the product id exist
	if (isset($_REQUEST['p']) && (int)$_REQUEST['p'] > 0) {
		$productId = (int)$_REQUEST['p'];
	} else {
		header('Location: index.php');
	}
	
	// does the product exist ?
	/*$sql = "SELECT imgId, pd_qty FROM ".$cfg['DB_GALLERY']." WHERE imgId= $productId";
	$result = $sabera->sql_query($sql);
	
	if ($sabera->sql_numrows($result) != 1) {
		// the product doesn't exist
		header('Location: cart.php');
	} else {
		// how many of this product we
		// have in stock
		$row = $sabera->sql_fetchrow($result);
		$currentStock = $row['pd_qty'];

		if ($currentStock == 0) {
			// we no longer have this product in stock
			// show the error message
			setError('The product you requested is no longer in stock');
			header('Location: cart.php');
			exit;
		}

	}*/		
	
	// current session id
	$sid = session_id();
	
	// check if the product is already
	// in cart table for this session
	$sql = "SELECT `imgId` FROM ".$cfg['DB_CART']." WHERE `imgId` = ".$productId." AND `ct_session_id` = '".$sid."'";
	$result = $sabera->sql_query($sql);
	
	if ($sabera->sql_numrows($result) == 0) {
		// put the product in cart table
		$sql = "INSERT INTO ".$cfg['DB_CART']." (`imgId`, `ct_qty`, `ct_session_id`, `ct_date`)
				VALUES ('".$productId."', 1, '".$sid."', NOW())";
		$result = $sabera->sql_query($sql);
	} else {
		// update product quantity in cart table
		$sql = "UPDATE ".$cfg['DB_CART']." 
		        SET `ct_qty` = `ct_qty` + 1
				WHERE `ct_session_id` = '$sid' AND `imgId` = $productId";		
				
		$result = $sabera->sql_query($sql);		
	}	
	
	// an extra job for us here is to remove abandoned carts.
	// right now the best option is to call this function here
	deleteAbandonedCart();
	
	header('Location: ' . $_SESSION['shop_return_url']);				
}
/*
	Get all item in current session
	from shopping cart table
*/
function getCartContent()
{
	global  $sabera,$cfg;
	$cartContent = array();

	$sid = session_id();
	$sql = "SELECT ct_id, ct.imgId, ct_qty, imgTitle, imgPrice, pd.categoryId
			FROM ".$cfg['DB_CART'].", ".$cfg['DB_GALLERY'].", ".$cfg['DB_CATEGORY']."
			WHERE ct_session_id = '$sid' AND ct.imgId= pd.imgId AND cat.categoryId = pd.cat_id";
	
	$result = $sabera->sql_query($sql);
	
	while ($row = $sabera->sql_fetchrow($result)) {
		/*if ($row['pd_thumbnail']) {
			$row['pd_thumbnail'] = WEB_ROOT . 'images/product/' . $row['pd_thumbnail'];
		} else {
			$row['pd_thumbnail'] = WEB_ROOT . 'images/no-image-small.png';
		}*/
		$cartContent[] = $row;
	}
	
	return $cartContent;
}
/*
	Remove an item from the cart
*/
function deleteFromCart($cartId = 0)
{
	global  $sabera,$cfg;
	if (!$cartId && isset($_GET['cid']) && (int)$_GET['cid'] > 0) {
		$cartId = (int)$_GET['cid'];
	}

	if ($cartId) {	
		$sql  = "DELETE FROM ".$cfg['DB_CART']."
				 WHERE ct_id = $cartId";

		$result = $sabera->sql_query($sql);
	}
	
	header('Location: cart.php');	
}
/*
	Update item quantity in shopping cart
*/
function updateCart()
{
	global  $sabera,$cfg;
	$cartId     = $_POST['hidCartId'];
	$productId  = $_POST['hidProductId'];
	$itemQty    = $_POST['txtQty'];
	$numItem    = count($itemQty);
	$numDeleted = 0;
	$notice     = '';
	
	for ($i = 0; $i < $numItem; $i++) {
		$newQty = (int)$itemQty[$i];
		if ($newQty < 1) {
			// remove this item from shopping cart
			deleteFromCart($cartId[$i]);	
			$numDeleted += 1;
		} else {
			// check current stock
			/*$sql = "SELECT pd_name, pd_qty
			        FROM ".$cfg['DB_GALLERY']."
					WHERE imgId = {$productId[$i]}";
			$result = $sabera->sql_query($sql);
			$row    = $sabera->sql_fetchrow($result);
			
			if ($newQty > $row['pd_qty']) {
				// we only have this much in stock
				$newQty = $row['pd_qty'];

				// if the customer put more than
				// we have in stock, give a notice
				if ($row['pd_qty'] > 0) {
					setError('The quantity you have requested is more than we currently have in stock. The number available is indicated in the &quot;Quantity&quot; box. ');
				} else {
					// the product is no longer in stock
					setError('Sorry, but the product you want (' . $row['pd_name'] . ') is no longer in stock');

					// remove this item from shopping cart
					deleteFromCart($cartId[$i]);	
					$numDeleted += 1;					
				}
			} */
							
			// update product quantity
			$sql = "UPDATE ".$cfg['DB_CART']."
					SET ct_qty = $newQty
					WHERE ct_id = {$cartId[$i]}";
				
			$sabera->sql_query($sql);
		}
	}
	
	if ($numDeleted == $numItem) {
		// if all item deleted return to the last page that
		// the customer visited before going to shopping cart
		header("Location: $returnUrl" . $_SESSION['shop_return_url']);
	} else {
		header('Location: cart.php');	
	}
	
	exit;
}
function isCartEmpty()
{
	global  $sabera,$cfg;
	$isEmpty = false;
	
	$sid = session_id();
	$sql = "SELECT `ct_id` FROM ".$cfg['DB_CART']."	WHERE `ct_session_id` = '$sid'";
	
	$result = $sabera->sql_query($sql);
	
	if ($sabera->sql_numrows($result) == 0) {
		$isEmpty = true;
	}	
	
	return $isEmpty;
}

/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart()
{
	global  $sabera,$cfg;
	$yesterday = date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	$sql = "DELETE FROM ".$cfg['DB_CART']." WHERE `ct_date` < '".$yesterday."'";
	$sabera->sql_query($sql);		
}
function getShopConfig()
{
	global  $sabera,$cfg;
	// get current configuration
	$sql = "SELECT sc_name, sc_address, sc_phone, sc_email, sc_shipping_cost, sc_order_email, cy_symbol 
			FROM ".$cfg['DB_SHOP_CONFIG']." sc, ".$cfg['DB_CURRENCY']." cy
			WHERE sc_currency = cy_id";
	$result = $sabera->sql_query($sql);
	$row    = mysql_fetch_array($result);

    if ($row) {
        extract($row);
	
        $shopConfig = array('name'           => $sc_name,
                            'address'        => $sc_address,
                            'phone'          => $sc_phone,
                            'email'          => $sc_email,
				    		'sendOrderEmail' => $sc_order_email,
                            'shippingCost'   => $sc_shipping_cost,
                            'currency'       => $cy_symbol);
    } else {
        $shopConfig = array('name'           => '',
                            'address'        => '',
                            'phone'          => '',
                            'email'          => '',
				    		'sendOrderEmail' => '',
                            'shippingCost'   => '',
                            'currency'       => '');    
    }

	return $shopConfig;						
}
function displayAmount($amount)
{
	global $sabera,$cfg;
	return $shopConfig['currency'] . number_format($amount);
}
function setError($errorMessage)
{
	global  $sabera,$cfg;
	if (!isset($_SESSION['plaincart_error'])) {
		$_SESSION['plaincart_error'] = array();
	}
	
	$_SESSION['plaincart_error'][] = $errorMessage;

}
/*
	print the error message
*/
function displayError()
{
	global  $sabera,$cfg;
	if (isset($_SESSION['plaincart_error']) && count($_SESSION['plaincart_error'])) {
		$numError = count($_SESSION['plaincart_error']);
		
		echo '<table id="errorMessage" width="550" align="center" cellpadding="20" cellspacing="0"><tr><td>';
		for ($i = 0; $i < $numError; $i++) {
			echo '&#8226; ' . $_SESSION['plaincart_error'][$i] . "<br>\r\n";
		}
		echo '</td></tr></table>';
		
		// remove all error messages from session
		$_SESSION['plaincart_error'] = array();
	}
}
?>