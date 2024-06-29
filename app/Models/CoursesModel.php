<?php

namespace App\Models;

use CodeIgniter\Model;

class CoursesModel extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'id_course';
    protected $allowedFields = ['nom_course'];

    public function getCourses()
    {
        return $this->findAll();
    }

}
