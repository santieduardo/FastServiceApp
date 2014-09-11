<?php
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	
	include "classeBD.php";
	
	FuncoesBD::conectar();
	FuncoesBD::logar($email, $senha);

?>