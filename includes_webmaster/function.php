<?php
	
#####################################################################################################################################################################
#||||||||||||||||||||||||||||||||||||||||||								   FUNCTIONS LIST                        		   |||||||||||||||||||||||||||||||||||||||||#	
#####################################################################################################################################################################
	

##########################################################<<<<<<<<<<<<<<<   CATEGORY FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function getCategoryID($catid) {
		global $cfg,$heart;
		$pd=array();
		$sql_m="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `id`='".$catid."'";
		$res_m=$heart->sql_query($sql_m);
		if($heart->sql_numrows($res_m)>0) {  	
			$sql_p="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$catid."'";
			$res_p=$heart->sql_query($sql_p);
			if($heart->sql_numrows($res_p)>0){
				while($row_p=$heart->sql_fetchrow($res_p)){			
					$sql_s="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$row_p['id']."'";
					$res_s=$heart->sql_query($sql_s);	
					if($heart->sql_numrows($res_s)>0){
						while($row_s=$heart->sql_fetchrow($res_s)){
							$sql_pd="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `category`='".$row_s['id']."'";
							$res_pd=$heart->sql_query($sql_pd);	
							if($heart->sql_numrows($res_pd)>0){
								while($row_pd=$heart->sql_fetchrow($res_pd)){
									$pd[] = $row_pd['pd_id'];
								}
							}
						
						}
					}
				}
			}
			return implode(',',$pd);
		}
	}
	
	function getParentCategoryId($sub_cat_id){
		global  $heart,$cfg;
		$sql_cat = "SELECT * FROM ".$cfg['DB_CATEGORY']." 
							WHERE `id`= ".$sub_cat_id." 
							  AND `status`='A' ";
		$res_cat = $heart->sql_query($sql_cat);
		$row_cat=$heart->sql_fetchrow($res_cat);
		$cat_id = $row_cat['cat_parent_id'];
		return $cat_id;
	}
	
	function getParentNSubCategory($sub_cat_id){
		global  $heart,$cfg;
		$parentNSubCategoryArr = array();
		$sql_cat = "SELECT * FROM ".$cfg['DB_CATEGORY']." 
							WHERE `id`  IN(".$sub_cat_id.") 
							  AND `status`='A'  ORDER BY `order` ASC";
		$res_cat = $heart->sql_query($sql_cat);
		while($row_cat=$heart->sql_fetchrow($res_cat)){
			$parentCatName = getParentCategoryName($row_cat['cat_parent_id']);
			$parentNSubCategoryArr[$row_cat['cat_parent_id']]['Name'] = $parentCatName;
			$parentNSubCategoryArr[$row_cat['cat_parent_id']]['Sub'][$row_cat['id']] = $row_cat['name'];
		}
		return $parentNSubCategoryArr;
	}
	
	function getParentCategoryName($sub_cat_id){
		global  $heart,$cfg;
		$sql_cat = "SELECT * FROM ".$cfg['DB_CATEGORY']." 
							WHERE `id` IN(".$sub_cat_id.") 
							  AND `status`='A' ORDER BY `order` ASC";
		$res_cat = $heart->sql_query($sql_cat);
		$row_cat=$heart->sql_fetchrow($res_cat);
		return $row_cat['name'];
	}
	
	function getSubCategoryIds($parent_cat_id){
		global  $heart,$cfg;
		$sub_catIdsArr = array();
		$sql_cat = "SELECT * FROM ".$cfg['DB_CATEGORY']." 
							WHERE `id` IN(".$parent_cat_id.") 
							  AND `status`='A' ";
		$res_cat = $heart->sql_query($sql_cat);
		while($row_cat=$heart->sql_fetchrow($res_cat)){
			$sub_catIdsArr[] = $row_cat['id'];
		}
		return $sub_catIdsArr;
	}
	
	function getCategoryMap($catid,$url) {
		global $cfg,$heart,$map;
		$sql="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE cpid='".$catid."'";
		$res=$heart->sql_query($sql);
		if($heart->sql_numrows($res)>0){  	
			$row=$heart->sql_fetchrow($res);
			$map[] = "<a href='".$url."?act=showcat&catid=".$row['cid']."' class='link'>".$row['cname']."</a>";
			getCategoryMap($row['project_pid'],$url);		
		}else{
			$map[] = "<a href='".$url."' class='link'>Category</a>";
		}
		return $map;
	}
	
	function getcatid($cID){
		global  $heart,$cfg;
		$sql_country = "SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `id` = '".$cID."'";
		$res_country = $heart->sql_query($sql_country);
		$row_country	=	$heart->sql_fetchrow($res_country);
		$catid 	= 	$row_country['cat_parent_id'];
		return $catid;
	}
	
	function getChildCategories($id,$recursive = true){
		global  $heart,$cfg;
		$i=0;
		$categories = array();
		$sql = "SELECT * FROM ".$cfg['DB_CATEGORY']."WHERE `cat_parent_id` = ".$id."  AND `status`!='D'";
		$result = $heart->sql_query($sql);
		while ($row = $heart->sql_fetchrow($result)){
			$categories[$i] = $row['id'];
			$i++;
		}
		$n  = count($categories);
		return $categories;
	}
	
	function catname($categoryId){
		global  $heart,$cfg;
		$sql_cat = "SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_id` = '".$categoryId."'";
		$res_cat = $heart->sql_query($sql_cat);
		$row_cat	=	$heart->sql_fetchrow($res_cat);
		$cat_name 	= 	$row_cat['cat_name'];
		return $cat_name;
	}
	
	function catDes($categoryId){
		global  $heart,$cfg;
		$sql_cat = "SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_id` = '".$categoryId."'";
		$res_cat = $heart->sql_query($sql_cat);
		$row_cat	=	$heart->sql_fetchrow($res_cat);
		$cat_name 	= 	stripslashes($row_cat['cat_description']);
		return $cat_name;
	}
	
	function category() {
		global $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_CATEGORY'];
		$res = $heart->sql_query($sql);
		$i=0;
		$category['max_cat'] = $heart->sql_numrows($res);
		$category['cat_name'] = "";
		while($cat_row=$heart->sql_fetchrow($res)) {
			$i++;
			$sql_gen = "SELECT * FROM ".$cfg['DB_GENRES']." WHERE cat_id='".$cat_row['cat_id']."'";
			$res_gen = $heart->sql_query($sql_gen);
			if ($heart->sql_numrows($res_gen)!=0){
				$cat_divided = ($i==$category['max_cat'])?"":"<span class=\"divider\">|</span>";
				$category['cat_name'] .= "<a href=\"contain-movie.php?catid=".$cat_row['cat_id']."\" name=\"link".$i."\" onmouseover=\"MM_showMenu(window.mm_menu_1215150716_".$cat_row['cat_id'].",0,18,null,'link".$i."')\" onmouseout=\"MM_startTimeout();\">".ucfirst($cat_row['cat_name'])."</a>".$cat_divided;
			}else {
				$cat_divided = ($i==$category['max_cat'])?"":"<span class=\"divider\">|</span>";
				$category['cat_name'] .= "<a href=\"#\" name=\"link".$i."\">".ucfirst($cat_row['cat_name'])."</a>".$cat_divided;	  	
			}
		}
		return $category;
	}
	
	function categoryName($categoryId){
		global $heart,$cfg;
		$sql="SELECT categoryName FROM ".$cfg['DB_CATEGORY']." WHERE `categoryId` IN (".$categoryId.")";
		$res=$heart->sql_query($sql);
		$maxrow=$heart->sql_numrows($res);
		while($row=$heart->sql_fetchrow($res)){
			$i++;
			$comma=($i==$maxrow)?'':',';
			$category_name.= $row['categoryName'].$comma;
		}
		return $category_name;			
	}
	
	function view_category($sel='') {
		global $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_CATEGORY'];
		$res = $heart->sql_query($sql);
		$view_category = "";
		$color= "alt2";
		while($cat_row=$heart->sql_fetchrow($res)) {
			$color = ($color=="alt1")?"alt2":"alt1";
			$s = ($sel==$cat_row['cat_id'])?"selected=\"selected\" ":"";
			$view_category .= "<option value=".$cat_row['cat_id']." ".$s." class='".$color."'>"."&raquo;&nbsp;".$cat_row['cat_name']."</option>";
		}
		return $view_category;
	}
	
	function jokes_category($user_id){
		global $heart,$cfg;
		$sql="SELECT categoryName  FROM ".$cfg['DB_CATEGORY']." WHERE  categoryId  =".$user_id."";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		return $row['categoryName'];
	}
	
	function find_cat($cid='') {
		if($cid) {
			$sql = "SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE cat_id='".$cid."'";
			$res = $heart->sql_query($sql);
			$row = $heart->sql_fetchrow($res);
			$row['max'] = $heart->sql_numrows($res);
			return $row;
		}
	}
	
	function getcategoryname($pd_id){
		global  $heart,$cfg;
		$cat=array();
		$sql_pd = "SELECT `name` FROM ".$cfg['DB_CATEGORY']." WHERE `id` IN (".$pd_id.") ";
		$res_pd = $heart->sql_query($sql_pd);
		$maxrow_pd=$heart->sql_numrows($res_pd);	 
		if($maxrow_pd>0){
			while($row_pd=$heart->sql_fetchrow($res_pd)){  
				$cat[] = stripslashes($row_pd['name']);
			}
			return implode(',',$cat);
		}
	} 
	
	function getcategoryname2($pd_id){
		global  $heart,$cfg;
		$cat=array();
		$sql_pd = "SELECT `cat_id` FROM ".$cfg['DB_PRODUCT_CAT']." WHERE `pd_id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);	
		$maxrow_pd=$heart->sql_numrows($res_pd);	 
		if($maxrow_pd>0){
			while($row_pd=$heart->sql_fetchrow($res_pd)){  
				$cat[] = stripslashes($row_pd['cat_id']);
			}
			return implode(',',$cat);
		}
	}
	
	function find_subcat($cid){
		global $cfg,$heart;
		$sql = "SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE cpid='".$cid."'";
		$res = $heart->sql_query($sql);
		return ($heart->sql_numrows($res)!=0)?true:false;
	}
	
	function cat_map($cid){
		global $cfg,$heart;
		$sql = "SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE cid='".$cid."'";
		$res = $heart->sql_query($sql);
		if ($row = $heart->sql_fetchrow($res))
		$cat =  "<a href='category.php' class='tcat'>Category</a> -> ".$row['cname'];
		else
		$cat = "Category";
		return $cat;
	}
	
	function getCatName($categoryId){
		global  $heart,$cfg;
		$sql_cat = "SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `id` = '".$categoryId."'";
		$res_cat = $heart->sql_query($sql_cat);
		$row_cat	=	$heart->sql_fetchrow($res_cat);
		$cat_name 	= 	ucwords(strtolower(stripslashes($row_cat['name'])));
		return $cat_name;
	}
	
	function del_cat($cid){
		global $heart, $cfg;
		$sql = "DELETE FROM ".$cfg['DB_CATEGORY']." WHERE cid='".$cid."'";
		$res = $heart->sql_query($sql);
		$sql = "DELETE FROM ".$cfg['DB_CATEGORY']." WHERE cpid='".$cid."'";
		$res = $heart->sql_query($sql);
	}
	
	function countShowinTop(){
		global $cfg,$heart;$num;
		$sql="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `show_in_top_menu`='Y' ";
		$res=$heart->sql_query($sql);
		$num=$heart->sql_numrows($res);	
		return $num;	
	}
	
