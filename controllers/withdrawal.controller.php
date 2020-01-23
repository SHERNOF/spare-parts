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
			UPDATE partsUser'S PURCHASES AND REDUCE THE STOCK AND INCREASE SALES OF THE PRODUCT
			=============================================*/

			$partsList = json_decode($_POST["partsList"], true);

			// var_dump($partsList);

	// 		$totalPurchasedProducts = array();

			foreach ($partsList as $key => $value) {

	// // 		   array_push($totalPurchasedProducts, $value["quantity"]);
				
			   $tableParts = "parts";

			    $item = "id";
			    $valuePartId = $value["id"];
	// 		    $order = "id";

				$getPart = PartsModel::mdlShowParts($tableParts, $item, $valuePartId);
	// 			// $getPart = PartsModel::mdlShowParts($tableParts, $item, $valuePartId, $order);

	// 			// sales is from parts table column
				$item1a = "sales";
				$value1a = $value["quantity"] + $getPart["sales"];

			    $Withdrawal = PartsModel::mdlUpdatePart($tableParts, $item1a, $value1a, $valuePartId);

				$item1b = "stock";
				$value1b = $value["stock"];

				$newStock = PartsModel::mdlUpdatePart($tableParts, $item1b, $value1b, $valuePartId);
				

			// }

			// $tablepartsUser  = "partsuser";

			// $itempartsUser = "id";
			// $valuepartsUser = $_POST["selectpartsUser"];
			
			// $getpartsUser = ModelpartsUser::mdlShowpartsUser ($tablepartsUser , $itempartsUser, $valuepartsUser);		
			// var_dump($getpartsUser);

	// 		$item1a = "purchases";
	// 		$value1a = array_sum($totalPurchasedProducts) + $getpartsUser["purchases"];

	// 		$partsUserPurchases = ModelpartsUser::mdlUpdatepartsUser($table , $item1a, $value1a, $valuepartsUser);

	// 		$item1b = "lastPurchase";

	// 		date_default_timezone_set('America/Bogota');

	// 		$date = date('Y-m-d');
	// 		$hour = date('H:i:s');
	// 		$value1b = $date.' '.$hour;

	// 		$datepartsUser = ModelpartsUser::mdlUpdatepartsUser($table , $item1b, $value1b, $valuepartsUser);

	// 		/*=============================================
	// 		SAVE THE SALE
	// 		=============================================*/	

	// 		$table = "sales";

	// 		$data = array("idSeller"=>$_POST["idSeller"],
	// 					   "idpartsUser"=>$_POST["selectpartsUser"],
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

			}

		}

	}


}