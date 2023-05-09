<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    $paymentMethods = [];
    $shippingMethods = [];

    $query = "SELECT * FROM metoda_platnosci";
    $result = $connection->query($query);
    fetchAllToArray($paymentMethods, $result);
    $result->free();

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

    <div class='shipping-payment'>
        <h1>Dostawa i płatność</h1>
        <form method='POST'>
            <div class='payment-forms'>
                <?php
                    foreach ($paymentMethods as $paymentMethod) {
                        echo "<div>
                            <input type='radio' name='payment' value='".$paymentMethod['metoda_platnosci_id']."' id='".$paymentMethod['rodzaj']."'><label for='".$paymentMethod['rodzaj']."'>".$paymentMethod['rodzaj']."<img src='".$paymentMethod['zdjecie_sciezka']."'></label>
                        </div>";
                    }
                ?>
            </div>
            <div class='shipping-forms'>
                <?php
                    foreach ($shippingMethods as $shippingMethod) {
                        echo "<div>
                            <input type='radio' name='shipping' value='".$shippingMethod['metoda_dostawy_id']."' id='".$shippingMethod['rodzaj']."'><label for='".$shippingMethod['rodzaj']."'>".$shippingMethod['rodzaj']."<img src='".$shippingMethod['zdjecie_sciezka']."'></label>
                        </div>";
                    }
                ?>
            </div>
            <div class='order-sum'>
                Wartosc zamowienia
                Koszt przesylki
                Do zaplaty
            </div>
            <button type='submit'>Przejdź dalej</button>
        </form>
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