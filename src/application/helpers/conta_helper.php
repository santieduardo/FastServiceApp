<?php

function getUser(){
	$CI =& get_instance();
	return $CI->session->userdata('usuario');
}

function avatar_url($email = 'self', $size = 32){
	
	if($email == 'self'){
		
		$CI =& get_instance();
		$conexaoId = $CI->db->select('conexoes.id')
			->from('conexoes')
			->join('usuarios', 'conexoes.usuario = usuarios.idUsuario', 'inner')
			->get()->row();
		
		if($conexaoId)
			return "http://graph.facebook.com/{$conexaoId->id}/picture";
		
		$email = getUserEmail();
	}
		
	if(empty($email))
		return base_url('assets/img/default-profile.jpg');

	return "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "&s=" . $size;
}

function isLogged(){
	return getUser() ? true : false;
}

function getUserEmail(){
	$user = getUser();
	if($user)
		return $user->email;

	return false;
}

function getUserNome(){
	$user = getUser();
	if($user)
		return $user->nome;

	return false;
}

function getUserId(){
	$user = getUser();
	if($user)
		return $user->idUsuario;

	return false;
}

?>