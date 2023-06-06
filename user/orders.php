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
    }

    $orders = [];
    
    $query = "SELECT * FROM zamowienie WHERE uzytkownik_id=".$_SESSION['id'];
    $result = $connection->query($query);
    fetchAllToArray($orders, $result);
    $result->free();

    /* foreach ($orders as $order) {
        $query = "SELECT z_p.produkt_id, p.nazwa, p.cena, z_p.ilosc, CONCAT(z.sciezka, z.nazwa) AS zdjecie FROM zamowienie_produkt AS z_p JOIN produkt as p USING (produkt_id) JOIN zdjecie AS z USING (produkt_id) WHERE zamowienie_id=".$orders['zamowienie_id']." GROUP BY p.produkt_id";
        $result = $connection->query($query);
        fetchAllToArray($order, $result);
        $result->free();
    } */

    require_once __DIR__.'\..\page-components\required.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje zamówienia | Drogeria internetowa Kosmetykowo.pl</title>
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
        <div class='breadcrumbs'>
            <ul>
                <li><a href='/sklep/index.php'>Strona Główna</a></li>
                <li><a href='/sklep/user/account.php'>Konto</a></li>
                <li><a href='/sklep/user/orders.php'>Zamówienia</a></li>
            </ul>
        </div>

        <h2 style='text-align:center; width:100%'>Ten moduł jest w tej chwili niedostępny</h2>
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