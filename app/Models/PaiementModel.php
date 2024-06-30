<?php

namespace App\Models;

use CodeIgniter\Model;

class PaiementModel extends Model
{
    protected $table = 'paiementloyer';
    protected $primaryKey = 'id_paiement';
    protected $allowedFields = ['id_location', 'date_paiement', 'loyer_paye'];

    public function getPaymentsByLocation($id_location)
    {
        return $this->where('id_location', $id_location)
                    ->findAll();
    }

    public function getTotalPaid($id_location)
    {
        $this->selectSum('loyer_paye');
        $this->where('id_location', $id_location);
        $result = $this->get()->getRow();
        return $result->loyer_paye ?? 0;
    }
    
    public function payer($id_location, $date_paiement, $loyer_a_paye, $loyer_paye)
    {
        $data =
        [
            'id_location' => $id_location,
            'date_paiement' => $date_paiement,
            'loyer_a_paye' => $loyer_a_paye,
            'loyer_paye' => $loyer_paye
        ];
        
        return $this->insert($data);
    }



}


