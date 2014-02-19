<?php
session_name('vive');
session_start();
define('APP_NAME', 'stodgovive');
define('APP_DIR',dirname(realpath(__FILE__)));
define('APP_DOMAIN','santodomingovive.com/mx');
define('APP_URI','http://'. APP_DOMAIN);
define('DEBUG',FALSE);
// -------------------------------------------------------
require_once(APP_DIR.'/lib/functions.php');
// -------------------------------------------------------
libLoad('lang');
// -------------------------------------------------------
$db_cfg['host'] = 'localhost';
$db_cfg['user'] = 'santodom_mixart';
$db_cfg['pass'] = 'Admin001';
$db_cfg['dbname'] = 'santodom_mx2014';
libLoad('db_mysql');
$db = new DB_MySQL($db_cfg);
function debug($error) {
	$msg = "DATE:\t". date('Y-m-d H:i:s') ."\n";
	$msg.= "IP:\t". $_SERVER['REMOTE_ADDR'] ."\n";
	$msg.= "ERORR:\t". $error ."\n";
	@mail('info@mixart.do','APP ERROR: '.APP_DOMAIN,$msg);
	if (DEBUG) {
		exit($msg);
	} else {
		echo $msg;
	}
}
?>