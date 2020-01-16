<?php

require_once "../controllers/partsUser.controller.php";
require_once "../models/partsUser.model.php";



class AjaxpartsUser{

	/*=============================================
	EDIT PARTS USER
	=============================================*/

	public $idpartsUser;

	public function ajaxEdipartstUser(){

		$item = "id";
		$value = $this->idpartsUser;

		$answer = ControllerpartsUser::ctrShowpartsUser($item, $value);

		echo json_encode($answer);
	}

}


/*=============================================
EDIT USER
=============================================*/

if (isset($_POST["idUpartsUser"])) {

	$edit = new AjaxpartsUsers();
	$edit -> idpartsUser = $_POST["idpartsUser"];
	$edit -> ajaxEditpartsUser();
}

