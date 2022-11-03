<!DOCTYPE html>
<html lang="pl">

<?php
$connect = new mysqli('localhost', 'root', '', 'sklep');

$query = "SELECT kategoria_2.kategoria_id,kategoria_2.kategoria AS kategoria_2,kategoria_1.kategoria AS kategoria_2,kategoria.kategoria AS kategoria FROM kategoria_2 JOIN kategoria_1 on (kategoria_2.parent_id = kategoria_1.kategoria_id) JOIN kategoria on (kategoria_1.parent_id = kategoria.kategoria_id)";
$result = $connect->query($query);

$i = 0;
while ($row = $result->fetch_assoc()) {
    $kategorie[$i] = $row;
    $i++;
}

$query = "SELECT * FROM kategoria";
$result = $connect->query($query);

$i = 0;
while ($row = $result->fetch_assoc()) {
    $glowneKategorie[$i] = $row;
    $i++;
}

$query = "SELECT * FROM marka";
$result = $connect->query($query);

$i = 0;
while ($row = $result->fetch_assoc()) {
    $marki[$i] = $row;
    $i++;
}

ob_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>%TITLE% Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="ui/logo_small.svg">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/produkt.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>

<body>
    <header>
        <div class="logo_big-container">
            <a href="index.php"><img class="logo_big" src="ui/logo_big.svg" /></a>
        </div>

        <div class="search-container">
            <form>
                <input class="search-field" type="text" placeholder="Szukaj produktów...">
                <button class="search-button" type="submit"></button>
            </form>
        </div>

        <div class="header-buttons">
            <button type="button" id="header-account"></button>
            <button onclick="location.href='koszyk.php'" type="button" id="header-basket"></button>
        </div>
    </header>

    <header class="header-small off">
        <div class="logo_big-container">
            <a href="index.php"><img class="logo_big" src="ui/logo_big.svg" /></a>
        </div>

        <div class="search-container">
            <form>
                <input class="search-field" type="text" placeholder="Szukaj produktów...">
                <button class="search-button" type="submit"></button>
            </form>
        </div>

        <div class="header-buttons">
            <button type="button" id="header-account"></button>
            <button onclick="location.href='koszyk.php'" type="button" id="header-basket"></button>
        </div>
    </header>

    <nav class="navigation-categories">
        <ul>
            <li><a class="pink-text" href="#">PROMOCJE</a></li>
            <?php
            foreach ($glowneKategorie as $glownaKategoria) {
                $query = "SELECT * FROM kategoria_1 WHERE kategoria_1.parent_id=" . $glownaKategoria['kategoria_id'];
                $result = $connect->query($query);

                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $podkategorie[$i] = $row;
                    $i++;
                }

                echo
                "<li class='category'><a class='uppercase' href='kategoria.php?maincategory=" . $glownaKategoria['kategoria_id'] . "'>" . $glownaKategoria['kategoria'] . "</a>
                <section class='categories-bg off'><ul class='categories-main'>";

                foreach ($podkategorie as $podkategoria) {
                    $query = "SELECT * FROM kategoria_2 WHERE kategoria_2.parent_id=" . $podkategoria['kategoria_id'];
                    $result = $connect->query($query);

                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        $podpodkategorie[$i] = $row;
                        $i++;
                    }

                    echo "<li>
                    <a class='subcategory uppercase' href='index.php?category=" . $podkategoria['kategoria_id'] . "'>" . $podkategoria['kategoria'] . "</a><ul>";

                    foreach ($podpodkategorie as $podpodkategoria) {
                        echo "<li><a class='subsubcategory' href='index.php?subcategory=" . $podpodkategoria['kategoria_id'] . "'>" . $podpodkategoria['kategoria'] . "</a></li>";
                    }

                    echo "</ul></li>";
                    unset($podpodkategorie);
                }

                echo "</ul></section></li>";
                unset($podkategorie);
            }
            ?>

            <li class="category"><a href="marki.php" class="uppercase">MARKI</a>
            </li>
        </ul>
    </nav>

    <main>
        <?php
        $id = $_GET['id'];

        $query = "SELECT nazwa,cena,opis,kategoria_2.kategoria AS kategoria2,kategoria_2.kategoria_id AS kategoria2_id,kategoria_1.kategoria AS kategoria1,kategoria_1.kategoria_id AS kategoria1_id,kategoria.kategoria AS kategoria,kategoria.kategoria_id AS kategoria_id,marka,marka.marka_id AS marka_id FROM produkt JOIN kategoria_2 on (produkt.kategoria_id = kategoria_2.kategoria_id) JOIN kategoria_1 on (kategoria_2.parent_id = kategoria_1.kategoria_id) JOIN kategoria on (kategoria_1.parent_id = kategoria.kategoria_id) JOIN marka on (produkt.marka_id = marka.marka_id) WHERE produkt_id=$id";

        $result = $connect->query($query);
        $produkt = $result->fetch_assoc();

        $query = "SELECT nazwa_pliku FROM zdjecie WHERE produkt_id=$id";
        $result = $connect->query($query);

        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $zdjecia[$i] = $row;
            $i++;
        }

        echo
        "<div class='category-tree'>
            <a href='index.php' class='uppercase'>Strona Główna</a> >
            <a href='kategoria.php?maincategory=" . $produkt['kategoria_id'] . "' class='uppercase'>" . $produkt['kategoria'] . "</a> >
            <a href='kategoria.php?category=" . $produkt['kategoria1_id'] . "' class='uppercase'>" . $produkt['kategoria1'] . "</a> >
            <a href='kategoria.php?subcategory=" . $produkt['kategoria2_id'] . "' class='uppercase'>" . $produkt['kategoria2'] . "</a>
        </div>


        
        <div class='product-information'>
            <div class='img-gallery'>" . //statycznie ustawione, do poprawki || zrobione za pomoca pluginu jq xzoom - czy to dozwolone?
            "<div class='xzoom-container'>
                    <img class='xzoom' src='product_img/1_1_min.jpg' xoriginal='product_img/1_1.jpg'>
                    <div class='xzoom-thumbs'>
                        <a href='product_img/1_1.jpg'>
                            <img class='xzoom-gallery' src='product_img/1_1_min.jpg' xpreview='product_img/1_1_min.jpg'>
                        </a>
                        <a href='product_img/1_2.jpg'>
                            <img class='xzoom-gallery' src='product_img/1_2_min.jpg'>
                        </a>
                        <a href='product_img/1_3.jpg'>
                            <img class='xzoom-gallery' src='product_img/1_3_min.jpg'>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class='info'>
                <a href='marka.php?brand=" . $produkt['marka_id'] . "'><h4>" . $produkt['marka'] . "</h4></a>
                <h3>" . $produkt['nazwa'] . "</h3>
                <span>" . number_format($produkt['cena'], 2, ',') . " zł</span><br>
                <div class='product-quantity'>
                    <div class='quantity-input'>
                        <button onclick='subtract()' class='quantity-square'>-</button>
                        
                        <input class='quantity quantity-square' type='number' name='quantity' min='0' max='99' value='1' step='1'/>
                        
                        <button onclick='add()' class='quantity-square'>+</button>
                    </div>
                    <div class='add-to-cart'>
                        <button>Dodaj do koszyka</button>
                    </div>
                </div>
                <p>" . nl2br($produkt['opis']) . "</p>
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
                <a id="social-fb" href="https://facebook.com"><img src="ui/facebook.svg"></a>
                <a id="social-tiktok" href="https://tiktok.com"><img src="ui/tiktok.svg"></a>
                <a id="social-insta" href="https://instagram.com"><img src="ui/instagram.svg"></a>
            </div>
        </div>
    </section>

    <footer>
        <div class="stopka">
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

    <script src="script.js"></script>
    <script src="menuHandler.js"></script>
    <script src="productQuantity.js"></script>
    <script src="productImageGallery.js"></script>
    <script src="xzoom.js"></script>
</body>

</html>

<?php
$buffer = ob_get_contents();
ob_end_clean();
echo str_replace("%TITLE%", $produkt['nazwa'], $buffer);
$connect->close();
?>