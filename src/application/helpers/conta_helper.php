<?php
function avatar_url($email = 'self', $size = 32){
	
	if($email == 'self')
		$email = getUserEmail();
	
	if(empty($email))
		return base_url('assets/img/default-profile.jpg');

	return "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "&s=" . $size;
}

function isLogged(){
	if(isset($_SESSION['usuario'])){
		return true;
	}

	return false;
}

function getUserEmail(){
	if(isset($_SESSION['usuario'])){
		return $_SESSION['usuario']['email'];
	}
	
	return false;
}

function getUserNome(){
	if(isset($_SESSION['usuario'])){
		return $_SESSION['usuario']['nome'];
	}
	
	return false;
}

function getUserId(){
	if(isset($_SESSION['usuario'])){
		return $_SESSION['usuario']['id'];
	}
	
	return false;
}

?>