##########################################################<<<<<<<<<<<<<<<   PRODUCT FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
		
	function getProductId($pd_id){
		global  $heart,$cfg;
		$cat=array();
		$childId = getChildCategories($pd_id);
		if($childId){
			$pd_id = implode(',',$childId);
			$sql_pd = "SELECT `pd_id` FROM ".$cfg['DB_PRODUCT_CAT']." WHERE `cat_id` IN (".$pd_id.")";
		}
		else{
			$sql_pd = "SELECT `pd_id` FROM ".$cfg['DB_PRODUCT_CAT']." WHERE `cat_id` = '".$pd_id."'";
		}
		$res_pd = $heart->sql_query($sql_pd);	
		$maxrow_pd=$heart->sql_numrows($res_pd);	 
		if($maxrow_pd>0){
			while($row_pd=$heart->sql_fetchrow($res_pd)){ 				
				$cat[] = stripslashes($row_pd['pd_id']);
			}
			return implode(',',$cat);
		}
	}
	
	function getPdId($pd_id){
		global  $heart,$cfg;
		$cat=array();	
		$sql_pd = "SELECT `pd_id` FROM ".$cfg['DB_PRODUCT']." WHERE `pd_code` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);	
		$maxrow_pd=$heart->sql_numrows($res_pd);	 
		if($maxrow_pd>0){
			$row_pd=$heart->sql_fetchrow($res_pd);		
			return ($row_pd['pd_id']);
		}
	}
	
	function pd_name($pd_id){
		global  $heart,$cfg;
		 $sql_cart = "SELECT `ct_weight` FROM ".$cfg['DB_DUMMY_CART']." WHERE `pd_id` = '".$pd_id."'
		     ORDER BY `ct_id` DESC LIMIT 0,1 ";
		$res_cart = $heart->sql_query($sql_cart);
		$row_cart = $heart->sql_fetchrow($res_cart);

		$sql_pd = "SELECT `pd_name` FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		if($row_cart['ct_weight'] > 0)
		{
			$productName = explode(' ', stripslashes($row_pd['pd_name']));
			//print_r($productNameFinal1);
	        $length = count($productName);
	        //$productNameFinal1 = substr($pd_name, 1);
	        $productNameFinal1 = array_splice($productName, 1, $length);  
	        //print_r($productNameFinal1);
	        $productNameFinal1 = implode(' ', $productNameFinal1);
	        $pdName = $row_cart['ct_weight'].' '.$productNameFinal1;
		}
		else
		{
			$pdName 	= 	stripslashes($row_pd['pd_name']);
		}
		
		return $pdName;
	}
	
	function pd_price($pd_id){
		global  $heart,$cfg;
		$sql_cart = "SELECT `num_price` FROM ".$cfg['DB_DUMMY_CART']." WHERE `pd_id` = '".$pd_id."'
		     			ORDER BY `ct_id` DESC LIMIT 0,1 ";
		$res_cart = $heart->sql_query($sql_cart);
		$row_cart = $heart->sql_fetchrow($res_cart);

		$sql_pd = "SELECT `pd_price` FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		if($row_cart['num_price']!='') 
	    {
	        $pdPrice  = $row_cart['num_price'];
	    }
	    else
	    {
	        $pdPrice  = $row_pd['pd_price'];
	    }
		//$pdPrice 	= $row_pd['pd_price'];
		return $pdPrice;
	}

	function pd_preference($pd_id)
	{
		global  $heart,$cfg;
		 $sql_cart = "SELECT `preference` FROM ".$cfg['DB_DUMMY_CART']." WHERE `pd_id` = '".$pd_id."'
		     			ORDER BY `ct_id` DESC LIMIT 0,1 ";
		$res_cart = $heart->sql_query($sql_cart);
		$row_cart = $heart->sql_fetchrow($res_cart);

		$pdPreference  = $row_cart['preference'];
		return $pdPreference; 
	}
	
	function pd_image_name($pd_id){
		global  $heart,$cfg;
		$sql_pd = "SELECT `pd_image` FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$pd_image 	= $row_pd['pd_image'];
		return $pd_image;
	}	
	
	function getWatermarkImageName($watermarkId){
		global  $heart,$cfg;
		$sql = "SELECT `w_image` FROM ".$cfg['DB_WATERMARK']." WHERE `w_id` = '".$watermarkId."'";
		$res = $heart->sql_query($sql);
		$row	=	$heart->sql_fetchrow($res);
		$watermarkImage 	= $row['w_image'];
		return $watermarkImage;
	
	}
	
	
	
	function getFeaturedProduct(){
		global  $heart,$cfg;
		$featuredProduct = array();
		
		$sqlFeaturedProduct = "SELECT *	FROM ".$cfg['DB_PRODUCT']."	
								WHERE `pd_featured` = 'A' AND `pd_status` = 'A'
								ORDER BY RAND() LIMIT 0 , 6";
		$resultFeaturedProduct = $heart->sql_query($sqlFeaturedProduct);
		while ($rowFeaturedProduct = $heart->sql_fetchrow($resultFeaturedProduct)) {
			$rowFeaturedProduct['pd_image'] = 'includes/thumbnail.php?path=../productImage/' . $rowFeaturedProduct['pd_image'] . '&width=165&height=73';
			$featuredProduct[] = $rowFeaturedProduct;
		}
		return $featuredProduct;
	}	
	
	function product_map($pid){
		global $cfg,$heart;
		$sql = "SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE pid='".$pid."'";
		$res = $heart->sql_query($sql);
		if ($row = $heart->sql_fetchrow($res))
		$cat =  "Product -> ".$row['pname'];
		else
		$cat = "Product";
		return $cat;
	}
	
	function getproductdetails($pd_id,$fld){
		global  $heart,$cfg;
		$sql_pd = "SELECT `".$fld."` FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$pdPrice 	= stripslashes($row_pd[$fld]);
		return $pdPrice;
	} 
	
	function proname($productId){
		global  $heart,$cfg;
		$sql_pt = "SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = '".$productId."'";
		$res_pt = $heart->sql_query($sql_pt);
		$row_pt	=	$heart->sql_fetchrow($res_pt);
		$pt_name 	= 	$row_pt['pd_name'];
		return $pt_name;
	}
	function productinfo($productid){
		global  $heart,$cfg;
		$sql_pt = "SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = '".$productid."'";
		$res_pt = $heart->sql_query($sql_pt);
		$row_pt	=	$heart->sql_fetchrow($res_pt);
		$product_info 	= 	$row_pt['pd_name'].$row_pt['pd_description'];
		return $product_info;
	}
	function delete_product($pid){
		global $cfg,$heart;
		$sql = "DELETE FROM ".$cfg['DB_PRODUCT']." WHERE pid='".$pid."'";
		$res = $heart->sql_query($sql);
		$sql = "DELETE FROM ".$cfg['DB_PRODUCT_PROPERTY']." WHERE pid='".$pid."'";
		$res = $heart->sql_query($sql);
	}
	
	function countRightbar(){
		global $cfg,$heart;$num;
		$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_rightbar`='A' ";
		$res=$heart->sql_query($sql);
		$num=$heart->sql_numrows($res);	
		return $num;	
	}
	
	function addonval($id){
		global  $heart,$cfg;
		$sql_addon="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `status`='A' AND `isAddon` =".$id."";
		$res_addon=$heart->sql_query($sql_addon);
		$maxrow=$heart->sql_numrows($res_addon);
		if($maxrow >0){
			while($row_addon=$heart->sql_fetchrow($res_addon)){
				$catid 	= 	$maxrow ;
				return $catid;
			}
		}
	}
	
##########################################################<<<<<<<<<<<<<<<   CART FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function getPdQtyinCart(){
		global  $heart,$cfg;
		$cartContent = array();
		$sid = session_id();
		$sql = "SELECT ct_id, ct.pd_id, ct_qty, pd_name, pd_price, pd_image, pd.cat_id
					FROM ".$cfg['DB_CART']." ct, ".$cfg['DB_PRODUCT']." pd, ".$cfg['DB_CATEGORY']." cat
					WHERE ct_session_id = '$sid' AND ct.pd_id = pd.pd_id AND cat.cat_id = pd.cat_id";
					
		$result = $heart->sql_query($sql);
		while ($row = $heart->sql_fetchrow($result)) {
			$row['pd_image'] = 'includes/thumbnail.php?path=../productImage/' . $row['pd_image'] . '&width=60&height=60';
			$cartContent[] = $row;
		}
		return $cartContent;
	}
	
	function getCartContent(){
		global  $heart,$cfg;
		$cartContent = array();
		$sid = session_id();
		$sql = "SELECT ct_id, ct.pd_id,pd.pd_code,ct.siteId, ct_qty, pd_name, pd_price, pd_image, pd.category,ct.shipping_type_charges
				 FROM ".$cfg['DB_CART']." ct, ".$cfg['DB_PRODUCT']." pd
				 WHERE ct_session_id = '$sid' AND ct.pd_id = pd.pd_id AND ct.siteId ='".$_SESSION['site']."'" ;		$result = $heart->sql_query($sql);
		while ($row = $heart->sql_fetchrow($result)) {
			$row['pd_image'] = $cfg['PRODUCT_IMAGES']. $row['pd_image'];
			$cartContent[] = $row;
		}
		return $cartContent;
	}
	
	function deleteAbandonedCart(){
		global  $heart,$cfg;
		$yesterday = date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
		$sql = "DELETE FROM ".$cfg['DB_CART']." WHERE `ct_date` < '".$yesterday."'";
		$heart->sql_query($sql);		
	}

	function getShopConfig(){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_SHOP_CONFIG']."WHERE `siteId`='".$_SESSION['site']."'";
		$result = $heart->sql_query($sql);
		$row    = $heart->sql_fetchrow($result);
		if ($row) {
			extract($row);
			$shopConfig = array('name'           		=> $sc_name,
				'address'        		=> $sc_address,
				'phone'          		=> $sc_phone,
				'email'          		=> $sc_email,
				'sendOrderEmail' 		=> $sc_order_email,
				'shippingCost'   		=> $sc_shipping_cost,
				'free_shipping_limit' 	=> $sc_free_shipping_limit,
				'currency'       		=> $cy_symbol);
		} else {
			$shopConfig = array('name'           		=> '',
			'address'        		=> '',
			'phone'          		=> '',
			'email'          		=> '',
			'sendOrderEmail' 		=> '',
			'shippingCost'   		=> '',
			'free_shipping_limit' 	=> '',
			'currency'      		=> '');    
		}
		return $shopConfig;						
	}
	
	function displayFrontAmount($amount){
		global $shopConfig;
		return  number_format($amount);
	}
	
	function deleteFromCart($cartId = 0){
		global  $heart,$cfg;
		if (!$cartId && isset($_GET['cid']) && (int)$_GET['cid'] > 0) {
			$cartId = (int)$_GET['cid'];
		}
		if ($cartId) {	
			$sql  = "DELETE FROM ".$cfg['DB_CART']." WHERE ct_id = $cartId";
			$result = $heart->sql_query($sql);
		}
		header('Location: cart.php');	
	}
	
	function isCartEmpty(){
		global  $heart,$cfg;
		$isEmpty = false;
		$sid = session_id();
		$sql = "SELECT ct_id FROM ".$cfg['DB_CART']." ct WHERE ct_session_id = '$sid'";
		$result = $heart->sql_query($sql);
		if ($heart->sql_numrows($result) == 0) {
			$isEmpty = true;
		}	
		return $isEmpty;
	}
	
##########################################################<<<<<<<<<<<<<<<   COUNTRY FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function countryName($countryID){
		global  $heart,$cfg;
		$sql_country = "SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE `country_id` = '".$countryID."'";
		$res_country = $heart->sql_query($sql_country);
		$row_country	=	$heart->sql_fetchrow($res_country);
		$country_name 	= 	$row_country['country_name'];
		return $country_name;
	}
	
	function countryAbb($countryID){
		global  $heart,$cfg;
		$sql_country = "SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE `country_id` = '".$countryID."'";
		$res_country = $heart->sql_query($sql_country);
		$row_country	=	$heart->sql_fetchrow($res_country);
		$country_abbreviation 	= 	$row_country['country_abbreviation'];
		return $country_abbreviation;
	}
	
	function getCountryList($country_id, $class, $CountryId){
		global  $heart,$cfg;
		$CountryId = ($CountryId!="")?$CountryId:'countryId';
		$str='';
		$sqlCountry="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']."WHERE `status`= 'A' ORDER BY `country_name` ASC";
		$resCountry=$heart->sql_query($sqlCountry);
		$str.= '<select name="'.$CountryId.'" id="'.$CountryId.'" size="1" class="'.$class.'">
				<option value="0">SELECT COUNTRY</option>';
		while($rowCountry=$heart->sql_fetchrow($resCountry)) { 
			$str.='<option value="'.$rowCountry['country_id'].'" '.(($rowCountry['country_id']==$country_id)?'selected="selected"':'').'>'.$rowCountry['country_name'].'</option>';
		}								
		$str.='</select>';
		return $str;
	}	
	
	function country_name($country_id){
		global  $heart,$cfg;
		if(trim($country_id)) $sql = "SELECT * FROM ".$cfg['DB_COUNTRY']." WHERE countries_id = '".$country_id."'";
		else  $sql = "SELECT * FROM ".$cfg['DB_COUNTRY'];
		$res = $heart->sql_query($sql);
		if($heart->sql_numrows($res)!=0){
			while($row = $heart->sql_fetchrow($res)){
				$sel = ($row['countries_id']==$countries_id)?"selected":"";
				print "<option value='".$row['countries_id']."' ".$sel.">".$row['countries_name']."</option>\n";
			}
		}
	}
	
	function find_country_name($country_id){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_COUNTRY']." WHERE countries_id = '".$country_id."'";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		return $row['countries_name'];
	}
	
##########################################################<<<<<<<<<<<<<<<   STATE FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function show_state($id){
		global  $heart,$cfg;
		$sql = "SELECT *  FROM ".$cfg['DB_STATE']." WHERE stateId='".$id."' ";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		return $row['stateCode'];
	}
	
	function state_name($id){
		global  $heart,$cfg;
		$sql = "SELECT *  FROM ".$cfg['DB_STATE']." WHERE stateId='".$id."' ";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		return $row['stateName'];
	}
	
##########################################################<<<<<<<<<<<<<<<   CITY FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function city_name($id){
		global  $heart,$cfg;
		$sql = "SELECT *  FROM ".$cfg['DB_CITIES']." WHERE ct_id='".$id."' ";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		return $row['city_name'];
	}
	
	function getCountryNStateNCity($heart,$cfg,$country_id){
		$countryNStateNCityArr = array();
		$sql_country = "SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." 
								WHERE `country_id`='".$country_id."'
								  AND `status`!='D'";
		$res_country = $heart->sql_query($sql_country);
		$maxrow_country = $heart->sql_numrows($res_country);
		if($maxrow_country>0){
			$row_country = $heart->sql_fetchrow($res_country);
			$countryNStateNCityArr['Country']['Name'][$row_country['country_id']] = $row_country['country_name'] ;
			$sql_state = "SELECT *  FROM ".$cfg['DB_STATE']." 
								   WHERE `country_id`='".$row_country['country_id']."'
								     AND `status`!='D'";
			$res_state = $heart->sql_query($sql_state);
			$maxrow_state = $heart->sql_numrows($res_state);
			if($maxrow_state>0){
				while($row_state = $heart->sql_fetchrow($res_state)){
					$countryNStateNCityArr['Country']['Id'][$row_country['country_id']]['States']['Name'][$row_state['st_id']] =   $row_state['state_name'];
					$sql_city = "SELECT *  FROM ".$cfg['DB_CITY']." 
										  WHERE `state_id`='".$row_state['st_id']."'
											AND `status`!='D'";
					$res_city = $heart->sql_query($sql_city);
					$maxrow_city = $heart->sql_numrows($res_city);
					if($maxrow_city>0){
						while($row_city = $heart->sql_fetchrow($res_city)){
							$countryNStateNCityArr['Country']['Id'][$row_country['country_id']]['States']['Id'][$row_state['st_id']]['Cities']['Id'][$row_city['ct_id']] =$row_city['city_name'];
						}
					}
				}
			}
		}
		return $countryNStateNCityArr;	
	}
	
	
	
##########################################################<<<<<<<<<<<<<<<   ORDER FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################

	function getOrderID($str){
		global $heart,$cfg;
		$od=array();
		$sql_p="SELECT * FROM ".$cfg['DB_ORDER_ITEM']."  WHERE`pd_id` IN (".$str.")";   
		$res_p=$heart->sql_query($sql_p);
		$maxrow_p=$heart->sql_numrows($res_p);	 
		if($maxrow_p>0){
			while($row_p=$heart->sql_fetchrow($res_p)){  
			$od[] = $row_p['od_id'];
			}
			return implode(',',$od);
		}
	}
	
	function getOrderUserDetails($od_id){
		global  $heart,$cfg;
		$orderUserDetails = array();
		$sql = "SELECT od_date,od_payment_first_name, od_payment_last_name, od_payment_address1, od_payment_landmark, od_payment_city, od_payment_state, od_payment_country, od_payment_postal_code,od_payment_email FROM ".$cfg['DB_ORDER']." WHERE od_id = '".$od_id."'";
		$result = $heart->sql_query($sql);
		while ($row = $heart->sql_fetchrow($result)) {
			$orderUserDetails[] = $row;
		}
		return $orderUserDetails;
	}
	
	function saveOrder(){
		global  $heart,$cfg;
		$orderId       = 0;
		$shippingCost  = $_REQUEST['hidShippingCost'];
		$cartContent = getCartContent();
		$numItem     = count($cartContent);
		$dt=explode(" ",$hidShippingDate);
		$date=explode("-",$dt[0]);
		$fulldate=$date[2]."-".$date[1]."-".$date[0]." ".$dt[1];
		$sid = session_id();
			 $sql = "INSERT INTO ".$cfg['DB_ORDER'].
			"(`siteId`,`od_date`,`od_delivery_date`,`od_shipping_email`,`od_shipping_first_name`,`od_shipping_last_name`,`od_shipping_address1`,`od_shipping_landmark`,	
			`od_shipping_phone`,`od_shipping_state`,`od_shipping_city`,`od_shipping_postal_code`,`od_shipping_country`,`od_shipping_msg`,`od_shipping_sender_name`,
			`od_payment_first_name`,`od_payment_last_name`,`od_payment_address1`,`od_payment_landmark`,`od_payment_phone`,`od_payment_state`,`od_payment_city`,
			`od_payment_postal_code`,`od_payment_country`,`od_payment_email`,`cust_id`,`od_amount`,`od_shipping_type`,`od_shipping_cost`,`od_shipping_instruction` )
			SELECT     
			`siteId`,`od_date`,`od_delivery_date`,`od_shipping_email`,`od_shipping_first_name`,`od_shipping_last_name`,`od_shipping_address1`,`od_shipping_landmark`,	  
			`od_shipping_phone`,`od_shipping_state`,`od_shipping_city`,`od_shipping_postal_code`,`od_shipping_country`,`od_shipping_msg`,`od_shipping_sender_name`,
			`od_payment_first_name`,`od_payment_last_name`,`od_payment_address1`,`od_payment_landmark`,`od_payment_phone`,`od_payment_state`,`od_payment_city`,
			`od_payment_postal_code`,`od_payment_country`,`od_payment_email`,`cust_id`,`od_amount`,`od_shipping_type`,`od_shipping_cost`,`od_shipping_instruction`
			FROM ".$cfg['DB_TEMP_ORDER']." WHERE `od_session_id`='".$sid."'";
		
		$result = $heart->sql_query($sql);
		$orderId = mysql_insert_id();
		/// $update_sql="UPDATE ".$cfg['DB_ORDER']." SET `onlinepaymentcode` ='RFW-3600-'".$orderId." WHERE `od_id` = '".$orderId."'";
		$update_sql = " UPDATE ".$cfg['DB_ORDER']."
						SET `onlinepaymentcode` = 'RFW-3600-".$orderId."'
						WHERE `od_id` ='".$orderId."'"; 
		$heart->sql_query($update_sql);
		
		$sql = "DELETE FROM ".$cfg['DB_TEMP_ORDER']." WHERE `od_session_id`='".$sid."'";
		$result = $heart->sql_query($sql);
			
		$sql_p= "SELECT * FROM ".$cfg['DB_SHOP_CONFIG']." Where `siteId`='".$_SESSION['site']."'  ";
		$res_p = $heart->sql_query($sql_p);
		$row_p = $heart->sql_fetchrow($res_p);		
		
		$or_pattern = $row_p['order_id_pattern']."-".$orderId;
		$sql = " UPDATE ".$cfg['DB_ORDER']."	SET `or_pattern` = '".$or_pattern."' WHERE `od_id` = ".$orderId."  ";
		
		$result1 = $heart->sql_query($sql);	
		if ($orderId) {
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "INSERT INTO ".$cfg['DB_ORDER_ITEM']." (od_id, pd_id, od_qty,siteId)
				VALUES ($orderId, {$cartContent[$i]['pd_id']}, {$cartContent[$i]['ct_qty']},'".$_SESSION['site']."')";
				$result = $heart->sql_query($sql);					
			}

			for ($i = 0; $i < $numItem; $i++) {
				$sql = "DELETE FROM ".$cfg['DB_CART']."
				WHERE `ct_session_id`='".$sid."'";
				$result = $heart->sql_query($sql);					
			}							
		}					
	
		$sql_o="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_id` = '".$orderId."'"; 
		$res=$heart->sql_query($sql_o);	
		$row_o=$heart->sql_fetchrow($res);
		
		$to_name = $row_o['od_shipping_first_name']."&nbsp;".$row_o['od_shipping_last_name'];
		$from_name = $cfg['STUFF_NAME'];
		$from_email = $cfg['ADMIN_ORDER_EMAIL'];
		$to_email  = $row_o['od_shipping_email'];
		$subject = 'Rainbow Florist';
		
		$stringbuilder=
		
		"<table width='580' cellspacing='10' cellpadding='10' border='0' align='center' style='border:solid 1px #aed9fb'>
		<tbody>
		<tr>
		<td width='159' height='65' style='padding:12px 0px'>
		<a target='_blank' href='".$cfg['base_url']."'>
		<img src='".$cfg['base_url'].$cfg['IMAGES'].'new_logo.png'."' width='147' height='65' border='0'/>
		
		</a>							
		</td>
		<td width='421'>
		<p style='color:#7e8f9f;font-size:20px;font-family:Verdana,Helvetica,sans-serif;margin:5px 75px 0 0px;text-align:right'>Call us on :</p>
		<p style='color:#135a9c;font-size:22px;font-weight:bold;font-family:Verdana,Helvetica,sans-serif;margin:0px 0 10px 0;text-align:right'>
		+91-8080909029  <br/> +91-7666609786    							
		</p>						
		</td>
		</tr>
		<tr>
		<td style='border-top:dashed 1px #000' colspan='2'>
		<table width='100%' cellspacing='0' cellpadding='0' border='0' style='margin:8px 0 0px 0'>
		<tbody>
		<tr> 
		<td valign='top' width='76%'>
		<p style='margin:10px 0 5px 0;font-size:26px;font-weight:bold;color:#313c46;font-family:Verdana,Helvetica,sans-serif'>
		Dear ".$row_o['od_payment_first_name'].",    								   
		</p>
		<p style='margin:0px 0 0 0;font-size:20px;font-weight:bold;color:#ef7818;font-family:Verdana,Helvetica,sans-serif'>
		Thank you for placing your order  with us.    								   
		</p>									 
		</td>
		<td width='24%'><img src='".$cfg['base_url'].$cfg['PRODUCT_IMAGES'].'14_14.jpg'."' width='140' height='120' ></td>
		</tr>
		</tbody>
		</table>							
		</td>
		</tr>
		<tr>
		<td colspan='2'>
		<p style='margin:0px 0px 12px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px'>
		Your order has been successfully placed and you will be receiving your merchandise shortly!!!    						
		</p>
		<p style='margin:8px 0px 12px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px'>   						
		</p>
		<p style='margin:8px 0px 12px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px'>
		Moving on here are the details of your order:    						
		</p>
		<div style='margin:15px auto;width:540px'>
		<table width='540' cellspacing='0' cellpadding='0' border='1' align='center' style='border:solid 1px #b8b2db'>
		<tbody>
		<tr>
		<td valign='top' width='73' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
		Order ID    							  
		</td>
		<td colspan='2' valign='top' width='73' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
		Product Name    							  
		</td>
		<td valign='top' width='73' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
		Quantity								  
		</td>
		<td valign='top' width='95' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
		Final Amount    							  
		</td>
		<td valign='top' width='56' align='center' style='font-family:Verdana,Helvetica,sans-serif;font-size:13px;color:#333333;padding:7px 0 7px 0px;font-weight:bold'>
		Status    							  
		</td>
		</tr>";
		@$myvar="";
		$sql_od = "SELECT * FROM ".$cfg['DB_ORDER_ITEM']." WHERE `od_id` = '".$orderId."'  ";
		$res_od = $heart->sql_query($sql_od);
		while($row_od =	$heart->sql_fetchrow($res_od)){
			$myvar.="<tr>
			<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
			".getallordersdetails($row_od['od_id'],'or_pattern')."							
			</td>
			<td colspan='2' style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>			
			<img src='".$cfg['base_url'].$cfg['PRODUCT_IMAGES'].getproductdetails($row_od[pd_id],'pd_image')."' width='70' align='center'/><br/>	
			".pd_name($row_od['pd_id'])."		
			</td>
			<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
			".$row_od['od_qty']."							
			</td>
			
			<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
			<img src='".$cfg['base_url'].$cfg['IMAGES'].'rs_b.png'."' width='10' height='10' />".pd_price($row_od['pd_id']) * $row_od['od_qty']."						
			</td>
			<td style='font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#333333;padding:7px 0 7px 10px' align='center'>
			".getallordersdetails($row_od['od_id'],'od_status')."  									
			</td>
			</tr>";
		}
	
		$footer="</tbody>
				</table>
				</div>
				
				<p style='margin:8px 0px 14px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:17px'>
				<strong>NOTE:</strong>
				<ol style='margin:8px 0px 14px -20px;font-family:Verdana,Helvetica,sans-serif;font-size:12px;color:#333333!important;line-height:20px'>
				<li>   
				Keep your order number handy for any future communication with us regarding this order. In case you have ordered for more than one products, the delivery might happen separately for each product.							    
				</li>
				<li>	
				Your Shipping and Billing information have been upadated. Please do login to minimize your entries on your next visting.Thank you for shopping with us.    			</li>
				</ol>
				</p>						 
				</td>
				</tr>
				
				<tr>
				<td align='center' colspan='2'>
				<p style='margin:0px 0px 4px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:24px;font-weight:bold;color:#26baf1'>
				Happy <span style='color:#94d01f'> Shopping!! </span>						  
				</p>
				<p style='margin:5px 0px 15px 0px;font-family:Verdana,Helvetica,sans-serif;font-size:14px;color:#666666'>".$cfg['ADMIN_NAME']."</p>						 						  
				</td>
				</tr>
				</tbody>
				</table>";
		$message=$stringbuilder.$myvar.$footer;
		send_mail($cfg['ADMIN_NAME'], $to_email, $from_name, $from_email, $subject, $message, $bcc='');
		return $orderId;
	}
	
	function getOrderAmount($orderId){
		global  $heart,$cfg;
		$orderAmount = 0;
		$promoRate = '';
		$proCode = ($_REQUEST['proCode']!="")?$_REQUEST['proCode']:'null';
		if($proCode!='null'){
			$sqlp = "SELECT * FROM ".$cfg['DB_PROMO']." WHERE `proCode` = '".$proCode."'";
			$resultp = $heart->sql_query($sqlp);
			$maxrowp = $heart->sql_numrows($resultp);
			$rowp = $heart->sql_fetchrow($resultp);
			if($maxrowp>0){
				$promoRate = $rowp['proDis'];
			}
		}
		$sql = "SELECT SUM(pd_price * od_qty)
				  FROM ".$cfg['DB_ORDER_ITEM']." oi, ".$cfg['DB_PRODUCT']." p 
				 WHERE oi.pd_id = p.pd_id 
				   AND oi.od_id = '".$orderId."'
				 UNION
					SELECT od_shipping_cost 
					  FROM ".$cfg['DB_ORDER']."
					 WHERE od_id = '".$orderId."'";
		$result = $heart->sql_query($sql);
		if ($heart->sql_numrows($result) == 2) {
			$row = $heart->sql_fetchrow($result);
			$totalPurchase = $row[0];
			$shippingCost = $row[1];
			$totalPurchase = $totalPurchase - ( $totalPurchase * ($promoRate/100));
			$orderAmount = $totalPurchase + $shippingCost;
		}	
		return $orderAmount;	
	}
	
	function modifyOrder($orderId,$status1,$status2,$delivered_by,$feedback,$received,$del_time,$receive_through){
		global  $heart,$cfg;
		 $curdate=date('Y-m-d');
		 $sql = " UPDATE ".$cfg['DB_ORDER']."
					SET `od_status` = '".$status1."', 
						`od_delivery_status` = '".$status2."', 
						`od_delivery_date` ='".$del_time."',
						`od_delivered_by` = '".$delivered_by."',
						`od_feedback` = '".$feedback."',
						`od_received_by` = '".$received."',
						`received_option`='".$receive_through."',
						`od_last_update` = '".$curdate."'
				  WHERE `od_id` = '".$orderId."'";
		$result = $heart->sql_query($sql);
	}
	
	function getallordersdetails($pd_id,$fld){
		global  $heart,$cfg;
		$sql_pd = "SELECT `".$fld."` FROM ".$cfg['DB_ORDER']." WHERE `od_id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$pdPrice 	= stripslashes($row_pd[$fld]);
		return $pdPrice;
	} 
	function getPaypalAmount($amount)
	{
		global  $heart,$cfg;
		
		$sql	= "SELECT * FROM ".$cfg['DB_CURRENCY_SETTING']." ";
		$result	= $heart->sql_query($sql);
		$row	= $heart->sql_fetchrow($result);
		$indianvalue	= $row['indian_value'];
		$Amount	= $amount/$indianvalue;
		return $Amount;
		
	}
	
