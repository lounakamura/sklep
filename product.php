<?php
    session_start();
    ob_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    $maincategories = [];
    $products = [];
    $product = [];

    // Storing the main categories
    $query = "SELECT * FROM kategoria";
    $result = $connection->query($query);
    fetchAllToArray( $maincategories, $result );
    $result->free();

    // Storing products
    $query = "SELECT produkt_id, nazwa, cena, opis, kategoria_2.kategoria_id AS kategoria_2_id, kategoria_2.kategoria AS kategoria_2, kategoria_1.kategoria_id AS kategoria_1_id, kategoria_1.kategoria AS kategoria_1, kategoria.kategoria_id AS kategoria_id, kategoria.kategoria AS kategoria, marka.marka_id AS marka_id, marka.marka AS marka FROM produkt JOIN kategoria_2 ON (produkt.kategoria_id = kategoria_2.kategoria_id) JOIN kategoria_1 ON (kategoria_2.parent_id = kategoria_1.kategoria_id) JOIN kategoria ON (kategoria_1.parent_id = kategoria.kategoria_id) JOIN marka ON (produkt.marka_id = marka.marka_id)";
    $result = $connection->query($query);
    fetchAllToArray( $products, $result );
    $result->free();
    
    $id = $_GET['id'];

    $query = "SELECT produkt_id, nazwa, cena, opis, kategoria_2.kategoria AS kategoria2, kategoria_2.kategoria_id AS kategoria2_id,kategoria_1.kategoria AS kategoria1,kategoria_1.kategoria_id AS kategoria1_id,kategoria.kategoria AS kategoria,kategoria.kategoria_id AS kategoria_id,marka,marka.marka_id AS marka_id FROM produkt JOIN kategoria_2 on (produkt.kategoria_id = kategoria_2.kategoria_id) JOIN kategoria_1 on (kategoria_2.parent_id = kategoria_1.kategoria_id) JOIN kategoria on (kategoria_1.parent_id = kategoria.kategoria_id) JOIN marka on (produkt.marka_id = marka.marka_id) WHERE produkt_id=$id";
    $result = $connection->query($query);
    $product = $result->fetch_assoc();
    $result->free();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>%TITLE% Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="images/ui/logo-small.svg">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/product.css">
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
            <button type="button" id="header-account"></button>
            <button onclick="location.href='shopping-cart.php'" type="button" id="header-cart"></button>
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
            <button type="button" id="header-account"></button>
            <button onclick="location.href='shopping-cart.php'" type="button" id="header-cart"></button>
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
         // $query = "SELECT nazwa_pliku FROM zdjecie WHERE produkt_id=$id"; zdjecia nadal do implementacji

        echo // to implement: breadcrumbs
        "<div class='category-tree'>
            <a href='index.php' class='uppercase'>Strona Główna</a> >
            <a href='kategoria.php?maincategory=" . $product['kategoria_id'] . "' class='uppercase'>" . $product['kategoria'] . "</a> >
            <a href='kategoria.php?category=" . $product['kategoria1_id'] . "' class='uppercase'>" . $product['kategoria1'] . "</a> >
            <a href='kategoria.php?subcategory=" . $product['kategoria2_id'] . "' class='uppercase'>" . $product['kategoria2'] . "</a>
        </div>

        <div class='product-information'>
            <div class='img-gallery'>" . //statycznie ustawione, do poprawki || zrobione za pomoca pluginu jq xzoom
            "<div class='xzoom-container'>
                    <img class='xzoom' src='images/product-images/1_1_min.jpg' xoriginal='images/product-images/1_1.jpg'>
                    <div class='xzoom-thumbs'>
                        <a href='images/product-images/1_1.jpg'>
                            <img class='xzoom-gallery' src='images/product-images/1_1_min.jpg' xpreview='images/product-images/1_1_min.jpg'>
                        </a>
                        <a href='images/product-images/1_2.jpg'>
                            <img class='xzoom-gallery' src='images/product-images/1_2_min.jpg'>
                        </a>
                        <a href='images/product-images/1_3.jpg'>
                            <img class='xzoom-gallery' src='images/product-images/1_3_min.jpg'>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class='info'>
                <a href='brand.php?brand=" . $product['marka_id'] . "'>
                    <h4>" . $product['marka'] . "</h4>
                </a>
                <h3>" . $product['nazwa'] . "</h3>
                <span>" . number_format($product['cena'], 2, ',') . " zł</span><br>
                <div class='add-to-cart-container'>
                    <div class='quantity-input-container'>
                        <table>
                            <tr>
                                <td>
                                    <button class='subtract white-button'>-</button>
                                </td>
                                <td>
                                    <input class='quantity' type='number' data-value='1' value='1' min='1' max='99' step='1'>
                                </td>
                                <td>
                                    <button class='add white-button'>+</button>
                                </td>
                            </tr>
                        </table>  
                    </div>
                    <button class='pink-button add-to-cart-button' data-product_id='".$product['produkt_id']."'>Dodaj do koszyka</button>
                </div>
                <p>" . nl2br($product['opis']) . "</p>
            </div>
        </div>";
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
    <script src="js/productQuantity.js"></script>
    <script src="js/productImageGallery.js"></script>
    <script src="js/xzoom.js"></script>
    <script src="js/addToCart.js"></script>
</body>
</html>

<?php
    $buffer = ob_get_contents();
    ob_end_clean();
    echo str_replace("%TITLE%", $product['nazwa'], $buffer);
    $connection->close();
?>