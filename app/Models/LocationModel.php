<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = 'v_location_net'; 
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
        'date_fin_prevus',
        'loyer_net',
    ]; 

    public function getLocations()
    {
        $data=$this->findAll();
        return $data;
    }

    public function getLocationsByDate($date1,$date2)
    {
        $data = $this->where('date_debut >=', $date1)
                    ->where('date_debut <=', $date2)
                    ->findAll();
        return $data;
    }
<<<<<<< Updated upstream

    public function calculateMonthsDifference($date_debut, $date_fin_prevus)
    {
        $query = $this->db->query("
            SELECT EXTRACT(YEAR FROM AGE(?::date, ?::date)) * 12 + EXTRACT(MONTH FROM AGE(?::date, ?::date)) AS months_difference
        ", [$date_fin_prevus, $date_debut, $date_fin_prevus, $date_debut]);

        return $query->getRow()->months_difference;
    }

    public function getLocationsByDateByid($date1,$date2,$id_proprietaire)
=======
    
    public function getLocationsNetByProprio($id_proprietaire)
    {
        $data = $this->where('id_proprietaire',$id_proprietaire)
                    ->findAll();
        return $data;
    }
    
    public function getLocationsNetByDateByProprio($date1,$date2,$id_proprietaire)
>>>>>>> Stashed changes
    {
        $data = $this->where('date_debut >=', $date1)
                     ->where('date_debut <=', $date2)
                     ->where('id_proprietaire',$id_proprietaire)
                    ->findAll();
        return $data;
    }

    public function getChiffreAffaireProprio($id_proprietaire)
    {
        $builder = $this->db->table($this->table);
        $builder->select("SUM(loyer_net) AS total_loyer_net")
                ->where('id_proprietaire',$id_proprietaire);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getChiffreAffaireProprioByDate($date1,$date2,$id_proprietaire)
    {
        $builder = $this->db->table($this->table);
        $builder->select("SUM(loyer_net) AS total_loyer_net")
                ->where('date_debut >=', $date1)
                ->where('date_debut <=', $date2)
                ->where('id_proprietaire',$id_proprietaire);
        $query = $builder->get();
        return $query->getRowArray();
    }

   

}
