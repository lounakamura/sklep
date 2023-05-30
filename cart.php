<?php
    session_start();

    require_once __DIR__."\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    require_once __DIR__.'\page-components\required.php';

    $cartProducts = [];

    // Storing products in cart
    $query = "SELECT koszyk_id, p.produkt_id, p.nazwa, p.cena, k.ilosc, CONCAT(z.sciezka, z.nazwa) AS zdjecie FROM koszyk AS k JOIN produkt as p USING (produkt_id) JOIN zdjecie AS z USING (produkt_id) WHERE ";
    if(isset($_SESSION['loggedin'])) {
        $query .= "uzytkownik_id=".$_SESSION['id'];
    } else {
        $query .= "sesja_id=".$_SESSION['session'];
    }
    $query .= " GROUP BY p.produkt_id";
    $result = $connection->query($query);
    fetchAllToArray($cartProducts, $result);
    $result->free();

    // Get cheapest shipping cost
    $query = "SELECT MIN(cena) as koszt FROM metoda_dostawy";
    $result = $connection->query($query);
    $shipping = $result->fetch_assoc();
    $result->free();

    $productSum = 0;
    foreach( $cartProducts as $cartProduct ) {
        $productSum += $cartProduct['cena']*$cartProduct['ilosc'];
    }
    $cartTotal = $productSum + $shipping['koszt'];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk | Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/cart.css">
</head>

<body>
    <?php 
        require_once __DIR__.'\page-components\header.html';
        require_once __DIR__.'\page-components\nav.php'; 
    ?>

    <main>
        <h1>Koszyk</h1>
        
        <?php
            if(count($cartProducts)==0) {
                echo "
                <div class='shopping-cart-empty'>
                    <span>Twój koszyk jest pusty. Dodaj do niego produkty, aby móc rozpocząć składanie zamówienia.</span>
                    <button onclick='location.href=\"/sklep/index.php\"' class='white-button'>Powrót</button>
                </div>";
            } else {
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
                                    <div class='quantity-input-container' data-min='1' data-max='99' data-step='1'>
                                        <table>
                                            <tr>
                                                <td>
                                                    <button class='subtract white-button'>-</button>
                                                </td>
                                                <td>
                                                    <span class='quantity-display' data-cart_id='".$cartProduct['koszyk_id']."'>".$cartProduct['ilosc']."</span>
                                                </td>
                                                <td>
                                                    <button class='add white-button'>+</button>
                                                </td>
                                            </tr>
                                        </table>  
                                    </div>
                                </td>
                                <td class='product-total-price'>
                                    <span>
                                        <span class='product-total'>".number_format(($cartProduct['ilosc']*$cartProduct['cena']), 2, ',', '')."</span><span> zł</span
                                    </span>
                                </td>
                                <td class='product-remove'>
                                    <button type='button' class='remove-from-cart' data-cart_id='".$cartProduct['koszyk_id']."'></button>
                                </td>
                            </tr>";
                        }
                        
                        echo "
                        </tbody>
                    </table>

                    <div class='clear-cart'>
                    
                        <button type='button' class='clear-cart-button'>
                            <img src='/sklep/images/ui/delete.svg'>
                            <span>Wyczyść koszyk</span>
                        </button>
                    </div>

                    <div class='shopping-cart-footer'>
                        <div class='footer-left'>
                            <button onclick='location.href=\"/sklep/index.php\"' class='button-back white-button'>Kontynuuj zakupy</button>
                        </div>
                        <div class='footer-right'>
                            <div class='order-cost'>
                                <div class='order-cost-row'>
                                    <span>Wartość zamówienia</span>
                                    <span class='order-product-sum'>
                                        <span class='product-sum'>".number_format($productSum, 2, ',', '')."</span><span> zł</span
                                    </span>
                                </div>
                                <div class='order-cost-row'>
                                    <span>Dostawa od</span>
                                    <span class='order-shipping-price'>
                                        <span class='shipping-price'>".number_format($shipping['koszt'], 2, ',', '')."</span><span> zł</span
                                    </span>
                                </div>
                                <div class='order-cost-row'>
                                    <span>Razem</span>
                                    <span class='order-total-sum'>
                                        <span class='total-sum'>".number_format($cartTotal, 2, ',', '')."</span><span> zł</span
                                    </span>
                                </div>
                            </div>
                            <form method='POST' action='/sklep/order/information.php'>
                                <button type='submit' class='button-next pink-button'>Realizuj zamówienie</button>
                            </form>
                        </div>
                    </div>
                </div>";
            }
        ?>
    </main>

    <?php 
        require_once __DIR__.'\page-components\newsletter.html';
        require_once __DIR__.'\page-components\social-media.html'; 
        require_once __DIR__.'\page-components\footer.html';
        require_once __DIR__.'\page-components\extras.html';
    ?>
</body>
</html>

<?php 
    require_once __DIR__.'\page-components\scripts.html';
?>

<script src="/sklep/js/productQuantity.js"></script>
<script src="/sklep/js/removeFromCart.js"></script>
<script src="/sklep/js/clearCart.js"></script>

<?php
    $connection->close();
?>