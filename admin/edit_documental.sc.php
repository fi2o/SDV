<?php
// -------------------------------------------------------
$msg = FALSE;
$error = FALSE;
$action = 'insert';
$db = db();
$page_title = 'Documentales';

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
	$record['ndocumental'] = substr($db->escape($_POST['ndocumental']),0,254);
	$record['linkv'] = substr($db->escape($_POST['linkv']),0,254);
	$record['descv'] = ($_POST['descv']);
	

	if ($record['linkv']=='') {
		errorMsg('Suba un video.');
	}
	
	

	if ($record['descv']=='') {
		errorMsg('Escriba una breve descripción.');
	}
	
	
	if (!$error) {
		$IDNEWS = $db->insert('documentales',$record);
		goto2('admin/index.php');
	}
}
else if (@$_POST['action']=='update')
{
	$record['ndocumental'] = substr($db->escape($_POST['ndocumental']),0,254);
	$record['linkv'] = substr($db->escape($_POST['linkv']),0,254);
	$record['descv'] = ($_POST['descv']);
	
	
	if (!ctype_digit(@$_POST['news'])) {
		goto2('admin/index.php?1');
	}
	
	$IDNEWS = @$_POST['news'];	
	
	if (!$error) {
		$db->update('documentales',$record,$IDNEWS);
		goto2('admin/index.php');
	}
}


if (@$_GET['action']=='show') {
	$action = 'update';
	
	if (!ctype_digit(@$_GET['news'])) {
		goto2('admin/index.php');
	}
	
	$_POST = $db->get_row('documentales',$_GET['news']);
	
	if ($db->num_rows()!=1) {
		errorMsg('Este registro no existe.');
	}

	$page_title = 'Editar documental';
}

?>