<?php

class Thumbs
{
	public $quality = "85";
	
    /**
     * Crea un thumb a partir de la imagen dada.
     *
     * @param string $original_image
     * @param string $thumb
     * @param integer $fix limited/fixed by width, height or both (0 = both, 1 = width, 2 = height)
     * @return bool
     */

	public function create_thumb($original_image, $thumb, $maxW, $maxH, $fix = 3)
	{
		switch ($fix)
		{
			case 0:
				$crop = TRUE;
				break;

			default:

			case 1:
				$crop = TRUE;
				break;

			default:

			case 2:
				$crop = FALSE;
				break;

			default:

			case 3:
				$crop = TRUE;
				break;


			default:
				return FALSE;
				break;
		}

		return $this->create_thumb2($original_image, $thumb, $maxW, $maxH, $this->quality, $crop);

////////////////////////////////////////////////////////////////////
//		ESTA FUNCION DE AQUI PARA ABAJO ESTA OBSOLETA.
////////////////////////////////////////////////////////////////////
//
//		$srcFile = $original_image;
//
//		list($srcW, $srcH, $srcType, $html_attr) = getimagesize($srcFile);
//
//		# --------------------------------------------------------
//		# Extraigo la extension de archivo.
//		$ext = substr($original_image, (strrpos($original_image, '.') + 1));
//		$ext = strtolower($ext);
//
//		# --------------------------------------------------------
//		if($ext == 'jpg' || $ext == 'jpeg')
//		{
//			$srcImage = @imagecreatefromjpeg($srcFile);
//		}
//		elseif($ext == 'gif')
//		{
//			$srcImage = @imagecreatefromgif($srcFile);
//		}
//		elseif($ext == 'png')
//		{
//			$srcImage = @imagecreatefrompng($srcFile);
//		}
//		else
//		{
//			return FALSE;
//		}
//
//		# --------------------------------------------------------
//		# Por ambos
//		if($fix == 0)
//		{
//			/*if(($srcW / $maxW) > ($srcH / $maxH))
//			{
//				$factor = $maxW / $srcW;
//			}
//			else
//			{
//				$factor = $maxH / $srcH;
//			}
//
//			$newH = (int) round($srcH * $factor);
//			$newW = (int) round($srcW * $factor);*/
//
//			$newH = (int) $maxH;
//			$newW = (int) $maxW;
//
//			$newImage = imagecreatetruecolor($newW, $newH);
//		}
//		# Por el ancho
//		elseif($fix == 1)
//		{
//			$factor = $maxW / $srcW;
//
//			$newH = (int) round($srcH * $factor);
//			$newW = (int) round($srcW * $factor);
//
//			$newImage = imagecreatetruecolor($newW, $newH);
//		}
//		# Por el alto
//		elseif($fix == 2)
//		{
//			$factor = $maxH / $srcH;
//
//			$newH = (int) round($srcH * $factor);
//			$newW = (int) round($srcW * $factor);
//
//			$newImage = imagecreatetruecolor($newW, $newH);
//		}
//		elseif($fix == 3)
//		{
//			if ($srcW > $srcH)
//			{
//				$factor = $maxH / $srcH;
//			}
//			elseif ($srcW < $srcH)
//			{
//				$factor = $maxW / $srcW;
//			}
//			elseif ($srcW == $srcH)
//			{
//				$factor = $maxW / $srcW; # <- Esto esta mal, hay que corregirlo.
//			}
//
//			$newH = (int) round($srcH * $factor);
//			$newW = (int) round($srcW * $factor);
//
//			$newImage = imagecreatetruecolor($maxW, $maxH);
//		}
//
//
//		imagecopyresampled($newImage, $srcImage, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
//		imagejpeg($newImage, $thumb, $this->quality);
//
//		# --------------------------------------------------------
//		return TRUE;
	}

	public function create_thumb2($imagePath, $newPath, $thumbW, $thumbH, $quality = 90, $crop = TRUE)
	{

		if (!is_file($imagePath))
		{
			throw new Exception('create_thumb2: la ubicacion del archivo es incorrecta.');
		}

		@unlink($newPath);


		$imageInfo = getimagesize($imagePath);
		$imageW = $imageInfo[0];
		$imageH = $imageInfo[1];

		if ($thumbH == 'auto' && $thumbW > 0)
		{
			$thumbH = ceil(($thumbW * $imageH) / $imageW);
		}
		elseif ($thumbW == 'auto' && $thumbH > 0)
		{
			$thumbW = ceil(($thumbH * $imageW) / $imageH);
		}


		$wCalc = ceil(($thumbH * $imageW) / $imageH);
		$hCalc = ceil(($thumbW * $imageH) / $imageW);

		if (($wCalc == $thumbW) && ($hCalc == $thumbH))
		{
			// no se hace nada
		}
		elseif (($wCalc < $thumbW) && ($hCalc >= $thumbH))
		{
			$wCalc = $thumbW;
			$hCalc = ceil(($thumbW * $imageH) / $imageW);
		}
		elseif (($wCalc > $thumbW) && ($hCalc <= $thumbH))
		{
			$wCalc = ceil(($thumbH * $imageW) / $imageH);
			$hCalc = $thumbH;
		}

		# Extraigo la extension de archivo.
		$ext = substr($imagePath, (strrpos($imagePath, '.') + 1));
		$ext = strtolower($ext);

		$srcFile = $imagePath;

		if($ext == 'jpg' || $ext == 'jpeg')
		{
			$srcImage = imagecreatefromjpeg($srcFile);
		}
		elseif($ext == 'gif')
		{
			$srcImage = imagecreatefromgif($srcFile);
		}
		elseif($ext == 'png')
		{
			$srcImage = imagecreatefrompng($srcFile);
		}
		else
		{
			throw new Exception('create_thumb2: el formato de la imagen es desconido.');
		}

		if(!$srcImage) throw new Exception('create_thumb2: no se pudo crear el lienzo.');


		$newImage = imagecreatetruecolor($wCalc, $hCalc);

		imagecopyresampled($newImage, $srcImage, 0, 0, 0, 0, $wCalc, $hCalc, $imageW, $imageH);

		if ($crop)
		{
			$res = imagecreatetruecolor ($thumbW, $thumbH);

			imagecopy($res, $newImage, 0, 0, 0, 0, $thumbW, $thumbH);

			imagejpeg($res, $newPath, $quality);
		}
		else
		{
			imagejpeg($newImage, $newPath, $quality);
		}

	}

}

?>