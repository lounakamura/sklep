<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
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
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>
    
    <main>
        <h1>Przypomnij hasło</h1>
        <h2 style='text-align:center; width:100%'>Ta opcja jest w tej chwili niedostępna</h2>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\social-media.html'; 
        require_once __DIR__.'\..\page-components\footer.html';
        require_once __DIR__.'\..\page-components\extras.html';
    ?>
</body>
</html>

<?php 
    require_once __DIR__.'\..\page-components\scripts.html';
    require_once __DIR__.'\..\page-components\popup-module.php';
?>

<?php
    $connection->close();
?>