<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div div class="card-body">
                        <div class="row">
                            <div class="col-lg-6"><br/><br/><h5 class="card-title">LISTES LOCATION PROPRIETAIRE</h5></div>
                            <div class="col-lg-6">
                            <?php if (isset($ca['total_loyer_net'])): ?>
                            <br/><br/><h2 style="text-align: right">Chiffre d'affaire total: <?= $ca['total_loyer_net'] ?> Mga</h2>
                                    <?php endif; ?>
                            </div>  
                        </div>
                    </div>
                        
                    <form id="choixForm" action="<?= base_url('/proprio/location') ?>" method="GET">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                <div class="input-group col-md-4">
                                    <span class="input-group-text" id="inputGroupPrepend">Date Min</span>
                                    <input type="date" name="date1" class="form-control" id="date1" placeholder="Date Min">
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

                        
                        
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom Bien</th>
                                    <th scope="col">Région</th>
                                    <th scope="col">Nom Propriétaire</th>
                                    <th scope="col">Nom Type Bien</th>
                                    <th scope="col">Commission</th>
                                    <th scope="col">Date Début</th>
                                    <th scope="col">Durée</th>
                                    <th scope="col">Date Fin Prévue</th>
                                    <th scope="col">Loyer par Mois</th>
                                    <th scope="col">Loyer Net</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($locations as $location): ?>
                                    <tr>
                                        <td><?= $location['id_location'] ?></td>
                                        <td><?= $location['nom_bien'] ?></td>
                                        <td><?= $location['region'] ?></td>
                                        <td><?= $location['nom_proprietaire'] ?></td>
                                        <td><?= $location['nom_typebien'] ?></td>
                                        <td><?= $location['commission'] ?>%</td>
                                        <td><?= $location['date_debut'] ?></td>
                                        <td><?= $location['duree'] ?></td>
                                        <td><?= $location['date_fin_prevus'] ?></td>
                                        <td><?= $location['loyer_par_mois'] ?></td>
                                        <td><?= $location['loyer_net'] ?></td>
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
