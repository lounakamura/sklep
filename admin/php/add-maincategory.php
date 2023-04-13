<?php
    session_start();

    require_once __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        header('Location: '.__DIR__.'\..\..\index.php');
    }

    if (!isset($_POST['maincategory'])) {
        header('Location: '.__DIR__.'\..\..\admin\admin.php');
    }
    
    $query = "INSERT INTO kategoria (kategoria) VALUES ('".$_POST['maincategory']."')";
    $result = $connection->query($query);

    header('Location: '.__DIR__.'\..\..\admin\admin.php');
?>