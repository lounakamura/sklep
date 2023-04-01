<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    // Only allow logged in users to add products to favourites
    if(!isset($_SESSION['loggedin'])) {
        echo "not logged in";
    } else {
        // Checking if product is already in user favourites
        $query = "SELECT ulubiony_id FROM ulubiony WHERE produkt_id=".$_POST['product_id']." AND uzytkownik_id=".$_SESSION['id'];
        $result = $connection->query($query);

        // If product is in favourites, remove it
        if (mysqli_num_rows($result)>0) { 
            $ulubiony_id = $result->fetch_assoc();
            $result->free();

            $query = "DELETE FROM ulubiony WHERE produkt_id=".$_POST['product_id']." AND uzytkownik_id=".$_SESSION['id'];
            $result = $connection->query($query);
        // If product is not in favourites, add it
        } else {
            $query = "INSERT INTO ulubiony (uzytkownik_id, produkt_id) VALUES (".$_SESSION['id'].", ".$_POST['product_id'].")";
            $result = $connection->query($query);
        }
    }
?>