<?php include 'classes/Sell.php';  $sell = new Sell(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>
	<div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation">
	    <div class="container-fluid">
	        <div class="navbar-header"><a class="navbar-brand" href="#">sellSys</a>
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	            </button>
	        </div>
	        <div class="collapse navbar-collapse navbar-menubuilder">
	            <ul class="nav navbar-nav navbar-right ">
	            	<li class="active"><a href="#">Iniciar Venda</a></li>
	                <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="customer.php">Cliente</a></li>
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
			<?php echo $sell->dashboard(); ?>
			<div class="col-md-3 pull-right">
				<div class="birthday">
					<?php echo $sell->birthday(); ?>
				</div>
			</div>
		</div>

		<div class="sellTable">
			<div class="container-fluid">
				<?php echo $sell->products(); ?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/mask.js"></script>
</body>
</html>