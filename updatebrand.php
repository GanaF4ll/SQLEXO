<?php
require_once('settings/config.php');

// requete de lecture des festivals
$read = $db->prepare('SELECT * FROM brands');
$read->execute();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <?php include('partials/head.php'); ?>
    <title>Modifier une marque</title>
  </head>

  <body>
  <?php include('partials/header.php'); ?>

  <legend>Modifier une marque:</legend>
  <form method="POST" action="<?= $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
  <p>
    <label for="brand_id">ID de la marque:</label>
    <textarea name="brand_id"></textarea>
  </p>
  <p>
    <label for="brand_name">Nom de la marque:</label>
    <textarea name="brand_name"></textarea>
  </p>
  <p>
  <label for="brand_origin">Pays d'origine de la marque:</label>
    <textarea  name="brand_origin"></textarea>
  </p>
  <p>
  <label for="brand_logo">Logo de la marque:</label>
    <input type="file" name="brand_logo">
  </p>
  <p>
    <button type="submit" name="update">Valider</button>
  </p>
</form>
  </body>
  <?php include('partials/footer.php'); ?>
</html>