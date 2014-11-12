<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	private function produtosTerm(&$query, $term){
		if(is_numeric($term)){
			$query->like('id_produto', $term);
		}
		$query->or_like(array(
			'nome' => $term
		));
	}
	
	function getProdutosSize($term){
		$query = $this->db->select('id_produto')
			->from('produto');
			
		$this->produtosTerm($query, $term);
		return $query->get()->num_rows();
	}
	
	function getProdutos($page, $term){
		$query = $this->db->select('id_produto, nome')
			->from('produto')
			->order_by('nome', 'asc')
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
		return $this->db->select('id_produto, nome')
			->from('produto')
			->where('id_produto', $produtoId)
			->get()->row();
	}
	
	function getProdutosLista(){
		return $this->db->select('id_produto, nome')
			->from('produto')
			->order_by('nome', 'asc')
			->get()->result();
	}
}