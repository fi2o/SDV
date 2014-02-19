<?php
function build_query($var='') {
	parse_str($_SERVER['QUERY_STRING'], $query_string_vars);
	$var = explode('=',$var);
	if (!empty($var)) {
		$query_string_vars[$var[0]] = $var[1];
	}
	$query_string = http_build_query($query_string_vars);
		
	return $query_string;
}
?>