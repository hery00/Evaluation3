<?php

namespace App\Models;

use CodeIgniter\Model;

class PenaliteModel extends Model
{
    protected $table = 'penalite';
    protected $primaryKey = 'id_penalite';
    protected $allowedFields = ['nom_etape', 'nom_equipe', 'penalite'];
    protected $useTimestamps = false;

   
    public function insertPenalite($data)
    {
        return $this->insert($data);
    }

    public function deletePenalite($id)
    {
        return $this->delete($id);
    }

    public function getAllPenalites()
    {
        return $this->findAll();
    }
}

