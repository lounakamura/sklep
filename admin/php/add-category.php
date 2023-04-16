<?php
    session_start();

    require_once __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        header('Location: '.__DIR__.'\..\..\index.php');
    }

    if (!isset($_POST['parent-category'] ,$_POST['category'])) {
        header('Location: ..\admin.php');
    }

    $query = "INSERT INTO kategoria_1 (parent_id, kategoria) VALUES (".$_POST['parent-category'].", '".$_POST['category']."')";
    $result = $connection->query($query);

    header('Location: ..\admin.php');
?>