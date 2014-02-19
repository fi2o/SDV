<?php
// -------------------------------------------------------
$msg = FALSE;
$error = FALSE;
$action = 'insert';
$db = db();
$page_title = 'Videos';

// -------------------------------------------------------
function errorMsg($str) {
	global $msg, $error;
	
	$error = TRUE;
	
	if ($msg===FALSE) {
		$msg = $str;
	}
}

// -------------------------------------------------------
if (@$_POST['action']=='insert')
{
	$record['nvideo'] = substr($db->escape($_POST['nvideo']),0,254);
	$record['idsecciones'] = substr($db->escape($_POST['idsecciones']),0,254);
	$record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);	
	$record['linkv'] = substr($db->escape($_POST['linkv']),0,254);
	$record['fecha_publi'] = substr($db->escape($_POST['fecha_publi']),0,254);
	$record['descv'] = ($_POST['descv']);
	

	if ($record['linkv']=='') {
		errorMsg('Suba un video.');
	}
	
	

	if ($record['descv']=='') {
		errorMsg('Escriba una breve descripción.');
	}
	
	
	if (!$error) {
		$IDNEWS = $db->insert('videosyt',$record);
		goto2('admin/index.php');
	}
}
else if (@$_POST['action']=='update')
{
	$record['nvideo'] = substr($db->escape($_POST['nvideo']),0,254);
	$record['idsecciones'] = substr($db->escape($_POST['idsecciones']),0,254);
	$record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);
	$record['linkv'] = substr($db->escape($_POST['linkv']),0,254);
	$record['fecha_publi'] = substr($db->escape($_POST['fecha_publi']),0,254);
	$record['descv'] = ($_POST['descv']);
	
	
	if (!ctype_digit(@$_POST['news'])) {
		goto2('admin/index.php?1');
	}
	
	$IDNEWS = @$_POST['news'];	
	
	if (!$error) {
		$db->update('videosyt',$record,$IDNEWS);
		errorMsg('Este registro ha sido actualizado.');
	}
}


if (@$_GET['action']=='show') {
	$action = 'update';
	
	if (!ctype_digit(@$_GET['news'])) {
		goto2('admin/l.php');
	}
	
	$_POST = $db->get_row('videosyt',$_GET['news']);
	
	if ($db->num_rows()!=1) {
		errorMsg('Este registro no existe.');
	}

	$page_title = 'Editar Video';
}

?>