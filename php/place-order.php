<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( (!isset($_POST['place-order'])) || $_POST['place-order'] != 'yes') {
        header('Location: ..\order\check.php');
    }

    $cartProducts = [];

    $query = "SELECT p.produkt_id, p.cena, k.ilosc FROM koszyk AS k JOIN produkt as p USING (produkt_id) WHERE uzytkownik_id=".$_SESSION['id'];
    $result = $connection->query($query);
    fetchAllToArray($cartProducts, $result);
    $result->free();

    $query = "SELECT cena FROM metoda_dostawy WHERE metoda_dostawy_id=".$_SESSION['order-info']['shipping'];
    $result = $connection->query($query);
    $shippingPrice = $result->fetch_assoc()['cena'];
    $result->free();

    $orderTotal = $shippingPrice;
    foreach ($cartProducts as $cartProduct) {
        $orderTotal += $cartProduct['ilosc']*$cartProduct['cena'];
    }

    $query = "INSERT INTO zamowienie (zamowienie_id, uzytkownik_id, metoda_platnosci_id, metoda_dostawy_id, uwagi, do_zaplaty, klient_czy_firma, klient_imie, klient_nazwisko, klient_nazwa_firmy, klient_nip, klient_email, klient_telefon, adres_ulica, adres_nr_domu, adres_nr_mieszkania, adres_kod_pocztowy, adres_miasto, adres_kraj_id, status_id) VALUES ('', ".$_SESSION['id'].", ".$_SESSION['order-info']['payment'].", ".$_SESSION['order-info']['shipping'].", '".$_POST['remarks']."', '$orderTotal', ".$_SESSION['client-info']['isCompany'].", '".$_SESSION['client-info']['first-name']."', '".$_SESSION['client-info']['last-name']."', '".$_SESSION['client-info']['company-name']."', '".$_SESSION['client-info']['nip']."', '".$_SESSION['client-info']['email']."', '".$_SESSION['client-info']['phone']."', '".$_SESSION['client-info']['street']."', ".$_SESSION['client-info']['street-no'].", '".$_SESSION['client-info']['house-no']."', '".$_SESSION['client-info']['postal-code']."', '".$_SESSION['client-info']['city']."', ".$_SESSION['client-info']['country'].", '1')";
    $result = $connection->query($query);

    $query = "SELECT MAX(zamowienie_id) as id FROM zamowienie";
    $result = $connection->query($query);
    $order_id = $result->fetch_assoc()['id'];
    $result->free();

    foreach ($cartProducts as $cartProduct) {
        $query = "INSERT INTO zamowienie_produkt (zamowienie_produkt_id, zamowienie_id, produkt_id, ilosc, cena) VALUES (NULL, $order_id, '".$cartProduct['produkt_id']."', '".$cartProduct['ilosc']."', '".$cartProduct['cena']."')";
        $result = $connection->query($query);
    }

    $query = "DELETE FROM koszyk WHERE uzytkownik_id=".$_SESSION['id'];
    $result = $connection->query($query);

    /* header('Location: ..\order\.php'); */
    
    $connection->close();
?>