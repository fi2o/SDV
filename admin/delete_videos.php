<?php
require '../config.php';
require 'security.php';

if (!ctype_digit(@$_GET['video'])) {
	goto2('admin/');
}

$db = db();

$IDATRACCIONES = @$_GET['video'];

$db->delete('videosyt',$IDATRACCIONES);

goto2('admin/lvideos.php');
?>
