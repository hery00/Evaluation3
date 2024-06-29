<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'id_client';
    protected $allowedFields = ['nom', 'email','id_type_user'];


    public function getClient($email)
    {
        $client = $this->where('email',$email)
                        ->get()->getRowArray();
        if(!empty($client))
        {
            return $client;
        }
        return null;
    }
}
