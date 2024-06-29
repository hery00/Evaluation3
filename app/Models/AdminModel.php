<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = ['nom', 'login', 'passe'];

    public function getAdminUser($login, $passe)
    {
        $user = $this->where('login', $login)
                     ->where('passe', $passe)
                     ->get()->getRowArray();
            
        if(!empty($user))
        {
            return $user;
        }
        return null;
       
    }

    public function registerUser($data, $table)
    {
        $data['passe'] = password_hash($data['passe'], PASSWORD_DEFAULT);
        return $this->db->table($table)->insert($data);
    }
}

