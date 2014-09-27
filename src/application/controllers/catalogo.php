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
			'pagination' => $pagination
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
}
