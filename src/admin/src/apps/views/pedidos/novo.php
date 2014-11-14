<div class="row">
	<h4 class="page-header">Novo Pedido</h4>
	<div class="col-md-5">
		<div class="row">
			<h4 style="text-align: center">Produtos</h4>
		</div>
		<div class="row">
			<form role="form" method="get" action="<?=site_url('pedidos/novo'); ?>">
				<div class="input-group">
					<input type="text" class="form-control" name="term" value="<?=$this->input->get('term'); ?>" placeholder="Procurar...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</form>
		</div>
		<br>
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Produto</th>
						<th colspan="2">Valor Unitário</th>
					</tr>
				</thead>
				<tbody>
			    	<?php if(sizeof($produtos) > 0){ ?>
						<?php foreach($produtos as $row){ ?>
			    			<tr>
								<td><?=$row->nome; ?></td>
								<td><?=$row->preco; ?></td>
								<td class="text-right" width="200">
									<form action="<?=site_url('pedidos/addProduto/' . $row->idProduto); ?>" method="post">
										<div class="col-md-8">
											<input type="number" value="1" name="qtd" min="0" class="form-control">
										</div>
										<button type="submit" class="btn btn-default col-md-4">
											<span class="glyphicon glyphicon-arrow-right"></span>
										</button>
									</form>
								</td>
							</tr>
			    		<?php } ?>
			    	<?php } else { ?>
						<tr>
							<td class="text-center" colspan="5"><br>Não foi encontrado nenhum resultado<br><br></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="row hidden-print">
			<div class="col-md-12">
				<?=$pagination; ?>
			</div>
		</div>
	</div>
	
	<div class="col-md-1"></div>
	
	<div class="col-md-6">
		<div class="row">
			<h4 style="text-align: center">Pedido</h4>
		</div>
		<br>
		<div class="row">
			<a class="btn btn-warning col-xs-12" href="<?=site_url('pedidos/resetPedido'); ?>" onclick="return confirm('Tem Certeza');">
				<span class="glyphicon glyphicon-ok"></span> Limpar Pedido
			</a>
		</div>
		<br>
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Produto</th>
						<th>Valor unit</th>
						<th width="100">Quantidade</th>
						<th width="100"></th>
					</tr>
				</thead>
				<tbody>				
					<?php if(sizeof($carrinho->produtos) > 0){ ?>
						<?php foreach($carrinho->produtos as $linha){ ?>
							<form action="<?=site_url('pedidos/atualizarProduto/' . $linha->idProduto); ?>" method="post">
								<tr>
									<td><?=$linha->nome; ?></td>
									<td>R$ <?=reais($linha->preco); ?></td>
									<td class="text-center">
										<input type="number" value="<?=$linha->quantidade; ?>" name="qtd" min="0" class="form-control">
									</td>
									<td class="text-center">
										<div class="btn-group">
											<button type="submit" class="btn btn-info">
												<span class="glyphicon glyphicon-refresh"></span>
											</button>
											<a class="btn btn-danger" href="<?=site_url('pedidos/removerProduto/' . $linha->idProduto); ?>">
												<span class="glyphicon glyphicon-trash"></span>
											</a>
										</div>
									</td>
								</tr>
							</form>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-xs-6">Total: R$ <?=reais($carrinho->total); ?></div>
			<div class="col-xs-6 text-right">
				<a class="btn btn-success" href="<?=site_url('pedidos/finalizarPedido'); ?>">
					<span class="glyphicon glyphicon-ok"></span> Finalizar Pedido
				</a>
			</div>
		</div>
	</div>
</div>
