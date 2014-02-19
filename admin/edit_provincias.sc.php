<?php
// -------------------------------------------------------
$msg = FALSE;
$error = FALSE;
$action = 'insert';
$db = db();
$page_title = 'Agregar Provincia';
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
	$record['descprovincia'] = ($_POST['descprovincia']);	
	
	
	if ($record['descprovincia']=='') {
		errorMsg('Escriba un titulo para la noticia.');
	}
	
	
	if (!$error) {
		$IDNEWS = $db->insert('personajes',$record);
         errorMsg('La entrada se ha agregado');
		 goto2('admin/descprovincia.php');
	}
}
else if (@$_POST['action']=='update')
{
	$record['descprovincia'] = ($_POST['descprovincia']);
	
	
	if (!ctype_digit(@$_POST['news'])) {
		goto2('admin/index.php?1');
	}
	
	$IDNEWS = @$_POST['news'];
	
	if (!$error) {
		$db->update('provincias',$record,$IDNEWS);
		errorMsg('Se actualizo la provincia');
	}
}


if (@$_GET['action']=='show') {
	$action = 'update';
	
	if (!ctype_digit(@$_GET['news'])) {
		goto2('admin/index.php');
	}
	
	$_POST = $db->get_row('provincias',$_GET['news']);
	
	if ($db->num_rows()!=1) {
		errorMsg('Este registro no existe.');
	}

	$page_title = 'Editar Provincia';
}

?>