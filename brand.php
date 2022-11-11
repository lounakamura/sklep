<?php
    session_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    $maincategories = [];
    $brands = [];
    $products = [];
    $cartProducts = [];

    // Product display based on brand
    $baseSelectionOn = '';
    if (isset($_GET['brand'])) {
        $baseSelectionOn = ' WHERE produkt.marka_id=' . $_GET['brand'];
    }

    // Storing the main categories
    $query = "SELECT * FROM kategoria";
    $result = $connection->query( $query );
    fetchAllToArray( $maincategories, $result );
    $result->free();

    // Storing brands
    $query = "SELECT * FROM marka";
    $result = $connection->query($query);
    fetchAllToArray($brands, $result);
    $result->free();

    // Storing products
    $query = "SELECT produkt_id, nazwa, cena, opis, kategoria_2.kategoria_id AS kategoria_2_id, kategoria_2.kategoria AS kategoria_2, kategoria_1.kategoria_id AS kategoria_1_id, kategoria_1.kategoria AS kategoria_1, kategoria.kategoria_id AS kategoria_id, kategoria.kategoria AS kategoria, marka.marka_id AS marka_id, marka.marka AS marka FROM produkt JOIN kategoria_2 ON (produkt.kategoria_id = kategoria_2.kategoria_id) JOIN kategoria_1 ON (kategoria_2.parent_id = kategoria_1.kategoria_id) JOIN kategoria ON (kategoria_1.parent_id = kategoria.kategoria_id) JOIN marka ON (produkt.marka_id = marka.marka_id)$baseSelectionOn";
    $result = $connection->query( $query );
    fetchAllToArray( $products, $result );
    $result->free();

    if (isset($_SESSION['session'])) {
        $query = "SELECT koszyk_id, produkt.produkt_id, produkt.nazwa, produkt.cena, ilosc FROM koszyk JOIN produkt ON (produkt.produkt_id = koszyk.produkt_id) WHERE sesja_id=".$_SESSION['session'];
        $result = $connection->query($query);
        fetchAllToArray( $cartProducts, $result );
        $result->free();
    }

    $shipping = 10.90;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="images/ui/logo-small.svg">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/category-brand.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
