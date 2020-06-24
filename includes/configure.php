<?php
error_reporting(1);
@ini_set('display_errors', '1');
@ini_set('session.name', 'sid');
/**
*	Define the webserver and path parameters
*	DIR_FS_* = Filesystem directories (local/physical)
*	DIR_WS_* = Webserver directories (virtual/URL)
*/
$cfg									=	array();
// eg, http://localhost - should not be empty for productive servers
//die($_SERVER['HTTP_HOST']);
$cfg['H_MENU']='';
$cfg['base_url']            			=	"http://localhost/gleamsys/";
$cfg['HTTP_SERVER']						=	'http://'.$_SERVER['HTTP_HOST'].'/';
$cfg['DIR_WS']							=	'/var/www/html/';

$cfg['ADMIN_TITLE']						=	'Gleamsys - Admin Panel';
$cfg['TITLE']							=	':: Gleamsys';
$cfg['ADMIN_NAME']						=	'Gleamsys';
$cfg['ADMIN_EMAIL']						=	'info@gleamsys.com';
$cfg['INFO_EMAIL']						=	'info@gleamsys.com';
$cfg['SITE_NAME']						=	'Gleamsys';

// eg, https://localhost - should not be empty for productive servers
$cfg['HTTPS_SERVER']					=	"https://".$_SERVER['HTTP_HOST']."/";
$cfg['ENABLE_SSL']						=	FALSE; // secure webserver for checkout procedure?

$cfg['HTTP_COOKIE_DOMAIN']				=	'localhost';
$cfg['HTTPS_COOKIE_DOMAIN'] 			=	'';
$cfg['HTTP_COOKIE_PATH']				=	$cfg['DIR_WS'].'tmp/';
$cfg['HTTPS_COOKIE_PATH']				=	'';

$cfg['DIR_WS_INCLUDES']					=	$cfg['DIR_WS'].'includes/';
$cfg['DIR_WS_CLASSES']					=	$cfg['HTTP_SERVER'].'libs/';

// Client side path
$cfg['IMAGES']							=	'images/';
$cfg['IMAGES_FRANT']					=	'images/';
$cfg['DIR_WS_JSCRIPT']					=	'scripts/';

//Database Details
$cfg['DB_SERVER']						=	'localhost';
$cfg['DB_SERVER_USERNAME']				=	'root'; // Database user name
$cfg['DB_SERVER_PASSWORD']				=	''; // Database password
$cfg['DB_DATABASE']						=	'gleamsys'; // Database Name*/


$cfg['DB_TYPE']		        			=	'mysql'; // Dabase type MYSQL or ORACLE
$cfg['USE_PCONNECT']					=	FALSE;


// PayPal configuration 
define('PAYPAL_ID', 'sb-8vqor1649489@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', $cfg['base_url'].'paypal/success.php'); 
define('PAYPAL_CANCEL_URL', $cfg['base_url'].'paypal/cancel.php'); 
define('PAYPAL_NOTIFY_URL', $cfg['base_url'].'paypal/ipn.php'); 
define('PAYPAL_CURRENCY', 	'AUD'); 

define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>