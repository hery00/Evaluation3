<?php

namespace App\Models;

use CodeIgniter\Model;

class ImportResultatModel extends Model
{
    protected $table = 'import_resultat'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = [
        'etape_rang',
        'numero_dossard',
        'nom',
        'genre',
        'date_naissance',
        'equipe',
        'arrivee'
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
    public function insertCsvData($etape_rang, $numero_dossard, $nom, $genre, $date_naissance, $equipe, $arrivee)
    {
        $sql = "INSERT INTO import_resultat VALUES ('%d','%d','%s','%s','%s','%s')";
        $sql = sprintf($sql,$etape_rang, $numero_dossard, $nom, $genre, $date_naissance, $equipe, $arrivee);
        echo $sql;
        $this->db->query($sql);

    }
}
