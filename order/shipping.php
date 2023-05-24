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
        <?php
            require_once 'nav.php';
        ?>

        <div class='shipping-payment'>
            <h1>Dostawa i płatność</h1>
            <form method='POST' action='/sklep/php/save-shipping-payment-method.php'>
                <div class='payment-forms'>
                    <h2>Płatność</h2>
                    <?php
                        $first = 0;
                        foreach ($paymentMethods as $paymentMethod) {
                            echo "<div>
                                <input type='radio' name='payment' value='".$paymentMethod['metoda_platnosci_id']."' id='".$paymentMethod['rodzaj']."' ";
                                    if($first == 0){
                                        echo "checked";
                                        $first++;
                                    }
                                echo ">
                                <label for='".$paymentMethod['rodzaj']."'>
                                    <span>".$paymentMethod['rodzaj']."</span>
                                    <img src='".$paymentMethod['zdjecie_sciezka']."'>
                                </label>
                            </div>";
                        }
                    ?>
                </div>
                <div class='shipping-forms'>
                    <h2>Dostawa</h2>
                    <?php
                        $first = 0;
                        foreach ($shippingMethods as $shippingMethod) {
                            echo "<div>
                                <input type='radio' name='shipping' value='".$shippingMethod['metoda_dostawy_id']."' id='".$shippingMethod['rodzaj']."' onclick='calculateOrderValue()' ";
                                    if($first == 0){
                                        echo "checked";
                                        $first++;
                                    }
                                echo ">
                                <label for='".$shippingMethod['rodzaj']."'>
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
                                </label>
                            </div>";
                        }
                    ?>
                </div>
                <div class='order-cost'>
                    <div class='order-cost-row'>
                        <span>Wartość zamówienia</span>
                        <span class='order-product-sum'>
                            <span class='product-sum'>
                                <?php
                                    echo number_format($productSum, 2, ',', '');
                                ?>
                            </span>
                            <span>  zł</span>
                        </span>
                    </div>
                    <div class='order-cost-row'>
                        <span>Dostawa</span>
                        <span class='order-shipping-price'>
                            <span class='shipping-price'>
                            </span>
                            <span> zł</span>
                        </span>
                    </div>
                    <div class='order-cost-row'>
                        <span>Razem</span>
                        <span class='order-total-sum'>
                            <span class='total-sum'>
                                <?php
                                    echo number_format($productSum, 2, ',', '');
                                ?>
                            </span>
                            <span> zł</span
                        </span>
                    </div>
                </div>
                <input type='hidden' name='previous' value='shipping'>
                <button type='submit' class='pink-button'>Przejdź dalej</button>
            </form>
        </div>
    </main>

    <?php 
        
        require_once __DIR__.'\..\page-components\footer.html';
        
    ?>
</body>
</html>

<script src="/sklep/js/orderCalcTotal.js"></script>

<?php
    $connection->close();
?>