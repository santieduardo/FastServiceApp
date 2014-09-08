
<form role="form" method="get" action="<?=site_url(); ?>">
	<input type="hidden" name="c" value="<?=$catId; ?>">
	<div class="input-group">
		<input type="text" class="form-control" name="q" value="<?=$search; ?>">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit">Procurar</button>
		</span>
	</div>
</form>
<br>
<ol class="breadcrumb">
	<?php
	if(empty($catId)){
		echo '<li class="active">Todas</li>';
	} else {
		echo '<li><a href="',site_url(),'">Todas</a></li>';
	}
	
	foreach($categorias as $rows){
		if($catId == $rows->idCategoria){
			echo '<li class="active">',$rows->nome,'</li>';
		} else {
			echo '<li><a href="',site_url('?c=' .$rows->idCategoria),'">',$rows->nome,'</a></li>';
		}
	}
	?>
</ol>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>Nome</td>
			<td>Categoria</td>
			<td>Preço Unitário</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($produtos as $rows){ ?>
			<tr>
				<td><?=$rows->nome; ?></td>
				<td><?=$rows->categoria; ?></td>
				<td>R$ <?=number_format($rows->preco, 2, ',', ' '); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>