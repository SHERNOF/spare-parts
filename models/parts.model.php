<?php

require_once "connection.php";

class PartsModel {

    /*=============================================
	SHOW PRODUCTS
    =============================================*/
    
    static public function mdlShowParts ($table, $item, $value){

        if ($item != null){

            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

        } else {

            $stmt = Connection::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();
        
        }

        $stmt -> close();

		$stmt = null;

    } 


}