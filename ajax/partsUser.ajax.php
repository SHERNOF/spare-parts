<?php

require_once "../controllers/partsUser.controller.php";
require_once "../models/partsUser.model.php";



class AjaxpartsUser{

	/*=============================================
	EDIT PARTS USER
	=============================================*/

	public $idpartsUser;

	public function ajaxEditpartsUser(){

		$item = "id";
		$value = $this->idpartsUser;

		$answer = ControllerpartsUser::ctrShowpartsUser($item, $value);

		echo json_encode($answer);
	}

}


/*=============================================
EDIT USER
=============================================*/

if (isset($_POST["idpartsUser"])) {

	$partsUser = new AjaxpartsUser();
	$partsUser -> idpartsUser = $_POST["idpartsUser"];
	$partsUser -> ajaxEditpartsUser();
}

