<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	private function clientesTerm(&$query, $term){
		if(is_numeric($term)){
			$query->like('id_cliente', $term);
		}
		
		$query->or_like(array(
			'nome' => $term,
			'cnpj' => $term,
			'ie' => $term
		));
	}
	
	function getClientesSize($term){
		$query = $this->db->select('id_cliente')
			->from('clientes');
			
		$this->clientesTerm($query, $term);
		return $query->get()->num_rows();
	}
	
	function getClientes($page, $term){
		$query = $this->db->select('id_cliente, nome, cnpj, ie')
			->from('clientes')
			->order_by('nome', 'asc')
			->limit(PAGE_LIMIT, $page);
		
		
		$this->clientesTerm($query, $term);
		return $query->get()->result();
	}
	
	function insertCliente($data){
		$this->db->insert('clientes', $data);
		return $this->db->insert_id();
	}
	
	function updateCliente($clienteId, $data){
		$this->db->where('id_cliente', $clienteId)->update('clientes', $data);
	}
	
	function getClienteByCNPJ($cnpj){
		return $this->db->select('id_cliente, nome')
			->from('clientes')
			->where('cnpj', $cnpj)
			->get()->row();
	}
	
	function getClienteById($clienteId){
		return $this->db->select('id_cliente, nome, razao, cnpj, ie, endereco, bairro, cep, cidade, uf, tel, limite, limite_rest, end_cob, sif')
			->from('clientes')
			->where('id_cliente', $clienteId)
			->get()->row();
	}
	
	function getClientesLista(){
		return $this->db->select('id_cliente, nome')
			->from('clientes')
			->order_by('nome', 'asc')
			->get()->result();
	}
}