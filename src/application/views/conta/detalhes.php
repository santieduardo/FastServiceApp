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
			<th width="120" class="hidden-print"></th>
		</tr>
	</thead>
	<tbody>
	
		<?php if(sizeof($pedidos) > 0){ ?>
			<?php foreach($pedidos as $row){ ?>

				<tr>
					<td>
						<?=$row->idPedido; ?>
					</td>
					<td><?=date("d/m/Y h:i"); ?></td>
					
					<td class="text-right">R$ <?=reais($row->total); ?></td>
					<td class="text-center hidden-print">
						<div class="btn-group">
				
							<a href="<?=site_url('conta/cancelar/' . $row->idPedido); ?>" class="btn btn-default">
								<span class="glyphicon glyphicon-trash"></span> Cancelar Pedido
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

	