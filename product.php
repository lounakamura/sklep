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

    $product = [];
    $images = [];
    
    // Checking if there is a product chosen
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

    // Storing if a product is favourited
    $product['ulubiony'] = "not-fav";
    if(isset($_SESSION['loggedin'])){
        $query = "SELECT produkt_id FROM ulubiony WHERE uzytkownik_id=".$_SESSION['id']." AND produkt_id=".$product['produkt_id'];
        $result = $connection->query($query);
        if(mysqli_num_rows($result)>0){
            $product['ulubiony'] = "fav";
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
    <?php
        require_once __DIR__.'\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/product.css">
</head>

<body>
    <?php 
        require_once __DIR__.'\page-components\header.html';
        require_once __DIR__.'\page-components\nav.php'; 
    ?>

    <main>
        <div class='main-content'>
            <?php
                echo "<div class='breadcrumbs'>
                    <ul>
                        <li><a href='/sklep/index.php'>Strona Główna</a></li>
                        <li><a href='/sklep/products.php'>Produkty</a></li>
                        <li><a href='/sklep/products.php?maincategory=".$product['kategoria_id']."'>".$product['kategoria']."</a></li>
                        <li><a href='/sklep/products.php?category=".$product['kategoria1_id'] . "'>".$product['kategoria1']."</a></li>
                        <li><a href='/sklep/products.php?subcategory=" . $product['kategoria2_id']."' style='color:#c5c5c5'>".$product['kategoria2']."</a></li>
                    </ul>
                </div>

                <div class='product-information'>
                    <div class='img-gallery'>
                        <div class='gallery-container'>
                            <button class='add-to-fav ".$product['ulubiony']."' data-product_id='".$product['produkt_id']."' title='Ulubione'></button>
                            <img class='gallery-main-img' src='".$images[0]['zdjecie']."' title='Kliknij aby otworzyć galerię'>
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
                        <a href='products.php?brand=" . $product['marka_id'] . "'>
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
        </div>
    </main>

    <?php 
        require_once __DIR__.'\page-components\social-media.html'; 
        require_once __DIR__.'\page-components\footer.html';
        require_once __DIR__.'\page-components\extras.html';
    ?>
</body>
</html>

<?php 
    require_once __DIR__.'\page-components\scripts.html';
?>

<script src="/sklep/js/productQuantity.js"></script>
<script src="/sklep/js/addToCart.js"></script>
<script src="/sklep/js/productImageGallery.js"></script>

<?php
    $buffer = ob_get_contents();
    ob_end_clean();
    echo str_replace("%TITLE%", $product['nazwa'], $buffer);
    $connection->close();
?>