<h4 class="page-header">Dados Bancários - <small>Editar</small></h4>
<div class="row hidden-print">
	<div class="col-md-12">
		<div class="btn-group">
			<a href="<?=site_url('contas'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-chevron-left"></span> Voltar
			</a>
		</div>
	</div>
</div>
<br>
<form action="<?=site_url('contas/editar/' . $conta->id_conta); ?>" method="post" id="contas-form">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Cliente / Fornecedor *</label>
					<select name="id_cliente" class="form-control" required="required">
						<option value="">Selecione um cliente</option>
						<?php
							foreach($clientes as $cliente){
								if(post('id_cliente', $conta->id_cliente) == $cliente->id_cliente){
									echo '<option value="',$cliente->id_cliente,'" selected>',$cliente->nome,'</option>';
								} else {
									echo '<option value="',$cliente->id_cliente,'">',$cliente->nome,'</option>';
	
								}
							}
						?>
					</select>
				</div>
				
				<div class="col-md-6 form-group">
					<label>Favorecido</label>
					<input type="text" maxlength="250" required="required" class="form-control" name="favorecido" value="<?=post('favorecido', $conta->favorecido); ?>">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-3 form-group">
					<label>Banco *</label>
					<input type="text" maxlength="150" required="required" class="form-control" name="banco" value="<?=post('banco', $conta->banco); ?>">
				</div>
				
				<div class="col-md-3 form-group">
					<label>Agência *</label>
					<input type="text" maxlength="50" required="required" class="form-control" name="agencia" value="<?=post('agencia', $conta->agencia); ?>">
				</div>

				<div class="col-md-3 form-group">
					<label>Conta *</label>
					<input type="text" maxlength="75" required="required" class="form-control" name="cc" value="<?=post('cc', $conta->cc); ?>">
				</div>
				
				<div class="col-md-3 form-group">
					<label>CNPJ/CPF *</label>
					<input type="text" maxlength="150" required="required" class="form-control" name="cnpj" value="<?=post('cnpj', $conta->cnpj); ?>">
				</div>
			</div>
			
			<div class="row hidden-print">
				<div class="col-md-4 col-md-offset-8">
					<button type="submit" class="btn btn-success pull-right">
						 <span class="glyphicon glyphicon-ok"></span> Salvar
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$("#contas-form").validate();
	
</script>