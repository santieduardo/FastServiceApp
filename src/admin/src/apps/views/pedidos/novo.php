<h4 class="page-header">Novo Pedido</h4>
<div class="col-md-6">
	<h4 style="text-align: center">Produtos</h4>
	<br>
	<div class="row">
		<form role="form" method="get" action="<?=site_url('pedidos/novo'); ?>">
			<div class="input-group">
				<input type="text" class="form-control" name="term" value="<?=$this->input->get('term'); ?>" placeholder="Procurar...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
		</form>
	</div>
	<br>
	<div class="row">
	    <table class="table table-striped table-bordered">    
	       <thead>       
		      <tr>
			     <th>Produto</th>
			     <th colspan="2">Valor Unitário</th>
		      </tr>
		  	</thead>		  		
		    <tbody>
		    	<?php if(sizeof($pedidos) > 0){ ?>
					<?php foreach($pedidos as $row){ ?>
		    			<tr>
		    				<td><?=$row->nome; ?></td>
		    				<td><?=$row->preco; ?></td>
		    				<td class="text-right" width="200">
								<form action="<?=site_url('pedidos/addCarrinho'); ?>" method="post">
									<input type="hidden" value="<?=$row->idProduto; ?>" name="produtoId">
									<div class="col-md-8">
										<input type="number" value="1" name="qtd" min="0" class="form-control">
									</div>
									<button type="submit" class="btn btn-default col-md-4">
										<span class="glyphicon glyphicon-arrow-right"></span>
									</button>
								</form>
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
	</div>
	
	<div class="row hidden-print">
		<div class="col-md-12">
			<!-- <?=$pagination; ?> -->
		</div>
	</div>
</div>

<div class="col-md-1"></div>

<div class="col-md-5"> <!--  REVER MD -->
	<h4 style="text-align: center">Pedido</h4>
	<br>
	<div class="row">
	    <table class="table table-striped table-bordered">    
	       <thead>       
		      <tr>
			     <th>Produto</th>
			     <th>Valor unit</th>
			     <th>Qtd</th>
			     <th></th>
		      </tr>
		  	</thead>		  		
		    <tbody>				
				<?php if(sizeof($pedidosAdd) > 0){ ?>
					<?php foreach($pedidosAdd as $linha){ ?>
				<tr>			
					<td><?=$linha->nome; ?></td>
		    		<td><?=$linha->preco; ?></td>
		    		<td><?=$qtd; ?></td>
					<td class="text-right">
						<form action="">
							<input type="number" value="1" name="qtd" min="0">
							<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-arrow-right"></span>
							</button>
						</form>
					</td>					
			  </tr>
			  <?php } ?>
		<?php } ?>
		</tbody>
	  </table>	
	</div>
</div>
