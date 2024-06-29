<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProprietaireModel;
use App\Models\BienModel;
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
        } else {
            return redirect()->to('/proprio')->with('error', 'Votre numero est incorrecte!');
                }
    }

    public function listebiensByProprietaire()
    {
        $session = session();
        $user = $session->get('user');
        $id_proprio=$user['id_proprietaire'];
        $model = new BienModel();
        $data['biens'] = $model->getBiensByProprietaire($id_proprio);
        $data =
        [
            'content' => view('Pages/ListeBiens',$data)
        ];
        return view('LayoutProprio/layout',$data);
    }


}
