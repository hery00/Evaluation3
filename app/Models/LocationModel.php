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


function calculateMonthsDifference($startDate, $endDate) {
    $start = new \DateTime($startDate);
    $end = new \DateTime($endDate);
    
    if ($start > $end) {
        list($start, $end) = [$end, $start];
    }
    
    $startYear = (int)$start->format('Y');
    $startMonth = (int)$start->format('m');
    $endYear = (int)$end->format('Y');
    $endMonth = (int)$end->format('m');
    
    $monthsDifference = (($endYear - $startYear) * 12) + ($endMonth - $startMonth) + 1; 

    return $monthsDifference;
}



    public function getLocationsNetByProprio($id_proprietaire)
    {
        $data = $this->where('id_proprietaire',$id_proprietaire)
                    ->findAll();
        return $data;
    }
    
    public function getLocationsNetByDateByProprio($date1,$date2,$id_proprietaire)
    {
        $data = $this->where('date_debut >=', $date1)
                     ->where('date_debut <=', $date2)
                     ->where('id_proprietaire',$id_proprietaire)
                    ->findAll();
        return $data;
    }


    public function getLocationsByClient($id_client)
    {
        $data = $this->where('id_client',$id_client)
                    ->findAll();
        return $data;
    }
    
    public function getLocationsByDateByClient($date1,$date2,$id_client)
    {
        $data = $this->where('date_debut >=', $date1)
                     ->where('date_debut <=', $date2)
                     ->where('id_client',$id_client)
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
