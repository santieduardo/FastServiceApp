<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->user->check();
		$this->load->model('usuarios_model', 'usuarios');
	}

	public function index(){
	
		$term = $this->input->get('term');
		$page = $this->input->get('per_page');
		if(!is_numeric($page)) $page = 0;
	
		$size = $this->usuarios->getUsuariosSize($term);
		$usuarios = $this->usuarios->getUsuarios($page, $term);
		$pagination = pagination(array(
			'base_url' => site_url('usuarios?term=' .$term),
			'total_rows' => $size,
			'per_page' => PAGE_LIMIT
		));
	
		$this->load->view('tpl/header');
		$this->load->view('usuarios/lista', array(
			'usuarios' => $usuarios,
			'size' => $size,
			'pagination' => $pagination
		));
		$this->load->view('tpl/footer');
	}
	
	public function novo(){

		if($this->input->post()){
			try {		
				$this->novoPost();
			} catch (Exception $ex){
				fail($ex->getMessage(), true);
			}
		}
		
		$this->load->view('tpl/header');
		$this->load->view('usuarios/novo');
		$this->load->view('tpl/footer');
	}
	
	private function novoPost(){
		$data = array(
			'login' => strtolower($this->input->post('login')),
			'senha' => $this->input->post('senha')
		);
		
		if($this->input->post('repita') !== $data['senha'])
			throw new Exception("As senhas não são iguais");
		
		if(!preg_match(PASSWORD_FORMAT, $data['senha']))
			throw new Exception("Formato inváido da senha");

		if(!preg_match(USERNAME_FORMAT, $data['login']))
			throw new Exception("Formato inváido do usuário");
		
		if($this->usuarios->getUsuarioByLogin($data['login']))
			throw new Exception("Login já em uso");
		
		$data['senha'] = sha1($data['senha']);
		
		$usuarioId = $this->usuarios->insertUsuario($data);
		success('Usuário cadastrado com sucesso.');
		redirect("usuarios#id=" . $usuarioId);
	}
	
	public function password($usuarioId){
		$usuario = $this->usuarios->getUsuarioById($usuarioId);
		if($usuario){
		
			if($this->input->post()){
				try {	
					$this->editarPost($usuario);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
		
			$this->load->view('tpl/header');
			$this->load->view('usuarios/password', array(
				'usuario' => $usuario
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function passwordPost($usuario){
		$data = array(
			'senha' => $this->input->post('senha')
		);
		
		if(!preg_match(PASSWORD_FORMAT, $data['senha']))
			throw new Exception("Formato inváido da senha");
		
		if(!preg_match(USERNAME_FORMAT, $data['login']))
			throw new Exception("Formato inváido do usuário");
		
		$data['senha'] = sha1($data['senha']);
		$this->usuarios->updateUsuario($usuario->id_usuario, $data);
		success('Senha trocada com sucesso.');
		redirect("usuarios");
	}
	
	public function remover($usuarioId){
		$usuario = $this->usuarios->getUsuarioById($usuarioId);
		if($usuario){
	
			if($this->input->post()){
				try {
					$this->removerPost($usuario);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
	
			$this->load->view('tpl/header');
			$this->load->view('usuarios/remover', array(
					'usuario' => $usuario
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function removerPost($usuario){
		$this->usuarios->deleteUsuario($usuario->id_usuario);
		success('Usuário removida com sucesso.');
		redirect("usuarios");
	}
}