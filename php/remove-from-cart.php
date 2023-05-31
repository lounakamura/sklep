<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    // Remove item from cart based on cart_id
    $query = "DELETE FROM koszyk WHERE koszyk_id=".$_POST['cart_id'];
    $result = $connection->query($query);

    // Count the number of items in the cart afterwards
    $query = "SELECT COUNT(*) AS ilosc FROM koszyk WHERE sesja_id=".$_SESSION['session'];
    $result = $connection->query($query);
    $cartAmount = $result->fetch_assoc();
    $result->free();

    // Update cookie responsible for amount of items in the cart
    setcookie('cart-amount', $cartAmount['ilosc'], '0', '/sklep'); 

    $connection->close();
?>