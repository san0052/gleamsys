<?php
include_once("includes/links_frontend.php");

$type = !empty($_REQUEST['type']) ? trim($_REQUEST['type']) : '';
$limit = !empty($_REQUEST['limit']) ? trim($_REQUEST['limit']) : 1;
$is_more = !empty($_REQUEST['is_more']) ? trim($_REQUEST['is_more']) : '';
$offset = !empty($_REQUEST['offset']) ? trim($_REQUEST['offset']) : 0;
$min_amount = !empty($_REQUEST['min_amount']) ? trim($_REQUEST['min_amount']) : 0;
$max_amount = !empty($_REQUEST['max_amount']) ? trim($_REQUEST['max_amount']) : 0;

$category_ids = !empty($_REQUEST['sub_category']) ? trim($_REQUEST['sub_category']):'';

# if any condition occurs
$anyCondition = 0;
# if sidebar selected
$sidebarCounter = false;

#next offset
$nextOffset = 0;
if (!empty($is_more)) {
	// if ($offset == 1) {
	// 	$nextOffset = $offset+$limit;
	// } else if($offset>1){
	// 	$nextOffset = ($offset - 1)*$limit+1;
	// }else{
	// 	$nextOffset = 0;
	// }
	$nextOffset = ($offset - 1)*$limit+$limit;
}

$productSql = '';
$productSql .= "SELECT * FROM ".$cfg['DB_PRODUCT']." AS pro WHERE ";


	if (!empty($category_ids)) {
		if ($anyCondition > 0) {
			$productSql .= " AND ";
		}
		$new_category_ids = explode(',', $category_ids);
		$productSql .= ' (';
		for($i=0; $i<count($new_category_ids); $i++) {
			if ($i == (count($new_category_ids)-1)) {
				$productSql .= ' pro.`category` LIKE "%'.$new_category_ids[$i].'%" ';
			} else {
				$productSql .= ' pro.`category` LIKE "%'.$new_category_ids[$i].'%" OR ';
			}
		}
		$productSql .= ') ';
		$sidebarCounter = true;
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
				$productSql = str_replace('AND ','', $productSql);
				break;
		}

		$anyCondition++;

	} // end of type

	if(!empty($min_amount) && empty($max_amount)) {
		if ($anyCondition > 0) {
			$productSql .= " AND ";
		}
		$productSql .= " pd_price >= ".$min_amount;
		$sidebarCounter = true;
		$anyCondition++;
	}

	if(!empty($max_amount) && empty($min_amount)) {
		if ($anyCondition > 0) {
			$productSql .= " AND ";
		}
		$productSql .= " pd_price <= ".$max_amount;
		$sidebarCounter = true;
		$anyCondition++;
	}

	if (!empty($min_amount) && !empty($max_amount)) {
		if ($anyCondition > 0) {
			$productSql .= " AND ";
		}
		$productSql .= " (pd_price BETWEEN ".$min_amount." AND ".$max_amount.")";
		$sidebarCounter = true;
		$anyCondition++;
	}

	if (empty($anyCondition)) {
		$productSql = str_replace('WHERE', '', $productSql);
	}

	# order by 
	$productSql .= " ORDER BY pro.`pd_id` DESC ";

	# limit
	$productSql .= " LIMIT ".$limit." OFFSET ".$nextOffset;
	// echo $productSql;	
	$res    =   $mycms->sql_query($productSql);
	$productArr	=	array();
    while($product    =   $mycms->sql_fetchrow($res)){
    	array_push($productArr, $product);
    }

    if (!empty($is_more)) {
    	if (!empty($productArr)) {
    		$htmlDetails = dynamicHTML($productArr,$offset);
    		echo json_encode(
    			array(
    				'status'=>true,
    				'query'=>$productSql,
    				'details'=>$htmlDetails['html'],
    				'nextOffset'=>$htmlDetails['nextCounter'],
    				'sidebarCounter' => $sidebarCounter
    			)
    		); die;
    	} else {
    		echo json_encode(
    			array(
    				'status'=>false,
    				'query'=>$productSql,
    				'nextOffset'=>$offset,
    				'details'=>array(),
    				'sidebarCounter'=>$sidebarCounter
    			)
    		); die;
    	}
    }


    function dynamicHTML($productArr,$offset) {
    	$returnArr = array();
    	$htmlData = '';
    	foreach ($productArr as $key => $value) { 
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

    	// $returnArr = array('html'=>$htmlData,'nextCounter'=>$previousId);
    	$returnArr = array('html'=>$htmlData,'nextCounter'=>$offset+1);
    	return $returnArr;
    }
?>