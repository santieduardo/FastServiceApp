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
			"erro" => $erro,
			"sucesso" => $this->session->flashdata('registroSucesso')
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
	
		$erro = false;
		
		if($this->input->post()){
			try {
				$this->doCadastrar();
			}catch (Exception $e){
				$erro = $e->getMessage();
			}
		}		
		
		$this->load->view('tpl/header');
	
		$this->load->view('conta/registrar',array(
			'erro' => $erro
		));
	
		$this->load->view('tpl/footer');

	}			
			
	private function doCadastrar(){
		
		$this->load->model('conta_model', 'model');
		
		$nome = $this->input->post('nome');
		$sobrenome = $this->input->post('sobrenome');
		$email = $this->input->post('email');
		$senha = $this->input->post('senha');
		$confirmaSenha = $this->input->post('confirma-senha');
		
		$this->load->helper('email');
		
		if($this->model->checkEmail($email)){
			throw new Exception("E-mail já cadastrado");
		}
		
		if(!valid_email($email)){
			throw new Exception("E-mail Inválido");
		}
		
		if(!preg_match(PASSWORD_FORMAT, $senha)){
			throw new Exception("Senha com formato inválido");
		}
		
		if($senha !== $confirmaSenha){
			throw new Exception("As senhas são diferentes");
		}

		$user = array(
				'nome' => $nome ,
				'sobrenome' => $sobrenome ,
				'email' => $email ,
				'senha' => sha1($senha) ,
				'ctime' => time()
		);
		
		$this->model->insertUser($user);
	
		$this->session->set_flashdata('registroSucesso','Cadastro realizado com sucesso.');
		
		redirect("conta/login");
		
    }
    

	}