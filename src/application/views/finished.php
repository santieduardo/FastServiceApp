
	<div class="checkout">
		<div class="page-header">
		  <h2>Pedido <small>- <?=str_pad($pedido->idPedidos, 10, "0", STR_PAD_LEFT); ?></small></h2>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body carrinho" id="carrinho">
						<?php if(isset($produtos) && !empty($produtos)){ ?>
							<table class="table">
								<thead>
									<tr>
										<th>Produto</th>
										<th>Qtd</th>
										<th colspan="2">Valor Unit</th>
									</tr>
								</thead>
								<tbody>
									<?php if(sizeof($produtos) > 0){ ?>
										<?php foreach($produtos as $produto){ ?>
											<tr class="item">
												<td><?=$produto->nome; ?></td>
												<td><?=$produto->quantidade; ?></td>
												<td nowrap="nowrap">R$ <?=reais($produto->preco); ?></td>
											</tr>
										<?php } ?>
									<?php } else { ?>
										<tr>
											<td class="text-center" colspan="4"><br>Sem produtos no carrinho</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							
							<div class="well well-sm">
								Total: <span class="pull-right" id="total">R$ <?=reais($pedido->total); ?></span>
							</div>
							
							<div class="text-center">
								<img alt="" src="<?=site_url('checkout/qr/'.$pedido->idPedidos); ?>">
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
