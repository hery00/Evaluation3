<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = 'v_location_bien_type'; 
    protected $primaryKey = 'id_location';
    protected $allowedFields = [
        'id_bien',
        'id_proprietaire ',
        'nom_bien',
        'description',
        'region',
        'loyer_par_mois',
        'nom_proprietaire',
        'nom_typebien',
        'commission',
        'id_location',
        'id_client',
        'date_debut',
        'duree',
        'date_fin_prevus'
    ]; 

    public function getLocations()
    {
        $data=$this->findAll();
        return $data;
    }

    public function getLocationsByDate($date1, $date2)
    {
        $data = $this->where('date_debut >=', $date1)
                    ->where('date_debut <=', $date2)
                    ->findAll();
        return $data;
    }

    public function getLocationsByDateByid($date1,$date2,$id_proprietaire)
    {
        $data = $this->where('date_debut >=', $date1)
                     ->where('date_debut <=', $date2)
                     ->where('id_proprietaire', $id_proprietaire)
                     ->findAll();
        return $data;
    }

}
