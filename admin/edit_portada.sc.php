<?php
// -------------------------------------------------------
$msg = FALSE;
$error = FALSE;
$action = 'insert';
$db = db();
$page_title = 'Portada';

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
	$record['video'] = substr($db->escape($_POST['video']),0,254);
	$record['descripcion'] = ($_POST['descripcion']);
	

	if ($record['video']=='') {
		errorMsg('Suba un video.');
	}
	
	

	if ($record['descripcion']=='') {
		errorMsg('Escriba una breve descripcion.');
	}
	
	
	if (!$error) {
		$IDNEWS = $db->insert('concursante',$record);
		goto2('admin/index.php');
	}
}
else if (@$_POST['action']=='update')
{
	$record['video'] = substr($db->escape($_POST['video']),0,254);
	$record['descripcion'] = ($_POST['descripcion']);
	
	
	if (!ctype_digit(@$_POST['news'])) {
		goto2('admin/index.php?1');
	}
	
	$IDNEWS = @$_POST['news'];	
	
	if (!$error) {
		$db->update('paginas',$record,$IDNEWS);
		goto2('admin/index.php');
	}
}


if (@$_GET['action']=='show') {
	$action = 'update';
	
	if (!ctype_digit(@$_GET['news'])) {
		goto2('admin/index.php');
	}
	
	$_POST = $db->get_row('paginas',$_GET['news']);
	
	if ($db->num_rows()!=1) {
		errorMsg('Este registro no existe.');
	}

	$page_title = 'Editar portada';
}

?>