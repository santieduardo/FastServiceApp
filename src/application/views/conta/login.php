<div class="row conta">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="alert alert-danger" role="alert"></div>
		<form role="form" action="" method="post">
			<div class="form-group">
				<label for="label-email">E-mail</label>
				<input type="email" class="form-control" name="email" id="label-email" placeholder="Insira seu e-mail">
			</div>
			<div class="form-group">
				<label for="label-senha">Senha</label>
				<input type="password" class="form-control" name="senha" id="label-senha" placeholder="Insira sua senha">
			</div>
			<a class="pull-left link-secundario" href="<?=site_url(); ?>">Cancelar</a>
			<button type="submit" class="btn btn-success pull-right">				
				<span class="glyphicon glyphicon-ok"></span>
				Entrar
			</button>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>