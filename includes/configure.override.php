<?php
//Uploads Folder
$cfg['SERVICES']								=	'uploads/services/';
$cfg['HOMESLIDER']								=	'uploads/homeSlider/';
$cfg['GALLERY']									=	'uploads/gallery/';
$cfg['RESUME']									=	'uploads/resume/';
$cfg['CONTENT_BANNER']							=	'uploads/contentPageBanner/';

// Databse table name
	// ARCHITECTURE RELATED TABLES

// Databse table name
$TABLE_PREFIX					    		          = 'conf_';
$cfg['DB.CONF.USER']			    		          = "`".$TABLE_PREFIX."user`";
$cfg['DB.USER.CERTIFICATE.MAP']		    	          = "`".$TABLE_PREFIX."user_certificate_mapping`";
$cfg['DB.CONF.SECTION']			    		          = "`".$TABLE_PREFIX."webpagesection`";
$cfg['DB.CONF.MODULE']			    		          = "`".$TABLE_PREFIX."webpagemodule`";
$cfg['DB.CONF.PAGE']			    		          = "`".$TABLE_PREFIX."webpage`";
$cfg['DB.CONF.PAGE_ACCESS']		    		          = "`".$TABLE_PREFIX."webpageaccess`";
$cfg['DB.CONF.ROLE']			    		          = "`".$TABLE_PREFIX."webmasterrole`";
$cfg['DB.CONF.ROLEDETAILS']		    		          = "`".$TABLE_PREFIX."webmasterroledetails`";
$cfg['DB.CONF.COMPANY']			    		          = "`".$TABLE_PREFIX."company`";
$cfg['DB.CONF.DOMAIN']			    		          = "`".$TABLE_PREFIX."webdomain`";
$cfg['DB.CONF.PAGE_ACCESS_CNTRL_MSTR']		          = "`".$TABLE_PREFIX."pagecontrolmaster`";
$cfg['DB.CONF.PAGE_ACCESS_CNTRL']			          = "`".$TABLE_PREFIX."pagecontrol`";
$cfg['DB.CONF.EMAIL.TEMPLATE']			              = "`".$TABLE_PREFIX."email_template`";
$cfg['DB.CONF.NEWSLETTER.TEMPLATE']			          = "`".$TABLE_PREFIX."newsletter_template`";
$cfg['DB.CONF.COUPON.TEMPLATE']			          	  = "`".$TABLE_PREFIX."coupon_template`";
$cfg['DB_LOGIN_DETAILS']					          = "`_login_records_`";

$cfg['TABLE_PREFIX']				= 'gleam_';
$cfg['DB_WEBMASTER']				= "`".$cfg['TABLE_PREFIX']."webmaster`";
$cfg['DB_PAGECONTENT']				= "`".$cfg['TABLE_PREFIX']."cms`";
$cfg['DB_NEWS']						= "`".$cfg['TABLE_PREFIX']."news`";
$cfg['DB_CONTACT_US']				= "`".$cfg['TABLE_PREFIX']."contact_us`";
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
$cfg['DB_FOOTER_NAV']				= "`".$cfg['TABLE_PREFIX']."footer_nav`";
$cfg['DB_COUNTRY_MASTER']			= "`".$cfg['TABLE_PREFIX']."country_master`";
$cfg['DB_HOME_VIEWMORE']			= "`".$cfg['TABLE_PREFIX']."home_viewmore`";
$cfg['DB_TESTIMONIAL']	    		= "`".$cfg['TABLE_PREFIX']."testimonial`";
$cfg['DB_USER']						= "`".$cfg['TABLE_PREFIX']."user`";
$cfg['DB_CART']						= "`".$cfg['TABLE_PREFIX']."cart`";
$cfg['DB_DUMMY_CART']				= "`".$cfg['TABLE_PREFIX']."dummy_cart`";
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
$cfg['DB_NEWSLETTER_EMAIL'] 		= "`".$cfg['TABLE_PREFIX']."newsletter_email`";
$cfg['DB_NEWSMAIL']         		= "`".$cfg['TABLE_PREFIX']."newsmail`";
$cfg['DB_ORDER']					= "`".$cfg['TABLE_PREFIX']."order`";
$cfg['DB_TEMP_ORDER']				= "`".$cfg['TABLE_PREFIX']."temp_order`";
$cfg['DB_ORDER_ITEM']				= "`".$cfg['TABLE_PREFIX']."order_item`";
$cfg['DB_BANNER']					= "`".$cfg['TABLE_PREFIX']."banner`";
$cfg['DB_KEYWORD']					= "`".$cfg['TABLE_PREFIX']."keyword`";
$cfg['DB_KEYWORD_CATEGORY'] 		= "`".$cfg['TABLE_PREFIX']."category_key`";
$cfg['DB_KEYWORD_CATEGORY_MAP']		= "`".$cfg['TABLE_PREFIX']."category_key_map`";
$cfg['DB_PAYMENT_REQUEST']			= "`".$cfg['TABLE_PREFIX']."payment_request_table`";
$cfg['DB_PAYMENT_RESPONSE'] 		= "`".$cfg['TABLE_PREFIX']."payment_response`";
$cfg['DB_SPECIAL_MESSAGE']			= "`".$cfg['TABLE_PREFIX']."special_message`";
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
$cfg['DB_FAQ']						= "`".$cfg['TABLE_PREFIX']."faq`";

