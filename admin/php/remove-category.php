<?php
    session_start();

    require_once __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        header('Location: /sklep/index.php');
    }

    if (!isset($_POST['category'])) {
        header('Location: /sklep//admin/admin.php');
    }

    $query = "DELETE FROM kategoria_1 WHERE kategoria_id=".$_POST['category'];
    $result = $connection->query($query);

    header('Location: /sklep//admin/admin.php');
?>