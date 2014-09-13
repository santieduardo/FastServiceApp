<div class="row conta">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="alert alert-danger" role="alert"></div>
		<form role="form" action="" method="post">
			<div class="form-group">
				<label for="label-nome">Nome</label>
				<input type="text" class="form-control" name="nome" id="label-nome" placeholder="Insira seu nome">
			</div>
			<div class="form-group">
				<label for="label-sobrenome">Sobrenome</label>
				<input type="text" class="form-control" name="sobrenome" id="label-sobrenome" placeholder="Insira seu sobrenome">
			</div>
			<div class="form-group">
				<label for="label-email">E-mail</label>
				<input type="email" class="form-control" name="email" id="label-email" placeholder="Insira seu email">
			</div>
			<div class="form-group">
				<label for="label-senha">Senha</label>
				<input type="password" class="form-control" name="senha" id="label-senha" placeholder="Insira sua senha">
			</div>
			<div class="form-group">
				<label for="label-confirma-senha">Senha</label>
				<input type="password" class="form-control" name="confirma-senha" id="label-confirma-senha" placeholder="Confirme a senha">
			</div>
			<a class="pull-left link-secundario" href="<?=site_url(); ?>">Cancelar</a>
			<button type="submit" class="btn btn-success pull-right">		
				<span class="glyphicon glyphicon-ok"></span>
				Enviar
			</button>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>