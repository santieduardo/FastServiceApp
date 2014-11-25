<?php
$url = $this->uri->segment(1);
$title = isset($title) ? $title . ' - Fast Service App' : 'Fast Service App';

?><!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title><?=$title; ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="imagetoolbar" content="no">
<meta name="google" content="notranslate">
<meta name="content-language" content="pt-br">

<link rel="shortcut icon" type="image/png" href="<?=base_url('favicon.png'); ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/main.css'); ?>">

<script type="text/javascript">var URL = {base: '<?=base_url(); ?>',site: '<?=site_url(); ?>',current: '<?=current_url(); ?>'};</script>
<script type="text/javascript" src="<?=base_url('assets/js/jquery-1.11.1.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/maskedinput.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/validate.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/main.js'); ?>"></script>

<!--[if lt IE 9]><script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>
<body>
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">Toggle</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=site_url(); ?>">Fast Service App</a>
    	</div>
		
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="<?=$url == 'catalogo' ? 'active' : ''; ?>"><a href="<?=site_url('catalogo'); ?>">Catálogo</a></li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<?php if(isLogged()){ ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?=getUserNome(); ?>
							<img src="<?=avatar_url(); ?>" class="img-thumbnail pull-right" width="32" height="32">
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?=site_url('conta/detalhes'); ?>">Detalhes</a></li>
							<li><a href="<?=site_url('conta/logoff'); ?>">Sair</a></li>
							
						</ul>
					</li>
				<?php } else { ?>
					<li class="dropdown">
						<a href="<?=site_url('conta/login'); ?>" class="dropdown-toggle">
							Login
							<img src="<?=avatar_url(false); ?>" class="img-thumbnail pull-right" width="32" height="32">
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?=site_url('conta/detalhes'); ?>">Detalhes</a></li>
							<li><a href="<?=site_url('conta/logoff'); ?>">Sair</a></li>
							
						</ul>
					</li>
				<?php } ?>
			</ul>
		</div>
    </div>
</nav>

<div class="container">