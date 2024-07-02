<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProprietaireModel;
use App\Models\BienModel;
use App\Models\PhotosModel;
use App\Models\LocationModel;
use App\Models\LocationDetailMoisModel;
use App\Models\LocationDetailFinalModel;
use App\Models\LocationDetailModel;
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
    $id_proprio = $user['id_proprietaire'];
    $model = new BienModel();
    $locationdetailmodel = new LocationDetailMoisModel();
    $photomodel = new PhotosModel();
    $data['biens'] = $model->getBiensByProprietaire($id_proprio);

    foreach ($data['biens'] as &$bien) {
        $bien['photo'] = $photomodel->getPhotoByBien($bien['id_bien']);

        // Calcul de la date de disponibilité
        $lastPayment = $locationdetailmodel->getLastPaymentByBien($bien['id_bien']);
        if ($lastPayment) {
            $lastDate = new \DateTime($lastPayment['date_fin_prevus']);
            $lastDate->modify('+1 day'); // Ajoute 1 jour
            $bien['date_disponibilite'] = $lastDate->format('Y-m-d');
        } 
    }

    $data = [
        'content' => view('Pages/ListeBiens', $data)
    ];

    return view('LayoutProprio/layout', $data);
}


    
    public function getChiffreAffaireMois()
    {
        $session = session();
        $user = $session->get('user');
        $id_proprio = $user['id_proprietaire'];
        $locationmodel = new LocationDetailMoisModel();
        $date1 = $this->request->getGet('date1');
        $date2 = $this->request->getGet('date2');

        if (empty($date1) && empty($date2))
        {
            $data['locations'] = $locationmodel->getLocationDetailMoisByProprio($id_proprio);
        } else {
            $data['locations'] = $locationmodel->getLocationDetailMoisByDateByProprio($date1, $date2, $id_proprio);
        }

        
        // echo "<pre>" . print_r($data, true) . "</pre>";

        // Charger la vue de la page Location avec les données
        $content = view('Pages/gainpropriomois', $data);

        $layout_data = [
            'content' => $content
        ];

        return view('LayoutProprio/layout', $layout_data);
    }

    public function getChiffreAffaireFinal()
    {
        $session = session();
        $user = $session->get('user');
        $id_proprio = $user['id_proprietaire'];
        $locationmodel = new LocationDetailFinalModel();
        $date1 = $this->request->getGet('date1');
        $date2 = $this->request->getGet('date2');

        if (empty($date1) && empty($date2))
        {
            $data['locations'] = $locationmodel->getLocationDetailFinalByProprio($id_proprio);
        } else {
            $data['locations'] = $locationmodel->getLocationDetailFinalByDateByProprio($date1, $date2, $id_proprio);
        }
        
        // echo "<pre>" . print_r($data, true) . "</pre>";

        // Charger la vue de la page Location avec les données
        $content = view('Pages/gainpropriofinal', $data);
        $layout_data = [
            'content' => $content
        ];

        return view('LayoutProprio/layout', $layout_data);
    }


    public function testGetChiffreAffaire()
{
  
    $locationModel = new LocationModel();
    $Model = new LocationDetailModel();
    $difference = $locationModel->getAllLocationIDs();

    echo '<pre>';
    print_r($difference);
    echo '</pre>';
    $Model->genererdetailslocations($difference);
}

    public function logout()
    {
        // Déconnectez l'administrateur en supprimant sa session
        $session = session();
        $session->remove('proprietaire_id');
        return redirect()->to('/proprio');
    }


}
