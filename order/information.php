<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
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
    <?php
        require_once __DIR__.'\..\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/order.css">
</head>

<body>
    <header class='header-small'>
        <div class="logo_big-container">
            <a href="/sklep/index.php"><img class="logo_big" src="/sklep/images/ui/logo-big.svg" /></a>
        </div>
    </header>

    <main>
    <div class='order-navigation'>
            <a class='nav' href='/sklep/cart.php'>
                <span class='order-icons'>
                    <i class="fa-solid fa-cart-shopping fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Koszyk</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
            <a class='nav' href='/sklep/order/login.php'>
                <span class='order-icons'>
                    <i class="fa-solid fa-file-lines fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Twoje dane</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
            <a class='nav' href='/sklep/order/shipping.php'>
                <span class='order-icons'>
                    <i class="fa-solid fa-truck fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Dostawa i płatność</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
            <a class='nav' href='/sklep/order/check.php'>
                <span class='order-icons bubble-icon'>
                    <i class="fa-solid fa-clipboard-check fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Weryfikacja danych</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
        </div>

        <div class='client-info'>
            <h1>Twoje dane</h1>
            <form method='POST'>
                <input type='radio' name='company' value='no' id='private-person'><label for='private-person'>Osoba prywatna</label>
                <input type='radio' name='company' value='yes' id='company'><label for='company'>Firma</label>
                <label for='first-name'>Imię</label><input type='text' name='first-name' id='first-name'>
                <label for='last-name'>Nazwisko</label><input type='text' name='last-name' id='last-name'>
                <label for='street'>Ulica</label><input type='text' name='street' id='street'>
                <label for='street-no'>Nr domu</label><input type='text' name='street-no' id='street-no'>
                <label for='house-no'>Nr mieszkania</label><input type='text' name='house-no' id='house-no'>
                <label for='postal-code'>Kod pocztowy</label><input type='text' name='postal-code' id='postal-code'>
                <label for='city'>Miejscowość</label><input type='text' name='city' id='city'>
                <label for='country'>Kraj</label><select name='country' id='country'>
                <label for='phone'>Numer telefonu</label><input type='tel' name='phone' id='phone'>
                <label for='email'>Adres email</label><input type='email' name='email' id='email'>
                <button type='submit'>Przejdź dalej</button>
            </form>
        </div>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\footer.html';
    ?>
</body>
</html>

<?php
    $connection->close();
?>