##########################################################<<<<<<<<<<<<<<<   LOCATION FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
		
	function getlocationname_individual($pd_id){
		global  $heart,$cfg;
		$sql_pd = "SELECT `name` FROM ".$cfg['DB_LOCATION']." WHERE `id` IN (".$pd_id.") ";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		return $row_pd['name'];
	} 
	
	function getlocationname($pd_id){
		global  $heart,$cfg;
		$loc=array();
		$sql_pd = "SELECT `name` FROM ".$cfg['DB_LOCATION']." WHERE `id` IN (".$pd_id.") ";
		$res_pd = $heart->sql_query($sql_pd);
		$maxrow_pd=$heart->sql_numrows($res_pd);
		if($maxrow_pd>0){
			while($row_pd	=	$heart->sql_fetchrow($res_pd)){
				$loc[] = stripslashes($row_pd['name']);
			}
			return implode(', ',$loc);
		}	
	} 
	
##########################################################<<<<<<<<<<<<<<<   PRICE FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function getpricerangeid(){
		global  $heart,$cfg;
		$sql_country = "SELECT * FROM ".$cfg['DB_PRICERANGE']." WHERE `status`='A'";
		$res_country = $heart->sql_query($sql_country);
		$row_country	=	$heart->sql_fetchrow($res_country);
		$descr 	= 	$row_country['id'];
		return $descr;
	}
	
	function currency(){
		global  $heart,$cfg;
		$sql_conf = "SELECT * FROM ".$cfg['DB_SHOP_CONFIG']." ";
		$res_conf = $heart->sql_query($sql_conf);
		$row_conf =	$heart->sql_fetchrow($res_conf);
		$cy_id = $row_conf['sc_currency'];
		$sql_cms = "SELECT * FROM ".$cfg['DB_CURRENCY']." WHERE `cy_id` = '".$cy_id."'";
		$res_cms = $heart->sql_query($sql_cms);
		$row_cms	=	$heart->sql_fetchrow($res_cms);
		$cy_code 	= 	$row_cms['cy_code'];
		return $cy_code;
	}
	
	function shipping_cost(){
		global  $heart,$cfg;
		$sql_conf = "SELECT * FROM ".$cfg['DB_SHOP_CONFIG']." ";
		$res_conf = $heart->sql_query($sql_conf);
		$row_conf =	$heart->sql_fetchrow($res_conf);
		$sc_shipping_cost = $row_conf['sc_shipping_cost'];
		return $sc_shipping_cost;
	}
	
	function currency_symbol(){
		global  $heart,$cfg;
		$sql_conf = "SELECT * FROM ".$cfg['DB_SHOP_CONFIG']." ";
		$res_conf = $heart->sql_query($sql_conf);
		$row_conf =	$heart->sql_fetchrow($res_conf);
		$cy_id = $row_conf['sc_currency'];
		$sql_cms = "SELECT * FROM ".$cfg['DB_CURRENCY']." WHERE `cy_id` = '".$cy_id."'";
		$res_cms = $heart->sql_query($sql_cms);
		$row_cms	=	$heart->sql_fetchrow($res_cms);
		$cy_symbol 	= 	$row_cms['cy_symbol'];
		return $cy_symbol;
	}
	
	function displayAmount($od_id){
		global  $heart,$cfg;
		$subTotal = subTotal($od_id);
		$shipping_cost = shipping_cost();
		$total = ($subTotal + $shipping_cost);
		$totPrice = $total;
		return $totPrice;
	}
	
	function subTotal($od_id){
		global  $heart,$cfg;
		$subTotal=0;
		$sql_od = "SELECT * FROM ".$cfg['DB_ORDER_ITEM']." WHERE `od_id` = '".$od_id."'";
		$res_od = $heart->sql_query($sql_od);
		while($row_od =	$heart->sql_fetchrow($res_od)){
			$pd_id 	= 	$row_od['pd_id'];
			$sql_pd = "SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = '".$pd_id."'";
			$res_pd = $heart->sql_query($sql_pd);
			$row_pd	=	$heart->sql_fetchrow($res_pd);
			$subTotal = $subTotal + (pd_price($row_od['pd_id']) * $row_od['od_qty']);	
		}
		$currency_symbol = currency_symbol();
		$subTot = $subTotal;
		return $subTot;
	}
	
	function getrangedetails($pd_id,$fld){
		global  $heart,$cfg;
		$sql_pd = "SELECT `".$fld."` FROM ".$cfg['DB_PRICERANGE']." WHERE `id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$pdPrice 	= stripslashes($row_pd[$fld]);
		return $pdPrice;
	} 
	
