<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->user->check();
		$this->load->helper('pedidos');
		$this->load->model('pedidos_model', 'pedidos');
		
	}

	public function index(){
		
		$ordem = $this->input->get('ordem');
		$term = $this->input->get('term');
		$page = $this->input->get('per_page');
		if(!is_numeric($page)) $page = 0;
		if(!is_numeric($ordem)) $ordem = 0;
		
		
		$size = $this->pedidos->getPedidosSize($term);
		$pedidos = $this->pedidos->getPedidos($page, $term, $ordem);
		$pagination = pagination(array(
			'base_url' => site_url('pedidos?term=' .$term.'&ordem='.$ordem),
			'total_rows' => $size,
			'per_page' => PAGE_LIMIT
		));
	
		$this->load->view('tpl/header');
		$this->load->view('pedidos/lista', array(
			'pedidos' => $pedidos,
			'size' => $size,
			'ordem' => $ordem,
			'pagination' => $pagination
		));
		$this->load->view('tpl/footer');
	}
	
	public function novo(){
		die();
		if($this->input->post()){
			try {		
				$this->novoPost();
			} catch (Exception $ex){
				fail($ex->getMessage(), true);
			}
		}
		
		$this->load->view('tpl/header');
		$this->load->view('pedidos/novo');
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
		
		$pedido = $this->pedidos->getPedidoByCNPJ($data['cnpj']);
		if($pedido){
			throw new Exception('CNPJ já cadastrado. Link <a href="'.site_url('pedidos/editar/' . $pedido->id_pedido).'">'.$pedido->nome.'</a>');
		} else {
		
			$pedidoId = $this->pedidos->insertPedido($data);
			success('Pedido cadastrado com sucesso.');
			redirect("pedidos#id=" . $pedidoId);
		}
	}
	
	public function editar($pedidoId){
		die();
		$pedido = $this->pedidos->getPedidoById($pedidoId);
		if($pedido){
		
			if($this->input->post()){
				try {	
					$this->editarPost($pedido);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
		
			$this->load->view('tpl/header');
			$this->load->view('pedidos/editar', array(
				'pedido' => $pedido
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function editarPost($pedido){
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
	
		$tempPedido = $this->pedidos->getPedidoByCNPJ($data['cnpj']);
		if($tempPedido && $tempPedido->id_pedido != $pedido->id_pedido){
			throw new Exception('CNPJ já cadastrado. Link <a href="'.site_url('pedidos/editar/' . $tempPedido->id_pedido).'">'.$tempPedido->nome.'</a>');
		} else {
			$this->pedidos->updatePedido($pedido->id_pedido, $data);
			success('Pedido atualizado com sucesso.');
			redirect("pedidos");
		}
	}
	
	
}