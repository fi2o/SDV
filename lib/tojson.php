<?php
/**
 * Transforma un array en JSON
 *
 * @param array $array
 * @return string
 */
function toJSON($array) {
	$json_parts = array();
	
	foreach ($array as $var_name => $var_value) {
		$json_parts[] = '"'. $var_name .'":"'. $var_value .'"';
	}
	
	return '{'. implode(',',$json_parts) .'}';
}
?>