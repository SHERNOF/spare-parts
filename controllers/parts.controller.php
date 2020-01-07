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
}