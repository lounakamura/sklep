<?php
    session_start();

    require_once "../config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        header('Location: /sklep/index.php');
    }

    if (!isset($_POST['subcategory'])) {
        header('Location: /sklep/admin.php');
    }

    $query = "DELETE FROM kategoria_2 WHERE kategoria_id=".$_POST['subcategory'];
    $result = $connection->query($query);

    header('Location: /sklep/admin.php');
?>