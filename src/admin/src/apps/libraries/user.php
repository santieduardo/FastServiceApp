<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User {
	
	private $data = false;
	private $ci;
	
	public function  __construct(){
		$this->ci =& get_instance();
		$this->setup();
	}
	
	public function check(){
		if(!$this->data){
			redirect('login?redirect=' . rawurlencode($this->ci->uri->uri_string()));
		}
	}
	
	public function check404($invert = false){
		if($invert){
			if($this->data) show_404();
		} else {
			if(!$this->data) show_404();
		}
	}
	
	public function getId(){
		if(!$this->data) return false;
		return $this->data->id;
	}
	
	public function getUsername(){
		if(!$this->data) return false;
		return $this->data->nome;
	}
	
	public function flags($flag){
		if(!$this->data) return false;
		
		foreach ($this->data->flags as $f){
			if($f === $flag) return true;
		}
		
		return false;
	}
	
	private function setup(){
		$data = $this->ci->session->userdata('admin');
	
		if($data && isset($data->id)){
			$this->data = $data;
		}
	}
}