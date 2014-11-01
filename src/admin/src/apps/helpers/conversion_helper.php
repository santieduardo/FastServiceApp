<?php
function reais($double){
	return number_format($double, 2, ',', '.');
}

function double($reais){
	return str_replace(
		array(',', '.'),
		array('.', ''),		
		trim($reais)
	);
}

function sql_to_site($str){
	return implode('/', array_reverse(explode('-', $str)));
}

function site_to_sql($str){
	return implode('-', array_reverse(explode('/', $str)));
}