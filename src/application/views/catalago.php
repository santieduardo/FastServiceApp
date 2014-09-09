<div class="catalogo">
	<div class="page-header">
	  <h2>Catálogo</h2>
	</div>
	
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
	
	<?php 
	if(sizeof($produtos) > 0){
		echo '<div class="row lista">';
		foreach($produtos as $rows){
	?>
		<div class="col-sm-6 col-md-3">
			<div class="thumbnail">
				<div class="label label-<?=$rows->label; ?>"><?=$rows->categoria; ?></div>
				<img src="<?=base_url('assets/img/produtos/' . $rows->arquivo); ?>" alt="...">
				<div class="caption">
					<h5><?=$rows->nome; ?> <small>R$ <?=number_format($rows->preco, 2, ',', ' '); ?></small></h5>
				</div>
			</div>
		</div>
	<?php
		}
		echo '</div>';
	} else {
		echo '
			<div class="callout callout-warning">
			    <h4>Nenhum produto encontrado</h4>
			    <p>Verifique se as palavras estão escritas corretamente ou reescreva sua busca usando termos mais genéricos.</p>
			</div>
		';
	}
	?>
</div>