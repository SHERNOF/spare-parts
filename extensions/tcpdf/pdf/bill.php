<?php

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setFontSubsetting(true);

// $pdf->SetFont('dejavusans', '', 11, '', true);

$pdf->startPageGroup();

$pdf->AddPage();


?>