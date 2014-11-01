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
    
    function insertUser($user){
    	
    	$this->db->insert('usuarios',$user);
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
    
    
}
