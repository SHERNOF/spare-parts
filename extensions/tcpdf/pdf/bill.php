<?php

require_once "../../../controllers/withdrawal.controller.php";
require_once "../../../models/withdrawal.model.php";

require_once "../../../controllers/partsUser.controller.php";
require_once "../../../models/partsUser.model.php";

require_once "../../../controllers/users.controller.php";
require_once "../../../models/users.model.php";

require_once "../../../controllers/parts.controller.php";
require_once "../../../models/parts.model.php";

class printBill {

    public $code;

    public function getBillPrinting(){

        //WE BRING THE INFORMATION OF THE Withdrawal

        $itemWithdrawal = "code";
        $valueWithdrawal = $this->code;

        $answerWithdrawal = ControllerWithdrawal::ctrShowWithdrawal($itemWithdrawal, $valueWithdrawal);

        
        $withdrawaldate = substr($answerWithdrawal["withdrawalDate"],0,-8);
        $parts = json_decode($answerWithdrawal["parts"], true);
        $netPrice = number_format($answerWithdrawal["netPrice"],2);
        $tax = number_format($answerWithdrawal["tax"],2);
        $totalPrice = number_format($answerWithdrawal["totalPrice"],2);


        // Parts User Information

        $itempartsUser = "id";
        $valuepartsUser = $answerWithdrawal["idPartsUser"];

        $answerpartsUser = ControllerpartsUser::ctrShowpartsUser($itempartsUser, $valuepartsUser);

        //Issuer infromations

        $itemIssuer = "id";
        $valueIssuer = $answerWithdrawal["idIssuer"];

        $answerIssuer = ControllerUsers::ctrShowUsers($itemIssuer, $valueIssuer);


// ---------------------------------------------------------

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

$block1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					NIT: 71.759.963-9

					<br>
					ADDRESS: Singapore

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					CELLPHONE: 93851908
					
					<br>
					sherwin.nofuente@cognex.com

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>BILL <br>$valueWithdrawal</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($block1, false, false, false, false, '');

// ---------------------------------------------------------

$block2 = <<<EOF

	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>

    <table style="font-size:10px; padding:5px 10px;">
    
		<tr>
			<td style="border: 1px solid #777; background-color:white; width:390px">
				Customer: $answerpartsUser[name]
			</td>

			<td style="border: 1px solid #777; background-color:white; width:150px; text-align:right">
				Date: $withdrawaldate
			</td>
		</tr>

		<tr>
			<td style="border: 1px solid #777; background-color:white; width:540px">Issuer: $answerIssuer[name]</td>
		</tr>

		<tr>
		<td style="border-bottom: 1px solid #777; background-color:white; width:540px"></td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($block2, false, false, false, false, '');

// ---------------------------------------------------------
// ---------------------------------------------------------

$block3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #777; background-color:white; width:260px; text-align:center">Part</td>
		<td style="border: 1px solid #777; background-color:white; width:80px; text-align:center">quantity</td>
		<td style="border: 1px solid #777; background-color:white; width:100px; text-align:center">value Unit.</td>
		<td style="border: 1px solid #777; background-color:white; width:100px; text-align:center">value Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($block3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($parts as $key => $item) {

$itemPart = "description";
$valuePart = $item["description"];
$orden = null;

$answerPart = ControllerParts::ctrShowParts($itemPart, $valuePart, $orden);

$valueUnit = number_format($answerPart["sellingPrice"], 2);

$totalPrice = number_format($item["totalPrice"], 2);

$block4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #777; color:#333; background-color:white; width:260px; text-align:center">
				$item[description]
			</td>

			<td style="border: 1px solid #777; color:#333; background-color:white; width:80px; text-align:center">
				$item[quantity]
			</td>

			<td style="border: 1px solid #777; color:#333; background-color:white; width:100px; text-align:center">$ 
				$valueUnit
			</td>

			<td style="border: 1px solid #777; color:#333; background-color:white; width:100px; text-align:center">$ 
				$totalPrice
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($block4, false, false, false, false, '');

}

// ---------------------------------------------------------

// ---------------------------------------------------------

$block5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Net:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $netPrice
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Tax:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $tax
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $totalPrice
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($block5, false, false, false, false, '');


$pdf->Output('bill.pdf');

}

}

$bill = new printBill();
$bill -> code = $_GET["code"];
$bill -> getBillPrinting();

?>