##########################################################<<<<<<<<<<<<<<<   DISCLAIMER FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function getdisclaimerfront($dis){
		global  $heart,$cfg;
		$sql_country = "SELECT * FROM ".$cfg['DB_DISCLAIMER']." WHERE `d_id` = '".$dis."' AND `status`='A'";
		$res_country = $heart->sql_query($sql_country);
		$row_country	=	$heart->sql_fetchrow($res_country);
		$title 	= 	$row_country['title'];
		$descr 	= 	$row_country['description'];
		$arka ='Title:  '.$title.'<br/>Description:  '.$descr;
		return $descr;
	}

	function getdisclaimer($dis){
		global  $heart,$cfg;
		$sql_country = "SELECT * FROM ".$cfg['DB_DISCLAIMER']." WHERE `d_id` = '".$dis."'";
		$res_country = $heart->sql_query($sql_country);
		$row_country	=	$heart->sql_fetchrow($res_country);
		$title 	= 	$row_country['title'];
		$descr 	= 	$row_country['description'];
		$arka ='Title:  '.$title.'<br/>Description:  '.$descr;
		return $arka;
	}	

##########################################################<<<<<<<<<<<<<<<   NOTES FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function getnotes($dis){
		global  $heart,$cfg;
		$sql_country = "SELECT * FROM ".$cfg['DB_NOTES']." WHERE `n_id` = '".$dis."'";
		$res_country = $heart->sql_query($sql_country);
		$row_country	=	$heart->sql_fetchrow($res_country);
		$title 	= 	$row_country['title'];
		$descr 	= 	$row_country['description'];
		$arka ='Title:  '.$title.'<br/>Description:  '.$descr;
		return $arka;
	}
	
	function getnotesfront($dis){
		global  $heart,$cfg;
		$sql_country = "SELECT * FROM ".$cfg['DB_NOTES']." WHERE `n_id` = '".$dis."' AND `status`='A'";
		$res_country = $heart->sql_query($sql_country);
		$row_country	=	$heart->sql_fetchrow($res_country);
		$title 	= 	$row_country['title'];
		$descr 	= 	$row_country['description'];
		$arka ='Title:  '.$title.'<br/>Description:  '.$descr;
		return $descr;
	}
	
