<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	
	function getUserByLogin($usuario, $senha){
		return $this->db->select('id, nome')
			->from('admins')
			->where(array(
				'usuario' => $usuario,
				'senha' => $senha
			))
			->get()->row();
	}
	
	function getFlags($idUsuario){
		return $this->db->select('flags.flag')
			->from('admin_flags AS flags')
			->join('admin_permissoes AS permissoes', 'flags.id = permissoes.flag', 'inner')
			->join('admins', 'permissoes.admin = admins.id', 'inner')
			->where('admins.id', $idUsuario)
			->get()->result();
	}
	
}