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
	
	
	
	$where = Array('idatracciones' => $_POST["news"]);
	$atraccion = $db->query('SELECT * FROM atracciones WHERE idatracciones = ' . $_POST["news"]);
	
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
	        	unlink('../images/atracciones/' . $atraccion["fotosatrac"]);
				unlink('../images/atracciones/thumb150/' . $atraccion["fotosatrac"]);
	        	if(($ext1 === 'jpg') or ($ext1 === 'jpeg'))
	            {
	                $fM->createThumbnailJPEG('../images/atracciones/', $nombreimagenPrincipal . '.' . $ext1, '../images/atracciones/thumb150/', 150, 100);
	            }
	            if(($ext1 === 'png'))
	            {
	                $fM->createThumbnailPNG('../images/atracciones/', $nombreimagenPrincipal . '.' . $ext1, '../images/atracciones/thumb150/', 150, 0);
	            }
				$foto = Array('fotosatrac' => $nombreimagenPrincipal . '.' . $ext1);
				$db->update('atracciones','fotosatrac', $foto);
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
	        	unlink('../images/atracciones/' . $atraccion["ph1"]);
				unlink('../images/atracciones/thumb49/' . $atraccion["ph1"]);
	        	if(($ext2 === 'jpg') or ($ext2 === 'jpeg'))
	            {
	            	 $fM->createThumbnailJPEG('../images/atracciones/', $nombreImagen1 . '.' . $ext2, '../images/atracciones/thumb49/', 120, 100);
	            }
	            if(($ext2 === 'png'))
	            {
	                 $fM->createThumbnailPNG('../images/atracciones/', $nombreImagen1 . '.' . $ext2, '../images/atracciones/thumb49/', 120, 0);
	            }
				$foto = Array('fotosatrac' => $nombreImagen1 . '.' . $ext2);
				$db->update('atracciones','ph1', $foto);
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
	        	unlink('../images/atracciones/' . $atraccion["ph2"]);
				unlink('../images/atracciones/thumb49/' . $atraccion["ph2"]);
	        	if(($ext3 === 'jpg') or ($ext3 === 'jpeg'))
	            {
	            	 $fM->createThumbnailJPEG('../images/atracciones/', $nombreImagen2 . '.' . $ext3, '../images/atracciones/thumb49/', 120, 100);
	            }
	            if(($ext3 === 'png'))
	            {
	                 $fM->createThumbnailPNG('../images/atracciones/', $nombreImagen2 . '.' . $ext3, '../images/atracciones/thumb49/', 120, 0);
	            }
				$foto = Array('fotosatrac' => $nombreImagen2 . '.' . $ext3);
				$db->update('atracciones','ph2', $foto);
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
	        	unlink('../images/atracciones/' . $atraccion["ph3"]);
				unlink('../images/atracciones/thumb49/' . $atraccion["ph3"]);
	        	if(($ext3 === 'jpg') or ($ext3 === 'jpeg'))
	            {
	            	 $fM->createThumbnailJPEG('../images/atracciones/', $nombreImagen3 . '.' . $ext4, '../images/atracciones/thumb49/', 120, 100);
	            }
	            if(($ext3 === 'png'))
	            {
	                 $fM->createThumbnailPNG('../images/atracciones/', $nombreImagen3 . '.' . $ext4, '../images/atracciones/thumb49/', 120, 0);
	            }
				$foto = Array('fotosatrac' => $nombreImagen3 . '.' . $ext4);
				$db->update('atracciones','ph3', $foto);
			}
		}
	}
	$data = Array('nombreatrac' => $_POST["nombreatrac"],
				'descatrac' => $_POST["descatrac"]
				);
	$db->update('atracciones', $data, $where);
}
header("Location: " . $_SERVER["HTTP_REFERER"]);

?>