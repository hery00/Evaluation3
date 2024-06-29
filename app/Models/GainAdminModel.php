<?php

namespace App\Models;

use CodeIgniter\Model;

class GainAdminModel extends Model
{
    protected $table = 'gain_admin'; 

    protected $allowedFields = [
        'id_location',
        'id_bien',
        'nom_bien',
        'type_bien',
        'loyer_par_mois',
        'commission',
        'gain'
    ];

    public function getGains()
    {
        return $this->findAll();
    }

    public function getGainByLocation($id_location)
    {
        return $this->where('id_location', $id_location)->first();
    }

}