##########################################################<<<<<<<<<<<<<<<   CUSTOMER FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################

	function user_name($userId){
		global  $heart,$cfg;
		$sql_usr = "SELECT * FROM ".$cfg['DB_USER']." WHERE `user_id` = '".$userId."'";
		$res_usr = $heart->sql_query($sql_usr);
		$row_usr	=	$heart->sql_fetchrow($res_usr);
		$usrName 	= 	$row_usr['user_name'];
		return $usrName;
	}
	
	function username($userId){
		global $heart,$cfg;
		$sql="SELECT usrName FROM ".$cfg['DB_USER']." WHERE  uid =".$userId."";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		return $row['usrName'];
	}
	
	function admin_user($uid,$photo) {
		return "../includes/thumbnail.php?path=../user_photo/".$uid."/".$photo."&width=32&height=32";
	}

	function uname($uid){
		global $heart, $cfg;
		$sql = "SELECT * FROM ".$cfg['DB_MEMBER']." WHERE uid='".$uid."'";
		$res = $heart->sql_query($sql);
		if($heart->sql_numrows($res)!=0){
			$row = $heart->sql_fetchrow($res);
			return $row['user_name'];
		}else{
			$none = "<font name='#ff0000'>none</font>";
			return $none;
		}
	}
	
	function user_photo($uid){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_MEMBERS']." WHERE uid='".$uid."'";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		return "<img src=\"../includes/thumbnailproduct.php?path=../user_photo/".$row['photo']."&width=".$cfg['BIMG_W']."&height=".$cfg['BIMG_H']."\" name=\"".$row['firstname']."&nbsp;".$row['lastname']."\" border=\"0\" />";
	}
	
	function usrName($usrid){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_USER']." WHERE `userId` = '".$usrid."'";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		if($row['eStatus']=='A') return $row['eEmail'];
		else return ''; 
	}
	
	function getUserDetails(){
		global  $heart,$cfg;
		$userDetails = array();
		
		$uid = $_SESSION['login_userId'];
		$sql = "SELECT user_name, user_password, user_first_name, user_last_name, user_shipping_address1, user_shipping_address2, user_phone, user_city, user_state, user_country_id, user_postal_code FROM ".$cfg['DB_USER']." WHERE user_id = '".$uid."'";
		$result = $heart->sql_query($sql);
		while ($row = $heart->sql_fetchrow($result)) {
			$userDetails[] = $row;
		}
		return $userDetails;
	}
	
	function getUserFirstName(){
		global  $heart,$cfg;
		$uid = $_SESSION['login_userId'];
		$sql = "SELECT `user_first_name` FROM ".$cfg['DB_USER']." WHERE user_id = '".$uid."'";
		$result = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($result);
		$userfName = $row['user_first_name'];
		return $userfName;
	}
	
	function getcustdetailsall($uid,$fld){
		global  $heart,$cfg;
		$sql_pd = "SELECT `".$fld."` FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE `cust_id` = '".$uid."' AND `siteId`='".$_SESSION['site']."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$pdPrice 	= stripslashes($row_pd[$fld]);
		return $pdPrice;
	}
	
	function autoRegister(){
		global  $heart,$cfg;
		$hidShippingEmail	   = $_REQUEST['hidShippingEmail'];			
		$hidShippingDate 	   = ucwords($_REQUEST['hidShippingDate']);				
		$hidShippingFirstName  = ucwords(addslashes($_REQUEST['hidShippingFirstName']));
		$hidShippingLastName   = ucwords(addslashes($_REQUEST['hidShippingLastName']));
		$hidShippingAddress1   = addslashes(str_replace("\r"," ",str_replace("\n"," ",$_REQUEST['hidShippingAddress1'])));
		$hidShippingCountry    = $_REQUEST['hidShippingCountry'];
		$hidShippingState  	   = addslashes($_REQUEST['hidShippingState']);
		$hidShippingCity       = ucwords(addslashes($_REQUEST['hidShippingCity']));
		$hidShippingPostalCode = addslashes($_REQUEST['hidShippingPostalCode']);
		$hidShippingLandMark   = addslashes($_REQUEST['hidShippingLandMark']);
		$hidShippingPhone	   = addslashes($_REQUEST['hidShippingPhone']);
		$hidShippingMsg 	   = addslashes($_REQUEST['hidShippingMsg']);
		$hidShippingSenderName = addslashes($_REQUEST['hidShippingSenderName']);
		$hidShippingIns		   = addslashes($_REQUEST['hidShippingIns']);
		$amount 			   = addslashes($_REQUEST['grndAmount']);
		$cust_id               = $_REQUEST['cust_id'];
		$hidPaymentFirstName   = ucwords(addslashes($_REQUEST['hidPaymentFirstName']));
		$hidPaymentLastName    = ucwords(addslashes($_REQUEST['hidPaymentLastName']));
		$hidPaymentAddress1	   = addslashes(str_replace("\r"," ",str_replace("\n"," ",$_REQUEST['hidPaymentAddress1'])));
		$hidPaymentCountry	   = $_REQUEST['hidPaymentCountry'];
		$hidPaymentState	   = addslashes($_REQUEST['hidPaymentState']);
		$hidPaymentCity        = ucwords(addslashes($_REQUEST['hidPaymentCity']));
		$hidPaymentPostalCode  = addslashes($_REQUEST['hidPaymentPostalCode']);
		$hidPaymentLandMark	   = addslashes($_REQUEST['hidPaymentLandMark']);
		$hidPaymentPhone	   = addslashes($_REQUEST['hidPaymentPhone']);
		$hidPaymentEmail	   = addslashes($_REQUEST['hidPaymentEmail']);		
		$s_id				   = $_REQUEST['s_id'];
		$sql="SELECT * FROM ".$cfg['DB_TEMP_ORDER']." WHERE `od_session_id` = '".$s_id."'";
		$res=$heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		$maxrow=$heart->sql_numrows($res);
		if($maxrow>0){
			if($row['cust_id']==0){
				$passwd1= str_rand();
				$passwd=$heart->encoded($passwd1);
				$sql1="INSERT INTO ".$cfg['DB_CUSTOMER']."
				SET 
				`email` = '".$_REQUEST['hidShippingEmail']."',
				`password` = '".$passwd."',
				`status`='A',
				`date`=NOW()";	
				$heart->sql_query($sql1);
				$id=mysql_insert_id();
				$sql_b="INSERT INTO " .$cfg['DB_CUSTOMER_DETAILS']. "(`cust_id`,`fname`,`lname`,`phone`,`address`,`landmark`,`city`,`state`,`country`,`pincode`,`details`,`salutation`) VALUES ('".$id."','".$hidPaymentFirstName."','".$hidPaymentLastName."','".$hidPaymentPhone."','".$hidPaymentAddress1."','".$hidShippingLandMark."','".$hidPaymentCity."','".$hidPaymentState."','".$hidPaymentCountry."','".$hidPaymentPostalCode."','billing','')";
				
				$sql_s="INSERT INTO " .$cfg['DB_CUSTOMER_DETAILS']. "(`cust_id`,`fname`,`lname`,`phone`,`address`,`landmark`,`city`,`state`,`country`,`pincode`,`details`,`salutation`) VALUES ('".$id."','".$hidShippingFirstName."','".$hidShippingLastName."','".$hidShippingPhone."','".$hidShippingAddress1."','".$hidPaymentLandMark."','".$hidShippingCity."','".$hidShippingState."','".$hidShippingCountry."','".$hidShippingPostalCode."','shipping','')";
				
				$heart->sql_query($sql_b);
				$heart->sql_query($sql_s);
				
				$sql_t="UPDATE ".$cfg['DB_TEMP_ORDER']." SET `cust_id`='".$id."' WHERE `od_session_id` = '".$s_id."'";
				$heart->sql_query($sql_t);
				$sqlchecknews="SELECT * FROM ".$cfg['DB_NEWSLETTER_EMAIL']." WHERE  `email` ='".$_REQUEST['hidShippingEmail']."'";
				$reschecknews=$heart->sql_query($sqlchecknews);
				$numchecknews=$heart->sql_numrows($reschecknews);
				if($numchecknews==0){
					$sql_src="INSERT INTO ".$cfg['DB_NEWSLETTER_EMAIL']." (`name`,`email`,`date`,`status`) VALUES ('".$hidShippingFirstName.$hidShippingLastName."','".$_REQUEST['hidShippingEmail']."',NOW(),'A')";
					$heart->sql_query($sql_src);
				}
				$to_name = $hidShippingFirstName.$hidShippingLastName; 
				$to_email  = $hidShippingEmail;				
				$from_name =$cfg['ADMIN_NAME'];
				$from_email = $cfg['ADMIN_EMAIL'];				
				$subject = 'Rainbow Florist World';
				$message = 'You have registered with our site : <br><br>				
				Your Id:'.$hidShippingEmail.'<br>
				Your Password:'.$heart->decoded($passwd).'<br>
				You can change your password later.	
				<br>Regards<br>'.$cfg['ADMIN_NAME'].'<br>'."Rainbow Florist World";
				send_mail($to_name, $to_email, $from_name, $from_email, $subject, $message, $bcc='');
			}
			else{
				$sql_b="UPDATE " .$cfg['DB_TEMP_ORDER']. " 
				SET 
				`od_date`='".date("Y-m-d H:i:s")."',
				`od_delivery_date`='".$hidShippingDate."',
				`od_shipping_first_name`='".$hidShippingFirstName."',
				`od_shipping_last_name`='".$hidShippingLastName."',
				`od_shipping_landmark`='".$hidShippingLandMark."',
				`od_shipping_phone`='".$hidShippingPhone."',
				`od_shipping_address1`='".$hidShippingAddress1."',
				`od_shipping_city`='".$hidShippingCity."',
				`od_shipping_state`='".$hidShippingState."',
				`od_shipping_country`='".$hidShippingCountry."',
				`od_shipping_postal_code`='".$hidShippingPostalCode."' ,
				`od_amount`='".$amount."' ,
				`od_shipping_sender_name`='".$hidShippingSenderName."' ,
				`od_shipping_msg`='".$hidShippingMsg."' ,
				`od_shipping_instruction`='".$hidShippingIns."' ,
				`od_last_update`='".date("Y-m-d H:i:s")."',
				
				`od_payment_first_name`='".$hidPaymentFirstName."',
				`od_payment_last_name`='".$hidPaymentLastName."',
				`od_payment_phone`='".$hidPaymentPhone."',
				`od_payment_landmark`='".$hidPaymentLandMark."',
				`od_payment_address1`='".$hidPaymentAddress1."',
				`od_payment_city`='".$hidPaymentCity."',
				`od_payment_state`='".$hidPaymentState."',
				`od_payment_country`='".$hidPaymentCountry."',
				`od_payment_postal_code`='".$hidPaymentPostalCode."' ,
				`od_payment_email`='".$hidPaymentEmail."' 
				WHERE `cust_id` ='".$cust_id."' AND `od_session_id` = '".$s_id."'"; 
				$heart->sql_query($sql_b);
			} 
		}
		return 1;
	}
	
