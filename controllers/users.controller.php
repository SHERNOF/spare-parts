<?php

class ControllerUsers {
	
	// User Login
	
	
	public function ctrUserLogin (){

		if (isset($_POST["loginUser"])){

			// 1. this defines the characters to be accepted

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginUser"]) && 
			  preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginPassword"])) {

			  	// 2. the input in the placeholdr user is then to b compared to the user column in the database
			  
			  	$table = "users";
			  	$item = "user";
			  	$value = $_POST["loginUser"];
			  	$answer = UsersModel::mdlShowUsers($table, $item, $value);
	

			  	// var_dump($answer["user"]

			  	// 3. this condition defines the behaviour of the page if there's no value or wrong values are input in the login page vs the database

			  	if($answer["user"] == $_POST["loginUser"] && $answer["password"] == $_POST["loginPassword"]){

			  		echo '<br><div class="alert alert-success">You\'re the man!!! Welcome to the system</div>';

			  	} else {
			  		echo '<br><div class="alert alert-danger">Login error, please try again</div>';
			  	}
			}
		}
	}
}