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
	// // 		    $order = "id";

				$getPart = PartsModel::mdlShowParts($tableParts, $item, $valuePartId);

	// // 			// sales is from parts table column
				$item1a = "sales";
				$value1a = $value["quantity"] + $getPart["sales"];

			    $Withdrawal = PartsModel::mdlUpdatePart($tableParts, $item1a, $value1a, $valuePartId);

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
						   "tax"=>$_POST["newTaxPrice"],
						   "netPrice"=>$_POST["newNetPrice"],
						   "totalPrice"=>$_POST["saleTotal"],
						   "paymentMethod"=>$_POST["listPaymentMethod"]);

			$answer = ModelWithdrawal::mdlAddWithdrawal($table, $data);

			if($answer == "ok"){

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


}