##########################################################<<<<<<<<<<<<<<<   PAGE-CONTENT FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function cmsName($cmsId){
		global  $heart,$cfg;
		$sql_cms = "SELECT * FROM ".$cfg['DB_PAGECONTENT']." WHERE `cmsId` = '".$cmsId."' AND `cmsStatus`= 'A'";
		$res_cms = $heart->sql_query($sql_cms);
		$row_cms	=	$heart->sql_fetchrow($res_cms);
		$cmsName 	= stripslashes($row_cms['cmsName']);
		return $cmsName;
	}
	
	function pagecontent($pageid){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_PAGECONTENT']." WHERE `cmsId` = '".$pageid."'  AND `cmsStatus`= 'A' ";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		if($row['cmsStatus']=='A') return stripslashes($row['content']);
		else return ''; 
	}
	
	function pageName($pageid){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_PAGECONTENT']." WHERE `cmsId` = '".$pageid."'";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		if($row['cmsStatus']=='A') return $row['cmsName'];
		else return ''; 
	}
	
	function pageLink($pageid){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_PAGECONTENT']." WHERE `cmsId` = '".$pageid."'";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		if($row['cmsStatus']=='A') return $row['linkFile'];
		else return ''; 
	}
	
##########################################################<<<<<<<<<<<<<<<   BANNER FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function rightbanner(){
		global  $heart,$cfg;
		$sql = "SELECT *  FROM ".$cfg['DB_BANNER']." WHERE banner_pos='right' ORDER BY banner_order ASC"; 
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrowset($res);
		return $row;
	}
	
	function bottombanner(){
		global  $heart,$cfg;
		$sql = "SELECT *  FROM ".$cfg['DB_BANNER']." WHERE banner_pos='bottom' ORDER BY banner_order ASC"; 
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrowset($res);
		return $row;
	}	
	
	function getLink($id){
		global  $heart,$cfg;$link;
		$sql1="SELECT `banner_link` FROM ".$cfg['DB_BANNER']." WHERE `status` = 'A' AND `banner_id`='".$id."'";
		$res1=$heart->sql_query($sql1);
		$row1=$heart->sql_fetchrow($res1);
		$link = $row1['banner_link'];
		if($link) return $link;

		else return '0';
	}
	
	function getbannerImageName($bannerId){
		global  $heart,$cfg;
		echo $sql="SELECT `banner_img` FROM ".$cfg['DB_BANNER']." 
								 WHERE `status` = 'A' 
								  AND `banner_id`='".$bannerId."'";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		$bannerImage = $row['banner_img'];
		return $bannerImage;
	}
	
	
##########################################################<<<<<<<<<<<<<<<   COLOR FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function getcolorname($pd_id){
		global  $heart,$cfg;
		$sql_pd = "SELECT `name` FROM ".$cfg['DB_COLOR']." WHERE `id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$pdPrice 	= stripslashes($row_pd['name']);
		return $pdPrice;
	} 
	
	function getcolorcode($pd_id){
		global  $heart,$cfg;
		$sql_pd = "SELECT `code` FROM ".$cfg['DB_COLOR']." WHERE `id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$pdPrice 	= stripslashes($row_pd['code']);
		return $pdPrice;
	} 	
	
##########################################################<<<<<<<<<<<<<<<   DATE & TIME FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function getdataformat1($submit_date){
		$ds=array();
		$p=array();
		$ds=explode(" ",$submit_date);
		$ds=explode("-",$ds[0]);
		$p[0]=$ds[2];
		$p[1]=$ds[1];
		$p[3]=$ds[0];
		$t=implode("-",$p);
		return $t;
	}
	
	function getdataformat($submit_date){
		$p=array();
		$ds=explode("-",$submit_date);
		$p[0]=$ds[2];
		$p[1]=$ds[1];
		$p[3]=$ds[0];
		$t=implode("-",$p);
		return $t;
	}
	
	function getDifference($startDate,$endDate,$format){
		list($date,$time) = explode(' ',$endDate);
		$startdate = explode("-",$date);
		$starttime = explode(":",$time);
		
		list($date,$time) = explode(' ',$startDate);
		$enddate = explode("-",$date);
		$endtime = explode(":",$time);
	
		$secondsDifference = mktime($endtime[0],$endtime[1],$endtime[2],
		$enddate[1],$enddate[2],$enddate[0]) - mktime($starttime[0],
		$starttime[1],$starttime[2],$startdate[1],$startdate[2],$startdate[0]);
		switch($format){
			case 1:
				return floor($secondsDifference/60); // Difference in Minutes
			
			case 2:
				return floor($secondsDifference/60/60); // Difference in Hours    
			
			case 3:
				return floor($secondsDifference/60/60/24); // Difference in Days    
		
			case 4:
				return floor($secondsDifference/60/60/24/7); 	// Difference in Weeks    
			
			case 5:
				return floor($secondsDifference/60/60/24/7/4); // Difference in Months    
			
			default:
				return floor($secondsDifference/365/60/60/24); // Difference in Years    
		}                
	}

