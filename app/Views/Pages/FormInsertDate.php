<main id="main" class="main">
<section class="section">
      <div class="row">
        <div class="col-lg-4">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ajouter Heure d'Arrivee</h5>

           
              <form action="<?= base_url('/updatearrivee') ?>" method="get">
              <input type="hidden" name="idetape" value=" <?= $participation['id_etape'] ?>">
              <input type="hidden" name="idcoureur" value=" <?= $participation['id_coureur'] ?> ">
              <input type="hidden" name="idequipe" value=" <?= $participation['id_equipe'] ?> ">
                <div class="row mb-3">
                  <label for="date" class="col-sm-2 col-form-label">Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="date">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputTime" class="col-sm-2 col-form-label">Time</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control" name="time" step="1">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
</section>
</main>