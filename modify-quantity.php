<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    $query = "UPDATE koszyk SET ilosc = ".$_POST['quantity']." WHERE koszyk_id=".$_POST['cart_id'];
    $result = $connection->query($query);
?>