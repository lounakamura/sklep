<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    // Checking if product is already in the cart
    $query = "SELECT koszyk_id FROM koszyk WHERE produkt_id=".$_POST['product_id']." AND sesja_id=".$_SESSION['session'];
    $result = $connection->query($query);

    // If product is in the cart, update value || Dodac komunikat na stronie w przypadku proby dodania wiekszej ilosci niz 99
    if (mysqli_num_rows($result)>0) { 
        $koszyk_id = $result->fetch_assoc();
        $query = "UPDATE koszyk SET ilosc = ilosc+".$_POST['quantity']." WHERE koszyk_id=".$koszyk_id['koszyk_id'];
        $result = $connection->query($query);
    
    // If product is not in the cart, add it
    } else { 
        $query = "INSERT INTO koszyk (produkt_id, ilosc, sesja_id) VALUES (".$_POST['product_id'].", ".$_POST['quantity'].", ".$_SESSION['session'].")";
        $result = $connection->query($query);
        
        // Count the number of items in the cart afterwards
        $query = "SELECT COUNT(*) AS ilosc FROM koszyk WHERE sesja_id=".$_SESSION['session'];
        $result = $connection->query($query);
        $cartAmount = $result->fetch_assoc();
        $result->free();

        // Update cookie responsible for amount of items in the cart
        setcookie('cart-amount', $cartAmount['ilosc'], '0', '/sklep');
    }
?>