<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plantas_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	private function plantasTerm(&$query, $term){
		if(is_numeric($term)){
			$query->like('plantas.id_planta', $term);
		}
		$query->or_like(array(
			'clientes.nome' => $term,
			'clientes.cnpj' => $term,
			'plantas.razao' => $term,
			'plantas.ide' => $term
		));
	}
	
	function getPlantasSize($term){
		$query = $this->db->select('plantas.id_planta')
			->from('plantas')
			->join('clientes', 'plantas.id_cliente = clientes.id_cliente', 'left outer')
			->group_by('plantas.id_planta');
			
			
		$this->plantasTerm($query, $term);
		return $query->get()->num_rows();
	}
	
	function getPlantas($page, $term){
		$query = $this->db->select('plantas.id_planta, plantas.razao, plantas.ide, clientes.nome')
			->from('plantas')
			->join('clientes', 'plantas.id_cliente = clientes.id_cliente', 'left outer')
			->group_by('plantas.id_planta')
			->order_by('plantas.razao', 'asc')
			->limit(PAGE_LIMIT, $page);
		
		
		$this->plantasTerm($query, $term);
		return $query->get()->result();
	}
	
	function insertPlanta($data){
		$this->db->insert('plantas', $data);
		return $this->db->insert_id();
	}
	
	function updatePlanta($plantaId, $data){
		$this->db->where('id_planta', $plantaId)->update('plantas', $data);
	}
	
	function deletePlanta($plantaId){
		$this->db->where('id_planta', $plantaId)->delete('plantas');
	}
	
	function getPlantaById($plantaId){
		return $this->db->select('id_planta, id_cliente, ide, razao, cgc, ie, endereco, bairro, cep, cidade, uf, tel')
			->from('plantas')
			->where('id_planta', $plantaId)
			->get()->row();
	}
	
	function getPlantasLista(){
		return $this->db->select('id_planta, razao')
		->from('plantas')
		->order_by('razao', 'asc')
		->get()->result();
	}
}