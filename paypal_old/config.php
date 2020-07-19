<?php 
/* 
 * PayPal and database configuration 
 */ 
  
// PayPal configuration 
define('PAYPAL_ID', 'sb-8vqor1649489@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', 'http://localhost/practice/paypal/success.php'); 
define('PAYPAL_CANCEL_URL', 'http://localhost/practice/paypal/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://localhost/practice/paypal/ipn.php'); 
define('PAYPAL_CURRENCY', 	'AUD'); 
 
// Database configuration 
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', 'password'); 
define('DB_NAME', 'practice');
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");