<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    $query = "DELETE FROM koszyk WHERE koszyk_id=".$_POST['cart_id'];
    $result = $connection->query($query);
?>