<?php

require_once "../controllers/parts.controller.php";
require_once "../controllers/categories.controller.php";
require_once "../models/parts.model.php";
require_once "../models/categories.model.php";


class PartsTable{
    public function showPartsTable(){	

        $item = null;
		$value = null;

        $parts = ControllerParts::ctrShowParts($item, $value);
        // var_dump($parts);
        // $image = "<img src='".$parts[$i]["image"]."' width='40px'>";
        
        

        $Jsondata = '{
            "data": [';

            for($i = 0; $i < count($parts); $i++){
                $image = "<img src='".$parts[$i]["image"]."' width='40px'>";

					$item = "id";
                    $value = $parts[$i]["idCategory"];

                    $categories = ControllerCategory::ctrShowCategories($item, $value);

                    $buttons =  "<div class='btn-group'><button class='btn btn-wwarning btnEditPart' idPart=".$parts[$i]["id"]." data-toggle='modal' data-target='#EditPar'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeletePart' idParts=".$parts[$i]["id"]." code=".$parts[$i]["code"]." image=".$parts[$i]["image"]."><i class='fa fa-times'></i></button></div>";


                $Jsondata .= '[
                        "'.($i+1).'",
                        "'.$image.'",
                        "'.$parts[$i]["code"].'",
                        "'.$parts[$i]["description"].'",
                        "'.$categories["category"].'",
						"$ '.$parts[$i]["stock"].'",
						"$ '.$parts[$i]["buyingPrice"].'",
						"$ '.$parts[$i]["sellingPrice"].'",
						"'.$parts[$i]["date"].'",
						"'.$buttons.'"               
                ],';
                }
            
                $Jsondata = substr($Jsondata, 0, -1);
            $Jsondata .= ']

        }';
        echo $Jsondata;

        return;

       
            
        

    }
}

$activateParts = new PartsTable();
$activateParts -> showPartsTable();