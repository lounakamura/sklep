<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    $maincategories = [];
    $products = [];

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
        <h1>Koszyk</h1>
        <div class='shopping-cart-empty'>
            <span>Twój koszyk jest pusty. Dodaj do niego produkty, aby móc rozpocząć składanie zamówienia.</span>
            <button onclick="location.href='index.php'" class='white-button'>Powrót</button>
        </div>
         <div class='shopping-cart-with-products'>
            <table>
                <thead>
                    <tr>
                        <th class='first'></th>
                        <th class='table-header uppercase'>Cena</th>
                        <th class='table-header uppercase'>Ilość</th>
                        <th class='table-header uppercase' >Wartość</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class='product-container'>
                        <td class='product-image product-name'>
                            <a href='product.php?id=1'><img src='images/product-images/1_1_min.jpg'></a>
                            <a href='product.php?id=1'><h3>Za wszystkie krzywdy sam przeproszę Boga One kuszą mnie jak zło-o, biały towar (woo)</h3></a>
                        </td>
                        <td class='product-price'>
                            <span>20,00 zł</span>
                        </td>
                        <td class='product-quantity'>
                            <div class='quantity-input'>
                                <button class='quantity-square subtract'>-</button>
                                <input class='quantity quantity-square' type='number' name='quantity' min='0' max='99' value='1' step='1'/>
                                <button class='quantity-square add'>+</button>
                            </div>
                        </td>
                        <td class='product-total-price'>
                            <span>20,00 zł</span>
                        </td>
                        <td class='product-remove'>
                            <button class='remove-from-cart'></button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class='shopping-cart-footer'>
                <div class='footer-left'>
                    <div class='add-discount-code'>
                        <span style='padding-bottom:2px'>Dodaj kod rabatowy</span>
                        <div style='display:inline-flex'>
                            <input class='discount-code' type='text' name='discount-code'>
                            <button class='button-activate pink-button'>Aktywuj</button>
                        </div>
                    </div>
                    <button onclick="location.href='index.php'" class='button-back white-button'>Kontynuuj zakupy</button>
                </div>
                <div class='footer-right'>
                    <div class='order-cost'>
                        <div class='order-cost-row'>
                            <span>Wartość zamówienia</span>
                            <span>
                                <?php
                                    echo number_format('20', 2, ',')
                                ?>
                                zł
                            </span>
                        </div>
                        <div class='order-cost-row'>
                            <span>Dostawa od</span>
                            <span>
                                <?php
                                    echo number_format('9.90', 2, ',')
                                ?>
                                zł
                            </span>
                        </div>
                        <div class='order-cost-row'>
                            <span>Razem</span>
                            <span>
                                <?php
                                    echo number_format('29.90', 2, ',')
                                ?>
                                zł
                            </span>
                        </div>
                    </div>
                    <button class='button-next pink-button'>Realizuj zamówienie</button>
                </div>
            </div>
        </div> -->
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
</body>

</html>

<?php
    $connection->close();
?>