<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogo_model extends CI_Model {	
	
	function __construct(){
		parent::__construct();
	}

	function getCatalogoProdutos($categoria = false, $search = false, $page = 0){
		
		$produtos = $this->db->select('produtos.idProduto, produtos.nome, produtos.preco, produtos.arquivo, categorias.nome as categoria, categorias.label')
			->from('produtos')
			->join('categorias', 'categorias.idCategoria = produtos.categoria', 'inner')
			->where('produtos.status', 1)
			->order_by('categorias.nome', 'asc')
			->order_by('produtos.nome', 'asc')
			->limit(Catalogo::PAGE_LIMIT, $page);
		
		if(!empty($categoria))
			$produtos->where('categorias.idCategoria', $categoria);
		
		if(!empty($search))
			$produtos->like('produtos.nome', $search);
		
		return $produtos->get()->result();
	}
	
	function getCatalogoProdutosSize($categoria = false, $search = false){
		$produtos = $this->db->select('produtos.idProduto')
			->from('produtos')
			->join('categorias', 'categorias.idCategoria = produtos.categoria', 'inner')
			->where('produtos.status', 1);
		
		if(!empty($categoria))
			$produtos->where('categorias.idCategoria', $categoria);
		
		if(!empty($search))
			$produtos->like('produtos.nome', $search);
		
		return $produtos->get()->num_rows();
		
	}
	
	function getCategorias(){
		return $this->db->distinct()->select('categorias.idCategoria, categorias.nome')
			->from('produtos')
			->join('categorias', 'categorias.idCategoria = produtos.categoria', 'inner')
			->where('status', 1)
			->order_by('categorias.nome', 'asc')
			->get()->result();
	}

}