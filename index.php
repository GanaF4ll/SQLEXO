<?php
require_once('settings/config.php');

// requete de lecture des cars
$read = $db->prepare('SELECT cars.id, cars.name, brands.name AS brand, cars.colors, cars.realeaseyear, cars.image
FROM cars
INNER JOIN brands ON cars.brand_id = brands.id');
$read->execute();

// flash_in('success', 'good job!');

?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <?php include('partials/head.php'); ?>
    <title>Base de données</title>
  </head>

  <body>
  <?php include('partials/header.php'); ?>
  <p>Nombre de Marques: <?= $read->rowCount();?></p>
  <p>Nombre de voitures : <?= $read->rowCount();?></p>
  <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Marque</th>
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody>
        <?php while($data = $read->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
            <td><?= $data['id']; ?></td>
            <td><?= $data['name']; ?></td>
            <td><?= $data['brand']; ?></td>
            <td><?= $data['realeaseyear']; ?></td>
            </tr>
            <?php endwhile; ?>
    </tbody>
  </table>
  </body>
  <?php include('partials/footer.php'); ?>
</html>


