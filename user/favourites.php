<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    require_once __DIR__.'\..\page-components\required.php';

    $products = [];
    $favourited = [];

    if(isset($_SESSION['loggedin'])) {
        // Sorting products
        if (isset($_GET['sort']) && $_GET['sort']!='') {
            $sort = 'ORDER BY '.$_GET['sort'];
        } else {
            $sort = 'ORDER BY p.nazwa ASC';
        }

        // Storing products
        $query = "SELECT p.produkt_id, p.nazwa, cena, ilosc, k2.kategoria_id AS kategoria_2_id, k2.kategoria AS kategoria_2, k1.kategoria_id AS kategoria_1_id, k1.kategoria AS kategoria_1, k.kategoria_id AS kategoria_id, k.kategoria AS kategoria, m.marka_id AS marka_id, m.marka AS marka, CONCAT(z.sciezka, z.nazwa) AS zdjecie FROM produkt AS p JOIN kategoria_2 AS k2 USING (kategoria_id) JOIN kategoria_1 AS k1 ON (k2.parent_id = k1.kategoria_id) JOIN kategoria AS k ON (k1.parent_id = k.kategoria_id) JOIN marka AS m USING (marka_id) JOIN zdjecie AS z USING (produkt_id) JOIN ulubiony USING (produkt_id) WHERE uzytkownik_id=".$_SESSION['id']." GROUP BY p.produkt_id $sort";
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
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulubione | Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="/sklep/images/ui/logo-small.svg">
    <link rel="stylesheet" href="/sklep/css/main.css">
    <link rel="stylesheet" href="/sklep/css/favourites.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="/sklep/js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>

    <main>
        <h1>Ulubione</h1>
        
        <?php
            if(!isset($_SESSION['loggedin'])) {
                echo '
                <div class="not-logged-in">
                    <span>Nie jesteś zalogowany. Zaloguj się lub utwórz konto aby dodawać produkty do ulubionych.</span>
                    <button onclick="location.href=\'/sklep/user/login.php\'" class="login-button pink-button">Zaloguj się</button>
                    <span>lub</span>
                    <button onclick="location.href=\'/sklep/user/register.php\'" class="register-button pink-button">Zarejestruj się</button>
                </div>';
            } else {
                echo "<div class='products-misc'>
                        <h3>".$productsFound." wyników</h3>
                    <form method='GET'>
                        <label>Sortuj wg</label>
                        <select name='sort' id='sort'>
                            <option value='' selected>domyślnie</option>
                            <option value='p.produkt_id DESC'>najnowsze</option>
                            <option value='p.nazwa ASC'>nazwa a-z</option>
                            <option value='p.nazwa DESC'>nazwa z-a</option>
                            <option value='cena ASC'>cena od najniższej</option>
                            <option value='cena DESC'>cena od najwyższej</option>
                        </select>
                    </form>
                </div>";

                echo "<div class='product-display'>";
                    echo "<div class='products-container'>";
                        foreach ($products as $product) {
                            echo "<div class='product-container ".$product['dostepnosc']."'>";
                                echo "<div>";
                                    echo "<button class='add-to-fav ".$product['ulubiony']."' data-product_id='".$product['produkt_id']."'></button>";
                                    echo "<a href='/sklep/product.php?id=" . $product['produkt_id'] . "'>
                                        <img src='".$product['zdjecie']."'>"; 
                                    echo "</a>"; 
                                    echo "<a href='/sklep/products.php?brand=" . $product['marka_id'] . "'>
                                        <h4>" . $product['marka'] . "</h4>";
                                    echo "</a>";
                                    echo "<a href='/sklep/product.php?id=" . $product['produkt_id'] . "'>
                                        <h3 class='line-limit'>" . $product['nazwa'] . "</h3>";
                                    echo "</a>";
                                echo "</div>";
                                echo "<div>";
                                    echo "<span>" . number_format($product['cena'], 2, ',') . "<span> zł</span></span><br>";
                                    echo "<button class='pink-button add-to-cart-button ".$product['dostepnosc']."' data-product_id='".$product['produkt_id']."'>Dodaj do koszyka</button>";
                                echo "</div>";
                            echo "</div>";
                        }
                    echo "</div>";
                echo "</div>";
            }
        ?>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\newsletter.html';
        require_once __DIR__.'\..\page-components\social-media.html'; 
        require_once __DIR__.'\..\page-components\footer.html';
        require_once __DIR__.'\..\page-components\extras.html';
    ?>

    <script src="/sklep/js/misc.js"></script>
    <script src="/sklep/js/scrollToTop.js"></script>
    <script src="/sklep/js/menuHandler.js"></script>
    <script src="/sklep/js/productQuantity.js"></script>
    <script src="/sklep/js/cartPreview.js"></script>
    <script src="/sklep/js/accountPreview.js"></script>
    <script src="/sklep/js/productSort.js"></script>
</body>
</html>

<?php
    $connection->close();
?>