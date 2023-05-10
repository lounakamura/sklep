<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( (!isset($_POST['first-name'], $_POST['last-name']) || (!isset($_POST['company-name'], $_POST['nip']))) || !isset($_POST['street'], $_POST['street-no'], $_POST['city'], $_POST['postal-code'], $_POST['country'], $_POST['phone'], $_POST['email'])) {
        header('Location: ..\order\information.php');
    }

    if($_POST['company'] == 'yes'){
        $_SESSION['isCompany'] = 1;
        $_SESSION['first-name'] = 'NULL';
        $_SESSION['last-name'] = 'NULL';
        $_SESSION['company-name'] = "'".$_POST['company-name']."'";
        $_SESSION['nip'] = "'".$_POST['nip']."'";
    } else {
        $_SESSION['isCompany'] = 0;
        $_SESSION['first-name'] = "'".$_POST['first-name']."'";
        $_SESSION['last-name'] = "'".$_POST['last-name']."'";
        $_SESSION['nip'] = 'NULL';
        $_SESSION['company-name'] = 'NULL';
    }
    $_SESSION['street'] = "'".$_POST['street']."'";
    $_SESSION['street-no'] = "'".$_POST['street-no']."'";
    if(isset($_POST['house-no'])){
        $_SESSION['house-no'] = "'".$_POST['house-no']."'";
    } else {
        $_SESSION['house-no'] = 'NULL';
    }
    $_SESSION['city'] = "'".$_POST['city']."'";
    $_SESSION['postal-code'] = "'".$_POST['postal-code']."'";
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['phone'] = "'".$_POST['phone']."'";
    $_SESSION['email'] = "'".$_POST['email']."'";

    if(isset($_POST['save-info']) && $_POST['save-info'] == 'yes'){
        $query = "INSERT INTO `uzytkownik_adres` (`uzytkownik_adres_id`, `uzytkownik_id`, `imie`, `nazwisko`, `ulica`, `nr_domu`, `nr_mieszkania`, `miasto`, `kod_pocztowy`, `kraj_id`, `telefon`, `czy_firma`, `nazwa_firmy`, `nip`) VALUES (NULL, ".$_SESSION['id'].", ".$_SESSION['first-name'].", ".$_SESSION['last-name'].", ".$_SESSION['street'].", ".$_SESSION['street-no'].", ".$_SESSION['house-no'].", ".$_SESSION['city'].", ".$_SESSION['postal-code'].", ".$_SESSION['country'].", ".$_SESSION['phone'].", ".$_SESSION['isCompany'].", ".$_SESSION['company-name'].", ".$_SESSION['nip'].")";
        echo $query;
        $result = $connection->query($query);
    }

    header('Location: ..\order\shipping.php');
    
    $connection->close();
?>