##########################################################<<<<<<<<<<<<<<<   VENDOR FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function getvendoramount($pd_id,$fld){
		global  $heart,$cfg;
		$sql_pd = "SELECT `".$fld."` FROM ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." WHERE `vendor_id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$pdPrice 	= stripslashes($row_pd[$fld]);
		return $pdPrice;
	} 
	
	function getVendorTableValue($colName, $vendId){
		global $cfg,$heart;$num;
		$sql="SELECT ".$colName." FROM ".$cfg['DB_VENDOR']." WHERE `id` = '".$vendId."' ";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		return $row[$colName];
	}
	
	function total($order_id, $vendor_id){
		global  $heart,$cfg;
		$sql_sum = "SELECT SUM(avail.price*order_item.od_qty) as summation
					  FROM ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail 
				INNER JOIN ".$cfg['DB_ORDER_ITEM']." order_item 
					    ON avail.product_id = order_item.pd_id
		             WHERE order_item.od_id = '".$order_id."'
		               AND avail.vendor_id = '".$vendor_id."'";
		$res_sum = $heart->sql_query($sql_sum);
		$row_sum =	$heart->sql_fetchrow($res_sum);
		return $row_sum['summation']; 
	}
	
	function vendor_total_paid($vendor_id){
		global  $heart,$cfg;
		$sql_od = "SELECT SUM(avail.price)
					 FROM ".$cfg['DB_ORDER_ITEM']." order_item 
			   INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail
					   ON avail.product_id = order_item.pd_id
					WHERE avail.vendor_id = '".$vendor_id."'";
		$res_od = $heart->sql_query($sql_od);
		$row_od =	$heart->sql_fetchrow($res_od);
		return $row_od['avail.price']; 
	}
	
	function total_a($order_id){
		global  $heart,$cfg;
		$sql_a = "SELECT SUM(price*od_qty) as summation FROM ".$cfg['DB_VENDOR_ORDER_PRODUCT']." WHERE `od_id` = '".$order_id."'";
		$res_a = $heart->sql_query($sql_a);
		$row_a = $heart->sql_fetchrow($res_a);
		return $row_a['summation']; 
	}
	
#####################################################<<<<<<<<<<<<<<<   PAGINATION FUNCTIONS    >>>>>>>>>>>>>>>>>>###############################################
	
	function get_pagination_variable($num_of_records, $requested_page_no, $display_num_rows){
		if($requested_page_no <= 0) $requested_page_no = 1;
		$start_from = ($requested_page_no - 1) * $display_num_rows;
		if($num_of_records % $display_num_rows == 0)  $no_of_pages = (int)(($num_of_records / $display_num_rows));
		else  $no_of_pages = (int)(ceil($num_of_records / $display_num_rows));
		$arr_pagination_variable = array('requested_page_no' => $requested_page_no, 'no_of_pages' => $no_of_pages, 'start_from' => $start_from, 'display_num_rows' => $display_num_rows);
		return $arr_pagination_variable;
	}
	
	function set_pagination_pagelist($requested_page_no, $no_of_pages, $pagination_class_on = 'pagination_on', $pagination_class_off = 'pagination_off'){
		if($requested_page_no - 1 > 0)	{	
			$pagination_ist = "<a class='".$pagination_class_on."' href='#' onClick='return pagination_submit(1);'>First</a>&nbsp;";
		}
		$pagination_code = "";	
		if($requested_page_no - 3 <= 0) $i = 1;
		else $i = $requested_page_no - 3;
		for($j = 1; $i <= $no_of_pages && $j <= 3; $i++, $j++){
			if($pagination_code!='') $pagination_code .= '|'; 
			if($i != $requested_page_no) $pagination_code .= "<a class='".$pagination_class_on."' href='#' onClick='return pagination_submit($i);'>$i</a>";
		    else $pagination_code .= "<span class='".$pagination_class_off."'><b>$i</b></span>";
		} 
		
		if($requested_page_no < $no_of_pages){
			$pagination_lst = "&nbsp;<a class='".$pagination_class_on."' href='#' onClick='return pagination_submit($no_of_pages);'>Last</a>";
		}
		return $pagination_ist.$pagination_code.$pagination_lst;
	}
	
	function set_pagination_prevNext($requested_page_no, $no_of_pages, $pagination_class_on = 'pagination_on', $pagination_class_off = 'pagination_off'){
		if($requested_page_no - 1 > 0)	{	
			$previous = ($requested_page_no - 1);		
			$pagination_code_prev = "<a class='".$pagination_class_on."' href='#' onClick='return pagination_submit($requested_page_no-1);'>Previous</a>";
		}
		if($requested_page_no < $no_of_pages){
			$pagination_code_nxt = "<a class='".$pagination_class_on."' href='#' onClick='return pagination_submit($requested_page_no+1);'>Next</a>";
		}
		if($pagination_code_prev!=''&&$pagination_code_nxt!='') $separator = '|';
		return $pagination_code_prev.$separator.$pagination_code_nxt;
	}
	
############################################<<<<<<<<<<<<<<<   RANDOM NUMBER GENERATION FUNCTIONS    >>>>>>>>>>>>>>>>>>###############################################
		
	function str_rand($length = 4, $seeds = 'alphanum'){
		// Possible seeds
		$seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
		$seedings['numeric'] = '0123456789';
		$seedings['alphanum'] = 'abcdefghijkl0123456789mnopqrstuvwxyz';
		$seedings['hexidec'] = '0123456789abcdef';
		// Choose seed
		if (isset($seedings[$seeds])){
			$seeds = $seedings[$seeds];
		}
		// Seed generator
		list($usec, $sec) = explode(' ', microtime());
		$seed = (float) $sec + ((float) $usec * 100000);
		mt_srand($seed);
	
		// Generate
		$str = '';
		$seeds_count = strlen($seeds);
		
		for ($i = 0; $length > $i; $i++){
			$str .= $seeds{mt_rand(0, $seeds_count - 1)};
		}
		return $str;
	}
	
	function Random_Number($dbname,$dbfield,$pre,$count){
		global  $heart,$cfg;
		$random_number = "";
		for($i=0;$i<=$count;$i++){
			srand ((double) microtime( )*1000000);
			$random_number.= rand(0,9);
		}
		$sql_ran = "SELECT * FROM ".$dbname." WHERE $dbfield='$pre".$random_number."'";
		$res_ran = $heart->sql_query($sql_ran);
		if($heart->sql_numrows($res_ran)==0) return "$pre".$random_number;
		else{
			$random_number = "";
			Random_Number($dbname,$dbfield,$pre,$count);
		}
	}
	
##########################################################<<<<<<<<<<<<<<<   OTHERS FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################
	
	function zone_name($zone_id){
	global  $heart,$cfg;
	$sql_zone = "SELECT * FROM ".$cfg['DB_ZONE']."  WHERE zone_id = '".$zone_id."'";
	$res_zone = $heart->sql_query($sql_zone);
	$row_zone =	$heart->sql_fetchrow($res_zone);
	$zone_name 	= 	$row_zone['zone_name'];
	return $zone_name;
	}

	function getSiteName($id){
		global  $heart,$cfg;
		$sql_pd = "SELECT `s_name` FROM ".$cfg['DB_SITE']." WHERE `s_id` = '".$id."' AND `status`= 'A'";
		$res_pd = $heart->sql_query($sql_pd);	
		$row_pd = $heart->sql_fetchrow($res_pd);
		return $row_pd['s_name'];
	}
	function getCurrentPageName($split=1)
	{
		$currentFile = $_SERVER["PHP_SELF"];
	    $parts = explode('/', $currentFile);
	    return $parts[count($parts) - $split];
	}
	
	function searchKeyInsert($keyword,$catId,$session_id){
		global  $heart,$cfg;
		$yesterday=date('Y-m-d', mktime(0, 0, 0,date('m'),date('d')-1,date('y')));
		$sql="SELECT * FROM ".$cfg['DB_SEARCH']."WHERE `session_id`='".$session_id."'";
		$res=$heart->sql_query($sql);
		$maxrow=$heart->sql_numrows($res);
		$row=$heart->sql_fetchrow($res);
		if($maxrow==0){
		$sql_src="INSERT INTO ".$cfg['DB_SEARCH']." (`session_id`,`search_key`,`cat_id`,`date`)
					   VALUES ('".$session_id."','".$keyword."','".$catId."',NOW())";
		$heart->sql_query($sql_src);
		}else{
			$sql_srcup="UPDATE ".$cfg['DB_SEARCH']." 
			               SET  `search_key` = '".$keyword."',
								`cat_id` = '".$catId."',
								`date` = NOW()			
						 WHERE 	`session_id` = '".$session_id."' ";
			$heart->sql_query($sql_srcup);
		}
		$sql="DELETE FROM " .$cfg['DB_SEARCH']."WHERE `date`= '".$yesterday."'";
		$heart->sql_query($sql);
	}
	
	function getTopSeller(){
		global  $heart,$cfg;
		$topSellProduct = array();
		$sqlTopSell = "SELECT od.pd_id, pd.pd_id, pd_name, pd_price, pd_abs, pd_image
						FROM ".$cfg['DB_ORDER_ITEM']." as od, ".$cfg['DB_PRODUCT']." as pd 
						WHERE od.pd_id = pd.pd_id
						GROUP BY od.pd_id 
						ORDER BY sum( od.od_qty ) DESC 
						LIMIT 0 , 10";//Set limit of showing top seller product
		$resultTopSell = $heart->sql_query($sqlTopSell);
		while ($rowTopSell = $heart->sql_fetchrow($resultTopSell)) {
			$rowTopSell['pd_image'] = 'includes/thumbnail.php?path=../productImage/' . $rowTopSell['pd_image'] . '&width=165&height=73';
			$topSellProduct[] = $rowTopSell;
		}
		return $topSellProduct;
	}
	
	function siteConf($pageid){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_CONFIGURE']." WHERE `id` = '".$pageid."'";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		return $row['value'];
	}
	
	function getoccasionname($pd_id){
		global  $heart,$cfg;
		$sql_pd = "SELECT `name` FROM ".$cfg['DB_OCCATIONS']." WHERE `id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$pdPrice 	= stripslashes($row_pd['name']);
		return $pdPrice;
	} 
	
