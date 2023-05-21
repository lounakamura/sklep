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
    <link rel="stylesheet" href="/sklep/css/order.css">
</head>

<body>
    <header class='header-small'>
        <div class="logo_big-container">
            <a href="/sklep/index.php"><img class="logo_big" src="/sklep/images/ui/logo-big.svg" /></a>
        </div>
    </header>

    <main>
        <?php
            require_once 'nav.php';
        ?>
        
        <h1>Sprawdź poprawność zamówienia</h1>
        <div class='client-info'>
            <h2>Dane zamawiającego</h2>
            <?php
                
                if($_SESSION['client-info']['isCompany'] == 1){
                    echo "
                    <span>".$_SESSION['client-info']['company-name']."</span>
                    <span>".$_SESSION['client-info']['nip']."</span>
                    ";
                } else {
                    echo "
                    <span>".$_SESSION['client-info']['first-name']."</span>
                    <span>".$_SESSION['client-info']['last-name']."</span>
                    ";
                }
                echo "
                <span>".$_SESSION['client-info']['street']." ". $_SESSION['client-info']['street-no']." ".$_SESSION['client-info']['house-no']."</span>
                ";
            ?>
        </div>
        <div class='delivery-info'>
            <h2>Adres dostawy</h2>
        </div>
        <div class='invoice-info'>
            <h2>Dane do faktury</h2>
        </div>
        <div class='products'>
            <h3>Zamówione produkty</h3>
        </div>
        <div class='remarks'>
            <h2>Uwagi do zamówienia</h3>
            <textarea></textarea>
        </div>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\footer.html';
    ?>
</body>
</html>

<?php
    $connection->close();
?>