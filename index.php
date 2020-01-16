<?php

require_once "controllers/template.controller.php";
require_once "controllers/users.controller.php";
require_once "controllers/categories.controller.php";
require_once "controllers/parts.controller.php";
require_once "controllers/partsUser.controller.php";
require_once "controllers/withdrawn.controller.php";


require_once "models/users.model.php";
require_once "models/categories.model.php";
require_once "models/parts.model.php";
require_once "models/partsUser.model.php";
require_once "models/withdrawn.model.php";



$template = new ControllerTemplate();
$template -> ctrTemplate();