<?php namespace App\Libraries;

use TCPDF;

class ExportPdf extends TCPDF {
    function __construct() {

        parent::__construct();

    }
    public function generatePDF() {
    $this->SetMargins(10, 10, 10);
    $this->SetTextColor(33, 65, 108);
    $this->SetAutoPageBreak(true);

    $this->AddPage();

    $this->SetFont('helvetica', '', 12);
    $this->Cell(40, 10, 'Hello World');

    $filename = 'Certificat du vainqueur.pdf';
    $this->Output($filename, 'D'); 
    exit();
}

}
