
<main id="main" class="main">
<section class="section">
    <div class="row">
    <div class="col-lg-4"></div>
      <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">General Form Elements</h5>
              <!-- General Form Elements -->
              <form action="<?= base_url('/insert') ?> " method="get">
                <div class="row mb-3">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                    <option value="">Select Etape</option>
                    <?php foreach ($etapes as $etape )  : ?>
                      <option value="<?= $etape['id_etape'] ?>"><?= $etape['nom'] ?></option>
                    <?php endforeach ?>
                    </select>
                </div>
                <div class="col-sm-1"></div>
                </div>
                <div class="row mb-3">
                <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                      <option value="">Select equipe</option>
                      <?php foreach ($equipes as $equipe) : ?>
                      <option value="<?= $equipe['id_equipe'] ?>"><?= $equipe['nom'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-sm-1"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                    <input type="time" class="form-control" step=1>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row mb-3">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
              </form><!-- End General Form Elements -->
            </div>
          </div>
      </div>
      <div class="col-lg-4"></div>
    </div>
</section>
</main>
