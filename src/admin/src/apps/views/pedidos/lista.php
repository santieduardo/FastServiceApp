<h4 class="page-header">Pedidos</h4>

<div class="row hidden-print">
	<div class="col-md-7">
		<div class="btn-group">
			<a href="<?=site_url('pedidos/novo'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-plus"></span> Cadastrar
			</a>
		</div>
	</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-4">
		<form role="form" method="get" action="<?=site_url('pedidos'); ?>">
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
			<th>Nº</th>
		    <th>Data</th>
		    <th>Cliente</th>
		    <th>Valor Total</th>
			<th width="120" class="hidden-print"></th>
		</tr>
	</thead>
	<tbody>
		<?php if(sizeof($pedidos) > 0){ ?>
			<?php foreach($pedidos as $row){ ?>
				<tr>
					<td><?=$row->idPedido; ?></td>
					<td><?=date("d/m/Y h:i"); ?></td>
					<td><?=$row->cliente; ?></td>
					<td class="text-right">R$ <?=reais($row->total); ?></td>
					<td class="text-center hidden-print">
						<div class="btn-group">
							<a href="<?=site_url('plantas/editar/' . $row->idPedido); ?>" class="btn btn-default">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
							
							<a href="<?=site_url('plantas/remover/' . $row->idPedido); ?>" class="btn btn-default">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td class="text-center" colspan="5">
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