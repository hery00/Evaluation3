<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\LocationDetailMoisModel;
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
    $locationmodel = new LocationDetailMoisModel();
    
    $date1 = $this->request->getGet('date1');
    $date2 = $this->request->getGet('date2');

    if (empty($date1) && empty($date2)) {
        $data['locations'] = $locationmodel->getLocationDetailMoisByClient($id_client);
    } else {
        $data['locations']  = $locationmodel->getLocationDetailMoisByDateByClient($date1, $date2,$id_client);
    }

    foreach ($data['locations'] as &$location) {
        $today = date("Y-m-d");
        $paymentDate = $location['payment_date']; 
        $yearToday = substr($today, 0, 4);
        $monthToday = substr($today, 5, 2);
        
        if ((substr($paymentDate, 0, 4) < $yearToday || (substr($paymentDate, 0, 4) == $yearToday && substr($paymentDate, 5, 2) < $monthToday))) {
            $location['status'] = "payer";
        } else {
            $location['status'] = "non payer";
        }
    }

    $content = view('Pages/listeloyer', $data);

    $layout_data = [
        'content' => $content
    ];

    return view('LayoutClient/layout', $layout_data);
}

    
    
    
    

}