//Tanushree 2.07.16
$cfg['DB_RECENTLY_VIEWED_DETAILS']		= "`".$cfg['TABLE_PREFIX']."recently_viewed_details`";
$cfg['DB_CUSTOMER_QUERY_LISTS']			= "`".$cfg['TABLE_PREFIX']."customer_query_lists`";
//Anindya 02.01.2012
$cfg['DB_CITY']							= "`".$cfg['TABLE_PREFIX']."city`";
//Anindya 01.02.12
$cfg['DB_SITE']							= "`".$cfg['TABLE_PREFIX']."site`";

$cfg['DB_VENDOR']						= "`".$cfg['TABLE_PREFIX']."vendor`";
$cfg['DB_VENDOR_PRODUCT_AVAIL']			= "`".$cfg['TABLE_PREFIX']."vendor_product_avail`";
$cfg['DB_ASSIGN_VENDORS']				= "`".$cfg['TABLE_PREFIX']."assign_vendors`";
$cfg['DB_LOGIN_RECORDS']				= "`".$cfg['TABLE_PREFIX']."login_records`";
$cfg['DB_VENDOR_ORDER']					= "`".$cfg['TABLE_PREFIX']."vendor_order`";
$cfg['DB_VENDOR_ORDER_PRODUCT']			= "`".$cfg['TABLE_PREFIX']."vendor_order_product`";
$cfg['DB_ALBUM']						= "`".$cfg['TABLE_PREFIX']."album`";
$cfg['DB_GALLERY']						= "`".$cfg['TABLE_PREFIX']."gallery`";
$cfg['DB_SHIPPING_TYPE']				= "`".$cfg['TABLE_PREFIX']."shipping_type`";
$cfg['DB_BLOCK_TIME']					= "`".$cfg['TABLE_PREFIX']."block_ordertime`";
$cfg['DB_COMPUTER_TRAIN']				= "`".$cfg['TABLE_PREFIX']."computer_training`";
$cfg['DB_SHOP_CONTENT']				    = "`".$cfg['TABLE_PREFIX']."shop_content`";
$cfg['DB_ONLINESTORE_BANNER']			= "`".$cfg['TABLE_PREFIX']."onlinestore_banner`";
$cfg['DB_USERS']						= "`".$cfg['TABLE_PREFIX']."users`";
$cfg['DB_USER_LOGIN']					= "`".$cfg['TABLE_PREFIX']."user_login`";
$cfg['DB_SHIPPING_ADDRESS']				= "`".$cfg['TABLE_PREFIX']."shipping_address`";
$cfg['DB_EMAIL_SIGNATURE']			    = "`".$cfg['TABLE_PREFIX']."email_signature`";
$cfg['DB_PAYMENT_EMAIL_HISTORY']		= "`".$cfg['TABLE_PREFIX']."payment_email_history`";

$cfg['SESSION_SITE']=2;



?>