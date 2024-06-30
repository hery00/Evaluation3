<?php

namespace App\Models;

use CodeIgniter\Model;

class LoyerModel extends Model
{
    protected $table = 'v_client_loyer';

    public function getLoyerByClient($id_client)
    {
        return $this->where('id_client', $id_client)->findAll();
    }
}