<section>
        <?php
            if(count($cartProducts)>0) {
                echo "
                <div class='preview-cart-container off'>
                    <div class='preview-cart-shape'>
                        <div class='preview-cart-products'>";
                        foreach ( $cartProducts as $cartProduct ) {
                            echo "
                            <div class='preview-cart-product'>
                                <div class='preview-cart-info'>
                                    <div>
                                        <a href='product.php?id=".$cartProduct['produkt_id']."'><img src='images/product-images/1_1_min.jpg'></a>
                                        <a href='product.php?id=".$cartProduct['produkt_id']."'><span>".$cartProduct['nazwa']."</span></a>
                                    </div>
                                    <div>
                                        <h4>".$cartProduct['ilosc']."</h4>
                                        <h4>x</h4>
                                        <h4>".number_format($cartProduct['cena'], 2, ',')." zł</h4>
                                    </div>
                                </div>
                                <div>
                                    <button type='button' class='remove-from-cart' data-cart_id='".$cartProduct['koszyk_id']."'></button>
                                </div>
                            </div>";
                        }
                        echo "</div>";
                        // MAKE A NEW JS FILE FOR CALCULATING TOTAL - SPECIFICALLY FOR THE PREVIEW CART
                        echo "
                        <div class='preview-cart-cost'>
                                <div class='preview-cost-row'>
                                    <span>Wartość zamówienia</span>
                                    <span class='preview-product-sum'>
                                        <span class='product-sum'></span> zł
                                    </span>
                                </div>
                                <div class='preview-cost-row'>
                                    <span>Dostawa od</span>
                                    <span class='preview-shipping-price'>
                                        <span class='shipping-price'>".number_format($shipping, 2, ',', ' ')."</span> zł
                                    </span>
                                </div>
                                <div class='preview-cost-row'>
                                    <span>Razem</span>
                                    <span class='preview-total-sum'>
                                        <span class='total-sum'></span> zł
                                    </span>
                                </div>
                        </div>
                        <button onclick='location.href=\"shopping-cart.php\"' class='goto-cart pink-button'>Przejdź do koszyka</button>";
                    echo "</div>";
                echo "<div>";    
            }
        ?>
    </section>

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
            <button type="button" class="header-account"></button>
            <button onclick="location.href='shopping-cart.php'" type="button" class="header-cart">
                <?php
                    if(count($cartProducts)>0){
                        echo "<div class='container-cart-items-amount'>
                            <div class='circle-cart-items-amount'>
                                <span class='cart-items-amount'>".$cartAmount['ilosc']."</span>
                            </div>
                        </div>";
                    }
                ?>
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
            <button type="button" class="header-account"></button>
            <button onclick="location.href='shopping-cart.php'" type="button" class="header-cart">
                <?php
                    if(count($cartProducts)>0){
                        echo "<div class='container-cart-items-amount'>
                            <div class='circle-cart-items-amount'>
                                <span class='cart-items-amount'>".$cartAmount['ilosc']."</span>
                            </div>
                        </div>";
                    }
                ?>
            </button>
        </div>
    </header>

    <nav class="navigation-categories">
        <ul>
            <li>
                <a class="pink-text" href="#">PROMOCJE</a>
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
            echo "<div style='display:flex'>";
                echo "<div class='categories-container'>";

                echo "</div>";

                echo "<div class='products-container'>";
                    foreach ($products as $product) {
                        echo "<div class='product-container'>";
                            echo "<a href='product.php?id=" . $product['produkt_id'] . "'>
                                <img src='https://hotel-tumski.com.pl/wp-content/uploads/2020/02/placeholder.png'>"; //PLACEHOLDER
                            echo "</a>"; 
                            echo "<a href='brand.php?brand=" . $product['marka_id'] . "'>
                                <h4>" . $product['marka'] . "</h4>";
                            echo "</a>";
                            echo "<a href='product.php?id=" . $product['produkt_id'] . "'>
                                <h3>" . $product['nazwa'] . "</h3>";
                            echo "</a>";
                            echo "<span>" . number_format($product['cena'], 2, ',') . " zł</span><br>";
                            echo "<button class='pink-button add-to-cart-button' data-product_id='".$product['produkt_id']."'>Do koszyka</button>";
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
                <a id="social-fb" href="https://facebook.com"><img src="images/ui/fb-logo.svg"></a>
                <a id="social-tiktok" href="https://tiktok.com"><img src="images/ui/tiktok-logo.svg"></a>
                <a id="social-insta" href="https://instagram.com"><img src="images/ui/instagram-logo.svg"></a>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer">
            <div>
                <h4 class="uppercase">O nas</h4>
                <a href="#">Polityka prywatności</a>
                <a href="#">Regulamin sklepu</a>
                <a href="#">Oferty Pracy</a>
                <a href="#">Nasze sklepy</a>
                <a href="#">Polityka cookies</a>
            </div>


            <div>
                <h4 class="uppercase">Obsługa klienta</h4>
                <a href="#">Formy płatności</a>
                <a href="#">Formy i koszty dostawy</a>
                <a href="#">Zwrot i wymiana towaru</a>
                <a href="#">Reklamacje</a>
                <a href="#">Kontakt</a>
            </div>

            <div>
                <h4 class="uppercase">Zakupy</h4>
                <a href="#">Twoje konto</a>
                <a href="#">Rejestracja</a>
                <a href="#">Logowanie</a>
                <a href="#">Przypomnij hasło</a>
                <a href="#">Zamówienia</a>
            </div>
        </div>
    </footer>

    <button class="to-top" onclick="location.href='#'"></button>

    <script src="js/script.js"></script>
    <script src="js/menuHandler.js"></script>
    <script src="js/addToCart.js"></script>
    <script src="js/previewCart.js"></script>
</body>

</html>

<?php
    $connection->close();
?>