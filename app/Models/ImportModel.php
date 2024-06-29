<?php

namespace App\Models;

use CodeIgniter\Model;

class ImportModel extends Model
{
    protected $table = 'import_etape';

    protected $allowedFields = ['etape', 'longueur', 'nb_coureur', 'rang_etape', 'date_depart', 'heure_depart'];

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
    
    public function insertCsvEquipe()
    {
        $sql = 'SELECT equipe FROM import_resultat GROUP BY equipe';
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $row)
        {
            $equipeModel = new EquipeModel();
            $nom = $row['equipe'];
            $login = $row['equipe']."@gmail.com";
            $passe = $nom;

            $equipeModel->insertEquipe($nom, $login, $passe);
        }
    }
    
    public function insertCsvCoureur()
    {
        $sql = 'SELECT numero_dossard, nom, genre, date_naissance FROM import_resultat GROUP BY numero_dossard, nom, genre, date_naissance';
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $row)
        {
            $coureurModel = new CoureurModel();
            $nom = $row['nom'];
            $numero_dossard = $row['numero_dossard'];
            $genre = $row['genre']; 
            $date_naissance = $row['date_naissance']; 

            $coureurModel->insertCoureur($nom, $numero_dossard, $genre, $date_naissance);
        }
    }
    

    // public function insertCsvArrivee()
    // {
    //     $sql = 'SELECT arrivee FROM import_resultat';
    //     $query = $this->db->query($sql);
    //     $results = $query->getResult();

    //     $participantModel = new ParticipantModel();
    //     foreach ($results as $row) {
    //         $arrivee = $row->arrivee;
    //         $participantModel->insertArrivee($arrivee);
    //     }
    // }


}
