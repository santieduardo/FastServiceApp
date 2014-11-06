<!DOCTYPE html>
<html lang="pt-BR">
 <head>
 
	<title>Consulta de pedidos</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="apple-touch-icon-precomposed" href="http://localhost/FastServiceApp/src/admin/src/favicon.png">
<link rel="icon" href="http://localhost/FastServiceApp/src/admin/src/favicon.ico">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google" content="notranslate">
<meta name="robots" content="noindex, nofollow">

<link rel="stylesheet" type="text/css" href="C:/xampp/htdocs/FastServiceApp/src/admin/src/assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="C:/xampp/htdocs/FastServiceApp/src/admin/src/assets/css/main.css">

<script type="text/javascript" src="http://localhost/FastServiceApp/src/admin/src/assets/js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="http://localhost/FastServiceApp/src/admin/src/assets/js/bootstrap.js"></script>
<script type="text/javascript" src="http://localhost/FastServiceApp/src/admin/src/assets/js/plugins/maskedinput.js"></script>
<script type="text/javascript" src="http://localhost/FastServiceApp/src/admin/src/assets/js/plugins/validate.js"></script>
<script type="text/javascript" src="http://localhost/FastServiceApp/src/admin/src/assets/js/main.js"></script>

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
	 <li class="dropdown">
	  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedido <span class="caret"></span></a>
	   <ul class="dropdown-menu" role="menu">
		<li><a href="<a href="http://localhost/FastServiceApp/src/admin/src/index.php/descontos">Fazer Pedido</a></li>
		<li><a href="<a href="http://localhost/FastServiceApp/src/admin/src/index.php/descontos">Consultar Pedido</a></li>
	   </ul>
	  </li>		
		<li><a href="http://localhost/FastServiceApp/src/admin/src/index.php/logoff">Sair</a></li>	
	 </ul>
		<p class="navbar-text navbar-right hidden-xs hidden-sm">Logado como Eduardo Santi</p>
	</div>
   </div>
 </nav>
 
<div class="container-fluid">
	<div class="row">
	<div class="col-md-3">
		<div class="col-sm-3 col-md-2 sidebar hidden-print">
			<div class="row">
	<div class="col-md-12 text-center">
		<a href="<?=site_url('views/pedidos/novo'); ?>" class="thumbnail">
			<span class="glyphicon glyphicon-plus-sign"></span>
			<br>
			Fazer Pedido
		</a>
	</div>
</div>	

<div class="row">
	<div class="col-md-12 text-center">
		<a href="<?=site_url('views/pedidos/lista'); ?>" class="thumbnail">
			<span class="glyphicon glyphicon-refresh"></span>
			<br>
			Consultar Pedido
		</a>
	</div>
</div>	


<div class="row">
	<div class="col-md-12 text-center">
		<a href="<?=site_url('logoff'); ?>" class="thumbnail">
			<span class="glyphicon glyphicon-log-out"></span>
			<br>
			Sair
		</a>
	</div>
</div>	
		</div>
	
			
<div class="dashboard">
  <div class="col-md-9">
    <h1 style="text-align: center">Consulta de Pedidos
  
    </h1>
    <div class="table-responsive">
      <table class="table">
       <thead> 
	      <tr>
		     <th> Nº </th>
		     <th>Data</th>
		     <th>Cliente</th>
		     <th>Valor Total</th>		
	      </tr>
	  	</thead>	
	  		
	    <tbody>				
		  <tr>	
			 <th> 01 </th>
			 <th> 04/11/2014</th>
			 <th> Cliente 1 </th>
			 <th> 07,50</th>
			 <th> <a href="#" class="btn btn-info btn-lg">
                   <span class="glyphicon glyphicon-zoom-in"> </span>
                  </a>
             </th>			
		  </tr>
										
		  <tr>		
			 <th> 02 </th>
			 <th> 02/11/2014</th>
			 <th> Cliente 2 </th>
			 <th> 05,20</th>
			 <th> <a href="#" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                  </a>
             </th>
		  </tr>
				
		  <tr>
				
			 <th> 03 </th>
			 <th> 01/11/2014</th>
			 <th> Cliente 3 </th>
			 <th> 09,90</th>
			 <th> <a href="#" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-zoom-in">        
                    </span>
                  </a>
             </th>
					
				</tr>
				
				
      </table>
     </div>
    </div>
 </body>
</html>