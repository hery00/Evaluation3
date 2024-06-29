<?php

// App/Services/CourseService.php
namespace App\Services;

use App\Models\CoursesModel;

class CourseService
{
    protected $courseModel;

    public function __construct()
    {
        $this->courseModel = new CoursesModel();
    }

    public function getCourses()
    {
        return $this->courseModel->getCourses();
    }
}

?>