<?php
require '../config.php';
require 'security.php';

if (!ctype_digit(@$_GET['banner'])) {
	goto2('admin/');
}

$db = db();

$IDATRACCIONES = @$_GET['banner'];

$db->delete('banners',$IDATRACCIONES);

goto2('admin/index.php');
?>
