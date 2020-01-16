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
						  title: "The customer has been saved",
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
						  title: "¡Customer cannot be blank or especial characters!",
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

}