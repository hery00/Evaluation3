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
                        <form id="selectionForm" action="<?= base_url('/filtreclassementequipe') ?>" method="GET">
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
                        <th scope="col">id_equipe</th>
                        <th scope="col">id_categorie</th>
                        <th scope="col">nom_categorie</th>
                        <th scope="col">equipe_nom</th>
                        <th scope="col">total_points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classements as $classement) : ?>
                        <tr>
                            <td><?php echo $classement['id_equipe']; ?></td>
                            <td><?php echo $classement['id_categorie']; ?></td>
                            <td><?php echo $classement['nom_categorie']; ?></td>
                            <td><?php echo $classement['equipe_nom']; ?></td>
                            <td><?php echo $classement['total_points']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
          </div>
        </div>
      </div>
</section>
</main>


 