<?php

namespace App\Models;

use CodeIgniter\Model;

class EtapesModel extends Model
{
    protected $table = 'etape'; 
    protected $primaryKey = 'id_etape';
    protected $allowedFields = [
        'nom', 
        'longueur_km', 
        'nb_coureur', 
        'rang_etape', 
        'id_course', 
        'depart'
    ];
    protected $returnType = 'array';

    public function getEtapesByCourse()
    {
        return $this->findAll();
    }
    public function getEtapesById($id_etape)
    {
            return $this->where('id_etape', $id_etape)
            ->first();
    }
    public function getAllEtapes()
    {
        return $this->findAll();
    }

   
}
