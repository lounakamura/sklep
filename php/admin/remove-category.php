<?php
    session_start();

    require_once "../config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_POST['category'])) {
        header('Location: /sklep/admin.php');
    }

    $query = "DELETE FROM kategoria_1 WHERE kategoria_id=".$_POST['category'];
    $result = $connection->query($query);

    header('Location: /sklep/admin.php');
?>