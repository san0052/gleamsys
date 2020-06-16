<?php

/*********************************************************
*                 PRODUCT FUNCTIONS 
**********************************************************/


/*
	Get detail information of a product
*/
function getProductDetail($pdId, $catId)
{
	global  $sabera,$cfg;
	$_SESSION['shoppingReturnUrl'] = $_SERVER['REQUEST_URI'];
	
	// get the product information from database
	$sql = "SELECT `pd_name`, `pd_description`, `pd_price`, `pd_image`, `pd_qty`
			FROM ".$cfg['DB_PRODUCT']."
			WHERE `pd_id` = '".$pdId."'";
	
	$result = $sabera->sql_query($sql);
	$row    = $sabera->sql_fetchrow($result);
	extract($row);
	
	$row['pd_description'] = nl2br($row['pd_description']);
	
	if ($row['pd_image']) {
		$row['pd_image'] = $cfg['base_url'] . 'productImage/' . $row['pd_image'];
	} else {
		$row['pd_image'] = $cfg['base_url'] . 'productImage/no-image-large.png';
	}
	
	$row['cart_url'] = "cart.php?action=add&p=$pdId";
	
	return $row;			
}



?>