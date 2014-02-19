<?php
require '../config.php';
require 'security.php';

if (!ctype_digit(@$_GET['directorio'])) {
	goto2('admin/');
}

$db = db();

$IDATRACCIONES = @$_GET['directorio'];

$db->delete('directorio',$IDATRACCIONES);

goto2('admin/directorio.php');
?>
