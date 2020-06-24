<?php 
// Connect with the database 
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); 
 
// Display error if failed to connect 
if ($db->connect_errno) { 
    printf("Connect failed: %s\n", $db->connect_error); 
    exit(); 
} 

// CREATE TABLE `payments` (
//  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
//  `item_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
//  `txn_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
//  `payment_gross` float(10,2) NOT NULL,
//  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
//  `payment_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
//  PRIMARY KEY (`payment_id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



// CREATE TABLE `products` (
//  `id` int(11) NOT NULL AUTO_INCREMENT,
//  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
//  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
//  `price` float(10,2) NOT NULL,
//  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive',
//  PRIMARY KEY (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;