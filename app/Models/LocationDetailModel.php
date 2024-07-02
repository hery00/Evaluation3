<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationDetailModel extends Model
{
    protected $table = 'v_location_bien_type';
    protected $allowedFields = [
        'id_bien',
        'ref',
        'id_proprietaire',
        'nom_bien',
        'description',
        'region',
        'loyer_par_mois',
        'nom_typebien',
        'commission',
        'type_bien',
        'id_location',
        'id_client',
        'email',
        'telephone',
        'date_debut',
        'duree'
    ];

    public function getLocations()
    {
        $data=$this->findAll();
        return $data;
    }

    public function insertLocation($data)
    {
        // Insérer la location
        $this->insert($data);

        // Obtenir l'ID de la location insérée
        $idLocation = $this->insertID();

        // Générer des enregistrements détaillés pour la location
         $this->genererdetailslocations($idLocation);

    }

    
        public function genererdetailslocations($locationIDs)
        {
            $db = \Config\Database::connect();
            $locationBienTypeModel = new \App\Models\LocationDetailModel();
            
            foreach ($locationIDs as $idLocation) {
                $location = $this->where('id_location', $idLocation)->first();
    
                if (!$location) {
                    continue; // Si aucune location n'est trouvée, passer à l'itération suivante
                }
    
                // Récupérer les informations supplémentaires de la vue v_location_bien_type
                $locationDetails = $locationBienTypeModel->where('id_location', $idLocation)->first();
    
                if (!$locationDetails) {
                    continue; // Si aucun détail n'est trouvé, passer à l'itération suivante
                }
    
                $dateDebut = new \DateTime($location['date_debut']);
                $duree = $location['duree'];
                $idBien = $location['id_bien'];
                $idClient = $location['id_client'];
    
                for ($i = 0; $i < $duree; $i++) {
                    // Calculer la date de fin prévue pour ce mois
                    $paymentDate = (clone $dateDebut)->add(new \DateInterval('P' . $i . 'M'));
    
                    // Si c'est le dernier mois, ajuster la date de fin à la fin du mois
                    if ($i == $duree - 1) {
                        $paymentDate->modify('last day of this month');
                    } else {
                        // Sinon, ajuster la date de fin au dernier jour du mois
                        $paymentDate->setDate($paymentDate->format('Y'), $paymentDate->format('m'), cal_days_in_month(CAL_GREGORIAN, $paymentDate->format('m'), $paymentDate->format('Y')));
                    }
                    
                    // Déterminer la commission pour le mois en cours
                    $commission = $i == 0 ? 100.00 : $locationDetails['commission']; // 100% pour le premier mois, sinon commission définie
    
                    // Calculer le montant de la commission
                    $montantCommission = $locationDetails['loyer_par_mois'] * $commission / 100;
    
                    // Calculer les chiffres d'affaires
                    if ($i == 0) {
                        // Premier mois : CA_proprio = Loyer_par_mois
                        $CA_proprio = $locationDetails['loyer_par_mois'];
                    } else {
                        // Autres mois : CA_proprio = Loyer_par_mois - montantCommission
                        $CA_proprio = $locationDetails['loyer_par_mois'] - $montantCommission;
                    }
                    
                    // Calculer le chiffre d'affaires administrateur
                    $CA_admin = $locationDetails['loyer_par_mois'] + $montantCommission;
    
                    // Récupérer le numéro du mois (1 pour le premier mois, 2 pour le deuxième, etc.)
                    $numMois = $i + 1;
    
                    $paymentData = [
                        'id_location' => $idLocation,
                        'id_client' => $idClient,
                        'id_bien' => $idBien,
                        'duree' => $duree,
                        'date_debut' => $location['date_debut'],
                        'date_fin_prevus' => $paymentDate->format('Y-m-d'),
                        'loyer_par_mois' => $locationDetails['loyer_par_mois'],
                        'commission' => $commission,
                        'montant_commission' => $montantCommission,
                        'ca_admin' => $CA_admin,
                        'ca_proprio' => $CA_proprio,
                        'type_bien' => $locationDetails['nom_typebien'],
                        'id_proprietaire' => $locationDetails['id_proprietaire'],
                        'initial_payment_date' => $paymentDate->format('Y-m-d H:i:s'),
                        'payment_date' => $paymentDate->format('Y-m-d H:i:s'),
                        'num_mois' => $numMois,
                        'mois' => $paymentDate->format('m')
                    ];
                    
                    // Vérifier si l'entrée existe déjà dans detail_locations
                    $existingRecord = $db->table('detail_locations')
                                        ->where('id_location', $idLocation)
                                        ->where('date_debut', $location['date_debut'])
                                        ->where('date_fin_prevus', $paymentDate->format('Y-m-d'))
                                        ->countAllResults();
                    // Insérer les données uniquement si aucune entrée correspondante n'est trouvée
                    if ($existingRecord == 0) {
                        $db->table('detail_locations')->insert($paymentData);
                    }
                }
            }
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
