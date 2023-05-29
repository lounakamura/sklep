<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( (!isset($_POST['first-name'], $_POST['last-name']) || (!isset($_POST['company-name'], $_POST['nip']))) || !isset($_POST['street'], $_POST['street-no'], $_POST['city'], $_POST['postal-code'], $_POST['country'], $_POST['phone'], $_POST['email'])) {
        header('Location: ..\order\information.php');
    }

    $_SESSION['client-info'] = [];

    if($_POST['company'] == 'yes'){
        $_SESSION['client-info']['isCompany'] = 1;
        $_SESSION['client-info']['first-name'] = NULL;
        $_SESSION['client-info']['last-name'] = NULL;
        $_SESSION['client-info']['company-name'] = $_POST['company-name'];
        $_SESSION['client-info']['nip'] = $_POST['nip'];
    } else {
        $_SESSION['client-info']['isCompany'] = 0;
        $_SESSION['client-info']['first-name'] = $_POST['first-name'];
        $_SESSION['client-info']['last-name'] = $_POST['last-name'];
        $_SESSION['client-info']['nip'] = NULL;
        $_SESSION['client-info']['company-name'] = NULL;
    }

    $_SESSION['client-info']['street'] = $_POST['street'];
    $_SESSION['client-info']['street-no'] = $_POST['street-no'];
    if(isset($_POST['house-no'])){
        $_SESSION['client-info']['house-no'] = $_POST['house-no'];
    } else {
        $_SESSION['client-info']['house-no'] = NULL;
    }
    $_SESSION['client-info']['city'] = $_POST['city'];
    $_SESSION['client-info']['postal-code'] = $_POST['postal-code'];
    $_SESSION['client-info']['country'] = $_POST['country'];
    $_SESSION['client-info']['phone'] = $_POST['phone'];
    $_SESSION['client-info']['email'] = $_POST['email'];
    
    header('Location: ..\order\shipping.php');
    
    $connection->close();
?>