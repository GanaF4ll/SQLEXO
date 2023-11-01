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
    <title>Marques</title>
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
  <p>Supprimer une marque <a href="deletebrand.php">ici</a></p>
  <legend>Ajouter une marque:</legend>
  <form method="POST" action="<?= $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
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
    <button type="submit" name="content">Valider</button>
  </p>
</form>
  </body>
  <?php include('partials/footer.php'); ?>
</html>