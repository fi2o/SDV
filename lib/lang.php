<?php
class Lang
{
	
	private static $vars = array();
	
	
	private static $filesLoaded = FALSE;
	

	private function LoadLangFiles()
	{
		/*
		 * Cargo los archivos.
		 */
		
		require APP_DIR .'/includes/lang/'. APP_LANG .'/header.php';

		
		$langFile = APP_DIR .'/includes/lang/'. APP_LANG .'/'. basename($_SERVER['PHP_SELF']);
		
		if (is_file($langFile))
		{
			require $langFile;
		}
		
		
		require APP_DIR .'/includes/lang/'. APP_LANG .'/footer.php';
		
		
		/*
		 * Seteo algunas variables.
		 */
		
		self::$vars = $lang;
		
		
		self::$filesLoaded = TRUE;
	}
	
	
	public function GetVar($var)
	{
		if ( self::$filesLoaded === FALSE)
		{
			self::LoadLangFiles();
		}
		
		
		if (! array_key_exists($var, self::$vars)) return $var;
		
		return self::$vars[$var];
	}
	
}



/**
 * Funcion para el lenguage.
 *
 * @param string $var
 * @param bool $htmlentities
 * @return string
 */
function lang($var, $htmlentities = TRUE)
{
	$str = Lang::GetVar($var);
	
	if ($htmlentities) $str = htmlentities($str);
	
	return $str;
}


?>