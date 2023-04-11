<?php
    session_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    $cartAmount = [];
    $maincategories = [];
    $cartProducts = [];

    // Storing cart amount
    $query = "SELECT COUNT(*) AS ilosc FROM koszyk WHERE ";
    if(isset($_SESSION['loggedin'])){
        $query .= "uzytkownik_id=".$_SESSION['id'];
    } else {
        $query .= "sesja_id=".$_SESSION['session'];
    }
    $result = $connection->query($query);
    $cartAmount = $result->fetch_assoc();
    $result->free();

    // Storing the main categories
    $query = "SELECT * FROM kategoria";
    $result = $connection->query($query);
    fetchAllToArray($maincategories, $result);
    $result->free();

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

    setcookie('cart-amount', $cartAmount['ilosc'], '0' , '/sklep');

    // to mnie wkurwia ze jest tutaj, dac to gdzie indziej
    //it so sad *pisses*
    $productSum = 0;
    foreach( $cartProducts as $cartProduct ) {
        $productSum += $cartProduct['cena']*$cartProduct['ilosc'];
    }
    $cartTotal = $productSum + $shipping['koszt'];

    //TO BE IMPLEMENTED
    //kody rabatowe
    //skladanie zamowienia
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk | Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="images/ui/logo-small.svg">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/shopping-cart.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <header>
        <div class="logo_big-container">
            <a href="index.php"><img class="logo_big" src="images/ui/logo-big.svg" /></a>
        </div>

        <div class="search-container">
            <form>
                <input class="search-field" type="text" placeholder="Szukaj produktów...">
                <button class="search-button" type="submit"></button>
            </form>
        </div>

        <div class="header-buttons">
            <button onclick="location.href='user/account.php'" type="button" class="header-account"></button>
            <button onclick="location.href='user/favourites.php'" type="button" class='header-fav'></button>
            <button onclick="location.href='cart.php'" type="button" class="header-cart">
                <div class='container-cart-items-amount' style='opacity:0'>
                    <div class='circle-cart-items-amount'>
                        <span class='cart-items-amount'>
                            -
                        </span>
                    </div>
                </div>
            </button>
        </div>
    </header>

    <header class="header-small off">
        <div class="logo_big-container">
            <a href="index.php"><img class="logo_big" src="images/ui/logo-big.svg" /></a>
        </div>

        <div class="search-container">
            <form>
                <input class="search-field" type="text" placeholder="Szukaj produktów...">
                <button class="search-button" type="submit"></button>
            </form>
        </div>

        <div class="header-buttons">
            <button onclick="location.href='user/account.php'" type="button" class="header-account" data-fixed='yes'></button>
            <button onclick="location.href='user/favourites.php'" type="button" class='header-fav' data-fixed='yes'></button>
            <button onclick="location.href='cart.php'" type="button" class="header-cart" data-fixed='yes'>
                <div class='container-cart-items-amount' style='opacity:0'>
                    <div class='circle-cart-items-amount'>
                        <span class='cart-items-amount'>
                            -
                        </span>
                    </div>
                </div>
            </button>
        </div>
    </header>

    <nav class="navigation-categories">
        <ul>
            <li>
                <a class="pink-text uppercase" href="/sklep/sale.php">Promocje</a>
            </li>

            <?php
            foreach ( $maincategories as $maincategory ) {
                $categories = [];
                $query = "SELECT * FROM kategoria_1 WHERE kategoria_1.parent_id = " . $maincategory['kategoria_id'];
                $result = $connection->query($query);
                fetchAllToArray( $categories, $result );
                $result->free();

                echo "<li class='category'>
                    <a class='uppercase' href='products.php?maincategory=" . $maincategory['kategoria_id'] . "'>" . $maincategory['kategoria'] . "</a>";
                    echo "<section class='categories-bg off'>
                        <ul class='categories-main'>";
                            foreach ( $categories as $category ) {
                                $subcategories = [];
                                $query = "SELECT * FROM kategoria_2 WHERE kategoria_2.parent_id=" . $category['kategoria_id'];
                                $result = $connection->query($query);
                                fetchAllToArray( $subcategories, $result );
                                $result->free();

                                echo "<li>
                                    <a class='subcategory uppercase' href='products.php?category=" . $category['kategoria_id'] . "'>" . $category['kategoria'] . "</a>";
                                    echo "<ul>";
                                        foreach ( $subcategories as $subcategory ) {
                                            echo "<li>
                                                <a class='subsubcategory' href='products.php?subcategory=" . $subcategory['kategoria_id'] . "'>" . $subcategory['kategoria'] . "</a>";
                                            echo "</li>";
                                        }
                                    echo "</ul>";
                                echo "</li>";
                                unset( $subcategories );
                            }
                        echo "</ul>";
                    echo "</section>";
                echo "</li>";
                unset( $categories );
            }
            ?>

            <li class="category">
                <a href="brands.php" class="uppercase">Marki</a>
            </li>
        </ul>
    </nav>


    <main>
        <h1>Koszyk</h1>
        
        <?php
            if(count($cartProducts)==0) {
                echo "
                <div class='shopping-cart-empty'>
                    <span>Twój koszyk jest pusty. Dodaj do niego produkty, aby móc rozpocząć składanie zamówienia.</span>
                    <button onclick='location.href=\"index.php\"' class='white-button'>Powrót</button>
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
                                    <a href='product.php?id=".$cartProduct['produkt_id']."'><img src='".$cartProduct['zdjecie']."'></a>
                                    <a href='product.php?id=".$cartProduct['produkt_id']."'><h3>".$cartProduct['nazwa']."</h3></a>
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
                        <button type='button' class='clear-cart-button'>Wyczyść koszyk</button>
                    </div>

                    <div class='shopping-cart-footer'>
                        <div class='footer-left'>
                            <div class='add-discount-code'>
                                <span style='padding-bottom:2px'>Dodaj kod rabatowy</span>
                                <div style='display:inline-flex'>
                                    <input class='discount-code' type='text' name='discount-code'>
                                    <button class='button-activate pink-button'>Aktywuj</button>
                                </div>
                            </div>
                            <button onclick='location.href=\"index.php\"' class='button-back white-button'>Kontynuuj zakupy</button>
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
                            <button class='button-next pink-button'>Realizuj zamówienie</button>
                        </div>
                    </div>
                </div>";
            }
        ?>
    </main>



    <!---

        <section>
            <div class="newsletter-container">
                <h2>Zapisz się do naszego newslettera</h2>
                <form>
                    <input type="text" placeholder="Podaj adres e-mail">
                    <button type="submit">Zapisz się</button>
                </form>
            </div>
        </section>

    -->

    <section>
        <div class="social-media">

            <h2>Znajdziesz nas na:</h2>
            <div class="social-media-icons">
                <a id="social-fb" href="https://facebook.com" target='_blank'><img src="images/ui/fb-logo.svg"></a>
                <a id="social-tiktok" href="https://tiktok.com" target='_blank'><img src="images/ui/tiktok-logo.svg"></a>
                <a id="social-insta" href="https://instagram.com" target='_blank'><img src="images/ui/instagram-logo.svg"></a>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer">
            <div>
                <h4 class="uppercase">O nas</h4>
                <a href="/sklep/about/privacy-policy.php">Polityka prywatności</a>
                <a href="/sklep/about/terms-of-service.php">Regulamin sklepu</a>
                <a href="/sklep/about/job-offers.php">Oferty Pracy</a>
                <a href="/sklep/about/our-shop.php">Nasz sklep</a>
                <a href="/sklep/about/cookie-policy.php">Polityka cookies</a>
            </div>


            <div>
                <h4 class="uppercase">Obsługa klienta</h4>
                <a href="/sklep/customer-service/payment-forms.php">Formy płatności</a>
                <a href="/sklep/customer-service/shipping.php">Formy i koszty dostawy</a>
                <a href="/sklep/customer-service/return-or-exchange.php">Zwrot i wymiana towaru</a>
                <a href="/sklep/customer-service/refund.php">Reklamacje</a>
                <a href="/sklep/customer-service/contact.php">Kontakt</a>
            </div>

            <div>
                <h4 class="uppercase">Zakupy</h4>
                <a href="/sklep/user/account.php">Twoje konto</a>
                <a href="/sklep/register.php">Rejestracja</a>
                <a href="/sklep/login.php">Logowanie</a>
                <a href="/sklep/user/forgotten-password.php">Przypomnij hasło</a>
                <a href="/sklep/user/orders.php">Zamówienia</a>
            </div>
        </div>
    </footer>

    <!-- Additional elements -->

    <!-- Account preview -->
    <section>
        <iframe src='account-preview.php' class='account-container hidden' data-id='account'>
        </iframe>
    </section>

    <!-- Loading screen -->
    <section>
        <div class='loading-screen not-displayed'>
            <div class='lds-ring'><div></div><div></div><div></div><div></div></div>
        </div>
    </section>

    <!-- Go back to the top of the page button -->
    <button class="to-top" onclick="location.href='#'"></button>

    <script src="js/script.js"></script>
    <script src="js/scrollToTop.js"></script>
    <script src="js/menuHandler.js"></script>
    <script src="js/productQuantity.js"></script>
    <script src="js/previewCart.js"></script>
    <script src="js/removeFromCart.js"></script>
    <script src="js/clearCart.js"></script>
    <script src="js/accountPreview.js"></script>
</body>
</html>

<?php
    $connection->close();
?>