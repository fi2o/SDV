<?php
require '../config.php';
require 'security.php';

if (!ctype_digit(@$_GET['atracciones'])) {
	goto2('admin/');
}

$db = db();

$IDATRACCIONES = @$_GET['atracciones'];

$db->delete('atracciones',$IDATRACCIONES);

goto2('admin/atracciones.php');
?>
