<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationDetailMoisModel extends Model
{
    protected $table = 'detail_locations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_location', 'id_client', 'id_bien', 'duree', 'date_debut', 'date_fin_prevus', 
        'loyer_par_mois', 'commission', 'montant_commission', 'ca_admin', 'ca_proprio', 
        'type_bien', 'id_proprietaire', 'initial_payment_date', 'payment_date', 'num_mois', 'mois'
    ];


    public function getLocationDetailMois()
    {
        return $this->findAll();
    }

    public function getLocationDetailMoisByDate($date1, $date2)
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


        public function getLastPaymentByBien($id_bien)
    {
        $builder = $this->db->table('detail_locations');
        $builder->select('*');
        $builder->where('id_bien', $id_bien);
        $builder->orderBy('date_fin_prevus', 'DESC');
        $builder->limit(1);
        return $builder->get()->getRowArray();
    }

    public function getLocationDetailMoisByProprio($id_proprietaire)
    {
        return $this->where('id_proprietaire',$id_proprietaire)
                    ->findAll();
    }

    public function getLocationDetailMoisByDateByProprio($date1,$date2,$id_proprietaire)
    {
        $start_month = date('m', strtotime($date1));
        $start_year = date('Y', strtotime($date1));
  
        $end_month = date('m', strtotime($date2));
        $end_year = date('Y', strtotime($date2));

        return $this->where("EXTRACT(MONTH FROM payment_date) >= $start_month")
                    ->where("EXTRACT(YEAR FROM payment_date) >= $start_year")
                    ->where("EXTRACT(MONTH FROM payment_date) <= $end_month")
                    ->where("EXTRACT(YEAR FROM payment_date) <= $end_year")
                    ->where('id_proprietaire', $id_proprietaire)
                    ->findAll();
    }


    public function getLocationDetailMoisByClient($id_client)
    {
        return $this->where('id_client',$id_client)
                    ->findAll();
    }

    public function getLocationDetailMoisByDateByClient($date1,$date2,$id_client)
    {
        $start_month = date('m', strtotime($date1));
        $start_year = date('Y', strtotime($date1));
  
        $end_month = date('m', strtotime($date2));
        $end_year = date('Y', strtotime($date2));

        return $this->where("EXTRACT(MONTH FROM payment_date) >= $start_month")
                    ->where("EXTRACT(YEAR FROM payment_date) >= $start_year")
                    ->where("EXTRACT(MONTH FROM payment_date) <= $end_month")
                    ->where("EXTRACT(YEAR FROM payment_date) <= $end_year")
                    ->where('id_client', $id_client)
                    ->findAll();
    }
}
