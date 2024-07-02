<?php


namespace App\Controllers;

use App\Models\LocationModel;
use App\Models\LocationDetailModel;
use App\Models\ClientModel;

class LocationController extends BaseController
{
    public function create()
    {
        $locationModel = new LocationModel();
        $LocationDetailModel = new LocationDetailModel();
        $clientmodel = new ClientModel();

        $id_bien = $this->request->getGet('id_bien');
        $client = $this->request->getGet('client');
        $date_debut = $this->request->getGet('date_debut');
        $duree = $this->request->getGet('duree');
        
        $id_client = $clientmodel->insertClient($client);
       
        $data = [
            'id_bien' => $id_bien,
            'id_client' => $id_client,
            'date_debut' => $date_debut,
            'duree' => $duree
        ];

        // Insérer la nouvelle location
        $newLocationId = $locationModel->insertLocation($data);

        if ($newLocationId) {
          
            $LocationDetailModel->genererdetailslocations([$newLocationId]);

            return redirect()->to('admin/gainmois');

        } else {
            return redirect()->back()->with('error', 'La location existe déjà');
        }
    }

}