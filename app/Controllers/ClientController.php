<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\LocationModel;
use App\Models\LoyerModel;
use CodeIgniter\HTTP\ResponseInterface;

class ClientController extends BaseController
{
    public function index()
    {
        return view('Pages/loginclient');
    }

    public function loginClient()
    {
        $model = new ClientModel();
        $email = $this->request->getPost('email');
        $client = $model->getClient($email);

        if ($client) {   
            $session = session();
            $session->set('user', $client);
            return redirect()->to('client/listeloyer'); 
        } else {
            return redirect()->to('/client')->with('error', 'Votre email est incorrecte!');
                }
    }

    public function ListeLoyerByDateByClient()
    {
        $session = session();
        $user = $session->get('user');
        $id_client = $user['id_client'];
        $locationmodel = new LocationModel();
        $date1 = $this->request->getGet('date1');
        $date2 = $this->request->getGet('date2');
    
        $locations = $locationmodel->getLocationsByClient($id_client);
        
        if(!empty($date1) && !empty($date2)) {
            $locations = $locationmodel->getLocationsByDateByClient($date1, $date2, $id_client);
        }
    
        $data = [];
    
        foreach ($locations as $location) {
            $date_debut = $location['date_debut'];
            $date_fin_prevus = $location['date_fin_prevus'];
    
            // Calculer la durée en mois et ajuster les dates si nécessaire
            if ($date_debut >= $date1 && $date_debut < $date2) {
                if ($date_fin_prevus > $date_debut && $date_fin_prevus <= $date2) {
                    $duree = $locationmodel->calculateMonthsDifference($date_debut, $date_fin_prevus);
                } elseif ($date_fin_prevus > $date_debut && $date_fin_prevus >= $date2) {
                    $duree = $locationmodel->calculateMonthsDifference($date_debut, $date2);
                    $date_fin_prevus = $date2;
                } else {
                    $duree = $locationmodel->calculateMonthsDifference($date_debut, $date_fin_prevus);
                }
            } elseif ($date_debut <= $date1 && $date_fin_prevus >= $date1) {
                if ($date_fin_prevus <= $date2) {
                    $duree = $locationmodel->calculateMonthsDifference($date1, $date_fin_prevus);
                    $date_debut = $date1;
                } elseif ($date_fin_prevus > $date2) {
                    $duree = $locationmodel->calculateMonthsDifference($date1, $date2);
                    $date_fin_prevus = $date2;
                } else {
                    $duree = $locationmodel->calculateMonthsDifference($date_debut, $date_fin_prevus);
                }
            } else {
                continue; // Si aucune des conditions n'est remplie, passer à la prochaine location
            }
    
            $loyer_par_mois = $location['loyer_par_mois'];
            $montant_loyer = $loyer_par_mois * $duree;
            $loyer_a_payer = $montant_loyer;
    
            $data[] = [
                'id_location' => $location['id_location'],
                'id_bien' => $location['id_bien'],
                'id_client' => $location['id_client'],
                'id_proprietaire' => $location['id_proprietaire'],
                'nom_bien' => $location['nom_bien'],
                'description' => $location['description'],
                'region' => $location['region'],
                'loyer_par_mois' => $location['loyer_par_mois'],
                'nom_proprietaire' => $location['nom_proprietaire'],
                'nom_typebien' => $location['nom_typebien'],
                'commission' => $location['commission'],
                'date_debut' => $date_debut,
                'date_fin_prevus' => $date_fin_prevus,
                'montant_loyer' => $montant_loyer,
                'loyer_a_payer' => $loyer_a_payer
            ];
        }
        // echo "<pre>" . print_r($data, true) . "</pre>";
        // Charger la vue de la page Location avec les données
        $content = view('Pages/listeloyer', ['loyers' => $data]);
    
        $layout_data = [
            'content' => $content
        ];
    
        return view('LayoutProprio/layout', $layout_data);
    }
    
    
    
    

}
