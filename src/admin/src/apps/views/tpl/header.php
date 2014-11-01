<!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title>Fast Service App</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="apple-touch-icon-precomposed" href="<?=base_url('favicon.png'); ?>">
<link rel="icon" href="<?=base_url('favicon.ico'); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google" content="notranslate">
<meta name="robots" content="noindex, nofollow">

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/main.css'); ?>">

<script type="text/javascript" src="<?=base_url('assets/js/jquery-1.11.1.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/maskedinput.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/validate.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/main.js'); ?>"></script>
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>


<nav class="navbar navbar-default navbar navbar-fixed-top hidden-print" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<!-- Novo -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedido <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<a href="<?=site_url('descontos'); ?>">Fazer Pedido</a></li>
						<li><a href="<a href="<?=site_url('descontos'); ?>">Consultar Pedido</a></li>
						
					</ul>
				</li>		
				<li><a href="<?=site_url('logoff'); ?>">Sair</a></li>	
			</ul>
			<p class="navbar-text navbar-right hidden-xs hidden-sm">Logado como <?=ucfirst($this->user->getUsername()); ?></p>
		</div>
	</div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar hidden-print">
			<?=$this->load->view('tpl/sidebar'); ?>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<?php displayAlert(); ?>
