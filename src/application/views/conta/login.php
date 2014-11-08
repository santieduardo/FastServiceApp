<div class="row conta">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<?php
			if($erro){
				echo'<div class="alert alert-danger" role="alert">', $erro, '</div>';
			}
			if($sucesso){
				echo'<div class="alert alert-success" role="alert">', $sucesso, '</div>';
			}
		?>
		<br>
		<a href="<?=site_url('conta/loginFacebook'); ?>" class="btn btn-facebook col-xs-12">Logar com Facebook</a>
		<br>
		<br><hr>
		
		<form role="form" action="<?=site_url('conta/login'); ?>" method="post" id="form-login">
			<div class="form-group">
				<label for="label-email">E-mail</label>
				<input type="email" class="form-control" name="email" id="label-email" placeholder="Insira seu e-mail" required="required">
			</div>
			<div class="form-group">
				<label for="label-senha">Senha</label>
				<input type="password" class="form-control" name="senha" id="label-senha" placeholder="Insira sua senha" required="required">
			</div>
			
			<a class="pull-left link-secundario" href="<?=site_url('conta/registrar'); ?>">Criar uma conta</a>
			
			<button type="submit" class="btn btn-success pull-right">				
				<span class="glyphicon glyphicon-ok"></span>
				Entrar
			</button>
			
			<input type="hidden" value="<?=$this->input->get_post('return'); ?>" name="return">
		</form>
	</div>
	<div class="col-md-4"></div>
</div>
<script type="text/javascript">
	$("#form-login").validate();
</script>