<?php

require_once 'connection.php';

class ModelWithdrawal {

    /*=============================================
	SHOWING WITHDRAWAL
	=============================================*/

	static public function mdlShowWithdrawal($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTERING WITHDRAWAL
	=============================================*/

	static public function mdlAddWithdrawal($table, $data){

		// $stmt = Connection::connect()->prepare("INSERT INTO $table(code, idPartsUser, idIssuer, parts, tax, netPrice, totalPrice, paymentMethod) VALUES (:code, :idPartsUser, :idIssuer, :parts, :tax, :netPrice, :totalPrice, :paymentMethod)");
		$stmt = Connection::connect()->prepare("INSERT INTO $table(code, idPartsUser, idIssuer, parts, disc, netPrice, totalPrice, paymentMethod) VALUES (:code, :idPartsUser, :idIssuer, :parts, :disc, :netPrice, :totalPrice, :paymentMethod)");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idPartsUser", $data["idPartsUser"], PDO::PARAM_INT);
		$stmt->bindParam(":idIssuer", $data["idIssuer"], PDO::PARAM_INT);
		$stmt->bindParam(":parts", $data["parts"], PDO::PARAM_STR);
		// $stmt->bindParam(":tax", $data["tax"], PDO::PARAM_STR);
		$stmt->bindParam(":disc", $data["disc"], PDO::PARAM_STR);
		$stmt->bindParam(":netPrice", $data["netPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":totalPrice", $data["totalPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":paymentMethod", $data["paymentMethod"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDIT WITHDRAWAL
	=============================================*/

	static public function mdlEditWithdrawal($table, $data){

		// $stmt = Connection::connect()->prepare("UPDATE $table SET idPartsUser = :idPartsUser, idIssuer = :idIssuer, parts = :parts, tax = :tax, netPrice = :netPrice, totalPrice = :totalPrice, paymentMethod = :paymentMethod WHERE code = :code");
		$stmt = Connection::connect()->prepare("UPDATE $table SET idPartsUser = :idPartsUser, idIssuer = :idIssuer, parts = :parts, disc = :disc, netPrice = :netPrice, totalPrice = :totalPrice, paymentMethod = :paymentMethod WHERE code = :code");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idPartsUser", $data["idPartsUser"], PDO::PARAM_INT);
		$stmt->bindParam(":idIssuer", $data["idIssuer"], PDO::PARAM_INT);
		$stmt->bindParam(":parts", $data["parts"], PDO::PARAM_STR);
		// $stmt->bindParam(":tax", $data["tax"], PDO::PARAM_STR);
		$stmt->bindParam(":disc", $data["disc"], PDO::PARAM_STR);
		$stmt->bindParam(":netPrice", $data["netPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":totalPrice", $data["totalPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":paymentMethod", $data["paymentMethod"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	DELETE SALE
	=============================================*/

	static public function mdlDeleteWithdrawal($table, $data){

		$stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $data, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	DATES RANGE
	=============================================*/	

	static public function mdlWithdrawalDatesRange($table, $initialDate, $finalDate){

		if($initialDate == null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($initialDate == $finalDate){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE withdrawalDate like '%$finalDate%'");

			$stmt -> bindParam(":withdrawalDate", $finalDate, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$actualDate = new DateTime();
			$actualDate ->add(new DateInterval("P1D"));
			$actualDatePlusOne = $actualDate->format("Y-m-d");

			$finalDate2 = new DateTime($finalDate);
			$finalDate2 ->add(new DateInterval("P1D"));
			$finalDatePlusOne = $finalDate2->format("Y-m-d");

			if($finalDatePlusOne == $actualDatePlusOne){

				$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE withdrawalDate BETWEEN '$initialDate' AND '$finalDatePlusOne'");

			}else{


				$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE withdrawalDate BETWEEN '$initialDate' AND '$finalDate'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}
			/*=============================================
			Adding TOTAL sales
			=============================================*/

			static public function mdlAddingTotalSales($table){	

				$stmt = Connection::connect()->prepare("SELECT SUM(netPrice) as total FROM $table");

				$stmt -> execute();

				return $stmt -> fetch();

				$stmt -> close();

				$stmt = null;

			}

}