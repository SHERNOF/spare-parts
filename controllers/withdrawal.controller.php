<?php

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
	CREATE SALE
	=============================================*/

	static public function ctrCreateWithdrawal(){

		if(isset($_POST["newWithdrawal"])){

			/*=============================================
			UPDATE CUSTOMER'S PURCHASES AND REDUCE THE STOCK AND INCREASE SALES OF THE PRODUCT
			=============================================*/

			$partsList = json_decode($_POST["partsList"], true);

			var_dump($partsList);

	// 		$totalPurchasedProducts = array();

	// 		foreach ($productsList as $key => $value) {

	// 		   array_push($totalPurchasedProducts, $value["quantity"]);
				
	// 		   $tableProducts = "products";

	// 		    $item = "id";
	// 		    $valueProductId = $value["id"];
	// 		    $order = "id";

	// 		    $getProduct = ProductsModel::mdlShowProducts($tableProducts, $item, $valueProductId, $order);

	// 			$item1a = "sales";
	// 			$value1a = $value["quantity"] + $getProduct["sales"];

	// 		    $newSales = ProductsModel::mdlUpdateProduct($tableProducts, $item1a, $value1a, $valueProductId);

	// 			$item1b = "stock";
	// 			$value1b = $value["stock"];

	// 			$newStock = ProductsModel::mdlUpdateProduct($tableProducts, $item1b, $value1b, $valueProductId);

	// 		}

	// 		$tableCustomers = "customers";

	// 		$item = "id";
	// 		$valueCustomer = $_POST["selectCustomer"];

	// 		$getCustomer = ModelCustomers::mdlShowCustomers($tableCustomers, $item, $valueCustomer);

	// 		$item1a = "purchases";
	// 		$value1a = array_sum($totalPurchasedProducts) + $getCustomer["purchases"];

	// 		$customerPurchases = ModelCustomers::mdlUpdateCustomer($tableCustomers, $item1a, $value1a, $valueCustomer);

	// 		$item1b = "lastPurchase";

	// 		date_default_timezone_set('America/Bogota');

	// 		$date = date('Y-m-d');
	// 		$hour = date('H:i:s');
	// 		$value1b = $date.' '.$hour;

	// 		$dateCustomer = ModelCustomers::mdlUpdateCustomer($tableCustomers, $item1b, $value1b, $valueCustomer);

	// 		/*=============================================
	// 		SAVE THE SALE
	// 		=============================================*/	

	// 		$table = "sales";

	// 		$data = array("idSeller"=>$_POST["idSeller"],
	// 					   "idCustomer"=>$_POST["selectCustomer"],
	// 					   "code"=>$_POST["newSale"],
	// 					   "products"=>$_POST["productsList"],
	// 					   "tax"=>$_POST["newTaxPrice"],
	// 					   "netPrice"=>$_POST["newNetPrice"],
	// 					   "totalPrice"=>$_POST["saleTotal"],
	// 					   "paymentMethod"=>$_POST["listPaymentMethod"]);

	// 		$answer = ModelSales::mdlAddSale($table, $data);

	// 		if($answer == "ok"){

	// 			echo'<script>

	// 			localStorage.removeItem("range");

	// 			swal({
	// 				  type: "success",
	// 				  title: "The sale has been succesfully added",
	// 				  showConfirmButton: true,
	// 				  confirmButtonText: "Cerrar"
	// 				  }).then((result) => {
	// 							if (result.value) {

	// 							window.location = "sales";

	// 							}
	// 						})

	// 			</script>';

	// 		}

		}

	}


}