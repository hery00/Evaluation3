<?php

namespace App\Models;

use CodeIgniter\Model;

class CategorieModel extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id_categorie';
    protected $allowedFields = ['nom'];

    public function getAllCategories()
    {
        return $this->findAll(); 
    }
}
?>
