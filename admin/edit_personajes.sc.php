<?php
// -------------------------------------------------------
$msg = FALSE;
$error = FALSE;
$action = 'insert';
$db = db();
$page_title = 'Agregar Personaje';
require_once('../lib/filemanager.php');
require_once('../lib/stringmanager.php');
// -------------------------------------------------------
function errorMsg($str) {
	global $msg, $error;
	
	$error = TRUE;
	
	if ($msg===FALSE) {
		$msg = $str;
	}
}
$fM = new fileManager();
$sM = new stringManager(); 
// -------------------------------------------------------
if (@$_POST['action']=='insert')
{
	$record['nombre'] = substr($db->escape($_POST['nombre']),0,254);
	$record['desc'] = ($_POST['desc']);	
	$record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);
	
	if(isset($_FILES['imagen'])){
		$errors= array();
		#$file_name = $_FILES['imagen']['name'];
		$file_size =$_FILES['imagen']['size'];
		$file_tmp =$_FILES['imagen']['tmp_name'];
		$file_type=$_FILES['imagen']['type'];   
		$file_ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
		$file_name = $sM->generateFullRandomCode() . '.' . $file_ext;
		$expensions= array("jpeg","jpg","png"); 		
		if(in_array($file_ext,$expensions)=== false){
		}
		if($file_size > 2097152){
		$errors[]='File size must be excately 2 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../images/personajes/".$file_name);
			$directorio = $file_name;
			if(($file_ext === 'jpg') or ($file_ext === 'jpeg'))
            {
                $fM->createThumbnailJPEG('../images/personajes/', $file_name, '../images/personajes/thumb400/', 400, 100);
				$fM->createThumbnailJPEG('../images/personajes/thumb400/', $file_name, '../images/personajes/thumb180/', 180, 100);
            }
            if(($file_ext === 'png'))
            {
                $fM->createThumbnailPNG('../images/personajes/', $file_name, '../images/personajes/thumb400/', 400, 0);
				$fM->createThumbnailPNG('../images/personajes/400/', $file_name, '../images/personajes/thumb180/', 180, 0);
            }
			
			
		}else{
			print_r($errors);
		}
	}
	$record['imagen'] = $directorio;

	if ($record['nombre']=='') {
		errorMsg('Escriba un titulo para la noticia.');
	}
	
	
	if (!$error) {
		$IDNEWS = $db->insert('personajes',$record);
         errorMsg('La entrada se ha agregado');
		 goto2('admin/personajes.php');
	}
}
else if (@$_POST['action']=='update')
{
	$record['nombre'] = substr($db->escape($_POST['nombre']),0,254);
	$record['desc'] = ($_POST['desc']);	
	$record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);
			
	if($_FILES['imagen']['size'] == 0){
		} else{
		$errors= array();
		#$file_name = $_FILES['imagen']['name'];
		$file_size =$_FILES['imagen']['size'];
		$file_tmp =$_FILES['imagen']['tmp_name'];
		$file_type=$_FILES['imagen']['type'];   
		$file_ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
		$file_name = $sM->generateFullRandomCode() . '.' . $file_ext;
		$expensions= array("jpeg","jpg","png"); 		
		if(in_array($file_ext,$expensions)=== false){
		}
		if($file_size > 5097152){
		$errors[]='File size must be excately 5 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../images/personajes/".$file_name);
			$record['imagen'] = $file_name;
			if(($file_ext === 'jpg') or ($file_ext === 'jpeg'))
            {
                $fM->createThumbnailJPEG('../images/personajes/', $file_name, '../images/personajes/thumb400/', 400, 100);
				$fM->createThumbnailJPEG('../images/personajes/thumb400/', $file_name, '../images/personajes/thumb180/', 180, 100);
            }
            if(($file_ext === 'png'))
            {
                $fM->createThumbnailPNG('../images/personajes/', $file_name, '../images/personajes/thumb400/', 400, 0);
				$fM->createThumbnailPNG('../images/personajes/thumb400/', $file_name, '../images/personajes/thumb180/', 180, 0);
            }
			
			
		}
	}
	
	
	if (!ctype_digit(@$_POST['news'])) {
		goto2('admin/index.php?1');
	}
	
	$IDNEWS = @$_POST['news'];
	
	if (!$error) {
		$db->update('personajes',$record,$IDNEWS);
		errorMsg('El personaje se ha actualizado');
	}
}


if (@$_GET['action']=='show') {
	$action = 'update';
	
	if (!ctype_digit(@$_GET['news'])) {
		goto2('admin/index.php');
	}
	
	$_POST = $db->get_row('personajes',$_GET['news']);
	
	if ($db->num_rows()!=1) {
		errorMsg('Este registro no existe.');
	}

	$page_title = 'Editar Personaje';
}

?>