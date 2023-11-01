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
    <title>Supprimer une marque</title>
  </head>

  <body>
  <?php include('partials/header.php'); ?>
  <p>Nombre de Marques: <?= $read->rowCount();?></p>
  <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Logo</th>
            <th>Origine</th>
            
        </tr>
    </thead>
    <tbody>
        <?php while($data = $read->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
            <td><?= $data['id']; ?></td>
            <td><?= $data['name']; ?></td>
            <td><img src=<?= $data['logo']; ?>></td>
            <td><?= $data['origin']; ?></td>
            </tr>
            <?php endwhile; ?>
    </tbody>
  </table>
  <p>Certaines de nos informations sont incorrectes ? Modifiez-les vous-même <a href="updatebrand.php">ici</a></p>
  <legend>Supprimer une marque:</legend>
  <form method="POST" action="<?= $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
  <p>
  <label for="brand_id">ID de la marque:</label>
    <textarea  name="brand_id"></textarea>
  </p>
  <p>
    <button type="submit" name="delete">Valider</button>
  </p>
</form>
  </body>
  <?php include('partials/footer.php'); ?>
</html>