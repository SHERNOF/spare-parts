<?php

class ControllerWithdrawal{

    /*=============================================
	SHOW WITHDRAWAL
	=============================================*/

	static public function ctrShowWithdrawal($item, $value){

		$table = "withdrawal";

		$answer = ModelWithdrawal::mdlShowWithdrawal($table, $item, $value);

		return $answer;

	}

}