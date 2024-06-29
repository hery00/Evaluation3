<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EquipeModel;
use App\Models\EtapesModel;
use App\Models\ImportModel;
use App\Models\ImportEtapeModel;
use App\Models\ImportResultatModel;
use App\Models\ImportPointModel;
use CodeIgniter\Files\File;

class ImportController extends BaseController
{
    public function index(): string
    {
        $data = [
            'content' => view('Pages/Import')
        ];
        return view('Layout_Admin/layout',$data);
    }

    public function importcsv()
    {
        helper(['form', 'url']);
        $importModel = new ImportModel();
        
        $file = $this->request->getFile('fichier');
        //$filepath = WRITEPATH . 'uploads/' . $file->store();
        $cheminTemporaire = $file->getTempName();
        
       // return redirect()->back()->with('success', 'File imported successfully.');

        $file2 = $this->request->getFile('resultat');
        $cheminTemporaire2 = $file2->getTempName();

        $tab1 = $importModel -> import_csv($cheminTemporaire);
        $tab2 = $importModel -> import_csv($cheminTemporaire2);
        $etapemodel = new ImportEtapeModel();

        for ($i = 1; $i < count($tab1); $i++) 
        {

            $etape = $tab1[$i][0];
            $longueur = $tab1[$i][1];
            $nb_coureur = $tab1[$i][2];
            $rang_etape = $tab1[$i][3];
            $date_depart = $tab1[$i][4];
            $heure_depart = $tab1[$i][5];

            $etapemodel -> insertCsvData($etape, $longueur, $nb_coureur, $rang_etape, $date_depart, $heure_depart); 
        }
        
        $etapemodel->insert_etapecsv();

        for ($i = 1; $i < count($tab2); $i++) 
        {
            $resultatmodel = new ImportResultatModel();

            $classement_rang = $tab2[$i][0];
            $numero_dossard = $tab2[$i][1];
            $nom = $tab2[$i][2];
            $genre = $tab2[$i][3];
            $date_naissance = $tab2[$i][4];
            $equipe = $tab2[$i][5];
            $arrivee = $tab2[$i][5];

            $resultatmodel -> insertCsvData($classement_rang, $numero_dossard, $nom, $genre, $date_naissance, $equipe, $arrivee); 
        }

        $importModel->insertCsvEquipe();
        $importModel->insertCsvCoureur();
        // $importModel->insertCsvArrivee();
        
        //var_dump($tab2);
    }

    //POINTS
    public function import_points()
    {
        helper(['form', 'url']);
        $importModel = new ImportModel();
        
        $file = $this->request->getFile('fichier');
        //$filepath = WRITEPATH . 'uploads/' . $file->store();
        $cheminTemporaire = $file->getTempName();
        
       // return redirect()->back()->with('success', 'File imported successfully.');

        $tab1 = $importModel -> import_csv($cheminTemporaire);
        // var_dump($tab1);
        $PointModel = new ImportPointModel();
        
        for ($i = 1; $i < count($tab1); $i++) 
        {

            $classement = $tab1[$i][0];
            $point = $tab1[$i][1];

            $PointModel -> insertCsvPoint($classement, $point); 
        }

        $PointModel->insert_point_base();
         
    }

    public function link_point()
    {
        $data = [
            'content' => view('Pages/Import_Points')
        ];
        return view('Layout_Admin/layout',$data);
    }

    

    //     for ($i = 1; $i < count($donnees); $i++) {
    //         // $ligne = $donnees[$i];
    //         $model = new ImportModel();

    //         $classement = $donnees[$i][0];
    //         $longueur = $donnees[$i][1];
    //         $nb_coureur = $donnees[$i][2];
    //         $rang_classement = $donnees[$i][3];
    //         $date_depart = $donnees[$i][4];
    //         $heure_depart = $donnees[$i][5];

    //         $model -> insertCsvData($classement, $longueur, $nb_coureur, $rang_classement, $date_depart, $heure_depart); 
    //     }
    // }

}
