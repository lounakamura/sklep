<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    $shippingMethods = [];

    $query = "SELECT * FROM metoda_dostawy";
    $result = $connection->query($query);
    fetchAllToArray($shippingMethods, $result);
    $result->free();

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
    <link rel="stylesheet" href="/sklep/css/customer-service.css">
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>

    <main>
        <div class='shipping-payment'>
            <div class='shipping-forms'>
                <h1>Formy dostawy</h1>
                <?php
                    foreach ($shippingMethods as $shippingMethod) {
                        echo "<div>
                            <div>
                                <span>".$shippingMethod['rodzaj']."</span>
                                <span>Dostawa ".$shippingMethod['oczekiwanie_min']."-".$shippingMethod['oczekiwanie_max']." dni roboczych</span>
                            </div>
                            <div>
                                <span>
                                    <span>".str_replace('.', ',',$shippingMethod['cena'])."</span> zł
                                </span>
                                <img src='".$shippingMethod['zdjecie_sciezka']."'>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\newsletter.html';
        require_once __DIR__.'\..\page-components\social-media.html'; 
        require_once __DIR__.'\..\page-components\footer.html';
        require_once __DIR__.'\..\page-components\extras.html';
    ?>
</body>
</html>

<?php 
    require_once __DIR__.'\..\page-components\scripts.html';
?>

<?php
    $connection->close();
?>