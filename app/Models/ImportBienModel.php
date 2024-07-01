<?php

namespace App\Models;

use CodeIgniter\Model;

class ImportBienModel extends Model
{
    protected $table = 'import_bien'; // Le nom de votre table
    protected $primaryKey = 'id'; // Supposons que vous avez une colonne id comme clé primaire

    protected $allowedFields = [
        'reference',
        'nom',
        'description',
        'type',
        'region',
        'loyer_mensuel',
        'proprietaire'
    ];

    // Optionnel : Si vous avez des colonnes de création et de mise à jour automatiques
    protected $useTimestamps = false;
    
    // Si vous avez des colonnes created_at et updated_at, définissez-les ici
    // protected $createdField = 'created_at';
    // protected $updatedField = 'updated_at';

    /**
     * Insert data from CSV.
     *
     * @param string $etape
     * @param float $longueur
     * @param int $nb_coureur
     * @param int $rang_etape
     * @param string $date_depart
     * @param string $heure_depart
     * @return bool
     */
    public function insertCsvData($reference, $nom, $description, $type, $region, $loyer_mensuel, $proprietaire)
    {
        $sql = "INSERT INTO import_bien VALUES ('%s','%s','%s','%s','%s','%d','%s')";
        $sql = sprintf($sql,$reference, $nom, $description, $type, $region, $loyer_mensuel, $proprietaire);
        echo $sql;
        $this->db->query($sql);

    }

    // public function insert_etapecsv()
    // {
    //     $query = 'INSERT INTO Etape (nom, longueur_km, nb_coureur, rang_etape,depart)
    //         SELECT 
    //             etape, 
    //             longueur, 
    //             nb_coureur, 
    //             rang_etape,
    //             (date_depart + heure_depart) AS depart
    //         FROM import_etape
    //         GROUP BY etape, longueur, nb_coureur, rang_etape, date_depart,heure_depart';

    //     $this->db->query($query);
    // }
    

}
