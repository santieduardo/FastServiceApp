<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contas extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->user->check();
		$this->load->model('contas_model', 'contas');
		$this->load->model('clientes_model', 'clientes');
	}

	public function index(){
	
		$term = $this->input->get('term');
		$page = $this->input->get('per_page');
		if(!is_numeric($page)) $page = 0;
	
		$size = $this->contas->getContasSize($term);
		$contas = $this->contas->getContas($page, $term);
		$pagination = pagination(array(
			'base_url' => site_url('contas?term=' .$term),
			'total_rows' => $size,
			'per_page' => PAGE_LIMIT
		));
	
		$this->load->view('tpl/header');
		$this->load->view('contas/lista', array(
			'contas' => $contas,
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
		$this->load->view('contas/novo', array(
			'clientes' => $this->clientes->getClientesLista()
		));
		$this->load->view('tpl/footer');
	}
	
	private function novoPost(){
		$data = array(
			'id_cliente' => $this->input->post('id_cliente'),
			'favorecido' => $this->input->post('favorecido'),
			'banco' => $this->input->post('banco'),
			'agencia' => $this->input->post('agencia'),
			'cc' => $this->input->post('cc'),
			'cnpj' => $this->input->post('cnpj')
		);
		
		$contaId = $this->contas->insertConta($data);
		success('Dado bancário cadastrado com sucesso.');
		redirect("contas#id=" . $contaId);
	}
	
	public function editar($contaId){
		$conta = $this->contas->getContaById($contaId);
		if($conta){
		
			if($this->input->post()){
				try {	
					$this->editarPost($conta);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
		
			$this->load->view('tpl/header');
			$this->load->view('contas/editar', array(
				'clientes' => $this->clientes->getClientesLista(),
				'conta' => $conta
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function editarPost($conta){
		$data = array(
			'id_cliente' => $this->input->post('id_cliente'),
			'favorecido' => $this->input->post('favorecido'),
			'banco' => $this->input->post('banco'),
			'agencia' => $this->input->post('agencia'),
			'cc' => $this->input->post('cc'),
			'cnpj' => $this->input->post('cnpj')
		);
	
		$this->contas->updateConta($conta->id_conta, $data);
		success('Dados bancário atualizado com sucesso.');
		redirect("contas");
	}
	
	public function remover($contaId){
		$conta = $this->contas->getContaById($contaId);
		if($conta){
	
			if($this->input->post()){
				try {
					$this->removerPost($conta);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
	
			$this->load->view('tpl/header');
			$this->load->view('contas/remover', array(
					'conta' => $conta
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function removerPost($conta){
		$this->contas->deleteConta($conta->id_conta);
		success('Dados bancário removida com sucesso.');
		redirect("contas");
	}
}