<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choix d'option</title>
  <!-- CSS Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main id="main" class="main">
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">LISTE DE VOS COUREURS </h5>
            <form id="choixForm" action="<?= base_url('/coureur/equipe') ?>" method="GET">
              <select class="form-control" id="options" name="idcategorie">
                <option value="">Sélectionner Catégorie</option>
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
                  <th scope="col">Nom du Coureur</th>
                  <th scope="col">Numéro de Dossard</th>
                  <th scope="col">Genre</th>
                  <th scope="col">Date de Naissance</th>
                  <th scope="col">Équipe</th>
                  <th scope="col">Catégorie</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($coureurs as $coureur): ?>
                <tr>
                    <td><?= $coureur['id_coureur'] ?></td>
                    <td><?= $coureur['coureur_nom'] ?></td>
                    <td><?= $coureur['numero_dossard'] ?></td>
                    <td><?= $coureur['genre'] ?></td>
                    <td><?= $coureur['date_naissance'] ?></td>
                    <td><?= $coureur['equipe_nom'] ?></td>
                    <td><?= $coureur['categorie_nom'] ?></td>
                    <td><a href="<?= base_url('/choisircoureur') ?>?id_coureur=<?= $coureur['id_coureur'] ?>&id_equipe=<?= $coureur['id_equipe'] ?>">
                    <button type="button" class="btn btn-primary choose-participants" data-coureur="<?= $coureur['id_coureur'] ?>">Choisir</button></a></td>
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

<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Erreur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= session()->getFlashdata('error') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#options').change(function() {
            $('#choixForm').submit(); 
        });

        // Affiche la modal si une erreur est présente
        <?php if (session()->getFlashdata('error')): ?>
            $('#errorModal').modal('show');
        <?php endif; ?>
    });
</script>

</body>
</html>