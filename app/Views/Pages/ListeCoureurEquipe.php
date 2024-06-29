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
            <form id="choixForm" action="<?= base_url('/assignercoureur') ?>" method="GET">
              <div class="row mb-2">
                  <label class="col-sm-2 col-form-label">Etapes:</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="id_etape">
                      <option selected>Choisir Etape</option>
                      <?php foreach ($etapes as $etape): ?>
                        <option value="<?= $etape['id_etape'] ?>"><?= $etape['nom'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
              </div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nom du Coureur</th>
                  <th scope="col">Numéro de Dossard</th>
                  <th scope="col">Genre</th>
                  <th scope="col">Date de Naissance</th>
                  <th scope="col">Équipe</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($coureurs as $coureur): ?>
                <tr>
                    <td><?= $coureur['id_coureur'] ?></td>
                    <td><?= $coureur['nom'] ?></td>
                    <td><?= $coureur['numero_dossard'] ?></td>
                    <td><?= $coureur['genre'] ?></td>
                    <td><?= $coureur['date_naissance'] ?></td>
                    <td><input class="form-check-input" type="radio" name="id_coureur" id="id_coureur" value="<?= $coureur['id_coureur'] ?>" ></td> 
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <div class="row mb-3">
                    <button type="submit" class="btn btn-primary">Assigner</button>
                  </div>
            </div>
            </form>
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
