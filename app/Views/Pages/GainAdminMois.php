<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                            <div class="col-lg-6"><br/><br/><h5 class="card-title">LISTES DES GAINS</h5></div>
                            <div class="col-lg-6">
                            </div>  
                        </div>
                        <form id="choixForm" action="<?= base_url('/admin/gainmois') ?>" method="GET">
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
                
                <?php if (!empty($locations) && is_array($locations)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Numero mois</th>
                            <th>Designation</th>
                            <th>Mois</th>
                            <th>Revenue</th>
                            <th>Commission (%)</th>
                            <th>Gains Par mois</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($locations as $location): ?>
                        <tr>
                            <td><?= esc($location['num_mois']); ?></td>
                            <td><?= esc($location['type_bien']); ?></td>
                            <td><?= esc($location['payment_date']); ?></td>
                            <td><?= esc($location['ca_admin']); ?></td>
                            <td><?= esc($location['commission']); ?></td>
                            <td><?= esc($location['montant_commission']); ?></td>
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
