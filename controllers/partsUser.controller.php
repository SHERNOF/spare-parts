<?php

class ControllerpartsUser{

    static public function ctrCreatepartsUser(){

        if(isset($_POST["newpartsUser"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newpartsUser"]) &&
            preg_match('/^[0-9]+$/', $_POST["newIdDocument"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["newEmail"]) && 
            preg_match('/^[()\-0-9 ]+$/', $_POST["newPhone"]) && 
            preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["newAddress"])){

                $table = "partsUser";

                $data = array("name"=>$_POST["newpartsUser"],
					           "idDocument"=>$_POST["newIdDocument"],
					           "email"=>$_POST["newEmail"],
					           "phone"=>$_POST["newPhone"],
					           "address"=>$_POST["newAddress"],
                               "birthdate"=>$_POST["newBirthdate"]);
                               
                $answer = ModelpartsUser::mdlAddpartsUser($table, $data);

                if($answer == "ok"){

                    echo'<script>

					swal({
						  type: "success",
						  title: "The custpart user has been saved",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "partsUser";

									}
								})

					</script>';

                }

        } else {

            echo'<script>

					swal({
						  type: "error",
						  title: "Sherwin Part User cannot be blank or especial characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "partsUser";

							}
						})

			  	</script>';


            }

        }

    }

    /*=============================================
	SHOW PartsUser
	=============================================*/

	static public function ctrShowpartsUser($item, $value){

		$table = "partsUser";

		$answer = ModelpartsUser::mdlShowpartsUser($table, $item, $value);

		return $answer;

    }

    /*=============================================
	Edit Parts User
	=============================================*/

    static public function ctrEditpartsUser(){

        if(isset($_POST["editpartsUser"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editpartsUser"]) &&
            preg_match('/^[0-9]+$/', $_POST["editIdDocument"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editEmail"]) && 
            preg_match('/^[()\-0-9 ]+$/', $_POST["editPhone"]) && 
            preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editAddress"])){

                $table = "partsUser";

                $data = array("id"=>$_POST["idpartsUser"],
                                "name"=>$_POST["editpartsUser"],
					           "idDocument"=>$_POST["editIdDocument"],
					           "email"=>$_POST["editEmail"],
					           "phone"=>$_POST["editPhone"],
					           "address"=>$_POST["editAddress"],
                               "birthdate"=>$_POST["editBirthdate"]);
                               
                $answer = ModelpartsUser::mdlEditpartsUser($table, $data);

                if($answer == "ok"){

                    echo'<script>

					swal({
						  type: "success",
						  title: "Edit Successful",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
									if (result.value) {

									window.location = "partsUser";

									}
								})

					</script>';

                }

        } else {

            echo'<script>

					swal({
						  type: "error",
						  title: "Parts User cannot be blank or especial characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "partsUser";

							}
						})

			  	</script>';


            }

        }

    }

    /*=============================================
	Delete Parts User
	=============================================*/
    static public function ctrDeletepartsUser(){

		if(isset($_GET["idpartsUser"])){

			$table ="partsUser";
			$data = $_GET["idpartsUser"];

			$answer = ModelpartsUser::mdlDeletepartsUser($table, $data);

			if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "The part user has been deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then(function(result){
								if (result.value) {

								window.location = "partsUser";

								}
							})

				</script>';

			}		

		}

	}
}