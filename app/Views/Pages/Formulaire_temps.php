<main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Formulaire de saisie de temps</h5>
            <form action="<?= base_url('') ?>" method="POST">
                <div class="row mb-3">
                  <label for="id_etape" class="col-sm-2 col-form-label">ID Étape</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_etape" name="id_etape" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="id_coureur" class="col-sm-2 col-form-label">ID Coureur</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_coureur" name="id_coureur" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="id_equipe" class="col-sm-2 col-form-label">ID Équipe</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_equipe" name="id_equipe" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="heure_arrivee" class="col-sm-2 col-form-label">Heure Arrivée</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control" id="heure_arrivee" name="heure_arrivee" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
            </div>
          </div>
        </div>
      </div>
    </section>
</main>
