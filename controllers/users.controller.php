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

				$encrypt = crypt($_POST["loginPassword"], '$2a$07$usesomesillystringforsalt$');				

			  	// 2. the input in the placeholdr user is then to b compared to the user column in the database
			  
			  	$table = "users";
			  	$item = "user";
			  	$value = $_POST["loginUser"];
			  	$answer = UsersModel::mdlShowUsers($table, $item, $value);

			  	// var_dump($answer["user"]

			  	// 3. this condition defines the behaviour of the page if there's no value or wrong values are input in the login page vs the database

					if($answer["user"] == $_POST["loginUser"] && $answer["password"] == $encrypt){

					  // this is from tempplate.php under \views\plugins
					  
					  if($answer["status"] == 1){
						  
						$_SESSION["startSession"] = "ok";
						$_SESSION["id"] = $answer["id"];
						$_SESSION["name"] = $answer["name"]; 
						$_SESSION["user"] = $answer["user"];
						$_SESSION["profile"] = $answer["profile"];
						$_SESSION["photo"] = $answer["photo"];

				/*=============================================
								Last Login
				=============================================*/

				date_default_timezone_set("Asia/Singapore");
				
				$date = date('Y-m-d');
				$hour = date('H:i:s');

				$actualDate = $date.' '.$hour;

				$item1 = "lastLogin";
				$value1 = $actualDate;

				$item2 = "id";
				$value2 = $answer["id"];

				$lastLogin = UsersModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);

					if($lastLogin == "ok"){


						echo '<script>
  
						window.location = "home";
  
						</script>';

					}

					  } else {

						echo '<br><div class="alert alert-danger">The user is not activated yet</div>';
					  }

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

					$picsFolder = "views/img/users/".$_POST["newUser"];

					mkdir($picsFolder, 0755);
						
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

							$table = "users";

							$encrypt = crypt($_POST["newPasswd"], '$2a$07$usesomesillystringforsalt$');						
								
							$data = array("name" => $_POST["newName"],
											"user" => $_POST["newUser"],
											"password" => $encrypt,
											"profile" => $_POST["newProfile"],
											"photo" => $photo);

								$answer = UsersModel::mdlAddUser($table, $data);

								if ($answer == "ok") {
				
									echo '<script>
						
									swal({
										type: "success",
										title: "User added succesfully!",
										showConfirmButton: true,
										confirmButtonText: "Close"
			
									}).then(function(result){
			
										if(result.value){
			
											window.location = "users";
										}
			
									});
									
									</script>';
								}


						} else {


							echo '<script>
					
							swal({
								type: "error",
								title: "No especial characters or blank fields",
								showConfirmButton: true,
								confirmButtonText: "Close"
					
								}).then(function(result){
		
									if(result.value){
		
										window.location = "users";
									}
		
								});
							
						</script>';

						}
					}
				}

				/*=============================================
				SHOW USERS
				=============================================*/
				static public function ctrShowUsers($item, $value){

					$table = "users";
					$answer = UsersModel::mdlShowUsers($table, $item, $value);
					return $answer;

				}

				/*=============================================
				EDIT USERS
				=============================================*/
				static public function ctrEditUser(){

					if (isset($_POST["EditUser"])) {

					if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editName"])){

				
					
				// 	else {

				// 		echo '<script>
					
				// 	swal({
				// 		type: "error",
				// 		title: "The name cannot be empty or no especial characters or blank fields",
				// 		showConfirmButton: true,
				// 		confirmButtonText: "Close"
				// 		}).then(function(result){
				// 			if(result.value){
				// 				window.location = "users";
				// 			}
				// 		})
				// </script>';
				// 	}



				/*=============================================
				Image Validation
				=============================================*/

						$photo = $_POST["currentPhoto"];

						if (isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])){

							list($width, $height) = getimagesize($_FILES["editPhoto"]["tmp_name"]);
							
							$newWidth = 500;
							$newHeight = 500;
		
							/*=============================================
							Create the folder location of the photo
							=============================================*/		
		
							$picsFolder = "views/img/users/".$_POST["EditUser"];

							if(!empty($_POST["currentPhoto"])){

								unlink($_POST["currentPhoto"]);

							} else {

								mkdir($picsFolder, 0755);

							}
		
							
								
							if($_FILES["editPhoto"]["type"] == "image/jpeg"){
		
								$randomNumber = mt_rand(100,999);
								
								$photo = "views/img/users/".$_POST["EditUser"]."/".$randomNumber.".jpg";
								
								$srcImage = imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);
								
								$destination = imagecreatetruecolor($newWidth, $newHeight);
		
								imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		
								imagejpeg($destination, $photo);
		
							}
		
							if ($_FILES["editPhoto"]["type"] == "image/png") {
		
								$randomNumber = mt_rand(100,999);
								
								$photo = "views/img/users/".$_POST["EditUser"]."/".$randomNumber.".png";
								
								$srcImage = imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);
								
								$destination = imagecreatetruecolor($newWidth, $newHeight);
		
								imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		
								imagepng($destination, $photo);
							}
						}

						$table = "users";

						if($_POST["editPasswd"] != ""){

						
						if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editPasswd"])) {

							$encrypt = crypt($_POST["editPasswd"], '$2a$07$usesomesillystringforsalt$');
				} 
				
				else {

					echo '<script>
					
					swal({
						type: "error",
						title: "No especial characters or blank in the password field",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "users";
							}

						})
					
				</script>';

				}

			} else {

				$encrypt = $_POST["currentPasswd"];

			}

			$data = array("name" => $_POST["editName"],
						"user" => $_POST["EditUser"],
						"password" => $encrypt,
						"profile" => $_POST["editProfile"],
						"photo" => $photo);

			$answer = UsersModel::mdlEditUser($table, $data);

			if ($answer == "ok") {
				
				echo '<script>
	
				swal({
					type: "success",
					title: "User updated succesfully!",
					showConfirmButton: true,
					confirmButtonText: "Close"

				}).then(function(result){

					if(result.value){

						window.location = "users";
					}

				});
				
				</script>';
			}
			 else {
				echo '<script>
						
				swal({
					type: "error",
					title: "No especial characters in the name or blank field",
					showConfirmButton: true,
					confirmButtonText: "Close"
					 }).then(function(result){
							
						if (result.value) {

							window.location = "users";
						
						}

					});
				
			</script>';
				} 
			}
		}
	}

	/*=============================================
				DELETE USER
	=============================================*/

	static public function ctrDeleteUser(){

		if(isset($_GET["userId"])){
			

			$table ="users";
			$data = $_GET["userId"];
			
			if($_GET["userPhoto"] != ""){

				unlink($_GET["userPhoto"]);				
				rmdir('views/img/users/'.$_GET["username"]);

			}
			
			$answer = UsersModel::mdlDeleteUser($table, $data);
			

			if($answer == "ok"){
				console.log("answer", answer);

				echo'<script>

				swal({
					  type: "success",
					  title: "The user has been succesfully deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close"

					  }).then(function(result){
					  	
						if (result.value) {

						window.location = "users";

						}
					})

				</script>';

			}	
		}

	}

}





	
