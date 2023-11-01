<?php
if (!empty($_POST) && isset($_POST['update'])) {
    $_POST = array_map('trim', $_POST);

    $error = false;

    if (empty($_POST['brand_name'])) {
        $error = true;
        flash_in('error', 'Le nom de la marque est obligatoire');
    } elseif (strlen($_POST['brand_name']) > 50) {
        $error = true;
        flash_in('error', 'Le nom de la marque est trop long');
    }

    if (strlen($_POST['brand_origin']) > 50) {
        $error = true;
        flash_in('error', 'Le lieu d\'origine de la marque est trop long');
    }


    if ($_FILES["brand_logo"]["error"] == 0) {
        $uploadDir = "uploads/";

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = $uploadDir . uniqid() . "_" . $_FILES["brand_logo"]["name"];

        if (move_uploaded_file($_FILES["brand_logo"]["tmp_name"], $filename)) {
            $_POST['brand_logo'] = $filename;
        } else {
            $error = true;
            flash_in('error', 'Erreur lors du téléchargement du logo.');
        }
    } else {
        $_POST['brand_logo'] = 'uploads\6542303f618e5_question.png'; 
    }

    if (!$error) {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['brand_id'])) {
            $query = $db->prepare('UPDATE brands SET name = :name, logo = :logo, origin = :origin WHERE id = :id');
            $query->execute([
                ':id' => $_POST['brand_id'],
                ':name' => $_POST['brand_name'],
                ':logo' => $_POST['brand_logo'],
                ':origin' => $_POST['brand_origin'],
            ]);
        }

        flash_in('success', 'Marque mise à jour');

        header('Location: updatebrand.php');
        exit();
    }
}
?>
