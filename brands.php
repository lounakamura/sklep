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

$query = "SELECT DISTINCT UPPER(SUBSTRING(marka, 1, 1)) AS litera FROM marka ORDER BY marka";
$result = $connect->query($query);
$i = 0;
while ($row = $result->fetch_assoc()) {
    $litery[$i] = $row;
    $i++;
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="ui/logo_small.svg">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/marki.css">
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
                    <a class='subcategory uppercase' href='kategoria.php?category=" . $podkategoria['kategoria_id'] . "'>" . $podkategoria['kategoria'] . "</a><ul>";

                    foreach ($podpodkategorie as $podpodkategoria) {
                        echo "<li><a class='subsubcategory' href='kategoria.php?subcategory=" . $podpodkategoria['kategoria_id'] . "'>" . $podpodkategoria['kategoria'] . "</a></li>";
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
        <section class="alphabet-ref">
            <?php
            foreach ($litery as $litera) {
                echo "<a href='#" . $litera['litera'] . "'>" . $litera['litera'] . "</a>";
            }
            ?>
        </section>
        <section>
            <?php
            foreach ($litery as $litera) {
                echo "<div id='" . $litera['litera'] . "' class='brand'><h2>" . $litera['litera'] . "</h2>";

                $query = "SELECT * FROM marka WHERE UPPER(SUBSTRING(marka, 1, 1))='" . $litera['litera'] . "'";
                $result = $connect->query($query);

                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $marki[$i] = $row;
                    $i++;
                }

                foreach ($marki as $marka) {
                    echo "<a href='marka.php?brand=" . $marka['marka_id'] . "'>" . $marka['marka'] . "</a>";
                }

                echo "</div>";
                unset($marki);
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
</body>

</html>
<?php
$connect->close();
?>