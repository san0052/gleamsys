<?php
include_once("includes/links_frontend.php");

$type = !empty($_REQUEST['type']) ? trim($_REQUEST['type']) : 'all';
$limit = !empty($_REQUEST['limit']) ? trim($_REQUEST['limit']) : 9;
$offset = !empty($_REQUEST['offset']) ? trim($_REQUEST['offset']) : 0;

$sort = !empty($_REQUEST['sort']) ? trim($_REQUEST['sort']) : '';
$is_more = !empty($_REQUEST['is_more']) ? trim($_REQUEST['is_more']) : '';

$min_amount = !empty($_REQUEST['min_amount']) ? trim($_REQUEST['min_amount']) : 0;
$max_amount = !empty($_REQUEST['max_amount']) ? trim($_REQUEST['max_amount']) : 0;
$category_header = !empty($_POST['category']) ? ($_POST['category']) : $_REQUEST['category'];
$category_header_get = !empty($_REQUEST['category_get']) ? ($_REQUEST['category_get']) : '';


if (empty($category_header) && !empty($category_header_get)) {
	$category_header = $category_header_get;
	
}

$category_ids = !empty($_REQUEST['sub_category']) ? trim($_REQUEST['sub_category']):'';

# if any condition occurs
$anyCondition = 1;
# if sidebar selected
$sidebarCounter = false;

#next offset
$nextOffset = 0;
if (!empty($is_more)) {
	$nextOffset = ($offset - 1)*$limit+$limit;
}

$productSql = '';
$productSql .= "SELECT * FROM ".$cfg['DB_PRODUCT']." AS pro WHERE pro.`status` = 'A' ";

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

	// main category
	if (!empty($category_header)) {

		$category_sql = '';
		if (is_array($category_header)) {
			$category_sql .= "SELECT group_concat(DISTINCT `id`) AS `ids` FROM ".$cfg['DB_CATEGORY']."  WHERE ";
			$counter=0;
			foreach ($category_header as $key => $value) {
				$current_id = (string)base64_decode($value);
				if ($counter == (count($category_header)-1)) {
					$category_sql .= " `cat_parent_id` = ".$current_id." AND ";
				} else {
					$category_sql .= " `cat_parent_id` = ".$current_id." OR ";
				}
				$counter++;
			}

			$category_sql .= " `siteId`= '".$cfg['SESSION_SITE']."'";
		} else {
			$category_header1 = base64_decode(trim($category_header));
			$category_sql .= "SELECT group_concat(`id`) AS `ids` FROM ".$cfg['DB_CATEGORY']."  WHERE `cat_parent_id`= ".$category_header1." AND `siteId`='".$cfg['SESSION_SITE']."'";
		}
		// echo " sql ".$category_sql; die;
		
		$res1=$mycms->sql_query($category_sql);
 		$row1=$mycms->sql_fetchrow($res1);
		if (!empty($row1)) {
			$new_category_ids1 = explode(',', $row1['ids']);
			$productSql .= ' AND (';
			for($i=0; $i<count($new_category_ids1); $i++) {
				if ($i == (count($new_category_ids1)-1)) {
					$productSql .= ' pro.`category` LIKE "%'.$new_category_ids1[$i].'%" ';
				} else {
					$productSql .= ' pro.`category` LIKE "%'.$new_category_ids1[$i].'%" OR ';
				}
			}
			
			if (is_array($category_header)) {
				foreach ($category_header as $key => $value) {
					$current_id = (string)base64_decode($value);
					$productSql .= ' OR pro.`pd_parent_cat` LIKE "%'.$current_id.'%" ';
				}
			} else {
				$current_id = (string)base64_decode($category_header);
				$productSql .= ' OR pro.`pd_parent_cat` LIKE "%'.$current_id.'%" ';
			}
			
			$productSql .= ' ) ';
			$sidebarCounter = true;
			$anyCondition++;
		}
	}

	// echo " sql ".$productSql; die;

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
	


	// if (empty($anyCondition)) {
	// 	$productSql = str_replace('WHERE', '', $productSql);
	// }

	# order by 

	if (!empty($sort)) {
		switch ($sort) {
			// case 'popular':
			// 	$productSql .= " pro.`pd_featured` = 'A'";
			// 	break;
			case 'low_to_high':
				$productSql .= " ORDER BY pro.`pd_price` ASC ";
				break;
			case 'high_to_low':
				$productSql .= " ORDER BY pro.`pd_price` DESC ";
				break;
			case 'newest':
				$productSql .= " ORDER BY pro.`pd_date` DESC ";
				break;
			default:
				$productSql .= " ORDER BY pro.`pd_id` DESC ";
				break;
		}

		$anyCondition++;
	} // end of sort


	# limit
	$productSql .= " LIMIT ".$limit." OFFSET ".$nextOffset;
	// echo $productSql;die;
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
                $htmlData .= '<a href="'.$cfg['base_url'].'product-details.php?category='.base64_encode($value['pd_id']).'">';
	    			$htmlData .= '<div class="main-prd-box" onclick="window.location.href=\'product-details.php\'">';
			    		$htmlData .= '<div class="box_img">';
			    			$htmlData .= '<img has="postloader" src="image_bank/product_image/'.$value['pd_image'].'" alt="'.$value['pd_name'].'">';
			    		$htmlData .= '</div>';
			    		$htmlData .= '<p class="product-name">'.$value['pd_name'].'</p>';
			    	$htmlData .= '</div>';
		    	$htmlData .= '</a>';
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
		    					$htmlData .= '<input type="number" min="1" max="10" value="1" class="cart_counter_'.$value['pd_id'].'">';
		    					$htmlData .= '</div>';
		    				$htmlData .= '</div>';
		    				$htmlData .= '<button class="add_to_cart" data-cartProductId="'.$value['pd_id'].'">Add to Cart</button>';
		    			$htmlData .= '</div>';
		    		$htmlData .= '</div>';
		    	$htmlData .= '</div>';
		    $htmlData .= '</div>';
    	}

    	$returnArr = array('html'=>$htmlData,'nextCounter'=>$offset+1);
    	return $returnArr;
    }
?>