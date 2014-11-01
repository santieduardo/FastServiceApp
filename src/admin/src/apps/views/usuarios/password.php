<h4 class="page-header">Usuários - <small>Trocar senha</small></h4>
<div class="row hidden-print">
	<div class="col-md-12">
		<div class="btn-group">
			<a href="<?=site_url('usuarios'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-chevron-left"></span> Voltar
			</a>
		</div>
	</div>
</div>
<br>

<form action="<?=site_url('usuarios/password/' . $usuario->id); ?>" method="post" id="usuarios-form">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Login</label>
					<input type="text" readonly="readonly" class="form-control" value="<?=$usuario->login; ?>">
				</div>
				
				<div class="col-md-3 form-group">
					<label>Senha *</label>
					<input type="password" maxlength="16" required="required" class="form-control" name="senha">
				</div>
				
				<div class="col-md-3 form-group">
					<label>Repita *</label>
					<input type="password" maxlength="16" required="required" class="form-control" name="repita">
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
	$("#usuarios-form").validate();
</script>