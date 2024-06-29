<?php

namespace App\Models;

use CodeIgniter\Model;

class PhotosModel extends Model
{
    protected $table = 'photos';
    protected $primaryKey = 'id_photo';
    protected $allowedFields = ['id_bien', 'nom'];

    public function getPhotosByBien($id_bien)
    {
        return $this->where('id_bien', $id_bien)->findAll();
    }
    public function getPhotoByBien($id_bien)
    {
        return $this->where('id_bien', $id_bien)
                    ->orderBy('id_photo', 'ASC')
                    ->first();
    }
}
