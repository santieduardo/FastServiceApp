<h4 class="page-header">Pedidos</h4>

<div class="row hidden-print">
	<div class="col-md-6">
		<div class="btn-group">
			<a href="<?=site_url('pedidos/novo'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-plus"></span> Novo Pedido
			</a>
		</div>
	</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-5">
		<form role="form" method="get" action="<?=site_url('pedidos'); ?>">
			<div class="input-group">
				<input type="text" class="form-control" name="term" value="<?=$this->input->get('term'); ?>" placeholder="Buscar por número do pedido ou cliente">
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
			<th width="105" class="hidden-print"></th>
		</tr>
	</thead>
	<tbody>
		<?php if(sizeof($pedidos) > 0){ ?>
			<?php foreach($pedidos as $row){ ?>
				<tr>
					<td>
						<span class="glyphicon glyphicon-tag legend-<?=$status[$row->status]->classe; ?>"></span>
						<?=$row->idPedido; ?>
					</td>
					<td><?=date("d/m/Y h:i", $row->ctime); ?></td>
					<td><?=$row->nome. ' ' . $row->sobrenome; ?></td>
					<td class="text-right">R$ <?=reais($row->total); ?></td>
					<td class=" hidden-print">

						<a href="<?=site_url('pedidos/itens/' . $row->idPedido); ?>" class="btn btn-default" title="Detalhes do Pedido">
							<span class="glyphicon glyphicon-eye-open"></span>
						</a>
						<?php if($row->status == 2){?>
							<a href="<?=site_url('pedidos/cancelar/' . $row->idPedido); ?>" class="btn btn-danger" title="Cancelar Pedido">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						<?php }?>
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
	<div class="col-md-4">
		<?=$pagination; ?>
	</div>
	<div class="col-md-8 text-right">
		<?php foreach($status as $row){ ?>
			<p class="legenda-footer legend-<?=$row->classe; ?>">
				<span class="glyphicon glyphicon-tag"></span> <?=$row->alt; ?>
			</p>
		<?php } ?>
	</div>
</div>