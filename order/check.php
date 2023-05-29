<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    $cartProducts = [];
    $country = [];
    $paymentMethod = [];
    $shippingMethod = [];

    $query = "SELECT koszyk_id, p.produkt_id, p.nazwa, p.cena, k.ilosc, CONCAT(z.sciezka, z.nazwa) AS zdjecie FROM koszyk AS k JOIN produkt as p USING (produkt_id) JOIN zdjecie AS z USING (produkt_id)";
    $result = $connection->query($query);
    fetchAllToArray($cartProducts, $result);
    $result->free();

    $query = "SELECT nazwa FROM kraj WHERE kraj_id=".$_SESSION['client-info']['country'];
    $result = $connection->query($query);
    $country = $result->fetch_assoc()['nazwa'];
    $result->free();

    $query = "SELECT * FROM metoda_platnosci WHERE metoda_platnosci_id=".$_SESSION['order-info']['payment'];
    $result = $connection->query($query);
    $paymentMethod = $result->fetch_assoc();
    $result->free();

    $query = "SELECT * FROM metoda_dostawy WHERE metoda_dostawy_id=".$_SESSION['order-info']['shipping'];
    $result = $connection->query($query);
    $shippingMethod = $result->fetch_assoc();
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
    <link rel="stylesheet" href="/sklep/css/cart.css">
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

        <form method='POST' action='/sklep/php/place-order.php'>
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
                        <span>".$_SESSION['client-info']['first-name']." ".$_SESSION['client-info']['last-name']."</span>
                        ";
                    }
                    echo "
                    <span>".$_SESSION['client-info']['street']." ". $_SESSION['client-info']['street-no'];
                    if($_SESSION['client-info']['house-no']){
                        echo "/".$_SESSION['client-info']['house-no'];
                    }
                    echo "</span>
                    <span>".$_SESSION['client-info']['postal-code']." ".$_SESSION['client-info']['city']."</span>
                    <span>$country</span>
                    <span>".$_SESSION['client-info']['email']."</span>
                    <span>".$_SESSION['client-info']['phone']."</span>
                    ";
                ?>
            </div>

            <div class='remarks'>
                <h2>Uwagi do zamówienia</h3>
                <textarea id='remarks' name='remarks' placeholder='Tutaj wpisz uwagi...'></textarea>
            </div>

            <div class='shipping-payment'>
                <h3>Wybrana metoda płatności</h3>
                <?php
                    echo $paymentMethod['rodzaj'];
                ?>
                <h3>Wybrana metoda dostawy</h3>
                <?php
                    echo $shippingMethod['rodzaj'];
                ?>
            </div>

            <div class='products'>
                <h3>Zamówione produkty</h3>
                <?php
                    echo "
                    <div class='shopping-cart-with-products'>
                    <table class='cart'>
                        <thead>
                            <tr>
                                <th class='first'></th>
                                <th class='table-header uppercase'>Cena</th>
                                <th class='table-header uppercase'>Ilość</th>
                                <th class='table-header uppercase'>Wartość</th>
                            </tr>
                        </thead>
                        <tbody>";
                        foreach ( $cartProducts as $cartProduct ) {
                            echo "
                            <tr class='product-container'>
                                <td class='product-image product-name'>
                                    <a href='/sklep/product.php?id=".$cartProduct['produkt_id']."'><img src='".$cartProduct['zdjecie']."'></a>
                                    <a href='/sklep/product.php?id=".$cartProduct['produkt_id']."'><h3>".$cartProduct['nazwa']."</h3></a>
                                </td>
                                <td class='product-price'>
                                    <span><span class='price'>".number_format($cartProduct['cena'], 2, ',')."</span><span> zł</span</span>
                                </td>
                                <td class='product-quantity'>
                                    <span class='quantity-display' data-cart_id='".$cartProduct['koszyk_id']."'>".$cartProduct['ilosc']."</span>
                                </td>
                                <td class='product-total-price'>
                                    <span>
                                        <span class='product-total'>".number_format(($cartProduct['ilosc']*$cartProduct['cena']), 2, ',', '')."</span><span> zł</span
                                    </span>
                                </td>
                            </tr>";
                        }
                    
                    echo "</table>
                    </div>";
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
                            <?php
                            echo number_format($shippingMethod['cena'], 2, ',', '');
                            ?>
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

            <input type='hidden' name='place-order' value='yes'>
            <button type='button' onclick="location.href='/sklep/order/shipping.php'">Wróć</button>
            <button type='submit' class='pink-button'>Zamawiam</button>
        </form>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\footer.html';
    ?>
</body>
</html>

<?php
    $connection->close();
?>