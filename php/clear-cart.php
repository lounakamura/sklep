<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    // Remove all items from cart
    $query = "DELETE FROM koszyk WHERE sesja_id=".$_SESSION['session'];
    $result = $connection->query($query);

    $cartAmount['ilosc'] = 0;

    // Update cookie responsible for amount of items in the cart
    setcookie('cart-amount', $cartAmount['ilosc'], '0', '/sklep'); 
?>