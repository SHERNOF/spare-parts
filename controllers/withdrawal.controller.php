<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


class ControllerWithdrawal{

    /*=============================================
	SHOW WITHDRAWAL
	=============================================*/

	static public function ctrShowWithdrawal($item, $value){

		$table = "withdrawal";

		$answer = ModelWithdrawal::mdlShowWithdrawal($table, $item, $value);

		return $answer;

	}

/*=============================================
	CREATE WITHDRAWAL
	=============================================*/

	static public function ctrCreateWithdrawal(){

		if(isset($_POST["newWithdrawal"])){

			/*=============================================
			UPDATE partsUser'S PURCHASES AND REDUCE THE STOCK AND INCREASE SALES OF THE PRODUCT
			=============================================*/

			$partsList = json_decode($_POST["partsList"], true);

			$totalWithdrawnParts = array();

			foreach ($partsList as $key => $value) {

			   array_push($totalWithdrawnParts, $value["quantity"]);
				
			   $tableParts = "parts";

			    $item = "id";
			    $valuePartId = $value["id"];
			    $order = "id";

				$getPart = PartsModel::mdlShowParts($tableParts, $item, $valuePartId, $order);

	// // 			// sales is from parts table column
				$item1a = "sales";
				$value1a = $value["quantity"] + $getPart["sales"];

			    $newWithdrawals = PartsModel::mdlUpdatePart($tableParts, $item1a, $value1a, $valuePartId);

				$item1b = "stock";
				$value1b = $value["stock"];

				$newStock = PartsModel::mdlUpdatePart($tableParts, $item1b, $value1b, $valuePartId);

			}

			$tablepartsUser  = "partsuser";

			$itempartsUser = "id";
			$valuepartsUser = $_POST["selectpartsUser"];
			
			$getpartsUser = ModelpartsUser::mdlShowpartsUser ($tablepartsUser , $itempartsUser, $valuepartsUser);		
			// var_dump($getpartsUser);

			$item1a = "partsWithdrawn";
			$value1a = array_sum($totalWithdrawnParts) + $getpartsUser["partsWithdrawn"];

			$partsUserWithdrawn = ModelpartsUser::mdlUpdatepartsUser($tablepartsUser , $item1a, $value1a, $valuepartsUser);
			

			$item1b = "lastWithdrawn";

			date_default_timezone_set('America/Bogota');

			$date = date('Y-m-d');
			$hour = date('H:i:s');
			$value1b = $date.' '.$hour;

			$datepartsUser = ModelpartsUser::mdlUpdatepartsUser($tablepartsUser , $item1b, $value1b, $valuepartsUser);

			/*=============================================
			SAVE THE SALE
			=============================================*/	

			$table = "withdrawal";

			$data = array("idIssuer"=>$_POST["idIssuer"],
						   "idPartsUser"=>$_POST["selectpartsUser"],
						   "code"=>$_POST["newWithdrawal"],
						   "parts"=>$_POST["partsList"],
						//    "tax"=>$_POST["newTaxPrice"],
						"disc"=>$_POST["newDiscPrice"],
						   "netPrice"=>$_POST["newNetPrice"],
						   "totalPrice"=>$_POST["saleTotal"],
						   "paymentMethod"=>$_POST["listPaymentMethod"]);

			$answer = ModelWithdrawal::mdlAddWithdrawal($table, $data);

			if($answer == "ok"){

				$printer = "POS-58-Series"; //windows

				// $printer = "Thermal Printer H58 Printer USB";//MAC

				$connector = new WindowsPrintConnector($printer);

				$printer = new Printer($connector);

				// $printer -> text("Heloo World"."\n");

				// $printer -> cut();

				// $printer -> close();
				
				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text(date("Y-m-d H:i:s")."\n");//Invoice date

				$printer -> feed(1); //We feed paper 1 time*/

				$printer -> text("JMSA Pharmacy"."\n");//Company name

				$printer -> text("ID: 71.759.963-9"."\n");//Company's 

				$printer -> text("Address: Pila, Laguna"."\n");//Company address

				$printer -> text("Phone: 639567297076"."\n");//Company's phone

				$printer -> text("Invoice N.".$_POST["newWithdrawal"]."\n");//Invoice number

				$printer -> feed(1); //We feed paper 1 time*/

				$printer -> text("Customer: ".$getpartsUser["name"]."\n");//Customer's name

				$tableSeller = "users";
				$item = "id";
				$seller = $_POST["idIssuer"];

				$getIssuer = UsersModel::MdlShowUsers($tableSeller, $item, $seller);

				$printer -> text("Seller: ".$getIssuer["name"]."\n");//Seller's name

				$printer -> feed(1); //We feed paper 1 time*/

				foreach ($partsList as $key => $value) {

					$printer->setJustification(Printer::JUSTIFY_LEFT);

					$printer->text($value["description"]."\n");//Product's name

					$printer->setJustification(Printer::JUSTIFY_RIGHT);

					$printer->text("$ ".number_format($value["price"],2)." Und x ".$value["quantity"]." = $ ".number_format($value["totalPrice"],2)."\n");

				}

				$printer -> feed(1); //We feed paper 1 time*/			
				
				$printer->text("NET: $ ".number_format($_POST["newNetPrice"],2)."\n"); //net price

				$printer->text("TAX: $ ".number_format($_POST["newTaxPrice"],2)."\n"); //tax value
				$printer->text("DISCOUNT: $ ".number_format($_POST["newDiscPrice"],2)."\n"); //tax value

				$printer->text("--------\n");

				$printer->text("TOTAL: $ ".number_format($_POST["saleTotal"],2)."\n"); //ahora va el total

				$printer -> feed(1); //We feed paper 1 time*/	

				$printer->text("Thanks for your purchase"); //We can add a footer

				$printer -> feed(3); //We feed paper 3 times*/

				$printer -> cut(); //We cut the paper, if the printer has the option

				$printer -> pulse(); //Through the printer we send a pulse to open the cash drawer.

				$printer -> close(); 

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "The sale has been succesfully added",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "withdrawn";

								}
							})

