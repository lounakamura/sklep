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
        header('Location: /sklep/user/login.php');
    }

    require_once __DIR__.'\..\page-components\required.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje konto | Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="../images/ui/logo-small.svg">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>

    <main>
        <span>acc info</span>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\newsletter.html';
        require_once __DIR__.'\..\page-components\social-media.html'; 
        require_once __DIR__.'\..\page-components\footer.html';
        require_once __DIR__.'\..\page-components\extras.html';
    ?>

    <script src="../js/misc.js"></script>
    <script src="../js/scrollToTop.js"></script>
    <script src="../js/menuHandler.js"></script>
    <script src="../js/productQuantity.js"></script>
    <script src="../js/cartPreview.js"></script>
    <script src="../js/accountPreview.js"></script>
</body>
</html>

<?php
    $connection->close();
?>