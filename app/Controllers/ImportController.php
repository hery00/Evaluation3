<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LocationDetailModel;
use App\Models\ImportModel;
use App\Models\LocationModel;
use App\Models\ImportBienModel;
use App\Models\ImportLocationModel;
use App\Models\ImportCommissionModel;
use CodeIgniter\Files\File;

class ImportController extends BaseController
{
    public function index(): string
    {
        $data = [
            'content' => view('Pages/Import')
        ];
        return view('LayoutAdmin/layout',$data);
    }

    public function importcsv()
    {
        helper(['form', 'url']);
        $importModel = new ImportModel();
        $locationModel = new LocationModel();
        $LocationDetailModel = new LocationDetailModel();
        
        $file = $this->request->getFile('bien');
        $cheminTemporaire = $file->getTempName();

        $file2 = $this->request->getFile('location');
        $cheminTemporaire2 = $file2->getTempName();

        $file3 = $this->request->getFile('commission');
        $cheminTemporaire3 = $file3->getTempName();

        $tab1 = $importModel -> import_csv($cheminTemporaire);
        $tab2 = $importModel -> import_csv($cheminTemporaire2);
        $tab3 = $importModel -> import_csv($cheminTemporaire3);

        $bienmodel = new ImportBienModel();

        for ($i = 1; $i < count($tab1); $i++) 
        {

            $reference = $tab1[$i][0];
            $nom = $tab1[$i][1];
            $description = $tab1[$i][2];
            $type = $tab1[$i][3];
            $region = $tab1[$i][4];
            $loyer_mensuel = $tab1[$i][5];
            $proprietaire = $tab1[$i][6];

            $bienmodel -> insertCsvData($reference, $nom, $description, $type, $region, $loyer_mensuel,$proprietaire); 
        }
        

        for ($i = 1; $i < count($tab2); $i++) 
        {
            $locationmodel = new ImportLocationModel();

            $reference = $tab2[$i][0];
            $date_debut = $tab2[$i][1];
            $duree = $tab2[$i][2];
            $client = $tab2[$i][3];

            $locationmodel -> insertCsvData($reference, $date_debut, $duree, $client); 
        }

        for ($i = 1; $i < count($tab3); $i++) 
        {
            $commissionmodel = new ImportCommissionModel();
    
            $nom = $tab3[$i][0];
            $commission = $tab3[$i][1];
            $commission = $this->nettoyer_commission($commission); // Nettoyer les pourcentages
    
            $commissionmodel->insertCsvData($nom, $commission); 
        }
        
        $importModel ->insertCsvProprietaire();
        $importModel->insertCsvCommission();
        $importModel->insertCsvBien();
        $importModel->insertCsvClient();
        $importModel->insertCsvLocation();
        $locationIDs = $locationModel->getAllLocationIDs();
        $LocationDetailModel->genererdetailslocations($locationIDs);
    }

    public function nettoyer_commission($commission)
    {
        $commission = trim($commission); // Nettoie les espaces
        if (strpos($commission, '%') !== false) {
            $commission = str_replace('%', '', $commission); // Enlève le caractère '%'
        }
        $commission = str_replace(',', '.', $commission); // Remplace la virgule par un point si nécessaire
        return (float)$commission;
    }

}
