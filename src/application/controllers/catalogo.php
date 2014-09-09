<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogo extends CI_Controller {

	public function index(){
		
		$this->load->model('catalogo_model', 'model');
		
		$catId = $this->input->get('c');
		$search = $this->input->get('q');
		
		$produtos = $this->model->getCatalogoProdutos($catId, $search);
		
		
		
		
		$this->load->view('tpl/header', array(
			'title' => 'Catálogo'
		));
		
		$this->load->view('catalago', array(
			'produtos' => $produtos,
			'categorias' => $this->getCategoriasHTML($catId, $search),
			'catId' => $catId,
			'search' => $search
		));

		$this->load->view('tpl/footer');
		
	}
	
	private function getCategoriasHTML($catId, $search){
		$categorais = $this->model->getCategorias();
		$html = array();
		
		$params = array();
		$url = site_url('catalogo?');
		if(!empty($search))
			$params['q'] = $search;
		
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