				</script>';

			}

		}

	}


	/*=============================================
	EDIT WITHDRAWAL
	=============================================*/

	static public function ctrEditWithdrawal(){
// test
		if(isset($_POST["editWithdrawal"])){

			/*=============================================
			FORMAT PRODUCTS AND partsUserS TABLES
			=============================================*/
			$table = "withdrawal";

			$item = "code";
			$value = $_POST["editWithdrawal"];

			$getWithdrawal = ModelWithdrawal::mdlShowWithdrawal($table, $item, $value);


			/*=============================================
			CHECK IF THERE'S ANY EDITED SALE
			=============================================*/

			if($_POST["partsList"] == ""){

				$partsList = $getWithdrawal["parts"];
				$partChange = false;

			}else{

				$partsList = $_POST["partsList"];
				$partChange = true;
				
			}

			if($partChange){

			$parts = json_decode($getWithdrawal["parts"], true);

			$totalWithdrawnParts = array();

			foreach ($parts as $key => $value) {

				array_push($totalWithdrawnParts, $value["quantity"]);

				$tableParts = "parts";

				$item = "id";
				$valuePartId = $value["id"];
			    $order = "id";

				$getPart = PartsModel::mdlShowParts($tableParts, $item, $valuePartId, $order);

				// sales is from parts table column
				$item1a = "sales";
				$value1a = $getPart["sales"] - $value["quantity"];

			    $newWithdrawals = PartsModel::mdlUpdatePart($tableParts, $item1a, $value1a, $valuePartId);


				$item1b = "stock";
				$value1b = $value["quantity"] + $getPart["stock"];

				$newStock = PartsModel::mdlUpdatePart($tableParts, $item1b, $value1b, $valuePartId);

			}

			$tablepartsUser  = "partsuser";

			$itempartsUser = "id";
			$valuepartsUser = $_POST["selectpartsUser"];
			
			$getpartsUser = ModelpartsUser::mdlShowpartsUser ($tablepartsUser , $itempartsUser, $valuepartsUser);		

			$item1a = "partsWithdrawn";
			$value1a = $getpartsUser["partsWithdrawn"] - array_sum($totalWithdrawnParts) ;

			$partsUserWithdrawn = ModelpartsUser::mdlUpdatepartsUser($tablepartsUser , $item1a, $value1a, $valuepartsUser);


			/*=============================================
			UPDATE partsUser'S PURCHASES AND REDUCE THE STOCK AND INCREASE SALES OF THE PRODUCT
			=============================================*/

			
			$partsList2 = json_decode($partsList, true);

			$totalWithdrawnParts2 = array();

			foreach ($partsList2 as $key => $value) {

			   array_push($totalWithdrawnParts2, $value["quantity"]);
				
			   $tableParts2 = "parts";

			    $item2 = "id";
			    $valuePartId2 = $value["id"];
			    $order = "id";

				$getPart2 = PartsModel::mdlShowParts($tableParts2, $item2, $valuePartId2, $order);

	// // 			// sales is from parts table column
				$item1a2 = "sales";
				$value1a2 = $value["quantity"] + $getPart2["sales"];

			    $newWithdrawals2 = PartsModel::mdlUpdatePart($tableParts2, $item1a2, $value1a2, $valuePartId2);

				$item1b2 = "stock";
				$value1b2 = $value["stock"];

				$newStock2 = PartsModel::mdlUpdatePart($tableParts2, $item1b2, $value1b2, $valuePartId2);

			}

			$tablepartsUser2  = "partsuser";

			$itempartsUser2 = "id";
			$valuepartsUser2 = $_POST["selectpartsUser"];
			
			$getpartsUser2 = ModelpartsUser::mdlShowpartsUser ($tablepartsUser2, $itempartsUser2, $valuepartsUser2);		
			// var_dump($getpartsUser);

			$item1a2 = "partsWithdrawn";
			$value1a2 = array_sum($totalWithdrawnParts2) + $getpartsUser2["partsWithdrawn"];

			$partsUserWithdrawn2 = ModelpartsUser::mdlUpdatepartsUser($tablepartsUser2, $item1a2, $value1a2, $valuepartsUser2);
			

			$item1b2 = "lastWithdrawn";

			date_default_timezone_set('America/Bogota');

			$date = date('Y-m-d');
			$hour = date('H:i:s');
			$value1b2 = $date.' '.$hour;

			$datepartsUser2 = ModelpartsUser::mdlUpdatepartsUser($tablepartsUser2, $item1b2, $value1b2, $valuepartsUser2);

		}

			/*=============================================
			SAVE THE WITHDRAWAL CHANGES
			=============================================*/	

			// $table = "withdrawal";

			$data = array("idIssuer"=>$_POST["idIssuer"],
						   "idPartsUser"=>$_POST["selectpartsUser"],
						   "code"=>$_POST["editWithdrawal"],
						   "parts"=>$partsList,
						//    "tax"=>$_POST["newTaxPrice"],
						   "disc"=>$_POST["newDiscPrice"],
						   "netPrice"=>$_POST["newNetPrice"],
						   "totalPrice"=>$_POST["saleTotal"],
						   "paymentMethod"=>$_POST["listPaymentMethod"]);

			$answer = ModelWithdrawal::mdlEditWithdrawal($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "The withdrawal has been succesfully added",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "withdrawn";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	Delete Sale
	=============================================*/

	 static public function ctrDeleteWithdrawal(){


		if(isset($_GET["idWithdrawal"])){

			$table = "withdrawal";

			$item = "id";
			$value = $_GET["idWithdrawal"];

			$getSale = ModelWithdrawal::mdlShowWithdrawal($table, $item, $value);


			/*=============================================
			Update last Purchase date
			=============================================*/

			$tablepartsUsers = "partsUser";

			$itemsales = null;
			$valuesales = null;

			$getSales = ModelWithdrawal::mdlShowWithdrawal($table, $itemsales, $valuesales);

			$saveDates = array();

			

			foreach ($getSales as $key => $value){

				if ($value["idPartsUser"] == $getSale["idPartsUser"]){

					array_push($saveDates, $value["withdrawalDate"]);

				}
			}

				if(count($saveDates) > 1){

							if($getSale["withdrawalDate"] > $saveDates[count($saveDates)-2]){
			
								$item = "lastWithdrawn";
								$value = $saveDates[count($saveDates)-2];
								$valueIdpartsUser = $getSale["idPartsUser"];
			
								$partsUserPurchases = ModelpartsUser::mdlUpdatepartsUser($tablepartsUsers, $item, $value, $valueIdpartsUser);
			
						}else{
							$item = "lastWithdrawn";
							$value = $saveDates[count($saveDates)-1];
							$valueIdpartsUser = $getSale["idPartsUser"];

							$partsUserPurchases = ModelpartsUser::mdlUpdatepartsUser($tablepartsUsers, $item, $value, $valueIdpartsUser);

						}

						}else{
			
							$item = "lastWithdrawn";
							$value = "0000-00-00 00:00:00";
							$valueIdpartsUser = $getSale["idPartsUser"];
			
							$partsUserPurchases = ModelpartsUser::mdlUpdatepartsUser($tablepartsUsers, $item, $value, $valueIdpartsUser);
							var_dump($partsUserPurchases);
			
			}

							/*=============================================
							FORMAT PRODUCTS AND partsUserS TABLE
					 		=============================================*/
							$parts = json_decode($getSale["parts"], true);

							$totalWithdrawnParts = array();
				
							foreach ($parts as $key => $value) {
				
								array_push($totalWithdrawnParts, $value["quantity"]);
				
								$tableParts = "parts";
				
								$item = "id";
								$valuePartId = $value["id"];
								$order = "id";
				
								$getPart = PartsModel::mdlShowParts($tableParts, $item, $valuePartId, $order);
				
								// sales is from parts table column
								$item1a = "sales";
								$value1a = $getPart["sales"] - $value["quantity"];
				
								$newWithdrawals = PartsModel::mdlUpdatePart($tableParts, $item1a, $value1a, $valuePartId);
				
				
								$item1b = "stock";
								$value1b = $value["quantity"] + $getPart["stock"];
				
								$newStock = PartsModel::mdlUpdatePart($tableParts, $item1b, $value1b, $valuePartId);
				
							}
				
							$tablepartsUser  = "partsuser";
				
							$itempartsUser = "id";
							$valuepartsUser = $getSale["idPartsUser"];
							
							$getpartsUser = ModelpartsUser::mdlShowpartsUser ($tablepartsUser , $itempartsUser, $valuepartsUser);		
				
							$item1a = "partsWithdrawn";
							$value1a = $getpartsUser["partsWithdrawn"] - array_sum($totalWithdrawnParts) ;
				
							$partsUserWithdrawn = ModelpartsUser::mdlUpdatepartsUser($tablepartsUser , $item1a, $value1a, $valuepartsUser);

							/*=============================================
							Delete Sale
							=============================================*/

							$answer = ModelWithdrawal::mdlDeleteWithdrawal($table, $_GET["idWithdrawal"]);

							if($answer == "ok"){

								echo'<script>

								swal({
									  type: "success",
									  title: "The sale has been deleted succesfully",
									  showConfirmButton: true,
									  confirmButtonText: "Close",
									  closeOnConfirm: false
									  }).then((result) => {
												if (result.value) {

												window.location = "withdrawn";

												}
											})

								</script>';

							}		
						}

					}

	/*=============================================
	DATES RANGE
	=============================================*/	

	static public function ctrWithdrawalDatesRange($initialDate, $finalDate){

		$table = "withdrawal";

		$answer = ModelWithdrawal::mdlWithdrawalDatesRange($table, $initialDate, $finalDate);

		return $answer;
		
	}

	/*=============================================
	DOWNLOAD EXCEL
	=============================================*/

	public function ctrDownloadReport(){

		if(isset($_GET["report"])){

			$table = "withdrawal";

			if(isset($_GET["initialDate"]) && isset($_GET["finalDate"])){

				$sales = ModelWithdrawal::mdlWithdrawalDatesRange($table, $_GET["initialDate"], $_GET["finalDate"]);

			}else{

				$item = null;
				$value = null;

				$sales = ModelWithdrawal::mdlShowWithdrawal($table, $item, $value);

			}

			/*=============================================
			WE CREATE EXCEL FILE
			=============================================*/

			$name = $_GET["report"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Excel file
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CODE</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>partsUser</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Issuer</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Quantity</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Parts</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Discount</td>

					<td style='font-weight:bold; border:1px solid #eee;'>netPrice</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO Of Payment</td	
					<td style='font-weight:bold; border:1px solid #eee;'>Date</td>		
					</tr>");


					foreach ($sales as $row => $item){


					$partsUser = ControllerpartsUser::ctrShowpartsUser("id", $item["idPartsUser"]);
					$vendedor = ControllerUsers::ctrShowUsers("id", $item["idIssuer"]);


					echo utf8_decode("<tr>
					<td style='border:1px solid #eee;'>".$item["code"]."</td> 
					<td style='border:1px solid #eee;'>".$partsUser["name"]."</td>
					<td style='border:1px solid #eee;'>".$vendedor["name"]."</td>
					<td style='border:1px solid #eee;'>");
					
					$products =  json_decode($item["parts"], true);

					foreach ($products as $key => $valueproducts) {
			 			
						echo utf8_decode($valueproducts["quantity"]."<br>");

					}

					echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

					foreach ($products as $key => $valueproducts) {
							
					echo utf8_decode($valueproducts["description"]."<br>");
					
					}

					echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["disc"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["netPrice"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["totalPrice"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["paymentMethod"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["withdrawalDate"],0,10)."</td>		
		 			</tr>");

					}

					}

					echo "</table>";
		}

				/*=============================================
				Adding TOTAL sales (netPrice column)
				=============================================*/

				public function ctrAddingTotalSales(){

					$table = "withdrawal";

					$answer = ModelWithdrawal::mdlAddingTotalSales($table);

					return $answer;

				}
	}

