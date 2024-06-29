<main id="main" class="main">
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <?php foreach ($result as $etapeId => $etapeData) : ?>
            <h2></h2>
            <ul>
        <div class="card col-lg-12">
          <div class="card-body">
            <h2 class="card-title">EQUIPE   <?= $id_equipe ?></h2>
            <h5 class="card-title"> Étape: <?php echo $etapeData['etape']['nom']; ?>(<?php echo $etapeData['etape']['longueur_km']; ?> km) - <?php echo $etapeData['etape']['nb_coureur']; ?> coureurs</h5>
            
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Nom du Coureur</th>
                  <th scope="col">Temps Chrono</th>
                </tr>
              </thead>
              <tbody>
                    <?php foreach ($etapeData['participations'] as $participation) : ?>
                <tr>
                    <td><?php echo $participation['coureur_nom']; ?></td>
                    <td><?php echo $participation['depart']; ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <a href="<?= base_url('/listecoureur') ?>"><button type="button" class="btn btn-primary choose-participants">Ajouter coureur</button></a>
            
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>