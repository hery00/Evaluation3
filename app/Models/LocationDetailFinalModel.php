<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationDetailFinalModel extends Model
{
    protected $table = 'v_detail_locations';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['annee', 'num_mois', 'mois', 'total_ca_admin', 'total_ca_proprio', 'total_montant_commission']; // Champs autorisés

    public function getLocationDetailFinal()
    {
        return $this->findAll();
    }

    public function getLocationDetailFinalByDate($date1, $date2)
    {
    
        $start_month = date('m', strtotime($date1));
        $start_year = date('Y', strtotime($date1));
    
        $end_month = date('m', strtotime($date2));
        $end_year = date('Y', strtotime($date2));

        return $this->where("EXTRACT(MONTH FROM payment_date) >= $start_month")
                    ->where("EXTRACT(YEAR FROM payment_date) >= $start_year")
                    ->where("EXTRACT(MONTH FROM payment_date) <= $end_month")
                    ->where("EXTRACT(YEAR FROM payment_date) <= $end_year")
                    ->findAll();
    }
    public function getLocationDetailFinalByProprio($id_proprietaire)
    {
        return $this->where('id_proprietaire',$id_proprietaire)
                    ->findAll();
    }

    public function getLocationDetailFinalByDateByProprio($date1, $date2,$id_proprietaire)
    {
    
        $start_month = date('m', strtotime($date1));
        $start_year = date('Y', strtotime($date1));
    
        $end_month = date('m', strtotime($date2));
        $end_year = date('Y', strtotime($date2));

        return $this->where("EXTRACT(MONTH FROM payment_date) >= $start_month")
                    ->where("EXTRACT(YEAR FROM payment_date) >= $start_year")
                    ->where("EXTRACT(MONTH FROM payment_date) <= $end_month")
                    ->where("EXTRACT(YEAR FROM payment_date) <= $end_year")
                    ->where('id_proprietaire',$id_proprietaire)
                    ->findAll();
    }

}
