<?php
require_once('settings/config.php');

// requete de lecture des cars
$read = $db->prepare('SELECT * FROM cars WHERE brand_id = 6');
$read->execute();
$brandid = 1;

// flash_in('success', 'good job!');

?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <?php include('partials/head.php'); ?>
    <title>Tesla</title>
  </head>

  <body>
  <?php include('partials/header.php'); ?>
  
  <p>Nombre de voitures Tesla: <?= $read->rowCount();?></p>

  <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Année de sortie</th>
            <th>Aperçu</th>
        </tr>
    </thead>
    <tbody>
        <?php while($data = $read->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
            <td><?= $data['id']; ?></td>
            <td><?= $data['name']; ?></td>
            <td><?= $data['realeaseyear']; ?></td>
            <td><img src=<?= $data['image']; ?>></td>
            </tr>
            <?php endwhile; ?>
    </tbody>
  </table>
  <p>Certaines de nos informations sont incorrectes ? Modifiez-les vous-même <a href="updatecar.php">ici</a></p>
  <legend>Ajouter une voiture</legend>
  <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <p>
            <textarea placeholder="Nom de la voiture" name="car_name"></textarea>
        </p>
        <p>
            <textarea placeholder="Couleur de la voiture" name="car_color"></textarea>
        </p>
        <p>
            <textarea placeholder="Année de sortie" name="car_release"></textarea>
        </p>
        <p>
            <input type="file" name="car_image">
        </p>
        <p>
            <textarea style="display: none;" name="car_brand">6</textarea>
        </p>
        <p>
            <button type="submit" name="content2">Valider</button>
        </p>
    </form>
  </body>
  <?php include('partials/footer.php'); ?>
</html>