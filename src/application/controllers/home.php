<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		
		$this->load->model('catalogo_model', 'model');
		
		$catId = $this->input->get('c');
		$search = $this->input->get('q');
		
		$produtos = $this->model->getCatalogoProdutos($catId, $search);
		
		
		$this->load->view('tpl/header');
		
		$this->load->view('catalago', array(
			'produtos' => $produtos,
			'categorias' => $this->model->getCategorias(),
			'catId' => $catId,
			'search' => $search
		));

		$this->load->view('tpl/footer');
		
	}
}
