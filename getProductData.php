<?php
include_once("includes/links_frontend.php");

$type = !empty($_REQUEST['type']) ? trim($_REQUEST['type']) : '';
$limit = !empty($_REQUEST['limit']) ? trim($_REQUEST['limit']) : 3;
$is_more = !empty($_REQUEST['is_more']) ? trim($_REQUEST['is_more']) : '';
$offset_id = !empty($_REQUEST['offset']) ? trim($_REQUEST['offset']) : 0;

# if any condition occurs
$anyCondition = 0;

$productSql = '';
$productSql .= "SELECT * FROM ".$cfg['DB_PRODUCT']." AS pro WHERE ";

	if (!empty($offset_id)) {
		$productSql .= " pro.pd_id < ";
		$productSql .= $offset_id;
		$anyCondition++;
	}


	if (!empty($type)) {
		if ($anyCondition > 0) {
			$productSql .= " AND ";
		}
		switch ($type) {
			case 'feature':
				$productSql .= " pro.`pd_featured` = 'A'";
				break;
			case 'new-arrival':
				$productSql .= " pro.`new_arrival_pro` = 'A'";
				break;
			case 'best-selling':
				$productSql .= " pro.`pd_bestseller` = 'Y'";
				break;
			case 'todays-special':
				$productSql .= " pro.`today_Spcial_product` = 'Y' AND pro.`pd_date` LIKE CONCAT(CURDATE(),'','%')";
				break;
			default:
				$productSql = str_replace('AND ', '', $productSql);
				break;
		}

		$anyCondition++;

	} // end of type

	if (empty($anyCondition)) {
		$productSql = str_replace('WHERE', '', $productSql);
	}

	# order by 
	$productSql .= " ORDER BY pro.`pd_id` DESC ";

	# limit
	$productSql .= " LIMIT ".$limit;

	$res    =   $mycms->sql_query($productSql);
	$productArr	=	array();
    while($product    =   $mycms->sql_fetchrow($res)){
    	array_push($productArr, $product);
    }
    if (!empty($is_more)) {
    // echo "$productSql"; die;
    	if (!empty($productArr)) {
    		$htmlDetails = dynamicHTML($productArr);
    		echo json_encode(array('status'=>true, 'details'=>$htmlDetails['html'], 'nextOffset'=>$htmlDetails['nextCounter'])); die;
    	} else {
    		echo json_encode(array('status'=>false, 'details'=>array())); die;
    	}
    }


    function dynamicHTML($productArr) {
    	$returnArr = array();
    	$htmlData = '';
    	$firstCounter = count($productArr);
    	$previousId = '';
    	foreach ($productArr as $key => $value) { 
    		if (($firstCounter-1) == $key) {
                $previousId = $value['pd_id'];
                 //echo "jfgj".$value['pd_id'];die;
            }
    		$htmlData .= '<div class="item productItem">';
    			$htmlData .= '<div class="main-prd-box" onclick="window.location.href=\'product-details.php\'">';
		    		$htmlData .= '<div class="box_img">';
		    			$htmlData .= '<img has="postloader" src="image_bank/product_image/'.$value['pd_image'].'" alt="'.$value['pd_name'].'">';
		    		$htmlData .= '</div>';
		    		$htmlData .= '<p class="product-name">'.$value['pd_name'].'</p>';
		    	$htmlData .= '</div>';

		    	$htmlData .= '<div class="price-box">';
		    		$htmlData .= '<div class="price-content">';
		    			$htmlData .= '<p class="price">';
		    			$htmlData .= ' <span class="main-price">';
			    			$htmlData .= '$'.$value['pd_price'];
			    		$htmlData .= '</span>';
		    			$htmlData .= '<span class="offer-price">';
		    				$htmlData .= '$'.$value['strike_price'];
		    			$htmlData .= '</span>';
		    			$htmlData .= '</p>';
		    		$htmlData .= '</div>';

		    		$htmlData .= '<div class="prd-box-fot">';
		    			$htmlData .= '<div class="quentity-frm">';
		    				$htmlData .= '<div class="check-delivery">';
		    					$htmlData .= '<input type="number" min="1" max="10" value="1">';
		    					$htmlData .= '</div>';
		    				$htmlData .= '</div>';
		    				$htmlData .= '<button>Add to Cart</button>';
		    			$htmlData .= '</div>';
		    		$htmlData .= '</div>';
		    	$htmlData .= '</div>';
		    $htmlData .= '</div>';
    	}

    	$returnArr = array('html'=>$htmlData,'nextCounter'=>$previousId);
    	return $returnArr;
    }
?>