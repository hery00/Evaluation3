<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategorieModel;
use App\Models\EquipeModel;
use App\Models\EtapesModel;
use App\Models\PointClassementGeneraleModel;
use CodeIgniter\HTTP\ResponseInterface;

use Config\Services;

class PointClassementGeneraleController extends BaseController
{
      

      
    public function Classementgeneral()
    {
        $indice = $this->request->getGet('indice');
        
        // Instancier les modèles
        $etapeModel = new EtapesModel();
        $equipeModel = new EquipeModel();
        $categorieModel = new CategorieModel();
        $classementModel = new PointClassementGeneraleModel();
        
        // Récupérer les données nécessaires depuis les modèles
        $data['etapes'] = $etapeModel->getAllEtapes();
        $data['equipes'] = $equipeModel->getAllEquipes();
        $data['categories'] = $categorieModel->getAllCategories();
        $data['classements'] = $classementModel->getPointClassementGenerale();
        
        // Passer les données à la vue
        $data['indice'] = $indice;
        
        // Charger la vue avec les données
        $data['content'] = view('Pages/pointclassementgeneral', $data);
        
        // Rendre la vue en fonction de l'indice
        if ($indice == 1) {
            return view('Layout/layout', $data);
        } else {
            return view('Layout_Admin/layout', $data);
        }
    }


    
   
    public function filtreClassement()
    {
        $indice = $this->request->getGet('indice');
        $PointClassementGeneraleModel = new PointClassementGeneraleModel();
        $id_etape = $this->request->getGet('idetape');
        $id_equipe = $this->request->getGet('idequipe');
        $id_categorie = $this->request->getGet('idcategorie');
        $etapeModel = new EtapesModel();
        $equipeModel = new EquipeModel();
        $categorieModel = new CategorieModel();
        

        $data['etapes'] = $etapeModel->getAllEtapes();
        $data['equipes'] = $equipeModel->getAllEquipes();
        $data['categories'] = $categorieModel->getAllCategories();
        $data['classements'] = $PointClassementGeneraleModel->getPointClassementGenerale();
        
        
        if ($id_etape != null) {
            $data['classements'] = $PointClassementGeneraleModel->getPointClassementGeneraleByEtape($id_etape);
        }
        if ($id_equipe != null) {
            $data['classements'] = $PointClassementGeneraleModel->getPointClassementGeneraleByEquipe($id_equipe);
        }
        if ($id_categorie != null) {
            $data['classements'] = $PointClassementGeneraleModel->getPointClassementGeneraleByCategorie($id_categorie);
        }
        
        $data['indice'] = $indice;
        $data['content'] = view('Pages/pointclassementgeneral', $data);
        
       
        if ($indice == 1) {
            return view('Layout/layout', $data);
        } else {
            return view('Layout_Admin/layout', $data);
        }
    }
    
    public function Classementequipe()
    {
        $indice = $this->request->getGet('indice');

        $etapeModel = new EtapesModel();
        $equipeModel = new EquipeModel();
        $categorieModel = new CategorieModel();
        $classementModel = new PointClassementGeneraleModel();
        $data['etapes'] = $etapeModel->getAllEtapes();
        $data['equipes'] = $equipeModel->getAllEquipes();
        $data['categories'] = $categorieModel->getAllCategories();
        $data['classements'] = $classementModel->sumPointsEquipe();
        
        $data['indice'] = $indice;
        
        $data['content'] = view('Pages/pointequipe', $data);
        
       
        if ($indice == 1) {
            return view('Layout/layout', $data);
        } else {
            return view('Layout_Admin/layout', $data);
        }
    }

     
    public function filtreClassementEquipe()
    {
        $indice = $this->request->getGet('indice');
        $PointClassementGeneraleModel = new PointClassementGeneraleModel();
        $id_etape = $this->request->getGet('idetape');
        $id_categorie = $this->request->getGet('idcategorie');
        $etapeModel = new EtapesModel();
        $equipeModel = new EquipeModel();
        $categorieModel = new CategorieModel();
        
        $data['etapes'] = $etapeModel->getAllEtapes();
        $data['equipes'] = $equipeModel->getAllEquipes();
        $data['categories'] = $categorieModel->getAllCategories();
        $data['classements'] = $PointClassementGeneraleModel->sumPointsEquipe();
        
        
        if ($id_etape != null) {
            $data['classements'] = $PointClassementGeneraleModel->sumPointsEquipeByEtape($id_etape);
        }
        if ($id_categorie!= null) {
            $data['classements'] = $PointClassementGeneraleModel->sumPointsEquipeByCategorie($id_categorie);
        }
        
        $data['indice'] = $indice;
        $data['content'] = view('Pages/pointequipe', $data);
        
       
        if ($indice == 1) {
            return view('Layout/layout', $data);
        } else {
            return view('Layout_Admin/layout', $data);
        }
    }


}
