<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->user->check();
		$this->load->model('clientes_model', 'clientes');
	}

	public function index(){
	
		$term = $this->input->get('term');
		$page = $this->input->get('per_page');
		if(!is_numeric($page)) $page = 0;
	
		$size = $this->clientes->getClientesSize($term);
		$clientes = $this->clientes->getClientes($page, $term);
		$pagination = pagination(array(
			'base_url' => site_url('clientes?term=' .$term),
			'total_rows' => $size,
			'per_page' => PAGE_LIMIT
		));
	
		$this->load->view('tpl/header');
		$this->load->view('clientes/lista', array(
			'clientes' => $clientes,
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
		$this->load->view('clientes/novo');
		$this->load->view('tpl/footer');
	}
	
	private function novoPost(){
		$data = array(
			'nome' => $this->input->post('nome'),
			'razao' => $this->input->post('razao'),
			'cnpj' => $this->input->post('cnpj'),
			'ie' => $this->input->post('ie'),
			'endereco' => $this->input->post('endereco'),
			'bairro' => $this->input->post('bairro'),
			'cep' => $this->input->post('cep'),
			'cidade' => $this->input->post('cidade'),
			'uf' => $this->input->post('uf'),
			'tel' => $this->input->post('tel'),
			'limite' => $this->input->post('limite'),
			'limite_rest' => $this->input->post('limite'),
			'end_cob' => $this->input->post('end_cob'),
			'sif' => $this->input->post('sif')
		);
		
		$cliente = $this->clientes->getClienteByCNPJ($data['cnpj']);
		if($cliente){
			throw new Exception('CNPJ já cadastrado. Link <a href="'.site_url('clientes/editar/' . $cliente->id_cliente).'">'.$cliente->nome.'</a>');
		} else {
		
			$clienteId = $this->clientes->insertCliente($data);
			success('Cliente cadastrado com sucesso.');
			redirect("clientes#id=" . $clienteId);
		}
	}
	
	public function editar($clienteId){
		$cliente = $this->clientes->getClienteById($clienteId);
		if($cliente){
		
			if($this->input->post()){
				try {	
					$this->editarPost($cliente);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
		
			$this->load->view('tpl/header');
			$this->load->view('clientes/editar', array(
				'cliente' => $cliente
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function editarPost($cliente){
		$data = array(
			'nome' => $this->input->post('nome'),
			'razao' => $this->input->post('razao'),
			'cnpj' => $this->input->post('cnpj'),
			'ie' => $this->input->post('ie'),
			'endereco' => $this->input->post('endereco'),
			'bairro' => $this->input->post('bairro'),
			'cep' => $this->input->post('cep'),
			'cidade' => $this->input->post('cidade'),
			'uf' => $this->input->post('uf'),
			'tel' => $this->input->post('tel'),
			'limite' => $this->input->post('limite'),
			'end_cob' => $this->input->post('end_cob'),
			'sif' => $this->input->post('sif')
		);
	
		$tempCliente = $this->clientes->getClienteByCNPJ($data['cnpj']);
		if($tempCliente && $tempCliente->id_cliente != $cliente->id_cliente){
			throw new Exception('CNPJ já cadastrado. Link <a href="'.site_url('clientes/editar/' . $tempCliente->id_cliente).'">'.$tempCliente->nome.'</a>');
		} else {
			$this->clientes->updateCliente($cliente->id_cliente, $data);
			success('Cliente atualizado com sucesso.');
			redirect("clientes");
		}
	}
	
	
}