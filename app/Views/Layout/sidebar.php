<?php 
use App\Services\CourseService;
$courseService = new CourseService();
$courses = $courseService->getCourses();
?>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('/accueil') ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('/etapeparticipation') ?>">
          <i class="bi bi-card-list"></i>
          <span>Test etapes details</span>
        </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Resultats</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('/classementgeneral') ?>?indice=1">
                        <i class="bi bi-circle"></i><span>Classement général</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/generatepdf') ?>">
                        <i class="bi bi-circle"></i><span>Générer PDF</span>
                    </a>
                </li>
                <li>
                    <a href="forms-layouts.html">
                        <i class="bi bi-circle"></i><span>Classement général par équipe</span>
                    <a href="<?= base_url('/classementequipe') ?>?indice=1">
                        <i class="bi bi-circle"></i><span>Classement équipe</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->
    </ul>
</aside><!-- End Sidebar-->
