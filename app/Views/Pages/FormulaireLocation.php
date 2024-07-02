
<main id="main" class="main">
<section class="section">
    <div class="row">
    <div class="col-lg-4"></div>
      <div class="col-lg-4">
          <div class="card">
            <center>
            <div class="card-body">
              <h5 class="card-title">Formulaire d'insertion de location</h5>
              <!-- General Form Elements -->
              <form action="<?= base_url('location/createlocation') ?> " method="GET">
                <div class="">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="id_bien">
                    <option value="">Reference</option>
                        <?php foreach ($biens as $bien): ?> 
                            <option value="<?= $bien['id_bien'] ?>"><?= $bien['reference'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-1"></div>
                </div>
                <div class="">
                  <label for="" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="client" name="client" required  placeholder="email">
                  </div>
                  <div class="col-sm-1"></div>
                </div>
                <div class="">
                  <label for="" class="col-sm-2 col-form-label" ></label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="" name="date_debut" required placeholder="Date de début">
                  </div>
                </div>
                <div class="">
                  <label for="" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="duree" name="duree" required placeholder="Duree">
                  </div>
                </div>
                <br>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Insérer</button>
                </div>
              </form><!-- End General Form Elements -->
            </div>
            </center>
          </div>
      </div>
      <div class="col-lg-4"></div>
    </div>
</section>
</main>
