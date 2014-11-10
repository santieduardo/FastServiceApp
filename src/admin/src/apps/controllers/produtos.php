<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->user->check();
		$this->load->model('produtos_model', 'produtos');
	}

	public function index(){
	
		$term = $this->input->get('term');
		$page = $this->input->get('per_page');
		if(!is_numeric($page)) $page = 0;
	
		$size = $this->produtos->getProdutosSize($term);
		$produtos = $this->produtos->getProdutos($page, $term);
		$pagination = pagination(array(
			'base_url' => site_url('produtos?term=' .$term),
			'total_rows' => $size,
			'per_page' => PAGE_LIMIT
		));
	
		$this->load->view('tpl/header');
		$this->load->view('produtos/lista', array(
			'produtos' => $produtos,
			'size' => $size,
			'pagination' => $pagination
		));
		$this->load->view('tpl/footer');
	}	
	
	//rever
	public function showProdutos(){
		if ($this->input->post()){
			try {
				$this->showProdutosPost();
			} catch (Exception $e){
				fail($e->getMessage(), true);
			}
		}		
		
		$this->load->view('tpl/header');
		$this->load->view('pedidos/novo');
		$this->load->view('tpl/footer');
	}
	
	//rever
	private function showProdutosPost(){
		$data = array(
			'nome' => $this->input->post('nome'),
			'preco' => $this->input->post('preco')
		);
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
		$this->load->view('produtos/novo');
		$this->load->view('tpl/footer');
	}
	
	private function novoPost(){
		$data = array(
			'nome' => $this->input->post('nome')
		);
		
		$produtoId = $this->produtos->insertProduto($data);
		success('Produto cadastrado com sucesso.');
		redirect("produtos#id=" . $produtoId);
	}
	
	public function editar($produtoId){
		$produto = $this->produtos->getProdutoById($produtoId);
		if($produto){
		
			if($this->input->post()){
				try {	
					$this->editarPost($produto);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
		
			$this->load->view('tpl/header');
			$this->load->view('produtos/editar', array(
				'produto' => $produto
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function editarPost($produto){
		$data = array(
			'nome' => $this->input->post('nome')
		);
	
		$this->produtos->updateProduto($produto->id_produto, $data);
		success('Produto atualizado com sucesso.');
		redirect("produtos");
	}
	
	public function remover($produtoId){
		$produto = $this->produtos->getProdutoById($produtoId);
		if($produto){
	
			if($this->input->post()){
				try {
					$this->removerPost($produto);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
	
			$this->load->view('tpl/header');
			$this->load->view('produtos/remover', array(
					'produto' => $produto
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function removerPost($produto){
		$this->produtos->deleteProduto($produto->id_produto);
		success('Produto removida com sucesso.');
		redirect("produtos");
	}
}