<?php
    session_start();

    require_once "../config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        header('Location: /sklep/index.php');
    }

    if (!isset($_POST['parent-category'] ,$_POST['category'])) {
        header('Location: /sklep/admin.php');
    }

    $query = "INSERT INTO kategoria_1 (parent_id, kategoria) VALUES (".$_POST['parent-category'].", '".$_POST['category']."')";
    $result = $connection->query($query);

    header('Location: /sklep/admin.php');
?>