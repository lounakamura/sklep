<?php
    session_start();
    ob_start();

    require_once __DIR__."\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    require_once __DIR__.'\page-components\required.php';

    $products = [];
    $favourited = [];
    $displayedCategoryParents = [];

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
    if(isset($_SESSION['loggedin'])){
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
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>%TITLE% | Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="/sklep/images/ui/logo-small.svg">
    <link rel="stylesheet" href="/sklep/css/main.css">
    <link rel="stylesheet" href="css/category-brand.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
<section>
    <?php 
        require_once __DIR__.'\page-components\header.html';
        require_once __DIR__.'\page-components\nav.php'; 
    ?>

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

    <?php 
        require_once __DIR__.'\page-components\newsletter.html';
        require_once __DIR__.'\page-components\social-media.html'; 
        require_once __DIR__.'\page-components\footer.html';
        require_once __DIR__.'\page-components\extras.html';
    ?>

    <script src="js/misc.js"></script>
    <script src="js/scrollToTop.js"></script>
    <script src="js/menuHandler.js"></script>
    <script src="js/cartPreview.js"></script>
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