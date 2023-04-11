<?php
    session_start();

    require_once "../php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
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
    <title>Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="/sklep/images/ui/logo-small.svg">
    <link rel="stylesheet" href="/sklep/css/main.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <header>
        <div class="logo_big-container">
            <a href="/sklep/index.php"><img class="logo_big" src="/sklep/images/ui/logo-big.svg" /></a>
        </div>

        <div class="search-container">
            <form>
                <input class="search-field" type="text" placeholder="Szukaj produktów...">
                <button class="search-button" type="submit"></button>
            </form>
        </div>

        <div class="header-buttons">
            <button onclick="location.href='/sklep/user/account.php'" type="button" class="header-account"></button>
            <button onclick="location.href='/sklep/user/favourites.php'" type="button" class='header-fav'></button>
            <button onclick="location.href='/sklep/cart.php'" type="button" class="header-cart">
                <div class='container-cart-items-amount' style='opacity:0'>
                    <div class='circle-cart-items-amount'>
                        <span class='cart-items-amount'>
                            -
                        
                    </div>
                </div>
            </button>
        </div>
    </header>

    <header class="header-small off">
        <div class="logo_big-container">
            <a href="/sklep/index.php"><img class="logo_big" src="/sklep/images/ui/logo-big.svg" /></a>
        </div>

        <div class="search-container">
            <form>
                <input class="search-field" type="text" placeholder="Szukaj produktów...">
                <button class="search-button" type="submit"></button>
            </form>
        </div>

        <div class="header-buttons">
            <button onclick="location.href='/sklep/user/account.php'" type="button" class="header-account" data-fixed='yes'></button>
            <button onclick="location.href='/sklep/user/favourites.php'" type="button" class='header-fav' data-fixed='yes'></button>
            <button onclick="location.href='/sklep/cart.php'" type="button" class="header-cart" data-fixed='yes'>
                <div class='container-cart-items-amount' style='opacity:0'>
                    <div class='circle-cart-items-amount'>
                        <span class='cart-items-amount'>
                            -
                        
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
                    <a class='uppercase' href='/sklep/category.php?maincategory=" . $maincategory['kategoria_id'] . "'>" . $maincategory['kategoria'] . "</a>";
                    echo "<section class='categories-bg off'>
                        <ul class='categories-main'>";
                            foreach ( $categories as $category ) {
                                $subcategories = [];
                                $query = "SELECT * FROM kategoria_2 WHERE kategoria_2.parent_id=" . $category['kategoria_id'];
                                $result = $connection->query($query);
                                fetchAllToArray( $subcategories, $result );
                                $result->free();

                                echo "<li>
                                    <a class='subcategory uppercase' href='/sklep/category.php?category=" . $category['kategoria_id'] . "'>" . $category['kategoria'] . "</a>";
                                    echo "<ul>";
                                        foreach ( $subcategories as $subcategory ) {
                                            echo "<li>
                                                <a class='subsubcategory' href='/sklep/category.php?subcategory=" . $subcategory['kategoria_id'] . "'>" . $subcategory['kategoria'] . "</a>";
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
                <a href="/sklep/brands.php" class="uppercase">Marki</a>
            </li>
        </ul>
    </nav>
    
    <main>
        <h1>Polityka Cookies</h1>
        <p>
            <?php echo nl2br("
            Poniższa Polityka Cookies określa zasady zapisywania i uzyskiwania dostępu do danych na Urządzeniach Użytkowników korzystających z Serwisu do celów świadczenia usług drogą elektroniczną przez Administratora Serwisu.

            <h3>1. Definicje</h3>
            Serwis - serwis internetowy działający pod adresem www.kosmetykowo.pl
            Serwis zewnętrzny - serwis internetowe partnerów, usługodawców lub usługobiorców Administratora
            Administrator - firma Kosmetykowo, prowadząca działalność pod adresem: Limanowa 123, 34-600, Limanowa, o nadanym numerze identyfikacji podatkowej (NIP): 1234567890, o nadanym numerze REGON: 098765432, świadcząca usługi drogą elektroniczną za pośrednictwem Serwisu oraz przechowująca i uzyskująca dostęp do informacji w urządzeniach Użytkownika
            Użytkownik - osba fizyczna, dla której Administrator świadczy usługi drogą elektroniczna za pośrednictwem Serwisu.
            Urządzenie - elektroniczne urządzenie wraz z oprogramowaniem, za pośrednictwem, którego Użytkownik uzyskuje dostęp do Serwisu
            Cookies (ciasteczka) - dane tekstowe gromadzone w formie plików zamieszczanych na Urządzeniu Użytkownika
            
            <h3>2. Rodzaje Cookies</h3>
            Cookies wewnętrzne - pliki zamieszczane i odczytywane z Urządzenia Użytkownika przes system teleinformatyczny Serwisu
            Cookies zewnętrzne - pliki zamieszczane i odczytywane z Urządzenia Użytkownika przez systemy teleinformatyczne Serwisów zewnętrznych
            Cookies sesyjne - pliki zamieszczane i odczytywane z Urządzenia Użytkownika przez Serwis lub Serwisy zewnętrzne podczas jednej sesji danego Urządzenia. Po zakończeniu sesji pliki są usuwane z Urządzenia Użytkownika.
            Cookies trwałe - pliki zamieszczane i odczytywane z Urządzenia Użytkownika przez Serwis lub Serwisy zewnętrzne do momentu ich ręcznego usunięcia. Pliki nie są usuwane automatycznie po zakończeniu sesji Urządzenia chyba że konfiguracja Urządzenia Użytkownika jest ustawiona na tryb usuwanie plików Cookie po zakończeniu sesji Urządzenia.
            
            <h3>3. Bezpieczeństwo</h3>
            Mechanizmy składowania i odczytu - Mechanizmy składowania i odczytu Cookies nie pozwalają na pobierania jakichkolwiek danych osobowych ani żadnych informacji poufnych z Urządzenia Użytkownika. Przeniesienie na Urządzenie Użytkownika wirusów, koni trojańskich oraz innych robaków jest praktynie niemożliwe.
            Cookie wewnętrzne - zastosowane przez Administratora Cookie wewnętrzne są bezpieczne dla Urządzeń Użytkowników
            Cookie zewnętrzne - za bezpieczeństwo plików Cookie pochodzących od partnerów Serwisu Administrator nie ponosi odpowiedzialności. Lista partnerów zamieszczona jest w dalszej części Polityki Cookie.

            <h3>4. Cele do których wykorzystywane są pliki Cookie</h3>
            Usprawnienie i ułatwienie dostępu do Serwisu - Administrator może przechowywać w plikach Cookie informacje o prefernecjach i ustawieniach użytkownika dotyczących Serwisu aby usprawnić, polepszyć i przyśpieszyć świadczenie usług w ramach Serwisu.Logowanie - Administrator wykorzystuje pliki Cookie do celów logowania Użytkowników w SerwisieMarketing i reklama - Administrator oraz Serwisy zewnętrzne wykorzystują pliki Cookie do celów marketingowych oraz serwowania reklam Użytkowników.Dane statystyczne - Administrator oraz Serwisy zewnętrzne wykorzystuje pliki Cookie do zbirania i przetwarzania danych statystycznych takich jak np. statystyki odwiedzin, statystyki Urządzeń Użytkowników czy statystyki zachowań użytkowników. Dane te zbierane są w celu analizy i ulepszania Serwisu.

            <h3>5. Serwisy zewnętrzne</h3>
            Administrator nie współpracuje z serwisami zewnętrznymi i Serwis nie umieszcza ani nie korzysta z żadnych plików zewnętrznych plików Cookie.

            <h3>6. Możliwości określania warunków przechowywania i uzyskiwania dostępu na Urządzeniach Użytkownika przez Serwis i Serwisy zewnętrzne</h3>
            Użytkownik może w dowolnym momencie, samodzielnie zmienić ustawienia dotyczące zapisywania, usuwania oraz dostępu do danych zapisanych plików Cookies
            Użytkownik może w dowolnym momencie usunąć wszelkie zapisane do tej pory pliki Cookie korzystając z narzędzi Urządzenia Użytkownika za pośrednictwem którego Użytkowanik korzysta z usług Serwisu.
            
            <h3>7. Wyłączenie odpowiedzialności</h3>
            Administrator stosuje wszelkie możliwe środki w celu zapewnienia bezpieczeństwa danych umieszczanych w plikach Cookie. Należy jednak zwrócić uwagę, że zapewnienie bezpieczeństwa tych danych zależy od obu stron, w tym działalności Użytkownika oraz satnu zabezpieczeń urządzenia z którego korzysta.
            Administrator nie bierze odpowiedzialności za przechwycenie danych zawartych w plikach Cookie, podszycie się pod sesję Użytkownika lub ich usunięcie, na skutek świadomej lub nieświadomej działalność Użytkownika, wirusów, koni trojańskich i innego oprogramowania szpiegującego, którymi może być zainfekowane Urządzenie Użytkownika.
            Użytkownicy w celu zabezpieczenia się przed wskazanymi w punkcie poprzednim zagrożeniami powinni stosować się do zasad cyberbezpieczeństwa w sieci.
            Usługi świadczone przez podmioty trzecie są poza kontrolą Administratora. Podmioty te mogą w każdej chwili zmienić swoje warunki świadczenia usług, cel oraz wykorzystanie plików cookie. Administrator nie odpowiada na tyle na ile pozwala na to prawo za działanie plików cookies używanych przez serwisy partnerskie. Użytkownicy w każdej chwili mogą samodzielnie zarządzać zezwoleniami i ustawieniami plików cookie dla każedej dowolnej witryny.
            
            <h3>8. Wymagania Serwisu</h3>
            Ograniczenie zapisu i dostępu do plików Cookie na Urządzeniu Użytkownika może spowodować nieprawidłowe działanie niektórych funkcji Serwisu.
            Administrator nie ponosi żadnej odpowiedzialności za nieprawidłowo działające funkcje Serwisu w przypadku gdy Użytkownik ograniczy w jakikolwiek sposób możliwość zapisywania i odczytu plików Cookie.
            
            <h3>9. Zmiany w Polityce Cookie</h3>
            Administrator zastrzega sobie prawo do dowolnej zmiany niniejszej Polityki Cookie bez konieczności informowania o tym użytkowników.
            Wprowadzone zmiany w Polityce Cookie zawsze będą publikowane na tej stronie.
            Wprowadzone zmiany wchodzą w życie w dniu publikacji Polityki Cookie."); ?>
        </p>
    </main>

    <section>
        <div class="social-media">
            <h2>Znajdziesz nas na:</h2>
            <div class="social-media-icons">
                <a id="social-fb" href="https://facebook.com" target='_blank'><img src="/sklep/images/ui/fb-logo.svg"></a>
                <a id="social-tiktok" href="https://tiktok.com" target='_blank'><img src="/sklep/images/ui/tiktok-logo.svg"></a>
                <a id="social-insta" href="https://instagram.com" target='_blank'><img src="/sklep/images/ui/instagram-logo.svg"></a>
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
        <iframe src='/sklep/account-preview.php' class='account-container hidden' data-id='account'>
        </iframe>
    </section>

    <!-- Cart preview -->
    <section>
        <iframe src='/sklep/cart-preview.php' class='preview-cart-container hidden' data-id='preview-cart'>
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

    <script src="/sklep/js/script.js"></script>
    <script src="/sklep/js/scrollToTop.js"></script>
    <script src="/sklep/js/menuHandler.js"></script>
    <script src="/sklep/js/slideshowGallery.js"></script>

    <script src="/sklep/js/previewCart.js"></script>
    <script src="/sklep/js/addToCart.js"></script>
    <script src="/sklep/js/accountPreview.js"></script>
</body>
</html>

<?php
    $connection->close();
?>