<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( !isset($_POST['first-name'], $_POST['last-name'], $_POST['username'], $_POST['email'], $_POST['phone']) ) {
        header('Location: ..\user\account.php');
    }

    $query = "UPDATE uzytkownik SET imie = '".$_POST['first-name']."', nazwisko = '".$_POST['last-name']."', nazwa = '".$_POST['username']."',
    email = '".$_POST['email']."', numer_telefonu = '".$_POST['phone']."' WHERE uzytkownik_id=".$_SESSION['id'];
    $result = $connection->query($query);

    header('Location: ..\user\account.php');

    $connection->close();
?>