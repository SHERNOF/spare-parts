<?php

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";



class AjaxCategories{

	/*=============================================
	EDIT CATEGORY
	=============================================*/

	public $idCategory;

	public function ajaxEditCategory(){

		$item = "id";
		$value = $this->idCategory;

		$answer = ControllerCategory::ctrShowCategories($item, $value);

		echo json_encode($answer);
	}


	
}


/*=============================================
EDIT CATEGORY
=============================================*/

if (isset($_POST["idCategory"])) {

	$edit = new ajaxEditCategory();
	$edit -> idCategory = $_POST["idCategory"];
	$edit -> ajaxEditCategory();
}
