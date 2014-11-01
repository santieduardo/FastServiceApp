<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plantas extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->user->check();
		$this->load->model('plantas_model', 'plantas');
		$this->load->model('clientes_model', 'clientes');
	}

	public function index(){
	
		$term = $this->input->get('term');
		$page = $this->input->get('per_page');
		if(!is_numeric($page)) $page = 0;
	
		$size = $this->plantas->getPlantasSize($term);
		$plantas = $this->plantas->getPlantas($page, $term);
		$pagination = pagination(array(
			'base_url' => site_url('plantas?term=' .$term),
			'total_rows' => $size,
			'per_page' => PAGE_LIMIT
		));
	
		$this->load->view('tpl/header');
		$this->load->view('plantas/lista', array(
			'plantas' => $plantas,
			'size' => $size,
			'pagination' => $pagination
		));
		$this->load->view('tpl/footer');
	}
	
	public function novo(){

		if($this->input->post()){
			try {		
				$this->novoPost();
			} catch (Exception $ex){
				fail($ex->getMessage(), true);
			}
		}
		
		$this->load->view('tpl/header');
		$this->load->view('plantas/novo', array(
			'clientes' => $this->clientes->getClientesLista()
		));
		$this->load->view('tpl/footer');
	}
	
	private function novoPost(){
		$data = array(
			'id_cliente' => $this->input->post('id_cliente'),
			'ide' => $this->input->post('ide'),
			'razao' => $this->input->post('razao'),
			'cgc' => $this->input->post('cgc'),
			'ie' => $this->input->post('ie'),
			'endereco' => $this->input->post('endereco'),
			'bairro' => $this->input->post('bairro'),
			'cep' => $this->input->post('cep'),
			'cidade' => $this->input->post('cidade'),
			'tel' => $this->input->post('tel')
		);
		
		$plantaId = $this->plantas->insertPlanta($data);
		success('Planta cadastrada com sucesso.');
		redirect("plantas#id=" . $plantaId);
	}
	
	public function editar($plantaId){
		$planta = $this->plantas->getPlantaById($plantaId);
		if($planta){
		
			if($this->input->post()){
				try {	
					$this->editarPost($planta);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
		
			$this->load->view('tpl/header');
			$this->load->view('plantas/editar', array(
				'clientes' => $this->clientes->getClientesLista(),
				'planta' => $planta
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function editarPost($planta){
		$data = array(
			'id_cliente' => $this->input->post('id_cliente'),
			'ide' => $this->input->post('ide'),
			'razao' => $this->input->post('razao'),
			'cgc' => $this->input->post('cgc'),
			'ie' => $this->input->post('ie'),
			'endereco' => $this->input->post('endereco'),
			'bairro' => $this->input->post('bairro'),
			'cep' => $this->input->post('cep'),
			'cidade' => $this->input->post('cidade'),
			'tel' => $this->input->post('tel')
		);
	
		$this->plantas->updatePlanta($planta->id_planta, $data);
		success('Planta atualizada com sucesso.');
		redirect("plantas");
	}
	
	public function remover($plantaId){
		$planta = $this->plantas->getPlantaById($plantaId);
		if($planta){
	
			if($this->input->post()){
				try {
					$this->removerPost($planta);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
	
			$this->load->view('tpl/header');
			$this->load->view('plantas/remover', array(
					'planta' => $planta
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function removerPost($planta){
		$this->plantas->deletePlanta($planta->id_planta);
		success('Planta removida com sucesso.');
		redirect("plantas");
	}
}