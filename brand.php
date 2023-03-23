<?php
    session_start();
    ob_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    $maincategories = [];
    $products = [];

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

    // Display based on brand
    $baseSelectionOn;
    if (isset($_GET['brand'])) {
        $query = "SELECT * FROM marka WHERE marka_id=".$_GET['brand'];
        $result = $connection->query($query);
        $displayedBrand = $result->fetch_assoc();
        $result->free();
        $baseSelectionOn = 'WHERE produkt.marka_id='.$_GET['brand'];
    }

    // Sorting products
    $sort = ' ';
    if (isset($_POST['sort'])) {
        $sort = 'ORDER BY '.$_POST['sort'];
    }

    // Storing the main categories
    $query = "SELECT * FROM kategoria";
    $result = $connection->query( $query );
    fetchAllToArray($maincategories, $result);
    $result->free();

    // Storing products
    $query = "SELECT produkt.produkt_id, produkt.nazwa, cena, kategoria_2.kategoria_id AS kategoria_2_id, kategoria_2.kategoria AS kategoria_2, kategoria_1.kategoria_id AS kategoria_1_id, kategoria_1.kategoria AS kategoria_1, kategoria.kategoria_id AS kategoria_id, kategoria.kategoria AS kategoria, marka.marka_id AS marka_id, marka.marka AS marka, CONCAT(zdjecie.sciezka, zdjecie.nazwa) AS zdjecie FROM produkt JOIN kategoria_2 ON (produkt.kategoria_id = kategoria_2.kategoria_id) JOIN kategoria_1 ON (kategoria_2.parent_id = kategoria_1.kategoria_id) JOIN kategoria ON (kategoria_1.parent_id = kategoria.kategoria_id) JOIN marka ON (produkt.marka_id = marka.marka_id) JOIN zdjecie ON (zdjecie.produkt_id = produkt.produkt_id) $baseSelectionOn GROUP BY produkt.produkt_id $sort";
    $result = $connection->query($query);
    fetchAllToArray($products, $result);
    $productsFound = mysqli_num_rows($result);
    $result->free();

    setcookie('cart-amount', $cartAmount['ilosc'], '0' , '/sklep');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>%TITLE% | Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="images/ui/logo-small.svg">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/category-brand.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
<section>
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
                    <a class='uppercase' href='category.php?maincategory=" . $maincategory['kategoria_id'] . "'>" . $maincategory['kategoria'] . "</a>";
                    echo "<section class='categories-bg off'>
                        <ul class='categories-main'>";
                            foreach ( $categories as $category ) {
                                $subcategories = [];
                                $query = "SELECT * FROM kategoria_2 WHERE kategoria_2.parent_id=" . $category['kategoria_id'];
                                $result = $connection->query($query);
                                fetchAllToArray( $subcategories, $result );
                                $result->free();

                                echo "<li>
                                    <a class='subcategory uppercase' href='category.php?category=" . $category['kategoria_id'] . "'>" . $category['kategoria'] . "</a>";
                                    echo "<ul>";
                                        foreach ( $subcategories as $subcategory ) {
                                            echo "<li>
                                                <a class='subsubcategory' href='category.php?subcategory=" . $subcategory['kategoria_id'] . "'>" . $subcategory['kategoria'] . "</a>";
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
        <?php
            echo "<div>";
                echo "<h2>".$displayedBrand['marka']."</h2>";
                echo "<h3>".$productsFound." wyników</h3>";
                echo "<form method='POST'>";
                    echo "<select name='sort' onchange='this.form.submit()'>
                        <option value='produkt.nazwa ASC'>Sortuj po nazwie rosnąco</option>
                        <option value='produkt.nazwa DESC'>Sortuj po nazwie malejąco</option>
                        <option value='cena ASC'>Sortuj po cenie rosnąco</option>
                        <option value='cena DESC'>Sortuj po cenie malejąco</option>
                        <option value='produkt.produkt_id ASC'>Sortuj po dacie dodania rosnąco</option>
                        <option value='produkt.produkt_id dateDESC'>Sortuj po dacie dodania malejąco</option>
                        ";
                    echo "</select>";
                echo "</form>";
            echo "</div>";

            echo "<div class='product-display'>";
                echo "<div class='categories-container'>";

                echo "</div>";

                echo "<div class='products-container'>";
                foreach ($products as $product) {
                    echo "<div class='product-container'>";
                        echo "<div>";
                            echo "<button class='add-to-fav'></button>";
                            echo "<a href='product.php?id=" . $product['produkt_id'] . "'>
                                <img src='".$product['zdjecie']."'>"; 
                            echo "</a>"; 
                            echo "<a href='brand.php?brand=" . $product['marka_id'] . "'>
                                <h4>" . $product['marka'] . "</h4>";
                            echo "</a>";
                            echo "<a href='product.php?id=" . $product['produkt_id'] . "'>
                                <h3 class='line-limit'>" . $product['nazwa'] . "</h3>";
                            echo "</a>";
                        echo "</div>";
                        echo "<div>";
                            echo "<span>" . number_format($product['cena'], 2, ',') . "<span> zł</span></span><br>";
                            echo "<button class='pink-button add-to-cart-button' data-product_id='".$product['produkt_id']."'>Dodaj do koszyka</button>";
                        echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            echo "</div>";
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
                <a href="about/privacy-policy.php">Polityka prywatności</a>
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

    <!-- Cart preview -->
    <section>
        <iframe src='cart-preview.php' class='preview-cart-container hidden' data-id='preview-cart'>
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
    <script src="js/previewCart.js"></script>
    <script src="js/addToCart.js"></script>
    <script src="js/removeFromCart.js"></script>
    <script src="js/accountPreview.js"></script>
</body>

</html>

<?php
    $buffer = ob_get_contents();
    ob_end_clean();
    echo str_replace("%TITLE%", "Marka ".$displayedBrand['marka'], $buffer);
    $connection->close();
?>