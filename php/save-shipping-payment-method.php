<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( (!isset($_POST['previous'])) || $_POST['previous'] != 'shipping') {
        header('Location: ..\order\shipping.php');
    }

    $_SESSION['order-info']['payment'] = $_POST['payment'];
    $_SESSION['order-info']['shipping'] = $_POST['shipping'];

    $_SESSION['previous'] = 'shipping';
    
    header('Location: ..\order\check.php');
    
    $connection->close();
?>