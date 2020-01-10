<?php

class ControllerParts {

    /*=============================================
	SHOW PARTS
	=============================================*/

    static public function ctrShowParts($item, $value){
		$table = "parts";
		$answer = PartsModel::mdlShowParts($table, $item, $value);
		return $answer;
	}

	/*=============================================
	CREATE PARTS
	=============================================*/

	static public function ctrCreatePart(){
		if(isset($_POST["newDescription"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newDescription"]) &&
			   preg_match('/^[0-9]+$/', $_POST["newStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["newPriceBuy"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["newPriceSell"])){

				/*=============================================
				VALIDATE PicParts
				=============================================*/

				$route = "views/img/parts/default/anonymous.png";

				// $route = "";
			
				if (isset($_FILES["newPicParts"]["tmp_name"])){

					list($width, $height) = getPicPartssize($_FILES["newPicParts"]["tmp_name"]);
					
					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					Let's create the folder for each part
					=============================================*/

					$folder = "views/img/parts/".$_POST["newCode"];

					mkdir($folder, 0755);

					/*=============================================
					PHP functions depending on the PicParts
					=============================================*/

					if($_FILES["newPicParts"]["type"] == "PicParts/jpeg"){

						$randomNumber = mt_rand(100,999);
						
						$route = "views/img/parts/".$_POST["newCode"]."/".$randomNumber.".jpg";
						
						$srcPicParts = PicPartscreatefromjpeg($_FILES["newPicParts"]["tmp_name"]);
						
						$destination = PicPartscreatetruecolor($newWidth, $newHeight);

						PicPartscopyresized($destination, $srcPicParts, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						PicPartsjpeg($destination, $route);

					}

					if ($_FILES["newPicParts"]["type"] == "PicParts/png") {

						$randomNumber = mt_rand(100,999);
						
						$route = "views/img/parts/".$_POST["newCode"]."/".$randomNumber.".png";
						
						$srcPicParts = PicPartscreatefrompng($_FILES["newPicParts"]["tmp_name"]);
						
						$destination = PicPartscreatetruecolor($newWidth, $newHeight);

						PicPartscopyresized($destination, $srcPicParts, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						PicPartspng($destination, $route);
					}
				}	
				
				
				$table = "parts";

				$data = array("idCategory" => $_POST["newCategory"],
					"code" => $_POST["newCode"],
					"description" => $_POST["newDescription"],
					"stock" => $_POST["newStock"],
					"buyingPrice" => $_POST["newPriceBuy"],
					"sellingPrice" => $_POST["newPriceSell"],
					"PicParts" => $route);

					$answer = PartsModel::mdlAddPart($table, $data);

					if($answer == "ok"){

						echo'<script>
	
							swal({
								  type: "success",
								  title: "New Part Added",
								  showConfirmButton: true,
								  confirmButtonText: "Close"
								  }).then(function(result){
											if (result.value) {
	
											window.location = "parts";
	
											}
										})
							</script>';
					}
		} else {

			echo '<script>

					swal({
						  type: "error",
						  title: "Need to enter part name or no special characters",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "parts";
							}
						})
				  </script>';
				}
			}
		}
		

		/*=============================================
		EDIT Part
		=============================================*/

	static public function ctrEditPart(){

		if(isset($_POST["editDescription"])){

			// if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editDescription"]) &&
			//    preg_match('/^[0-9]+$/', $_POST["editStock"]) &&	
			//    preg_match('/^[0-9.]+$/', $_POST["editBuyingPrice"]) &&
			//    preg_match('/^[0-9.]+$/', $_POST["editSellingPrice"])){

				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editDescription"]) &&
				preg_match('/^[0-9]+$/', $_POST["editStock"]) &&	
				preg_match('/^[0-9.]+$/', $_POST["editPriceBuy"]) &&
				preg_match('/^[0-9.]+$/', $_POST["editPriceSell"])){

		   		/*=============================================
				VALIDATE Image
				=============================================*/

			   	$route = $_POST["actualPicParts"];

			   	if(isset($_FILES["editPicParts"]["tmp_name"]) && !empty($_FILES["editPicParts"]["tmp_name"])){

					list($width, $height) = getPicPartssize($_FILES["editPicParts"]["tmp_name"]);

					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					WE CREATE THE FOLDER WHERE WE WILL SAVE THE Part Image
					=============================================*/

					$folder = "views/img/Parts/".$_POST["editCode"];

					/*=============================================
					WE ASK IF WE HAVE ANOTHER PICTURE IN THE DB
					=============================================*/

					if(!empty($_POST["actualPicParts"]) && $_POST["actualPicParts"] != "views/img/Parts/default/anonymous.png"){

						unlink($_POST["actualPicParts"]);

					}else{

						mkdir($folder, 0755);	
					
					}
					
					/*=============================================
					WE APPLY DEFAULT PHP FUNCTIONS ACCORDING TO THE PicParts FORMAT
					=============================================*/

					if($_FILES["editPicParts"]["type"] == "image/jpeg"){

						/*=============================================
						WE SAVE THE PicParts IN THE FOLDER
						=============================================*/

						$random = mt_rand(100,999);

						$route = "views/img/parts/".$_POST["editCode"]."/".$random.".jpg";

						$origin = imagecreatefromjpeg($_FILES["editPicParts"]["tmp_name"]);						

						$destiny = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destiny, $origin,	 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destiny, $route);

					}

					if($_FILES["editPicParts"]["type"] == "image/png"){

						/*=============================================
						WE SAVE THE PicParts IN THE FOLDER
						=============================================*/

						$random = mt_rand(100,999);

						$route = "views/img/parts/".$_POST["editCode"]."/".$random.".png";

						$origin = imagecreatefrompng($_FILES["editPicParts"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destiny, $route);

					}

				}

				$table = "parts";

				$data = array("idCategory" => $_POST["editCategory"],
							   "code" => $_POST["editCode"],
							   "description" => $_POST["editDescription"],
							   "stock" => $_POST["editStock"],
							//    "buyingPrice" => $_POST["editBuyingPrice"],
							//    "sellingPrice" => $_POST["editSellingPrice"],
							"buyingPrice" => $_POST["editPriceBuy"],
							"sellingPrice" => $_POST["editPriceSell"],
							   "image" => $route);

				$answer = PartsModel::mdlEditPart($table, $data);

				if($answer == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "The Part has been edited",
							  showConfirmButton: true,
							  confirmButtonText: "Close"
							  }).then(function(result){
										if (result.value) {

										window.location = "Parts";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡The Part cannot be empty or have special characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "Parts";

							}
						})

			  	</script>';
			}

		}

	}


	}
