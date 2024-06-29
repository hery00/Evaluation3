<?php

namespace App\Models;

use CodeIgniter\Model;

class VequipeModel extends Model
{
    protected $table            = 'vequipes';
    protected $allowedFields    = ['id_equipe','equipe'];

    public function getAll()
    {
        return $this->findAll();
    }

    public function insertId()
    {
        $sql = 'SELECT id_equipe FROM vEquipe GROUP BY id_equipe';
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $row)
        {
            $coureurModel = new CoureurModel();
            $id = $row['id_equipe'];

            $coureurModel->insertEquipe($id);
        }
        // public function insertCsvArrivee()
        // {
        //     $sql = 'SELECT arrivee FROM import_resultat';
        //     $query = $this->db->query($sql);
        //     $results = $query->getResult();
    
        //     $participantModel = new ParticipantModel();
        //     foreach ($results as $row) {
        //         $arrivee = $row->arrivee;
        //         $participantModel->insertArrivee($arrivee);
        //     }
        // }
    }
   
}
