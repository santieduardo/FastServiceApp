<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;

class Conta extends CI_Controller {
	
	public function login(){
		if(isLogged()) show_404();
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
		$return = $this->input->post('return');

		$this->load->helper('email');
				
		if(!valid_email($email))
			throw new Exception("E-mail inválido");
		
		if(!preg_match(PASSWORD_FORMAT, $senha))
			throw new Exception("Senha com formato inválido");
		
		$usuario = $this->model->getUsuarioByLogin($email, $senha);
		if(!$usuario)
			throw new Exception("Usuário não encontrado");
				
		$this->session->set_userdata('usuario', $usuario);
		
		redirect($return);

	}
	
	public function registrar(){
		if(isLogged()) show_404();
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
			'nome' => $nome,
			'sobrenome' => $sobrenome,
			'email' => $email,
			'senha' => sha1($senha),
			'ctime' => time()
		);
		
		$this->model->insertUser($user);
	
		$this->session->set_flashdata('registroSucesso','Cadastro realizado com sucesso.');
		
		redirect("conta/login");
		
    }
    
    private function setupFacebookApi(){
    	FacebookSession::setDefaultApplication(
    		$this->config->item('facebook_appid'),
    		$this->config->item('facebook_secret')
		);
    }
    
    
    public function facebook(){
    	$this->setupFacebookApi();
    
    	$callback = site_url('conta/loginFacebook');
    	$helper = new FacebookRedirectLoginHelper($callback);
    	redirect($helper->getLoginUrl(array('scope' => 'email')));
    }
    
    private function loginFacebook(){
    	$this->setupFacebookApi();
    
    	$callback = site_url('conta/loginFacebook');
    	$session = null;
    
    	$helper = new FacebookRedirectLoginHelper($callback);
    	try {
    		$session = $helper->getSessionFromRedirect();
    		if($session){
    			$request = new FacebookRequest($session, 'GET', '/me?fields=email,id,first_name,last_name');
    			$response = $request->execute();
    			$data = $response->getGraphObject(GraphUser::className());
    			
    			$user = array(
    				'nome' => $data->getFirstName(),
    				'sobrenome' => $data->getLastName(),
    				'email' => $data->getProperty("email"),
    				'ctime' => time()
    			);
    			
    			$connection = array(
    				'id' => $data->getId(),
    				'token' => $session->getToken()
    			);
    
    			$this->tryLoginFacebook($user, $connection);
    
    		}
    	} catch(FacebookRequestException $ex) {
    		echo $ex->getMessage();
    	} catch(Exception $ex) {
    		echo $ex->getMessage();
    	}
    }
    
    private function tryLoginFacebook($data, $connection){
    	$this->load->model('conta_model', 'model');
    	
    	$this->model->
    	
    	/*
    	 * 
    	 */
    	
    	
    	
    	
    }
    
    public function logoff(){
    	$this->session->sess_destroy();
    	
    	redirect('');
    }
}