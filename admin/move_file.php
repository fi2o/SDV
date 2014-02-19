<?php
ini_set("memory_limit","1000M");
ini_set('max_execution_time', 1000);
ini_set("post_max_size", "5000M");
ini_set("upload_max_filesize", "500M"); 
require_once('../lib/stringmanager.php');
require_once('../lib/filemanager.php');
require_once('../config.php');
$minWidth = 400; # Ancho minimo de la imagen
$minHeight = 400; #Largo minimo de la imagen
$fM = new fileManager(); #Se crea el objeto manejador de archivos
$sM = new stringManager(); #Se crea el objeto manejador de textos
$db = db();

$file = $fM->reArrayFiles($_FILES['file']);
foreach($file as $f)
{
	list($width, $height) = getimagesize($f['tmp_name']);
	$nombreImagen = $sM->generateFullRandomCode();
	$ext = pathinfo($f['name'], PATHINFO_EXTENSION);
	$imagenesPermitidas = Array('jpg', 'png', 'jpeg'); 

	if(($width >= $minWidth) and ($height >= $minHeight))
	{
		if(in_array($ext, $imagenesPermitidas))
	    {
    		if($fM->fileUpload($f, '../images/galeria/' , $nombreImagen))
	        {
	        	$imagen = Array(
					'nombre' => $nombreImagen . '.' . $ext,
					'caption' => $_POST['caption']
				);
	        	$db->insert('galeria', $imagen);
				#$db->query($sql,FALSE);
	        	if(($ext === 'jpg') or ($ext === 'jpeg'))
	            {
	                $fM->createThumbnailJPEG('../images/galeria/', $nombreImagen . '.' . $ext, '../images/galeria/thumb900/', 900, 100);
					$fM->createThumbnailJPEG('../images/galeria/thumb900/', $nombreImagen . '.' . $ext, '../images/galeria/thumb120/', 300, 100);
	            }
	            if(($ext === 'png'))
	            {
	                $fM->createThumbnailPNG('../images/galeria/', $nombreImagen . '.' . $ext, '../images/galeria/thumb900/', 900, 0);
					$fM->createThumbnailPNG('../images/galeria/thumb900/', $nombreImagen . '.' . $ext, '../images/galeria/thumb120/', 300, 0);
	            }
			}
	    	
		}
	}
}

header('Location: ' . $_SERVER["HTTP_REFERER"]);

?>