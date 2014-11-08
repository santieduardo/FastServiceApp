<div class="row conta">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<?php 
			if($erro){
				echo'<div class="alert alert-danger" role="alert">', $erro, '</div>';
			}
		?>
		
		<br>
		<a href="<?=site_url('conta/loginFacebook'); ?>" class="btn btn-facebook col-xs-12">Cadastrar com Facebook</a>
		<br>
		<br><hr>
		
		<form role="form" action="<?=site_url('conta/registrar'); ?>" method="post" id="form-registrar">
			<div class="form-group">
				<label for="label-nome">Nome</label>
				<input type="text" class="form-control" name="nome" id="label-nome" placeholder="Insira seu nome" required="required">
			</div>
			<div class="form-group">
				<label for="label-sobrenome">Sobrenome</label>
				<input type="text" class="form-control" name="sobrenome" id="label-sobrenome" placeholder="Insira seu sobrenome" required="required">
			</div>
			<div class="form-group">
				<label for="label-email">E-mail</label>
				<input type="email" class="form-control" name="email" id="label-email" placeholder="Insira seu email" required="required">
			</div>
			<div class="form-group">
				<label for="label-senha">Senha</label>
				<input type="password" class="form-control" name="senha" id="label-senha" placeholder="Insira sua senha" required="required">
			</div>
			<div class="form-group">
				<label for="label-confirma-senha">Confirmar Senha</label>
				<input type="password" class="form-control" name="confirma-senha" id="label-confirma-senha" placeholder="Confirme a senha" required="required">
			</div>
			<a class="pull-left link-secundario" href="<?=site_url('conta/login'); ?>">Logar</a>
			<button type="submit" class="btn btn-success pull-right">		
				<span class="glyphicon glyphicon-ok"></span>
				Enviar
			</button>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>

<script type="text/javascript">
	$("#form-registrar").validate();
</script>