<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    if(!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
    } else if(!isset($_POST['place-order'])) {
        header('Location: check.php');
    }

    require_once __DIR__.'\..\page-components\required.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\..\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/order.css">
</head>

<body>
    <header class='header-small'>
        <div class="logo_big-container">
            <a href="/sklep/index.php"><img class="logo_big" src="/sklep/images/ui/logo-big.svg" /></a>
        </div>
    </header>

    <main>
        <form class='payment' onsubmit="return false">
            <input type='hidden' name='order-paid' value='yes'>
            <button type='button' id='pay' onclick='payment();'>Zapłać</button>
        </form>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\extras.html';
    ?>
</body>
</html>

<script src="/sklep/js/misc.js"></script>

<?php
    $connection->close();
?>