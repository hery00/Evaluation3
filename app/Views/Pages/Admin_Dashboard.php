<main id="main" class="main">
  
  <!-- Table with hoverable rows -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Les Etapes de la Course <?= $id_course ?></h5>
            <a href="<?= base_url('/generate-categories') ?>" class="btn btn-primary">Générer Catégories</a>
            <form id="choixForm" action="<?base_url('') ?>" method="GET">
              <select class="form-control" id="options" name="idcategorie">
              <option value="">Selectionner Categorie</option>
                <option value="1">Homme</option>
                <option value="2">Femme</option>
                <option value="3">Junior</option>
                <option value="4">Senior</option>
              </select>
            </form>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Longueur en km</th>
                  <th scope="col">NB coureurs/equipe</th>
                  <th scope="col">Rang etape</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($etapes as $etape): ?>
                <tr>
                  <form method="get" action="<?= base_url('formulaire') ?>">
                  <th scope="row"><?= $etape['id_etape'] ?></th>
                  <td><?= $etape['nom'] ?></td>
                  <td><?= $etape['longueur_km'] ?></td>
                  <td><?= $etape['nb_coureur'] ?></td>
                  <td><?= $etape['rang_etape'] ?></td>
                  <td><button type="submit" class="btn btn-primary choose-participants" data-toggle="modal" data-target="#participantsModal">Saisir le temps</button></td>
                  </form>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

