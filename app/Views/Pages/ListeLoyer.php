<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title">Liste des Loyers</h5>
                            </div>
                            
                            <form id="choixForm" action="<?= base_url('/client/listeloyer') ?>" method="GET">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="input-group col-md-4">
                                            <span class="input-group-text" id="inputGroupPrepend">Date Min</span>
                                            <input type="date" name="date1" class="form-control" id="date1" placeholder="Date Min" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group col-md-4">
                                            <span class="input-group-text" id="inputGroupPrepend">Date Max</span>
                                            <input type="date" name="date2" class="form-control" id="date2" placeholder="Date Max">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Filtrer</button>
                                    </div>
                                </div>
                            </form>
                            <?php if (!empty($loyers) && is_array($loyers)): ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID Location</th>
                                        <th>Nom Bien</th>
                                        <th>Description</th>
                                        <th>Region</th>
                                        <th>Loyer Par Mois</th>
                                        <th>Nom Propriétaire</th>
                                        <th>Nom Type Bien</th>
                                        <th>Commission</th>
                                        <th>Date Début</th>
                                        <th>Date Fin Prévu</th>
                                        <th>Montant Loyer</th>
                                        <th>Loyer À Payer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($loyers as $loyer): ?>
                                    <tr>
                                        <td><?= esc($loyer['id_location']); ?></td>
                                        <td><?= esc($loyer['nom_bien']); ?></td>
                                        <td><?= esc($loyer['description']); ?></td>
                                        <td><?= esc($loyer['region']); ?></td>
                                        <td><?= esc($loyer['loyer_par_mois']); ?></td>
                                        <td><?= esc($loyer['nom_proprietaire']); ?></td>
                                        <td><?= esc($loyer['nom_typebien']); ?></td>
                                        <td><?= esc($loyer['commission']); ?></td>
                                        <td><?= esc($loyer['date_debut']); ?></td>
                                        <td><?= esc($loyer['date_fin_prevus']); ?></td>
                                        <td><?= esc($loyer['montant_loyer']); ?></td>
                                        <td><?= esc($loyer['loyer_a_payer']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <p>Aucun loyer trouvé pour ce client.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
