<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
    <link href="<?= base_url()?>assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link href="<?= base_url()?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body text-center">
          <h2 class="card-title mb-4">Connexion</h2>
          <p class="card-text">Veuillez choisir votre type de connexion :</p>
          <div class="btn_choix"><a href="<?= base_url('formcontroller/log') ?>?data=1" class="btn btn-primary btn-block" style="margin-right: 20px;">Client</a>
          <a href="<?= base_url('formcontroller/log') ?>" class="btn btn-secondary btn-block">Admin</a></div>
         
        </div>
      </div>
    </div>
  </div>
</div>

<!-- jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
