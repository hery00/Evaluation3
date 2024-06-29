<?php

namespace App\Models;

use CodeIgniter\Model;

class ImportPointModel extends Model
{
    protected $table = 'import_point'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = [
        'classement',
        'point'
    ];

    // Optionnel : Si vous avez des colonnes de création et de mise à jour automatiques
    protected $useTimestamps = false;
    
    // Si vous avez des colonnes created_at et updated_at, définissez-les ici
    // protected $createdField = 'created_at';
    // protected $updatedField = 'updated_at';

    /**
     * Insert data from CSV.
     *
     * @param string $classement
     * @param float $point
     * @param int $nb_coureur
     * @param int $rang_classement
     * @param string $date_depart
     * @param string $heure_depart
     * @return bool
     */
    public function insertCsvPoint($classement, $point)
    {
        $sql = "INSERT INTO import_point VALUES ('%d','%d')";
        $sql = sprintf($sql,$classement, $point);
        echo $sql;
        $this->db->query($sql);

    }

    public function insert_point_base()
    {
        $sql = "INSERT INTO points (rang_point, points) SELECT classement, points FROM import_point GROUP BY classement, points ";
        $this->db->query($sql);
    }

}
