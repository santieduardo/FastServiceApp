<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	private function pedidosTerm(&$query, $term){
		if(is_numeric($term)){
			$query->like('pedidos.idPedido', $term);
		}
		
		$query->or_like(array(
			'usuarios.nome' => $term
		));
	}
		
	private function pedidosOrdem(&$query, $ordem){
		switch($ordem){
			case 1 : $query->order_by('cliente', 'asc'); break;
			case 2 : $query->order_by('cliente', 'desc'); break;

			default: $query->order_by('pedidos.idPedido', 'desc');
		}
	}
	
	function getPedidosSize($term){
		$query = $this->db->select('pedidos.idPedido')
			->from('pedidos')
			->join('usuarios', 'pedidos.usuario = usuarios.idUsuario', 'inner')
			->group_by('pedidos.idPedido');
			
		$this->pedidosTerm($query, $term);
		return $query->get()->num_rows();
	}
	
	function getPedidos($page, $term, $ordem){
		$query = $this->db->select('pedidos.idPedido, usuarios.nome as cliente, pedidos.total, pedidos.ctime, sum(pedidos_produtos.quantidade) as quantidade')
			->from('pedidos')
			->join('usuarios', 'pedidos.usuario = usuarios.idUsuario', 'inner')
			->join('pedidos_produtos', 'pedidos.idPedido = pedidos_produtos.pedido', 'left outer')
			->group_by('pedidos.idPedido')
			->limit(PAGE_LIMIT, $page);
		
		$this->pedidosOrdem($query, $ordem);
		$this->pedidosTerm($query, $term);
		return $query->get()->result();
	}
	
	function insertPedido($data){
		$this->db->insert('pedido', $data);
		return $this->db->insert_id();
	}
	
	function updatePedido($pedidoId, $data){
		$this->db->where('id_cliente', $pedidoId)->update('pedido', $data);
	}
	
	function getPedidoByCNPJ($cnpj){
		return $this->db->select('id_cliente, nome')
			->from('pedido')
			->where('cnpj', $cnpj)
			->get()->row();
	}
	
	function getPedidoById($pedidoId){
		return $this->db->select('id_cliente, nome, razao, cnpj, ie, endereco, bairro, cep, cidade, uf, tel, limite, limite_rest, end_cob, sif')
			->from('pedido')
			->where('id_cliente', $pedidoId)
			->get()->row();
	}
	
	function getListaProdutos(){
		$pedidos = $this->db->select('idProduto, nome, preco')
			->from('produtos')
			->order_by('nome', 'asc');
		
		return $pedidos->get()->result();
	}
}