<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conta_model extends CI_Model {	
	
	function __construct(){
		parent::__construct();
	}

	function getUsuarioByLogin($email, $senha){
          return $this->db->select("idUsuario, email , nome")	
			->from('usuarios')
            ->where('email', $email)
            ->where('senha', sha1($senha))
		    ->get()->row();
    }
    
    function getUsuarioById($id){
    	return $this->db->select("idUsuario, email , nome")
	    	->from('usuarios')
	    	->where('idUsuario', $id)
	    	->get()->row();
    }
    
    function insertUser($user){
    	$this->db->insert('usuarios', $user);
    	return $this->db->insert_id();
    }
    
    function checkEmail($email){
    
    	$this->db->where('email', $email);
    	$query = $this->db->get('usuarios');
    	if ($query->num_rows() > 0){
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    
    function getUsuarioByConnection($id) {
    	return $this->db->select("usuarios.idUsuario, usuarios.email , usuarios.nome")
	    	->from('usuarios')
	    	->join('conexoes', 'usuarios.idUsuario = conexoes.usuario', 'inner')
	    	->where('conexoes.id', $id)
	    	->get()->row();
    }
    
    function getUsuarioNotConnected($email) {
    	return $this->db->select("usuarios.idUsuario, usuarios.email , usuarios.nome")
	    	->from('usuarios')
	    	->join('conexoes', 'usuarios.idUsuario = conexoes.usuario', 'left outer')
	    	->group_by('usuarios.idUsuario')
	    	->where('usuarios.email', $email)
	    	->where('conexoes.id is null', null, false)
	    	->get()->row();
    }

    function insertConnection($usuarioId, $data) {
    	$data['usuario'] = $usuarioId;
    	$this->db->insert('conexoes', $data);
    }
    
}