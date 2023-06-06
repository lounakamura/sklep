<?php
    session_start();

    require_once  __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    $_SESSION['message'] = 'Ten moduł nie został zaimplementowany!';
    $_SESSION['message-type'] = 'error';
    header("Location: ..\admin.php");

    $connection->close();
?>