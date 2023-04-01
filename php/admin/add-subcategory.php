<?php
    session_start();

    require_once "../config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_POST['parent-category'], $_POST['subcategory'])) {
        header('Location: /sklep/admin.php');
    }

    $query = "INSERT INTO kategoria_2 (parent_id, kategoria) VALUES (".$_POST['parent-category'].", '".$_POST['subcategory']."')";
    $result = $connection->query($query);

    header('Location: /sklep/admin.php');
?>