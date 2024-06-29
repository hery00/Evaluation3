
<main id="main" class="main">
<section class="section">
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">LISTE DES PENALITES</h5>
            <form id="choixForm" action="<?= base_url('/forminsert') ?>" method="GET">
            <div class="row mb-3">
              <div class="col-mb-4"></div>
                <div class="col-mb-4">
                <button type="submit" class="btn btn-primary">Ajouter Penalité</button>
                </div>
              <div class="col-mb-4"></div>
            </div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Etape</th>
                  <th scope="col">Equipe</th>
                  <th scope="col">Penalité</th>
                </tr>
              </thead>
              <tbody>
              <tbody>
              <?php foreach ($penalites as $penalite): ?>
                <tr>
                    <td><?= $penalite['nom_etape'] ?></td>
                    <td><?= $penalite['nom_equipe'] ?></td>
                    <td><?= $penalite['penalite'] ?></td>
                    <td><input class="form-check-input" type="radio" name="id_coureur" id="id_coureur" value="<?= $coureur['id_coureur'] ?>" ></td> 
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-2"></div>
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
