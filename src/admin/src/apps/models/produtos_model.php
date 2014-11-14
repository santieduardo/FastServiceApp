<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	private function produtosTerm(&$query, $term){
		if(is_numeric($term)){
			$query->like('produtos.idProduto', $term);
		}
		$query->or_like(array(
			'categorias.nome' => $term,
			'produtos.nome' => $term
		));
	}
	
	function getProdutosSize($term){
		$query = $this->db->select('idProduto')
			->from('produtos')
			->join('categorias', 'produtos.categoria = categorias.idCategoria', 'inner');
			
		$this->produtosTerm($query, $term);
		return $query->get()->num_rows();
	}
	
	function getProdutos($page, $term){
		$query = $this->db->select('produtos.idProduto, produtos.nome, produtos.preco, categorias.nome as categoria')
			->from('produtos')
			->join('categorias', 'produtos.categoria = categorias.idCategoria', 'inner')
			->order_by('produtos.nome', 'asc')
			->limit(PAGE_LIMIT, $page);
		
		
		$this->produtosTerm($query, $term);
		return $query->get()->result();
	}
	
	function insertProduto($data){
		$this->db->insert('produto', $data);
		return $this->db->insert_id();
	}
	
	function updateProduto($produtoId, $data){
		$this->db->where('id_produto', $produtoId)->update('produto', $data);
	}
	
	function deleteProduto($produtoId){
		$this->db->where('id_produto', $produtoId)->delete('produto');
	}
	
	function getProdutoById($produtoId){
		return $this->db->select('idProduto, nome, preco')
			->from('produtos')
			->where('idProduto', $produtoId)
			->get()->row();
	}
	
	function getProdutosLista(){
		return $this->db->select('idProduto, nome, preco')
			->from('produtos')
			->order_by('nome', 'asc')
			->get()->result();
	}
}