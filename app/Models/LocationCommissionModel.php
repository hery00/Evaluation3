<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationCommissionModel extends Model
{
    protected $table = 'location_commission';
    protected $primaryKey = 'id_location';
    protected $allowedFields = [
        'id_bien',
        'id_proprietaire',
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
        'date_fin_prevus',
        'montant_commission',
    ]; 

    public function getCommissions()
    {
        return $this->findAll();
    }

    public function getCommissionFiltrer($date1, $date2)
    {
        return $this->where('date_debut',$date1)
                    ->where('date_fin_prevus',$date2)
                    ->findAll();
    }
    
    public function updateCommission($id_location, $id_bien, $id_client, $id_proprietaire, $nom_bien, $description, $region, $loyer_par_mois, $nom_proprietaire, $nom_typebien, $commission, $date_debut, $date_fin_prevus, $duree, $montant_commission)
    {
        $data = [
            'id_location' =>$id_location,
            'id_bien' => $id_bien,
            'id_client' => $id_client,
            'id_proprietaire' => $id_proprietaire,
            'nom_bien' => $nom_bien,
            'description' => $description,
            'region' => $region,
            'loyer_par_mois' => $loyer_par_mois,
            'nom_proprietaire' => $nom_proprietaire,
            'nom_typebien' => $nom_typebien,
            'commission' => $commission,
            'date_debut' => $date_debut,
            'date_fin_prevus' => $date_fin_prevus,
            'duree' => $duree,
            'montant_commission' => $montant_commission
        ];
        $existingCommission = $this->where('id_bien', $id_bien)
                                    ->where('id_client', $id_client)
                                    ->where('date_debut', $date_debut)
                                    ->where('date_fin_prevus', $date_fin_prevus)
                                    ->first();
    
        if (!$existingCommission)
        {
            $this->insert($data);
        }
    }
    
}
