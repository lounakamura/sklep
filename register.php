<?php
    session_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    if(isset($_SESSION['loggedin'])) {
        header('Location: /sklep/index.php');
    }

    $cartAmount = [];
    $maincategories = [];
    
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

    setcookie('cart-amount', $cartAmount['ilosc'], '0' , '/sklep');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja | Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="images/ui/logo-small.svg">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/register.css">
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
        <div class='register-container'>
            <h1>Zarejestruj się</h1>
            <form method='POST' action='php/register.php'>
                <label for='email'>E-mail</label><input type='email' name='email' class='register-field' id='email' required minlength='6' maxlength='254'>
                <label for='username_register'>Nazwa użytkownika</label><input type='text' class='register-field' name='username' id='username_register' required minlength='1' maxlength='50'>
                <label for='password_register'>Hasło</label><input type='password' name='password' class='register-field' id='password_register' required minlength='5' maxlength='64'>
                <label for='repeat-password'>Powtórz hasło</label><input type='password' name='repeat-password' class='register-field' id='repeat-password' required minlength='5' maxlength='64'>
                <div>
                    <input type='checkbox' id='accept-rules' required><label for='accept-rules'>Akceptuję warunki <a>regulaminu</a></label>
                </div>
                <div>
                    <input type='checkbox' name='newsletter' id='newsletter-add'><label for='newsletter-add'>Chcę zapisać się do newslettera</label>
                </div>
                <input class='register-button-confirm pink-button' type='submit' value='Zarejestruj się'>
            </form>
        </div>
    </main>



    <!--- to be done someday...

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
    $connection->close();
?>