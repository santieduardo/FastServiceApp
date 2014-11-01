<h4 class="page-header">Pedidos</h4>

<div class="row hidden-print">
	<div class="col-md-4">
		<div class="btn-group">
			<a href="<?=site_url('pedidos/novo'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-plus"></span> Cadastrar
			</a>
		</div>
	</div>
	<div class="col-md-1">&nbsp;</div>
	<form role="form" method="get" action="<?=site_url('pedidos'); ?>">
		<div class="col-md-3">
			<select class="form-control" name="ordem">
				<?php
					foreach(getOrdem() as $i => $row){
						if($ordem == $i){
							echo '<option value="',$i,'" selected>',$row,'</option>';
						} else {
							echo '<option value="',$i,'">',$row,'</option>';
						}
					}
				?>
			</select>
		</div>
		<div class="col-md-4">
			<div class="input-group">
				<input type="text" class="form-control" name="term" value="<?=$this->input->get('term'); ?>" placeholder="Procurar...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
		</div>
	</form>
</div>
<br>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>N°</th>
			<th>Cliente</th>
			<th>Fornecedor</th>
			<th>Data</th>
			<th>Embarque</th>
			<th>Vencimento</th>
			<th>Valor Total</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php if(sizeof($pedidos) > 0){ ?>
			<?php foreach($pedidos as $row){
				$status = getStatus($row->status);
			?>
				<tr>
					<td><?=$row->nro; ?></td>
					<td><?=$row->cliente; ?></td>
					<td><?=$row->fornecedor; ?></td>
					<td><?=sql_to_site($row->data); ?></td>
					<td><?=sql_to_site($row->embarque); ?></td>
					<td><?=sql_to_site($row->vencimento); ?></td>
					<td class="text-right">R$ <?=reais($row->total); ?></td>
					<td>
						<a class="btn text-<?=$status->classe; ?> hidden-print" title="<?=$status->alt; ?>">
							<span class="glyphicon glyphicon-tag"></span>
						</a>
						
						<p class="visible-print-inline"><?=$status->alt; ?></p>
						
						<div class="btn-group hidden-print">
							<?php if($row->nota){ ?>
								<a href="<?=site_url('notas/editar/' . $row->nota); ?>" class="btn btn-default">
									<span class="glyphicon glyphicon-barcode"></span>
								</a>
							<?php } ?>
						
							<a href="<?=site_url('pedidos/editar/' . $row->id_pedido); ?>" class="btn btn-default">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
							
							<a href="<?=site_url('pedidos/remover/' . $row->id_pedido); ?>" class="btn btn-default">
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