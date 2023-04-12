<?php
    $maincategories = [];
    
    // Storing the main categories
    $query = "SELECT * FROM kategoria";
    $result = $connection->query($query);
    fetchAllToArray($maincategories, $result);
    $result->free();

    // Storing cart amount
    $query = "SELECT COUNT(*) AS ilosc FROM koszyk WHERE ";
    if(isset($_SESSION['loggedin'])){
        $query .= "uzytkownik_id=".$_SESSION['id'];
    } else {
        $query .= "sesja_id=".$_SESSION['session'];
    }    
    $result = $connection->query($query);
    $cartAmount = $result->fetch_assoc();
    $result->free();

    setcookie('cart-amount', $cartAmount['ilosc'], '0' , '/sklep');
?>