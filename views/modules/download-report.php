<?php

require_once "../../controllers/withdrawal.controller.php";
require_once "../../models/withdrawal.model.php";
require_once "../../controllers/partsUser.controller.php";
require_once "../../models/partsUSer.model.php";
require_once "../../controllers/users.controller.php";
require_once "../../models/users.model.php";

$report = new ControllerWithdrawal();
$report -> ctrDownloadReport();