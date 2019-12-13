<?php

require_once "connection.php";

class UsersModel{
	/*=============================================
	=            Show Users            =
	=============================================*/
	
	static public function mdlShowUsers($table, $item, $value){
		$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $value, PDO:: PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch(); 

		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
	=            User Registration                =
	=============================================*/

		static public function mdlAddUser($table, $data) {

			$stmt = Connection::connect() -> prepare("INSERT INTO $table(name, user, password, profile) VALUES (:name, :user, :password, :profile)");


			$stmt -> bindParam(":name".$data["name"], PDO:: PARAM_STR);
			$stmt -> bindParam(":user".$data["user"], PDO:: PARAM_STR);
			$stmt -> bindParam(":password".$data["password"], PDO:: PARAM_STR);
			$stmt -> bindParam(":profile".$data["profile"], PDO:: PARAM_STR);

			if ($stmt -> execute()) {

				return 'ok';
			
			} else {

				return 'error';
			}

			$stmt -> close();
			$stmt = null;


		}

}