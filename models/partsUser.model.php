<?php

require_once "connection.php";

class ModelpartsUser{

    /*=============================================
	CREATE PARTS USER
    =============================================*/
    
    static public function mdlAddpartsUser($table, $data){

        $stmt = Connection::connect()->prepare("INSERT INTO $table(name, idDocument, email, phone, address, birthdate) VALUES (:name, :idDocument, :email, :phone, :address, :birthdate)");

        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt->bindParam(":idDocument", $data["idDocument"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":phone", $data["phone"], PDO::PARAM_STR);
		$stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
        $stmt->bindParam(":birthdate", $data["birthdate"], PDO::PARAM_STR);
        
        if($stmt->execute()){

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
	SHOW Parts User
	=============================================*/

	static public function mdlShowpartsUser($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


}