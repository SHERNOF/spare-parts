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

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf -> AddPage ('P', 'A7');

//---------------------------------------------------------

$block1 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				Date: $withdrawaldate

				<br><br>
				Inventory System
				
				<br>
				NIT: 71.759.963-9

				<br>
				Address: 5th Ave. Miami, Fl

				<br>
				Phone: 300 786 52 49

				<br>
				Invoice N.$valueWithdrawal

				<br><br>					
				Customer: $answerpartsUser[name]

				<br>
				Seller: $answerIssuer[name]

				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($block1, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($parts as $key => $item) {

	$unitValue = number_format($item["price"], 2);
	
	$totalPrice = number_format($item["totalPrice"], 2);
	
	$block2 = <<<EOF
	
	<table style="font-size:9px;">
	
		<tr>
		
			<td style="width:160px; text-align:left">
			$item[description] 
			</td>
	
		</tr>
	
		<tr>
		
			<td style="width:160px; text-align:right">
			$ $unitValue Units * $item[quantity]  = $ $totalPrice
			<br>
			</td>
	
		</tr>
	
	</table>
	
	EOF;
	
	$pdf->writeHTML($block2, false, false, false, false, '');
	
	}

	// ---------------------------------------------------------

$block3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:80px;">
			 NET: 
		</td>

		<td style="width:80px;">
			$ $netPrice
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TAX: 
		</td>

		<td style="width:80px;">
			$ $tax
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TOTAL: 
		</td>

		<td style="width:80px;">
			$ $totalPrice
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			<br>
			<br>
			Thank you for your purchase
		</td>

	</tr>

</table>



EOF;

$pdf->writeHTML($block3, false, false, false, false, '');



$pdf->Output('bill.pdf');

}

}

$bill = new printBill();
$bill -> code = $_GET["code"];
$bill -> getBillPrinting();

?>