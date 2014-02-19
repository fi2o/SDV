<?php
// -------------------------------------------------------
$msg = FALSE;
$error = FALSE;
$action = 'insert';
$db = db();
$page_title = 'Agregar Noticia';
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
	$record['titulo'] = substr($db->escape($_POST['titulo']),0,254);
	$record['linkn'] = substr($db->escape($_POST['linkn']),0,254);
	$record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);
	
  if ($record['titulo']=='') {
		errorMsg('Escriba un titulo para la noticia.');
	}
	
	
	if (!$error) {
		$IDNEWS = $db->insert('noticias',$record);
		goto2('admin/lnoticias.php');
	}
}
else if (@$_POST['action']=='update')
{
		$record['titulo'] = substr($db->escape($_POST['titulo']),0,254);
	$record['linkn'] = substr($db->escape($_POST['linkn']),0,254);
	$record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);
		
	if (!ctype_digit(@$_POST['news'])) {
		goto2('admin/index.php?1');
	}
	
	$IDNEWS = @$_POST['news'];
	
	if (!$error) {
		$db->update('noticias',$record,$IDNEWS);
		goto2('admin/lnoticias.php');
	}
}

if (@$_GET['action']=='show') {
	$action = 'update';
	
	if (!ctype_digit(@$_GET['news'])) {
		goto2('admin/index.php');
	}
	
	$_POST = $db->get_row('noticias',$_GET['news']);
	
	if ($db->num_rows()!=1) {
		errorMsg('Este registro no existe.');
	}

	$page_title = 'Editar noticias';
}

?>