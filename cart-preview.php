<?php
    session_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }
    
    if(!(isset($_SERVER['HTTP_SEC_FETCH_DEST']) && $_SERVER['HTTP_SEC_FETCH_DEST'] == 'iframe')) {
        header('Location: index.php');
    }

    $cartProducts = [];

    $query = "SELECT koszyk_id, produkt.produkt_id, produkt.nazwa, produkt.cena, ilosc, CONCAT(zdjecie.sciezka, zdjecie.nazwa) AS zdjecie FROM koszyk JOIN produkt ON (produkt.produkt_id = koszyk.produkt_id) JOIN zdjecie ON (zdjecie.produkt_id = produkt.produkt_id) WHERE ";
    if(isset($_SESSION['loggedin'])) {
        $query .= "uzytkownik_id=".$_SESSION['id'];
    } else {
        $query .= "sesja_id=".$_SESSION['session'];
    }
    $query .= " GROUP BY produkt.produkt_id";
    $result = $connection->query($query);
    fetchAllToArray( $cartProducts, $result );
    $result->free();

    // Get cheapest shipping cost
    $query = "SELECT MIN(cena) as koszt FROM dostawa";
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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/previews.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>
<body>
<?php
    echo "
    <div>
        <div class='preview-cart-shape'>
            <div class='preview-cart-products'>";
            foreach ( $cartProducts as $cartProduct ) {
                echo "
                <div class='preview-cart-product'>
                    <div class='preview-cart-info'>
                        <div>
                            <a href='product.php?id=".$cartProduct['produkt_id']."' target='_parent'><img src='".$cartProduct['zdjecie']."'></a>
                            <a href='product.php?id=".$cartProduct['produkt_id']."' target='_parent'><span class='line-limit'>".$cartProduct['nazwa']."</span></a>
                        </div>
                        <div>
                            <h4>".$cartProduct['ilosc']."</h4>
                            <h4>x</h4>
                            <h4>".number_format($cartProduct['cena'], 2, ',')."<span> zł</span</h4>
                        </div>
                    </div>
                    <div>
                        <button type='button' class='remove-from-cart' data-cart_id='".$cartProduct['koszyk_id']."'></button>
                    </div>
                </div>";
            }
            echo "</div>";
            echo "
            <div class='preview-cart-cost'>
                    <div class='preview-cost-row'>
                        <span>Wartość zamówienia</span>
                        <span class='preview-product-sum'>
                            <span class='product-sum'>".number_format($productSum, 2, ',', '')."</span><span> zł</span
                        </span>
                    </div>
                    <div class='preview-cost-row'>
                        <span>Dostawa od</span>
                        <span class='preview-shipping-price'>
                            <span class='shipping-price'>".number_format($shipping['koszt'], 2, ',', '')."</span><span> zł</span
                        </span>
                    </div>
                    <div class='preview-cost-row'>
                        <span>Razem</span>
                        <span class='preview-total-sum'>
                            <span class='total-sum'>".number_format($cartTotal, 2, ',', '')."</span><span> zł</span
                        </span>
                    </div>
            </div>
            <button onclick='parent.location.href=\"cart.php\"' class='goto-cart pink-button'>Przejdź do koszyka</button>";
        echo "</div>";
    echo "</div>";
?>

<script src="js/script.js"></script>
<script src="js/previewCart.js"></script>
<script src="js/addToCart.js"></script>
<script src="js/removeFromCart.js"></script>
</body>

<?php
    $connection->close();
?>