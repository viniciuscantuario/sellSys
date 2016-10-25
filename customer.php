<?php require_once "classes/Register.php"; $customer = new Register(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body style="background-color: #f8f8f8;">

<div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation" style="margin-bottom:0px;">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="/Sellsys">SellSys</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-right ">
            	<li><a href="index.php">Iniciar Venda</a></li>
                <li class="dropdown active">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li class="active"><a href="customer.php">Cliente</a></li>
		            <li><a href="stock.php">Estoque</a></li>
		            <!--li><a href="#">Fornecedor</a></li-->
		          </ul>	
		        </li>
                <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relatorios <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Vendas</a></li>
		            <li><a href="#">Estoque</a></li>
		          </ul>
		        </li>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h2 class="text-center">Cadastro de Estoque</h2>
			<form method="post" action=""> 
			    <div class="input-group input-group-lg">
					<span class="input-group-addon" >Nome</span>
					<input type="text" name="name" class="form-control" style="width:100%;" autofocus required >
				</div> <br>

				<div class="input-group input-group-lg">
					<span class="input-group-addon" >CPF</span>
					<input type="text" name="cpf" class="form-control" style="width:100%;" onkeyup="maskIt(this,event,'###.###.###-##')" required>
				</div> <br>

				<div class="input-group input-group-lg">
					<span class="input-group-addon" >Telefone</span>
					<input type="text" name="phone" class="form-control" style="width:100%;" onkeyup="maskIt(this,event,'(##)#####-####')" required>
				</div> <br>

				<div class="input-group input-group-lg">
					<span class="input-group-addon">Aniversario</span>
					<input type="date" name="birthday" class="form-control"  style="width:100%;" required>
				</div><br>
					
				<div class="input-group input-group-lg">
					<span class="input-group-addon">Endereço</span>
					<input type="text" name="address" class="form-control" style="width:100%;" required>
				</div> <br>

				<div class="input-group input-group-lg">
					<span class="input-group-addon">Cidade</span>
					<input type="text" name="city" class="form-control" style="width:100%;" required>
				</div> <br>

				<button type="submit" class="btn btn-success btn-large pull-right" name="send_customer" value="enviar">Enviar</button>
			</form>
		</div>

		<div class="col-md-8" style="padding-left:0px; padding-right:15px;">
			<h3 class="text-center">Estoque<a class="btn btn-large btn-info pull-right" href="">Todos clientes</a></h3>
			<table class="table table-hover">
			  <thead>
			  	<tr>
			  	 <th>Nome</th>
			  	 <th>CPF</th>
			  	 <th>Telefone</th>
			  	 <th>Aniversario</th>
			  	 <th>Endereço</th>
			  	 <th>Cidade</th>
			  	 <th>País</th>
			  	 <th>Data cadastro</th>
			  	 <th></th>
			  	</tr>
			  </thead>
			  <tbody>
			  	<?php $customer->getCustomerSummary(); ?>
			  </tbody>
			</table>	
		</div>

	</div>
</div>

<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/mask.js"></script>
</body>
</html>
