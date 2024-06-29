<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('') ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        <li class="nav-item">
        <a class="nav-link " href="<?= base_url('import') ?>">
            <i class="bi bi-menu-button-wide"></i>
            <span>Import de données</span>
        </a>
        </li>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('linkPoint') ?>">
                <i class="bi bi-grid"></i>
                <span>Import des points</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="<?=base_url('/listetapeadmin') ?>">
            <i class="bi bi-menu-button-wide"></i>
                <span>Liste Des Etapes</span>
            </a>
        </li>
        <li class="nav-item">
        <center><a href="<?= base_url('/generatecategories') ?>" class="btn btn-primary">Générer Catégories</a>
            </a></center>
        </li>
        <li class="nav-item">
            <center> 
            <a href action="<?= site_url('/resetables') ?>" class="btn btn-primary">Réinitialiser la base</a>
                </form>
            </center>
            <a class="nav-link " href="<?=base_url('/listpenalite') ?>">
            <i class="bi bi-menu-button-wide"></i>
                <span>Gerer les Pénalités</span>
            </a>
        </li>
      
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Resultats</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('/classementgeneral') ?>?indice=0">
                        <i class="bi bi-circle"></i><span>Classement général</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/classementequipe') ?>?indice=0">
                        <i class="bi bi-circle"></i><span>Classement équipe</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
        <center><a href="<?= base_url('/generatecategories') ?>" class="btn btn-primary">Générer Catégories</a>
            </a></center>
        </li>
        <li class="nav-item">
            <center> 
                <form action="<?= base_url('/resetables') ?>" method="get">
                    <button type="submit" class="btn btn-primary">Réinitialiser la base</button>
                </form>
            </center>
        </li>
    </ul>
</aside><!-- End Sidebar-->
