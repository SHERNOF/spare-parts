<?php

require_once "../controllers/parts.controller.php";
require_once "../models/parts.model.php";


class AjaxParts{

	/*=============================================
	Generate Code from IdCategory
	=============================================*/
	public $idCategory;

	public function ajaxCreateCodePart(){

		$item = "idCategory";
		$value = $this->idCategory;

		$answer = ControllerParts::ctrShowParts($item, $value);

		echo json_encode($answer);
	}

}

	/*=============================================
	Generate Code from IdCategory
	=============================================*/

	if(isset($_POST["idCategory"])){
		$codeParts = new AjaxParts();
		$codeParts -> idCategory = $_POST["idCategory"];
		$codeParts -> ajaxCreateCodePart();
	}

