<h4 class="page-header">Itens do Pedido</h4>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
		    <th>Produto</th>
		    <th>Valor</th>
		    <th>Quantidade</th>
		</tr>
	</thead>
	<tbody>
		<?php if(sizeof($itens) > 0){ ?>
			<?php foreach($itens as $row){ ?>
				<tr>
					<td><?=$row->nome; ?></td>
					<td class="col-md-2"><?=$row->preco; ?></td>
					<td class="col-md-2"><?=$row->quantidade; ?> unidade(s)</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td class="text-center" colspan="5">
					<br>Não foram encontrados produtos<br><br>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
		<div class="btn-group">
			<a href="<?=site_url('pedidos'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-arrow-left"></span> Voltar
			</a>
		</div>