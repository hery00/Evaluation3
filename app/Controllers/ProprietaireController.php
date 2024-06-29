<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProprietaireModel;
use App\Models\BienModel;
use App\Models\PhotosModel;
use App\Models\LocationModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProprietaireController extends BaseController
{


    public function log()
    {
        return view('Pages/loginproprio');
    }

    public function loginProprietaire()
    {
        $model = new ProprietaireModel();
        $telephone = $this->request->getPost('telephone');
        $proprietaire = $model->getProprietaire($telephone);

        if ($proprietaire) {   
            $session = session();
            $session->set('user', $proprietaire);
            return redirect()->to('/proprio/listebiens');
        } 
        else {
            return redirect()->to('/proprio')->with('error', 'Votre numero est incorrecte!');
        }
    }

    public function listebiensByProprietaire()
    {
        $session = session();
        $user = $session->get('user');
        $id_proprio=$user['id_proprietaire'];
        $model = new BienModel();
        $photomodel =  new PhotosModel();
        $data['biens'] = $model->getBiensByProprietaire($id_proprio);
    
        foreach ($data['biens'] as &$bien)
        {
            $bien['photo'] = $photomodel->getPhotoByBien($bien['id_bien']);
        }
        $data = [
            'content' => view('Pages/ListeBiens', $data)
        ];
    
        return view('LayoutProprio/layout', $data);
    }

    public function ListeLocationNetByDateByProprio()
    {
        $session = session();
        $user = $session->get('user');
        $id_proprio = $user['id_proprietaire'];
        $locationmodel = new LocationModel();
        $date1 = $this->request->getGet('date1');
        $date2 = $this->request->getGet('date2');

        if (empty($date1) && empty($date2)) {
            $data['ca'] = $locationmodel->getChiffreAffaireProprio($id_proprio);
        } else {
            $data['ca'] = $locationmodel->getChiffreAffaireProprioByDate($date1, $date2, $id_proprio);
        }

        if (empty($date1) && empty($date2))
        {  
            $data['locations'] = $locationmodel->getLocationsNetByProprio($id_proprio);
        } else {
            // Sinon, obtenir le chiffre d'affaire et les locations par date et propriétaire
            $data['locations'] = $locationmodel->getLocationsNetByDateByProprio($date1, $date2, $id_proprio);
        }

        // echo "<pre>" . print_r($data, true) . "</pre>";

        // Charger la vue de la page Location avec les données
        $content = view('Pages/Location', $data);
        $layout_data = [
            'content' => $content
        ];

        return view('LayoutProprio/layout', $layout_data);
    }


    public function testGetChiffreAffaire()
{
    $id_proprietaire = 1;
    $date1 ='01/01/2024';
    $date2 ='01/07/2024';
    $locationModel = new LocationModel();
    $chiffreAffaire = $locationModel->getChiffreAffaireProprioByDate($date1,$date2,$id_proprietaire);
    
    // Affichage pour le débogage
    echo '<pre>';
    print_r($chiffreAffaire);
    echo '</pre>';
}

}
