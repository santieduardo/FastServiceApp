<h4 class="page-header">Clientes / Fornecedores - <small>Cadastrar</small></h4>
<div class="row hidden-print">
	<div class="col-md-12">
		<div class="btn-group">
			<a href="<?=site_url('clientes'); ?>" class="btn btn-default">
				 <span class="glyphicon glyphicon-chevron-left"></span> Voltar
			</a>
		</div>
	</div>
</div>
<br>

<form action="<?=site_url('clientes/novo'); ?>" method="post" id="cliente-form">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Nome Fantasia *</label>
					<input type="text" maxlength="200" required="required" class="form-control" name="nome" value="<?=post('nome'); ?>">
				</div>
				
				<div class="col-md-6 form-group">
					<label>Razão Social *</label>
					<input type="text" maxlength="200" required="required" class="form-control" name="razao" value="<?=post('razao'); ?>">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 form-group">
					<label>CNPJ *</label>
					<input type="text" maxlength="50" required="required" class="form-control mask-cnpj" name="cnpj" value="<?=post('cnpj'); ?>">
				</div>
				
				<div class="col-md-6 form-group">
					<label>Inscrição Estadual *</label>
					<input type="text" maxlength="50" required="required" class="form-control" name="ie" value="<?=post('ie'); ?>">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Endereço *</label>
					<input type="text" maxlength="200" required="required" class="form-control" name="endereco" value="<?=post('endereco'); ?>">
				</div>
				
				<div class="col-md-3 form-group">
					<label>CEP *</label>
					<input type="text" maxlength="20" required="required" class="form-control mask-cep" name="cep" value="<?=post('cep'); ?>">
				</div>
				
				<div class="col-md-3 form-group">
					<label>UF *</label>
					<select name="uf" class="form-control" required="required">
						<option value="">Selecione o Estado</option>
						<?php
							foreach(getEstados() as $estado){
								if(post('uf') == $estado->uf){
									echo '<option value="',$estado->uf,'" selected>',$estado->uf,' - ',$estado->estado,'</option>';
								} else {
									echo '<option value="',$estado->uf,'">',$estado->uf,' - ',$estado->estado,'</option>';
	
								}
							}
						?>
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Cidade *</label>
					<input type="text" maxlength="200" required="required" class="form-control" name="cidade" value="<?=post('cidade'); ?>">
				</div>
			
				<div class="col-md-6 form-group">
					<label>Bairro *</label>
					<input type="text" maxlength="150" required="required" class="form-control" name="bairro" value="<?=post('bairro'); ?>">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Telefone *</label>
					<input type="text" maxlength="30" required="required" class="form-control" name="tel" value="<?=post('tel'); ?>">
				</div>
				
				<div class="col-md-6 form-group">
					<label>Limite de Cédito *</label>
					<input type="text" maxlength="13" required="required" class="form-control" name="limite" value="<?=post('limite', '10000000'); ?>">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-8 form-group">
					<label>Endereço de Cobrança *</label>
					<input type="text" maxlength="255" required="required" class="form-control" name="end_cob" value="<?=post('end_cob', 'O mesmo'); ?>">
				</div>
				
				<div class="col-md-4 form-group">
					<label>SIF</label>
					<input type="text" maxlength="20" class="form-control" name="sif" value="<?=post('sif'); ?>">
				</div>
			</div>
			
			<div class="row hidden-print">
				<div class="col-md-4 col-md-offset-8">
					<button type="submit" class="btn btn-success pull-right">
						 <span class="glyphicon glyphicon-ok"></span> Cadastrar
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$("#cliente-form").validate();
	
</script>