<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {
	
	public function index(){
		$this->load->model('checkout_model', 'checkout');
		
		$carrinho = $this->getCarrinho();
		
		if($this->input->post()){
			
			if(getUserId()){
				$this->doCreatePedido($carrinho);
			} else {
				redirect('conta/login?return=checkout');
			}
		}
		
		$this->load->view('tpl/header');
		
		$this->load->view('checkout', array(
			'carrinho' => $carrinho
		));
		
		
		$this->load->view('tpl/footer');
	}
	
	private function getCarrinho(){
		$carrinho = $this->session->userdata('carrinho');
		if(!$carrinho){
			$carrinho = (Object) array(
					'produtos' => array(),
					'total' => 0.0
			);
			$this->saveCarrinho($carrinho);
		}
		return $carrinho;
	}
	
	private function saveCarrinho($carrinho){
		$this->session->set_userdata('carrinho', $carrinho);
	}
	
	public function removeProduto(){
		$this->load->model('checkout_model', 'checkout');
		$carrinho = $this->getCarrinho();
		
		$produtoId = $this->input->get('produtoId');
		if(!is_numeric($produtoId)) show_404();
		
		$response = array();
		$produto = $this->checkout->getProdutoById($produtoId);
		
		if($produto){
			$key = getKeyFromArray($carrinho->produtos, 'idProduto', $produto->idProduto);
			if($key >= 0){
				$temp = $carrinho->produtos[$key];

				$valor = $temp->quantidade * $produto->preco;
		
				unset($carrinho->produtos[$key]);
				resetKeys($carrinho->produtos);
						
				$carrinho->total -= $valor;

				$this->saveCarrinho($carrinho);
			}
		}
		redirect('checkout');
	}
	
	private function doCreatePedido($carrinho){
		if(sizeof($carrinho->produtos) > 0){
			
			var_dump($carrinho);
			$idPedido = $this->checkout->insertPedido($carrinho->produtos);
			
			if($idPedido && $idPedido > 0){
				$this->saveCarrinho((Object) array(
					'produtos' => array(),
					'total' => 0.0
				));
				
				redirect('checkout/' . $idPedido);
			} else {
				redirect('checkout?fail');
			}
		}
	}
	
	/*
	 * Buscar o pedido e seus produtos com valor e quantidade e mostrar na tela com o qrcode
	 * é possivel fazer isso com duas querys.
	 * A tela pode ser parecida com a checkout.
	 */
	
	public function pedido($pedidoId){
		if(!is_numeric($pedidoId)) show_404();
		
		$userId = getUserId();
		if($userId){
			$this->load->model('checkout_model', 'checkout');
			
			/* Code */
			
			$this->load->view('tpl/header');
			/* View */
			$this->load->view('tpl/footer');
		} else {
			redirect('conta/login?return=' . rawurldecode("checkout/pedido/" . $pedidoId));
		}
	}
	
}