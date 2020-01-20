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

	/*=============================================
 	 EDIT Part
  	=============================================*/ 

	  public $idPart;
	  public $getParts;
	  public $partName;

  		public function ajaxEditPart(){

		if($this->getParts == "ok"){

			$item = null;
			$value = null;
  
			$answer = ControllerParts::ctrShowParts($item, $value);
  
			echo json_encode($answer);

		} else if ($this->partName != ""){

		$item = "description";
	    $value = $this->partName;

	    $answer = ControllerParts::ctrShowParts($item, $value);

	    echo json_encode($answer);


		} else {

		$item = "id";
	    $value = $this->idPart;

	    $answer = ControllerParts::ctrShowParts($item, $value);

	    echo json_encode($answer);

		}
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

	/*=============================================
	EDIT Part
	=============================================*/ 

if(isset($_POST["idPart"])){

	$editPart = new AjaxParts();
	$editPart -> idPart = $_POST["idPart"];
	$editPart -> ajaxEditPart();
  
  }


/*=============================================
GET PART
=============================================*/ 

if(isset($_POST["getParts"])){

	$getParts = new AjaxParts();
	$getParts -> getParts = $_POST["getParts"];
	$getParts -> ajaxEditPart();
  
  }

/*=============================================
GET PART NAME
=============================================*/ 

if(isset($_POST["partName"])){

	$partName = new AjaxParts();
	$partName -> partName = $_POST["partName"];
	$partName -> ajaxEditPart();
  
  }

