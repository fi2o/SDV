<?php
require '../config.php';
require 'security.php';

if (!ctype_digit(@$_GET['noticia'])) {
	goto2('admin/');
}

$db = db();

$IDATRACCIONES = @$_GET['noticia'];

$db->delete('noticias',$IDATRACCIONES);

goto2('admin/lnoticias.php');
?>
