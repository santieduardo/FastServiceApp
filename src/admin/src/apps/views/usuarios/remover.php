<h4 class="page-header">Usuários - <small>Remover</small></h4>

<form action="<?=site_url('usuarios/remover/' . $usuario->id); ?>" method="post" id="contas-form">
	<input type="hidden" name="hash" value="<?=time(); ?>">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="callout callout-danger">
				<h4>Remover Usuário</h4>
				<p>Tem certeza que quer remover o usuário <strong><?=$usuario->login; ?></strong>?</p>
				<p>
					&nbsp;
					<a href="<?=site_url('usuarios'); ?>" class="btn btn-default col-md-3">
						</span> Cancelar
					</a>
					<button type="submit" class="btn btn-danger col-md-3">
						  Sim
					</button>
				</p>
			</div>
		</div>
	</div>
</form>

