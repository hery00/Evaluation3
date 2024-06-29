<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipantModel extends Model
{
    protected $table = 'participation';
    protected $primaryKey = 'id_participation';
    protected $allowedFields = [
        'id_etape', 
        'id_coureur', 
        'id_equipe', 
        'arrivee'
    ];

    public function EfaParticipant($id_etape, $id_equipe, $id_coureur)
    {
        $participant = $this->where([
            'id_etape' => $id_etape,
            'id_equipe' => $id_equipe,
            'id_coureur' => $id_coureur
        ])->first();
        if($participant)
        {
            return true;
        }
        return false;
    }

    public function countparticipant($id_etape, $id_equipe)
    {
        return $this->where('id_etape', $id_etape)
        ->where('id_equipe', $id_equipe)
        ->countAllResults();
    }

    public function insertParticipation($id_etape, $id_equipe, $id_coureur)
    {
        $data = [
                'id_etape' => $id_etape,
                'id_equipe' => $id_equipe,
                'id_coureur' => $id_coureur
             ];
        
            return $this->insert($data);   
    }

    public function getParticipationsByEtape($id_etape)
    {
        return $this->where('id_etape', $id_etape)->findAll();
    }

    public function getParticipationsById($id_participation)
    {
        return $this->where('id_participation', $id_participation)->first();
    }

    public function updateArrivee($idParticipant, $idParticipation, $idCoureur, $arrivee)
    {
        // Vérifier si les données à mettre à jour existent
        $participant = $this->find($idParticipant);

        if ($participant) {
            // Données à mettre à jour
            $data = [
                'id_participation' => $idParticipation,
                'id_coureur' => $idCoureur,
                'arrivee' => $arrivee,
            ];

            // Mettre à jour les données
            return $this->update($idParticipant, $data);
        } else {
            // Gérer le cas où il n'y a pas de données à mettre à jour
            return false;
        }
    }

    // public function insertArrivee($arrivee)
    // {
    //     $data = ['arrivee' => $arrivee] ;
    //     return $this->insert($data);   
    // }
}




