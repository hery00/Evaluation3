<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{

    protected $table = 'location';
    protected $primaryKey = 'id_location';
    protected $allowedFields = ['id_bien', 'id_client', 'date_debut', 'duree'];
    
    public function getLocations()
    {
        return $this->findAll();
    }

    public function getAllLocationIDs()
    {
        $locations = $this->findAll();
        $locationIDs = array_column($locations, 'id_location');
        return $locationIDs;
    }

    public function insertLocation($data)
    {
        $existingLocation = $this->where('id_bien', $data['id_bien'])
                                 ->where('id_client', $data['id_client'])
                                 ->where('date_debut', $data['date_debut'])
                                 ->first();

        if ($existingLocation) {
            return false; 
        }
        $this->insert($data);

        // Retourner l'ID de la nouvelle location
        return $this->getInsertID();
    }


}
