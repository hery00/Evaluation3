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
        $this->insert($data);
        $idLocation = $this->insertID();

        // Générer les enregistrements détaillés pour la location insérée
        $this->generateDetailedRecords([$idLocation]);
    }


}
