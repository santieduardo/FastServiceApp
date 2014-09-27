<?php
function reais($number){
	return number_format($number, 2, ',', '.');
}

function pagination($options = array()){
	$ci =& get_instance();
	$ci->pagination->initialize(array_merge(array(
			'page_query_string' => true,
			'uri_segment' => 3,
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_link' => false,
			'first_tag_open' => false,
			'first_tag_close' => false,
			'last_link' => false,
			'last_tag_open' => false,
			'last_tag_close' => false,
			'next_link' => '»',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_link' => '«',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>'
	),$options));
	return $ci->pagination->create_links();
}

function nav($target = ''){
	$ci =& get_instance();

	$url = $ci->uri->segment(1);

	if(empty($url))
		$url = '';

	return $url == $target ? 'active' : '';
}

function getKeyFromArray(&$vetor, $key, $value){
	foreach($vetor as $index => $rows){
		if($rows->$key == $value){
			return $index;
		}
	}
	
	return -1;
}

function resetKeys(&$vetor){
	$new = array();
	foreach($vetor as $value)
		array_push($new, $value);
	
	$vetor = $new;
}

?>