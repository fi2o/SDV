<?php 
require_once('../config.php');
$db = db();
if(file_exists('../images/galeria/' . $_POST["imageName"]))
unlink('../images/galeria/' . $_POST["imageName"]);
if(file_exists('../images/galeria/thumb900/' . $_POST["imageName"]))
unlink('../images/galeria/thumb900/' . $_POST["imageName"]);
if(file_exists('../images/galeria/thumb120/' . $_POST["imageName"]))
unlink('../images/galeria/thumb120/' . $_POST["imageName"]);
$imagen = Array(
	'nombre' => $_POST["imageName"]
	);
$sql = "DELETE FROM galeria WHERE nombre LIKE '" . $_POST['imageName']."'";
$db->query($sql,FALSE);
header('Location: ' . $_SERVER["HTTP_REFERER"]);
?>