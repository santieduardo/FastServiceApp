<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conta extends CI_Controller {

	public function index(){
		
		
		$this->load->view('tpl/header');
		
		$this->load->view('home');

		$this->load->view('tpl/footer');
		
	}
	public function login(){
	
		$erro = false;
		
		if($this->input->post()){	 
			try{
				$this->dologin();
			}catch (Exception $e){
				$erro = $e->getMessage();
			}
		}
		
		$this->load->view('tpl/header');
	
		$this->load->view('conta/login', array(
			"erro" => $erro
		));
	
		$this->load->view('tpl/footer');
	
	}
	
	private function doLogin(){
		$this->load->model('conta_model', 'model');
		

		$email = $this->input->post('email');
		$senha = $this->input->post('senha');
				
		$this->load->helper('email');
				
		if(!valid_email($email))
			throw new Exception("E-mail inválido");
		
		if(!preg_match(PASSWORD_FORMAT, $senha))
			throw new Exception("Senha com formato inválido");
		
		$usuario = $this->model->getUsuarioByLogin($email, $senha);
		if(!$usuario)
			throw new Exception("Usuário não encontrado");
				
		$this->session->set_userdata('usuario', $usuario);
		
		redirect("");

	}
	
	public function registrar(){
	
		$this->load->view('tpl/header');
	
		$this->load->view('conta/registrar');
	
		$this->load->view('tpl/footer');
	
	}
	
}
