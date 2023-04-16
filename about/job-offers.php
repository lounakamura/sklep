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
    <script src="/sklep/js/jquery-3.6.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/it.js"></script>
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>
    
    <main>
        <h1>Oferty Pracy</h1>
        <p>
            <?php echo nl2br("
            <h3>Copywriter</h3>
            <h4>Opis stanowiska:</h4>
            <ul><li>Tworzenie tekstów eksperckich o szeroko rozumianej tematyce beauty</li>
            <li>Przygotowywanie opisów produktów na potrzeby sklepu internetowego</li>
            <li>Tworzenie i optymalizacja treści sklepu internetowego pod kątem wyszukiwarek internetowych</li>
            <li>Tworzenie treści na bloga</li>
            <li>Tworzenie tekstów na strony</li></ul>
            
            <h4>Wymagania:</h4>
            <ul><li>Rozumiesz i bardzo dobrze znasz branżę beauty, śledzisz trendy makijażowe i kosmetyczne</li>
            <li>Posiadasz lekkie pióro pdf</li>
            <li>Znasz doskonale zasady pisowni języka polskiego (gramatyka, ortografia, interpunkcja)</li>
            <li>Bogate słownictwo</li>
            <li>Potrafisz dostosować stylu do komunikatu</li>
            <li>Jesteś kreatywna/y</li>
            <li>Jesteś sumienna/y, dokładna/y i terminowa/y</li>
            <li>Rozumiesz czym jest SEO i potrafisz budować treści na strony internetowe</li></ul>
        
            <h4>Oferujemy:</h4>
            <ul><li>Praca w dużym, młodym zespole</li>
            <li>Umowa o pracę na pełen etat, współpraca B2B</li>
            <li>Komfortowe miejsce i warunki pracy</li>
            <li>Praca w młodym, energicznym zespole</li>
            <li>Szkolenie wdrożeniowe</li>
            <li>Rabat pracowniczy</li></ul>
            "); ?>
        </p>
        <a href='mailto:rekrutacja@kosmetykowo.pl' style='text-align:center;'><h3>Aplikuj</h3></a>
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
                <a href="/sklep/user/register.php">Rejestracja</a>
                <a href="/sklep/user/login.php">Logowanie</a>
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

    <script src="/sklep/js/misc.js"></script>
    <script src="/sklep/js/scrollToTop.js"></script>
    <script src="/sklep/js/menuHandler.js"></script>
<script src="/sklep/js/select2.js"></script>
    <script src="/sklep/js/slideshowGallery.js"></script>

    <script src="/sklep/js/cartPreview.js"></script>
    <script src="/sklep/js/addToCart.js"></script>
    <script src="/sklep/js/accountPreview.js"></script>
</body>
</html>

<?php
    $connection->close();
?>