<?php
// -------------------------------------------------------
$msg = FALSE;
$error = FALSE;
$action = 'insert';
$db = db();
$page_title = 'Videos en vivo';

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
	$record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);
	$record['covid'] = ($_POST['covid']);
	

	if ($record['covid']=='') {
		errorMsg('Suba un video.');
	}
	
	

	if ($record['idprovincias']=='') {
		errorMsg('Seleccionar Provincia.');
	}
	
	
	if (!$error) {
		$IDNEWS = $db->insert('videosvivo',$record);
		goto2('admin/index.php');
	}
}
else if (@$_POST['action']=='update')
{
    $record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);
	$record['covid'] = ($_POST['covid']);
	
	
	if (!ctype_digit(@$_POST['news'])) {
		goto2('admin/index.php?1');
	}
	
	$IDNEWS = @$_POST['news'];	
	
	if (!$error) {
		$db->update('videosvivo',$record,$IDNEWS);
		goto2('admin/index.php');
	}
}


if (@$_GET['action']=='show') {
	$action = 'update';
	
	if (!ctype_digit(@$_GET['news'])) {
		goto2('admin/index.php');
	}
	
	$_POST = $db->get_row('videosvivo',$_GET['news']);
	
	if ($db->num_rows()!=1) {
		errorMsg('Este registro no existe.');
	}

	$page_title = 'Editar Video';
}

?>