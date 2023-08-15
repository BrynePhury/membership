<?php
require __DIR__ . '/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Create a new DOMPDF instance
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$pdfView = "pdf_invoice"; // Set the name of the PDF view here

$data['page_title'] = "View Invoice";
        
// Render the view to a string
ob_start();
extract($data);
require_once($pdfView . ".php"); // Use the PDF view
$html = ob_get_clean();

$dompdf->loadHtml($html);

// Set paper size (A4 is the default)
$dompdf->setPaper('A4', 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('invoice.pdf', ['Attachment' => true]);
?>
