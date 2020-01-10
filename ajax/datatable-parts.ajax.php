<?php

require_once "../controllers/parts.controller.php";
require_once "../controllers/categories.controller.php";
require_once "../models/parts.model.php";
require_once "../models/categories.model.php";


    /*=============================================
    LOAD DYNAMIC Parts TABLE
    =============================================*/


class PartsTable{
    public function showPartsTable(){	

        $item = null;
		$value = null;

        $parts = ControllerParts::ctrShowParts($item, $value);
        // var_dump($parts);
    

        $Jsondata = '{
            "data": [';

            for($i = 0; $i < count($parts); $i++){

        /*=============================================
        Show Partsphotos
        =============================================*/

                $image = "<img src='".$parts[$i]["image"]."' width='40px'>";

        /*=============================================
        Show Part Category
        =============================================*/

					$item = "id";
                    $value = $parts[$i]["idCategory"];

                    $categories = ControllerCategory::ctrShowCategories($item, $value);

        /*=============================================
        Color coding of stock
        =============================================*/                    
        if($parts[$i]["stock"] <= 10){            
            $stock = "<button class='btn btn-danger'>".$parts[$i]["stock"]."</button>";
        } else if ($parts[$i]["stock"] > 11 && $parts[$i]["stock"] <= 15){
            $stock = "<button class='btn btn-warning'>".$parts[$i]["stock"]."</button>";
        } else {
            $stock = "<button class='btn btn-success'>".$parts[$i]["stock"]."</button>";
        }
    
        /*=============================================
        Button functions
        =============================================*/

        $buttons =  "<div class='btn-group'><button class='btn btn-warning btnEditPart' idPart=".$parts[$i]["id"]." data-toggle='modal' data-target='#EditPart'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeletePart' idPart=".$parts[$i]["id"]." code=".$parts[$i]["code"]." image=".$parts[$i]["image"]."><i class='fa fa-times'></i></button></div>";


                $Jsondata .= '[
                        "'.($i+1).'",
                        "'.$image.'",
                        "'.$parts[$i]["code"].'",
                        "'.$parts[$i]["description"].'",
                        "'.$categories["category"].'",
                        "'.$stock.'",  
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