<?php
// -------------------------------------------------------
$msg = FALSE;
$error = FALSE;
$action = 'insert';
$db = db();
$page_title = 'Agregar Banner';
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
	$record['cliente'] = substr($db->escape($_POST['cliente']),0,254);
	$record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);
	$record['idposicion'] = substr($db->escape($_POST['idposicion']),0,254);
	$record['idtec'] = substr($db->escape($_POST['idtec']),0,254);
	$record['content'] = ($_POST['content']);
    $record['fstart'] = substr($db->escape($_POST['fstart']),0,254);
	$record['ffinish'] = substr($db->escape($_POST['ffinish']),0,254);
	$record['link'] = substr($db->escape($_POST['link']),0,254);
	
	if(isset($_FILES['imagen'])){
		$errors= array();
		#$file_name = $_FILES['imagen']['name'];
		
		$file_size =$_FILES['imagen']['size'];
		$file_tmp =$_FILES['imagen']['tmp_name'];
		$file_type=$_FILES['imagen']['type'];   
		$file_ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
		$file_name = $sM->generateFullRandomCode() . '.' . $file_ext;
		$expensions= array("jpeg","jpg","png","PNG","JPG"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size > 6097152){
		$errors[]='File size must be excately 6 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../images/banners/".$file_name);
			$directorio = $file_name;
			if(($file_ext === 'jpg') or ($file_ext === 'jpeg'))
            {
				$fM->createThumbnailJPEG('../images/banners/', $file_name, '../images/banners/thumb728/', 728, 100);
				$fM->createThumbnailJPEG('../images/banners/', $file_name, '../images/banners/thumb400/', 400, 100);
				$fM->createThumbnailJPEG('../images/banners/', $file_name, '../images/banners/thumb300/', 300, 100);
            }
            if(($file_ext === 'png'))
            {
				$fM->createThumbnailPNG('../images/banners/', $file_name, '../images/banners/thumb728/', 728, 0);
				$fM->createThumbnailPNG('../images/banners/', $file_name, '../images/banners/thumb400/', 728, 0);
				$fM->createThumbnailPNG('../images/banners/', $file_name, '../images/banners/thumb300/', 300, 0);
            }
			
			
		}else{
			print_r($errors);
		}
	}
	$record['imagen'] = $directorio;

	if ($record['cliente']=='') {
		errorMsg('Escriba nombre del cliente.');
	}
	
	
	if (!$error) {
		$IDNEWS = $db->insert('banners',$record);
		goto2('admin/index.php');
	}
}
else if (@$_POST['action']=='update')
{
	$record['cliente'] = substr($db->escape($_POST['cliente']),0,254);
	$record['idprovincias'] = substr($db->escape($_POST['idprovincias']),0,254);
	$record['idposicion'] = substr($db->escape($_POST['idposicion']),0,254);
	if(!empty($_POST['idtec'])){
	$record['idtec'] = substr($db->escape($_POST['idtec']),0,254);}
	$record['content'] = ($_POST['content']);
    $record['fstart'] = substr($db->escape($_POST['fstart']),0,254);
	$record['ffinish'] = substr($db->escape($_POST['ffinish']),0,254);
	$record['link'] = substr($db->escape($_POST['link']),0,254);
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
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size > 6097152){
		$errors[]='File size must be excately 6 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../images/banners/".$file_name);
			$record['imagen'] = $file_name;
			
			if(($file_ext === 'jpg') or ($file_ext === 'jpeg'))
            {
				$fM->createThumbnailJPEG('../images/banners/', $file_name, '../images/banners/thumb728/', 728, 100);
				$fM->createThumbnailJPEG('../images/banners/', $file_name, '../images/banners/thumb400/', 400, 100);
				$fM->createThumbnailJPEG('../images/banners/', $file_name, '../images/banners/thumb300/', 300, 100);
            }
            if(($file_ext === 'png'))
            {
				$fM->createThumbnailPNG('../images/banners/', $file_name, '../images/banners/thumb728/', 728, 0);
				$fM->createThumbnailPNG('../images/banners/', $file_name, '../images/banners/thumb400/', 400, 0);
				$fM->createThumbnailPNG('../images/banners/', $file_name, '../images/banners/thumb300/', 300, 0);
            }
		}else{
			print_r($errors);
		}
	}
	
	if (!ctype_digit(@$_POST['news'])) {
		goto2('admin/index.php?1');
	}
	
	$IDNEWS = @$_POST['news'];
	
	if (!$error) {
		$db->update('banners',$record,$IDNEWS);
		errorMsg('Este registro ha sido actualizado.');
	}
}


if (@$_GET['action']=='show') {
	$action = 'update';
	
	if (!ctype_digit(@$_GET['news'])) {
		goto2('admin/index.php');
	}
	
	$_POST = $db->get_row('banners',$_GET['news']);
	
	if ($db->num_rows()!=1) {
		errorMsg('Este registro no existe.');
	}

	$page_title = 'Editar actividad';
}

?>