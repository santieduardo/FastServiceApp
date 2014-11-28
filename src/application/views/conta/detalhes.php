<h4 class="page-header">Pedidos - Cancelar</h4>

<div class="row hidden-print">
	<div class="col-md-6"> </div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-5"> </div>
</div>
<br>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nº</th>
		    <th>Data</th>
		    <th>Valor Total</th>
		    <th>Status</th>
			<th width="105" class="hidden-print"></th>
		</tr>
	</thead>
	<tbody>
	
		<?php if(sizeof($pedidos) > 0){ ?>
			<?php foreach($pedidos as $row){ ?>

				<tr>
					<td><?=pedido_format($row->idPedido); ?></td>
					<td><?=date("d/m/Y h:i", $row->ctime); ?></td>
					<td class="text-right">R$ <?=reais($row->total); ?></td>
					<td class="text-center"><?=$status[$row->status]->alt; ?></td>
					<td class="hidden-print">
						<a href="<?=site_url('checkout/pedido/' . $row->idPedido); ?>" class="btn btn-default">
							<span class="glyphicon glyphicon-eye-open"></span>
						</a>
						
						<?php if($row->status == 2){ ?>
							<a href="<?=site_url('conta/cancelar/' . $row->idPedido); ?>" class="btn btn-danger" title="Cancelar Pedido" onclick="javascript:return confirm('Você tem certeza?');">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						<?php } ?>
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

	