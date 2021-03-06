<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogo extends CI_Controller {
	
	const PAGE_LIMIT = 12;
	
	public function index(){
		$this->load->model('catalogo_model', 'model');
		
		$catId = $this->input->get('c');
		$term = $this->input->get('q');
		$page = $this->input->get('per_page');
		
		$produtos = $this->model->getCatalogoProdutos($catId, $term, $page);
		$size = $this->model->getCatalogoProdutosSize($catId, $term);
		
		$pagination = pagination(array(
			'base_url' => site_url('catalogo?q=' . $term . '&c=' . $catId),
			'total_rows' => $size,
			'per_page' => self::PAGE_LIMIT
		));
		
		$this->load->view('tpl/header', array(
			'title' => 'Catálogo'
		));

		$this->load->view('catalago', array(
			'produtos' => $produtos,
			'categorias' => $this->getCategoriasHTML($catId, $term),
			'catId' => $catId,
			'search' => $term,
			'produtosSize' => $size,
			'pagination' => $pagination,
			'carrinho' => $this->getCarrinho()
		));

		$this->load->view('tpl/footer');
		
	}
	
	private function getCategoriasHTML($catId, $term){
		$categorais = $this->model->getCategorias();
		$html = array();
		
		$params = array();
		$url = site_url('catalogo?');
		if(!empty($term))
			$params['q'] = $term;
		
		if(empty($catId)){
			array_push($html, 'Todas');
		} else {
			array_push($html, '<a href="' . $url . http_build_query($params) . '">Todas</a>');
		}
		
		foreach($categorais as $rows){
			$params['c'] = $rows->idCategoria;
			
			$url . http_build_query($params);
			
			if($catId == $rows->idCategoria){
				array_push($html, $rows->nome);
			} else {
				array_push($html, '<a href="' . $url . http_build_query($params) . '">' . $rows->nome . '</a>');
			}
		}
		
		return implode(' / ', $html);
	}
	
	private function getCarrinho(){
		$carrinho = $this->session->userdata('carrinho');
		if(!$carrinho){
			$carrinho = (Object) array(
				'produtos' => array(),
				'total' => 0.0
			);
			$this->saveCarrinho($carrinho);
		}
		return $carrinho;
	}
	
	private function saveCarrinho($carrinho){
		$this->session->set_userdata('carrinho', $carrinho);
	}
	
	private function isAjax(){
		if(!$this->input->is_ajax_request()) show_404();
		$this->load->model('catalogo_model', 'model');
	}
	
	/* Ajax */
	public function addProduto(){
		$this->isAjax();
		$carrinho = $this->getCarrinho();
		
		$produtoId = $this->input->get('produtoId');
		if(!is_numeric($produtoId)) show_404();
		
		$response = array();
		$produto = $this->model->getProdutoById($produtoId);
		
		if($produto){
			$key = getKeyFromArray($carrinho->produtos, 'idProduto', $produto->idProduto);
			
			if($key >= 0){
				$carrinho->produtos[$key]->quantidade++;
			} else {
				array_push($carrinho->produtos, (Object) array(
					'idProduto' => $produto->idProduto,
					'nome' => $produto->nome,
					'preco' => $produto->preco,
					'quantidade' => 1	
				));
			}
			
			$carrinho->total += $produto->preco;
			
			$response['status'] = 'OK';
			$response['data'] = $carrinho;
			$this->saveCarrinho($carrinho);
		} else {
			$response['status'] = 'ERROR';
		}
		
		echo json_encode($response);
		
	}
	
	public function removeProduto(){
		$this->isAjax();
		$carrinho = $this->getCarrinho();
	
		$produtoId = $this->input->get('produtoId');
		$deleteAll = $this->input->get('deleteAll');
		if(!is_numeric($produtoId)) show_404();
	
		$response = array();
		$produto = $this->model->getProdutoById($produtoId);
		
		if($produto){
			$key = getKeyFromArray($carrinho->produtos, 'idProduto', $produto->idProduto);
			if($key >= 0){

				$temp = $carrinho->produtos[$key];
				if($temp->quantidade == 1 || $deleteAll == '1'){
						
					$valor = $temp->quantidade * $produto->preco;
						
					unset($carrinho->produtos[$key]);
					resetKeys($carrinho->produtos);
					
					$carrinho->total -= $valor;
				} else {
					$carrinho->produtos[$key]->quantidade--;
					$carrinho->total -= $produto->preco;
				}
					
				$this->saveCarrinho($carrinho);
			}
			
			$response['data'] = $carrinho;
			$response['status'] = 'OK';
		} else {
			$response['status'] = 'ERROR';
		}
	
		echo json_encode($response);
	}
}