##########################################################<<<<<<<<<<<<<<<   REUSABLE FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################

	function previousPage(){
		global  $heart,$cfg;
		$page_name=array();
		$pre_url=$_SERVER['HTTP_REFERER'];
		$page_name=explode('/',$pre_url);
		$count=count($page_name);
		foreach($page_name as $key => $var){
			if($key==$count-1){
				$final_url=$var;
			}
		}
		return $final_url;
	}
	
	function myarray($arr,$order=''){
		$value = "";
		if($order=="ASC"){
			for($i=0;$i<count($arr);$i++){
				$value .= ($i==0)?$arr[$i]:"&nbsp;&raquo;&nbsp;".$arr[$i];
			}
		}else{
			for($i=(count($arr)-1);$i>=0;$i--){
				$value .= ($i==(count($arr)-1))?$arr[$i]:"&nbsp;&raquo;&nbsp;".$arr[$i];
			}
		}
		return $value;
	}
	
	function getFieldsFromTable($id,$tb,$tname,$fid){
		$sql="SELECT `".$tb."` FROM ".$tname." where `".$fid."`='".$id."'";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		if($row[$tb]) return $row[$tb];
		else return 0;
	}
	
	function send_mail($to_name, $to_email, $form_name, $form_email, $subject, $message, $bcc='') {
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: ". $form_name ."<".$form_email."> \r\n";
		if ($bcc != "")
		$headers .= "Bcc: ".$bcc."\n";
		$output = $message; $output = wordwrap($output, 72);
		return(mail($to_email, $subject, $output, $headers));
	}
	
	function Reporting() {
		global $cfg, $ERR, $MSG;
		$C="alt1";
		if( is_array($ERR) OR is_array($MSG)) {
			$value = isset($ERR)?"Error":"Msg";
			$rep = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"100%\">";
			$rep .= "<tr class=\"re_head\">";
			$rep .= "</tr>";
			if($value == "Error"){
				$rep .= "<tr class=\"alt1\">";
				$rep .= "<td colspan=\"2\" align=\"left\" class=\"msg\">Please check the following and try again:</td>";
				$rep .= "</tr>";
				foreach ($ERR as $key => $value) {
					$C = ($C=="alt1")?"alt1":"alt1";
					$rep .= "<tr class='".$C."'>\n";
					$rep .= "<td width=\"4%\" align=\"center\" valign=\"middle\"><img src='".$cfg['IMAGES']."s_warn.gif' width=\"16\" height=\"16\" border=\"0\"></td>";
					$rep .= "<td align=\"left\" class=\"msg\">".$value."</td></tr>\n";
				}
			}
			if($value == "Msg") {
				foreach ($MSG as $key => $value) {
					$rep .= "<tr class='".$C."'>\n";
					$rep .= "<td width=\"4%\" align=\"center\" valign=\"middle\"><img src='".$cfg['IMAGES']."s_msg.gif' width=\"16\" height=\"16\" border=\"0\"></td>";
					$rep .= "<td align=\"left\" class=\"msg\">".$value."</td></tr>\n";
				}
			}
			$rep .="</table>";
			return $rep;
		}
	}
	
##########################################################<<<<<<<<<<<<<<<   DEPRICATED FUNCTIONS    >>>>>>>>>>>>>>>>>>#################################################

/*	
	function getCatName($pd_id){
		global  $heart,$cfg;
		$sql_pd = "SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` = '".$pd_id."'";
		$res_pd = $heart->sql_query($sql_pd);
		$row_pd	=	$heart->sql_fetchrow($res_pd);
		$cat_id = $row_pd['cat_id'];
		$cat_name = catname($cat_id);
		return $cat_id;
	}
	
	function pkgName($pkgId){
		global  $heart,$cfg;
		$sql_pkg = "SELECT * FROM ".$cfg['DB_PACKAGES']." WHERE `pkgId` = '".$pkgId."'";
		$res_pkg = $heart->sql_query($sql_pkg);
		$row_pkg	=	$heart->sql_fetchrow($res_pkg);
		$pkgName 	= 	$row_pkg['planName'];
		return $pkgName;
	}
	
	function fareaName($fareaId){
		global  $heart,$cfg;
		$sql_farea = "SELECT * FROM ".$cfg['DB_FUNCTIONALAREA']." WHERE `fareaId` = '".$fareaId."'";
		$res_farea = $heart->sql_query($sql_farea);
		$row_farea	=	$heart->sql_fetchrow($res_farea);
		$farea_name 	= 	$row_farea['fareaName'];
		return $farea_name;
	}
	
	function industryName($industryId){
		global  $heart,$cfg;
		$sql_ind = "SELECT * FROM ".$cfg['DB_INDUSTRY']." WHERE `industryId` = '".$industryId."'";
		$res_ind = $heart->sql_query($sql_ind);
		$row_ind	=	$heart->sql_fetchrow($res_ind);
		$industry_name 	= 	$row_ind['industryName'];
		return $industry_name;
	}
	
	function basicQual($bqualId ){
		global  $heart,$cfg;
		$sql_bqual = "SELECT * FROM ".$cfg['DB_BASICQUALIFICATION']." WHERE `bqualId` = '".$bqualId."'";
		$res_bqual = $heart->sql_query($sql_bqual);
		$row_bqual	=	$heart->sql_fetchrow($res_bqual);
		$basic_qual 	= 	$row_bqual['bqualName'];
		return $basic_qual;
	}
	
	function postGrad($pgId){
		global  $heart,$cfg;
		$sql_pg = "SELECT * FROM ".$cfg['DB_POSTGRADUATION']." WHERE `pgId` = '".$pgId."'";
		$res_pg = $heart->sql_query($sql_pg);
		$row_pg	=	$heart->sql_fetchrow($res_pg);
		$post_grad 	= 	$row_pg['pgName'];
		return $post_grad;
	}
	
	function doctorate($doctId){
		global  $heart,$cfg;
		$sql_ppg = "SELECT * FROM ".$cfg['DB_DOCTORATE']." WHERE `doctId` = '".$doctId."'";
		$res_ppg = $heart->sql_query($sql_ppg);
		$row_ppg	=	$heart->sql_fetchrow($res_ppg);
		$doc_ppg 	= 	$row_ppg['doctName'];
		return $doc_ppg;
	}
	
	function show_product_type($id){
		global  $heart,$cfg;
		$sql = "SELECT *  FROM `rn_propertytype` WHERE propertytypeId='".$id."' ";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		return $row['typeName'];
	}
	
	function property_type($id){
		global  $heart,$cfg;
		$sql="SELECT * FROM ".$cfg['DB_PROPERTYTYPE']." WHERE `propertytypeId` = '$id'";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		return $row['typeName'];
	}
	
	function max_package_rate(){
		global  $heart,$cfg;
		$sql="SELECT * FROM ".$cfg['DB_RENTAL_ADPACKAGE']." WHERE `ad_packageStatus` <> 'D' ORDER BY `rate`  DESC";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		return $row['rentaladpackageId'];
	}
	
	function show_rental_address( $id,$format=false){
		global  $heart,$cfg;
		$sql="SELECT * FROM ".$cfg['DB_RENTAL_ADDRESS']." WHERE rentalId= '".$id."' ";
		$res=$heart->sql_query($sql);
		$row_query=$heart->sql_fetchrow($res);
		$theAddress = $row_query['address1'].', ';
		if($format) $theAddress .= '<br>';
		$theAddress .= ($row_query['cityId']>0)?city_name($row_query['cityId']).', ':$row_query['cityName'].', ';
		if($format) $theAddress .= '<br>';
		$theAddress .= ($row_query['stateId']>0)?show_state($row_query['stateId']).' ':$row_query['stateName'].' ';
		$theAddress .= $row_query['zip'];
		return $theAddress;
	}
	
	function show_user_type_name($user_type_id ){
		global  $heart,$cfg;
		$sql="SELECT * FROM ".$cfg['DB_USERTYPE']." WHERE `user_type_id` = ".$user_type_id."";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		return $row;
	}
	
	function getSitecatmap($siteid,$url) {
		global $cfg,$heart,$map;
		$sql="SELECT * FROM ".$cfg['DB_SITEMAP']." WHERE   siteMapId ='".$siteid."'";
		$res=$heart->sql_query($sql);
		if($heart->sql_numrows($res)>0){  	
			$row=$heart->sql_fetchrow($res);
			$map[] = "<a href='".$url."?show=view&id=".$siteid."' class='tableHeader1'>".$row['siteMapheading']."</a>";
			getSitecatmap($row['pid'],$url);		
		}else{
			$map[] = "<a href='".$url."' class='tableHeader1'>Site Map Root Node</a>";
		}
		return $map;
	}
	
	function areaName($areaid){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_AREA']." WHERE `areaId` = '".$areaid."'";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		if($row['areaStatus']=='A')  return $row['areaName'];
		else return ''; 
	}
	
	function langName($langid){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_LANGUAGE']." WHERE `langId` = '".$langid."'";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		if($row['langStatus']=='A')  return $row['language'];
		else return ''; 
	}
	
	function nationName($nationid){
		global  $heart,$cfg;
		$sql = "SELECT * FROM ".$cfg['DB_NATIONALITY']." WHERE `nationId` = '".$nationid."'";
		$res = $heart->sql_query($sql);
		$row = $heart->sql_fetchrow($res);
		if($row['nationStatus']=='A') return $row['nationality'];
		else return ''; 
	}	

*/
/*********************************************souvik category key page function needed*********************************************/

function getChildkeyCategories($id,$recursive = true){
		global  $heart,$cfg;
		$i=0;
		$categories = array();
		$sql = "SELECT * FROM ".$cfg['DB_KEYWORD_CATEGORY']."WHERE `cat_parent_id` = ".$id."  AND `status`!='D'";
		$result = $heart->sql_query($sql);
		while ($row = $heart->sql_fetchrow($result)){
			$categories[$i] = $row['id'];
			$i++;
		}
		$n  = count($categories);
		return $categories;
	}
	

/****************************************souvik category key page function ended*************************************************/
/****************************************souvik function for find category from key*************************************************/
function getcatgory_from_key($str){
	global $heart,$cfg;
	$sql="SELECT DISTINCT categoryid FROM ".$cfg['DB_KEYWORD_CATEGORY_MAP']."WHERE keywordid IN('".$str."') ";
	$result = $heart->sql_query($sql);
		while ($row = $heart->sql_fetchrow($result)){
			$categories[$i] = $row['categoryid'];
			$i++;
		}
		$n  = count($categories);
		return $categories;		
}
/****************************************souvik  function for find category from key ended*************************************************/

function findType($id)
  {
     global  $heart,$cfg;
    $sql="SELECT `shipping_type` FROM".$cfg['DB_ORDER_ITEM']." where `od_id`='".$id."'";
    $res = $heart->sql_query($sql);
    while ($row = $heart->sql_fetchrow($res))
    {
    	$type = $row['shipping_type'];
    }

    return $type;
  }

  function findTime($id)
  {
     global  $heart,$cfg;
    $sql="SELECT `delivery_time` FROM".$cfg['DB_ORDER_ITEM']." where `od_id`='".$id."'";
    $res = $heart->sql_query($sql);
    while ($row = $heart->sql_fetchrow($res))
    {
    	$time = $row['delivery_time'];
    }

    return $time;
  }
?>