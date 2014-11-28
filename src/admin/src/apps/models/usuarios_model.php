<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	

	function getUsuarioById($usuarioId){
		return $this->db->select('idUsuario, nome, sobrenome, email, ctime')
			->from('usuarios')
			->where('idUsuario', $usuarioId)
			->get()->row();
	}
}