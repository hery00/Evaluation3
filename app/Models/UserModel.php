<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = ['nom', 'login', 'passe'];

    public function getAdminUser($login, $passe)
    {
        $user = $this->db->table('admin')->where('login', $login)->get()->getRowArray();
        if ($user && password_verify($passe, $user['passe'])) {
            $user['table'] = 'admin';
            return $user;
        }
        return null;
    }

    public function getEquipeUser($login, $passe)
    {
        $user = $this->db->table('equipe')->where('login', $login)->get()->getRowArray();
        if ($user && password_verify($passe, $user['passe'])) {
            $user['table'] = 'equipe';
            return $user;
        }
        return null;
    }

    public function getUser($login,$passe)
     {
        $user = $this->getAdminUser($login, $passe);
        if ($user) {
            return $user;
        }

        // Check in equipe table
        $user = $this->getEquipeUser($login, $passe);
        if ($user) {
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

