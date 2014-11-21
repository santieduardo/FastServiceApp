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
		$query = $this->db->select('pedidos.idPedido, usuarios.nome as cliente, pedidos.total, pedidos.status, pedidos.ctime, sum(pedidos_produtos.quantidade) as quantidade')
			->from('pedidos')
			->join('usuarios', 'pedidos.usuario = usuarios.idUsuario', 'inner')
			->join('pedidos_produtos', 'pedidos.idPedido = pedidos_produtos.pedido', 'left outer')
			->group_by('pedidos.idPedido')
			->limit(PAGE_LIMIT, $page);
		
		$this->pedidosOrdem($query, $ordem);
		$this->pedidosTerm($query, $term);
		return $query->get()->result();
	}
	
	function insertPedido($produtos){
		$this->db->trans_start();
	
		$this->db->insert('pedidos', array(
			'usuario' => 0,
			'status' => 1,
			'ctime' => time()
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
	
		$this->db->where('idPedido', $pedidoId)->update('pedidos', array(
			'total' => $total
		));
			
		$this->db->trans_complete();
	
		if($this->db->trans_status() === false)
			return false;
	
		return $pedidoId;
	}
	
	function getPedidoById($idPedido){
		return $this->db->select('idPedido, usuario, total, ctime, status')
			->from('pedidos')
			->where('idPedido', $idPedido)
			->get()->row();
	}
	
	function updatePedido($idPedido, $data){
		$this->db->where('idPedido', $idPedido)->update('pedidos', $data);
	}
}