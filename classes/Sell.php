<?php 

	require_once "Crud.php";

	class Sell extends Crud	{
		
		function __construct() {
			session_start();

			if (isset($_POST['add_product'])) {
				$code = $_POST['new_product'];
				$sell_number = $_SESSION['session'];

				$insert_prod = "INSERT INTO `sales`(`sell_number`, `customer_id`, `stock_id`, `amount`) VALUES ('$sell_number', '1', (SELECT id FROM stock WHERE code = '$code'), '1')";
				$stmt = DB::prepare($insert_prod);
				$stmt->execute();
			}

			if (isset($_POST['open_sell'])) {
				$client = $_POST['client'];
				$session = uniqid();
				$_SESSION['session'] = $session;
				$_SESSION['client'] = $client;
			}

			if (isset($_POST['cancel_sell'])) {
				$sell_number = $_SESSION['session'];
				$cancel_sell = "DELETE FROM sales WHERE sell_number = '$sell_number'";
				$stmt = DB::prepare($cancel_sell);
				$stmt->execute();
				session_destroy();
			}
		}

		public function dashboard() {
			$sql = "SELECT * FROM customers WHERE cpf = :client OR name = :client";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':client', $_SESSION['client']);
			$stmt->execute();
			$stmt = $stmt->fetch();

			if (session_status() == "2" AND isset($_SESSION['client'])) {
				echo '<div class="col-md-3 pull-left">
						<div class="openSell">
							<form method="post">
								<div class="form-group form-group-lg" style="width: 100%;">
									<h3 class="text-center" style="color: #808080;">Venda aberta: ' . $_SESSION['session'] . '</h3>
									<input class="form-control" type="text" name="new_product" placeholder="Cod. do produto" autofocus>
								</div>
								<input type="submit" name="add_product" hidden>
							</form>
						</div>
					</div>
					<div class="col-md-6">
						<div class="clientSummary">
							<h3 style="margin-top: 0px;">Cliente: ' . $stmt->name . '</h3>
							<h4>CPF: ' . $stmt->cpf . '</h4>
							<h4>Telefone: ' . $stmt->phone . '</h4>
						</div>
					</div>';
			} else {
				echo '<div class="col-md-3 pull-left">
						<div class="openSell">
							<form method="post">
								<div class="form-group form-group-lg" style="width: 100%;">
									<input class="form-control" type="text" name="client" placeholder="Nome ou CPF" required autofocus>
									<h3 class="text-center" style="color: #808080;"><i class="fa fa-arrow-up" aria-hidden="true"></i> Digite CPF ou nome do cliente</h3>
								</div>
								<input type="submit" name="open_sell" hidden>
							</form>
						</div>
					</div>
					<div class="col-md-6">
						<div class="clientSummary">

						</div>
					</div>';
			}
		}

		public function birthday() {
			$sql = "SELECT id, name, DATE_FORMAT(birthday,'%d %b') AS birthday FROM customers WHERE (concat_ws('-',year(now()),month(birthday),day(birthday)) >= NOW() and concat_ws('-',year(now()),month(birthday),day(birthday))<=DATE_ADD(NOW(),INTERVAL 60 DAY)) or (DAY(birthday) = DAY(CURDATE()) AND MONTH(birthday) = MONTH(CURDATE())) ORDER BY birthday LIMIT 3";
			$stmt = DB::prepare($sql);
			$stmt->execute();
			$stmt = $stmt->fetchAll();

			if (empty($stmt)) {

				echo '<table class="table table-bordered">
						<h3 class="text-center" style="margin-top: 40px; color: #808080;">Sem Aniversários nos próximos 2 meses</h3>
					</table>';

			} else {

				foreach ($stmt as $key => $value) {
					echo '<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 80px;">Aniv.</th>
									<th>Cliente</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>' . $value->birthday . '</th>
									<th>' . $value->name . '</th>
								</tr>
							</tbody>
						</table>'; 
				}
			}
		}

		public function products() {

			if (session_status() == "2" AND isset($_SESSION['client'])) {
				$sell_number = $_SESSION['session'];

				$sql = "SELECT `sales`.*, `stock`.`code`, `stock`.`model`, `stock`.`brand`,  `stock`.`type`,  `stock`.`price_out` FROM sales INNER JOIN stock ON `sales`.`stock_id` = `stock`.`id` WHERE sell_number = '$sell_number' ORDER BY `sales`.`id` DESC";
				$stmt = DB::prepare($sql);
				$stmt->execute();
				$stmt = $stmt->fetchAll();

				echo '<div class="tableProd"><table class="table table-striped">
  						<thead>
  							<tr>
  								<th>Cod. Prod</th>
  								<th>Produto</th>
  								<th>Marca</th>
  								<th>Qtd</th>
  								<th>Preço und.</th>
  								<th>Total</th>
  								<th>Del</th>
  							</tr>
  						</thead>
  						<tbody>';

				foreach ($stmt as $key => $value) {
					$price_total = $value->price_out * $value->amount;

					echo '	<tr>
								<th>' . $value->code . '</th>
  								<th>' . $value->model . '</th>
  								<th>' . $value->brand . '</th>
  								<th>' . $value->amount . '</th>
  								<th>' . $value->price_out . '</th>
  								<th>' . $price_total . '</th>
  								<th>X</th>
  							</tr>';
				}

				echo '</tbody></table></div>
				<form method="post" style="position: absolute; bottom: 15px; ">
					<input class="btn btn-lg btn-danger" type="submit" name="cancel_sell" value="Cancelar">
				</form>
				<form method="post" style="position: absolute; bottom: 15px; right: 35px;">
					<input class="btn btn-lg btn-success" type="submit" name="close_sell" value="Fechar Venda">
				</form>';

		}
	
	}

}