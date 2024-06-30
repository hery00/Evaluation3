<main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <?php if (!empty($biens) && is_array($biens)): ?>
                    <?php foreach ($biens as $bien): ?>
                    <div class="col">
                        <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <?php if (!empty($bien['photo']) && !empty($bien['photo']['nom'])): ?>
                            <img src="<?= base_url('/assets/img/biens/' . esc($bien['photo']['nom'])) ?>" class="card-img-top" alt="Photo du bien">
                            <?php endif; ?>
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold fs-5 mb-0"><?= esc($bien['nom']) ?></h5>
                                <p class="card-text">
                                <span><?= esc($bien['description']) ?></span><br>
                                <span>Région: <?= esc($bien['region']) ?></span><br>
                                <span>Loyer par mois: <?= esc($bien['loyer_par_mois']) ?>Ar</span><br>
                                </p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                <p>Aucun bien trouvé pour ce propriétaire.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>