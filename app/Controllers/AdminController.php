<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\LocationModel;
use App\Models\LocationCommissionModel;

class AdminController extends BaseController
{

    public function log()
    {
            return view('Pages/login');
    }
    

    public function inscrir()
    {
        return view('Pages/inscription');
    }

    
    public function process()
    {
        $userModel = new AdminModel();
        $email = $this->request->getPost('email');
        $passe = $this->request->getPost('passe');
        
        // Vérifier si l'utilisateur avec cet email existe
        $user = $userModel->where('login', $email)->first();
    
        if ($user)
        {
            if ($user['passe'] === $passe)
            {
                $session = session();
                $session->set('id_user', $user['id_admin']);
                $session->set('nom', $user['nom']);
                $session->set('login', $user['login']);

                return redirect()->to('admin/gain'); 
                // echo "tafiditra";
            } else {
                // Mot de passe incorrect
                return redirect()->to('/')->with('error', 'Mot de passe incorrect.');
            }
        } else {
            // Utilisateur non trouvé avec cet email
            return redirect()->to('/')->with('error', 'E-mail incorrect.');
        }
    }
    
    public function Accueil()
    {
        return view('Pages/gainAdmin');
        // return view('Layout/layout',$data);
    }

    public function register()
    {
        helper(['form']);
        $session = session();
        $model = new AdminModel();
        $data = [
            'nom' => $this->request->getPost('nom'),
            'login' => $this->request->getPost('login'),
            'passe' => $this->request->getPost('passe'),
            'user_type' => $this->request->getPost('user_type')
        ];

        if ($data){
            $rules = [
                'nom' => 'required',
                'login' => 'required|min_length[6]',
                'passe' => 'required|min_length[6]',
                'confirm_passe' => 'matches[passe]',
                'user_type' => 'required|in_list[admin,propriétaire]'
            ];

            if ($this->validate($rules))
            {

                $table = $data['user_type'] == 'admin' ? 'admin' : 'propriétaire';
                unset($data['user_type']);
                $model->registerUser($data,$table);
                return redirect()->to('/log');

            } else {
                $data['validation'] = $this->validator;
                echo "error validation";
            }
        }
    }


    public function logout()
    {
        // Déconnectez l'administrateur en supprimant sa session
        $session = session();
        $session->remove('admin_id');
        return redirect()->to('admin_login');
    }

    public function calculateCommission()
    {
        $locationModel = new LocationModel();
        $locationCommissionModel = new LocationCommissionModel();

        $date1 = $this->request->getPost('date1');
        $date2 = $this->request->getPost('date2');

        if(empty($date1) && empty($date2))
        {
            $locations = $locationModel->getLocations();
        }
        else{
            $locations = $locationModel->getLocationsByDate($date1, $date2);
        }
        foreach ($locations as $location) {
            $date_debut = $location['date_debut'];
            $date_fin_prevus = $location['date_fin_prevus'];
            $duree =0;

           

            if($date_debut >= $date1 && $date_debut <= $date2)
            {
                if ($date_fin_prevus > $date_debut && $date_fin_prevus <= $date2)
                {
                    $duree = $location['duree'];
                    $date_fin_prevus;
                }
                elseif( $date_fin_prevus > $date_debut && $date_fin_prevus >= $date2)
                {
                    $duree = $locationModel->calculateMonthsDifference($date_debut, $date2);
                    $date_fin_prevus = date('Y-m-d', strtotime("+$duree months", strtotime($date_debut)));
                }
            }
            $loyer_par_mois = $location['loyer_par_mois'];
            $taux_commission = $location['commission'] / 100;
            $montant_commission = $loyer_par_mois * $duree * $taux_commission;

            $locationCommissionModel->updateCommission(
                $location['id_location'],
                $location['id_bien'],
                $location['id_client'],
                $location['id_proprietaire'],
                $location['nom_bien'],
                $location['description'],
                $location['region'],
                $location['loyer_par_mois'],
                $location['nom_proprietaire'],
                $location['nom_typebien'],
                $location['commission'],
                $date_debut,
                $date_fin_prevus,
                $duree,
                $montant_commission);        
        }

        return redirect()->to('admin/gain'); 
    }
    
}
