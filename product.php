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

    $cartAmount = [];
    $maincategories = [];
    $product = [];
    $images = [];

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
    fetchAllToArray( $maincategories, $result );
    $result->free();
    
    // Checking if there is product chosen
    if(!isset($_GET['id'])){
        header('Location: error.php');
    }

    // Storing displayed product information
    $query = "SELECT produkt_id, nazwa, cena, opis, ilosc, k2.kategoria AS kategoria2, k2.kategoria_id AS kategoria2_id, k1.kategoria AS kategoria1, k1.kategoria_id AS kategoria1_id, k.kategoria AS kategoria, k.kategoria_id AS kategoria_id, marka, m.marka_id AS marka_id FROM produkt AS p JOIN kategoria_2 AS k2 on (p.kategoria_id = k2.kategoria_id) JOIN kategoria_1 AS k1 on (k2.parent_id = k1.kategoria_id) JOIN kategoria AS k ON (k1.parent_id = k.kategoria_id) JOIN marka AS m ON (p.marka_id = m.marka_id) WHERE produkt_id=".$_GET['id'];
    $result = $connection->query($query);
    $product = $result->fetch_assoc();
    $result->free();

    // Storing product images
    $query = "SELECT CONCAT(z.sciezka, z.nazwa) AS zdjecie FROM produkt AS p JOIN zdjecie AS z USING (produkt_id) WHERE p.produkt_id=".$_GET['id'];
    $result = $connection->query($query);
    fetchAllToArray($images, $result);
    $result->free();

    // Storing product availability
    $availability = "available";
    if($product['ilosc']>50){
        $product['dostepnosc'] = "bardzo duża";
    } else if($product['ilosc']>15) {
        $product['dostepnosc'] = "duża";
    } else if($product['ilosc']>0) {
        $product['dostepnosc'] = "ostatnie sztuki";
    } else {
        $product['dostepnosc'] = "niedostępny";
        $availability = "unavailable";
    }

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
            echo "<div class='breadcrumbs'>
                <ul>
                    <li><a href='index.php' class='uppercase'>Strona Główna</a></li>
                    <li><a href='category.php?maincategory=".$product['kategoria_id']."' class='uppercase'>".$product['kategoria']."</a></li>
                    <li><a href='category.php?category=".$product['kategoria1_id'] . "' class='uppercase'>".$product['kategoria1']."</a></li>
                    <li><a href='category.php?subcategory=" . $product['kategoria2_id']."' class='uppercase'>".$product['kategoria2']."</a></li>
                </ul>
            </div>

            <div class='product-information'>
                <div class='img-gallery'>
                    <div class='gallery-container'>
                        <button class='add-to-fav'></button>
                        <img class='gallery-main-img' src='".$images[0]['zdjecie']."'>
                        <div class='gallery-thumbs'>";
                            foreach ($images as $image) {
                                echo "<img class='thumbnail' src='".$image['zdjecie']."'>";
                            }
                        echo "</div>
                    </div>
                    <div class='gallery-closeup hidden'> 
                        <div class='gallery-controls'>
                            <img class='gallery-close' src='/sklep/images/ui/cross.svg'>
                            <img class='gallery-previous' src='/sklep/images/ui/arrow-left.svg'>
                            <img class='gallery-next' src='/sklep/images/ui/arrow-right.svg'>
                        </div>
                        <div class='gallery-closeup-img'>
                            <img class='gallery-displayed-img' src='".$images[0]['zdjecie']."'>
                        </div>
                        <div class='gallery-closeup-thumbs'>";
                            foreach ($images as $image) {
                                echo "<img class='closeup-thumbnail' src='".$image['zdjecie']."'>";
                            }
                        echo "</div>
                    </div>
                </div>
                
                <div class='info'>
                    <a href='brand.php?brand=" . $product['marka_id'] . "'>
                        <h4>" . $product['marka'] . "</h4>
                    </a>
                    <h3>" . $product['nazwa'] . "</h3>
                    <span class='$availability'>" . number_format($product['cena'], 2, ',') . "<span class='$availability'> zł</span></span><br>
                    <div class='add-to-cart-container'>
                        <div class='quantity-input-container $availability' data-min='1' data-max='99' data-step='1'>
                            <table>
                                <tr>
                                    <td>
                                        <button class='subtract white-button $availability'>-</button>
                                    </td>
                                    <td>
                                        <span class='quantity-display $availability'>1</span>
                                    </td>
                                    <td>
                                        <button class='add white-button $availability'>+</button>
                                    </td>
                                </tr>
                            </table>  
                        </div>
                        <button class='pink-button add-to-cart-button $availability' data-product_id='".$product['produkt_id']."'>Dodaj do koszyka</button>
                    </div>
                    <div class='availability-info'>
                        <span>Dostępność: <span class='$availability'>".$product['dostepnosc']."</span></span>
                    </div>

                    <div>
                        <label for='state'>
                            <div class='accordion'>Opis</div>
                        </label>
                        <input type='checkbox' id='state' hidden checked>
                        <div class='accordion-content'>
                            <div class='accordion-inner'>
                                <p>
                                    ".nl2br($product['opis'])."
                                </p>
                            </div>
                        </div>
                    </div>

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
    <script src="js/productQuantity.js"></script>
    <script src="js/productImageGallery.js"></script>
    <script src="js/xzoom.js"></script>
    <script src="js/previewCart.js"></script>
    <script src="js/addToCart.js"></script>
    <script src="js/removeFromCart.js"></script>
    <script src="js/accountPreview.js"></script>
</body>
</html>

<?php
    $buffer = ob_get_contents();
    ob_end_clean();
    echo str_replace("%TITLE%", $product['nazwa'], $buffer);
    $connection->close();
?>