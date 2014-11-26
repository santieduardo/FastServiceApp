<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->user->check();
		$this->load->helper('pedidos');
		$this->load->model('pedidos_model', 'pedidos');
		$this->load->model('produtos_model', 'produtos');
	}

	public function index(){
		
		$ordem = $this->input->get('ordem');
		$term = $this->input->get('term');
		$page = $this->input->get('per_page');
		if(!is_numeric($page)) $page = 0;
		if(!is_numeric($ordem)) $ordem = 0;
		
		
		$size = $this->pedidos->getPedidosSize($term);
		$pedidos = $this->pedidos->getPedidos($page, $term, $ordem);
		$pagination = pagination(array(
			'base_url' => site_url('pedidos?term=' .$term.'&ordem='.$ordem),
			'total_rows' => $size,
			'per_page' => PAGE_LIMIT
		));
	
		$this->load->view('tpl/header');
		$this->load->view('pedidos/lista', array(
			'pedidos' => $pedidos,
			'status' => getStatus(),
			'size' => $size,
			'ordem' => $ordem,
			'pagination' => $pagination
		));
		$this->load->view('tpl/footer');
	}
	
	public function itens($idPedido){
		
		$itens = $this->produtos->getItensPedido($idPedido);
		
		$this->load->view('tpl/header');
		$this->load->view('pedidos/itens', array(
			'itens' => $itens
		));
		$this->load->view('tpl/footer');
	}
	
	public function novo(){
		$term = $this->input->get('term');
		$page = $this->input->get('per_page');
		if(!is_numeric($page)) $page = 0;
		
		$size = $this->produtos->getProdutosSize($term);
		$produtos = $this->produtos->getProdutos($page, $term);
		$pagination = pagination(array(
			'base_url' => site_url('pedidos/novo?term=' .$term),
			'total_rows' => $size,
			'per_page' => PAGE_LIMIT
		));
		
		$this->load->view('tpl/header');
		$this->load->view('pedidos/novo', array(
			'produtos' => $produtos,
			'carrinho' => $this->getCarrinho(),
			'size' => $size,
			'pagination' => $pagination
		));
		$this->load->view('tpl/footer');
	}
	
	
	private function getCarrinho($reset = false){
		$carrinho = $this->session->userdata('carrinho_admin');
		if(!$carrinho || $reset){
			$carrinho = (Object) array(
				'produtos' => array(),
				'total' => 0
			);
			$this->saveCarrinho($carrinho);
		}
		return $carrinho;
	}
	
	private function saveCarrinho($carrinho){
		$this->session->set_userdata('carrinho_admin', $carrinho);
	}
	
	public function resetPedido(){
		$this->getCarrinho(true);
		
		redirect('pedidos/novo');
	}
	
	public function addProduto($produtoId){
		$carrinho = $this->getCarrinho();
		
		$qtd = $this->input->post('qtd');
		if(!is_numeric($produtoId) || !is_numeric($qtd)) show_404();
		$produto = $this->produtos->getProdutoById($produtoId);
		
		if($produto){
			$key = getKeyFromArray($carrinho->produtos, 'idProduto', $produto->idProduto);
			
			if($key >= 0){
				$carrinho->produtos[$key]->quantidade += $qtd;
			} else {
				array_push($carrinho->produtos, (Object) array(
					'idProduto' => $produto->idProduto,
					'nome' => $produto->nome,
					'preco' => $produto->preco,
					'quantidade' => $qtd	
				));
			}
			
			$carrinho->total += $produto->preco * $qtd;
			$this->saveCarrinho($carrinho);
			
			redirect('pedidos/novo');
		} else
			show_404();
	}
	
	public function atualizarProduto($produtoId){
		$carrinho = $this->getCarrinho();
	
		$qtd = $this->input->post('qtd');
		if(!is_numeric($produtoId) || !is_numeric($qtd)) show_404();
		$produto = $this->produtos->getProdutoById($produtoId);
	
		if($produto){
			$key = getKeyFromArray($carrinho->produtos, 'idProduto', $produto->idProduto);
			
			if($key >= 0){
				$carrinho->total -= $produto->preco * $carrinho->produtos[$key]->quantidade;
				$carrinho->produtos[$key]->quantidade = $qtd;
				$carrinho->total += $produto->preco * $qtd;
			}
			
			$this->saveCarrinho($carrinho);
			redirect('pedidos/novo');
		} else
			show_404();
	}
	
	public function removerProduto($produtoId){
		$carrinho = $this->getCarrinho();

		if(!is_numeric($produtoId)) show_404();
		$produto = $this->produtos->getProdutoById($produtoId);
		
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
			
			redirect('pedidos/novo');
		} else 
			show_404();
	}
	
	public function finalizarPedido(){
		$carrinho = $this->getCarrinho();
		if(sizeof($carrinho->produtos) > 0){
				
			$idPedido = $this->pedidos->insertPedido($carrinho->produtos);
				
			if($idPedido && $idPedido > 0){
				$this->saveCarrinho((Object) array(
					'produtos' => array(),
					'total' => 0.0
				));
				
				success("Pedido realizado com sucesso!");
				redirect('pedidos/novo');
			} else {
				fail("O pedido tem que ter um ou mais produtos para poder ser finalizado!");
				redirect('pedidos/novo');
			}
		}
	}
	
	public function cancelar($pedidoId){
		$pedido = $this->pedidos->getPedidoById($pedidoId);
		if($pedido){	
			if($this->input->post()){
				$this->pedidos->updatePedido($pedido->idPedido, array(
					'status' => 0
				));

				success("Pedido cancelado com sucesso!");
				redirect('pedidos');
			}
			
			$this->load->view('tpl/header');
			$this->load->view('pedidos/cancelar', array(
					'pedido' => $pedido
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	public function editar($pedidoId){
		$pedido = $this->pedidos->getPedidoById($pedidoId);
		if($pedido){
		
			if($this->input->post()){
				try {	
					$this->editarPost($pedido);
				} catch (Exception $ex){
					fail($ex->getMessage(), true);
				}
			}
		
			$this->load->view('tpl/header');
			$this->load->view('pedidos/editar', array(
				'pedido' => $pedido
			));
			$this->load->view('tpl/footer');
		} else
			show_404();
	}
	
	private function editarPost($pedido){
		$data = array(
			'qtd' => $this->input->post('qtd')
		);
	
		$tempPedido = $this->pedidos->getPedidoByCNPJ($data['cnpj']);
		if($tempPedido && $tempPedido->id_pedido != $pedido->id_pedido){
			throw new Exception('Pedido já cadastrado. Link <a href="'.site_url('pedidos/editar/' . $tempPedido->id_pedido).'">'.$tempPedido->nome.'</a>');
		} else {
			$this->pedidos->updatePedido($pedido->id_pedido, $data);
			success('Pedido atualizado com sucesso.');
			redirect("pedidos");
		}
	}
	
	
}