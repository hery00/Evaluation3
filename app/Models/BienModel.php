<?php

namespace App\Models;

use CodeIgniter\Model;

class BienModel extends Model
{
    protected $table = 'bien';
    protected $primaryKey = 'id_bien';
    protected $allowedFields = ['nom', 'description', 'region', 'loyer_par_mois', 'id_proprietaire', 'id_typebien'];

    public function getBiensByProprietaire($id_proprietaire)
    {
        return $this->where('id_proprietaire', $id_proprietaire)->findAll();
    }
}
