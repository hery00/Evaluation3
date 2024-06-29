<script>
        function submitForm() {
            var form = document.getElementById('selectionForm');
            var selects = form.getElementsByTagName('select');

            for (var i = 0; i < selects.length; i++) {
                if (selects[i].value === "") {
                    selects[i].removeAttribute('name'); // Remove the name attribute to avoid submitting it
                }
            }
            form.submit();
        }
    </script>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                    <div class="card-body">
                        <h5 class="card-title">Classement général</h5>
                        <form id="selectionForm" action="<?= base_url('/filtreClassement') ?>" method="GET">
                        <input type="hidden" name="indice" value="<?= $indice ?>">
                        <div class="col-md-2">
                            <select class="form-select" name="idetape" onchange="submitForm()">
                                <option value="">Choisir Etape</option>
                                <?php foreach ($etapes as $etape): ?>
                                    <option value="<?= $etape['id_etape'] ?>"><?= $etape['nom'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="idequipe" onchange="submitForm()">
                                <option value="">Choisir Equipe</option>
                                <?php foreach ($equipes as $equipe): ?>
                                    <option value="<?= $equipe['id_equipe'] ?>"><?= $equipe['nom'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="idcategorie" onchange="submitForm()">
                                <option value="">Choisir Categorie</option>
                                <?php foreach ($categories as $categorie): ?>
                                    <option value="<?= $categorie['id_categorie'] ?>"><?= $categorie['nom'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                    </div>

            <table class="table table-hover">
                <thead>
                    <tr>

                        <th scope="col">Nom de l'Etape</th>
                        <th scope="col">Nom de l'Équipe</th>
                        <th scope="col">Longueur</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Nb coureur</th>
                        <th scope="col">Rang etape</th>
                        <th scope="col">Coureur</th>
                        <th scope="col">Numero Dossard</th>
                        <th scope="col">Chronos</th>
                        <th scope="col">Rang</th>
                        <th scope="col">Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classements as $classement) : ?>
                        <tr>
                           
                            <td><?php echo $classement['etape_nom']; ?></td>
                            <td><?php echo $classement['equipe_nom']; ?></td>
                            <td><?php echo $classement['longueur_km']; ?></td>
                            <td><?php echo $classement['nom_categorie'];?></td>
                            <td><?php echo $classement['nb_coureur']; ?></td>
                            <td><?php echo $classement['rang_etape']; ?></td>
                            <td><?php echo $classement['coureur_nom']; ?></td>
                            <td><?php echo $classement['numero_dossard']; ?></td>
                            <td><?php echo $classement['chronos']; ?></td>
                            <td><?php echo $classement['rang']; ?></td>
                            <td><?php echo $classement['points']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
          </div>
        </div>
      </div>
</section>
</main>


 