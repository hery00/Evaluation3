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

    public function calculateMonthsDifference($date1, $date2)
{
    $dateTime1 = new \DateTime($date1);
    $dateTime2 = new \DateTime($date2);

    // Récupérer le jour du mois pour la date de début et la date de fin
    $dayOfMonthStart = (int) $dateTime1->format('d');
    $dayOfMonthEnd = (int) $dateTime2->format('d');

    // Récupérer le mois pour la date de début et la date de fin
    $monthStart = (int) $dateTime1->format('m');
    $monthEnd = (int) $dateTime2->format('m');

    // Récupérer l'année pour la date de début et la date de fin
    $yearStart = (int) $dateTime1->format('Y');
    $yearEnd = (int) $dateTime2->format('Y');

    // Calculer la différence en mois
    $months_difference = $dateTime2->diff($dateTime1)->format('%m');

    // Condition 1 : Si le jour de la date fin <= le jour de la date début mais le mois de la date début < mois de la date fin et les années sont les mêmes
    if ($dayOfMonthEnd <= $dayOfMonthStart && $monthStart < $monthEnd && $yearStart == $yearEnd) {
        $months_difference++;
    }

    // Condition 2 : Si le jour de la date début < jour de la date fin et ils appartiennent au même mois et le jour de la date fin <= fin du mois
    if ($dayOfMonthStart < $dayOfMonthEnd && $monthStart == $monthEnd && $dayOfMonthEnd <= $dateTime2->format('t')) {
        $months_difference++;
    }

    // Condition 3 : Si le jour de la date fin >= premier jour de son mois et son mois > mois de la date début
    if ($dayOfMonthEnd >= 1 && $monthEnd > $monthStart) {
        $months_difference++;
    }

    // Assurer que le résultat est au moins 1 mois si la date de début et de fin sont les mêmes
    
    if ($months_difference <= 0)
    {
        $months_difference = 1;
    }

    return $months_difference;
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
