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

		$stmt = Connection::connect()->prepare("INSERT INTO $table(code, idPartsUser, idIssuer, parts, tax, netPrice, totalPrice, paymentMethod) VALUES (:code, :idPartsUser, :idIssuer, :parts, :tax, :netPrice, :totalPrice, :paymentMethod)");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idPartsUser", $data["idPartsUser"], PDO::PARAM_INT);
		$stmt->bindParam(":idIssuer", $data["idIssuer"], PDO::PARAM_INT);
		$stmt->bindParam(":parts", $data["parts"], PDO::PARAM_STR);
		$stmt->bindParam(":tax", $data["tax"], PDO::PARAM_STR);
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

}