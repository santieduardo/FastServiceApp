<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	private function usuariosTerm(&$query, $term){
		if(is_numeric($term)){
			$query->like('id', $term);
		}
		
		$query->or_like(array(
			'login' => $term
		));
	}
	
	function getUsuariosSize($term){
		$query = $this->db->select('id')
			->from('usuarios');
			
		$this->usuariosTerm($query, $term);
		return $query->get()->num_rows();
	}
	
	function getUsuarios($page, $term){
		$query = $this->db->select('id, login')
			->from('usuarios')
			->order_by('login', 'asc')
			->limit(PAGE_LIMIT, $page);
		
		
		$this->usuariosTerm($query, $term);
		return $query->get()->result();
	}
	
	function insertUsuario($data){
		$this->db->insert('usuarios', $data);
		return $this->db->insert_id();
	}
	
	function updateUsuario($usuarioId, $data){
		$this->db->where('id', $usuarioId)->update('usuarios', $data);
	}
	
	function deleteUsuario($usuarioId){
		$this->db->where('id', $usuarioId)->delete('usuarios');
	}
	
	function getUsuarioById($usuarioId){
		return $this->db->select('id, login')
			->from('usuarios')
			->where('id', $usuarioId)
			->get()->row();
	}
	
	function getUsuarioByLogin($login){
		return $this->db->select('id, login')
			->from('usuarios')
			->where('login', $login)
			->get()->row();
	}
	
	function getUsuariosLista(){
		return $this->db->select('id, login')
		->from('usuarios')
		->order_by('nome', 'asc')
		->get()->result();
	}
}