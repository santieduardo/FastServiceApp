<?php
function getStatus($status = false){
	$vetor = array(
		(Object) array('key' => 'true', 'classe' => 'success', 'alt' => 'Aguardando Embarque'),
		(Object) array('key' => 'false', 'classe' => 'danger', 'alt' => 'Pedido Inativo'),
		(Object) array('key' => 'emb', 'classe' => 'warning', 'alt' => 'Embarcado'),
		(Object) array('key' => 'fin', 'classe' => 'info', 'alt' => 'Finalizado')
	);
	
	if($status){
		foreach($vetor as $s)
			if($s->key == $status) return $s;

		return null;
	} else
		return $vetor;
}

function getOrdem(){
	return array(
		0 => 'Pedido',
		1 => 'Cliente - AZ',
		2 => 'Cliente - ZA',
		3 => 'Fornecedor - AZ',
		4 => 'Fornecedor - ZA',
		5 => 'Embarque - AZ',
		6 => 'Embarque - ZA',
		7 => 'Vencimento - AZ',
		8 => 'Vencimento - ZA',
	);
}