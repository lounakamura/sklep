<?php
    session_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }
    
    if(!isset($_SESSION['isadmin'])) {
        header('Location: /sklep/index.php');
    }

    $cartAmount = [];
    $maincategories = [];
    $brands = [];
    $productNames = [];

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

    // Storing brands
    $query = "SELECT * FROM marka ORDER BY marka ASC";
    $result = $connection->query($query);
    fetchAllToArray($brands, $result);
    $result->free();

    // Storing product names with ids
    $query = "SELECT produkt_id, nazwa FROM produkt";
    $result = $connection->query($query);
    fetchAllToArray($productNames, $result);
    $result->free();

    // Image upload
    if(isset($_POST['img-upload'])){
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $name = $_POST['product_id']."_".time().".".$extension;
        $target_dir = "images/product-images/".$_POST['product_id']."/";
        $target_file = $target_dir.$name;
      
        $validExtensions = array("jpg", "jpeg", "png", "gif");
      
        if(in_array($extension, $validExtensions)){
            // Check if directory exists, if not, create it
            if(!is_dir($target_dir)) {
                mkdir($target_dir);
            }
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)){
              $query = "INSERT INTO zdjecie (sciezka, nazwa, produkt_id) VALUES ('$target_dir', '$name', ".$_POST['product_id'].")";
              $result = $connection->query($query);
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
    <title>Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="images/ui/logo-small.svg">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/admin.css">
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
        <h1>Panel administratora</h1>

        <h2>Produkt</h2>
        <div class="container">
            <label for='state1'>
                <div class='accordion'>Dodaj nowy produkt</div>
            </label>
            <input type='checkbox' id='state1' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/add-product.php" enctype='multipart/form-data'>
                        <label for="category">Kategoria główna</label>
                        <select name="category" id="category">
                            <?php
                                foreach($maincategories as $maincategory){
                                    echo "<option value='".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</option>";
                                }
                            ?>
                        </select>

                        <label for="category1">Podkategoria</label>
                        <select name="category1" id="category1">
                            <?php
                                foreach($maincategories as $maincategory){
                                    $categories = [];
                                    $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                    $result = $connection->query($query);
                                    fetchAllToArray( $categories, $result );
                                    $result->free();

                                    foreach($categories as $category){
                                        echo "<option value='".$category['kategoria_id']."' data-parent='".$maincategory['kategoria_id']."'>".$category['kategoria']."</option>";
                                    }
                                    unset( $categories );
                                }
                            ?>
                        </select>

                        <label for="category2">Kategoria produktu</label>
                        <select name="category2" id="category2">
                            <?php
                                foreach($maincategories as $maincategory){
                                    $categories = [];
                                    $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                    $result = $connection->query($query);
                                    fetchAllToArray( $categories, $result );
                                    $result->free();

                                    foreach($categories as $category){
                                        $subcategories = [];
                                        $query = "SELECT * FROM kategoria_2 AS k2 WHERE k2.parent_id = ".$category['kategoria_id']." ORDER BY kategoria ASC";
                                        $result = $connection->query($query);
                                        fetchAllToArray( $subcategories, $result );
                                        $result->free();

                                        foreach($subcategories as $subcategory){
                                            echo "<option value='".$subcategory['kategoria_id']."' data-parent='".$category['kategoria_id']."'>".$subcategory['kategoria']."</option>";
                                        }
                                        unset($subcategories);
                                    }
                                    unset($categories);
                                }
                            ?>
                        </select>

                        <label for="name">Nazwa</label>
                        <input type="text" name="name" id="name" required maxlength="128">

                        <label for="price">Cena</label>
                        <input type="number" name="price" id="price" required min="0.00" max="10000.00" step="0.01">

                        <label for="description">Opis</label>
                        <textarea name="description" id="description" required></textarea>

                        <label>Marka</label>
                        <select name="brand">
                            <?php
                                foreach($brands as $brand){
                                    echo "<option value='".$brand['marka_id']."'>".$brand['marka']."</option>";
                                }
                            ?>
                        </select>

                        <label for="amount">Ilość</label>
                        <input type="number" name="amount" id="amount" required min="0" max="999" step="1" value="999">

                        <label for="images">Zdjęcia</label>
                        <input name="upload[]" type="file" multiple="multiple" id="images">

                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state2'>
                <div class='accordion'>Dodaj zdjęcia do istniejącego produktu</div>
            </label>
            <input type='checkbox' id='state2' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/upload-images.php" enctype='multipart/form-data'>
                        <label>Wybierz produkt z listy</label>
                        <select name="product">
                            <?php
                                foreach ($productNames as $product) {
                                    echo "<option value='".$product['produkt_id']."'>".$product['nazwa']."</option>";
                                }
                            ?>
                        </select>
                        <input name="upload[]" type="file" multiple="multiple" />
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state3'>
                <div class='accordion'>Usuń produkt</div>
            </label>
            <input type='checkbox' id='state3' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/remove-product.php">
                        <label>Wybierz produkt z listy</label>
                        <select name="product">
                            <?php
                                foreach ($productNames as $product) {
                                    echo "<option value='".$product['produkt_id']."'>".$product['nazwa']."</option>";
                                }
                            ?>
                        </select>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state4'>
                <div class='accordion'>Zmodyfikuj produkt</div>
            </label>
            <input type='checkbox' id='state4' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/modify-product.php">
                        <label>Wybierz produkt z listy</label>
                        <select name="product">
                            <?php
                                foreach ($productNames as $product) {
                                    echo "<option value='".$product['produkt_id']."'>".$product['nazwa']."</option>";
                                }
                            ?>
                        </select>
                        <button type="submit" class="pink-button">Modyfikuj</button>
                    </form>
                </div>
            </div>
        </div>

        <h2>Kategoria</h2>

        <div class="container">
            <label for='state5'>
                <div class='accordion'>Dodaj nową kategorię główną</div>
            </label>
            <input type='checkbox' id='state5' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/add-maincategory.php">
                        <label for='maincategory-name'>Nazwa</label>
                        <input type='text' name='maincategory' id='maincategory-name' required maxlength='25'>
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state6'>
                <div class='accordion'>Dodaj nową podkategorię</div>
            </label>
            <input type='checkbox' id='state6' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/add-category.php">
                        <label>Kategoria nadrzędna</label>
                        <select name="parent-category">
                            <?php
                                foreach($maincategories as $maincategory){
                                    echo "<option value='".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</option>";
                                }
                            ?>
                        </select>
                        <label for='category-name'>Nazwa</label>
                        <input type='text' name='category' id='category-name' required maxlength='32'>
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state7'>
                <div class='accordion'>Dodaj nową kategorię produktów</div>
            </label>
            <input type='checkbox' id='state7' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/add-subcategory.php">
                        <label>Kategoria nadrzędna</label>
                        <select name="parent-category">
                            <?php
                                foreach($maincategories as $maincategory){
                                    $categories = [];
                                    $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                    $result = $connection->query($query);
                                    fetchAllToArray( $categories, $result );
                                    $result->free();

                                    foreach($categories as $category){
                                        echo "<option value='".$category['kategoria_id']."' data-parent='".$maincategory['kategoria_id']."'>".$category['kategoria']."</option>";
                                    }
                                    unset( $categories );
                                }
                            ?>
                        </select>
                        <label for='subcategory-name'>Nazwa</label>
                        <input type='text' name='subcategory' id='subcategory-name' required maxlength='32'>
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state8'>
                <div class='accordion'>Usuń kategorię główną</div>
            </label>
            <input type='checkbox' id='state8' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/remove-maincategory.php">
                        <label>Wybierz kategorię główną</label>
                        <select name="maincategory">
                            <?php
                                foreach($maincategories as $maincategory){
                                    echo "<option value='".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</option>";
                                }
                            ?>
                        </select>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state9'>
                <div class='accordion'>Usuń podkategorię</div>
            </label>
            <input type='checkbox' id='state9' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/remove-category.php">
                        <label>Wybierz podkategorię</label>
                        <select name="category">
                            <?php
                            foreach($maincategories as $maincategory){
                                $categories = [];
                                $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                $result = $connection->query($query);
                                fetchAllToArray( $categories, $result );
                                $result->free();

                                foreach($categories as $category){
                                    echo "<option value='".$category['kategoria_id']."' data-parent='".$maincategory['kategoria_id']."'>".$category['kategoria']."</option>";
                                }
                                unset( $categories );
                            }
                            ?>
                        </select>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state10'>
                <div class='accordion'>Usuń kategorię produktów</div>
            </label>
            <input type='checkbox' id='state10' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/remove-subcategory.php">
                        <label>Wybierz kategorię produktów</label>
                        <select name="subcategory">
                            <?php
                                foreach($maincategories as $maincategory){
                                    $categories = [];
                                    $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                    $result = $connection->query($query);
                                    fetchAllToArray( $categories, $result );
                                    $result->free();

                                    foreach($categories as $category){
                                        $subcategories = [];
                                        $query = "SELECT * FROM kategoria_2 AS k2 WHERE k2.parent_id = ".$category['kategoria_id']." ORDER BY kategoria ASC";
                                        $result = $connection->query($query);
                                        fetchAllToArray( $subcategories, $result );
                                        $result->free();

                                        foreach($subcategories as $subcategory){
                                            echo "<option value='".$subcategory['kategoria_id']."' data-parent='".$category['kategoria_id']."'>".$subcategory['kategoria']."</option>";
                                        }
                                        unset($subcategories);
                                    }
                                    unset($categories);
                                }
                            ?>
                        </select>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
        </div>

        <h2>Marka</h2>

        <div class="container">
            <label for='state11'>
                <div class='accordion'>Dodaj nową markę</div>
            </label>
            <input type='checkbox' id='state11' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/add-brand.php">
                        <label for='brand-name'>Nazwa</label>
                        <input type='text' name='brand' id='brand-name' required maxlength='32'>
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state12'>
                <div class='accordion'>Usuń markę</div>
            </label>
            <input type='checkbox' id='state12' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/admin/remove-brand.php">
                        <label>Wybierz markę</label>
                        <select name="brand">
                            <?php
                                foreach($brands as $brand){
                                    echo "<option value='".$brand['marka_id']."'>".$brand['marka']."</option>";
                                }
                            ?>
                        </select>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
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

    <script src="/sklep/js-admin/addProduct-CategoryDisplay.js"></script>
</body>
</html>

<?php
    $connection->close();
?>