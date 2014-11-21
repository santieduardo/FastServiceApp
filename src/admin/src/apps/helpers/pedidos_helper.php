<?php
function getStatus($status = false){
	$vetor = array(
		0 => (Object) array('key' => '0', 'classe' => 'danger', 'alt' => 'Cancelado'),
		1 => (Object) array('key' => '1', 'classe' => 'success', 'alt' => 'Concluído'),
		2 => (Object) array('key' => '2', 'classe' => 'warning', 'alt' => 'Aberto')
	);
	
	if($status){
		foreach($vetor as $s)
			if($s->key == $status) return $s;

		return null;
	} else
		return $vetor;
}