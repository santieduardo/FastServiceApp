<h4 class="page-header">Pedidos - <small>Cancelar</small></h4>

<form action="<?=site_url('checkout/cancelar/' . $pedido->idPedido); ?>" method="post" id="pedidos-form">
	<input type="hidden" name="hash" value="<?=time(); ?>">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="callout callout-danger">
				<h4>Cancelar Pedido</h4>
				<p>Tem certeza que quer cancelar o pedido <strong><?=$pedido->idPedido; ?></strong>?</p>
				<p>
					&nbsp;
					<a href="<?=site_url('checkout'); ?>" class="btn btn-default col-md-3">
						Cancelar
					</a>
					<button type="submit" class="btn btn-danger col-md-3">
						Sim
					</button>
				</p>
			</div>
		</div>
	</div>
</form>

