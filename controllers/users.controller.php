<?php

class ControllerUsers {
	
	/*=============================================
						USER LOGIN
	=============================================*/
	
	static public function ctrUserLogin (){

		if (isset($_POST["loginUser"])) {

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

			  		// this is from tempplate.php under \views\plugins

			  		$_SESSION["startSession"] = "ok";
			  		echo '<script>

			  		window.location = "home";

			  		</script>';



			  	} else {
			  		echo '<br><div class="alert alert-danger">Login error, please try again</div>';
			  	}
			}
		}
	}
				/*=============================================
				CREATE USER
				=============================================*/

				static public function ctrCreateUser() {

					if (isset($_POST["newUser"])) {

						if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
							preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
							preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPasswd"])){

				/*=============================================
				Image Validation
				=============================================*/		
				$photo = "";
				
				if (isset($_FILES["newPhoto"]["tmp_name"])){

					list($width, $height) = getimagesize($_FILES["newPhoto"]["tmp_name"]);
					
					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					Create the folder location of the photo
					=============================================*/		

					// $photoDirectory = "views/img/users/".$_POST["newUser"];
					// $folder = "views/img/users/".$_POST["newUser"];
					

					// mkdir($folder, 0755);

					// $folder = "views/img/users/".$_POST["newUser"];

					// mkdir($folder, 0755);

					$folder = "views/img/users/".$_POST["newUser"];

					mkdir($folder, 0755);

					// if($_FILES["newPhoto"]["type"] == "image/png"){

						// $randomNumber = mt_rand(100,999);

						// $route = "views/img/users/".$_POST["newUser"]."/".$randomNumber.".jpg";

						/*=============================================
						Image trim
						=============================================*/	

						// $source = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);

						// $destination = imagecreatetruecolor($newWidth, $newHeight);

						// imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						/*=============================================
						Saving the photo
						=============================================*/	

						// imagepng($destination, $route);

					// 	$randomNumber = mt_rand(100,999);
						
					// 	$photo = "views/img/users/".$_POST["newUser"]."/".$randomNumber.".png";
						
					// 	$srcImage = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);
						
					// 	$destination = imagecreatetruecolor($newWidth, $newHeight);

					// 	imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

					// 	imagepng($destination, $photo);

					// }
						
					if($_FILES["newPhoto"]["type"] == "image/jpeg"){

						$randomNumber = mt_rand(100,999);
						
						$photo = "views/img/users/".$_POST["newUser"]."/".$randomNumber.".jpg";
						
						$srcImage = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);
						
						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destination, $photo);

					}

					if ($_FILES["newPhoto"]["type"] == "image/png") {

						$randomNumber = mt_rand(100,999);
						
						$photo = "views/img/users/".$_POST["newUser"]."/".$randomNumber.".png";
						
						$srcImage = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);
						
						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destination, $photo);
					}
				}

						// 	$table = "users";
								
						// 	$data = array("name" => $_POST["newName"],
						// 					"user" => $_POST["newUser"],
						// 					"password" => $_POST["newPasswd"],
						// 					"profile" => $_POST["newProfile"]);

						// 		$answer = UsersModel::mdlAddUser($table, $data);

						// 		if ($answer == "ok") {
				
						// 			echo '<script>
						
						// 			swal({
						// 				type: "success",
						// 				title: "¡User added succesfully!",
						// 				showConfirmButton: true,
						// 				confirmButtonText: "Close"
			
						// 			}).then(function(result){
			
						// 				if(result.value){
			
						// 					window.location = "users";
						// 				}
			
						// 			});
									
						// 			</script>';
						// 		}


						// } else {


						// 	echo '<script>
					
						// 	swal({
						// 		type: "error",
						// 		title: "No especial characters or blank fields",
						// 		showConfirmButton: true,
						// 		confirmButtonText: "Close"
					
						// 		}).then(function(result){
		
						// 			if(result.value){
		
						// 				window.location = "users";
						// 			}
		
						// 		});
							
						// </script>';

						}
					}
				}
			}
