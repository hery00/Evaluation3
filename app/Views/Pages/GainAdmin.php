<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                            <div class="col-lg-6"><br/><br/><h5 class="card-title">LISTES DES GAINS</h5></div>
                            <div class="col-lg-6">
                            <br/><br/><h2 style="text-align: right">Chiffre d'Affaires: <?= esc($final_total)?> Mga</h2>
                            </div>  
                        </div>
                        <form id="choixForm" action="<?= base_url('/admin/gain') ?>" method="GET">
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
                    </div>
                
                <?php if (!empty($commissions) && is_array($commissions)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Bien</th>
                            <th>Date de Début</th>
                            <th>Date de Fin Prévue</th>
                            <th>Durée (mois)</th>
                            <th>Montant Commission (Ar)</th>
                            <th>Gains (Ar)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($commissions as $commission): ?>
                        <tr>
                            <td><?= esc($commission['id_bien']); ?></td>
                            <td><?= esc($commission['date_debut']); ?></td>
                            <td><?= esc($commission['date_fin_prevus']); ?></td>
                            <td><?= esc($commission['duree']); ?></td>
                            <td><?= esc($commission['montant_commission']); ?></td>
                            <td><?= esc($commission['total_loyer_commission']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p>Aucune commission trouvée.</p>
                <?php endif; ?>
            </div>
        </div>
        </div>
    </section>
</main>
