<?php

require_once "../controllers/parts.controller.php";
require_once "../models/parts.model.php";



    /*=============================================
    LOAD DYNAMIC Withdrawal TABLE
    =============================================*/


class WithdrawalTable{

    public function showWithdrawalTable(){	

        $item = null;
		$value = null;

        $parts = ControllerParts::ctrShowParts($item, $value);
        // var_dump($parts);

        // if(count($parts) == 0){

		// 	$Jsondata = '{"data":[]}';

		// 	echo $jsonData;

		// 	return;
		// }
    

        $Jsondata = '{
            "data": [';

            for($i = 0; $i < count($parts); $i++){

        /*=============================================
        Show Partsphotos
        =============================================*/

                $image = "<img src='".$parts[$i]["image"]."' width='40px'>";

       
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
        
        $buttons =  "<div class='btn-group'><button class='btn btn-primary addProductSale recoverButton' idParts='".$parts[$i]["id"]."'>Add</button></div>";


                $Jsondata .= '[
                        "'.($i+1).'",
                        "'.$image.'",
                        "'.$parts[$i]["code"].'",
                        "'.$parts[$i]["description"].'",
                        
                        "'.$stock.'",  
					
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

$activateWithdrawal = new WithdrawalTable();
$activateWithdrawal -> showWithdrawalTable();