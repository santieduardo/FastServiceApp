<?php
function debug($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function success($msg, $displayNow = false){
	alert($msg, 1, $displayNow);
}

function fail($msg, $displayNow = false){
	alert($msg, 2, $displayNow);
}

function alert($msg, $status = 0, $displayNow = false){
	$ci =& get_instance();
	
	switch($status){
		case 1 : $classe = 'success'; break;
		case 2 : $classe = 'danger'; break;
		default : $classe = 'warning'; break;
	}
	$data =  array( 'text' => $msg, 'classe' => $classe);
	
	if($displayNow){
		$_SESSION['alertMsg'] = $data;
	} else  {
		$ci->session->set_flashdata('alertMsg', $data);
	}
	
}

function displayAlert(){
	$ci =& get_instance();
	
	$alerts = array();
	
	if(isset($_SESSION['alertMsg'])){
		array_push($alerts, $_SESSION['alertMsg']);
		unset($_SESSION['alertMsg']);
	}
	
	$temp = $ci->session->flashdata('alertMsg');
	if($temp)
		array_push($alerts, $temp);
	
	foreach($alerts as $alert){
		echo '
			<div class="alert alert-' . $alert['classe'] . ' alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
				</button>
				' . $alert['text'] . '
			</div>
		';
	}
}

function post($key, $default = false){
	if(isset($_POST[$key]))
		return $_POST[$key];
	
	if($default)
		return $default;
	
	return "";
}

function get($key, $default = false){
	if(isset($_GET[$key]))
		return $_GET[$key];

	if($default)
		return $default;

	return "";
}

function pagination($options = array()){
	$ci =& get_instance();
	$ci->pagination->initialize(array_merge(array(
		'page_query_string' => true,
		'uri_segment' => 3,
		'full_tag_open' => '<ul class="pagination">',
		'full_tag_close' => '</ul>',
		'first_link' => '<span class="glyphicon glyphicon-chevron-left"></span>',
		'first_tag_open' => '<li>',
		'first_tag_close' => '</li>',
		'last_link' => '<span class="glyphicon glyphicon-chevron-right"></span>',
		'last_tag_open' => '<li>',
		'last_tag_close' => '</li>',
		'next_link' => false,
		'next_tag_open' => '<li>',
		'next_tag_close' => '</li>',
		'prev_link' => false,
		'prev_tag_open' => '<li>',
		'prev_tag_close' => '</li>',
		'cur_tag_open' => '<li class="active"><a>',
		'cur_tag_close' => '</a></li>',
		'num_tag_open' => '<li>',
		'num_tag_close' => '</li>'
	),$options));
	return $ci->pagination->create_links();
}