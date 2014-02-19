<?php 
ini_set("memory_limit","1000M");
ini_set('max_execution_time', 1000);
ini_set("post_max_size", "5000M");
ini_set("upload_max_filesize", "500M"); 
require_once('../lib/stringmanager.php');
require_once('../lib/filemanager.php');
require_once('../config.php');

if(!empty($_POST["nombreatrac"]))
{
	#imagen principal
	$minWidth = 150; # Ancho minimo de la imagen
	$minHeight = 70; #Largo minimo de la imagen
	$fM = new fileManager(); #Se crea el objeto manejador de archivos
	$sM = new stringManager(); #Se crea el objeto manejador de textos
	$db = db();
	$imagenesPermitidas = Array('jpg', 'png', 'jpeg'); 
	list($width, $height) = getimagesize($_FILES['imagenPrincipal']['tmp_name']);
	if(($width >= $minWidth) and ($height >= $minHeight))
	{
		$ext1 = pathinfo($_FILES['imagenPrincipal']['name'], PATHINFO_EXTENSION);
		if(in_array($ext1, $imagenesPermitidas))
	    {
	    	$nombreimagenPrincipal = $sM->generateFullRandomCode();
			if($fM->fileUpload($_FILES['imagenPrincipal'], '../images/atracciones/' , $nombreimagenPrincipal))
	        {
	        	if(($ext1 === 'jpg') or ($ext1 === 'jpeg'))
	            {
	                $fM->createThumbnailJPEG('../images/atracciones/', $nombreimagenPrincipal . '.' . $ext1, '../images/atracciones/thumb150/', 110, 100);
	            }
	            if(($ext1 === 'png'))
	            {
	                $fM->createThumbnailPNG('../images/atracciones/', $nombreimagenPrincipal . '.' . $ext1, '../images/atracciones/thumb150/', 110, 0);
	            }
			}
		}
	}
	
	#imagen 1
	list($width, $height) = getimagesize($_FILES['imagen1']['tmp_name']);
	
	
	if(($width >= $minWidth) and ($height >= $minHeight))
	{
		$ext2 = pathinfo($_FILES['imagen1']['name'], PATHINFO_EXTENSION);
		if(in_array($ext2, $imagenesPermitidas))
	    {
	    	$nombreImagen1 = $sM->generateFullRandomCode();
			if($fM->fileUpload($_FILES['imagen1'], '../images/atracciones/' , $nombreImagen1))
	        {
	        	if(($ext2 === 'jpg') or ($ext2 === 'jpeg'))
	            {
	            	 $fM->createThumbnailJPEG('../images/atracciones/', $nombreImagen1 . '.' . $ext2, '../images/atracciones/thumb49/', 120, 100);
	            }
	            if(($ext2 === 'png'))
	            {
	                 $fM->createThumbnailPNG('../images/atracciones/', $nombreImagen1 . '.' . $ext2, '../images/atracciones/thumb49/', 120, 0);
	            }
			}
		}
	}
	
	
	#imagen 2
	list($width, $height) = getimagesize($_FILES['imagen2']['tmp_name']);
	if(($width >= $minWidth) and ($height >= $minHeight))
	{
		$ext3 = pathinfo($_FILES['imagen2']['name'], PATHINFO_EXTENSION);
		if(in_array($ext3, $imagenesPermitidas))
	    {
	    	$nombreImagen2 = $sM->generateFullRandomCode();
			if($fM->fileUpload($_FILES['imagen2'], '../images/atracciones/' , $nombreImagen2))
	        {
	        	if(($ext3 === 'jpg') or ($ext3 === 'jpeg'))
	            {
	            	 $fM->createThumbnailJPEG('../images/atracciones/', $nombreImagen2 . '.' . $ext3, '../images/atracciones/thumb49/', 120, 100);
	            }
	            if(($ext3 === 'png'))
	            {
	                 $fM->createThumbnailPNG('../images/atracciones/', $nombreImagen2 . '.' . $ext3, '../images/atracciones/thumb49/', 120, 0);
	            }
			}
		}
	}
	
	#imagen 3
	list($width, $height) = getimagesize($_FILES['imagen3']['tmp_name']);
	
	if(($width >= $minWidth) and ($height >= $minHeight))
	{
		$ext4 = pathinfo($_FILES['imagen3']['name'], PATHINFO_EXTENSION);
		if(in_array($ext4, $imagenesPermitidas))
	    {
	    	$nombreImagen3 = $sM->generateFullRandomCode();
			if($fM->fileUpload($_FILES['imagen3'], '../images/atracciones/' , $nombreImagen3))
	        {
	        	if(($ext3 === 'jpg') or ($ext3 === 'jpeg'))
	            {
	            	 $fM->createThumbnailJPEG('../images/atracciones/', $nombreImagen3 . '.' . $ext4, '../images/atracciones/thumb49/', 120, 100);
	            }
	            if(($ext3 === 'png'))
	            {
	                 $fM->createThumbnailPNG('../images/atracciones/', $nombreImagen3 . '.' . $ext4, '../images/atracciones/thumb49/', 120, 0);
	            }
			}
		}
	}
	
	if(!empty($nombreimagenPrincipal))
	{
		$nombreimagenPrincipal = $nombreimagenPrincipal . '.' . $ext1;
	}
	if(!empty($nombreImagen1))
	{
		$nombreImagen1 = $nombreImagen1 . '.' . $ext2;
	}
	if(!empty($nombreImagen2))
	{
		$nombreImagen2 = $nombreImagen2 . '.' . $ext3;
	}
	if(!empty($nombreImagen3))
	{
		$nombreImagen3 = $nombreImagen3 . '.' . $ext4;
	}
	
	$data = Array('nombreatrac' => $_POST["nombreatrac"],
				'descatrac' => $_POST["descatrac"],
				'fotosatrac' => $nombreimagenPrincipal,
				'ph1' => $nombreImagen1,
				'ph2' => $nombreImagen2,
				'ph3' => $nombreImagen3
				);
	$db->insert('atracciones', $data);
				
}
header("Location: " . $_SERVER["HTTP_REFERER"]);

?>