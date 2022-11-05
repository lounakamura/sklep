<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        $query = "SELECT MAX(sesja_id) AS sesja_id FROM sesja";
        $result = $connection->query($query);
        
        $maxSession = $result->fetch_assoc();
        $_SESSION['session'] = $maxSession+1;
        $query = "INSERT INTO sesja (sesja_id) VALUES (".$_SESSION['session'].")";
        $result = $connection->query($query);
    }

    $query = "INSERT INTO koszyk (produkt_id, ilosc, sesja_id) VALUES (".$_POST['product_id'].", )";
?>