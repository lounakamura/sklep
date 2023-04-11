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
    $favourited = [];
    $displayedCategoryParents = [];

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

    // Product display based on category
    $baseSelectionOn = '';
    $displayedCategoryName = 'Produkty';
    if(isset($_GET['maincategory']) || isset($_GET['category']) || isset($_GET['subcategory'])){
        if (isset($_GET['maincategory'])) {
            $baseSelectionOn = ' WHERE k.kategoria_id=' . $_GET['maincategory'];
            $displayedCategory = $_GET['maincategory'];
            $categoryTable = 'kategoria';
        } else if (isset($_GET['category'])) {
            $baseSelectionOn = ' WHERE k1.kategoria_id=' . $_GET['category'];
            $displayedCategory = $_GET['category'];
            $categoryTable = 'kategoria_1';
            $query = "SELECT k.kategoria AS k_nazwa, k.kategoria_id AS k_id FROM kategoria_1 AS k1 JOIN kategoria AS k ON (k1.parent_id = k.kategoria_id) WHERE k1.kategoria_id=$displayedCategory";
            $result = $connection->query($query);
            $displayedCategoryParents =  $result->fetch_assoc();
            $result->free();
        } else if (isset($_GET['subcategory'])) {
            $baseSelectionOn = ' WHERE k2.kategoria_id=' . $_GET['subcategory'];
            $displayedCategory = $_GET['subcategory'];
            $categoryTable = 'kategoria_2';
            $query = "SELECT k1.kategoria AS k1_nazwa, k1.kategoria_id AS k1_id, k.kategoria AS k_nazwa, k.kategoria_id AS k_id FROM kategoria_2 AS k2 JOIN kategoria_1 AS k1 ON (k2.parent_id = k1.kategoria_id) JOIN kategoria AS k ON (k1.parent_id = k.kategoria_id) WHERE k2.kategoria_id=$displayedCategory";
            $result = $connection->query($query);
            $displayedCategoryParents =  $result->fetch_assoc();
            $result->free();
        }
        $query = "SELECT kategoria FROM $categoryTable WHERE kategoria_id=$displayedCategory";
        $result = $connection->query($query);
        $displayedCategoryName = $result->fetch_assoc()['kategoria'];
        $result->free();
    } else if (isset($_GET['brand'])) {
        $query = "SELECT * FROM marka WHERE marka_id=".$_GET['brand'];
        $result = $connection->query($query);
        $displayedBrand = $result->fetch_assoc()['marka'];
        $result->free();
        $baseSelectionOn = 'WHERE p.marka_id='.$_GET['brand'];
        $displayedCategoryName = $displayedBrand;
    }

    // Sorting products
    if (isset($_GET['sort']) && $_GET['sort']!='') {
        $sort = 'ORDER BY '.$_GET['sort'];
    } else {
        $sort = 'ORDER BY p.nazwa ASC';
    }

    // Storing products
    $query = "SELECT p.produkt_id, p.nazwa, cena, ilosc, k2.kategoria_id AS kategoria_2_id, k2.kategoria AS kategoria_2, k1.kategoria_id AS kategoria_1_id, k1.kategoria AS kategoria_1, k.kategoria_id AS kategoria_id, k.kategoria AS kategoria, m.marka_id AS marka_id, m.marka AS marka, CONCAT(z.sciezka, z.nazwa) AS zdjecie FROM produkt AS p JOIN kategoria_2 AS k2 USING (kategoria_id) JOIN kategoria_1 AS k1 ON (k2.parent_id = k1.kategoria_id) JOIN kategoria AS k ON (k1.parent_id = k.kategoria_id) JOIN marka AS m USING (marka_id) JOIN zdjecie AS z USING (produkt_id) $baseSelectionOn GROUP BY p.produkt_id $sort";
    $result = $connection->query($query);
    fetchAllToArray($products, $result);
    $productsFound = mysqli_num_rows($result);
    $result->free();

    // Storing product availability
    for($i=0; $i<count($products); $i++){
        if($products[$i]['ilosc']>0) {
            $products[$i]['dostepnosc'] = "available";
        } else {
            $products[$i]['dostepnosc'] = "unavailable";
        }
    }

    // Storing favourited products
    if($_SESSION['loggedin']){
        $query = "SELECT produkt_id FROM ulubiony WHERE uzytkownik_id=".$_SESSION['id'];
        $result = $connection->query($query);
        fetchAllToArray($favourited, $result);
        $result->free();
    }

    for($i=0; $i<count($products); $i++){
        $products[$i]['ulubiony'] = "not-fav";
        for($j=0; $j<count($favourited); $j++){
            if(in_array($products[$i]['produkt_id'], $favourited[$j])) {
                $products[$i]['ulubiony'] = "fav";
            }
        }
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
    <link rel="stylesheet" href="css/category-brand.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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
        <?php    
            echo "<div class='breadcrumbs'>
                    <ul>
                        <li><a href='index.php'>Strona Główna</a></li>";
                        if(isset($_GET['brand'])){
                            echo "<li><a href='brands.php'>Marki</a></li>
                            <li><a href='products.php?brand=".$_GET['brand']."'>$displayedBrand</a></li>";
                        } else {
                            echo "<li><a href='products.php'>Produkty</a></li>";
                        }
                        if (isset($_GET['maincategory']) || isset($_GET['category']) || isset($_GET['subcategory'])) {
                            echo "<li><a href='products.php?maincategory=";
                            if(isset($_GET['maincategory'])){
                                echo $_GET['maincategory']."'>".$displayedCategoryName;
                            } else {
                                echo $displayedCategoryParents['k_id']."'>".$displayedCategoryParents['k_nazwa'];
                            }
                            echo "</a></li>";
                            if (isset($_GET['category']) || isset($_GET['subcategory'])) {
                                echo "<li><a href='products.php?category=";
                                if(isset($_GET['category'])){
                                    echo $_GET['category']."'>".$displayedCategoryName;
                                } else {
                                    echo $displayedCategoryParents['k1_id']."'>".$displayedCategoryParents['k1_nazwa'];
                                }
                                echo "</a></li>";
                                if (isset($_GET['subcategory'])) {
                                    echo "<li><a href='products.php?subcategory=".$_GET['subcategory']."'>$displayedCategoryName</a></li>";
                                }
                            }
                        }
                    echo "
                    </ul>
                </div>";
        ?>

        <div class='product-display'>
            <div class='categories-container'>
                <h3>Kategorie</h3>
                <ul class='accordion-menu'>
                    <?php
                        foreach ( $maincategories as $maincategory ) {
                            $categories = [];
                            $query = "SELECT * FROM kategoria_1 as k1 WHERE k1.parent_id = " . $maincategory['kategoria_id'];
                            $result = $connection->query($query);
                            fetchAllToArray( $categories, $result );
                            $result->free();

                            $active = '';
                            $display = '';

                            if (isset($_GET['maincategory'])) {
                                if ($maincategory['kategoria_id'] == $_GET['maincategory']){
                                    $active = "class='active'";
                                    $display = "style='display:block'";
                                }
                            } else if (isset($_GET['category']) || isset($_GET['subcategory'])) {
                                if($maincategory['kategoria_id'] == $displayedCategoryParents['k_id']){
                                    $active = "class='active'";
                                    $display = "style='display:block'";
                                }
                            }
                            echo "
                            <li $active>
                                <div class='dropdown-header'>
                                    <a href='products.php?maincategory=".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</a>
                                    <i class='fa fa-chevron-down dropdown-btn' data-hidden='true'></i>
                                </div>";
                            echo "<ul class='submenu' $display>";

                                foreach ( $categories as $category ) {
                                    $subcategories = [];
                                    $query = "SELECT * FROM kategoria_2 as k2 WHERE k2.parent_id=" . $category['kategoria_id'];
                                    $result = $connection->query($query);
                                    fetchAllToArray( $subcategories, $result );
                                    $result->free();

                                    $active = '';
                                    $display = '';

                                    if (isset($_GET['category'])) {
                                        if($category['kategoria_id'] == $_GET['category']){
                                            $active = "class='active'";
                                            $display = "style='display:block'";
                                        }
                                    } else if (isset($_GET['subcategory'])){
                                        if($category['kategoria_id'] == $displayedCategoryParents['k1_id']){
                                            $active = "class='active'";
                                            $display = "style='display:block'";
                                        }
                                    }

                                    echo "
                                    <li $active>
                                        <div class='dropdown-header'>
                                            <a href='products.php?category=".$category['kategoria_id']."'>".$category['kategoria']."</a>
                                            <i class='fa fa-chevron-down dropdown-btn' data-hidden='true'></i>
                                        </div>
                                        <ul class='nested-menu' $display>";
                                            foreach ( $subcategories as $subcategory ) {
                                                echo "<a href='products.php?subcategory=".$subcategory['kategoria_id']."'>".$subcategory['kategoria']."</a>";
                                            }
                                            echo "
                                        </ul>
                                    </li>";
                                    unset($subcategories);
                                }
                            echo "</ul>
                            </li>";
                            unset($categories);
                        }
                    ?>
                </ul>
            </div>

            <div class='products-container'>
                <div class='products-misc'>
                    <?php
                        echo "<h3>".$productsFound." wyników</h3>";
                    ?>
                    <form method='GET'>
                        <?php
                            if (isset($_GET['maincategory'])) {
                                echo "<input type='hidden' name='maincategory' value='".htmlspecialchars($_GET['maincategory'])."'>";
                            } else if (isset($_GET['category'])) {
                                echo "<input type='hidden' name='category' value='".htmlspecialchars($_GET['category'])."'>";
                            } else if (isset($_GET['subcategory'])) {
                                echo "<input type='hidden' name='subcategory' value='".htmlspecialchars($_GET['subcategory'])."'>";
                            }
                        ?>
                        <label for='sort'>Sortuj wg</label>
                        <select name='sort' id='sort'>
                            <option value='' selected>domyślnie</option>
                            <option value='p.produkt_id DESC'>najnowsze</option>
                            <option value='p.nazwa ASC'>nazwa a-z</option>
                            <option value='p.nazwa DESC'>nazwa z-a</option>
                            <option value='cena ASC'>cena od najniższej</option>
                            <option value='cena DESC'>cena od najwyższej</option>
                        </select>
                    </form>
                </div>

                <?php
                    foreach ($products as $product) {
                        echo "<div class='product-container ".$product['dostepnosc']."'>";
                            echo "<div>";
                                echo "<button class='add-to-fav ".$product['ulubiony']."' data-product_id='".$product['produkt_id']."'></button>";
                                echo "<a href='product.php?id=" . $product['produkt_id'] . "'>
                                    <img src='".$product['zdjecie']."'>"; 
                                echo "</a>"; 
                                echo "<a href='products.php?brand=" . $product['marka_id'] . "'>
                                    <h4>" . $product['marka'] . "</h4>";
                                echo "</a>";
                                echo "<a href='product.php?id=" . $product['produkt_id'] . "'>
                                    <h3 class='line-limit'>" . $product['nazwa'] . "</h3>";
                                echo "</a>";
                            echo "</div>";
                            echo "<div>";
                                echo "<span>" . number_format($product['cena'], 2, ',') . "<span> zł</span></span><br>";
                                echo "<button class='pink-button add-to-cart-button ".$product['dostepnosc']."' data-product_id='".$product['produkt_id']."'>Dodaj do koszyka</button>";
                            echo "</div>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
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
    <script src="js/addOrRemoveFavourite.js"></script>
    <script src="js/productSort.js"></script>
    <script src="js/accordionMenu.js"></script>
</body>

</html>

<?php
    $buffer = ob_get_contents();
    ob_end_clean();
    echo str_replace("%TITLE%", $displayedCategoryName, $buffer);
    $connection->close();
?>