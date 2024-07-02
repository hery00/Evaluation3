
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('/proprio/listebiens') ?>">
                <i class="bi bi-grid"></i>
                <span>Mes biens immobilier</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('/proprio/camois') ?>">
          <i class="bi bi-card-list"></i>
          <span>Chiffre d'Affaires par mois</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('/proprio/cafinal') ?>">
          <i class="bi bi-card-list"></i>
          <span>Chiffre d'Affaires Total par mois</span>
        </a>
        </li>
        <li class="nav-item">
            <center> 
                <form action="<?= site_url('/proprio/logout') ?>" method="post">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </center>
        </li>
    </ul>
</aside><!-- End Sidebar-->
