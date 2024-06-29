<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
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
            $userModel = new UserModel();
            $login = $this->request->getPost('login');
            $passe = $this->request->getPost('passe');
            $user = $userModel->getUser($login, $passe);
            if ($user)
            {
                $session = session();
                $session->set('id_user', $user['id_admin'] ?? $user['id_equipe']);
                $session->set('nom', $user['nom']);
                $session->set('login', $user['login']);
                $session->set('user_type', $user['table']);

                if($user['table'] == 'admin')
                {
                    return redirect()->to('listetapeadmin');
                }

                elseif($user['table'] == 'equipe')
                {
                    return redirect()->to('/accueil');
                }
                
            }

            else {
                echo $user['nom'];
                return redirect()->to('/log')->with('error', 'Login ou mot de passe incorrect.');
            }
    }

    public function Accueil()
    {
        $data = [
            'content' => view('Pages/dashboard')
        ];
        return view('Layout/layout',$data);
    }

    public function register()
    {
        helper(['form']);
        $session = session();
        $model = new UserModel();
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
                'user_type' => 'required|in_list[admin,equipe]'
            ];

            if ($this->validate($rules))
            {

                $table = $data['user_type'] == 'admin' ? 'admin' : 'equipe';
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

    
}
