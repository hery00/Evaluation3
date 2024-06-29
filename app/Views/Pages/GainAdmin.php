<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calculer la Commission</title>
</head>
<body>
    <h1>Calculer la Commission</h1>
    <form action="<?= site_url('admin/calculateCommission') ?>" method="post">
        <label for="date1">Date Début:</label>
        <input type="date" id="date1" name="date1" required><br>

        <label for="date2">Date Fin:</label>
        <input type="date" id="date2" name="date2" required><br>

        <input type="submit" value="Calculer">
    </form>
</body>
</html>
