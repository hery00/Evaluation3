<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
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
            echo "tafiditra";
        } else {
            return redirect()->to('/client')->with('error', 'Votre email est incorrecte!');
                }
    }
    
}
