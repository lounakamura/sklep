<?php
    session_start();

    require_once __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: '.__DIR__.'\..\..\index.php');
    } else if (!isset($_POST['product'])) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\admin.php');
    } else {
        $query = "DELETE FROM produkt WHERE produkt_id=".$_POST['product'];
        $result = $connection->query($query);

        $_SESSION['message'] = 'Produkt został usunięty!';
        $_SESSION['message-type'] = 'success';
        header('Location:..\admin.php');
    }

    $connection->close();
?>