<?php
error_reporting(1);
@ini_set('display_errors', '1');
@ini_set('session.name', 'sid');

/* 
  
cache clearance code  
*/

header("Cache-Control: no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
/**
*	Define the webserver and path parameters
*	DIR_FS_* = Filesystem directories (local/physical)
*	DIR_WS_* = Webserver directories (virtual/URL)
*/
$cfg=array();
// eg, http://localhost - should not be empty for productive servers
//die($_SERVER['HTTP_HOST']);
$cfg['H_MENU']='';
$cfg['base_url']            = "http://localhost/gleamsys/";
$cfg['base_url_v']         	= "http://localhost/gleamsys/";
$cfg['HTTP_SERVER']			= 'http://'.$_SERVER['HTTP_HOST'].'/';
$cfg['DIR_WS']				= '/var/www/html/';
$cfg['ADMIN_EMAIL']			= 'ranjit@rainbowfloristworld.com';
$cfg['ADMIN_ORDER_EMAIL']	= 'orders@rainbowfloristworld.com';


$cfg['TITLE1']			= ':: Welcome to Rainbow Florist ';

$cfg['ADMIN_TITLE']		= 'gleamsys Admin Panel';
$cfg['ADMIN_NAME']		= 'gleamsys Admin';

$cfg['STUFF_NAME']		= 'Rainbow Florist';
$cfg['ORDERS_NAME']		= 'Rainbow Florist Order Details';
$cfg['ORDERS_CONF']		= 'Rainbow Florist Order Confirmation';

// eg, https://localhost - should not be empty for productive servers
$cfg['HTTPS_SERVER']		= "https://".$_SERVER['HTTP_HOST']."/";
$cfg['ENABLE_SSL']			= FALSE; // secure webserver for checkout procedure?

$cfg['HTTP_COOKIE_DOMAIN']	= 'localhost';
$cfg['HTTPS_COOKIE_DOMAIN'] = '';
$cfg['HTTP_COOKIE_PATH']	= $cfg['DIR_WS'].'tmp/';
$cfg['HTTPS_COOKIE_PATH']	= '';

$cfg['DIR_WS_INCLUDES']		= $cfg['DIR_WS'].'includes/';
$cfg['DIR_WS_CLASSES']		= $cfg['HTTP_SERVER'].'lib/';

// Client side path
$cfg['IMAGES']				= 'images/';
$cfg['IMAGES_FRANT']		= 'images/';
$cfg['DIR_WS_JSCRIPT']		= 'scripts/';
$cfg['PRODUCT_IMAGES']		= 'image_bank/product_image/';
$cfg['GALLERY_IMAGES']		= 'image_bank/gallery_image/';
$cfg['DIR_IMAGE']				= 'image_bank/watermark/';
$cfg['DIR_LOGO']				= 'image_bank/logo/';
$cfg['BANNER_IMAGES']	  = 'image_bank/banner_image/';

// $cfg['DB_SERVER']			= '192.168.10.94';
// $cfg['DB_SERVER_USERNAME']	= 'root'; // Database user name
// $cfg['DB_SERVER_PASSWORD']	= 'root'; // Database password
// $cfg['DB_DATABASE']			= 'gleamsys17122019'; // Database Name*/

$cfg['DB_SERVER']			= 'localhost';
$cfg['DB_SERVER_USERNAME']	= 'root'; // Database user name
$cfg['DB_SERVER_PASSWORD']	= 'password'; // Database password
$cfg['DB_DATABASE']			= 'gleamsys'; // Database Name*/

$cfg['DB_TYPE']		        = 'mysql'; // Dabase type MYSQL or ORACLE
$cfg['USE_PCONNECT']		= FALSE;
// CC Avenue Information 
$cfg['CCAVENUE_URL']			= "https://www.ccavenue.com/shopzone/cc_details.jsp";
$cfg['CCAVENUE_MERCHANT_ID']	= "M_rainbow_11527";
$cfg['CCAVENUE_WORKING_KEY']	= "5uplu01w43mqo5hg4v";

// EBS Information 
$cfg['EBS_URL']		= "https://secure.ebs.in/pg/ma/sale/pay";
$cfg['EBS_MERCHANT_ID']= "12698";
$cfg['EBS_WORKING_KEY']= "2db3e5ea360964955688e88b6b3ecb48";
$cfg['EBS_PAYMENT_MODE']= "LIVE";

// Databse table name
$cfg['TABLE_PREFIX']				= 'gleam_';

$cfg['DB_WEBMASTER']				= "`".$cfg['TABLE_PREFIX']."webmaster`";
$cfg['DB_PAGECONTENT']				= "`".$cfg['TABLE_PREFIX']."cms`";
$cfg['DB_NEWS']						= "`".$cfg['TABLE_PREFIX']."news`";
$cfg['DB_CONTACT_US']				= "`".$cfg['TABLE_PREFIX']."contact_us`";
$cfg['DB_HOME_VIEWMORE']			= "`".$cfg['TABLE_PREFIX']."home_viewmore`";
$cfg['DB_EARLIEST_DELIVERYBY']		= "`".$cfg['TABLE_PREFIX']."earliest_deliveryby`";
$cfg['DB_PINCODES']		    		= "`".$cfg['TABLE_PREFIX']."pincodes`";
$cfg['DB_PRODUCT_SIZE']				= "`".$cfg['TABLE_PREFIX']."product_size`";
$cfg['DB_PRODUCT_REVIEWS']			= "`".$cfg['TABLE_PREFIX']."product_reviews`";
$cfg['DB_PRODUCT_WISHLIST']			= "`".$cfg['TABLE_PREFIX']."wishlist`";
$cfg['DB_PRODUCT_REFUND']			= "`".$cfg['TABLE_PREFIX']."refund`";
$cfg['DB_PRODUCT_ABOUTUS']			= "`".$cfg['TABLE_PREFIX']."aboutus`";
$cfg['DB_PRODUCT_ABOUTUSICON']		= "`".$cfg['TABLE_PREFIX']."aboutusicon`";
$cfg['DB_PRIVACY']					= "`".$cfg['TABLE_PREFIX']."privacy`";
$cfg['DB_TERMS']					= "`".$cfg['TABLE_PREFIX']."terms`";
$cfg['DB_CONTACT_LIST']				= "`".$cfg['TABLE_PREFIX']."contact_list`";
$cfg['DB_COUNTRY_MASTER']			= "`".$cfg['TABLE_PREFIX']."country_master`";
$cfg['DB_USER']						= "`".$cfg['TABLE_PREFIX']."user`";
$cfg['DB_CART']						= "`".$cfg['TABLE_PREFIX']."cart`";
$cfg['DB_CATEGORY']					= "`".$cfg['TABLE_PREFIX']."category`";
$cfg['DB_CURRENCY']					= "`".$cfg['TABLE_PREFIX']."currency`";
$cfg['DB_CURRENCY_SETTING']			= "`".$cfg['TABLE_PREFIX']."currency_setting`";
$cfg['DB_ORDER']					= "`".$cfg['TABLE_PREFIX']."order`";
$cfg['DB_ORDER_ITEM']				= "`".$cfg['TABLE_PREFIX']."order_item`";
$cfg['DB_PRODUCT']					= "`".$cfg['TABLE_PREFIX']."product`";
$cfg['DB_ADDON']					= "`".$cfg['TABLE_PREFIX']."addon`";
$cfg['DB_PRODUCT_CAT']				= "`".$cfg['TABLE_PREFIX']."product_cat`";
$cfg['DB_OCCATIONS']				= "`".$cfg['TABLE_PREFIX']."occasions`";
$cfg['DB_SHOP_CONFIG']				= "`".$cfg['TABLE_PREFIX']."shop_config`";
$cfg['DB_SEARCH']					= "`".$cfg['TABLE_PREFIX']."search`";
$cfg['DB_PROMO']					= "`".$cfg['TABLE_PREFIX']."promo`";
$cfg['DB_LOCATION']					= "`".$cfg['TABLE_PREFIX']."location`";
$cfg['DB_COLOR']					= "`".$cfg['TABLE_PREFIX']."color`";
$cfg['DB_CONTACT']					= "`".$cfg['TABLE_PREFIX']."contact`";
$cfg['DB_PRICERANGE']				= "`".$cfg['TABLE_PREFIX']."price_range`";
$cfg['DB_REVIEW']					= "`".$cfg['TABLE_PREFIX']."review`";
$cfg['DB_DISCLAIMER']				= "`".$cfg['TABLE_PREFIX']."disclaimer`";
$cfg['DB_DUMMY_CART']				= "`".$cfg['TABLE_PREFIX']."dummy_cart`";
$cfg['DB_NOTES']					= "`".$cfg['TABLE_PREFIX']."notes`";
$cfg['DB_WATERMARK'] 				= "`".$cfg['TABLE_PREFIX']."watermark`";
$cfg['DB_LOGO'] 					= "`".$cfg['TABLE_PREFIX']."logo`";
$cfg['DB_CUSTOMER']					= "`".$cfg['TABLE_PREFIX']."customer`";
$cfg['DB_CUSTOMER_DETAILS']			= "`".$cfg['TABLE_PREFIX']."customer_details`";
$cfg['DB_COUNTRY_MASTER']			= "`".$cfg['TABLE_PREFIX']."country_master`";
$cfg['DB_STATE']					= "`".$cfg['TABLE_PREFIX']."state`";
$cfg['DB_CITIES']					= "`".$cfg['TABLE_PREFIX']."cities`";
$cfg['DB_CARD']						= "`".$cfg['TABLE_PREFIX']."card`";
$cfg['DB_CARD_DETAILS']				= "`".$cfg['TABLE_PREFIX']."card_details`";
$cfg['DB_CARD_CONFIGURE']  			= "`".$cfg['TABLE_PREFIX']."card_configure`";
$cfg['DB_NEWSLETTER_EMAIL']         = "`".$cfg['TABLE_PREFIX']."newsletter_email`";
$cfg['DB_NEWSMAIL']                	= "`".$cfg['TABLE_PREFIX']."newsmail`";
$cfg['DB_ORDER']					= "`".$cfg['TABLE_PREFIX']."order`";
$cfg['DB_TEMP_ORDER']				= "`".$cfg['TABLE_PREFIX']."temp_order`";
$cfg['DB_ORDER_ITEM']				= "`".$cfg['TABLE_PREFIX']."order_item`";
$cfg['DB_BANNER']					= "`".$cfg['TABLE_PREFIX']."banner`";
$cfg['DB_KEYWORD']					= "`".$cfg['TABLE_PREFIX']."keyword`";
$cfg['DB_KEYWORD_CATEGORY'] 		= "`".$cfg['TABLE_PREFIX']."category_key`";
$cfg['DB_KEYWORD_CATEGORY_MAP'] 	= "`".$cfg['TABLE_PREFIX']."category_key_map`";
$cfg['DB_PAYMENT_REQUEST']			= "`".$cfg['TABLE_PREFIX']."payment_request_table`";
$cfg['DB_PAYMENT_RESPONSE'] 		= "`".$cfg['TABLE_PREFIX']."payment_response`";
$cfg['DB_SPECIAL_MESSAGE']			= "`".$cfg['TABLE_PREFIX']."special_message`";
			//Tanushree 2.07.16
$cfg['DB_RECENTLY_VIEWED_DETAILS']	= "`".$cfg['TABLE_PREFIX']."recently_viewed_details`";
$cfg['DB_CUSTOMER_QUERY_LISTS']		= "`".$cfg['TABLE_PREFIX']."customer_query_lists`";
				//Anindya 02.01.2012
$cfg['DB_CITY']						= "`".$cfg['TABLE_PREFIX']."city`";
//Anindya 01.02.12
$cfg['DB_SITE']						= "`".$cfg['TABLE_PREFIX']."site`";
$cfg['DB_VENDOR']					= "`".$cfg['TABLE_PREFIX']."vendor`";
$cfg['DB_VENDOR_PRODUCT_AVAIL']		= "`".$cfg['TABLE_PREFIX']."vendor_product_avail`";
$cfg['DB_ASSIGN_VENDORS']			= "`".$cfg['TABLE_PREFIX']."assign_vendors`";
$cfg['DB_LOGIN_RECORDS']			= "`".$cfg['TABLE_PREFIX']."login_records`";
$cfg['DB_VENDOR_ORDER']				= "`".$cfg['TABLE_PREFIX']."vendor_order`";
$cfg['DB_VENDOR_ORDER_PRODUCT']		= "`".$cfg['TABLE_PREFIX']."vendor_order_product`";
$cfg['DB_ALBUM']					= "`".$cfg['TABLE_PREFIX']."album`";
$cfg['DB_GALLERY']					= "`".$cfg['TABLE_PREFIX']."gallery`";
$cfg['DB_SHIPPING_TYPE']			= "`".$cfg['TABLE_PREFIX']."shipping_type`";
$cfg['DB_BLOCK_TIME']				= "`".$cfg['TABLE_PREFIX']."block_ordertime`";
$cfg['DB_EMAIL_HISTORY']			= "`".$cfg['TABLE_PREFIX']."email_history`";
$cfg['DB_HOME_COUNTER']			    = "`".$cfg['TABLE_PREFIX']."home_counter`";
$cfg['DB_BRAND_LOGO']			    = "`".$cfg['TABLE_PREFIX']."brand_logo`";
$cfg['DB_TESTIMONIAL']			    = "`".$cfg['TABLE_PREFIX']."testimonial`";
$cfg['DB_HOME_BANNER']			    = "`".$cfg['TABLE_PREFIX']."home_banner`";
$cfg['DB_CLIENT_INFO']			    = "`".$cfg['TABLE_PREFIX']."client_info`";
$cfg['DB_CLIENT_BANNER']			= "`".$cfg['TABLE_PREFIX']."client_banner`";
$cfg['DB_PORTFOLIO_BANNER']			= "`".$cfg['TABLE_PREFIX']."portfolio_banner`";
$cfg['DB_PORTFOLIO_INFO']			= "`".$cfg['TABLE_PREFIX']."portfolio_info`";
$cfg['DB_SERVICE_BANNER']			= "`".$cfg['TABLE_PREFIX']."services_banner`";
$cfg['DB_SERVICE_INFO']				= "`".$cfg['TABLE_PREFIX']."services_info`";
$cfg['DB_COMPUTER_TRAIN']			= "`".$cfg['TABLE_PREFIX']."computer_training`";

$cfg['SESSION_SITE']=2;
?>