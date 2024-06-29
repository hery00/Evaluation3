<main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="card">
        <h3 class="card-header">Importation de données</h3>
          <div class="card-body">
          <form method="post" action="<?= base_url('importcsv') ?>" enctype="multipart/form-data">
              <div class="col-lg-6">
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Importation Etapes</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="file" name="fichier" id="csv_file" required accept=".csv">
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Importation Resultat</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="file" name="resultat" id="csv_file" required accept=".csv">
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                  </div>
                </div>
              </div>
            </form><!-- End General Form Elements -->
          </div>
        </div>
      </div>
    </section>
</main>