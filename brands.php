<?php
    session_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    }
    
    $maincategories = [];
    $products = [];
    $letters = [];
    $cartProducts = [];

    // Storing the main categories
    $query = "SELECT * FROM kategoria";
    $result = $connection->query($query);
    fetchAllToArray( $maincategories, $result );
    $result->free();

    // Storing brands' first letter of name alphabetically
    $query = "SELECT DISTINCT UPPER(SUBSTRING(marka, 1, 1)) AS litera FROM marka ORDER BY marka";
    $result = $connection->query($query);
    fetchAllToArray( $letters, $result );
    $result->free();

    if (isset($_SESSION['session'])) {
        $query = "SELECT koszyk_id, produkt.produkt_id, produkt.nazwa, produkt.cena, ilosc FROM koszyk JOIN produkt ON (produkt.produkt_id = koszyk.produkt_id) WHERE sesja_id=".$_SESSION['session'];
        $result = $connection->query($query);
        fetchAllToArray( $cartProducts, $result );
        $result->free();
    }

    $shipping = 10.90;

    // Storing cart amount
    if (isset($_SESSION['session'])) {
        $query = "SELECT COUNT(*) AS ilosc FROM koszyk WHERE sesja_id=".$_SESSION['session'];
        $result = $connection->query($query);
        $cartAmount = $result->fetch_assoc();
        $result->free();
    }

    setcookie('cart-amount', $cartAmount['ilosc'], '0' , '/sklep');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marki | Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="images/ui/logo-small.svg">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/brands.css">
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
            <button type="button" class="header-account"></button>
            <button onclick="location.href='shopping-cart.php'" type="button" class="header-cart">
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
            <button type="button" class="header-account"></button>
            <button onclick="location.href='shopping-cart.php'" type="button" class="header-cart" data-fixed='yes'>
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
        <section class="alphabet-ref">
            <?php
                foreach ($letters as $letter) {
                    echo "<a href='#" . $letter['litera'] . "'>" . $letter['litera'] . "</a>";
                }
            ?>
        </section>
        <section>
            <?php
                foreach ($letters as $letter) {
                    $brands = [];
                    echo "<div id='" . $letter['litera'] . "' class='brand'>";
                        echo "<h2>" . $letter['litera'] . "</h2>";

                        $query = "SELECT * FROM marka WHERE UPPER(SUBSTRING(marka, 1, 1))='" . $letter['litera'] . "'";
                        $result = $connection->query($query);
                        fetchAllToArray( $brands, $result );
                        $result->free();

                        foreach ( $brands as $brand ) {
                            echo "<a href='brand.php?brand=" . $brand['marka_id'] . "'>" . $brand['marka'] . "</a>";
                        }

                    echo "</div>";
                    unset($brands);
                }
            ?>
        </section>
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

    <!-- Additional elements -->

    <!-- Login popup -->
    <section>
        <div class='account-popup-bg login-popup not-displayed'>
            <div class='account-popup-window'>
                <div class='account-popup-section'>
                    <div class='account-header'>
                        <h2>Zaloguj się</h2>
                        <img class='login-close' src='images/ui/cross-medium.svg'>
                    </div>
                    <label>E-mail</label>
                    <input type='email' class='login-field'>
                    <label>Hasło</label>
                    <input type='password' class='login-field'>
                    <a>Nie pamiętam hasła</a> <!-- do zrobienia ekran -->
                    <input class='log-in-button-confirm pink-button' type='submit' value='Zaloguj się'>
                </div>
                <div class='account-popup-section'>
                    <h3>Nie masz konta?</h3>
                    <input class='register-button white-button' type='submit' value='Zarejestruj się'>
                </div>
            </div>
        </div>
    </section>

    <!-- Register popup -->
    <section>
        <div class='account-popup-bg register-popup not-displayed'>
            <div class='account-popup-window'>
                <div class='account-header'><h2>Zarejestruj się</h2>
                    <img class='register-close' src='images/ui/cross-medium.svg'>
                </div>
                <label>E-mail</label>
                <input type='email' class='register-field'>
                <label>Hasło</label>
                <input type='password' class='register-field'>
                <label>Powtórz hasło</label>
                <input type='repeat-password' class='login-field'>
                <div>
                    <input type='checkbox'><label>Akceptuję warunki <a>regulaminu</a></label>
                </div>
                <div>
                    <input type='checkbox'><label>Chcę zapisać się do newslettera</label>
                </div>
                <input class='register-button-confirm pink-button' type='submit' value='Zarejestruj się'>
            </div>
        </div>
    </section>

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
    $connection->close();
?>