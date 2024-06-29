<main id="main" class="main">
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <?php foreach ($result as $etapeId => $etapeData) : ?>
            <h2></h2>
            <ul>
        <div class="card col-lg-12">
          <div class="card-body">
            <h5 class="card-title"> Étape: <?php echo $etapeData['etape']['nom']; ?>(<?php echo $etapeData['etape']['longueur_km']; ?> km) - <?php echo $etapeData['etape']['nb_coureur']; ?> coureurs</h5>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nom du Coureur</th>
                        <th scope="col">Nom de l'Équipe</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Arrivée</th>
                        <th scope="col">Départ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($etapeData['participations'] as $participation) : ?>
                        <tr>
                           
                            <td><?php echo $participation['coureur_nom']; ?></td>
                            <td><?php echo $participation['equipe_nom']; ?></td>
                            <td><?php echo $participation['genre']; ?></td>
                            <td><?php echo $participation['arrivee']; ?></td>
                            <td><?php echo $participation['depart']; ?></td>
                            <td><a href="<?=base_url('/formupdatearrivee') ?>?idparticipation=<?= $participation['id_participation'] ?>"><button type="button" class="btn btn-primary ">Ajouter Arriver</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>