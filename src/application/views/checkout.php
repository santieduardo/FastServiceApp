<form method="post" action="<?=site_url('checkout'); ?>">
	<div class="checkout">
		<div class="page-header">
		  <h2>Checkout</h2>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body carrinho" id="carrinho">
						<?php if(isset($carrinho) && !empty($carrinho)){ ?>
							<table class="table">
								<thead>
									<tr>
										<th>Produto</th>
										<th>Qtd</th>
										<th colspan="2">Valor Unit</th>
									</tr>
								</thead>
								<tbody>
									<?php if(sizeof($carrinho->produtos) > 0){ ?>
										<?php foreach($carrinho->produtos as $produto){ ?>
											<tr class="item">
												<td><?=$produto->nome; ?></td>
												<td><?=$produto->quantidade; ?></td>
												<td nowrap="nowrap">R$ <?=reais($produto->preco); ?></td>
												<td>
													<a class="close removerItem" href="<?=site_url('checkout/removeProduto?produtoId=' . $produto->idProduto); ?>">
														<span aria-hidden="true">&times;</span>
													</a>
												</td>
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
								Total: <span class="pull-right" id="total">R$ <?=reais($carrinho->total); ?></span>
							</div>
							
							
							<input type="hidden" value="<?=time(); ?>" name="time">
																								
							<button type="submit" class="btn btn-success btn-lg col-xs-12 col-sm-6 col-lg-4 col-sm-offset-3 col-lg-offset-4" <?=($carrinho->total > 0) ? '' : 'disabled="disabled"'; ?>>
								<span class="glyphicon glyphicon-ok"></span> Finalizar
							</button>
							
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>