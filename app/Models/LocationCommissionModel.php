<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationCommissionModel extends Model
{
    protected $table = 'location_commission';
    protected $primaryKey = 'id_location';
    protected $allowedFields = ['id_bien', 'id_client', 'date_debut', 'date_fin_prevus', 'duree', 'montant_commission'];

    // Méthode pour insérer ou mettre à jour la commission
    public function updateCommission($id_location, $date_debut, $date_fin_prevus, $duree, $montant_commission)
    {
        $data = [
            'id_bien' => $this->getBienId($id_location),
            'id_client' => $this->getClientId($id_location),
            'date_debut' => $date_debut,
            'date_fin_prevus' => $date_fin_prevus,
            'duree' => $duree,
            'montant_commission' => $montant_commission
        ];

        // Mise à jour ou insertion
        if ($this->find($id_location)) {
            $this->update($id_location, $data);
        } else {
            $this->insert($data);
        }
    }

    // Méthodes pour obtenir id_bien et id_client basées sur id_location
    private function getBienId($id_location)
    {
        return $this->db->table('location')->where('id_location', $id_location)->get()->getRow()->id_bien;
    }

    private function getClientId($id_location)
    {
        return $this->db->table('location')->where('id_location', $id_location)->get()->getRow()->id_client;
    }
}
