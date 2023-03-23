<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    // Checking if product is already in the cart
    $query = "SELECT koszyk_id FROM koszyk WHERE produkt_id=".$_POST['product_id']." AND sesja_id=".$_SESSION['session'];
    $result = $connection->query($query);

    // If product is in the cart, update value
    if (mysqli_num_rows($result)>0) { 
        $koszyk_id = $result->fetch_assoc();
        $result->free();

        // Preventing cart amount higher than 99
        $query = "SELECT ilosc FROM koszyk WHERE produkt_id=".$_POST['product_id']." AND sesja_id=".$_SESSION['session'];
        $result = $connection->query($query);
        $productAmount = $result->fetch_assoc();
        if (($_POST['quantity']+$productAmount['ilosc'])>99) {
            echo "error";
        } else {
            $query = "UPDATE koszyk SET ilosc = ilosc+".$_POST['quantity']." WHERE koszyk_id=".$koszyk_id['koszyk_id'];
            $result = $connection->query($query);
        }
    
    // If product is not in the cart, add it
    } else {
        if(isset($_SESSION['loggedin'])){
            $query = "INSERT INTO koszyk (produkt_id, ilosc, sesja_id, uzytkownik_id) VALUES (".$_POST['product_id'].", ".$_POST['quantity'].", ".$_SESSION['session'].", ".$_SESSION['id'].")";
        } else {
            $query = "INSERT INTO koszyk (produkt_id, ilosc, sesja_id) VALUES (".$_POST['product_id'].", ".$_POST['quantity'].", ".$_SESSION['session'].")";
        }
        
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