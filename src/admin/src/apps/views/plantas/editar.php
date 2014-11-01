<h4 class="page-header">Plantas - <small>Editar</small></h4>
<div class="row hidden-print">
	<div class="col-md-12">
		<div class="btn-group">
			<a href="<?=site_url('plantas'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-chevron-left"></span> Voltar
			</a>
		</div>
	</div>
</div>
<br>

<form action="<?=site_url('plantas/editar/' . $planta->id_planta); ?>" method="post" id="plantas-form">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Cliente / Fornecedor *</label>
					<select name="id_cliente" class="form-control" required="required">
						<option value="">Selecione um cliente</option>
						<?php
							foreach($clientes as $cliente){
								if(post('id_cliente', $planta->id_cliente) == $cliente->id_cliente){
									echo '<option value="',$cliente->id_cliente,'" selected>',$cliente->nome,'</option>';
								} else {
									echo '<option value="',$cliente->id_cliente,'">',$cliente->nome,'</option>';
	
								}
							}
						?>
					</select>
				</div>
				
				<div class="col-md-6 form-group">
					<label>Razão Social</label>
					<input type="text" maxlength="200" required="required" class="form-control" name="razao" value="<?=post('razao', $planta->razao); ?>">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Identificação *</label>
					<input type="text" maxlength="100" required="required" class="form-control" name="ide" value="<?=post('ide', $planta->ide); ?>">
				</div>
				
				<div class="col-md-6 form-group">
					<label>CGC *</label>
					<input type="text" maxlength="100" required="required" class="form-control" name="cgc" value="<?=post('cgc', $planta->cgc); ?>">
				</div>
				
			</div>
			
			<div class="row">
				<div class="col-md-4 form-group">
					<label>Inscrição Estadual *</label>
					<input type="text" maxlength="50" required="required" class="form-control" name="ie" value="<?=post('ie', $planta->ie); ?>">
				</div>
				
				<div class="col-md-4 form-group">
					<label>Endereço *</label>
					<input type="text" maxlength="200" required="required" class="form-control" name="endereco" value="<?=post('endereco', $planta->endereco); ?>">
				</div>
				
				<div class="col-md-4 form-group">
					<label>Bairro *</label>
					<input type="text" maxlength="75" required="required" class="form-control" name="bairro" value="<?=post('bairro', $planta->bairro); ?>">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-3 form-group">
					<label>CEP *</label>
					<input type="text" maxlength="75" required="required" class="form-control mask-cep" name="cep" value="<?=post('cep', $planta->cep); ?>">
				</div>
				
				<div class="col-md-3 form-group">
					<label>UF *</label>
					<select name="uf" class="form-control" required="required">
						<option value="">Selecione o Estado</option>
						<?php
							foreach(getEstados() as $estado){
								if(post('uf', $planta->uf) == $estado->uf){
									echo '<option value="',$estado->uf,'" selected>',$estado->uf,' - ',$estado->estado,'</option>';
								} else {
									echo '<option value="',$estado->uf,'">',$estado->uf,' - ',$estado->estado,'</option>';
	
								}
							}
						?>
					</select>
				</div>
				
				<div class="col-md-3 form-group">
					<label>Cidade *</label>
					<input type="text" maxlength="150" required="required" class="form-control" name="cidade" value="<?=post('cidade', $planta->cidade); ?>">
				</div>
				
				<div class="col-md-3 form-group">
					<label>Telefone *</label>
					<input type="text" maxlength="150" required="required" class="form-control" name="tel" value="<?=post('tel', $planta->tel); ?>">
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
	$("#plantas-form").validate();
</script>