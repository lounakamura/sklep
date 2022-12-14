<?php
    session_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    }
    //DODAC USUWANIE PO JAKIMS CZASIE SESJI

    $maincategories = [];
    $products = [];

    // Storing cart amount
    $query = "SELECT COUNT(*) AS ilosc FROM koszyk WHERE sesja_id=".$_SESSION['session'];
    $result = $connection->query($query);
    $cartAmount = $result->fetch_assoc();
    $result->free();

    // Product display based on category
    $baseSelectionOn = '';
    $displayedCategoryName = 'Produkty';
    if (isset($_GET['maincategory'])) {
        $baseSelectionOn = ' WHERE kategoria.kategoria_id=' . $_GET['maincategory'];
        $displayedCategory = $_GET['maincategory'];
        $categoryTable = 'kategoria';
    } else if (isset($_GET['category'])) {
        $baseSelectionOn = ' WHERE kategoria_1.kategoria_id=' . $_GET['category'];
        $displayedCategory = $_GET['category'];
        $categoryTable = 'kategoria_1';
    } else if (isset($_GET['subcategory'])) {
        $baseSelectionOn = ' WHERE kategoria_2.kategoria_id=' . $_GET['subcategory'];
        $displayedCategory = $_GET['subcategory'];
        $categoryTable = 'kategoria_2';
    }

    if (isset($categoryTable)) {
        $query = "SELECT kategoria FROM $categoryTable WHERE kategoria_id=$displayedCategory";
        $result = $connection->query($query);
        $displayedCategoryName = $result->fetch_assoc()['kategoria'];
        $result->free();
    }

    // Sorting products
    if (isset($_POST['sort'])) {
        $sort = 'ORDER BY '.$_POST['sort'];
    } else {
        $sort = 'ORDER BY produkt.nazwa ASC';
    }

    // Storing the main categories
    $query = "SELECT * FROM kategoria";
    $result = $connection->query($query);
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
    <title>Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="images/ui/logo-small.svg">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/category-brand.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
<section>
        <iframe src='account-preview.php' class='account-container hidden' data-id='account'>
        </iframe>
    </section>

    <section>
        <iframe src='cart-preview.php' class='preview-cart-container hidden' data-id='preview-cart'>
        </iframe>
    </section>

    <header>
        <div class="logo_big-container">
            <a href="index.php"><img class="logo_big" src="images/ui/logo-big.svg" /></a>
        </div>

        <div class="search-container">
            <form>
                <input class="search-field" type="text" placeholder="Szukaj produkt??w...">
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
                <input class="search-field" type="text" placeholder="Szukaj produkt??w...">
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
        <?php
            echo "<div>";
                echo "<h2>".$displayedCategoryName."</h2>";
                echo "<h3>".$productsFound." wynik??w</h3>";
                echo "<form method='POST'>";
                    echo "<select name='sort' onchange='this.form.submit()'>
                        <option value='produkt.nazwa ASC' selected>Sortuj po nazwie rosn??co</option>
                        <option value='produkt.nazwa DESC'>Sortuj po nazwie malej??co</option>
                        <option value='cena ASC'>Sortuj po cenie rosn??co</option>
                        <option value='cena DESC'>Sortuj po cenie malej??co</option>";
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
                                echo "<span>" . number_format($product['cena'], 2, ',') . "<span> z??</span></span><br>";
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
                <h2>Zapisz si?? do naszego newslettera</h2>
                <form>
                    <input type="text" placeholder="Podaj adres e-mail">
                    <button type="submit">Zapisz si??</button>
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
                <a href="#">Polityka prywatno??ci</a>
                <a href="#">Regulamin sklepu</a>
                <a href="#">Oferty Pracy</a>
                <a href="#">Nasze sklepy</a>
                <a href="#">Polityka cookies</a>
            </div>


            <div>
                <h4 class="uppercase">Obs??uga klienta</h4>
                <a href="#">Formy p??atno??ci</a>
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
                <a href="#">Przypomnij has??o</a>
                <a href="#">Zam??wienia</a>
            </div>
        </div>
    </footer>

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