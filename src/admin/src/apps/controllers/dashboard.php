<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function index(){
		$this->user->check();
				
		$this->load->view('tpl/header');
		$this->load->view('dashboard');
		$this->load->view('tpl/footer');
	}
	
	public function notFound(){
		$this->load->view('tpl/error-404');
	}
	
	public function login(){
		$this->user->check404(true);
		$redirect = $this->input->post('redirect');
		
		if($this->input->post()){
			$this->load->model('dashboard_model', 'model');
			$login = $this->input->post('username');
			$senha = sha1($this->input->post('senha'));
			
			$user = $this->model->getUserByLogin($login, $senha);
			
			if($user){			
				$flags = $this->model->getFlags($user->id);
				$this->session->set_userdata('admin',(Object) array(
					'id' => $user->id,
					'nome' => $user->nome,
					'flags' => $flags
				));
				
				if(empty($redirect))
					redirect('');
				
				redirect($redirect);
			} else {
				$this->session->set_flashdata('error_login', 'Login ou senha inválida. Tente novamente!');
				redirect('login?redirect=' . $redirect);
			}
		}
		
		$erro = $this->session->flashdata('error_login');
		$this->load->view('tpl/login', array(
			'erro' => $erro
		));
	}
	
	public function logoff(){
		$this->user->check404();
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('carrinho_admin');
		redirect('login?logoff=1');
	}
}