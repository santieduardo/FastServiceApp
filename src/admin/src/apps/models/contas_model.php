<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contas_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	private function contasTerm(&$query, $term){
		if(is_numeric($term)){
			$query->like('conta.id_conta', $term);
		} else {
		
			$query->or_like(array(
				'clientes.nome' => $term,
				'clientes.cnpj' => $term,
				'conta.favorecido' => $term
			));
		}
	}
	
	function getContasSize($term){
		$query = $this->db->select('conta.id_conta')
			->join('clientes', 'conta.id_cliente = clientes.id_cliente', 'left outer')
			->group_by('conta.id_conta')
			->from('conta');
			
		$this->contasTerm($query, $term);
		return $query->get()->num_rows();
	}
	
	function getContas($page, $term){
		$query = $this->db->select('conta.id_conta, conta.id_cliente, conta.favorecido, clientes.nome')
			->from('conta')
			->join('clientes', 'conta.id_cliente = clientes.id_cliente', 'left outer')
			->group_by('conta.id_conta')
			->order_by('conta.favorecido', 'asc')
			->limit(PAGE_LIMIT, $page);
		
		
		$this->contasTerm($query, $term);
		return $query->get()->result();
	}
	
	function insertConta($data){
		$this->db->insert('conta', $data);
		return $this->db->insert_id();
	}
	
	function updateConta($contaId, $data){
		$this->db->where('id_conta', $contaId)->update('conta', $data);
	}
	
	function deleteConta($contaId){
		$this->db->where('id_conta', $contaId)->delete('conta');
	}
	
	function getContaById($contaId){
		return $this->db->select('id_conta, id_cliente, favorecido, banco, agencia, cc, cnpj')
			->from('conta')
			->where('id_conta', $contaId)
			->get()->row();
	}
}