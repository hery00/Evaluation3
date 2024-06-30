<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calculer la Commission</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main id="main" class="main">
        <section class="section py-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <h1 class="mb-4">Calculer la Commission</h1>
                        <form action="<?= site_url('admin/gain') ?>" method="GET" class="mb-5">
                            <div class="mb-3">
                                <label for="date1" class="form-label">Date Début:</label>
                                <input type="date" id="date1" name="date1" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="date2" class="form-label">Date Fin:</label>
                                <input type="date" id="date2" name="date2" class="form-control" required>
                                <button type="submit" class="btn btn-primary">Filtrer</button>
                            </div>
                        </form>
                    </div>
                </div> 
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php if (!empty($commissions) && is_array($commissions)): ?>
                        <?php foreach ($commissions as $commission): ?>
                            <div class="col">
                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold fs-5 mb-0">Commission pour Bien ID: <?= esc($commission['id_bien']) ?></h5>
                                                <p class="card-text">
                                                    <span>Date de début: <?= esc($commission['date_debut']) ?></span><br>
                                                    <span>Date de fin prévue: <?= esc($commission['date_fin_prevus']) ?></span><br>
                                                    <span>Duree: <?= esc($commission['duree']) ?> mois</span><br>
                                                    <span>Montant Commission: <?= esc($commission['montant_commission']) ?> Ar</span><br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucune commission trouvée.</p>
                    <?php endif; ?>
                </div>

            </div>
        </section>
    </main>

    <!-- Inclure Bootstrap JS et Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
