<?php
    session_start();

    require_once __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: '.__DIR__.'\..\..\index.php');
    } else if (!isset($_POST['parent-category'] ,$_POST['category'])) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\admin.php');
    } else {
        $query = "INSERT INTO kategoria_1 (parent_id, kategoria) VALUES (".$_POST['parent-category'].", '".$_POST['category']."')";
        $result = $connection->query($query);

        $_SESSION['message'] = 'Kategoria produktów została dodana!';
        $_SESSION['message-type'] = 'success';
        header('Location: ..\admin.php');
    }

    $connection->close();
?>