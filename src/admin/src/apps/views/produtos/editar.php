<h4 class="page-header">Produtos - <small>Editar</small></h4>
<div class="row hidden-print">
	<div class="col-md-12">
		<div class="btn-group">
			<a href="<?=site_url('produtos'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-chevron-left"></span> Voltar
			</a>
		</div>
	</div>
</div>
<br>

<form action="<?=site_url('produtos/editar/' . $produto->id_produto); ?>" method="post" id="produtos-form">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Nome</label>
					<input type="text" maxlength="250" required="required" class="form-control" name="nome" value="<?=post('nome', $produto->nome); ?>">
				</div>
			</div>
			
			<div class="row hidden-print">
				<div class="col-md-4 col-md-offset-8">
					<button type="submit" class="btn btn-success pull-right">
						 <span class="glyphicon glyphicon-ok"></span> Salvar
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$("#produtos-form").validate();
</script>