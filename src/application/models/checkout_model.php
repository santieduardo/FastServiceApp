<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout_model extends CI_Model {	
	
	function __construct(){
		parent::__construct();
	}
	
	function getProdutoById($produtoId){
		return $this->db->select('idProduto, nome, preco, arquivo')
			->from('produtos')
			->where(array(
					'status' => 1,
					'idProduto' => $produtoId
			))
			->get()->row();
	}
	
	/*select produtos.nome, produtos.preco, pedidos_produtos.quantidade
	 * from produtos, pedidos_produtos, pedidos
	* where produtos.idproduto = pedidos_produtos.produto
	* and pedidos_produtos.pedido = pedidos.idPedidos
	* and pedidos.idpedidos = 6
	*
	*/
	function getItensPedido($idPedido) {
		return $this->db->select('produtos.nome, produtos.preco, pedidos_produtos.quantidade')
		->from('pedidos')
		->join('pedidos_produtos', 'pedidos_produtos.pedido = pedidos.idpedidos', 'inner')
		->join('produtos', 'pedidos_produtos.produto = produtos.idproduto', 'inner')
		->where('pedidos.idpedidos', $idPedido)
		->order_by('produtos.nome', 'asc')
		->get()->result();
	}
	
	function getPedidoById($pedidoId){
		return $this->db->select('idPedidos, usuario, total, ctime, status')
		->from('pedidos')
		->where('idPedidos', $pedidoId)
		->get()->row();
	}
	
	function insertPedido($produtos){
		$this->db->trans_start();
		
		$this->db->insert('pedidos', array(
			'usuario' => getUserId(),
			'status' => 2
		));
		$pedidoId = $this->db->insert_id();
		
		$total = 0;
		$inserts = array();
		foreach($produtos as $row){
			array_push($inserts, array(
				'produto' => $row->idProduto,
				'pedido' => $pedidoId,
				'quantidade' => $row->quantidade
			));
			$total += $row->quantidade * $row->preco;
		}
		
		$this->db->insert_batch('pedidos_produtos', $inserts);
		
		$this->db->where('idPedidos', $pedidoId)->update('pedidos', array(
			'total' => $total
		));
			
		$this->db->trans_complete();
		
		if($this->db->trans_status() === false)
			return false;
		
		return $pedidoId;
	}	
}