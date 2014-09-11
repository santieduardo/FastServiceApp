<?php
	session_start();
	session_name("secreta");

	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$confirmaSenha = $_POST['confirmasenha'];

	if($senha == $confirmaSenha){
		include "classeBD.php";

		FuncoesBD::conectar();
		FuncoesBD::incluirUsuario($nome, $sobrenome, $email, $senha, $confirmaSenha);
	}else{
		echo "Insira as senhas iguais";
	}
	
?>