<?php

require_once "../controllers/users.controller.php";
require_once "../models/users.model.php";

class AjaxUsers {

    // =====================================
	// =            Edit User              =
    // ======================================
    
    public $idUser;
    public function ajaxEditUser{
        $item = "id";
        $value = $this->idUser;

        $response = ControllerUsers::ctrShowUsers($item, $value);

        echo json_encode($answer);

    }
    
    // =====================================
	// =            Edit User              =
    // ======================================

    if(isset($_POST["idUser"])){

    $edit = new AjaxUsers();
    $edit -> idUser = $_POST["idUser"];
    $edit -> ajaxEditUser();

    }

}