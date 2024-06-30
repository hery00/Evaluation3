<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaiementModel;
use App\Models\LocationModel;
use CodeIgniter\HTTP\ResponseInterface;

class PaiementController extends BaseController
{
    public function payer()
    {
        $paymentModel = new PaiementModel();
        $locationModel = new LocationModel();

        $data = [
            'id_location' => $this->request->getPost('id_location'),
            'date_paiement' => $this->request->getPost('date_paiement'),
            'loyer_paye' => $this->request->getPost('loyer_paye'),
        ];

        $totalPaid = $paymentModel->getTotalPaid($data['id_location']);
        $location = $locationModel->find($data['id_location']);
        $totalRent = $location['loyer_par_mois'] * $location['duree'];

        if ($totalPaid + $data['loyer_paye'] > $totalRent) {
            return redirect()->back()->with('error', 'Total payment exceeds the rent amount.');
        }

        $paymentModel->save($data);
        return redirect()->to('/payments/index/' . $data['id_location'])->with('success', 'Payment recorded successfully.');
    }
}
