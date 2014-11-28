<h4 class="page-header">Pedido <small>- <?=$pedido->idPedido?></small></h4>
<div class="row hidden-print">
	<div class="col-md-6">
		<a href="<?=site_url('pedidos'); ?>" class="btn btn-default">
			 <span class="glyphicon glyphicon-arrow-left"></span> Voltar
		</a>
	</div>
	<div class="col-md-6 text-right">
		<?php if($pedido->status == 2) {?>
			<a href="<?=site_url('pedidos/cancelar/' . $pedido->idPedido); ?>" class="btn btn-danger">
				 <span class="glyphicon glyphicon-trash"></span> Cancelar
			</a>
			
			<a href="<?=site_url('pedidos/concluir/' . $pedido->idPedido); ?>" class="btn btn-success" onclick="javascript: return confirm('Você tem certeza?');">
				 <span class="glyphicon glyphicon-ok"></span> Concluir
			</a>
		<?php }?>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-4 form-group">
		<label>Nome</label>
		<div class="form-control"><?=$usuario->nome . ' ' . $usuario->sobrenome; ?></div>
	</div>
	<div class="col-md-4 form-group">
		<label>Data do Pedido</label>
		<div class="form-control"><?=date("d/m/Y h:i", $pedido->ctime); ?></div>
	</div>
	<div class="col-md-4 form-group">
		<label>Total do Pedido</label>
		<div class="form-control">R$ <?=reais($pedido->total); ?></div>
	</div>
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
		    <th>Produto</th>
		    <th>Quantidade</th>
		    <th>Valor Unitário</th>
		    <th>Valor Total</th>
		</tr>
	</thead>
	<tbody>
		<?php if(sizeof($itens) > 0){ ?>
			<?php foreach($itens as $row){ ?>
				<tr>
					<td><?=$row->nome; ?></td>
					<td class="col-md-2"><?=$row->quantidade; ?> unidade(s)</td>
					<td class="col-md-2">R$ <?=reais($row->preco); ?></td>
					<td class="col-md-2">R$ <?=reais($row->preco * $row->quantidade); ?></td>
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
<div class="row hidden-print">
	<div class="col-md-6">
		<a href="<?=site_url('pedidos'); ?>" class="btn btn-default">
			 <span class="glyphicon glyphicon-arrow-left"></span> Voltar
		</a>
	</div>
	<div class="col-md-6 text-right">
		<?php if($pedido->status == 2) {?>
			<a href="<?=site_url('pedidos/cancelar/' . $pedido->idPedido); ?>" class="btn btn-danger">
				 <span class="glyphicon glyphicon-trash"></span> Cancelar
			</a>
			
			<a href="<?=site_url('pedidos/concluir/' . $pedido->idPedido); ?>" class="btn btn-success" onclick="javascript: return confirm('Você tem certeza?');">
				 <span class="glyphicon glyphicon-ok"></span> Concluir
			</a>
		<?php }?>
	</div>
</div>