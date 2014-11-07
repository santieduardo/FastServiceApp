<h4 class="page-header">Novo Pedido</h4>
<div class="col-md-6">
	<h4 style="text-align: center">Produtos</h4>
	<br>
	<div class="row">
		<form role="form" method="get" action="<?=site_url('pedidos'); ?>">
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
				<?php for($i = 0; $i < 10; $i++){ ?>	  
				<tr>			
					<td>Produto 2</td>
					<td>R$ 2,50</td>
					<td class="text-right" width="200">
						<form action="" method="post">
							<input type="hidden" value="1" name="produtoId">
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
		</tbody>
	  </table>	
	</div>
	
	<div class="row hidden-print">
		<div class="col-md-12">
			<?=$pagination; ?>
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
			     <th>Valor</th>
			     <th></th>
		      </tr>
		  	</thead>		  		
		    <tbody>				
				<?php for($i = 0; $i < 10; $i++){ ?>	  
				<tr>			
					<td>Produto 2</td>
					<td>02,50</td>			 
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
		</tbody>
	  </table>	
	</div>
</div>
