<?php
    session_start();

    require_once __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        header('Location: /sklep/index.php');
    }

    if (!isset($_POST['product'])) {
        header('Location: /sklep//admin/admin.php');
    }

    $query = "DELETE FROM produkt WHERE produkt_id=".$_POST['product'];
    $result = $connection->query($query);

    header('Location: /sklep//admin/admin.php');
?>