<div class="catalogo">
	<div class="page-header">
	  <h2>Catálogo</h2>
	</div>
	
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Procurar Produto</h3>
				</div>
				<div class="panel-body">
		   			<form role="form" method="get" action="<?=site_url('catalogo'); ?>">
						<input type="hidden" name="c" value="<?=$catId; ?>">
						<div class="input-group">
							<input type="text" class="form-control" name="q" value="<?=$search; ?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">Procurar</button>
							</span>
						</div>
					</form>
					<br>
					Categorias: <?=$categorias; ?>
		
				</div>
			</div>
			
			<div class="row" id="produtos">
				<?php
				if($produtosSize > 0){ ?>
					<div class="lista">
						<?php foreach($produtos as $rows){ ?>
							<div class="col-sm-6 col-md-3">
								<div class="thumbnail" data-id="<?=$rows->idProduto; ?>">
									<div class="label label-<?=$rows->label; ?>"><?=$rows->categoria; ?></div>
									<img src="<?=base_url('assets/img/produtos/' . $rows->arquivo); ?>" alt="...">
									
									<h5><?=$rows->nome; ?></h5>

									<div class="options">
										R$ <?=reais($rows->preco); ?>
										<a class="btn btn-primary btn-xs pull-right adicionarItem">
											<span class="glyphicon glyphicon-plus"></span>
										</a>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
	  				<div class="col-md-12">
						<div class="callout callout-warning">
						    <h4>Nenhum produto encontrado</h4>
						    <p>Verifique se as palavras estão escritas corretamente ou reescreva sua busca usando termos mais genéricos.</p>
						</div>
	  				</div>
				<?php } ?>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$pagination; ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
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
							<tbody id="itens">
								<?php if(sizeof($carrinho->produtos) > 0){ ?>
									<?php foreach($carrinho->produtos as $produto){ ?>
										<tr data-id="<?=$produto->idProduto; ?>" class="item">
											<td><?=$produto->nome; ?></td>
											<td>
												<input type="number" min="1" value="<?=$produto->quantidade; ?>" required="required">
											</td>
											<td nowrap="nowrap">R$ <?=reais($produto->preco); ?></td>
											<td>
												<a class="close removerItem">
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
						
						<a class="btn btn-success btn-lg col-md-12 <?=($carrinho->total > 0) ? '' : 'disabled'; ?>" id="cart">
							<span class="glyphicon glyphicon-shopping-cart"></span> Finalizar Carrinho
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){

	var catalogo = new Catalogo();
	catalogo.init();
	try {
		
	} catch (err) {
		console.log(err.message);
	}
});
</script>
