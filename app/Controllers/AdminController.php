<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\LocationDetailFinalModel;
use App\Models\LocationDetailMoisModel;
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

                return redirect()->to('admin/gainmois'); 
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
    
    // public function Accueil()
    // {
    //     return view('Pages/gainAdmin');
    //     // return view('Layout/layout',$data);
    // }

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
        return redirect()->to('/');
    }

    public function link_formulaireLocation()
    {
        $data = [
            'content' => view('Pages/FormulaireLocation')
        ];
        return view('LayoutAdmin/layout',$data);
    }
    
    public function getCommissionFinal()
{
    $locationModel = new LocationDetailFinalModel();
    
    $date1 = $this->request->getGet('date1');
    $date2 = $this->request->getGet('date2');

    if (empty($date1) && empty($date2)) {
        $data['locations'] = $locationModel->getLocationDetailFinal();
    } else {
        $data['locations']  = $locationModel->getLocationDetailFinalByDate($date1, $date2);
    }


   
    $content = view('Pages/gainadminfinal', $data);

    $layout_data = [
        'content' => $content
    ];

    return view('LayoutAdmin/layout', $layout_data);
}

    public function getCommissionMois()
{
    $locationModel = new LocationDetailMoisModel();
    
    $date1 = $this->request->getGet('date1');
    $date2 = $this->request->getGet('date2');

    if (empty($date1) && empty($date2)) {
        $data['locations'] = $locationModel->getLocationDetailMois();
    } else {
        $data['locations']  = $locationModel->getLocationDetailMoisByDate($date1, $date2);
    }


   
    $content = view('Pages/gainadminmois', $data);

    $layout_data = [
        'content' => $content
    ];

    return view('LayoutAdmin/layout', $layout_data);
}


    
}
