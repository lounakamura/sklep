<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        $query = "SELECT MAX(sesja_id) AS sesja_id FROM sesja";
        $result = $connection->query($query);
        
        $maxSession = $result->fetch_assoc();
        $_SESSION['session'] = $maxSession['sesja_id']+1;
        $query = "INSERT INTO sesja (sesja_id) VALUES (".$_SESSION['session'].")";
        $result = $connection->query($query);
    }

    $query = "SELECT koszyk_id FROM koszyk WHERE produkt_id=".$_POST['product_id']." AND sesja_id=".$_SESSION['session'];
    $result = $connection->query($query);
    if (mysqli_num_rows($result)>0) { //Dodac komunikat na stronie w przypadku proby dodania wiekszej ilosci niz 99
        $koszyk_id = $result->fetch_assoc();
        $query = "UPDATE koszyk SET ilosc = ilosc+".$_POST['quantity']." WHERE koszyk_id=".$koszyk_id['koszyk_id'];
        $result = $connection->query($query);
    } else {
        $query = "INSERT INTO koszyk (produkt_id, ilosc, sesja_id) VALUES (".$_POST['product_id'].", ".$_POST['quantity'].", ".$_SESSION['session'].")";
        $result = $connection->query($query);
    }
?>