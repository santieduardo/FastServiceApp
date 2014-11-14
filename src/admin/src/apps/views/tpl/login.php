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
<script type="text/javascript" src="<?=base_url('assets/js/plugins/validate.js'); ?>"></script>

<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<div class="navbar-brand">Fast Service App</div>
		</div>
	</div>
</div>
<div class="container">
	<h1 class="page-header text-center">Acesso Restrito</h1>
	
	<?php if($this->input->get('logoff')){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Fechar</span>
					</button>
					Você saiu do sistema com sucesso. 
			    </div>
			</div>
		</div>
	<?php } ?>

	<?php if($erro){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Fechar</span>
					</button>
					<?=$erro; ?>
			    </div>
			</div>
		</div>
	<?php } ?>

	<form action="<?=site_url('login'); ?>" method="post" id="login-form">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 form-group">
				<label class="control-label">Usuário</label>
				<input type="usuario" name="text" class="form-control" required="required" maxlength="16">
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4 col-md-offset-4 form-group">
				<label class="control-label">Senha</label>
				<input type="password" name="senha" class="form-control" required="required" maxlength="16">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<button type="submit" class="btn btn-success pull-right">
					 <span class="glyphicon glyphicon-log-in"></span> Acessar
				</button>
			</div>
		</div>
		<input type="hidden" name="return" value="<?=$this->input->get_post('return', true); ?>">
	</form>
</div>

<script type="text/javascript">

	$("#login-form").validate();

</script>

</body>
</html>