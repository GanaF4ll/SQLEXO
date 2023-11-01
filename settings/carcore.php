<?php
if (!empty($_POST) && isset($_POST['content2'])) {
    $_POST = array_map('trim', $_POST);

    $error = false;

    if (empty($_POST['car_name'])) {
        $error = true;
        flash_in('error', 'Le nom de la voiture est obligatoire');
    } elseif (strlen($_POST['car_name']) > 50) {
        $error = true;
        flash_in('error', 'Le nom de la voiture est trop long');
    }

    if (strlen($_POST['car_color']) > 50) {
        $error = true;
        flash_in('error', 'La couleur est trop longue');
    }

    if (strlen($_POST['car_release']) > 4) {
        $error = true;
        flash_in('error', 'La date est trop longue');
    }

    if ($_FILES["car_image"]["error"] == 0) {
        $uploadDir = "uploads/";

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = $uploadDir . uniqid() . "_" . $_FILES["car_image"]["name"];

        if (move_uploaded_file($_FILES["car_image"]["tmp_name"], $filename)) {
            $_POST['car_image'] = $filename;
        } else {
            $error = true;
            flash_in('error', 'Erreur lors du téléchargement de l\'image.');
        }
    } else {
        $_POST['car_image'] = 'uploads\65422b880ecbb_dessin.jpg';
    }

    if (!$error) {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare('INSERT INTO cars (name, colors, brand_id, realeaseyear, image) VALUES (:name, :color, :brand, :realeaseyear, :image)');

        $query->execute([
            ':name' => $_POST['car_name'],
            ':color' => $_POST['car_color'],
            ':brand' => $_POST['car_brand'],
            ':realeaseyear' => $_POST['car_release'],
            ':image' => $_POST['car_image']
        ]);

        $db = null;

        flash_in('success', 'Voiture enregistrée');

        header('Location: carcontent.php');
        exit();
    }
}
?>
