<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	private function pedidosTerm(&$query, $term){
		if(is_numeric($term)){
			$query->like('pedido.id_pedido', $term);
		}
		$query->or_like(array(
			'pedido.nro' => $term,
			'clientes.nome' => $term,
			'fornecedores.nome' => $term
		));
	}
	
	private function pedidosOrdem(&$query, $ordem){
		switch($ordem){
			case 1 : $query->order_by('cliente', 'asc'); break;
			case 2 : $query->order_by('cliente', 'desc'); break;
			
			case 3 : $query->order_by('fornecedor', 'asc'); break;
			case 4 : $query->order_by('fornecedor', 'desc'); break;
			
			case 5 : $query->order_by('embarque_certo', 'asc'); break;
			case 6 : $query->order_by('embarque_certo', 'desc'); break;
			
			case 7 : $query->order_by('pedido.venc1', 'asc'); break;
			case 8 : $query->order_by('pedido.venc1', 'desc'); break;
			
			default: $query->order_by('pedido.id_pedido', 'desc');
		}
	}
	
	function getPedidosSize($term){
		$query = $this->db->select('id_pedido')
			->from('pedido')
			->join('clientes', 'pedido.id_cliente = clientes.id_cliente', 'left outer')
			->join('clientes as fornecedores', 'pedido.id_fornecedor = fornecedores.id_cliente', 'left outer')
			->group_by('pedido.id_pedido');
			
		$this->pedidosTerm($query, $term);
		return $query->get()->num_rows();
	}
	
	function getPedidos($page, $term, $ordem){
		$query = $this->db->select('pedido.id_pedido, pedido.nro, clientes.nome as cliente, fornecedores.nome as fornecedor, pedido.data, pedido.status, pedido.venc1, pedido.venc2, pedido.venc3')
			
			/* coluna embarque esta como texto e por isso tem que ser convertida para poder ordenar corretamente */
			->select("date_format(str_to_date(pedido.embarque, '%d/%m/%Y'), '%Y-%m-%d') as embarque_certo", false)
			
			->from('pedido')
			->join('clientes', 'pedido.id_cliente = clientes.id_cliente', 'left outer')
			->join('clientes as fornecedores', 'pedido.id_fornecedor = fornecedores.id_cliente', 'left outer')
			->group_by('pedido.id_pedido')
			->limit(PAGE_LIMIT, $page);
		
		$this->pedidosOrdem($query, $ordem);
		$this->pedidosTerm($query, $term);
		$result = $query->get()->result();
		
		$pedidos = array();
		
		foreach($result as $row){
			$nota = $this->db->select('id_nota')
				->from('nota')
				->where('id_pedido', $row->id_pedido)
				->get()->row();
			
			$total = $this->db->select('sum(val_u_total) as total')
				->from('prod_pedido')
				->group_by('id_prod_pedido')
				->where('id_pedido', $row->id_pedido)
				->get()->row();

			$vencimento = null;
			if($row->venc1 <> 0) $vencimento = $row->venc1;
			if($row->venc2 <> 0) $vencimento = $row->venc2;
			if($row->venc3 <> 0) $vencimento = $row->venc3;

			array_push($pedidos, (Object) array(
				'id_pedido' => $row->id_pedido,
				'nro' => $row->nro,
				'cliente' => $row->cliente,
				'fornecedor' => $row->fornecedor,
				'data' => $row->data,
				'status' => $row->status,
				'embarque' => ($row->embarque_certo <> 0 ? $row->embarque_certo : null),
				'vencimento' => $vencimento,
				'nota' => ($nota ? $nota->id_nota : null),
				'total' => ($total ? $total->total : 0.0)
			));
		}
		
		return $pedidos;
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
	
	function getPedidosLista(){
		return $this->db->select('id_cliente, nro')
			->from('pedido')
			->order_by('nro', 'asc')
			->get()->result();
	}
}