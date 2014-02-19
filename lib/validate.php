<?php
class validate {
	
	/**
	 * Verifica si el email pasado es correcto.
	 *
	 * @param	string $email
	 * @return	bool
	 */
	public function email($email) {
		if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@([a-z0-9-]+(\.[a-z0-9-]+)+)$/",$email)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/**
	 * Verifica si el string introducido tiene formato
	 * de dinero ej.: 8,500.00
	 *
	 * @param	string $money
	 * @return	bool
	 */
	public function money($money) {
		if (preg_match('/^([0-9,]+)(\.?)([0-9]*)$/',$money)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/**
	 * Verifica si el string introducido es un telefono.
	 *
	 * @param	string $money
	 * @return	bool
	 */
	public function phone($phone) {
		if (preg_match('/^([0-9-\.\s\(\)]+)$/',$phone)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/**
	 * Logitud minina
	 *
	 * @param	string
	 * @return	bool
	 */	
	public function min_length($str, $length)	{
		if (!ctype_digit($val)) {
			return FALSE;
		}
	
		return (strlen($str) < $length) ? FALSE : TRUE;
	}

	/**
	 * Logitud maxima
	 *
	 * @param	string
	 * @return	bool
	 */	
	public function max_length($str, $length)	{
		if (!ctype_digit($val)) {
			return FALSE;
		}
	
		return (strlen($str) > $length) ? FALSE : TRUE;
	}
	
	/**
	 * Logitud maxima
	 *
	 * @param	string
	 * @return	bool
	 */	
	public function exact_length($str, $length)	{
		if (!ctype_digit($val)) {
			return FALSE;
		}
	
		return (strlen($str) != $length) ? FALSE : TRUE;
	}
	
	/**
	 * Alpha
	 *
	 * @param	string
	 * @return	bool
	 */		
	public function alpha($str) {
		return (!preg_match("/^([a-zA-Z]+)$/", $str)) ? FALSE : TRUE;
	}
	
	/**
	 * Alpha Numeric
	 *
	 * @param	string
	 * @return	bool
	 */		
	public function alpha_numeric($str) {
		return (!preg_match("/^([a-zA-Z0-9]+)$/", $str)) ? FALSE : TRUE;
	}
	
	/**
	 * Numeric
	 *
	 * @param	integer
	 * @return	bool
	 */		
	public function integer($str) {
		return (bool) preg_match('/^([0-9]+)$/', $str);
	}
}

?>