<?php namespace App\Controllers;

use App\Libraries\ExportPdf;
use CodeIgniter\Controller;

class PdfController extends Controller {

    public function generate_pdf() {
        // Récupérer les données de classement par équipe
        //$classementEquipeData = ...;  Récupérez vos données ici

        // Vérifier le vainqueur (supposons que le vainqueur est le premier dans le classement)
        //$vainqueur = $classementEquipeData[0];

        $exportpdf = new ExportPdf();
        $exportpdf->generatePDF();
        // Créer un nouvel objet ExportPdf
        $pdf = new ExportPdf();

        // Début du document PDF
        $pdf->AddPage();

        // Ajouter du contenu au PDF (par exemple, le certificat)
        $pdf->SetFont('times', '', 12);
        $pdf->Write(5, 'Certificat de Vainqueur');

        // Générer le lien pour le certificat du vainqueur
        $pdf->Cell(0, 10, 'Cliquez ici pour télécharger le certificat');

        // Afficher le PDF dans le navigateur
        $pdf->Output('certificat_vainqueur.pdf', 'I');

    }
}
