<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationCommissionModel extends Model
{
    protected $table = 'location_commission';
    protected $primaryKey = 'id_commission';
    protected $allowedFields = [
        'id_bien',
        'id_client',
        'date_debut',
        'date_fin_prevus',
        'duree',
        'montant_commission'
    ];

    public function getCommissions()
    {
        return $this->findAll();
    }
    
    public function updateCommission($id_location, $id_bien, $id_client, $date_debut, $date_fin_prevus, $duree, $montant_commission)
    {
        $data = [
            'id_bien' => $id_bien,
            'id_client' => $id_client,
            'date_debut' => $date_debut,
            'date_fin_prevus' => $date_fin_prevus,
            'duree' => $duree,
            'montant_commission' => $montant_commission
        ];

        $this->insert($data);
    }
}
