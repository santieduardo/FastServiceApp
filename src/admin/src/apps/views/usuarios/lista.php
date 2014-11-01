<h4 class="page-header">Usuários</h4>

<div class="row hidden-print">
	<div class="col-md-7">
		<div class="btn-group">
			<a href="<?=site_url('usuarios/novo'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-plus"></span> Cadastrar
			</a>
		</div>
	</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-4">
		<form role="form" method="get" action="<?=site_url('usuarios'); ?>">
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
</div>
<br>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="60">ID</th>
			<th>Login</th>
			<th width="200" class="hidden-print"></th>
		</tr>
	</thead>
	<tbody>
		<?php if(sizeof($usuarios) > 0){ ?>
			<?php foreach($usuarios as $row){ ?>
				<tr>
					<td><?=$row->id; ?></td>
					<td><?=$row->login; ?></td>
					<td class="text-center hidden-print">
						<div class="btn-group">
							<a href="<?=site_url('usuarios/password/' . $row->id); ?>" class="btn btn-default">
								<span class="glyphicon glyphicon-lock"></span> Trocar senha
							</a>
							
							
							<a href="<?=site_url('usuarios/remover/' . $row->id); ?>" class="btn btn-default">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td class="text-center" colspan="3">
					<br>Não foi encontrado nenhum resultado<br><br>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<div class="row hidden-print">
	<div class="col-md-9">
		<?=$pagination; ?>
	</div>
	<div class="col-md-3 text-right">
		<p class="text-muted"><?=$size; ?> Registros</p>
	</div>
</div>