<?php

namespace App\Models;

use CodeIgniter\Model;

class ProprietaireModel extends Model
{
    protected $table = 'proprietaire';
    protected $primaryKey = 'id_proprietaire';
    protected $allowedFields = ['nom', 'telephone','id_type_user'];


    public function getProprietaire($num)
    {
        $proprio = $this->where('telephone',$num)
                        ->get()->getRowArray();
        if(!empty($proprio))
        {
            return $proprio;
        }
        return null;
    }

    // public function insertTelephoneProprio($telephone)
    //     {
    //         $sql = 'UPDATE coureur 
    //                 SET id_equipe = ?
    //                 WHERE id_coureur = (
    //                     SELECT id_coureur 
    //                     FROM coureur 
    //                     WHERE id_equipe IS NULL 
    //                     LIMIT 1
    //                 )';
    //         $this->db->query($sql, [$id]);
    //     }
}
