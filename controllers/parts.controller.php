<?php

class ControllerParts {

    /*=============================================
	SHOW PRODUCTS
	=============================================*/

    static public function ctrShowParts($item, $value){
		$table = "parts";
		$answer = PartsModel::mdlShowParts($table, $item, $value);
		return $answer;

	}

	

}