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
        <div class='order-navigation'>
            <a class='nav' href='/sklep/cart.php'>
                <span class='order-icons'>
                    <i class="fa-solid fa-cart-shopping fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Koszyk</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
            <a class='nav' href='/sklep/order/login.php'>
                <span class='order-icons'>
                    <i class="fa-solid fa-file-lines fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Twoje dane</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
            <a class='nav' href='/sklep/order/shipping.php'>
                <span class='order-icons'>
                    <i class="fa-solid fa-truck fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Dostawa i płatność</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
            <a class='nav' href='/sklep/order/check.php'>
                <span class='order-icons bubble-icon'>
                    <i class="fa-solid fa-clipboard-check fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Weryfikacja danych</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
        </div>

        <div class='payment-forms'>
            BLIK
            PayU
        </div>
        <div class='shipping-forms'>
            Paczkomaty
            Kurier inpost
            DPD
            Pocztex
            Pocztex odbior
            Fedex
            DHL
        </div>
        <div class='order-sum'>
            Wartosc zamowienia
            Koszt przesylki
            Do zaplaty
            Przejd dalej
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