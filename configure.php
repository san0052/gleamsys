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
$cfg['base_url']            			=	"http://kunanyicl-com-au.preview-domain.com/";
$cfg['HTTP_SERVER']						=	'http://'.$_SERVER['HTTP_HOST'].'/';
$cfg['DIR_WS']							=	'/var/www/html/';

$cfg['ADMIN_TITLE']						=	'KUNANYI - Admin Panel';
$cfg['TITLE']							=	':: KUNANYI';
$cfg['ADMIN_NAME']						=	'KUNANYI';
$cfg['ADMIN_EMAIL']						=	'info@kynanyicl.com.au';
$cfg['INFO_EMAIL']						=	'info@kynanyicl.com.au';
$cfg['SITE_NAME']						=	'KUNANYI';

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
$cfg['DB_SERVER_USERNAME']				=	'u731538542_kunanyicl'; // Database user name
$cfg['DB_SERVER_PASSWORD']				=	'kunanyicl!@#$#@!'; // Database password
$cfg['DB_DATABASE']						=	'u731538542_kunanyicl'; // Database Name*/


$cfg['DB_TYPE']		        			=	'mysql'; // Dabase type MYSQL or ORACLE
$cfg['USE_PCONNECT']					=	FALSE;
?>