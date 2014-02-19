<?php 
require_once('../config.php');
$db = db();
$imagen = Array(
	'nombre' => $_POST["imageName"]
	);
$sql = "UPDATE galeria set caption = '". $_POST["caption"] ."' WHERE nombre LIKE '" . $_POST['imageName']."'";
$db->query($sql,FALSE);
header('Location: ' . $_SERVER["HTTP_REFERER"]);
?>