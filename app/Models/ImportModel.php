<?php

namespace App\Models;

use CodeIgniter\Model;

class ImportModel extends Model
{
    protected $table = 'import_bien';

    protected $allowedFields = ['reference', 'nom', 'description', 'type', 'region', 'loyer_mensuel', 'proprietaire'];

    // Méthode pour insérer les données
    // public function insertCsvData($data)
    // {
    //     return $this->insert($data);
    // }
    public function import_csv($filepath, $ligneDeb = 1, $ligneFin = -1, $separateur = ',', $enclosure = '"')
        {
            if (!file_exists($filepath) || !is_readable($filepath)) {
                return false;
            }

            $donnees = [];
            if (($fichier_handle = fopen($filepath, 'r')) !== false) {
                $nligne = 1;
                while (($ligne = fgetcsv($fichier_handle, 1000, $separateur, $enclosure)) !== false) {
                    if ($ligneFin > 0) {
                        if ($nligne >= $ligneDeb && $nligne <= $ligneFin) {
                            $donnees[] = $ligne;
                        } 
                    } else {
                        if ($nligne >= $ligneDeb) {
                            $donnees[] = $ligne;
                        }
                    }
                    $nligne++;
                }
                fclose($fichier_handle);
            }

            return $donnees;
        }
    
    public function insertCsvProprietaire()
    {
        $this->db->query('ALTER TABLE bien DISABLE TRIGGER ALL;');

        $sql="INSERT INTO proprietaire (telephone) 
        SELECT proprietaire 
        FROM import_bien 
        GROUP BY proprietaire";
        
        $this->db->query($sql);
        $this->db->query('ALTER TABLE bien ENABLE TRIGGER ALL;');
    }   
 

    public function insertCsvBien()
    {
        $this->db->query('ALTER TABLE bien DISABLE TRIGGER ALL;');

        $sql="INSERT INTO bien (reference, nom, description, region, loyer_par_mois, id_proprietaire, id_typebien) 
        SELECT ib.reference, ib.nom, ib.description, ib.region, ib.loyer_mensuel, p.id_proprietaire, t.id_typebien 
        FROM import_bien ib 
        JOIN proprietaire p ON p.telephone = ib.proprietaire 
        JOIN typedebien t ON t.nom = ib.type 
        GROUP BY ib.reference, ib.nom, ib.description, t.id_typebien, ib.region, ib.loyer_mensuel, p.id_proprietaire";
        
        $this->db->query($sql);
        $this->db->query('ALTER TABLE bien ENABLE TRIGGER ALL;');
    }

    public function insertCsvCommission()
    {
        $this->db->query('ALTER TABLE typedebien DISABLE TRIGGER ALL;');

        $sql="INSERT INTO typedebien (nom,commission) 
        SELECT nom,commission
        FROM import_commission
        GROUP BY nom,commission";
        
        $this->db->query($sql);
        $this->db->query('ALTER TABLE typedebien ENABLE TRIGGER ALL;');
    }
    //location
    // public function insertCsvIdBienInLocation()
    // {
    //     $locationModel = new LocationModel();
    //     $this->db->query('ALTER TABLE bien DISABLE TRIGGER ALL;');
    
    //     $sql = 'SELECT id_bien FROM bien';
    //     $query = $this->db->query($sql);
    
    //     foreach ($query->getResultArray() as $row) {
    //         $id_bien = $row['id_bien'];
    //         $locationModel->insertIdBien($id_bien);
    //     }
    
    //     // Enable triggers again after the update is complete
    //     $this->db->query('ALTER TABLE bien ENABLE TRIGGER ALL;');
    // }

    public function insertCsvClient()
    {
        $this->db->query('ALTER TABLE location DISABLE TRIGGER ALL;');

        $sql="INSERT INTO client (email) 
        SELECT client 
        FROM import_location 
        GROUP BY client";
        
        $this->db->query($sql);
        $this->db->query('ALTER TABLE location ENABLE TRIGGER ALL;');
    }   
    
    public function insertCsvLocation()
    {
        $this->db->query('ALTER TABLE location DISABLE TRIGGER ALL;');
        $sql="INSERT INTO location (id_bien, id_client, date_debut, duree) 
        SELECT b.id_bien, c.id_client, il.date_debut, il.duree
        FROM import_location il 
        JOIN bien b ON b.reference = il.reference 
        JOIN client c ON c.email = il.client 
        GROUP BY b.id_bien, il.date_debut, il.duree, c.id_client";
        $this->db->query($sql);
        $this->db->query('ALTER TABLE location ENABLE TRIGGER ALL;');
    }

    // public function insertCsvCommission()
    // {
    //     $this->db->query('ALTER TABLE location DISABLE TRIGGER ALL;');
    //     $sql="INSERT INTO location (id_bien, id_client, date_debut, duree) 
    //     SELECT b.id_bien, c.id_client, il.date_debut, il.duree
    //     FROM import_location il 
    //     JOIN bien b ON b.reference = il.reference 
    //     JOIN client c ON c.email = il.client 
    //     GROUP BY b.id_bien, il.date_debut, il.duree, c.id_client";

    //     $this->db->query($sql);
    //     $this->db->query('ALTER TABLE location ENABLE TRIGGER ALL;');
    // }

}
