<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipeModel extends Model
{
    protected $table = 'equipe';
    protected $primaryKey = 'id_equipe';
    protected $allowedFields = ['nom', 'login', 'passe'];

    public function getAllEquipes()
    {
        return $this->findAll();
    }

    public function insertEquipe($nom, $login, $passe)
    {
        $data = [
            'nom' => $nom,
            'login' => $login,
            'passe' => $passe
         ];
    
        return $this->insert($data);   
    }

}
