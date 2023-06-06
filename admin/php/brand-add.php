<?php
    session_start();

    require_once __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\admin.php');
    } else if (!isset($_POST['brand'])) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\admin.php');
    } else {
        $query = "INSERT INTO marka (marka) VALUES ('".$_POST['brand']."')";
        $result = $connection->query($query);

        $_SESSION['message'] = 'Marka została dodana!';
        $_SESSION['message-type'] = 'success';
        header('Location: ..\admin.php');
    }

    $connection->close();
?>