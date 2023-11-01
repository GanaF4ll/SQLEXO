<?php
require_once('settings/config.php');

// Si le formulaire est soumis pour ajouter une nouvelle voiture
if (isset($_POST['content2'])) {
    // Récupérez les données du formulaire
    $carName = $_POST['car_name'];
    $carColor = $_POST['car_color'];
    $carReleaseYear = $_POST['car_release'];

    // Téléchargez l'image et récupérez son chemin
    if (isset($_FILES['car_image'])) {
        $uploadDir = "uploads/"; // Répertoire de destination pour les images
        $imagePath = $uploadDir . uniqid() . "_" . $_FILES['car_image']['name'];

        if (move_uploaded_file($_FILES['car_image']['tmp_name'], $imagePath)) {
            // L'image a été téléchargée avec succès, vous pouvez maintenant insérer les données dans la base de données
            $insert = $db->prepare('INSERT INTO cars (name, color, realeaseyear, image, brand_id) VALUES (?, ?, ?, ?, 13)');
            $insert->execute([$carName, $carColor, $carReleaseYear, $imagePath]);
        }
    }
}

// Requête de lecture des voitures
$read = $db->prepare('SELECT * FROM cars WHERE brand_id = 13');
$read->execute();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include('partials/head.php'); ?>
    <title>TEST</title>
</head>
<body>
    <?php include('partials/header.php'); ?>
    <p>Nombre de voitures test : <?= $read->rowCount(); ?></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Couleur</th>
                <th>Année de sortie</th>
                <th>Aperçu</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = $read->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?= $data['id']; ?></td>
                    <td><?= $data['name']; ?></td>
                    <td><?= $data['colors']; ?></td>
                    <td><?= $data['realeaseyear']; ?></td>
                    <td><img src="<?= $data['image']; ?>"></td>
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
            <textarea style="display: none;" name="car_brand">13</textarea>
        </p>
        <p>
            <button type="submit" name="content2">Valider</button>
        </p>
    </form>
</body>
<?php include('partials/footer.php'); ?>
</html>
