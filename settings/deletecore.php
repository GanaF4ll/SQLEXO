<?php
if (isset($_GET['brand_id'])) {
    $brandId = $_GET['brand_id'];
    
    try {
        $db = new PDO("mysql:host=localhost;dbname=cars", "root", "123456");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query = $db->prepare('DELETE FROM brands WHERE id = :id');
        $query->execute([':id' => $brandId]);
        
        $db = null;
        
        // Redirection après la suppression
        header('Location: deletebrand.php');
        exit();
    } catch (PDOException $e) {

    }
}
