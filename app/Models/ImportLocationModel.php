<?php

namespace App\Models;

use CodeIgniter\Model;

class ImportLocationModel extends Model
{
    protected $table = 'import_location'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = [
        'reference',
        'date_debut',
        'duree',
        'client'
    ];

    // Optionnel : Si vous avez des colonnes de création et de mise à jour automatiques
    protected $useTimestamps = false;
    
    // Si vous avez des colonnes created_at et updated_at, définissez-les ici
    // protected $createdField = 'created_at';
    // protected $updatedField = 'updated_at';

    /**
     * Insert data from CSV.
     *
     * @param string $etape_rang
     * @param float $numero_dossard
     * @param int $nom
     * @param int $genre
     * @param string $date_naissance
     * @param string $equipe
     * @return bool
     */
    public function insertCsvData($reference, $date_debut, $duree, $client)
    {
        $sql = "INSERT INTO import_location VALUES ('%s','%s','%d','%s')";
        $sql = sprintf($sql,$reference, $date_debut, $duree, $client);
        echo $sql;
        $this->db->query($sql);

    }
}
