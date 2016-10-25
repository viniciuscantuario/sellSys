<?php 

	require_once "Crud.php";

	class Register extends Crud	{

		function __construct() {
			if (isset($_POST['send_stock'])) {
				$price_in = $_POST['price_in'];
				$price_out = $_POST['price_out'];

				$price_in = str_replace(',', '.', $price_in);
				$price_out = str_replace(',', '.', $price_out);

				$this->setStock($_POST['code'], $_POST['brand'], $_POST['model'], $_POST['type'], $_POST['amount'], $price_in, $price_out, $_POST['description']);
			}

			if (isset($_POST['update_stock'])) {
				$price_in = $_POST['price_in'];
				$price_out = $_POST['price_out'];

				$price_in = str_replace(',', '.', $price_in);
				$price_out = str_replace(',', '.', $price_out);
				
				$this->updateStock($_POST['id'], $_POST['code'], $_POST['brand'], $_POST['model'], $_POST['type'], $_POST['amount'], $price_in, $price_out, $_POST['description']);		
			}

			if (isset($_POST['send_customer'])) {
				$this->setCustomer($_POST['name'], $_POST['cpf'], $_POST['phone'], $_POST['birthday'], $_POST['address'], $_POST['city']);
			}

			if (isset($_POST['update_customer'])) {
				$this->updateCustomer($_POST['id'], $_POST['name'], $_POST['cpf'], $_POST['phone'], $_POST['birthday'], $_POST['address'], $_POST['city'], $_POST['country']);
			}
		}

		public function setStock($code, $brand, $model, $type, $amount, $price_in, $price_out, $description) {
			$sql = "INSERT INTO stock (`code`,`brand`,`model`,`type`,`amount`,`price_in`,`price_out`,`description`,`date`) VALUES (:code, :brand, :model, :type, :amount, :price_in, :price_out, :description, NOW())";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(":code", $code);
			$stmt->bindParam(":brand", $brand);
			$stmt->bindParam(":model", $model);
			$stmt->bindParam(":type", $type);
			$stmt->bindParam(":amount", $amount);
			$stmt->bindParam(":price_in", $price_in);
			$stmt->bindParam(":price_out", $price_out);
			$stmt->bindParam(":description", $description);
			if ($stmt->execute()){
				echo "<script>alert('Produto inserido com sucesso!')</script>";
			}	
		}

		public function getStockSummary() {
			$sql = "SELECT * FROM stock ORDER BY id DESC LIMIT 8";
			$stmt = DB::prepare($sql);
			$stmt->execute();
			$stmt = $stmt->fetchAll();

			foreach ($stmt as $key => $value) {
				$price_in = str_replace('.', ',', $value->price_in);
				$price_out = str_replace('.', ',', $value->price_out);
		
				echo "<tr>
						<td>",$value->code,"</td>
						<td>",$value->amount,"</td>
						<td>",$value->brand,"</td>
						<td>",$value->type,"</td>
						<td>",$value->model,"</td>
						<td>R$ ",$price_in,"</td>
						<td>R$ ",$price_out,"</td>
						<td>",$value->description,"</td>
						<td>",$value->date,"</td>
						<td><a class='btn btn-default' data-toggle='modal' data-target='#",$value->id,"' style='width:100%'>Editar</a></td>
					  </tr>

					  <div class='modal fade' id='",$value->id,"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
  						<div class='modal-dialog' role='document'>
    						<div class='modal-content'>
      							<div class='modal-header'>
        							<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        							<h4 class='modal-title' id='myModalLabel'>Editar produto ",$value->code,"</h4>
      							</div>
      							<div class='modal-body'>
					      			<form method='post' action=''>
					      				<input name='id' value='",$value->id,"' hidden>

									    <div class='input-group input-group-lg'>
											<span class='input-group-addon'>Codigo do produto</span>
											<input type='text' name='code' class='form-control' value='",$value->code,"'  style='width:100%;' onkeyup='maskIt(this,event,'##########')' placeholder='",$value->code,"' required>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon' >Quantidade</span>
											<input type='text' name='amount' class='form-control' value='",$value->amount,"' style='width:100%;' onkeyup='maskIt(this,event,'####')' placeholder='",$value->amount,"' required>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon' >Marca</span>
											<input type='text' name='brand' class='form-control' style='width:100%;' value='",$value->brand,"' placeholder='",$value->brand,"' required>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>Tipo</span>
											<input type='text' name='type' class='form-control' value='",$value->type,"' placeholder='",$value->type,"' style='width:100%;'>
										</div><br>
											
										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>Modelo</span>
											<input type='text' name='model' class='form-control' value='",$value->model,"' placeholder='",$value->model,"' style='width:100%;'>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>Valor da Entrada</span>
											<input type='text' name='price_in' class='form-control' value='",$price_in,"' style='width:100%;' onkeyup='maskIt(this,event,'###.###.###,##',true)' placeholder='",$price_in,"' required>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>Valor de Venda</span>
											<input type='text' name='price_out' class='form-control' style='width:100%;' value='",$price_out,"' onkeyup='maskIt(this,event,'###.###.###,##',true)' placeholder='",$price_out,"' required>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>Descrição</span>
											<input type='text' name='description' class='form-control' value='",$value->description,"' placeholder='",$value->description,"' style='width:100%;'>
										</div> 
										<hr>
										<button type='submit' class='btn btn-success btn-large pull-right' name='update_stock' value='update_stock'>Atualizar</button>
										<button type='button' class='btn btn-danger btn-large pull-left' data-dismiss='modal' aria-label='Close'>Cancelar</button>
								</form>
       							</div>
      							<br><br>
						    </div>
						</div>
					  </div>";
			}
		} 

		public function updateStock($id, $code, $brand, $model, $type, $amount, $price_in, $price_out, $description) {
			$sql = "UPDATE stock SET code = :code, brand = :brand, model = :model, type = :type, amount = :amount, price_in = :price_in, price_out = :price_out, description = :description WHERE id = :id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(":id", $id);
			$stmt->bindParam(":code", $code);
			$stmt->bindParam(":brand", $brand);
			$stmt->bindParam(":model", $model);
			$stmt->bindParam(":type", $type);
			$stmt->bindParam(":amount", $amount);
			$stmt->bindParam(":price_in", $price_in);
			$stmt->bindParam(":price_out", $price_out);
			$stmt->bindParam(":description", $description);
			if ($stmt->execute()){
				echo "<script>alert('Atualizado com sucesso!')</script>";
			}
		}

		public function setCustomer($name, $cpf, $phone, $birthday, $address, $city) {
			$sql = "INSERT INTO `customers`(`id`, `name`, `cpf`, `phone`, `birthday`, `address`, `city`, `country`, `date`) VALUES (NULL, :name, :cpf, :phone, :birthday, :address, :city, 'Brasil', NOW() )";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':cpf', $cpf);
			$stmt->bindParam(':phone', $phone);
			$stmt->bindParam(':birthday', $birthday);
			$stmt->bindParam(':address', $address);
			$stmt->bindParam(':city', $city);
			if ($stmt->execute()){
				echo "<script>alert('Cliente cadastrado com sucesso!')</script>";
			}
		}

		public function getCustomerSummary() {
			$sql = "SELECT * FROM customers ORDER BY id DESC LIMIT 8";
			$stmt = DB::prepare($sql);
			$stmt->execute();
			$stmt = $stmt->fetchAll();

			foreach ($stmt as $key => $value) {
		
				echo "<tr>
						<td>",$value->name,"</td>
						<td>",$value->cpf,"</td>
						<td>",$value->phone,"</td>
						<td>",$value->birthday,"</td>
						<td>",$value->address,"</td>
						<td>",$value->city,"</td>
						<td>",$value->country,"</td>
						<td>",$value->date,"</td>
						<td><a class='btn btn-default' data-toggle='modal' data-target='#",$value->id,"' style='width:100%'>Editar</a></td>
					  </tr>

					  <div class='modal fade' id='",$value->id,"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
  						<div class='modal-dialog' role='document'>
    						<div class='modal-content'>
      							<div class='modal-header'>
        							<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        							<h4 class='modal-title' id='myModalLabel'>Editar ",$value->name,"</h4>
      							</div>
      							<div class='modal-body'>
					      			<form method='post' action=''>
					      				<input name='id' value='",$value->id,"' hidden>

									    <div class='input-group input-group-lg'>
											<span class='input-group-addon'>Nome</span>
											<input type='text' name='name' class='form-control' value='",$value->name,"'  style='width:100%;' placeholder='",$value->name,"' required>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>CPF</span>
											<input type='text' name='cpf' class='form-control' value='",$value->cpf,"' style='width:100%;' onkeyup='maskIt(this,event,'###.###.###-##')' placeholder='",$value->cpf,"' required>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon' >Telefone</span>
											<input type='text' name='phone' class='form-control' style='width:100%;' value='",$value->phone,"' placeholder='",$value->phone,"' required>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>Aniversario</span>
											<input type='date' name='birthday' class='form-control' value='",$value->birthday,"' placeholder='",$value->birthday,"' style='width:100%;'>
										</div><br>
											
										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>Endereço</span>
											<input type='text' name='address' class='form-control' value='",$value->address,"' placeholder='",$value->address,"' style='width:100%;'>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>Cidade</span>
											<input type='text' name='city' class='form-control' value='",$value->city,"' style='width:100%;' placeholder='",$value->city,"' required>
										</div> <br>

										<div class='input-group input-group-lg'>
											<span class='input-group-addon'>País</span>
											<input type='text' name='country' class='form-control' style='width:100%;' value='" ,$value->country,"' placeholder='",$value->country,"' required>
										</div> <br>

										<hr>
										<button type='submit' class='btn btn-success btn-large pull-right' name='update_customer' value='update_customer'>Atualizar</button>
										<button type='button' class='btn btn-danger btn-large pull-left' data-dismiss='modal' aria-label='Close'>Cancelar</button>
								</form>
       							</div>
      							<br><br>
						    </div>
						</div>
					  </div>";
			}
		}

		public function updateCustomer($id, $name, $cpf, $phone, $birthday, $address, $city, $country) {
			$sql = "UPDATE customers SET name = :name, cpf = :cpf, phone = :phone, birthday = :birthday, address = :address, city = :city, country = :country WHERE id = :id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(":id", $id);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':cpf', $cpf);
			$stmt->bindParam(':phone', $phone);
			$stmt->bindParam(':birthday', $birthday);
			$stmt->bindParam(':address', $address);
			$stmt->bindParam(':city', $city);
			$stmt->bindParam(':country', $country);
			if ($stmt->execute()){
				echo "<script>alert('Atualizado com sucesso!')</script>";
			}
		}

	}


