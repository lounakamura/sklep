<?php
    session_start();

    require_once "../config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_POST['maincategory'])) {
        header('Location: /sklep/admin.php');
    }
    
    $query = "INSERT INTO kategoria (kategoria) VALUES ('".$_POST['maincategory']."')";
    $result = $connection->query($query);

    header('Location: /sklep/admin.php');
?>