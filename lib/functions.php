<?php
/**
 * Formatea una cantidad numerica como dinero.
 *
 * @param mixed $amount
 * @return stirng
 */
function show_money($amount) {
	return number_format($amount,'2','.',',');
}

// -------------------------------------------------------
function comLoad($file_name) {
	require_once(APP_DIR.'/includes/'. $file_name .'.php');
}

function libLoad($file_name) {
	require_once(APP_DIR.'/lib/'. $file_name .'.php');
}

// -------------------------------------------------------
/**
 * Devuelve una unica instacia de la DB.
 *
 * @return object
 */
function db() {
	global $db;
	
	return $db;
}

// -------------------------------------------------------
function goto2($file_name) {
	header('LOCATION: '.APP_URI."/$file_name");
	exit;
}

// -------------------------------------------------------
function json_output($result,$msg) {
	return toJSON(array('result'=>$result,'msg'=>$msg));
}

// -------------------------------------------------------
function post($param) {
	return @$_POST[$param];
}

// -------------------------------------------------------
function T($str)
{
	return htmlentities(utf8_decode($str));
}
?>
